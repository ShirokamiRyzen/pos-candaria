<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $totalReceivedAmount = Order::all()->sum(function ($order) {
            return $order->receivedAmount();
        });

        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $products_count = Product::count();
        $orders = Order::with(['items', 'payments'])->get();
        //$customers_count = Customer::count();

        // ambil data order due date nya hari ini
        $currentDate = Carbon::now()->format('Y-m-d');
        $orders_due = Order::whereDate('due_day', $currentDate)->get();
        $amount = 0;
        foreach($orders_due as $order) {
            $payment = Payment::where('order_id', $order->id)->first();

            if($payment == null) {
                $items = OrderItem::where('order_id', $order->id)->get();
                foreach($items as $item) {
                    $amount += $item->price * $item->quantity;
                }
                $order->payments()->create([
                    'amount' => $amount,
                    'user_id' => $request->user()->id,
                ]);

                $amount = 0;
            }
        }
        return view('home', [
            'receivedAmount' => $totalReceivedAmount,
            'orders_count' => $orders->count(),
            'income' => $orders->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'outcome' => $orders->map(function($i) {
                if($i->supplier_id) {
                    return $i->total();
                }
            })->sum(),
            'buys_count' => $orders->filter(function($i) {
                return $i->supplier_id;
            })->count(),
            //'customers_count' => $customers_count,
            'products_count' => $products_count,
            
        ]);
    }
}
