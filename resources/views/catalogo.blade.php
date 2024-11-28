<!-- resources/views/catalogo.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Tenis</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('carrito.view') }}">Ver Carrito</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1 class="text-center mb-4">Bienvenido al Catálogo</h1>
    <div class="row">
        @foreach ($tenis as $teni)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="imagenes/{{ $teni->img_ten }}" class="card-img-top" alt="Imagen de {{ $teni->categ_ten }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $teni->categ_ten }}</h5>
                        <p class="card-text">
                            <strong>Modelo:</strong> {{ $teni->modelo ? $teni->modelo->nom_model : 'N/A' }}<br>
                            <strong>Talla:</strong> {{ $teni->num_talla }}<br>
                            <strong>Color:</strong> {{ $teni->color_ten }}<br>
                            <strong>Precio:</strong> ${{ $teni->prec_ten }}
                        </p>
                        <a href="{{ route('tenis.show', $teni->id_ten) }}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{ route('carrito.add', $teni->id_ten) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
