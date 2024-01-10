<nav class="active" id="sidebar">
    <ul class="list-unstyled lead">
        <li class="active">
            <a href="{{ route('home') }}"><i class="fa fa-home fa-lg"></i> Home</a>
        </li>
        <li >
            <a href="{{ route('users.index') }}"><i class="fa fa-user fa-lg"></i> User</a>
        </li>
        <li>
            <a href="{{ route('orders.index') }}"><i class="fa fa-desktop fa-lg"></i> Order</a>
        </li>
        <li>
            <a href="{{ route('transactions.index') }}"><i class="fa fa-money-bill fa-lg"></i> Transaction</a>
        </li>
        <li>
            <a href="{{ route('products.index') }}"><i class="fa fa-truck fa-lg"></i> Product</a>
        </li>
        <li>
            <a href="{{ route('customers') }}" ><i class="fa fa-users"></i>Customer</a>
        </li>
    </ul>
</nav>


<style>
   #sidebar ul.lead{
     border-bottom: 1px solid #008b8b;
     width: fit-content;
   }
   #sidebar ul li a{
    padding: 10px;
    font-size: 1.1em;
    display: block;
    width: 30vh;
    color: #008b8b;
    text-decoration: none;
   }
   #sidebar ul li a:hover{
    color: #fff;
    background: #008b8b;
    text-decoration:none;
   }
   #sidebar ul li a i{
    margin-right: 10px;
   }
   #sidebar ul li.active>a, a[aria-expanded="true"]{
    color: #fff;
    background:#008b8b;
   }
</style>


