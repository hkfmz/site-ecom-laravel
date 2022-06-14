<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;

class ProductController extends Controller
{

    public function index()
    {
        if (request()->categorie) {
            $products = Product::with('categories')->whereHas('categories', function ($query){
                $query->where('slug', request()->categorie);
            })->paginate(6);
        }else{
            $products = Product::with('categories')->paginate(6);
        }

        return view('products.index')->with('products', $products);
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail(); //;renvoie 404 au cas où le produit n'est pas trouvé
        $stock = $product->stock == 0 ? 'Indisponible' : 'Disponible';
        return view('products.show',[
            'product' => $product, 
            'stock' => $stock
        ]);
    }

    public function search(){

        request()->validate([
            'q' => 'required|min:3'
        ]);

        $query = request()->input('q');

        $products = Product::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->paginate(6);

        return view('products.search')->with('products', $products);
    }
}
