<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    @vite('resources/css/loginStyle.css')
</head>
<body>
    <main>
        <div class="back-butom">
            <a href="{{ route('home') }}" class="btn-inicio">
                <img src="/assets/img/loginAssets/back.png" alt="Inicio" class="img-boton">
                <p>Inicio</p>
            </a>
        </div>
        
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes cuenta?</h3>
                    <p>Inicia sesion para entrar en la pagina</p>
                    <button id="btn__login">Iniciar Sesion</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿No tienes cuenta?</h3>
                    <p>Registrate para entrar en la pagina</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>
            <!-- Formulario de Login y Registro -->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="" class="formulario__login">
                    <h2>Iniciar Sesion</h2>
                    <input  type="text" placeholder="Correo Electronico" name="email">
                    <input type="password" placeholder="Contraseña" name="password">
                    <a href="">
                        <p class="blue">Olvidaste tu contraseña?</p>
                    </a>
                    <button>Entrar</button>
                </form>
                <!--Registro-->
                <form action="" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre" name="name">
                    <input type="text" placeholder="Correo Electronico" name="email">
                    <input type="text" placeholder="Usuario" name="username">
                    <input type="text" placeholder="Contraseña" name="password">
                    <button>Registrarse</button>
                </form>

            </div>

        </div>

    </main>
    @vite('resources/js/loginScript.js')
</body>
</html>