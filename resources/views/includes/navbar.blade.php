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
        <a href="{{ route('home') }}" class="navbar-brand" id="logo">
            <img src="{{ asset('assets/logo.png') }}" width="70px" />
        </a>
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
                        <a class="dropdown-item" href="{{ route('offers.index') }}">Mis ofertas</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('offers.create') }}">Añadir ofertas</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a class="navbar-brand" href="{{ route('login-reg') }}">
                <img src="{{ asset('assets/acceso.png') }}" width="50px" />
            </a>
            @endif

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Inicio</a>
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