<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Inertia\Inertia;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(12);
        $comment = Comment::latest()->get();
        $reply = Reply::all();

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        
        if ($usertype == '1') {
            $total_product = Product::count();
            $total_order = Order::count();
            $total_user = User::count();
            $order = Order::all();
            $total_revenue = $order->sum('price');

            $total_delivered = Order::where('delivery_status', 'delivered')->count();
            $total_processing = Order::where('delivery_status', 'processing')->count();

            return view('admin.home', compact(
                'total_product', 
                'total_order', 
                'total_user', 
                'total_revenue', 
                'total_delivered', 
                'total_processing'
            ));
        } else {
            return redirect('/');
        }
    }

    public function product_details($id)
    {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($id);

        $cart = Cart::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => Auth::id()],
            [
                'product_title' => $product->title,
                'image' => $product->image ?? '',
                'quantity' => \DB::raw('quantity + ' . ($request->input('quantity', 1))),
                'price' => \DB::raw('price + ' . (($product->discount_price ?? $product->price) * $request->input('quantity', 1))),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        );

        return redirect()->back()->with('message', 'Product added to cart successfully!');
    }

    public function show_cart()
    {
        if (Auth::id()) {
            $cart = Cart::where('user_id', Auth::id())->get();
            return view('home.show_cart', compact('cart'));
        }
        return redirect('login');
    }

    public function remove_cart($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function products()
    {
        $product = Product::paginate(12);
        return view('home.all_product', compact('product'));
    }
}
