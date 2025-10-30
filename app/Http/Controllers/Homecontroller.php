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


use Session;

use Stripe;



class Homecontroller extends Controller
{

    public function index()
    {
        $product=Product::paginate(10);
        $comment=Comment::orderby('id', 'desc')->get();
        $reply=Reply::all();
        return view('home.userpage', compact('product' , 'comment' , 'reply'));
    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if ($usertype=='1')
       {
            $total_product=product::all()->count();

            $total_order=order::all()->count();

            $total_user=user::all()->count();

            $order=order::all();

            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue= $total_revenue + $order->price;

            }

            $total_delavered=order::where('delivery_status', '=', 'delivered')->get()->count();
            $toral_processing=order::where('delivery_status', '=', 'processing')->get()->count();
       

            
            return view('admin.home', compact('total_product', 'total_order', 'total_user' ,'total_revenue', 'total_delavered', 'toral_processing'));
        } 
        else 
        {
            $product=Product::paginate(10);
            $comment=Comment::orderby('id', 'desc')->get();
            $reply=Reply::all();
        return view('home.userpage', compact('product', 'comment' , 'reply'));
        }
    }
    public function product_details($id)
    {
        $product=Product::find($id);
        return view('home.product_details', compact('product'));
    }
     public function add_cart(Request $request, $id)
{
    // Require login
    if (!Auth::check()) {
        return redirect('login');
    }

    // Validate quantity
    $request->validate([
        'quantity' => 'nullable|integer|min:1',
    ]);

    // Get the product
    $product = Product::findOrFail($id);

    // Check if this product already exists in user's cart
    $cart = Cart::where('product_id', $product->id)
        ->where('user_id', Auth::id())
        ->first();

    if ($cart) {
        // Increase quantity
        $cart->quantity += $request->input('quantity', 1);

        // ✅ Use discount price if available, otherwise normal price
        $pricePerItem = (!empty($product->discount_price) && $product->discount_price > 0)
            ? $product->discount_price
            : $product->price;

        // Update total price based on quantity
        $cart->price = $cart->quantity * $pricePerItem;

        $cart->save();

        return redirect()->back()->with('message', 'Product quantity updated in Cart');
    }

    // Create new cart entry
    $cart = new Cart();
    $cart->user_id = Auth::id();
    $cart->product_id = $product->id;
    $cart->product_title = $product->title;
    $cart->image = $product->image ?? '';
    $cart->quantity = $request->input('quantity', 1);

    // ✅ Use discount price if available
    $pricePerItem = (!empty($product->discount_price) && $product->discount_price > 0)
        ? $product->discount_price
        : $product->price;

    // Store total price for this product (quantity × unit price)
    $cart->price = $cart->quantity * $pricePerItem;

    // Optional user info fields
    $cart->name = Auth::user()->name ?? 'user';
    $cart->email = Auth::user()->email ?? '';
    $cart->phone = $request->input('phone', '');
    $cart->address = $request->input('address', '');

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

    public function stripePost(Request $request,$totalprice)

    {
       

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $totalprice * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Thanks for payment." 

        ]);


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

            $order->payment_status='Paid';
            $order->delivery_status='processing';

            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();



        }

      

        Session::flash('success', 'Payment successful!');

              

        return back();

    }
    public function show_order()
    {
        if (Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $order=Order::where('user_id', $userid)->get();
            return view('home.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order=order::find($id);
        $order->delivery_status='You Cancelled the Order';
        $order->save();
        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
       if(Auth::id())
       {
        

        $comment=new Comment;

        $comment->name=Auth::user()->name;

        $comment->user_id=Auth::user()->id;

        $comment->comment=$request->comment;

        $comment->save();

        return redirect()->back();

       }
       else{

        return redirect('login');
       }

        
    }
    public function add_reply(Request $request)
    {
       if(Auth::id())
       {
        

        $reply=new reply;

        $reply->name=Auth::user()->name;

        $reply->user_id=Auth::user()->id;

        $reply->comment_id=$request->commentId;

        $reply->reply=$request->reply;

        $reply->save();

        return redirect()->back();

       }
       else{

        return redirect('login');
       }

        
    }

    public function product_search(Request $request)
    {
        $search_text=$request->search;
        $product=Product::where('title','LIKE',"%$search_text%")->orWhere('catagory','LIKE',"%$search_text%")->paginate(10);
        $comment=Comment::orderby('id', 'desc')->get();
        $reply=Reply::all();
        return view('home.userpage', compact('product' , 'comment' , 'reply'));
    }
    
   public function products()
    {
    $product = Product::paginate(10);
    $comment = Comment::orderBy('id', 'desc')->get();
    $reply = Reply::all();
    return view('home.all_product', compact('product', 'comment', 'reply'));
    }
    

    public function search_product(Request $request)
    {
        $search_text=$request->search;
        $product=Product::where('title','LIKE',"%$search_text%")->orWhere('catagory','LIKE',"%$search_text%")->paginate(10);
        $comment=Comment::orderby('id', 'desc')->get();
        $reply=Reply::all();
        return view('home.all_product', compact('product' , 'comment' , 'reply'));
    }

  


    
    
}
