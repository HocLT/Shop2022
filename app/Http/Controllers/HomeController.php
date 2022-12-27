<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

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
        $prod = Product::where('slug', '=', $slug)->first();
        return view('fe.product', compact(
            'prod'
        ));
    }

    public function addCart(Request $request) 
    {
        $pid = $request->pid;
        $prod = Product::find($pid);
        $quantity = $request->quantity;

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            if (array_key_exists($pid, $cart)) {
                $cart[$pid]->quantity += $quantity;
            } else {
                $cart[$pid] = new CartItem($prod, $quantity);
            }
        } else {
            $cart = [];
            $cart[$pid] = new CartItem($prod, $quantity);
        }
        $cart = $request->session()->put('cart', $cart);
    }

    public function viewCart(Request $request) 
    {
        //dd($request->session()->get('cart'));
        return view('fe.viewCart');
    }

    public function updateCart(Request $request) 
    {
        $pid = $request->pid;
        $quantity = $request->quantity;

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            if (array_key_exists($pid, $cart)) {
                $cart[$pid]->quantity = $quantity;
            }
        } 
        $cart = $request->session()->put('cart', $cart);
    }

    public function deleteCartItem(Request $request) 
    {
        $pid = $request->pid;

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            if (array_key_exists($pid, $cart)) {
                unset($cart[$pid]); // xóa phần tử khỏi mảng
            }
        } 
        $cart = $request->session()->put('cart', $cart);
    }
}
