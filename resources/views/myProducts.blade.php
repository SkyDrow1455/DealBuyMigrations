@extends('layouts.app')
@section('content')

<header class="custom-header py-5">
    <div id="model_container"></div>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-black">
            <h1 class="display-4 fw-bolder text-title-custom fuente-titulo">Tus Productos</h1>
            <p class="lead fw-normal text-custom mb-0">
                Estos son todos tus productos publicados en DealBuy.
            </p>
        </div>
    </div>
</header>

<div class="container">
    @if($products->isEmpty())
    <p class="lead fw-normal text-custom mb-0 text-center">No has publicado productos aún</p>

    @else
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($products as $product)
        <div class="col mb-5">
            <div class="card h-100">
                <!-- Product image -->
                @if($product->product_image && $product->product_image->isNotEmpty())
                <img class="card-img-top" src="{{ Storage::url($product->product_image->first()->image_url) }}" alt="Imagen del producto" style="max-height: 200px; object-fit: contain;">
                @else
                <img class="card-img-top" src="https://via.placeholder.com/300x200?text=Sin+imagen" alt="Sin imagen">
                @endif

                <!-- Product details -->
                <div class="card-body p-4">
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                        Mi Producto
                    </div>
                    <div class="text-center">
                        <h5 class="fw-bolder">{{ $product->name }}</h5>
                        <p>{{ $product->description }}</p>
                        <p class="fw-bold">${{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Product actions -->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="d-flex justify-content-center gap-2">
                        <!-- Botón Editar -->
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>

                        <!-- Formulario Eliminar -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    @endif
    <div class="text-center mt-4">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Publicar un producto</a>
    </div>
    <br><br>
    
</div>

@endsection