<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staffonly');
    }

    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        return view('orders.index', ['products' => $products, 'orders' => $orders]);
    }

    public function create()
    {
        // Add code for showing the order creation form
    }

   
    public function store(Request $request)
    {
    DB::beginTransaction(); // Start the transaction

    try {
        $order = new Order;
        $order->name = $request->customer_name;
        $order->phone = $request->customer_phone;
        $order->save();

        $order_id = $order->id;

        foreach ($request->product_id as $key => $product_id) {
            $orderDetail = new OrderDetail;
            $orderDetail->brand = $request->brand[$key];
            $orderDetail->quantity = $request->quantity[$key];
            $orderDetail->unitprice = $request->price[$key];
            $orderDetail->discount = $request->discount[$key];
            $orderDetail->total_amount = $request->total_amount[$key];
            $order->details()->save($orderDetail);

            // Retrieve the product by ID from the database
            $product = Product::find($product_id);

            // Subtract sold quantities from available quantities
            $newQuantity = $product->quantity - $request->quantity[$key];

            // Update the product's quantity in the database
            $product->update(['quantity' => $newQuantity]);

            // Check if the quantity is low and trigger an alert
            if ($newQuantity < 100) {
                // Set a flag or message to indicate low stock for this product
                // This information can be passed to the Products page
                // and displayed accordingly
            }

            $orderDetail->products()->attach($product_id);
        }

            $transaction = new Transaction;
            $transaction->order_id = $order_id;
            $transaction->paid_amount = (int)$request->paid_amount;
            $transaction->balance = (int)$request->balance;
            $transaction->payment_method = $request->payment_method;
            $transaction->transac_amount = (int)$request->sum_total;
            $transaction->transac_date = date('Y-m-d H:i:s');
            //$transaction->save();
            Auth::user()->transactions()->save($transaction);
            $transaction->order()->save($order);
    
            // Commit the transaction
        DB::commit();

        // Return the view after successfully committing the transaction
        return redirect()->route('orders.index', compact('transaction'))->with('success', 'Order created successfully');
    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();
        return redirect()->back()->with('error', 'Product inputs failed to be inserted! Check your inputs.');
    }

}


    public function show(Order $order, $id)
    {
        $record = Order::find($id);
        $receipt = PDF::loadView('transactions.receipt', $record);
        return $receipt->download('receipt.pdf');
    }

    public function edit(Order $order)
    {
        // You can add code for editing an order
    }

    public function update(Request $request, Order $order)
    {
        
    }

    public function destroy(Order $order)
    {
        // You can add code to delete an order
    }

    public function show_unique_customers() {
        $orders = Order::select('name', \DB::raw('count(*) as count'))
                        ->groupBy('name')->get();
        return view('orders.customer', compact('orders'));
    }
}
