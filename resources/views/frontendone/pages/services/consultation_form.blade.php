<section class="auth-area consultation-request">
    <style>
        .consultation-request .form-control:focus,
        .consultation-request textarea:focus,
        .consultation-request select:focus {
            background: #ecfdf5 !important;
            border-color: #76bd10 !important;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.15) !important;
        }

        .consultation-request .form-control {
            background: #ffffff;
            transition: all 0.25s ease;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="auth-form p-4" style="border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.05);">
                    <div class="auth-header text-center mb-4">
                        <i class="fa-solid fa-headset" style="font-size: 34px; color: #76bd10; margin-bottom: 12px;"></i>
                        <p style="font-size: 14px; font-weight: 700; color: #76bd10; margin-bottom: 8px;">Consultation Request</p>
                        <h2 style="font-size: 32px; font-weight: 800; margin-bottom: 8px;">Book a Consultation</h2>
                        <p style="color: #6b7280; margin: 0;">Fill out the form below and our team will get back to you with a proposal and next steps.</p>
                    </div>

                    {{-- @if(session('message'))
                        <div class="alert alert-success" style="border-radius: 14px; border: 1px solid #d1fae5; background: #ecfdf5; color: #065f46;">{{ session('message') }}</div>
                    @endif --}}

                    <form action="{{ route('service.consultations.store') }}" method="POST">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-user" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Your Name" required style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                    </div>
                                    @error('name')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-envelope" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Your Email" required style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                    </div>
                                    @error('email')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-phone" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone Number" required style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                    </div>
                                    @error('phone')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-building" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" placeholder="Company Name" style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                    </div>
                                    @error('company_name')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-briefcase" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror" required style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                            <option value="">Choose service</option>
                                            @foreach($services as $serviceItem)
                                                <option value="{{ $serviceItem->id }}" {{ old('service_id', $selectedServiceId ?? request('service_id')) == $serviceItem->id ? 'selected' : '' }}>{{ $serviceItem->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('service_id')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-clock" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <select name="timeslot_id" id="timeslot_id" class="form-control @error('timeslot_id') is-invalid @enderror" style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                            <option value="">Choose a timeline</option>
                                            @foreach($timeslots as $timeslot)
                                                @php
                                                    try {
                                                        $startTime = $timeslot->start_time ? \Carbon\Carbon::parse($timeslot->start_time)->format('h:i A') : null;
                                                    } catch (\Exception $e) {
                                                        $startTime = null;
                                                    }
                                                    try {
                                                        $endTime = $timeslot->end_time ? \Carbon\Carbon::parse($timeslot->end_time)->format('h:i A') : null;
                                                    } catch (\Exception $e) {
                                                        $endTime = null;
                                                    }
                                                @endphp
                                                <option value="{{ $timeslot->id }}" {{ old('timeslot_id') == $timeslot->id ? 'selected' : '' }}>{{ $timeslot->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('timeslot_id')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-icon" style="position: relative;">
                                        <i class="fa-solid fa-calendar-days" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                                        <input type="text" name="expected_timeline" id="expected_timeline" class="form-control @error('expected_timeline') is-invalid @enderror" value="{{ old('expected_timeline') }}" placeholder="Expected Timeline" style="padding-left: 50px; height: 54px; border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827;">
                                    </div>
                                    @error('expected_timeline')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="project_requirement" style="display:block; margin-bottom:8px; font-size: 14px; font-weight: 700; color: #4b5563;">Project Requirement</label>
                                    <textarea name="project_requirement" id="project_requirement" rows="5" class="form-control @error('project_requirement') is-invalid @enderror" placeholder="Tell us about your project requirements" required style="border-radius: 14px; border: 1px solid #edf0f5; font-size: 14px; font-weight: 600; background: #fff; color: #111827; padding: 16px 18px;">{{ old('project_requirement') }}</textarea>
                                    @error('project_requirement')<div class="invalid-feedback" style="display:block; margin-top:6px;">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="auth-btn">
                                    <button type="submit" style="width: 100%; height: 54px; background: #111827; color: #fff; border: none; border-radius: 50px; font-weight: 800; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; transition: 0.3s; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                                        <i class="fa-solid fa-paper-plane"></i> Send Consultation Request
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
