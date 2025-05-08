<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Ofertas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/addProduct.css') <!-- Usa la misma hoja de estilo -->
</head>
<body>

    <div class="back-butom">
        <a href="{{ route('home') }}" class="btn-inicio">
            <img src="/assets/img/loginAssets/back.png" alt="Inicio" class="img-boton">
            <p>Inicio</p>
        </a>
    </div>

    <div class="formulario">
        <h2>Mis Ofertas</h2>
        <div style="margin-top: 20px;"></div>

        <div class="d-flex justify-content-between mb-3">
            
            <a href="{{ route('offers.create') }}"
            class="btn btn-sm"
            style="background-color:rgb(13, 205, 253); color: white; border: none; box-shadow: 0 4px #0a58ca; padding: 6px 12px; border-radius: 12px; text-decoration: none; transition: all 0.2s;">
           Crear nueva oferta
            </a>
        </div>
        
        <div style="margin-top: 20px;"></div>
        
        @if ($offers->isEmpty())
            <p>No hay ofertas registradas.</p>
        @else
        <div class="table-container">
            <table class="table table-bordered table-hover">
            <table class="table table-bordered table-hover" style="border: 1px solid #ccc;">
    <thead class="table-light">
        <tr>
            <th style="border: 1px solid #ccc;">ID</th>
            <th style="border: 1px solid #ccc;">Comprador</th>
            <th style="border: 1px solid #ccc;">Producto</th>
            <th style="border: 1px solid #ccc;">Monto</th>
            <th style="border: 1px solid #ccc;">Solicitud</th>
            <th style="border: 1px solid #ccc;">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($offers as $offer)
        <tr>
            <td style="border: 1px solid #ccc;">{{ $offer->id }}</td>
            <td style="border: 1px solid #ccc;">{{ $offer->buyer->name ?? 'N/A' }}</td>
            <td style="border: 1px solid #ccc;">{{ $offer->product->name ?? 'N/A' }}</td>
            <td style="border: 1px solid #ccc;">${{ number_format($offer->amount, 2) }}</td>
            <td style="border: 1px solid #ccc;">{{ ucfirst($offer->status) }}</td>
            
                        <td>
                            <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" style="border-radius: 12px; padding: 4px;">
                                    <option value="pendiente" {{ $offer->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="aceptada" {{ $offer->status == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                                    <option value="rechazada" {{ $offer->status == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                                </select>
                            </form>
                        </td>

                        <td>
                        <button class="btn btn-sm" style="background-color:rgb(144, 35, 106); color: white; border: none; box-shadow: 0 4pxrgb(8, 14, 24); padding: 6px 12px; border-radius: 12px; transition: all 0.2s;"
                            onclick="window.location='{{ route('offers.show', $offer->id) }}'">
                            Ver
                           </button>

                           <button class="btn btn-sm" style="background-color:rgb(17, 106, 126); color: white; border: none; box-shadow: 0 4pxrgb(13, 10, 2); padding: 6px 12px; border-radius: 12px; transition: all 0.2s;"
                            onclick="window.location='{{ route('offers.edit', $offer->id) }}'">
                            Editar
                           </button>
                        <div style="display: flex; flex-direction: column; gap: 8px;"> 
                            
                            <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
                           
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" style="background-color:rgb(8, 7, 75); color: white; border: none; box-shadow: 0 4px #0a58ca; padding: 6px 12px; border-radius: 12px; transition: all 0.2s;" onclick="return confirm('¿Eliminar esta oferta?')">
                                    Eliminar
                                </button>                                
                            </form>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</body>
</html>
