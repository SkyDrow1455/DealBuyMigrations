<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="{{route('role.rolle')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <label>
        Ingrese su nombre:
        <br>
        <input type="text" name="name">
    </label>
    <br>
    
    <button type="submit">Enviar Formulario:</button>
    </form>
    
</body>
</html>