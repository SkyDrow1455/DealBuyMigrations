<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    
    public function deleteAdmin()
    {
        
        //Recuperar todos los productos junto con sus imágenes
        $product = Product::with('product_image')->get();
        $product = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function destroyAdmin($id)
    {
        $product = Product::findOrFail($id);

        // Verificar que el producto pertenece al usuario autenticado
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('d')->with('error', 'No tienes permiso para eliminar este producto');
        }

        // Eliminar las imágenes y el producto
        $product->product_image->each(function ($image) {
            Storage::delete('public/' . $image->image_url);
            $image->delete();
        });

        $product->destroy();

        return redirect()->route('myProducts')->with('success', 'Producto eliminado con éxito');
    }
}
