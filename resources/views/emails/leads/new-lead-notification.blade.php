<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New lead notification</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.5;">
<h1 style="font-size: 22px; margin-bottom: 16px;">
    New website lead
</h1>

<h2 style="font-size: 18px; margin-top: 24px;">
    Customer information
</h2>

<table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tr>
        <td><strong>Type</strong></td>
        <td>{{ $lead->type }}</td>
    </tr>
    <tr>
        <td><strong>Status</strong></td>
        <td>{{ $lead->status }}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>{{ $lead->name }}</td>
    </tr>
    <tr>
        <td><strong>Phone</strong></td>
        <td>
            <a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a>
        </td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>
            @if($lead->email)
                <a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a>
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>Preferred contact</strong></td>
        <td>{{ $lead->preferred_contact_method ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Subject</strong></td>
        <td>{{ $lead->subject ?? '-' }}</td>
    </tr>
</table>

@if($lead->message)
    <h2 style="font-size: 18px; margin-top: 24px;">
        Message
    </h2>

    <p style="white-space: pre-line;">
        {{ $lead->message }}
    </p>
@endif

@if($lead->items->isNotEmpty())
    <h2 style="font-size: 18px; margin-top: 24px;">
        Requested equipment
    </h2>

    <table cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; border-color: #e5e7eb;">
        <thead>
        <tr>
            <th align="left">Product</th>
            <th align="left">Quantity</th>
            <th align="left">Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lead->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>
                    @if($item->price)
                        ${{ number_format((float) $item->price, 2) }}
                    @else
                        On request
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<h2 style="font-size: 18px; margin-top: 24px;">
    Source
</h2>

<table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tr>
        <td><strong>Source</strong></td>
        <td>{{ $lead->source }}</td>
    </tr>
    <tr>
        <td><strong>Source page</strong></td>
        <td>{{ $lead->source_page ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>UTM source</strong></td>
        <td>{{ $lead->utm_source ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>UTM medium</strong></td>
        <td>{{ $lead->utm_medium ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>UTM campaign</strong></td>
        <td>{{ $lead->utm_campaign ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>IP address</strong></td>
        <td>{{ $lead->ip_address ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Created at</strong></td>
        <td>{{ $lead->created_at?->format('Y-m-d H:i:s') }}</td>
    </tr>
</table>
</body>
</html>
