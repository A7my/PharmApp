<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SetDeliveryMan;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function orders(){

        $orders = Order::orderBy('id', 'DESC')->get();
        return view('admin.ordersSetting.order' , compact('orders'));
    }

    public function recordOrder(Request $request){

        $order = Order::find($request->order_id);
        $order->delivery_man_id = $request->d_man;
        $order->save();

        $delivery_man = User::find($request->d_man)->name;
        $client = User::find($order->client_id);
        $d_man = User::find($request->d_man);
        Notification::send([$d_man , $client] , new SetDeliveryMan($order));
        return redirect('orders')->with('recordOrder' , 'you have set ' . $delivery_man . ' for Oder #' . $request->order_id);
    }
}
