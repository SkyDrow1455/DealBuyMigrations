<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product_Image;


class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del producto y la imagen
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación de imagen
        ]);

        // Crear el producto
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->condition = $request->input('condition');
        $product->user_id = Auth::id(); // Asignar el ID del usuario autenticado
        $product->save();

        // Verificar si se ha subido una imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('products', 'public'); // Almacena la imagen en storage/app/public/products

            // Guardar la imagen en la tabla product_images
            $productImage = new Product_Image();
            $productImage->product_id = $product->id;
            $productImage->image_url = $path;
            $productImage->save();
        }

        return redirect()->route('myProducts')->with('success', 'Producto publicado con éxito');
    }


    public function create()
    {
        // Obtener todas las categorías
        $categories = Category::all();

        // Retornar la vista con las categorías
        return view('addProducts', compact('categories'));
    }


    public function myProducts()
    {
        // Recuperar productos del usuario autenticado, incluyendo las imágenes
        $products = Product::where('user_id', Auth::id())->get(); // Primero cargamos los productos

        // A continuación, cargamos la relación 'product_image'
        $products->load('product_image');

        // Retornar la vista con los productos
        return view('myProducts', compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Verificar que el producto pertenece al usuario autenticado
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.myProducts')->with('error', 'No tienes permiso para eliminar este producto');
        }

        // Eliminar las imágenes y el producto
        $product->product_image->each(function ($image) {
            Storage::delete('public/' . $image->image_url);
            $image->delete();
        });

        $product->delete();

        return redirect()->route('myProducts')->with('success', 'Producto eliminado con éxito');
    }

    public function allProducts()
    {
        // Recuperar todos los productos junto con su(s) imagen(es)
        $products = Product::with('product_image')->get();

        return view('allProducts', compact('products'));
    }


    public function index(Request $request)
    {
        $query = Product::with('product_image');

        // Si hay búsqueda
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
        }

        $products = $query->get();

        return view('productsIndex', compact('products'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // <<--- Esto faltaba

        return view('editProduct', compact('product', 'categories'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'condition' => 'required|in:Nuevo,Usado',
            'image' => 'nullable|image|max:2048', // Opcional
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->condition = $request->condition;

        // Si sube nueva imagen
        if ($request->hasFile('image')) {
            if ($product->product_image && $product->product_image->isNotEmpty()) {
                foreach ($product->product_image as $image) {
                    Storage::delete($image->image_url);
                    $image->delete();
                }
            }

            $path = $request->file('image')->store('products');

            $product->product_image()->create([
                'image_url' => $path,
            ]);
        }

        $product->save();

        return redirect()->route('myProducts')->with('success', 'Producto actualizado correctamente.');
    }
    public function show($id) {
        // Recuperar el producto por ID, incluyendo la relación con las imágenes y ofertas
        $product = Product::with(['product_image', 'offers.buyer'])->findOrFail($id);
        // Cargar las imágenes del producto
        return view('products.productShow', compact('product'));
    }
    
}
