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
                        <img src="{{ asset('imagenes/logofinal.JPG') }}" style="width: 55px; height: 55px; border-radius: 50%">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lista_deseos.index') }}">Ver Lista de Deseos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1 class="text-center mb-4">Bienvenido al Catálogo</h1>

    <!-- Filtro por Categorías y Sucursales -->
    <div class="mb-4">
        <form action="{{ route('catalogo') }}" method="GET">
            <div class="form-group">
                <label for="categoria">Filtrar por Categoría:</label>
                <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas las Categorías</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->nom_categ }}" {{ $selectedCategory == $categoria->nom_categ ? 'selected' : '' }}>
                            {{ $categoria->nom_categ }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="sucursal">Filtrar por Sucursal:</label>
                <select name="sucursal" id="sucursal" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas las Sucursales</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->cve_suc }}" {{ $selectedSucursal == $sucursal->cve_suc ? 'selected' : '' }}>
                            {{ $sucursal->nom_suc }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach ($tenis as $teni)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($teni->img_ten) }}" class="card-img-top" alt="Imagen de {{ $teni->categ_ten }}">
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
                        @if(auth()->user()->listaDeseos->contains($teni->id_ten))
                            <form action="{{ route('lista_deseos.remove', $teni->id_ten) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar de la lista de deseos</button>
                            </form>
                        @else
                            <form action="{{ route('lista_deseos.add', $teni->id_ten) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Añadir a la lista de deseos</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
