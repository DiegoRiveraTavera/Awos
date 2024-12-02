<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                @php $total = 0; @endphp
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
            <h4>Total a Pagar: ${{ number_format($total, 2) }}</h4>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Pagar</button>
        </div>
        
    @else
        <p class="text-center">Tu carrito está vacío.</p>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
