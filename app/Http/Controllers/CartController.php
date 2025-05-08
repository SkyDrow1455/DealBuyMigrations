<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\CartProduct;


class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        $user = Auth::user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'activo'],
            ['total' => 0]
        );

        $product = Product::findOrFail($request->product_id);
        $price = $request->price ?? $product->price;
        $quantity = $request->quantity ?? 1;

        // Verificamos si ya está en el carrito
        $existing = $cart->products()->where('product_id', $product->id)->first();

        if ($existing) {
            $newQuantity = $existing->pivot->quantity + $quantity;
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' => $newQuantity,
                'price' => $price,
                'total' => $price * $newQuantity
            ]);
        } else {
            $cart->products()->attach($product->id, [
                'quantity' => $quantity,
                'price' => $price,
                'total' => $price * $quantity
            ]);
        }

        $this->updateCartTotal($cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }



    public function viewCart()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        // Intentar obtener el carrito activo del usuario
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'activo'],  // Condición de búsqueda
            ['total' => 0] // Valores predeterminados si no existe un carrito
        );

        // Obtener los productos del carrito
        $products = $cart->products()->withPivot('quantity', 'price', 'total')->get();

        return view('cart', [
            'cart' => $cart,
            'products' => $products
        ]);
    }


    public function updateQuantity(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->where('status', 'activo')->firstOrFail();

        $cart->products()->updateExistingPivot($request->product_id, [
            'quantity' => $request->quantity,
            'total' => $request->quantity * $request->price,
        ]);

        $this->updateCartTotal($cart);

        return response()->json(['message' => 'Cantidad actualizada.']);
    }



    public function removeProduct($productId)
    {
        $cart = Cart::where('user_id', auth()->id())->where('status', 'activo')->firstOrFail();
        $cart->products()->detach($productId);

        $this->updateCartTotal($cart);

        return response()->json(['message' => 'Producto eliminado del carrito.']);
    }


    private function updateCartTotal(Cart $cart)
    {
        $total = $cart->products->sum(function ($product) {
            return $product->pivot->total;
        });

        $cart->update(['total' => $total]);
    }

    public function index()
    {
        // Obtener el carrito activo del usuario autenticado
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 'activo')->first();

        // Si no existe un carrito, crea uno automáticamente
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 'activo',
                'total' => 0
            ]);
        }

        // Obtener los productos del carrito
        $cartProducts = CartProduct::with('product.category', 'product.product_image')->get();


        return view('cart', compact('cart', 'cartProducts'));
    }
}
