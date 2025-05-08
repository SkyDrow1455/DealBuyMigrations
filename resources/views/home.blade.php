<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Deal buy</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->

  <!--Fuentes Google-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Press+Start+2P&display=swap" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite('resources/css/styles.css')
  @vite('resources/css/chatbotStyle.css')
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
  <!-- Botón flotante para abrir el chatbot -->
  <div id="chatbot-toggle" class="chatbot-toggle">💬</div>

  <!-- Contenedor del chatbot oculto por defecto -->
  <div class="chatbot-container" id="chatbot-container">
    <div class="chat-header">Asistente Virtual</div>
    <div class="chat-messages" id="chat-messages"></div>
    <div class="chat-input-container">
      <input type="text" id="prompt" name="prompt" placeholder="Escribe un mensaje..." autocomplete="off" />
      <button id="send-btn">➤</button>
    </div>
  </div>
  <!-- Navigation-->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="icon-custom">

      <!--Logo-->
      <img src="{{ asset('assets/logo.png') }}" width="70px" />
    </div>
    <div class="container px-4 px-lg-5">



      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        @if (Auth::check())
        <div class="dropdown">
          <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('products.create') }}">Añadir producto</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('myProducts') }}">Mis productos</a>
            </li>
            <li>
<<<<<<< HEAD
              <a class="dropdown-item" href="{{ route('offers.index') }}">Mis ofertas</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('offers.create') }}">Añadir ofertas</a>
            </li>
            <li>
            <form method="POST" action="{{ route('logout') }}">
=======
              @auth
              @if (auth()->user()->hasRole('admin'))
              {{-- Opciones solo para administradores --}}
            <li>
              <a class="dropdown-item" href="{{route('d')}}">Panel Administrativo</a>
            <li>
              @endif
              @endauth
              <form method="POST" action="{{ route('logout') }}">
>>>>>>> 907ed6621f79880d93029905068df9ccfa07b259
                @csrf
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
              </form>
            </li>
          </ul>
        </div>
        @else
        <a class="navbar-brand" href="{{ route('login-reg') }}">
          <img src="./assets/acceso.png" width="50px" />
        </a>
        @endif

        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#!">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#!">Informacion</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              id="navbarDropdown"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">Tienda</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{route('allProducts')}}">Todos los productos</a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#!">Productos Nuevos</a>
              </li>
              <li><a class="dropdown-item" href="#!">Productos Usados</a></li>
            </ul>
          </li>
        </ul>

        <div class="col-md-6">
          <form action="{{ route('products.index') }}" method="GET" class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
            <button class="btn btn-outline-dark" type="submit">
              <i class="bi bi-search"></i> Buscar
            </button>
          </form>
        </div>

        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark d-flex align-items-center">
          <i class="bi-cart-fill me-1"></i>
          Carrito
        </a>
      </div>
    </div>
  </nav>
  <!-- Header-->
  <header class="custom-header py-5">
    <div id="model_container"></div>
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-black">
        <h1 class="display-4 fw-bolder text-title-custom fuente-titulo">DEAL BUY</h1>
        <p class="lead fw-normal text-custom mb-0">
          Donde la innovación se encuentra con las ofertas
        </p>
      </div>
    </div>
  </header>
  <!-- Section-->
  <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Product image-->
            <img
              class="card-img-top"
              src="https://co-media.hptiendaenlinea.com/catalog/product/cache/b3b166914d87ce343d4dc5ec5117b502/6/6/664R5AA-1_T1687387258.png"
              alt="..."
              width="100" />
            <!-- Product details-->
            <div class="card-body p-4">
              <div
                class="badge bg-dark text-white position-absolute"
                style="top: 0.5rem; right: 0.5rem">
                Mas Vendido
              </div>
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">Teclado básico</h5>
                <!-- Product price-->
                $40.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Sale badge-->
            <div
              class="badge bg-dark text-white position-absolute"
              style="top: 0.5rem; right: 0.5rem">
              En venta
            </div>
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/logitech-cam.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">WebCam Logitech</h5>
                <!-- Product reviews-->
                <div
                  class="d-flex justify-content-center small text-warning mb-2">
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                </div>
                <!-- Product price-->
                <span class="text-muted text-decoration-line-through">$150.000</span>
                $120.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Sale badge-->
            <div
              class="badge bg-dark text-white position-absolute"
              style="top: 0.5rem; right: 0.5rem">
              Promocion
            </div>
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/AppleMacMini.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">Apple Mac Mini</h5>
                <!-- Product price-->
                <span class="text-muted text-decoration-line-through">$4.600.000</span>
                $4.000.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/Ryzen7.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">AMD Ryzen 7 7700x</h5>
                <!-- Product reviews-->
                <div
                  class="d-flex justify-content-center small text-warning mb-2">
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                </div>
                <!-- Product price-->
                $750.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Sale badge-->
            <div
              class="badge bg-dark text-white position-absolute"
              style="top: 0.5rem; right: 0.5rem">
              Popular
            </div>
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/MouseLogi.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">Mouse Logitech G305</h5>
                <!-- Product price-->
                <span class="text-muted text-decoration-line-through">$365.000</span>
                $290.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/RTX.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">Zotac RTX 3050</h5>
                <!-- Product price-->
                $890.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Sale badge-->
            <div
              class="badge bg-dark text-white position-absolute"
              style="top: 0.5rem; right: 0.5rem">
              En venta
            </div>
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/AsusTUF.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">Portatil Asus TUF Gaming</h5>
                <!-- Product reviews-->
                <div
                  class="d-flex justify-content-center small text-warning mb-2">
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                </div>
                <!-- Product price-->
                <span class="text-muted text-decoration-line-through">$4.200.000</span>
                $3.800.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-5">
          <div class="card h-100">
            <!-- Product image-->
            <img
              class="card-img-top"
              src="./assets/img/Diadema.png"
              alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">Diadema Logitech</h5>
                <!-- Product reviews-->
                <div
                  class="d-flex justify-content-center small text-warning mb-2">
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                  <div class="bi-star-fill"></div>
                </div>
                <!-- Product price-->
                $280.000
              </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-ligth">
        Copyright &copy;
      </p>
      <p class="m-0 text-center text-white">Camilo Andres Samboni</p>
      <p class="m-0 text-center text-white">Jesus Arbey Andrade</p>
      <p class="m-0 text-center text-white">Diana Lorena Sandoval</p>
      <p class="m-0 text-center text-white">Laura Daniela Belalcazar</p>
      <p class="m-0 text-center text-white">Andres Mauricio Maracaldo</p>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  @vite('resources/js/app.js')
  @vite('resources/js/chatbot.js')
  @vite('resources/js/loaderScript.js')

</body>

</html>