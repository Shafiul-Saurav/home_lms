<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreateCertificate;
use App\Models\LogoFavicon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /**
     * Display a listing of certificates
     */
    public function index()
    {
        $certificates = CreateCertificate::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.pages.certificate.index', compact('certificates'));
    }

    /**
     * Show certificate details
     */
    public function show(CreateCertificate $certificate)
    {
        $certificate->load(['user', 'course']);
        $logoFav = LogoFavicon::first();
        $companyLogo = $logoFav && $logoFav->logo ? asset($logoFav->logo) : null;
        $companyName = $logoFav && $logoFav->web_name ? $logoFav->web_name : 'DSGST Learning Management System';
        return view('backend.pages.certificate.show', compact('certificate', 'companyLogo', 'companyName'));
    }

    /**
     * Approve certificate
     */
    public function approve(CreateCertificate $certificate)
    {
        if ($certificate->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending certificates can be approved.');
        }

        $certificate->update([
            'status' => 'approved',
            'issued_date' => now(),
            'certificate_number' => 'CERT-' . strtoupper(Str::random(10)),
        ]);

        return redirect()->back()->with('success', 'Certificate approved successfully!');
    }

    /**
     * Reject certificate with reason
     */
    public function reject(Request $request, CreateCertificate $certificate)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        if ($certificate->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending certificates can be rejected.');
        }

        $certificate->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->back()->with('success', 'Certificate rejected successfully!');
    }

    /**
     * Remove a certificate
     */
    public function destroy(CreateCertificate $certificate)
    {
        $certificate->delete();
        return redirect()->back()->with('success', 'Certificate deleted successfully!');
    }
}

