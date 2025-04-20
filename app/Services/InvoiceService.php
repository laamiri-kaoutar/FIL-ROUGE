<?php

namespace App\Services;

use App\Models\Order;
use Spatie\Browsershot\Browsershot;

class InvoiceService
{
    public function generateInvoice(Order $order)
    {
        $data = [
            'order' => $order,
            'date' => now()->format('F d, Y'),
        ];

        // Render the HTML content from the view
        $html = view('client.invoice-pdf', $data)->render();

        // Generate PDF using Browsershot
        $pdf = Browsershot::html($html)
            ->setOption('landscape', false)
            ->setOption('margin', ['top' => '20mm', 'right' => '20mm', 'bottom' => '20mm', 'left' => '20mm'])
            ->pdf();

        // Return the PDF as a downloadable response
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="invoice-order-' . $order->id . '.pdf"');
    }
}