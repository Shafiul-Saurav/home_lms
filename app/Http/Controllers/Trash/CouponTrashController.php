<?php

namespace App\Http\Controllers\Trash;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CouponTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-coupon');

        $coupons = Coupon::onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.coupons.trash', compact('coupons'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-coupon');

        $coupon = Coupon::onlyTrashed()->findOrFail($id);
        $coupon->restore();

        return redirect()->back()->with('info', 'Coupon Restored Successfully 🙂');

    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-coupon');

        $coupon = Coupon::onlyTrashed()->findOrFail($id);
        $coupon->forceDelete();

        return redirect()->back()->with('error', 'Coupon Deleted Permanently');

    }
}
