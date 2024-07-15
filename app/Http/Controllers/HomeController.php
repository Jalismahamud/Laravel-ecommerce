<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $products = Product::all();
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }

        return view('home.index', compact('products','count'));
    }
    public function login_home(){
        $products = Product::all();
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }
        return view('home.index', compact('products','count'));
    }
    public function index(){
        return view('admin.index');
    }
    public function product_details($id)
    {
        $data = Product::find($id);
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }else{
            $count = '';
        }
        return view('home.product_details', compact('data','count'));

    }
    // add to cart controller methods start here
    public function add_cart($id){
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Your Product has been added to the Cart');
        return redirect()->back();


    }
    public function mycart(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
            $cart = Cart::where('user_id',$userid)->get();
        }else{
            $count = '';
        }

        return view('home.mycart',compact('count','cart'));
    }
    public function confirm_order(Request $request){
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id',$userid)->get();


        foreach($cart as $carts){
            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();

    }

   $cart_remove = Cart::where('user_id',$userid)->get();

   foreach($cart_remove as $remove){
    $data = Cart::find($remove->id);
    $data->delete();
   }


   toastr()->timeOut(10000)->closeButton()->addSuccess('Successfully Order the Products');
    return redirect()->back();

}
}
