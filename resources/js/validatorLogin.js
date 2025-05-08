//Verificacion de campos Login
const btnLog = document.querySelector("#btn-login");
const formLog = document.querySelector("#form-log");

btnLog.addEventListener("click", (e) => {
    e.preventDefault();

    const datos = new FormData(formLog);

    fetch("login-reg", {
        method: "post",
        body: datos,
    })
        .then((response) => response.json())
        .then((result) => {
            console.log(result);

            // Mostrar errores si los hay
            if (result.alerta === "danger") {
                document.querySelector(".errors-emaill").textContent =
                    result.email ? result.email[0] : "";
                document.querySelector(".errors-passwordl").textContent =
                    result.password ? result.password[0] : "";

                document.querySelectorAll(".badge").forEach((span) => {
                    span.style.display = "block";
                    span.style.textAlign = "left";
                });

                setTimeout(() => {
                    document.querySelectorAll(".badge").forEach((span) => {
                        span.style.display = "none";
                    });
                }, 3000);
            }

            // Si todo salió bien, redirigir
            if (result.alerta === "success") {
                window.location.href = result.redirect;
            }
        })
        .catch((error) => {
            console.error("Error en la petición:", error);
        });
});
