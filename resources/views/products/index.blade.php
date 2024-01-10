@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h3 style="float: left">Add product</h3>
            <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target="#addproduct">
              <i class="fa fa-plus"></i> Add New product
            </a>
          </div>
          <div class="card-body">
            {{-- Add product form --}}
            <div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel">Add product</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                      </div>
                      {{-- <div class="form-group">
                        <label for="alert_stock">Alert Stock</label>
                        <input type="number" name="alert_stock" id="alert_stock" class="form-control">
                      </div> --}}
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="2" class="form-control"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Save Product</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-bordered table-left">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product name</th>
                  <th>Brand</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  {{-- <th>Alert Stock</th> --}}
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $key => $product)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->brand }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ number_format($product->price, 2) }}</td>
                  <td>
                    @if ($product->quantity <= 100)
                        <span style="color: red;">{{ $product->quantity }}</span>
                      @else
                        {{ $product->quantity }}
                      @endif
                  </td>
                  {{-- <td>
                      @if ($product->quantity <= 100)
                        <span style="color: red;">{{ $product->quantity }}</span>
                      @else
                        {{ $product->quantity }}
                      @endif
                    </td> --}}
                    <td>
                    <div class="btn-group">
                      <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editproduct{{ $product->id }}">
                        <i class="fa fa-edit"></i> Edit
                      </a>
                      <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteproduct{{ $product->id }}">
                        <i class="fa fa-trash"></i> Del
                      </a>
                    </div>
                  </td>
                </tr>
                {{-- Modal of editing product details --}}
                <div class="modal right fade" id="editproduct{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">Edit Product</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                          @csrf
                          @method('PUT') 
                          
                          <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text" name ="brand" id="brand" value="{{ $product->brand }}" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="2" class="form-control">{{ $product->description }}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}" class="form-control">
                          </div>
                          <div class ="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" class="form-control">
                          
                          </div>
                          {{-- <div class="form-group">
                            <label for="alert_stock">Alert Stock</label>
                            <input type="number" name="alert_stock" id="alert_stock" value="{{ $product->alert_stock }}" class="form-control">
                          </div> --}}
                          <div class="modal-footer">
                            <button class="btn btn-primary btn-block">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Modal for deleting products --}}
                <div class="modal right fade" id="deleteproduct{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">Delete Product</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                          @csrf
                          @method('delete')
                          <p>Are you sure you want to delete this {{ $product->product_name }}?</p>
                          <div class="modal-footer">
                            <button class="btn btn-info" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </tbody>
              
            </table>
           
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header"><h3>Search product</h3></div>
          <div class="card-body">
            <!-- Your search form or content here -->
            <div class="mb-3">
              <form action="{{ route('products.index') }}" method="GET">
                  <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Search products" value="{{ request('search') }}">
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
