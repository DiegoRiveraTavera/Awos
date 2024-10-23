<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class="bg-primary d-flex justify-content-center align-items-center vh-100">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
            <div class="bg-light p-4 rounded-3 shadow text-center" style="width: 300px;">
            <img src="imagenes/logofinal.JPG" alt="Logo RTenis" class="img-fluid mb-3" style="width: 100px;">
                <form action="{{route('registrarse')}}" method="POST">
                    @csrf
            
                <h2>Registrate</h2>
                <br>
                    <div class="form-group">
                    <input type="text" id="usuario" name="usuario" class="form-control" maxlength="30" placeholder="Escribe un usuario"/>
                    <br>

                    <input type="email" id="email" name="email" class="form-control" maxlength="30"placeholder="Escribe un correo" required/>
                    <br>

                    <input type="password"  id="contraseña" name="contraseña" class="form-control"maxlength="10" placeholder="Escribe una contraseña" required/>
                    <br>

                    <button type="submit" class="btn btn-primary" name="login">Registrar</button>
                    </div>

                    <a href="{{route('login')}}">Iniciar Sesión</a>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>