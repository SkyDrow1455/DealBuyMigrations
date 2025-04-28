<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Mis productos</h1>

        @if($products->isEmpty())
        <!-- Mensaje si no hay productos -->
        <p>No has publicado productos aún</p>
        @else
        <!-- Mostrar productos si hay productos publicados -->
        @foreach($products as $product)
        <div class="product">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Precio: ${{ $product->price }}</p>

            @if($product->product_image && $product->product_image->isNotEmpty())
            <img src="{{ Storage::url($product->product_image->first()->image_url) }}" alt="Imagen del producto" style="max-width: 200px;">
            @else
            <p>No hay imagen disponible</p>
            @endif

            <!-- Formulario para eliminar el producto -->
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            
        </div>
        @endforeach
        @endif
        <br>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Publicar un producto</a>
    </div>
</body>

</html>