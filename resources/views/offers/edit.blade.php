<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oferta</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/addProduct.css')
</head>

<body>
    <div class="back-butom">
        <a href="{{ route('offers.index') }}" class="btn-inicio">
            <img src="/assets/img/loginAssets/back.png" alt="Volver" class="img-boton">
            <p>Volver</p>
        </a>
    </div>

    <div class="formulario">
        <form action="{{ route('offers.update', $offer->id) }}" method="POST" class="product-form">
            @csrf
            @method('PUT')

            <h2>Editar Oferta</h2>

            <label for="buyer_id">ID del Comprador</label>
            <input type="number" class="form-control" id="buyer_id" name="buyer_id" value="{{ $offer->buyer_id }}" required>

            <label for="product_id">Producto</label>
            <select class="form-control" id="product_id" name="product_id" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $offer->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>

            <label for="amount">Monto de la Oferta</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $offer->amount }}" min="0" required>

            <button type="submit" class="btn btn-primary" id="btn-publicar">Actualizar Oferta</button>
        </form>
    </div>
</body>

</html>


