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
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes cuenta?</h3>
                    <p>Inicia sesion para entrar en la pagina</p>
                    <button id="btn__login">Iniciar Sesion</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿No tienes cuenta?</h3>
                    <p>Registrate para entrar en la pagina</p>
                    <button type="button" id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!-- Formulario de Login y Registro -->
            <div class="contenedor__login-register">


                <!--Login-->
                <form id="form-log" class="formulario__login">
                    @csrf
                    <h2>Iniciar Sesion</h2>
                    <div>
                        <input type="email" placeholder="Correo Electronico" name="email">
                        <span class="badge text-danger errors-emaill"></span>
                    </div>

                    <div>
                        <input type="password" placeholder="Contraseña" name="password">
                        <span class="badge text-danger errors-passwordl"></span>
                    </div>

                    <a href="{{ route('password.request') }}">
                        <p class="blue">Olvidaste tu contraseña?</p>
                    </a>
                    <button type="submit" id="btn-login">Entrar</button>
                </form>


                <!--Registro-->
                <form id="form-reg" class="formulario__register">
                    @csrf
                    <h2>Registrarse</h2>
                    <div>
                        <input type="text" placeholder="Nombre" name="name" id="name">
                        <span class="badge text-danger errors-nombre"></span>
                    </div>

                    <div>
                        <input type="text" placeholder="Correo Electronico" name="email" id="email">
                        <span class="badge text-danger errors-email"></span>
                    </div>

                    <div>
                        <input type="password" placeholder="Contraseña" name="password" id="password">
                        <span class="badge text-danger errors-password"></span>
                    </div>

                    <div>
                        <input type="password" placeholder="Confirmar Contraseña" name="password_confirmation" id="password_confirmation">
                        <span class="badge text-danger errors-password_confirmation"></span>
                    </div>

                    <button type="submit" id="btn-enviar">Registrarse</button>
                </form>

            </div>

        </div>

    </main>
    @vite('resources/js/loginScript.js')
    @vite('resources/js/loaderScript.js')
    @vite('resources/js/validatorLogin.js')
</body>

</html>