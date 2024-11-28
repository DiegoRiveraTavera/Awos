<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    <title>Lista de Categorias</title>
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
  <center><h1>Categorias</h1></center>

  <h2 class="text-center my-4">Lista de Categorias</h2>
  <div class="text-end mb-3">
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Crear Nueva Categoria</a>
  </div>

  @if($categorias->isEmpty())
      <p class="text-center">No hay categorias disponibles.</p>
  @else
      <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id_categ }}</td>
                <td>{{ $categoria->nom_categ }}</td>
                
                <td>
                    <!--<a href="{{ route('categorias.show', $categoria->id_categ) }}" class="btn btn-info btn-sm">Ver</a>-->
                    <a href="{{ route('categorias.edit', $categoria->id_categ) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria->id_categ) }}" method="POST" style="display:inline;">
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
