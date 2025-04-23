<!DOCTYPE html>
<html>
<head>
    <title>Orders Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-pending {
            color: #d97706;
            font-weight: bold;
        }
        .status-in-progress {
            color: #2563eb;
            font-weight: bold;
        }
        .status-completed {
            color: #16a34a;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Orders Report</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Client</th>
                <th>Freelancer</th>
                <th>Service</th>
                <th>Package</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->freelancer->name ?? 'N/A' }}</td>
                    <td>{{ $order->service->title ?? 'N/A' }}</td>
                    <td>{{ $order->package->name ?? 'N/A' }}</td>
                    <td>${{ number_format($order->amount, 2) }}</td>
                    <td class="status-{{ str_replace('_', '-', $order->status) }}">{{ ucwords(str_replace('_', ' ', $order->status)) }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>