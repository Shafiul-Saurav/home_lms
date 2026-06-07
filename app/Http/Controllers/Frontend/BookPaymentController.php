<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\BookOrder;
use App\Models\SslCommerz;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BookPaymentController extends Controller
{
    /**
     * Show checkout page
     */
    public function checkoutPage(Request $request, $book_id)
    {
        $book = Book::findOrFail($book_id);
        $qty = $request->input('qty', 1);
        $sslCommerzConfig = SslCommerz::first();
        return view('frontend.pages.checkout.book_checkout', compact('book', 'qty', 'sslCommerzConfig'));
    }

    /**
     * Process payment
     */
    public function checkout(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        $qty = $request->input('qty', 1);

        // Payment method handling is delegated to specific gateways; allow ShurjoPay flow
        $unitSellingPrice = $book->price - $book->discount_amount;
        $subtotal = $unitSellingPrice * $qty;
        $discountAmount = 0;
        $appliedCouponCode = $request->applied_coupon;

        if ($appliedCouponCode) {
            $coupon = Coupon::where('code', strtoupper($appliedCouponCode))->first();
            if ($coupon && $coupon->isValid()) {
                $discountAmount = $coupon->getDiscountAmount($subtotal);
            }
        }

        $finalTotal = $subtotal - $discountAmount;

        // Generate unique temporary transaction ID
        $randomPart = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
        $datePart = date('Y-m-d');
        $temporaryTranId = 'B-TEMP-' . $randomPart . '-' . $datePart;

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
        $post_data['success_url'] = route('book.payment.success');
        $post_data['fail_url'] = route('book.payment.fail');
        $post_data['cancel_url'] = route('book.payment.cancel');
        $post_data['emi_option'] = "0";

        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_city'] = 'Dhaka';
        $post_data['cus_state'] = 'Dhaka';
        $post_data['cus_postcode'] = '1000';
        $post_data['cus_country'] = 'Bangladesh';
        $post_data['cus_phone'] = $request->phone;

        $post_data['shipping_method'] = 'YES';
        $post_data['product_name'] = $book->name;
        $post_data['product_category'] = 'Book';
        $post_data['product_profile'] = 'physical-goods';

        // Store order data in session
        session()->put('pending_book_order', [
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'price' => $book->price,
            'qty' => $qty,
            'amount' => $finalTotal,
            'discount_amount' => $discountAmount + ($book->discount_amount * $qty),
            'coupon_name' => $appliedCouponCode,
            'agree' => $request->agree ? 1 : 0,
            'temporary_transaction_id' => $temporaryTranId
        ]);

        // Send data to SSLCommerz API
        $response = Http::asForm()->post($sslCommerzConfig->sslcommerz_url, $post_data);
        $responseData = $response->json();

        if (isset($responseData['status']) && $responseData['status'] == 'SUCCESS') {
            return redirect($responseData['GatewayPageURL']);
        }

        session()->forget('pending_book_order');
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
            $pendingData = session()->get('pending_book_order');

            if (!$pendingData) {
                return redirect()->route('book.payment.fail')->with('error', 'Order session expired.');
            }

            $orderNumber = 'B-ORD-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd');

            $order = BookOrder::create([
                'user_id' => $pendingData['user_id'],
                'book_id' => $pendingData['book_id'],
                'name' => $pendingData['name'],
                'email' => $pendingData['email'],
                'phone' => $pendingData['phone'],
                'address' => $pendingData['address'],
                'order_number' => $orderNumber,
                'transaction_id' => $tran_id,
                'currency' => 'BDT',
                'amount' => $pendingData['amount'],
                'price' => $pendingData['price'],
                'qty' => $pendingData['qty'],
                'discount_amount' => $pendingData['discount_amount'],
                'coupon_name' => $pendingData['coupon_name'],
                'date' => date('Y-m-d'),
                'agree' => $pendingData['agree'],
                'status' => 'pending',
                'payment_status' => 'Completed',
                'payment_method' => 'SSLCommerz'
            ]);

            session()->forget('pending_book_order');
            return redirect()->route('book.payment.thankyou', ['order_id' => $order->id]);
        }

        return redirect()->route('book.payment.fail');
    }

    public function fail(Request $request)
    {
        session()->forget('pending_book_order');
        return view('frontend.pages.checkout.payment_fail');
    }

    public function cancel(Request $request)
    {
        session()->forget('pending_book_order');
        return view('frontend.pages.checkout.payment_cancel');
    }

    public function thankyou($order_id)
    {
        $order = BookOrder::with('book')->findOrFail($order_id);
        return view('frontend.pages.checkout.book_payment_thankyou', compact('order'));
    }
}
