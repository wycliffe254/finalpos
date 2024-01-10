

<div class="">My Duka</div>

<div>
    <p>Customer: {{ $transaction->order->name }}</p>
</div>

<div class="table-responsive">
    <p>Items</p>
    <table class="table table-borderd table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Item </th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Unit price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->order->details as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                        @foreach ($item->products as $product)
                          {{ $product->product_name }}
                        @endforeach
                    </td>
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->quantity}}</td>
                    <td>{{ $item->unitprice }}</td>
                    <td>{{ $item->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    <p>Sum Total: {{ $transaction->transac_amount }}</p>
    <p>Amout Paid: {{ $transaction->paid_amount }}</p>
    <p>Customer Change: {{ $transaction->balance }}</p>
</div>
<div>
    <p>Date: {{ $transaction->created_at }}</p>
</div>

