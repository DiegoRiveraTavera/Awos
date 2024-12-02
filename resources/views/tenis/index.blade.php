<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Lista de Productos</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('indexAdmin') }}">
      <img src="imagenes/logofinal.JPG" alt="Logo" style="width: 55px; height: 55px; border-radius: 50%;">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
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

<div class="container my-5">
  <center><h1>Productos</h1></center>

  <h2 class="text-center my-4">Lista de Tenis</h2>
  <div class="text-end mb-3">
    <a href="{{ route('tenis.create') }}" class="btn btn-primary">Crear Nuevo Tenis</a>
  </div>

  @if($tenis->isEmpty())
      <p class="text-center">No hay tenis disponibles.</p>
  @else
      <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Talla</th>
                <th>Categoría</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Sucursal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenis as $teni)
            <tr>
                <td>{{ $teni->id_ten }}</td>
                <td>{{ $teni->id_model }}</td>
                <td>{{ $teni->num_talla }}</td>
                <td>{{ $teni->categ_ten }}</td>
                <td>{{ $teni->color_ten }}</td>
                <td>{{ $teni->prec_ten }}</td>
                <td>{{ $teni->costo_ten }}</td>
                <td><img src="{{ $teni->img_ten }}" alt="Imagen de Tenis" style="width: 50px; height: 50px;"></td>
                <td>{{ $teni->cantidad }}</td>
                <td>{{ optional($teni->inventario)->sucursal->nom_suc ?? 'Sin Sucursal' }}</td>
                <td>
                    <!--<a href="{{ route('tenis.show', $teni->id_ten) }}" class="btn btn-info btn-sm">Ver</a>-->
                    <a href="{{ route('tenis.edit', $teni->id_ten) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('tenis.destroy', $teni->id_ten) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
  @endif

</div>
</body>
</html>
