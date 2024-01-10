@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h3 style="float: left">Customers</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>Date</th> --}}
                            <th>Customer name</th>
                            <th>Times served</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                {{-- <td>{{ $order->created_at }}</td> --}}
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->count }}</td>
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
          <div class="card-header"><h3>Search Customer</h3></div>
          <div class="card-body">
            <!-- Your search form or content here -->
            <div class="mb-3">
              <form action="{{ route('products.index') }}" method="GET">
                  <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Search customers" value="{{ request('search') }}">
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
