<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\Coupon;
use App\Models\ShurjopaySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShurjopayCourseController extends Controller
{
    private function getToken($config)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://engine.shurjopayment.com/api/get_token', [
            'username' => $config->username,
            'password' => $config->password,
        ]);

        return $response->json()['token'] ?? null;
    }

    public function checkout(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $config = ShurjopaySetting::first();

        if (!$config || !$config->username || !$config->password || !$config->store_id) {
            return redirect()->back()->with('error', 'Shurjopay is not configured properly.');
        }

        $token = $this->getToken($config);

        if (!$token) {
            return redirect()->back()->with('error', 'Shurjopay token generation failed.');
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
        $order_num = 'SP-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd');

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
            'order_number' => $order_num
        ]);

        $payload = [
            "prefix" => $config->prefix ?? "CDZY",
            "token" => $token,
            "return_url" => route('course.shurjopay.success'),
            "cancel_url" => route('course.shurjopay.cancel'),
            "store_id" => $config->store_id,
            "amount" => $finalTotal,
            "order_id" => $order_num,
            "currency" => "BDT",
            "customer_name" => $request->name,
            "customer_address" => $request->address ?? "Dhaka",
            "customer_phone" => $request->phone,
            "customer_city" => "Dhaka",
            "customer_post_code" => "1000",
            "client_ip" => $request->ip(),
            "discount_amount" => "0",
            "disc_percent" => "0",
            "customer_email" => $request->email,
            "customer_state" => "Dhaka",
            "customer_postcode" => "1000",
            "customer_country" => "Bangladesh",
            "shipping_address" => $request->address ?? "Dhaka",
            "shipping_city" => "Dhaka",
            "shipping_country" => "Bangladesh",
            "received_person_name" => $request->name,
            "shipping_phone_number" => $request->phone,
            "value1" => $course->id,
            "value2" => Auth::id()
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('https://engine.shurjopayment.com/api/secret-pay', $payload);

        $responseData = $response->json();

        if (isset($responseData['checkout_url'])) {
            return redirect()->away($responseData['checkout_url']);
        }

        session()->forget('pending_course_order');
        return redirect()->back()->with('error', 'Shurjopay payment creation failed.');
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $config = ShurjopaySetting::first();
        $token = $this->getToken($config);
        $pendingData = session()->get('pending_course_order');

        if (!$orderId) {
            return redirect()->route('course.payment.fail')->with('error', 'Missing order_id from Shurjopay.');
        }

        $verification = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('https://engine.shurjopayment.com/api/verification', [
            'order_id' => $orderId,
        ]);

        $data = $verification->json();

        if (!empty($data[0]) && ($data[0]['sp_code'] === '1000')) {
            if (!$pendingData) {
                return redirect()->route('course.payment.fail')->with('error', 'Order session expired.');
            }

            $order = CourseOrder::create([
                'user_id' => $pendingData['user_id'],
                'course_id' => $pendingData['course_id'],
                'name' => $pendingData['name'],
                'email' => $pendingData['email'],
                'phone' => $pendingData['phone'],
                'address' => $pendingData['address'],
                'order_number' => $pendingData['order_number'],
                'transaction_id' => $data[0]['bank_trx_id'] ?? $orderId,
                'currency' => 'BDT',
                'amount' => $pendingData['amount'],
                'price' => $pendingData['price'],
                'discount_amount' => $pendingData['discount_amount'],
                'coupon_name' => $pendingData['coupon_name'],
                'date' => date('Y-m-d'),
                'agree' => $pendingData['agree'],
                'status' => 'Enrolled',
                'payment_status' => 'Completed',
                'payment_method' => 'ShurjoPay'
            ]);

            session()->forget('pending_course_order');
            return redirect()->route('course.payment.thankyou', ['order_id' => $order->id]);
        }

        session()->forget('pending_course_order');
        return redirect()->route('course.payment.fail')->with('error', 'Shurjopay verification failed.');
    }

    public function cancel()
    {
        session()->forget('pending_course_order');
        return view('frontend.pages.checkout.payment_cancel');
    }
}
