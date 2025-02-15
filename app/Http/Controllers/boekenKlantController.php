<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\boekenKlant as boekenKlantModel;

class boekenKlantController extends Controller
{
    public function index()
    {
        $boekenKlant = boekenKlantModel::all();
        dd($boekenKlant);
        $boekenKlant = boekenKlantModel::all();
        return view('klantBoeken.index', ['klantBoeken' => $boekenKlant]);
    }
}
