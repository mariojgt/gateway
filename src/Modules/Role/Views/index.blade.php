@extends('gateway::layouts.admin')

@section('title', 'User Roles')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    User Roles
                    <span class="float-right">
                        <i class="icon-plus icons icon-linked toolTipped" title="Create New" data-toggle="modal" data-target="#addModal"></i>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="t-index">Order</th>
                                    <th>Role</th>
                                    <th>Description</th>
                                    <th>Area</th>
                                    <th>Users</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr {!! $role->trashed() ? ' class="table-danger"' : false !!}>
                                        <td>{{ $role->display_order }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role->area }}
                                        <td>0</td>
                                        <td class="text-right">
                                            @if ($role->trashed())
                                                <a href="{{ route('admin.role.restore', ['encid' => encrypt($role->id)]) }}" class="toolTipped" title="Restore">
                                                    <i class="icon-reload icons icon-linked"></i>
                                                </a>
                                                <i class="icon-trash icons icon-linked icon-delete toolTipped"
                                                    data-container="tr"
                                                    data-route="{{ route('admin.role.delete') }}"
                                                    data-encid="{{ encrypt($role->id) }}"
                                                    data-type="hard"
                                                    title ="Destroy">
                                                </i>
                                            @else
                                                <i class="icon-trash icons icon-linked icon-delete toolTipped"
                                                    data-container="tr"
                                                    data-route="{{ route('admin.role.delete') }}"
                                                    data-encid="{{ encrypt($role->id) }}"
                                                    title="Delete">
                                                </i>
                                            @endif
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
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <legend>Add A Role</legend>
                <form method="post" action="{{ route('admin.role.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter a Role name" required="required" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="description">Role Description</label>
                        <input type="text" name="description" class="form-control" id="description" placeholder="Enter a Role description" required="required" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <input type="text" name="area" class="form-control" id="area" placeholder="Enter an area" required="required" aria-required="true" value="admin">
                    </div>
                    <div class="form-group">
                        <label for="display_order">Ordering</label>
                        <input type="number" min="1" name="display_order" class="form-control" id="display_order" placeholder="Enter a Role display order" required="required" aria-required="true" value="10">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success btn-block">Add Role</button>
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

@section('scripts')
@endsection

@section('js')
@endsection
