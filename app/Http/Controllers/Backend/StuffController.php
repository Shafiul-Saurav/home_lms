<?php

namespace App\Http\Controllers\Backend;

use App\Models\Stuff;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaffPayment;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class StuffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stuffs = Stuff::latest('id')->paginate(100);
        $departments = Department::get();
        return view('backend.pages.stuff.stuff', compact('stuffs', 'departments'));
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
    public function store(Request $request)
    {
        // dd($request->all());
        $stuff = Stuff::create([
            'department_id' => $request->department_id,
            'full_name' => $request->full_name,
            'bio' => $request->bio,
            'salary_type' => $request->salary_type,
            'salary_amount' => $request->salary_amount,
        ]);

        $this->image_upload($request, $stuff->id);
        return redirect()->route('staffs.index')->with('message', 'Stuff Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stuff = Stuff::findOrFail($id);
        $departments = Department::get();
        return view('backend.pages.stuff.edit', compact('stuff', 'departments'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stuff = Stuff::findOrFail($id);

        $stuff->update([
            'department_id' => $request->department_id,
            'full_name' => $request->full_name,
            'bio' => $request->bio,
            'salary_type' => $request->salary_type,
            'salary_amount' => $request->salary_amount,
        ]);
        $this->image_upload($request, $stuff->id);
        return redirect()->route('staffs.index')->with('message', 'Stuff Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stuff = Stuff::findOrFail($id);
        $stuff->delete();

        return redirect()->route('staffs.index')->with('message', 'Stuff Moved to Trash Successfully');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('stuff_image')) {
            $path = $request->file('stuff_image')->store('stuffs', 'public');
            return response()->json(['url' => Storage::url($path)]);
        }
        return response()->json(['error' => 'No image uploaded'], 400);
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $stuff_id)
    {
        $stuff = Stuff::findOrFail($stuff_id);

        if ($request->hasFile('stuff_image')) {
            $photo_location = public_path('uploads/stuffs/');

            if ($stuff->stuff_image && $stuff->stuff_image != 'default_stuff.png') {
                $old_photo_path = $photo_location . $stuff->stuff_image;
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }

            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $uploaded_photo = $request->file('stuff_image');
            $extension = strtolower($uploaded_photo->getClientOriginalExtension());
            $new_photo_name = $stuff->id . '.' . $extension;
            $new_photo_path = $photo_location . $new_photo_name;

            $img = Image::read($uploaded_photo)->resize(300, 300);

            if ($extension === 'webp') {
                $img->toWebp(40)->save($new_photo_path);
            } else {
                $img->toJpeg(40)->save($new_photo_path);
            }

            $stuff->update([
                'stuff_image' => $new_photo_name,
            ]);
        }
    }

    public function staffPayment($id)
    {
        $stuff = Stuff::findOrFail($id);
        $stuffPayments = StaffPayment::where('staff_id', $id)->paginate(100);

        return view('backend.pages.staff_payment.staff_payment', compact('stuff', 'stuffPayments'));
    }

    public function staffPaymentSave(Request $request, $id)
    {
        // dd($request->all());
        StaffPayment::create([
            'staff_id' => $request->staff_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('staff.payment', $id)->with('message', 'Payment Created Successfully 🙂');
    }

    public function staffPaymentDelete($id)
    {
        $stuffPayment = StaffPayment::where('id', $id)->first();
        $stuffPayment->delete();

        return redirect()->back()->with('message', 'Payment Record Moved to Trash Successfully');
    }

}
