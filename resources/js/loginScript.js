document.getElementById("btn__registrarse").addEventListener("click", register);
document.getElementById("btn__login").addEventListener("click", login);
window.addEventListener("resize", anchoPagina);

//Variables
var contenedor_login_register = document.querySelector(
    ".contenedor__login-register"
);
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

function anchoPagina() {
    if (window.innerWidth > 850) {
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
    }
}

anchoPagina();

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

function login() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}
//Verificacion de campos Registro
const btn = document.querySelector("#btn-enviar");
const formulario = document.querySelector("#form-reg");

btn.addEventListener("click", (e) => {
    e.preventDefault();

    const datos = new FormData(formulario);

    fetch('crearUsuario', {
        method: 'post',
        body: datos
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);

        // Mostrar errores si los hay
        if (result.alerta === "danger") {
            document.querySelector(".errors-nombre").textContent = result.name ? result.name[0] : "";
            document.querySelector(".errors-email").textContent = result.email ? result.email[0] : "";
            document.querySelector(".errors-password").textContent = result.password ? result.password[0] : "";
            document.querySelector(".errors-password_confirmation").textContent = result.password_confirmation ? result.password_confirmation[0] : "";

            document.querySelectorAll(".badge").forEach(span => {
                span.style.display = "block";
                span.style.textAlign = "left";
            });

            setTimeout(() => {
                document.querySelectorAll(".badge").forEach(span => {
                    span.style.display = "none";
                });
            }, 3000);
        }

        // Si todo salió bien, redirigir
        if (result.alerta === "success") {
            window.location.href = result.redirect;
        }
    })
    .catch(error => {
        console.error('Error en la petición:', error);
    });
});

