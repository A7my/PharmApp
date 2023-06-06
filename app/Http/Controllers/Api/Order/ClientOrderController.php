<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Helpers\helper;
use App\Models\Product;
use Nette\Utils\Helpers;
use Illuminate\Http\Request;
use App\Notifications\SetOrder;
use App\Notifications\AcceptOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Notifications\Notification;
use Notification;


class ClientOrderController extends Controller
{
    public function __construct(){
        $this->helper = new helper();
    }

    public function createOrder(Request $request){

        $clientId = Auth::user()->id;
        $cart = Cart::where('user_id' , $clientId)->where('ordered' , 'no')->get();


        $quantity  = DB::table('carts')->where('user_id' , $clientId)->where('ordered' , 'no')->pluck('quantity');
        $price = DB::table('carts')->where('user_id' , $clientId)->where('ordered' , 'no')->pluck('total_price');

        $sumOfQuantity = $quantity->sum();
        $sumOfPrice = $price->sum();

        $order = new Order;
        $order->client_id = $clientId;
        $order->items = $sumOfQuantity;
        $order->total_price = $sumOfPrice;
        $order->address = $request->address;
        $order->save();

        foreach($cart as $c){
            $product = Product::find($c->product_id);
            $product->quantity = $product->quantity - $c->quantity;
            $product->save();

            $orderFromCart = Cart::find($c->id);
            $orderFromCart->ordered = 'yes';
            $orderFromCart->save();
        }
        return $this->helper->ResponseJson(1, __('apis.createOrder') , [$order]);
    }


    public function acceptOrder(){

        $clientId = Auth::user()->id;
        $orders = Order::where('client_id' , $clientId)->get();

        foreach($orders as $o){

        $order = Order::find($o->id);
        $order->status = 'delivered';
        $order->save();
        }
        // $admins = User::where('role' , 'admin')->get();
        // $delivery_man = $order->delivery_man;


        if( Cart::where('user_id', $clientId)->get() != NULL){
            DB::table('carts')->where('user_id', $clientId)->where('ordered' , 'yes')->delete();
        }

        return $this->helper->ResponseJson(1, __('apis.acceptOrder') );
    }

    public function myOrders(){
        $clientId = Auth::user()->id;
        $cart = Cart::where('user_id' , $clientId)->where('ordered' , 'yes')->get();
        $order = Order::where('client_id' , $clientId)->where('status' , 'not_delivered')->first();
        $delivery_man = $order->delivery_man;
        $products = [];
        $products_images = [];
        $prices = [];
        $quantities = [];
        foreach($cart as $c){
            $product = Product::find($c->product_id);
            array_push($products , $product->name);
            array_push($products_images , $product->image);
            array_push($prices , $product->price);
            array_push($quantities , $c->quantity);
        }
        $notifications = Auth::user()->unreadNotifications;
        return $this->helper->ResponseJson(1, NULL , [ $order , $products ,$products_images ,$prices , $quantities , $delivery_man , $notifications]);
    }
}
