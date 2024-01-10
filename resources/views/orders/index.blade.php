@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <a href="{{ route('receipt') }}" class="btn btn-danger">Print receipt</a>
              </div>
          @elseif(session('warning'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('warning') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @elseif(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <h3 style="float: left">Ordered products</h3>
          {{-- <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target="#addproduct">
            <i class="fa fa-plus"></i> Add New product
          </a> --}}
        </div>
        <form action="{{ route('orders.store') }}" method="post">
          @csrf
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
               
              </div>
            </div>
          </div>
          <table class="table table-bordered table-left">
            <thead>
              <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount (%)</th>
                <th>Total</th>
                <th><a href="#" class="btn btn-sm btn-success add_moreProduct rounded-circle"><i class="fa fa-plus"></i></a></th>
              </tr>
            </thead>
            <tbody class="addMoreProduct">
              <tr>
                <td>1</td>
                <td>
                  <select name="product_id[]" id="product_id" class="form-control product_id">
                    <option value="">Select item</option>
                    @foreach ($products as $product)
                      <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                        {{ $product->product_name }}
                      </option>
                    @endforeach
                  </select>
                </td>
                <td>
                    <input type="text" name="brand[]" class="form-control brand">
                  </td>
                <td>
                  <input type="number" name="quantity[]" class="form-control quantity">
                </td>
                <td>
                  <input type="number" name="price[]" class="form-control price">
                </td>
                <td>
                  <input type="number" name="discount[]" class="form-control discount">
                </td>
                <td>
                  <input type="float" name="total_amount[]" class="form-control total_amount">
                </td>
                <td><a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-times"></i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3>
            Total <b class="total">0.00</b>
            <input type="hidden" name="sum_total" id="sum">
          </h3>
        </div>
        <div class="card-body">
          <div class="panel">
            <div class="row">
              <table class="table table-striped">
                <tr>
                  <td>
                    <label for="customer_name">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control">
                  </td>
                  <td>
                    <label for="customer_phone">Customer Phone</label>
                    <input type="number" name="customer_phone" id="customer_phone" class="form-control">
                  </td>
                </tr>
              </table>
              <td>
                Payment Method
                <span class="radio-item">
                  <input type="radio" name="payment_method" id="payment_method_cash" class="true" value="cash" checked="checked">
                  <label for="payment_method_cash"><i class="fa fa-money-bill text-success"></i>Cash</label>
                </span>
                <span class="radio-item">
                  <input type="radio" name="payment_method" id="payment_method_bank_transfer" class="true" value="bank transfer">
                  <label for="payment_method_bank_transfer"><i class="fa fa-university text-danger"></i>Bank Transfer</label>
                </span>
                <span class="radio-item">
                  <input type="radio" name="payment_method" id="payment_method_credit_card" class="true" value="credit card">
                  <label for="payment_method_credit_card"><i class="fa fa-credit-card text-info"></i>Credit Card</label>
                </span>
              </td>
              <td>
                Payment
                <input type="number" name="paid_amount" id="paid_amount" class="form-control">
              </td>
              <td>
                Customer's Change
                <input type="number" readonly name="balance" id="balance" class="form-control">
              </td>
              <td>
                <button  class="btn-primary btn-lg btn-block mt-3">Save</button>
              </td>
              <td>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              
              <button class="btn btn-danger btn-lg btn-block mt-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </button>
              
              </td>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
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

.radio-item input[type="radio"] {
  visibility: hidden;
  width: 20px;
  height: 20px;
  margin: 0 5px 0 5px;
  cursor: pointer;
}

/* before style */
.radio-item input[type="radio"]:before {
  position: relative;
  margin: 4px -25px -4px 0;
  display: inline-block;
  visibility: visible;
  width: 20px;
  height: 20px;
  border-radius: 10px;
  border: 2px inset rgb(150, 150, 150, 0.75);
  background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%,
    rgb(250, 250, 250) 5%, rgb(230, 230, 230) 95%, rgb(225, 225, 225) 100%);
  content: '';
  cursor: pointer;
}

/* after style */
.radio-item input[type="radio"]:checked:after {
  position: relative;
  top: 0;
  left: 9px;
  display: inline-block;
  border-radius: 6px;
  visibility: visible;
  width: 12px;
  height: 12px;
  background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%,
    rgb(225, 250, 100) 5%, rgb(225, 250, 100) 95%, rgb(25, 100, 0) 100%);
  content: '';
  cursor: pointer;
}

/* after checked */
.radio-item input[type="radio"].true:checked:after {
  background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%,
    rgb(225, 250, 100) 5%, rgb(225, 250, 100) 95%, rgb(25, 100, 0) 100%);
}

