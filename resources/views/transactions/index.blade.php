@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h3>Transactions</h3>
              <a href="{{ route('export') }}" 
                  class="btn btn-dark btn-link export-link">Export to Excel
              </a>
          </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Customer name</th>
                            <th>Items sold</th>
                            <th>Cost</th>
                            <th>Amount paid</th>
                            <th>Balance</th>
                            <th>Payment method</th>
                            <th>Cashier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->order->name }}</td>
                                <td>{{ count($transaction->order->details) }}</td>
                                <td>{{ $transaction->transac_amount }}</td>
                                <td>{{ $transaction->paid_amount }}</td>
                                <td>{{ $transaction->balance }}</td>
                                <td>{{ $transaction->payment_method }}</td>
                                <td>{{ $transaction->user->name }}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header"><h3>Search transaction</h3></div>
          <div class="card-body">
            <!-- Your search form or content here -->
            <div class="mb-3">
              <form action="{{ route('products.index') }}" method="GET">
                  <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Search transactions" value="{{ request('search') }}">
                      <button class="btn btn-info" type="submit">Search</button>
                  </div>
              </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.export-link {
        color: #fff;
        text-decoration: none;
        font-size: large;
}
.export-link:hover {
        text-decoration: none; 
}
.modal.right .modal-dialog {
  top: 0;
  right: 0;
  margin-right: 20vh;
}
.modal.fade:not(.in).right .modal-dialog {
  -webkit-transform: translate3d(25px, 0, 0);
  transform: translate3d(25px, 0, 0);
}
</style>

<!-- Include jQuery and Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
