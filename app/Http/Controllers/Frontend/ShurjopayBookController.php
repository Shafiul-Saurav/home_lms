<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\Coupon;
use App\Models\ShurjopaySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShurjopayBookController extends Controller
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

    public function bookCheckout(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        $qty = $request->input('qty', 1);
        $config = ShurjopaySetting::first();

        if (!$config || !$config->username || !$config->password || !$config->store_id) {
            return redirect()->back()->with('error', 'Shurjopay is not configured properly.');
        }

        $token = $this->getToken($config);

        if (!$token) {
            return redirect()->back()->with('error', 'Shurjopay token generation failed.');
        }

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
        $order_num = 'SB-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd');

        session()->put('pending_book_order_shurjopay', [
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
            'order_number' => $order_num
        ]);

        $payload = [
            "prefix" => $config->prefix ?? "CDZY",
            "token" => $token,
            "return_url" => route('book.shurjopay.success'),
            "cancel_url" => route('book.shurjopay.cancel'),
            "store_id" => $config->store_id,
            "amount" => $finalTotal,
            "order_id" => $order_num,
            "currency" => "BDT",
            "customer_name" => $request->name,
            "customer_address" => $request->address,
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
            "shipping_address" => $request->address,
            "shipping_city" => "Dhaka",
            "shipping_country" => "Bangladesh",
            "received_person_name" => $request->name,
            "shipping_phone_number" => $request->phone,
            "value1" => $book->id,
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

        session()->forget('pending_book_order_shurjopay');
        return redirect()->back()->with('error', 'Shurjopay payment creation failed.');
    }

    public function bookSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $config = ShurjopaySetting::first();
        $token = $this->getToken($config);
        $pendingData = session()->get('pending_book_order_shurjopay');

        if (!$orderId) {
            return redirect()->route('book.payment.fail')->with('error', 'Missing order_id from Shurjopay.');
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
                'transaction_id' => $data[0]['bank_trx_id'] ?? $orderId,
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
                'payment_method' => 'ShurjoPay'
            ]);

            session()->forget('pending_book_order_shurjopay');
            return redirect()->route('book.payment.thankyou', ['order_id' => $order->id]);
        }

        session()->forget('pending_book_order_shurjopay');
        return redirect()->route('book.payment.fail')->with('error', 'Shurjopay verification failed.');
    }

    public function bookCancel()
    {
        session()->forget('pending_book_order_shurjopay');
        return view('frontend.pages.checkout.payment_cancel');
    }
}
