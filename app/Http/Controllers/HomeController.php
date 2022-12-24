<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index() 
    {
        $featuredProducts = Product::where('featured', '=', 1)->get();
        return view('fe.index', compact(
            'featuredProducts'
        ));
    }

    public function product($slug)
    {
        dd(1);
        $prod = Product::where('slug', '=', $slug)->first();
        // $prod = Product::find(1);
        return view('fe.product', compact(
            'prod'
        ));
    }
}
