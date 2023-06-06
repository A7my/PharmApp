<?php

namespace App\Http\Controllers\DeliveryMen;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\ClientPay;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Notifications\Notification;


class MyOrderController extends Controller
{
    public function myorders(){
        $id = Auth::user()->id;
        $myorders = Order::where('delivery_man_id' , $id)->orderBy('id', 'DESC')->get();
        return view('deliveryMen.myorder' , compact('myorders'));
    }

    public function myorder($id){
        $order = Order::find($id);
        $order->pay = 'paid';
        $order->save();


        $clientName = User::find($order->client_id)->name;
        $admins = User::where('role' , 'admin')->get();
        Notification::send($admins , new ClientPay( $id , $clientName ));
        return redirect('myorders')->with('payConfirmation' , 'You confirmed that client has paid');


    }

    public function readNotification($id){


        $readNotification = DB::table('notifications')->where('id' ,   $id)
        ->update(['read_at' => now()]);

        return redirect()->back();
    }

    public function readAllNotification(){
        $user = User::find(Auth::user()->id);
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }

}
