<!DOCTYPE html>
<html>
<head>
    <title>New Booking Notification</title>
</head>
<body>
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
</body>
</html>
