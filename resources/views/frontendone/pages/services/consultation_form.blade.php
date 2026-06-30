<section class="section-padding consultation-request">
    <div class="container">
        <div class="section-heading text-center mb-4">
            <span class="sub-title"><i class="fa-solid fa-headset"></i> Consultation Request</span>
            <h2>Book a Consultation</h2>
            <p>Fill out the form below and our team will get back to you with a proposal and next steps.</p>
        </div>

        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form action="{{ route('service.consultations.store') }}" method="POST">
            @csrf
            <div class="row gy-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}">
                        @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="service_id">Select Service</label>
                        <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                            <option value="">Choose service</option>
                            @foreach($services as $serviceItem)
                                <option value="{{ $serviceItem->id }}" {{ old('service_id', $selectedServiceId ?? request('service_id')) == $serviceItem->id ? 'selected' : '' }}>{{ $serviceItem->title }}</option>
                            @endforeach
                        </select>
                        @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="timeslot_id">Preferred Timeslot</label>
                        <select name="timeslot_id" id="timeslot_id" class="form-control @error('timeslot_id') is-invalid @enderror">
                            <option value="">Choose a timeslot (optional)</option>
                            @foreach($timeslots as $timeslot)
                                <option value="{{ $timeslot->id }}" {{ old('timeslot_id') == $timeslot->id ? 'selected' : '' }}>{{ $timeslot->label }} ({{ \Carbon\Carbon::createFromFormat('H:i:s', $timeslot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $timeslot->end_time)->format('h:i A') }})</option>
                            @endforeach
                        </select>
                        @error('timeslot_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="expected_timeline">Expected Timeline</label>
                        <input type="text" name="expected_timeline" id="expected_timeline" class="form-control @error('expected_timeline') is-invalid @enderror" value="{{ old('expected_timeline') }}" placeholder="e.g. 2-4 weeks">
                        @error('expected_timeline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="project_requirement">Project Requirement</label>
                        <textarea name="project_requirement" id="project_requirement" rows="5" class="form-control @error('project_requirement') is-invalid @enderror" required>{{ old('project_requirement') }}</textarea>
                        @error('project_requirement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Send Consultation Request</button>
                </div>
            </div>
        </form>
    </div>
</section>
