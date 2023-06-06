<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){

        // For Admin

        $orders = Order::count();
        $notDeliveredOrders = Order::where('status' , 'not_delivered')->count();
        $deliveredOrders = Order::where('status' , 'delivered')->count();

        if($orders != 0){
            $deliveredToTotal = ($deliveredOrders / $orders) * 100;
            $paidOrdersPerc = (Order::where('pay' , 'paid')->count() / $orders) * 100;
            $notPaidOrdersPerc = (Order::where('pay' , 'not_paid')->count() / $orders) * 100 ;
        }else{
            $deliveredToTotal = 0;
            $paidOrdersPerc = 0;
            $notPaidOrdersPerc = 0 ;
        }


        $notPaidOrders = Order::where('pay' , 'not_paid')->count();
        $PaidOrders = Order::where('pay' , 'paid')->count();


        $pedningOrders = Order::where('delivery_man_id' , NULL)->count();

        $totalNotPaidOrders = Order::where('pay' , 'not_paid')->pluck('total_price')->sum();
        $totalPaidOrders = Order::where('pay' , 'paid')->pluck('total_price')->sum();


        $chartjs1 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Not Paid Ordered', 'Paid Order'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$notPaidOrdersPerc, $paidOrdersPerc]
            ]
        ])
        ->options([]);

        $chartjs2 = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Not Delivered Orders', 'Delivered Orders'])
        ->datasets([
            [
                "label" => "Not Delivered Orderes ",
                'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                'data' => [$notDeliveredOrders , $deliveredOrders]
            ],
            [
                "label" => "Delivered Orders",
                'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
                // 'data' => [65]
            ]
        ])
        ->options([]);



        // For Delivery Man

        return view('dashboard' , compact( 'chartjs1' , 'chartjs2' ,'PaidOrders' , 'totalPaidOrders',  'deliveredToTotal' , 'pedningOrders' , 'notDeliveredOrders' , 'deliveredOrders' , 'notPaidOrders' , 'totalNotPaidOrders'));
    }
}
