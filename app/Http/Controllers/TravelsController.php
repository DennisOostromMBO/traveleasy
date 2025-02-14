<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;

class TravelsController extends Controller
{
    public function index()
    {
        $travels = DB::select('CALL spGetAllTravels()');
        return view('travels.index', ['travels' => $travels]);
    }
}