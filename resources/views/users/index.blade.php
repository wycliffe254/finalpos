@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 style="float: left">Add User</h3>
                        <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target="#addUser">
                            <i class="fa fa-plus"></i> Add New User
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->is_admin == 1)
                                           Admin
                                        @elseif ($user->is_admin == 2)
                                          Cashier
                                         @else
                                          Customer
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editUser{{ $user->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUser{{ $user->id }}">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal of editing user details --}}
                                <div class="modal right fade" id="editUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="staticBackdropLabel">Edit User</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="is_admin">Role</label>
                                                        <select name="is_admin" id="is_admin" class="form-control">
                                                            <option value="1" @if ($user->is_admin == 1) selected @endif>Admin</option>
                                                            <option value="2" @if ($user->is_admin == 2) selected @endif>Cashier</option>
                                                            {{-- <option value="3" @if ($user->is_admin == 3) selected @endif>Customer</option> --}}
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" id="password" readonly value="{{ $user->password }}" class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal for deleting user --}}
                                <div class="modal right fade" id="deleteUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="staticBackdropLabel">Delete User</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete this {{ $user->name }}?</p>
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
                    <div class="card-header"><h3>Search User</h3></div>
                    <div class="card-body">
                        <!-- Your search form or content here -->
                        <div class="mb-3">
                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search users" value="{{ request('search') }}">
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

{{-- Modal of adding a new user --}}
<div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">Add User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="is_admin">Role</label>
                        <select name="is_admin" id="is_admin" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Cashier</option>
                            <option value="3">Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="confirm-password" id="confirm-password" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
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
