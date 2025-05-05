<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Añadir un producto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/addProduct.css')
</head>

<body>
    <div class="back-butom">
        <a href="{{ route('home') }}" class="btn-inicio">
            <img src="/assets/img/loginAssets/back.png" alt="Inicio" class="img-boton">
            <p>Inicio</p>
        </a>
    </div>
    <div class="formulario">
        <form action="{{ route('products.store') }}" method="POST" id="addProductForm" class="product-form" enctype="multipart/form-data">

            @csrf

            <h2>Publicar un Producto</h2>
            <label for="name">Nombre del producto</label>
            <input type="text" placeholder="Nombre del producto" class="form-control" id="name" name="name" required>

            <label for="description">Descripción</label>
            <textarea class="form-control" placeholder="Añade una descripcion" id="description" name="description" required></textarea>

            <label for="price">Precio</label>
            <input type="number" placeholder="Precio" class="form-control" id="price" name="price" required>

            <label for="category_id">Categoría</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <!-- Campo para seleccionar la condición -->

            <label for="condition">Condición</label>
            <select class="form-control" id="condition" name="condition" required>
                <option value="Nuevo">Nuevo</option>
                <option value="Usado">Usado</option>
            </select>

            <label for="image">Imagen del producto</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <!-- Contenedor para la vista previa de la imagen -->
            <img id="imagePreview" src="" alt="Vista previa de la imagen" style="display: none; margin-top: 10px; max-width: 100%; height: auto;">

            <button type="submit" class="btn btn-primary" id="btn-publicar">Publicar producto</button>
        </form>

    </div>

    <div id="message"></div>

    <script>
        // Obtener el input y la imagen de vista previa
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');

        // Event listener para cuando el usuario seleccione un archivo
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Obtener el primer archivo seleccionado

            if (file) {
                // Crear un objeto URL para la imagen seleccionada
                const objectURL = URL.createObjectURL(file);
                // Establecer la URL en la imagen de vista previa
                imagePreview.src = objectURL;
                // Hacer visible la imagen de vista previa
                imagePreview.style.display = 'block';
            } else {
                // Si no se selecciona ninguna imagen, ocultar la vista previa
                imagePreview.style.display = 'none';
            }
        });
    </script>


</body>

</html>