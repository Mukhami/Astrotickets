<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Purchased Ticket</title>
</head>
<body>
<div class="container-fluid">
Dear {!! $order->user->name !!},
<p><b><u>EVENT INFORMATION</u></b></p>
<b><b></b>NAME: {!! $order->event->name !!}</b></p>
<b><b></b>VENUE: {!! $order->event->location !!}</b></p>
<b><b></b>FROM: {!! \Carbon\Carbon::parse($order->event->start_date)->format('d M Y') !!}, {!! $order->event->start_time !!}</b></p>
<p><b>TILL: {!! \Carbon\Carbon::parse($order->event->end_date)->format('d M Y') !!}, {!! $order->event->end_time !!}</b></p>

<p><b>Options on what to do with the ticket(s) attached below:</p>

<p>1. Present this ticket on your phone for validation of the QR Code (Tip: take a screenshot)</p>
<p>2. Print this ticket and bring it with you (tip: not so good for the environment)</p>
<p>3. DO NOT SHARE THE QR CODE</p>

    Here are your tickets</b>><br>

<p><b><u>TICKET INFORMATION</u></b></p>
<p><b>NUMBER OF TICKETS PURCHASED: {!! $order->quantity !!}</b></p>
<p><b>AMOUNT PAID: {!! $order->charges !!}</b></p>

<hr>
<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(255,0,127)->size(200)->generate($order->ticket_id)) !!} ">
<hr>
    <p>Thank you and have a lovely day.</p>
    <p>ASTROTICKETS!</p>

</div>
</body>
</html>



