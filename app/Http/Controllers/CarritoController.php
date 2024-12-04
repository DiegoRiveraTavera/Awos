<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teni;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf; // Importa la clase Dompdf

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

            if (empty($carrito)) {
                return redirect()->route('carrito.view')->with('error', 'El carrito está vacío.');
            }

            foreach ($carrito as $id => $detalle) {
                $teni = Teni::find($detalle['id']);
                if ($teni) {
                    $teni->cantidad -= $detalle['cantidad'];
                    $teni->save();
                }
            }

            // Redirigir a la pregunta de la factura
            return redirect()->route('carrito.facturaPregunta');
        } catch (\Exception $e) {
            Log::error('Error en procesarCompra: ' . $e->getMessage());
            return redirect()->route('carrito.view')->with('error', 'Ocurrió un error al procesar la compra.');
        }
    }

    public function facturaPregunta()
    {
        return view('carrito.factura_pregunta');
    }

    public function mostrarFormularioFactura()
    {
        return view('carrito.factura');
    }

    public function generarFactura(Request $request)
    {
        try {
            // Validar los datos enviados desde el formulario
            $validated = $request->validate([
                'nombre_completo' => 'required|string|max:255',
                'telefono' => 'required|string|max:15',
                'rfc' => 'required|string|max:13',
                'correo' => 'required|email|max:255',
                'domicilio' => 'required|string|max:500',
            ]);

            // Obtener los datos del carrito
            $carrito = session()->get('carrito', []);
            if (empty($carrito)) {
                return redirect()->back()->with('error', 'El carrito está vacío.');
            }

            // Calcular totales
            $total = array_reduce($carrito, function ($carry, $item) {
                return $carry + ($item['precio'] * $item['cantidad']);
            }, 0);

            $subtotal = $total * 0.84;
            $iva = $total * 0.16;
            $totalConIva = $total;

            // Usar los datos enviados desde el formulario
            $datosFactura = [
                'nombre_completo' => $validated['nombre_completo'],
                'telefono' => $validated['telefono'],
                'rfc' => $validated['rfc'],
                'correo' => $validated['correo'],
                'domicilio' => $validated['domicilio']
            ];

            // Renderizar la vista para el PDF
            $vistaPDF = view('carrito.factura_pdf', compact('carrito', 'total','subtotal', 'iva', 'totalConIva', 'datosFactura'))->render();

            // Generar el PDF con Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($vistaPDF);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Vaciar el carrito después de generar la factura
            session()->forget('carrito');

            // Descargar el PDF generado
            return response()->streamDownload(
                fn () => print($dompdf->output()),
                'factura.pdf',
                ['Content-Type' => 'application/pdf']
            );
        } catch (\Exception $e) {
            Log::error('Error en generarFactura: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al generar la factura.');
        }
    }
}
