<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teni;
use App\Models\Inventario;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    public function add(Request $request, $id)
    {
        $teni = Teni::with('modelo')->find($id);
        if (!$teni) {
            return redirect()->route('catalogo')->with('error', 'Producto no encontrado');
        }

        $carrito = session()->get('carrito', []);

        $cantidadSolicitada = isset($carrito[$id]) ? $carrito[$id]['cantidad'] + 1 : 1;

        if ($teni->cantidad < $cantidadSolicitada) {
            return redirect()->route('catalogo')->with('error', 'Cantidad solicitada no disponible en inventario');
        }

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

    public function procesarCompra(Request $request)
    {
        try {
            $carrito = session()->get('carrito', []);

            foreach ($carrito as $id => $detalle) {
                $teni = Teni::find($detalle['id']);
                if ($teni) {
                    // Descontar la cantidad del inventario del tenis
                    $teni->cantidad -= $detalle['cantidad'];
                    $teni->save();

                    // Descontar la cantidad del inventario general
                    /*$inventario = Inventario::where('id_ten', $detalle['id'])->first();
                    if ($inventario) {
                        $inventario->exist_inv -= $detalle['cantidad'];
                        $inventario->save();
                    }*/
                }
            }

            // Vaciar el carrito
            session()->forget('carrito');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Registrar el error para depuración
            Log::error('Error en procesarCompra: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
