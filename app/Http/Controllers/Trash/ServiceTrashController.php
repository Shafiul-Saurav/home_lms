<?php

namespace App\Http\Controllers\Trash;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceTrashController extends Controller
{
    public function trash()
    {
        $services = Service::onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.services.trash', compact('services'));
    }

    public function restore(string $id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->restore();

        return redirect()->back()->with('info', 'Service Restored Successfully 🙂');

    }

    public function forceDelete(string $id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->forceDelete();

        return redirect()->back()->with('error', 'Service Deleted Permanently');

    }
}
