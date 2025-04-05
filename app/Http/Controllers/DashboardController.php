<?php

namespace App\Http\Controllers;

use App\Models\Bautizo;
use App\Models\Comunion;
use App\Models\Confirmacion;
use App\Models\Casamiento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBautizos = Bautizo::count();
        $totalComuniones = Comunion::count();
        $totalConfirmaciones = Confirmacion::count();
        $totalCasamientos = Casamiento::count();

        return view('dashboard', compact('totalBautizos', 'totalComuniones', 'totalConfirmaciones', 'totalCasamientos'));
    }
}
