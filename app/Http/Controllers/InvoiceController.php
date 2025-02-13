<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = DB::select('CALL GetInvoices()');
        return view('invoices.overzicht', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = DB::select('CALL GetInvoiceById(?)', [$id]);
        return view('invoices.show', compact('invoice'));
    }

    public function generate($booking_id)
    {
        DB::statement('CALL GenerateInvoice(?)', [$booking_id]);
        return redirect()->route('invoices.index')->with('success', 'Invoice generated successfully.');
    }
}
