<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <title>Document</title>
</head>
<body class="bg-primary d-flex justify-content-center align-items-center vh-100">
<br><br>
    <div class="container">
        <div class="row justify-content-center">
        

            <div class="col-md-4">
            <div class="bg-light p-4 rounded-3 shadow text-center" style="width: 300px;">
            <img src="imagenes/logofinal.JPG" alt="Logo RTenis" class="img-fluid mb-3" style="width: 100px;">
            <form action="{{ route('login') }}" method="POST">
            @csrf
                  
                <h2>Iniciar Sesión</h2>
                <div class="form-group">

                <input type="text" class="form-control" id="usuario" name="usuario" maxlength="30" placeholder="Escribe tu usuario" required/> 
                <br>

                <input type="password" class="form-control" id="contraseña" name="contraseña" maxlength="10"placeholder="Escribe tu contraseña" required/>
                <br>

                <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                <br>

                <p>¿No tienes una cuenta?</p><a href="{{route('registrarse')}}">Registrate Aquí</a>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>