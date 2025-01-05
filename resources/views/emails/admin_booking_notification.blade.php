<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>New Booking Notification</title>
</head>
<body>
    <div class="container-fluid" style="
    background-image: url('{{ asset('mail/mail_bg.jpg') }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;">
        <p>Dear Admin,</p>

        <p>A new booking has been made by <strong>{{ $booking->user->name }}</strong>.</p>

        <p><strong>Booking Details:</strong></p>
        <ul>
            <li>User Name: {{ $booking->user->name }}</li>
            <li>User Email: {{ $booking->user->email }}</li>
            <li>Room: {{ $booking->room->title }}</li>
            <li>Check-in Date: {{ $booking->checkin_date }}</li>
            <li>Check-out Date: {{ $booking->checkout_date }}</li>
            <li>Total Adults: {{ $booking->total_adults }}</li>
            <li>Total Children: {{ $booking->total_children }}</li>
        </ul>

        <p>Please take necessary actions.</p>

        <p>Best regards,</p>
        <p>Your System</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
