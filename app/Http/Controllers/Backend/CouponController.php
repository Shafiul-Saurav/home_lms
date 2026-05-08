<?php

namespace App\Http\Controllers\Backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('index-coupon');

        $coupons = Coupon::latest('id')->paginate(100);
        return view('backend.pages.coupons.coupons', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request)
    {
        Coupon::create([
            'code' => strtoupper($request->code),
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'usage_limit' => $request->usage_limit,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Coupon Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('backend.pages.coupons.view', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Gate::authorize('edit-coupon');

        $coupon = Coupon::findOrFail($id);

        return view('backend.pages.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'code' => strtoupper($request->code),
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'usage_limit' => $request->usage_limit,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Coupon Update Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Gate::authorize('delete-coupon');

        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->back()->with('error', 'Coupon Delete Successfully');
    }


    public function checkActive($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        if (!$coupon) {
            return response()->json([
                'type' => 'error',
                'message' => 'Coupon not found'
            ], 404);
        }

        // Toggle the is_active status
        $coupon->is_active = $coupon->is_active ? 0 : 1;
        $coupon->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

}
