<?php

namespace App\Http\Controllers\Frontend;

use App\Models\PdfBook;
use App\Models\PdfBookOrder;
use App\Models\SslCommerz;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PdfBookPaymentController extends Controller
{
    /**
     * Show checkout page
     */
    public function checkoutPage($book_id)
    {
        $book = PdfBook::findOrFail($book_id);
        $sslCommerzConfig = SslCommerz::first();
        return view('frontend.pages.checkout.pdf_book_checkout', compact('book', 'sslCommerzConfig'));
    }

    /**
     * Process payment
     */
    public function checkout(Request $request)
    {
        $book = PdfBook::findOrFail($request->book_id);

        // Payment method handling is delegated to specific gateways; allow ShurjoPay flow
        $sellingPrice = $book->price - $book->discount_amount;
        $discountAmount = 0;
        $appliedCouponCode = $request->applied_coupon;

        if ($appliedCouponCode) {
            $coupon = Coupon::where('code', strtoupper($appliedCouponCode))->first();
            if ($coupon && $coupon->isValid()) {
                $discountAmount = $coupon->getDiscountAmount($sellingPrice);
            }
        }

        $finalTotal = $sellingPrice - $discountAmount;

        // Generate unique temporary transaction ID
        $randomPart = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
        $datePart = date('Y-m-d');
        $temporaryTranId = 'PDF-TEMP-' . $randomPart . '-' . $datePart;

        // Get SSLCommerz configuration
        $sslCommerzConfig = SslCommerz::first();

        if (!$sslCommerzConfig || !$sslCommerzConfig->store_id || !$sslCommerzConfig->store_password || !$sslCommerzConfig->sslcommerz_url) {
            return redirect()->back()->with('error', 'Payment gateway is not configured properly.');
        }

        $post_data = array();
        $post_data['store_id'] = $sslCommerzConfig->store_id;
        $post_data['store_passwd'] = $sslCommerzConfig->store_password;
        $post_data['total_amount'] = $finalTotal;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $temporaryTranId;
        $post_data['success_url'] = route('pdf.book.payment.success');
        $post_data['fail_url'] = route('pdf.book.payment.fail');
        $post_data['cancel_url'] = route('pdf.book.payment.cancel');
        $post_data['emi_option'] = "0";

        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address ?? 'Dhaka';
        $post_data['cus_city'] = 'Dhaka';
        $post_data['cus_state'] = 'Dhaka';
        $post_data['cus_postcode'] = '1000';
        $post_data['cus_country'] = 'Bangladesh';
        $post_data['cus_phone'] = $request->phone;

        $post_data['shipping_method'] = 'NO';
        $post_data['product_name'] = $book->name;
        $post_data['product_category'] = 'Digital Book';
        $post_data['product_profile'] = 'non-physical-goods';

        // Store order data in session
        session()->put('pending_pdf_book_order', [
            'user_id' => Auth::id(),
            'pdf_book_id' => $book->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'price' => $book->price,
            'amount' => $finalTotal,
            'discount_amount' => $discountAmount + $book->discount_amount,
            'coupon_name' => $appliedCouponCode,
            'agree' => $request->agree ? 1 : 0,
            'temporary_transaction_id' => $temporaryTranId
        ]);

        // Create pending order record for testing before payment is completed
        // $pendingOrder = PdfBookOrder::create([
        //     'user_id' => Auth::id(),
        //     'pdf_book_id' => $book->id,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'order_number' => 'PDF-ORD-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd'),
        //     'transaction_id' => $temporaryTranId,
        //     'currency' => 'BDT',
        //     'amount' => $finalTotal,
        //     'price' => $book->price,
        //     'discount_amount' => $discountAmount + $book->discount_amount,
        //     'coupon_name' => $appliedCouponCode,
        //     'date' => date('Y-m-d'),
        //     'agree' => $request->agree ? 1 : 0,
        //     'payment_status' => 'Pending',
        //     'payment_method' => 'SSLCommerz'
        // ]);

        // session()->put('pending_pdf_book_order_id', $pendingOrder->id);

        // Send data to SSLCommerz API
        $response = Http::asForm()->post($sslCommerzConfig->sslcommerz_url, $post_data);
        $responseData = $response->json();

        if (isset($responseData['status']) && $responseData['status'] == 'SUCCESS') {
            return redirect($responseData['GatewayPageURL']);
        }

        session()->forget('pending_pdf_book_order');
        $errorMessage = $responseData['failedreason'] ?? 'Payment could not be initiated.';
        return redirect()->back()->with('error', $errorMessage);
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $sslCommerzConfig = SslCommerz::first();

        // Verify payment
        $verify_data = [
            'store_id' => $sslCommerzConfig->store_id,
            'store_passwd' => $sslCommerzConfig->store_password,
            'val_id' => $request->input('val_id'),
            'format' => 'json'
        ];

        $verify_response = Http::asForm()->post($sslCommerzConfig->sslcommerz_validation_url, $verify_data);
        $verify_result = $verify_response->json();

        if ($verify_result['status'] == 'VALID' || $verify_result['status'] == 'VALIDATED') {
            // $pendingOrderId = session()->get('pending_pdf_book_order_id');
            $pendingData = session()->get('pending_pdf_book_order');

            if (!$pendingData) {
            // $order = null;
            // if ($pendingOrderId) {
            //     $order = PdfBookOrder::find($pendingOrderId);
            // }

            // if (!$order && $pendingData) {
            //     $order = PdfBookOrder::where('transaction_id', $pendingData['temporary_transaction_id'])
            //         ->where('payment_status', 'Pending')
            //         ->first();
            // }

            // if (!$order) {
            //     $order = PdfBookOrder::where('transaction_id', $tran_id)
            //         ->where('payment_status', 'Pending')
            //         ->first();
            // }

            // if (!$order) {
                return redirect()->route('pdf.book.payment.fail')->with('error', 'Order session expired.');
            }

            $orderNumber = 'PDF-ORD-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd');

            $order = PdfBookOrder::create([
                'user_id' => $pendingData['user_id'],
                'pdf_book_id' => $pendingData['pdf_book_id'],
                'name' => $pendingData['name'],
                'email' => $pendingData['email'],
                'phone' => $pendingData['phone'],
                'address' => $pendingData['address'],
                'order_number' => $orderNumber,
                'transaction_id' => $tran_id,
                'currency' => 'BDT',
                'amount' => $pendingData['amount'],
                'price' => $pendingData['price'],
                'discount_amount' => $pendingData['discount_amount'],
                'coupon_name' => $pendingData['coupon_name'],
                'date' => date('Y-m-d'),
                'agree' => $pendingData['agree'],
                'payment_status' => 'Completed',
                'payment_method' => 'SSLCommerz'
            ]);

            // $order->payment_status = 'Completed';
            // $order->payment_method = 'SSLCommerz';
            // $order->transaction_id = $tran_id;
            // $order->save();

            session()->forget('pending_pdf_book_order');
            // session()->forget('pending_pdf_book_order_id');
            return redirect()->route('pdf.book.payment.thankyou', ['order_id' => $order->id]);
        }

        return redirect()->route('pdf.book.payment.fail');
    }

    public function fail(Request $request)
    {
        session()->forget('pending_pdf_book_order');
        // session()->forget('pending_pdf_book_order_id');
        return view('frontend.pages.checkout.payment_fail');
    }

    public function cancel(Request $request)
    {
        session()->forget('pending_pdf_book_order');
        // session()->forget('pending_pdf_book_order_id');
        return view('frontend.pages.checkout.payment_cancel');
    }

    public function thankyou($order_id)
    {
        $order = PdfBookOrder::with('pdfBook')->findOrFail($order_id);
        return view('frontend.pages.checkout.pdf_book_payment_thankyou', compact('order'));
    }
}
