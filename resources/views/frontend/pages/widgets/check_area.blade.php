<div class="check-area mb-minus-70">
    <div class="container">
        <form action="{{ route('rooms') }}" method="GET" class="check-form">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="check-content">
                        <p>Arrival Date</p>
                        <div class="form-group">
                            <input type="date" name="checkin_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="check-content">
                        <p>Departure Date</p>
                        <div class="form-group">
                            <input type="date" name="checkout_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="check-btn check-content mb-0">
                        <button class="default-btn" type="submit">
                            Check Availability
                            <i class="flaticon-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
