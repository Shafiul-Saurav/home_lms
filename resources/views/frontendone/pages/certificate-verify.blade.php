@extends('frontendone.layouts.master')

@section('title', 'Verify Certificate')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        :root {
            --theme-color: #76bd10;
        }

        .verify-section {
            min-height: 70vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 40px 0;
        }

        .verify-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 50px;
            max-width: 600px;
            margin: 0 auto;
        }

        .verify-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .verify-header h1 {
            font-size: 2.5rem;
            font-weight: 900;
            color: #111;
            margin-bottom: 15px;
        }

        .verify-header p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            color: #111;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--theme-color);
            box-shadow: 0 0 0 3px rgba(118, 189, 16, 0.1);
        }

        .btn-verify {
            width: 100%;
            padding: 16px;
            background: var(--theme-color);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-verify:hover {
            background: #66a00a;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(118, 189, 16, 0.3);
        }

        .btn-verify:active {
            transform: translateY(0);
        }

        .btn-verify.loading {
            opacity: 0.8;
            pointer-events: none;
        }

        .result-section {
            display: none;
            animation: slideIn 0.4s ease;
        }

        .result-section.show {
            display: block;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-result {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
            border-radius: 12px;
            padding: 25px;
            margin-top: 25px;
        }

        .success-result .badge {
            display: inline-block;
            background: var(--theme-color);
            color: #fff;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .success-result h3 {
            color: #155724;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .cert-detail {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(40, 167, 69, 0.2);
        }

        .cert-detail:last-child {
            border-bottom: none;
        }

        .cert-detail label {
            font-weight: 700;
            color: #155724;
            font-size: 0.9rem;
        }

        .cert-detail value {
            color: #155724;
            font-weight: 600;
        }

        .error-result {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 2px solid #dc3545;
            border-radius: 12px;
            padding: 25px;
            margin-top: 25px;
        }

        .error-result h3 {
            color: #721c24;
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .error-result p {
            color: #721c24;
            margin: 0;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .info-box {
            background: #f0f7ff;
            border-left: 4px solid var(--theme-color);
            padding: 15px;
            border-radius: 8px;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #333;
            line-height: 1.6;
        }

        .info-box strong {
            color: var(--theme-color);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: var(--theme-color);
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #66a00a;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- Breadcrumb -->
        <div style="padding: 60px 0 40px; background: linear-gradient(135deg, #07111f 0%, #0d1f36 50%, #12345a 100%); color: #fff;">
            <div class="container">
                <a href="{{ route('home') }}"
                    style="display:inline-flex;align-items:center;gap:8px;color:rgba(255,255,255,.7);text-decoration:none;font-size:.9rem;margin-bottom:12px;"
                    onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">
                    <i class="fa-solid fa-arrow-left"></i> Back to Home
                </a>
                <h4 style="font-size:1.5rem;font-weight:700;margin:0;color:#fff;">Verify Certificate</h4>
            </div>
        </div>

        <!-- Verification Section -->
        <div class="verify-section">
            <div class="verify-card">
                <div class="verify-header">
                    <h1>Certificate Verify</h1>
                    <p>All Certificates Issued By InfoSecTrain Carry A Unique Certification ID. Please Enter The Certification ID Below To Verify The Authenticity Of Your Certificate.</p>
                </div>

                <form id="certificateForm">
                    <div class="form-group">
                        <label for="certificate_number">Certificate Number</label>
                        <input
                            type="text"
                            id="certificate_number"
                            name="certificate_number"
                            placeholder="Enter certificate number (e.g., CERT-XXXXXXXXXX)"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <button type="submit" class="btn-verify">
                        <i class="fas fa-search"></i>
                        <span>Verify Certificate</span>
                    </button>
                </form>

                <!-- Result Section -->
                <div id="resultSection" class="result-section">
                    <!-- Success Result -->
                    <div id="successResult" style="display: none;">
                        <div class="success-result">
                            <span class="badge">
                                <i class="fas fa-check-circle"></i> Verified
                            </span>
                            <h3>Certificate Verified Successfully!</h3>

                            <div class="cert-detail">
                                <label>Certificate Number:</label>
                                <value id="certNumber"></value>
                            </div>
                            <div class="cert-detail">
                                <label>Student Name:</label>
                                <value id="studentName"></value>
                            </div>
                            <div class="cert-detail">
                                <label>Course Name:</label>
                                <value id="courseName"></value>
                            </div>
                            <div class="cert-detail">
                                <label>Issued Date:</label>
                                <value id="issuedDate"></value>
                            </div>
                        </div>
                    </div>

                    <!-- Error Result -->
                    <div id="errorResult" style="display: none;">
                        <div class="error-result">
                            <h3>
                                <i class="fas fa-times-circle"></i> Certificate Not Found
                            </h3>
                            <p id="errorMessage">The certificate number you entered could not be verified. Please check the number and try again.</p>
                        </div>
                    </div>
                </div>

                <div class="info-box">
                    <strong>Note:</strong> Certification IDs issued from 13th Nov, 2021 will be verified here. Please feel free to get in touch with us at <strong>support@infosectrain.com</strong> for any issues regarding the certificates issued by us!
                </div>

                <a href="{{ route('home') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        document.getElementById('certificateForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const certificateNumber = document.getElementById('certificate_number').value.trim();
            const submitBtn = this.querySelector('.btn-verify');
            const resultSection = document.getElementById('resultSection');

            if (!certificateNumber) {
                toastr.error('Please enter a certificate number');
                return;
            }

            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<span class="loading-spinner"></span><span>Verifying...</span>';

            try {
                const response = await fetch("{{ route('check.certificate') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        certificate_number: certificateNumber
                    })
                });

                const data = await response.json();

                // Reset button
                submitBtn.classList.remove('loading');
                submitBtn.innerHTML = '<i class="fas fa-search"></i><span>Verify Certificate</span>';

                // Hide both results first
                document.getElementById('successResult').style.display = 'none';
                document.getElementById('errorResult').style.display = 'none';

                if (data.success) {
                    // Show success result
                    document.getElementById('certNumber').textContent = data.certificate.number;
                    document.getElementById('studentName').textContent = data.certificate.student_name;
                    document.getElementById('courseName').textContent = data.certificate.course_name;
                    document.getElementById('issuedDate').textContent = data.certificate.issued_date;

                    document.getElementById('successResult').style.display = 'block';
                    resultSection.classList.add('show');

                    toastr.success('Certificate verified successfully!');
                } else {
                    // Show error result
                    document.getElementById('errorMessage').textContent = data.message || 'The certificate number you entered could not be verified.';
                    document.getElementById('errorResult').style.display = 'block';
                    resultSection.classList.add('show');

                    toastr.error(data.message || 'Certificate not found');
                }
            } catch (error) {
                console.error('Error:', error);
                submitBtn.classList.remove('loading');
                submitBtn.innerHTML = '<i class="fas fa-search"></i><span>Verify Certificate</span>';
                toastr.error('An error occurred while verifying the certificate. Please try again.');
            }
        });
    </script>
@endpush
