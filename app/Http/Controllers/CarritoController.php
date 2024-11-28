<?php
// app/Http/Controllers/CarritoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teni;

class CarritoController extends Controller
{
    public function add(Request $request, $id)
    {
        $teni = Teni::with('modelo')->find($id);
        if (!$teni) {
            return redirect()->route('catalogo')->with('error', 'Producto no encontrado');
        }

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "id" => $teni->id_ten,
                "modelo" => $teni->modelo->nom_model,
                "categoria" => $teni->categ_ten,
                "talla" => $teni->num_talla,
                "color" => $teni->color_ten,
                "precio" => $teni->prec_ten,
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->route('catalogo')->with('success', 'Producto agregado al carrito');
    }

    public function view()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function remove(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito.view')->with('success', 'Producto eliminado del carrito');
    }
}
