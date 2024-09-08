<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Payment Confirmation</h1>
    <p>Hello {{ $booking->user->name }},</p>
    <p>We are pleased to inform you that your payment of ${{ $booking->total_amount }} has been successfully processed.</p>
    <p>Your booking details are as follows:</p>
    <ul>
        <li><strong>Room ID:</strong> {{ $booking->room_id }}</li>
        <li><strong>Check-in Date:</strong> {{ $booking->checkin_date }}</li>
        <li><strong>Check-out Date:</strong> {{ $booking->checkout_date }}</li>
        <li><strong>Total Payment Amount:</strong> ${{ $booking->total_amount }}</li>
        <li><strong>Total Adults:</strong> {{ $booking->total_adults }}</li>
        <li><strong>Total Children:</strong> {{ $booking->total_children }}</li>
    </ul>
    <p>Thank you for your payment and for choosing our services. We look forward to serving you during your stay.</p>
    <p>Best regards,<br>Your Company Name</p>
</body>
</html>
