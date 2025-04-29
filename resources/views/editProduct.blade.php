<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/addProduct.css')
</head>

<body>
    <div class="back-butom">
        <a href="{{ route('home') }}" class="btn-inicio">
            <img src="/assets/img/loginAssets/back.png" alt="Inicio" class="img-boton">
            <p>Inicio</p>
        </a>
    </div>
    <div class="container">
        <div class="formulario">
            <form action="{{ route('products.update', $product->id) }}" method="POST" id="editProductForm" class="product-form" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Importante para método PUT -->

                <h2>Editar Producto</h2>

                <label for="name">Nombre del producto</label>
                <input type="text" placeholder="Nombre del producto" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>

                <label for="description" class="mt-3">Descripción</label>
                <textarea class="form-control" placeholder="Añade una descripcion" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>

                <label for="price" class="mt-3">Precio</label>
                <input type="number" placeholder="Precio" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>

                <label for="category_id" class="mt-3">Categoría</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                <label for="condition" class="mt-3">Condición</label>
                <select class="form-control" id="condition" name="condition" required>
                    <option value="Nuevo" {{ old('condition', $product->condition) == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                    <option value="Usado" {{ old('condition', $product->condition) == 'Usado' ? 'selected' : '' }}>Usado</option>
                </select>

                <label for="image" class="mt-3">Imagen del producto</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">

                <!-- Mostrar la imagen actual solo si existe -->
                @if($product->product_image && $product->product_image->isNotEmpty())
                <img src="{{ Storage::url($product->product_image->first()->image_url) }}" alt="Imagen actual" style="margin-top: 10px; max-width: 100%; height: auto;">
                @endif

                <!-- Contenedor para la vista previa de la nueva imagen -->
                <img id="imagePreview" src="" alt="Vista previa de la imagen" style="display: none; margin-top: 10px; max-width: 100%; height: auto;">

                <button type="submit" class="btn btn-primary mt-4" id="btn-actualizar">Actualizar producto</button>
            </form>
        </div>
    </div>

</body>

</html>