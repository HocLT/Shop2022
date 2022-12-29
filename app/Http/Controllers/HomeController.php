<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

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

    public function checkout(Request $request) 
    {
        $customer = Customer::find(1);
        $total = 0;
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            foreach($cart as $item) {
                $total += $item->quantity * $item->prod->price;
            }
        } 
        return view('fe.checkout', compact(
            'customer',
            'total'
        ));
    }

    public function processCheckout(Request $request) {
        $name = $request->fullname;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->phone;
        if ($request->session()->has('cart')) {
            $ord = new Order();
            $ord->customer_name = $name;
            $ord->customer_email = $email;
            $ord->customer_phone = $phone;
            $ord->customer_address = $address;
            $ord->order_date = date('Y-m-d');
            $ord->save();

            $cart = $request->session()->get('cart');
            foreach($cart as $item) {
                $od = new OrderDetail();
                $od->order_id = $ord->id;
                $od->product_id = $item->prod->id;
                $od->price = $item->prod->price;
                $od->quantity = $item->quantity;
                $od->save();
            }

            $request->session()->forget('cart');
        } 
        return redirect('/thankyou');
    }

    public function thankyou(Request $request) {
        return view('fe.thankyou');
    }
}
