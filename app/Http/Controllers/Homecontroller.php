<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;



class Homecontroller extends Controller
{

    public function index()
    {
        $product=Product::paginate(10);
        return view('home.userpage', compact('product'));
    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if ($usertype=='1')
       {
            return view('admin.home');
        } 
        else 
        {
            $product=Product::paginate(10);
        return view('home.userpage', compact('product'));
        }
    }
    public function product_details($id)
    {
        $product=Product::find($id);
        return view('home.product_details', compact('product'));
    }
     public function add_cart(Request $request, $id)
    {
        // Require login — or remove this and allow guest flows explicitly
        if (!Auth::check()) {
            return redirect('login');
        }

        // Validate quantity (you can add other fields if your form posts them)
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        // Get product or fail
        $product = Product::findOrFail($id);

        // CREATE the Cart instance BEFORE assigning properties
        $cart = new Cart();

        // REQUIRED: set the user id so the INSERT will include it
        $cart->user_id = Auth::id();

        // use posted values if present or sensible defaults
        $cart->name = $request->input('name', Auth::user()->name ?? 'user');
        $cart->email = $request->input('email', Auth::user()->email ?? '');
        $cart->phone = $request->input('phone', '');
        $cart->address = $request->input('address', '');
        $cart->product_title = $product->title ?? $request->input('product_title', '');
        // prefer discount price if present and > 0, otherwise use regular price
        $cart->price = (!empty($product->discount_price) && $product->discount_price > 0)
        ? $product->discount_price
        : $product->price;
        $cart->image = $product->image ?? '';
        $cart->product_id = $product->id;
        $cart->quantity = $request->input('quantity', 1);

        $cart->save();

        return redirect()->back()->with('message', 'Product Added Successfully to Cart');
    }
    public function show_cart()
    {
        if (Auth::id())
        {
            $id=Auth::user()->id;
            $cart=Cart::where('user_id', $id)->get();
            return view('home.show_cart', compact('cart'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    
    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;

        $data=Cart::where('user_id', $userid)->get();
        foreach($data as $data)
        {
            $order=new Order;

            $order->name=$user->name;
            $order->email=$user->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;


            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';

            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();



        }
        return redirect()->back()->with('message', 'We have received your order. We will connect with you soon...');


    }
    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }
    
    
    
}
