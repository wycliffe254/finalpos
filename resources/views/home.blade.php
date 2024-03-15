@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card mb-4">
                <h4 class="card-header" style="background:#008b8b;color:#fff;">
                    <marquee behavior="" direction="">Welcome to My_Duka_Pos: Where Every Sale Tells a Story!</marquee>
                </h4>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <!-- Total Transactions Card -->
                        <div class="col-md-4">
                            <div class="card bg-success">
                                <div class="card-header bg-success d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Total Transactions</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-aspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical text-white"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Total transactions">
                                            <a href="{{ route('transactions.index') }}" class="dropdown-item">Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-center">{{ count($transactions) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Customers Card -->
                        <div class="col-md-4">
                            <div class="card bg-dark">
                                <div class="card-header bg-dark d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Total Customers</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-aspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical text-white"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Total customers">
                                            <a href="{{ route('customers') }}" class="dropdown-item">Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-white text-center">{{ count($orders) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Products Card -->
                        <div class="col-md-4">
                            <div class="card bg-warning">
                                <div class="card-header bg-warning d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2 text-dark">Total Products</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-aspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical text-dark"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Total products">
                                            <a href="{{ route('products.index') }}" class="dropdown-item">Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-dark text-center">{{ count($products) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="card">
                                <div class="card-header bg-secondary d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Top selling products</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-aspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Total transactions">
                                            <a href="" class="dropdown-item">Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="p-6 m-20 bg-white rounded">
                                        {!! $productsChart->container() !!}
                                    </div>

                                    <script src="{{ $productsChart->cdn() }}"></script>
                                    {{ $productsChart->script() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header" style="background:#008b8b;color:#fff;font-size:25px;font-weight:bold;">{{ __('Live Clock') }}</div>

                <div class="card-body">
                    <!-- Display Current Date and Time -->
                    <div class="d-flex justify-content-center align-items-center">
                    <div class="mb-3">
                        <h5>Current Date and Time:</h5>
                        <p id="currentDateTime">{{ now() }}</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="text-primary"><i class="fa fa-clock fa-4x"></i></p>
                        </div>
                    </div>

                     </div>
                    <!-- "Set Date and Time" Button -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#setDateTimeModal">
                            Set Date and Time
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Set Date and Time Modal -->
<div class="modal fade" id="setDateTimeModal" tabindex="-1" aria-labelledby="setDateTimeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setDateTimeModalLabel">Set Date and Time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Form for setting date and time -->
            <form method="post" action="{{ route('setDateTime') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newDateTime" class="form-label">New Date and Time</label>
                        <input type="datetime-local" class="form-control" id="newDateTime" name="newDateTime" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Set</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Function to update the current date and time
    function updateDateTime() {
        // Get the current date and time
        var currentDate = new Date();
        
        // Format the date and time as a string
        var formattedDateTime = currentDate.toLocaleString();
        
        // Update the HTML element with the new date and time
        document.getElementById('currentDateTime').innerHTML = formattedDateTime;
    }

    // Update the time every second (1000 milliseconds)
    setInterval(updateDateTime, 1000);
</script>

@endsection
