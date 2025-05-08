<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Product;

class OfferController extends Controller
{
 
    public function index()
    {
        $offers = Offer::with(['buyer', 'product'])->get();
        return view('offers.index', compact('offers'));
    }
    
    public function create()
    {
        $products = Product::all();
        return view('offers.create', compact('products'));
    }
    
    public function show($id)
    {
        $offer = Offer::with(['buyer', 'product'])->findOrFail($id);
        return view('offers.show', compact('offer'));
    }
    
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $products = Product::all();
        return view('offers.edit', compact('offer', 'products'));
    }
    
    public function store(Request $request)
{
    $validated = $request->validate([
        'buyer_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,id',
        'amount' => 'required|numeric|min:0',
    ]);

    Offer::create($validated);

    return redirect()->route('offers.index')->with('success', 'Oferta creada correctamente.');
}
public function destroy($id)
{
    $offer = Offer::findOrFail($id);
    $offer->delete();

    return redirect()->route('offers.index')->with('success', 'Oferta eliminada exitosamente.');
}

}