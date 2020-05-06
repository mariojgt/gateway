@extends('checkout::layouts.admin')

@section('title', 'Admins')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Admin Users
                <span class="float-right">
                    <i class="icon-plus icons icon-linked toolTipped" title="Create New" data-toggle="modal" data-target="#addModal"></i>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->name.' '.$admin->surname }}</td>
                                    <td>{!! $admin->role->name or 'user' !!}</td>
                                    <td>{{ $admin->status == 1 ? 'Active' : 'Suspended' }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.admin.edit',['id' => encrypt($admin->id)]) }}"><i class="icon-note icons"></i></a>
                                        <a href="{{ route('admin.admin.edit',['id' => encrypt($admin->id)]) }}"><i class="icon-trash icons"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <legend>Add an Admin User</legend>
                <form method="post" action="{{ route('admin.admin.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter a name" required="required" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" class="form-control" id="surname" placeholder="Enter a surname" required="required" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter an email" required="required" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="section">User Level</label>
                        <select name="role" id="role" class="custom-select form-control">
                            <option value="null">Please Choose</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ title_case($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success btn-block">Add Variable</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
@endsection
