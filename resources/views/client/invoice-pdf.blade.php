<!DOCTYPE html>
<html>
<head>
    <title>Invoice - Order #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #4B0082;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #4B0082;
        }
        .details {
            margin-bottom: 30px;
        }
        .details p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
            color: #4B0082;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>FreelanceHub Invoice</h1>
            <p>Order #{{ $order->id }} | Issued on {{ $date }}</p>
        </div>

        <!-- Order Details -->
        <div class="details">
            <p><strong>Customer:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
        </div>

        <!-- Order Summary Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Service</td>
                    <td>{{ $order->service->title }}</td>
                </tr>
                <tr>
                    <td>Package</td>
                    <td>{{ $order->package->name }}</td>
                </tr>
                <tr>
                    <td>Freelancer</td>
                    <td>{{ $order->service->user->name }}</td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>${{ number_format($order->amount, 2) }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td>{{ $order->created_at->format('F d, Y') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing FreelanceHub!</p>
            <p>Contact us at support@freelancehub.com</p>
        </div>
    </div>
</body>
</html>