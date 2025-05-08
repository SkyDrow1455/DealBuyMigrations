@extends('layouts.app')
@section('content')

<header class="custom-header py-5">
    <div id="model_container"></div>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-black">
            <h1 class="display-4 fw-bolder text-title-custom fuente-titulo">Todos nuestros productos</h1>
            <p class="lead fw-normal text-custom mb-0">
                DealBuy
            </p>
        </div>
    </div>
</header>
<div class="container">
    @if($products->isEmpty())
    <p class="text-center">No hay productos disponibles aún.</p>
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
                        {{ ucfirst($product->condition) }}
                    </div>

                    <div class="text-center">
                        <!-- Product name -->
                        <h5 class="fw-bolder">{{ $product->name }}</h5>
                        <!-- Product price -->
                        ${{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Product actions -->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <!-- Formulario para añadir al carrito -->
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-outline-dark mt-auto">Añadir al carrito</button>
                        </form>
                    </div>
                    <p></p>
                    <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" href="{{ route('offers.index') }}">Ofertar</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>


@endsection