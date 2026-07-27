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

    <form action="{{ route('service.consultations.store') }}" method="POST" class="auth-form p-4" style="border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.05);">
        @csrf
        <div class="row gy-3 consultation-request">
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
