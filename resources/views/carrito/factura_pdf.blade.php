<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Factura</h1>
    </div>

    <div class="content">
        <p><strong>Nombre Completo:</strong> {{ $datosFactura['nombre_completo'] }}</p>
        <p><strong>Teléfono:</strong> {{ $datosFactura['telefono'] }}</p>
        <p><strong>RFC:</strong> {{ $datosFactura['rfc'] }}</p>
        <p><strong>Correo:</strong> {{ $datosFactura['correo'] }}</p>
        <p><strong>Domicilio:</strong> {{ $datosFactura['domicilio'] }}</p>
    </div>

    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Categoría</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $detalle)
                <tr>
                    <td>{{ $detalle['modelo'] }}</td>
                    <td>{{ $detalle['categoria'] }}</td>
                    <td>{{ $detalle['talla'] }}</td>
                    <td>{{ $detalle['color'] }}</td>
                    <td>${{ number_format($detalle['precio'], 2) }} MXN</td>
                    <td>{{ $detalle['cantidad'] }}</td>
                    <td>${{ number_format($detalle['precio'] * $detalle['cantidad'], 2) }} MXN</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total sin IVA:</strong> ${{ number_format($subtotal, 2) }} MXN</p>
        <p><strong>IVA (16%):</strong> ${{ number_format($iva, 2) }} MXN</p>
        <p><strong>Total con IVA:</strong> ${{ number_format($totalConIva, 2) }} MXN</p>
    </div>
</div>
</body>
</html>

