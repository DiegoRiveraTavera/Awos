<?php
// app/Http/Controllers/ListaDeseosController.php

namespace App\Http\Controllers;

use App\Models\Teni;
use Illuminate\Http\Request;

class ListaDeseosController extends Controller
{
    public function add(Request $request, $teni_id)
    {
        $user = auth()->user();
        $user->listaDeseos()->attach($teni_id);

        return redirect()->back()->with('success', 'Tenis añadido a la lista de deseos.');
    }

    public function remove(Request $request, $teni_id)
    {
        $user = auth()->user();
        $user->listaDeseos()->detach($teni_id);

        return redirect()->back()->with('success', 'Tenis eliminado de la lista de deseos.');
    }

    public function index()
    {
        $user = auth()->user();
        $listaDeseos = $user->listaDeseos;

        return view('lista_deseos.index', compact('listaDeseos'));
    }
}
