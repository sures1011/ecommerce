<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

use Session;
use Stripe;


class HomeController extends Controller {
    public function index() {
        $product = Product::paginate(3);
        return view('home.userpage', compact('product'));
    }

    public function product_details($id){

        $product = Product::find($id);

        return view('home.product_details', compact('product'));
    }
    
    public function redirect(){
   
        $product = Product::all();
        $order = Order::all()->count();

        return view('admin.home',compact('product','order'));
    }

    public function add_cart(Request $request, $id){

        if(Auth::id()){
            $user=Auth::user();
            $product = Product::find($id);
            $userid=$user->id;
            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            if($product_exist_id)
            {
                $cart=cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;

                if($product->discount_price!=null)
            {
                $cart->price = $product->discount_price * $cart->quantity;
            }
            else{
                $cart->price = $product->price * $cart->quantity;
            }
            

                $cart->save();
                return redirect()->back()->with('message','Product added successfully');
            }
            else
            {
                $cart=new cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_id = $product->id;
            $cart->product_title = $product->title;
            if($product->discount_price!=null)
            {
                $cart->price = $product->discount_price * $request->quantity;
            }
            else{
                $cart->price = $product->price * $request->quantity;
            }
            
            $cart->image = $product->image;

            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back();
            }
            $cart=new cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_id = $product->id;
            $cart->product_title = $product->title;
            if($product->discount_price!=null)
            {
                $cart->price = $product->discount_price * $request->quantity;
            }
            else{
                $cart->price = $product->price * $request->quantity;
            }
            
            $cart->image = $product->image;

            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back()->with('success','Product added successfully');

            
        }
        else{
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id()){
            $id=Auth::user()->id;
        $cart=Cart::where('user_id','=',$id)->get();

        return view('home.showcart',compact('cart'));
        }
        else{
        return redirect('login');
        }
        
    }

    public function remove_cart($id){
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order(){
        $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id','=',$userid)->get();

        // dd($data);

        foreach($data as $data){
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;

            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;


            $order->payment_status = 'cash';

            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message','The order have been placed');
    }

    public function stripe($totalprice){
        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "aud",
                "source" => $request->stripeToken,
                "description" => "Thankyou for the payment of $totalprice." 
        ]);
      
        $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id','=',$userid)->get();

        // dd($data);

        foreach($data as $data){
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;

            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;


            $order->payment_status = 'Paid';

            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order(){
        if(Auth::id()){

            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id','=',$userid)->get();

            return view('home.order',compact('order'));

        }
        else
        {
            return redirect('login');
        }
    }
    public function cancel_order($id){
        $order=order::find($id);
        $order->delivery_status='Order Cancelled';
        $order->save();
        return redirect()->back();
    }

    public function products(){
        $product = Product::all();
        return view('home.all_product',compact('product'));
    }
}
