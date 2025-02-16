<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunicationController extends Controller
{
    public function index()
{
    // Haal de berichten op via de stored procedure
    $messages = DB::select('CALL spGetAllMessages()');

    // Retourneer de view met de berichten
    return view('communications.index', ['messages' => $messages]);
}
}