<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <p>Dear {{ $booking->user->name }},</p>

    <p>We are pleased to confirm your booking for the room <strong>{{ $booking->room->title }}</strong> from <strong>{{ $booking->checkin_date }}</strong> to <strong>{{ $booking->checkout_date }}</strong>.</p>

    <p><strong>Booking Details:</strong></p>
    <ul>
        <li>Room: {{ $booking->room->title }}</li>
        <li>Check-in Date: {{ $booking->checkin_date }}</li>
        <li>Check-out Date: {{ $booking->checkout_date }}</li>
        <li>Total Adults: {{ $booking->total_adults }}</li>
        <li>Total Children: {{ $booking->total_children }}</li>
    </ul>

    <p>Thank you for booking with us! We look forward to your stay.</p>

    <p>Best regards,</p>
    <p>Royal Palace</p>
</body>
</html>
