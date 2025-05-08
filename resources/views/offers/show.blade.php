@extends('layouts.app')

@section('content')
<header class="custom-header py-5">
    <div id="model_container"></div>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-black">
            <h1 class="display-4 fw-bolder text-title-custom fuente-titulo">Ofertas</h1>
            <p class="lead fw-normal text-custom mb-0">
                DealBuy
            </p>
        </div>
    </div>
</header>

<div class="container my-5">
<div style="background-color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
    <p><strong>Comprador:</strong> {{ $offer->buyer->name ?? 'N/A' }}</p>
    <p><strong>Producto:</strong> {{ $offer->product->name ?? 'N/A' }}</p>
    <p><strong>Precio original:</strong> ${{ number_format($offer->product->price, 0, ',', '.') }}</p>
    <p><strong>Monto:</strong> ${{ number_format ($offer->amount) }}</p>
    <p><strong>Estado:</strong> {{ $offer->status }}</p>

    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('offers.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>
</div>
@endsection

