<?php

namespace App\Http\Controllers\Backend;

use App\Models\CompanyOverview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CompanyOverviewController extends Controller
{
    public function index()
    {
        Gate::authorize('index-about');

        $companyOverview = CompanyOverview::first();
        return view('backend.pages.company_overview.company_overview', compact('companyOverview'));
    }

    public function store(Request $request)
    {
        Gate::authorize('edit-about');

        $companyOverview = CompanyOverview::firstOrNew();
        $companyOverview->title = $request->title;
        $companyOverview->sub_title = $request->sub_title;
        $companyOverview->description = $request->description;
        $companyOverview->save();

        return redirect()->back()->with('message', 'Company Overview updated successfully');
    }

    public function create()
    {
        // not used
    }

    public function show(string $id)
    {
        // not used
    }

    public function edit(string $id)
    {
        // not used
    }

    public function update(Request $request, string $id)
    {
        // not used
    }

    public function destroy(string $id)
    {
        // not used
    }
}
