<a href="{{ route('home') }}" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-list"></i></a>
<a href="{{ route('home') }}" class="btn btn-outline rounded-pill navbar-item navbar-item"><i class="fa fa-home"></i>Home</a>
<a href="{{ route('users.index') }}" class="btn btn-outline rounded-pill navbar-item "><i class="fa fa-user"></i>Users</a>

<a href="{{ route('products.index') }}" class="btn btn-outline rounded-pill navbar-item "><i class="fa fa-box"></i>Products</a>
<a href="{{ route('orders.index') }}" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-desktop"></i>Orders</a>
{{-- <a href="" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-file"></i>Reports</a> --}}
<a href="{{ route('transactions.index') }}" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-money-bill"></i>Transactions</a>
{{-- <a href="" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-warehouse"></i>Suppliers</a> --}}
<a href="{{ route('customers') }}" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-users"></i>Customers</a>
{{-- <a href="" class="btn btn-outline rounded-pill navbar-item"><i class="fa fa-gear"></i>Setting</a> --}}



<style>
    .navbar-item{
        margin-right: 10px;
    }
    .btn-outline{
        border-color: #008b8b;
        color: #000;
        
    }
    .btn-outline:hover{
        background: #008b8b;
        color: #fff;
    }
</style>