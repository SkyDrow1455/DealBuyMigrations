<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Inicio de Sesion</title>
    @vite('resources/css/loginStyle.css')
    @vite('resources/css/preloaderStyle.css')
</head>
<body>
        <!-- Loader -->
  <div class="preloader">
    <div class="spiner">
        <div class="spiner">
            <div class="spiner">
                <div class="spiner"> </div>
            </div>
        </div>
    </div>
</div>


    <main>
        <div class="back-butom">
            <a href="{{ route('home') }}" class="btn-inicio">
                <img src="/assets/img/loginAssets/back.png" alt="Inicio" class="img-boton">
                <p>Inicio</p>
            </a>
        </div>
       
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <style>
                    .contenedor__todo {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 10%;
                    }
                </style>
            </div>

            <!-- Formulario de Login y Registro -->
            <div class="contenedor__login-register">


                <!--Login-->
                <form action="{{ route('login') }}" method="POST" class="formulario__login">
                    @csrf
                    <h2>Sesión administrador</h2>
                    <input  type="text" placeholder="Correo Electronico" name="email">
                    <input type="password" placeholder="Contraseña" name="password">
                    <button type="submit">Entrar</button>
                </form>

            </div>

        </div>

    </main>
    @vite('resources/js/loginScript.js')
    @vite('resources/js/loaderScript.js')
</body>
</html>