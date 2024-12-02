<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=AcdwbqMmmL3MIP6qF8kEIH2Ct9FDpt0VO9hJhULcEBWjUmfS4APVUolFxoP5Bv1-0Z3hHUCJFZARbl8u&currency=MXN"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('catalogo') }}">
                        <img src="imagenes/logofinal.JPG" style="width: 55px; height: 55px; border-radius: 50%">
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="cursor: pointer;">Salir</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1 class="text-center mb-4">Carrito de Compras</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @php $total = 0; @endphp <!-- Definición inicial de $total -->
    @if($carrito)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><center>Modelo</center></th>
                    <th><center>Categoría</center></th>
                    <th><center>Talla</center></th>
                    <th><center>Color</center></th>
                    <th><center>Precio Unitario</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Acciones</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $details)
                    @php $total += $details['precio'] * $details['cantidad']; @endphp
                    <tr>
                        <td><center>{{ $details['modelo'] }}</center></td>
                        <td><center>{{ $details['categoria'] }}</center></td>
                        <td><center>{{ $details['talla'] }}</center></td>
                        <td><center>{{ $details['color'] }}</center></td>
                        <td><center>{{ $details['precio'] }}</center></td>
                        <td><center>{{ $details['cantidad'] }}</center></td>
                        <td>
                            <form action="{{ route('carrito.remove', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                <center><button type="submit" class="btn btn-danger btn-sm">Eliminar</button></center>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <h4>Total a Pagar: ${{ number_format($total, 2) }} MXN</h4>
        </div>
        <div class="d-flex justify-content-end">
            <div id="paypal-button-container"></div>
        </div>
    @else
        <p class="text-center">Tu carrito está vacío.</p>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $total }}',
                        currency_code: 'MXN'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Llamada AJAX a tu servidor para procesar el pedido
                fetch('{{ route("carrito.procesarCompra") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        detalles: details
                    })
                }).then(function(response) {
                    if (response.ok) {
                        // Redirigir al usuario a una página de confirmación o vaciar el carrito
                        window.location.href = "{{ route('catalogo') }}";
                    } else {
                        return response.json().then(err => { alert('Error: ' + err.message); });
                    }
                }).catch(function(error) {
                    console.error('Error:', error);
                    alert('Ocurrió un error con la transacción');
                });
            });
        },
        onError: function(err) {
            console.error('Error con PayPal:', err);
            alert('Ocurrió un error con la transacción');
        }
    }).render('#paypal-button-container');
</script>
</body>
</html>
