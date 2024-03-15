<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Charts\TopSellingProducts;

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
    public function index(TopSellingProducts $productsChart)
    {
        $transactions = Transaction::all();
        $orders = Order::distinct('name')->get();
        $products = Product::all();
        return view('home',['productsChart' => $productsChart->build()],
             compact('transactions', 'orders', 'products'));
    }
    public function setDateTime(Request $request)
    {
        // Handle the logic for setting date and time here

        // For example, you can update a variable in the session
        // with the new date and time
        $request->session()->put('customDateTime', $request->input('newDateTime'));

        return redirect()->route('home');
    }
}