.radio-item input[type="radio"].false:checked:after {
  background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%,
    rgb(250, 250, 250) 5%, rgb(230, 230, 230) 95%, rgb(225, 225, 225) 100%);
}

.radio-item label {
  display: inline-block;
  margin: 0;
  padding: 0;
  line-height: 25px;
  height: 25px;
  cursor: pointer;
}
</style>

@section('script')
<script>
  $(document).ready(function() {

    // Function to calculate total amount
    function calculateTotal() {
      var total = 0;
      $('.addMoreProduct .total_amount').each(function() {
        var amount = parseFloat($(this).val()) || 0;
        total += amount;
      });
      $('.total').html(total.toFixed(2));
      $('#sum').val(total.toFixed(2));
    }

    // Add more product row
    $('.add_moreProduct').on('click', function() {
      var product = $('.product_id').html();
      var numberofrow = $('.addMoreProduct tr').length + 1;
      var tr = '<tr>' +
        '<td class="no">' + numberofrow + '</td>' +
        '<td>' +
        '<select name="product_id[]" class="form-control product_id">' + product + '</select>' +
        '</td>' +
        '<td>' +
        '<input type="text" name="brand[]" class="form-control brand">' +
        '</td>' +
        '<td>' +
        '<input type="number" name="quantity[]" class="form-control quantity">' +
        '</td>' +
        '<td>' +
        '<input type="number" name="price[]" class="form-control price">' +
        '</td>' +
        '<td>' +
        '<input type="number" name="discount[]" class="form-control discount">' +
        '</td>' +
        '<td>' +
        '<input type="float" name="total_amount[]" class="form-control total_amount">' +
        '</td>' +
        '<td>' +
        '<a class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a>' +
        '</td>' +
        '</tr>';
      $('.addMoreProduct').append(tr);
    });

    // Delete product row
    $('.addMoreProduct').on('click', '.delete', function(e) {
      e.preventDefault();
      $(this).closest('tr').remove();
      renumberRows(); // Renumber rows after deletion
      calculateTotal(); // Recalculate total after deletion
    });

    // Renumber rows
    function renumberRows() {
      $('.addMoreProduct tr').each(function(index, row) {
        $(row).find('.no').text(index + 1);
      });
    }

    // Event handler for changing product
    $('.addMoreProduct').on('change', '.product_id', function() {
      var tr = $(this).closest('tr');
      var price = parseFloat(tr.find('.product_id option:selected').data('price')) || 0;
      tr.find('.price').val(price);
      calculateTotal();
    });

    // Calculate total amount on keyup for quantity or discount
    $('.addMoreProduct').on('keyup', '.quantity, .discount, .price', function() {
      var tr = $(this).closest('tr');
      var quantity = parseFloat(tr.find('.quantity').val()) || 0;
      var discount = parseFloat(tr.find('.discount').val()) || 0;
      var price = parseFloat(tr.find('.price').val()) || 0;
      var total_amount = (quantity * price) - ((quantity * price * discount) / 100);
      tr.find('.total_amount').val(total_amount);
      calculateTotal();
    });

    // Calculate balance
    $('#paid_amount').keyup(function() {
      var total = parseFloat($('.total').html()) || 0;
      var paid_amount = parseFloat($(this).val()) || 0;
      var tot = paid_amount - total;
      $('#balance').val(tot.toFixed(2));
    });

    // Initial total calculation on page load
    calculateTotal();
  });
</script>
@endsection


@endsection