<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function generateInvoicePdf($id)
    {
        $invoice = Invoice::with('booking.customer')->findOrFail($id);
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('factuur_' . $invoice->invoice_number . '.pdf');
    }
}
