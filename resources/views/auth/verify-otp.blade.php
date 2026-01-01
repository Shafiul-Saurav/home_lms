<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify OTP</title>

    <!-- CoreUI Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/css/themes/bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-2N+IHl7TflsBD/9pe1QB8uLoBoE7kIODejp9eye2tfbvhuO+EiyissU8aWDbzxjJ" crossorigin="anonymous">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            /* display: flex; */
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-area {
            padding: 20px 0;
        }

        .auth-form {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            background: white;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header img {
            max-height: 60px;
            margin-bottom: 15px;
        }

        .auth-header h4 {
            color: #333;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #6c757d;
            margin-bottom: 5px;
        }

        .otp-timer {
            text-align: center;
            margin: 25px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .timer-text {
            font-weight: bold;
            font-size: 1.8em;
            color: #0d6efd;
            display: inline-block;
            padding: 10px 25px;
            background-color: white;
            border-radius: 25px;
            border: 2px solid #0d6efd;
            min-width: 140px;
            text-align: center;
            font-family: monospace;
            letter-spacing: 2px;
        }

        .form-otp {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 25px 0;
        }

        .form-otp-control {
            width: 55px;
            height: 55px;
            text-align: center;
            font-size: 1.6em;
            font-weight: bold;
            border: 2px solid #ced4da;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
            background-color: #fff;
        }

        .form-otp-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .form-otp-control.error {
            border-color: #dc3545;
        }

        .auth-btn {
            margin-top: 20px;
        }

        .auth-bottom {
            margin-top: 25px;
            text-align: center;
        }

        .auth-bottom-text {
            margin-bottom: 15px;
            color: #6c757d;
        }

        .resend-btn {
            margin-top: 10px;
        }

        .alert {
            margin-top: 15px;
            border-radius: 8px;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="auth-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-form">
                        <div class="auth-header">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="Logo" style="max-height: 60px;" />
                            <h4>Verify Your Account</h4>
                            <p>Enter the 6-digit code sent to your email</p>
                            <p class="fw-bold text-primary">{{ $email }}</p>
                        </div>

                        <form id="otpForm" action="{{ route('otp.verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="otp" id="otpHidden">

                            <!-- OTP Input with CoreUI style -->
                            <div class="form-otp" data-coreui-toggle="otp" data-coreui-id="basicOTP" data-coreui-name="otp">
                                <input class="form-otp-control" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-next="1">
                                <input class="form-otp-control" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-next="2" data-prev="0">
                                <input class="form-otp-control" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-next="3" data-prev="1">
                                <input class="form-otp-control" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-next="4" data-prev="2">
                                <input class="form-otp-control" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-next="5" data-prev="3">
                                <input class="form-otp-control" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-prev="4">
                            </div>

                            @error('otp')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <!-- Timer -->
                            <div class="otp-timer">
                                <p class="mb-2">Time remaining:</p>
                                <div class="timer-text" id="timer">10:00</div>
                            </div>

                            <div class="auth-btn">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-check-circle me-2"></i>Verify OTP
                                </button>
                            </div>
                        </form>

                        <div class="auth-bottom">
                            <p class="auth-bottom-text">
                                Didn't receive OTP?
                            </p>
                            <button type="button" class="btn btn-outline-primary btn-sm resend-btn" id="resendBtn">
                                Resend OTP
                            </button>
                            <p class="text-muted mt-3 small">
                                The OTP will expire in 10 minutes
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize timer with the time left from the server
        let timeLeft = {{ $timeLeft }};
        let timerInterval = null;

        function startTimer() {
            const timerElement = document.getElementById('timer');
            const resendBtn = document.getElementById('resendBtn');

            // Update the display immediately
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            // Initially disable the button if there's time remaining
            if (timeLeft > 0) {
                resendBtn.disabled = true;
                resendBtn.classList.remove('btn-primary');
                resendBtn.classList.add('btn-outline-primary');
            } else {
                // If no time left, enable the button
                resendBtn.disabled = false;
                resendBtn.classList.remove('btn-outline-primary');
                resendBtn.classList.add('btn-primary');
            }

            timerInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.textContent = '00:00';
                    resendBtn.disabled = false;
                    resendBtn.classList.remove('btn-outline-primary');
                    resendBtn.classList.add('btn-primary');
                    return;
                }

                timeLeft--;

                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Disable button while timer is running
                if (timeLeft > 0) {
                    resendBtn.disabled = true;
                    resendBtn.classList.remove('btn-primary');
                    resendBtn.classList.add('btn-outline-primary');
                } else {
                    // Enable button when timer reaches 0
                    resendBtn.disabled = false;
                    resendBtn.classList.remove('btn-outline-primary');
                    resendBtn.classList.add('btn-primary');
                }
            }, 1000);
        }

        // Start the timer when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            startTimer();
        });

        // OTP input auto-focus functionality
        const otpInputs = document.querySelectorAll('.form-otp-control');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                // Remove non-numeric characters
                this.value = this.value.replace(/\D/g, '');

                // Limit to single digit
                if (this.value.length > 1) {
                    this.value = this.value.charAt(0);
                }

                // Move to next input if current is filled
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                    otpInputs[index + 1].select(); // Select the content for easy replacement
                }

                // Update hidden field with combined OTP
                updateHiddenOtpField();
            });

            input.addEventListener('keydown', function(e) {
                // Move to previous input on backspace if current is empty
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                    otpInputs[index - 1].select(); // Select the content for easy replacement
                }

                // Allow navigation with arrow keys
                if (e.key === 'ArrowLeft' && index > 0) {
                    otpInputs[index - 1].focus();
                    otpInputs[index - 1].select();
                } else if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                    otpInputs[index + 1].select();
                }
            });

            // Only allow numeric input
            input.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                    e.preventDefault();
                }
            });

            // Handle paste event
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const paste = (e.clipboardData || window.clipboardData).getData('text');
                const digits = paste.replace(/\D/g, '').substring(0, 6);

                // Fill the inputs with pasted digits
                for (let i = 0; i < digits.length && i < otpInputs.length; i++) {
                    if (otpInputs[i]) {
                        otpInputs[i].value = digits[i];
                    }
                }

                // Update hidden field
                updateHiddenOtpField();

                // Focus on the last filled input or the next empty one
                const nextEmptyIndex = Array.from(otpInputs)
                    .findIndex(input => !input.value);
                if (nextEmptyIndex !== -1) {
                    otpInputs[nextEmptyIndex].focus();
                } else {
                    otpInputs[otpInputs.length - 1].focus();
                }
            });

            // Focus event to select all text for easy replacement
            input.addEventListener('focus', function() {
                this.select();
            });
        });

        // Function to update the hidden OTP field
        function updateHiddenOtpField() {
            const inputs = document.querySelectorAll('.form-otp-control');
            let otpValue = '';

            inputs.forEach(input => {
                otpValue += input.value || '';
            });

            document.getElementById('otpHidden').value = otpValue;
        }

        // Handle form submission
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            const inputs = document.querySelectorAll('.form-otp-control');
            let otpValue = '';

            inputs.forEach(input => {
                otpValue += input.value || '';
            });

            // Check if OTP is complete
            if (otpValue.length !== 6) {
                e.preventDefault();
                alert('Please enter the complete 6-digit OTP.');
                return;
            }

            // Update the hidden field with the OTP value
            document.getElementById('otpHidden').value = otpValue;
        });

        // Resend OTP button functionality
        document.getElementById('resendBtn').addEventListener('click', function() {
            const button = this; // Store reference to the button

            // Disable the button and show loading state
            button.disabled = true;
            button.innerHTML = 'Sending...';
            button.classList.remove('btn-primary');
            button.classList.add('btn-outline-primary');

            // Make an AJAX request to resend the OTP
            fetch('{{ route("otp.resend") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: '{{ $email }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reset timer
                    timeLeft = 600; // 10 minutes in seconds
                    document.getElementById('timer').textContent = '10:00';

                    // Restart timer
                    if (timerInterval) {
                        clearInterval(timerInterval);
                    }
                    startTimer();

                    // Re-enable button
                    button.disabled = false;
                    button.innerHTML = 'Resend OTP';
                    button.classList.remove('btn-outline-primary');
                    button.classList.add('btn-primary');

                    // Show success message
                    alert('New OTP sent to your email!');
                } else {
                    // Re-enable button
                    button.disabled = false;
                    button.innerHTML = 'Resend OTP';
                    button.classList.remove('btn-outline-primary');
                    button.classList.add('btn-primary');
                    alert('Failed to send OTP. Please try again.');
                }
            })
            .catch(error => {
                // Re-enable button
                button.disabled = false;
                button.innerHTML = 'Resend OTP';
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
                alert('An error occurred. Please try again.');
            });
        });
    </script>
</body>
</html>
