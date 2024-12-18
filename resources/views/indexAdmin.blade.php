<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    <title>Panel de Administración</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ route('indexAdmin') }}">
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
          <a class="nav-link" href="{{ route('tenis.index') }}"><h4>Gestionar Productos</h4></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('sucursales.index') }}"><h4>Gestionar Sucursales</h4></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('categorias.index') }}"><h4>Gestionar Categorias</h4></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}"><h4>Gestionar Admins</h4></a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
<center>
<h1>Eres Admin</h1>
</center>
</body>
</html>

