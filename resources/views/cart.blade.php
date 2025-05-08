@extends('layouts.app')

@section('content')

<header class="custom-header py-5">
    <div id="model_container"></div>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-black">
            <h1 class="display-4 fw-bolder text-title-custom fuente-titulo">Carrito</h1>
            <p class="lead fw-normal text-custom mb-0">
                DealBuy
            </p>
        </div>
    </div>
</header>

<div class="container">
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Carrito</h5>
                        </div>
                        <div class="card-body">
                            <!-- Iterar sobre los productos del carrito -->
                            @foreach ($cartProducts as $cartProduct)
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    @if ($cartProduct->product)
                                    @php
                                    $firstImage = $cartProduct->product->product_image->first();
                                    @endphp

                                    <div class="bg-image hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                        @if ($firstImage)
                                        <img src="{{ Storage::url($firstImage->image_url) }}" class="w-100" alt="{{ $cartProduct->product->name }}" />
                                        @else
                                        <img src="https://via.placeholder.com/300x200?text=Sin+imagen" class="w-100" alt="Sin imagen">
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <p><strong>{{ $cartProduct->product->name }}</strong></p>
                                    <p>Condición: {{ $cartProduct->product->condition }}</p>
                                    <p>Categoría: {{ $cartProduct->product->category->name ?? 'Sin categoría' }}</p>

                                    <button type="button" class="btn btn-danger btn-md mb-2" onclick="removeFromCart({{ $cartProduct->product_id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <div class="d-flex mb-4" style="max-width: 300px">
                                        <button type="button" class="btn btn-primary btn-sm me-1 mb-2"
                                            onclick="updateQuantity({{ $cartProduct->product_id }}, {{ $cartProduct->quantity - 1 }}, {{ $cartProduct->price }})">
                                            <i class="bi bi-dash"></i>
                                        </button>

                                        <div class="form-outline">
                                            <input id="quantity{{ $cartProduct->id }}" min="1" name="quantity" value="{{ $cartProduct->quantity }}" type="number" class="form-control" />
                                            <label class="form-label text-center" for="quantity{{ $cartProduct->id }}">Cantidad</label>
                                        </div>

                                        <button type="button" class="btn btn-primary btn-sm me-1 mb-2"
                                            onclick="updateQuantity({{ $cartProduct->product_id }}, {{ $cartProduct->quantity + 1 }}, {{ $cartProduct->price }})">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>

                                    <p class="text-start text-md-center">
                                        <strong>${{ number_format($cartProduct->price * $cartProduct->quantity, 2) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <hr class="my-4" />
                            @endforeach
                        </div>
                    </div>

                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body">
                            <p><strong>Aceptamos</strong></p>
                            <img class="me-2" width="45px" src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg" alt="Visa" />
                            <img class="me-2" width="45px" src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg" alt="American Express" />
                            <img class="me-2" width="45px" src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg" alt="Mastercard" />
                            <img class="me-2" width="45px" src="https://logodownload.org/wp-content/uploads/2014/10/paypal-logo-1-1.png" alt="PayPal" />
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Resumen</h5>
                        </div>
                        <div class="card-body mb-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Productos
                                    <span>${{ number_format($cart->total, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Envío
                                    <span>Gratis</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Subtotal ({{ $cartProducts->sum('quantity') }} productos)
                                    <span>${{ number_format($cart->total, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total</strong>
                                        <p class="mb-0">(IVA incluido)</p>
                                    </div>
                                    <span><strong>${{ number_format($cart->total, 2) }}</strong></span>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-primary btn-lg btn-block">
                                Proceder al pago
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection


@push('scripts')
<script>
    function updateQuantity(productId, quantity, price) {
        if (quantity < 1) return;

        fetch("{{ route('cart.updateQuantity') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
                price: price
            })
        }).then(response => response.json())
          .then(data => location.reload());
    }
</script>

<script>
    function removeFromCart(productId) {
        fetch(`/cart/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => location.reload());
    }
</script>
@endpush
