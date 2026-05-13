<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\SslCommerz;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CoursePaymentController extends Controller
{
    /**
     * Show checkout page
     */
    public function checkoutPage($course_id)
    {
        $course = Course::findOrFail($course_id);
        $sslCommerzConfig = SslCommerz::first();
        return view('frontend.pages.checkout.course_checkout', compact('course', 'sslCommerzConfig'));
    }

    /**
     * Process payment
     */
    public function checkout(Request $request)
    {
        $course = Course::findOrFail($request->course_id);

        if ($request->payment_method == 'ShurjoPay') {
            return redirect()->back()->with('error', 'ShurjoPay integration is coming soon. Please use SSLCommerz.');
        }

        $sellingPrice = $course->price - $course->discount;
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
        $temporaryTranId = 'TEMP-' . $randomPart . '-' . $datePart;

        // Get SSLCommerz configuration from database
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
        $post_data['success_url'] = route('course.payment.success');
        $post_data['fail_url'] = route('course.payment.fail');
        $post_data['cancel_url'] = route('course.payment.cancel');
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
        $post_data['product_name'] = $course->name;
        $post_data['product_category'] = 'Online Course';
        $post_data['product_profile'] = 'non-physical-goods';

        // Store order data in session
        session()->put('pending_course_order', [
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'price' => $course->price,
            'amount' => $finalTotal,
            'discount_amount' => $discountAmount + $course->discount,
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

        session()->forget('pending_course_order');
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
            $pendingData = session()->get('pending_course_order');

            if (!$pendingData) {
                return redirect()->route('course.payment.fail')->with('error', 'Order session expired.');
            }

            // Create CourseOrder
            $orderNumber = 'ORD-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd');

            $order = CourseOrder::create([
                'user_id' => $pendingData['user_id'],
                'course_id' => $pendingData['course_id'],
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
                'status' => 'Enrolled',
                'payment_status' => 'Completed',
                'payment_method' => 'SSLCommerz'
            ]);

            session()->forget('pending_course_order');
            return redirect()->route('course.payment.thankyou', ['order_id' => $order->id]);
        }

        return redirect()->route('course.payment.fail');
    }

    public function fail(Request $request)
    {
        session()->forget('pending_course_order');
        return view('frontend.pages.checkout.payment_fail');
    }

    public function cancel(Request $request)
    {
        session()->forget('pending_course_order');
        return view('frontend.pages.checkout.payment_cancel');
    }

    public function thankyou($order_id)
    {
        $order = CourseOrder::with('course')->findOrFail($order_id);
        return view('frontend.pages.checkout.payment_thankyou', compact('order'));
    }

    public function ipn(Request $request)
    {
        // Implementation for IPN if needed
    }
    public function validateCoupon(Request $request)
    {
        $code = strtoupper($request->code);
        $total = $request->total;

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon.'], 404);
        }

        if (!$coupon->isValid()) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon.'], 400);
        }

        $discount = $coupon->getDiscountAmount($total);
        $newTotal = $total - $discount;

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discount' => number_format($discount, 2, '.', ''),
            'new_total' => number_format($newTotal, 2, '.', ''),
            'code' => $code
        ]);
    }
}
