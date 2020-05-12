@extends('gateway::layouts.admin')

@section('title', 'Configuration')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Configuration
                    <span class="float-right">
                        <i class="icon-plus icons icon-linked toolTipped" title="Create New" data-toggle="modal" data-target="#addModal"></i>
                    </span>
                </div>
                <div class="card-body">

                <form method="post" action="{{ route('admin.configuration.update') }}">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-nav-tab" role="tablist" aria-orientation="vertical">
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($sections as $section)
                                    @php
                                    $count++;
                                    @endphp
                                    <a class="nav-link {{ $count == 1 ? 'active' : false }}"
                                        id="v-pills-{{ $section }}-tab"
                                        data-toggle="tab" href="#v-pills-{{ $section }}"
                                        role="tab"
                                        aria-controls="v-pills-{{ $section }}">
                                            {{ $section }}
                                    </a>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-block btn-success mt-4">Update</button>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($sections as $section)
                                    @php
                                    $count++;
                                    @endphp
                                    <div class="tab-pane fade {{ $count == 1 ? 'show active' : false }}"
                                        id="v-pills-{{ $section }}" role="tabpanel"
                                        aria-labelledby="v-pills-{{ $section }}-tab">
                                        {{-- Content --}}
                                        <legend>{{ $section }}</legend>
                                        @foreach ($configs as $config)
                                            @if ($config->section == $section)
                                                <div class="form-group">
                                                    <label for="{{ $config->name }}">{{ title_case($config->name) }}</label>
                                                    @switch($config->type)
                                                        @case('select')

                                                            @break

                                                        @default
                                                            <input type="text" name="config[{{ $config->name }}]"
                                                                class="form-control" value="{{ $config->value }}" />
                                                    @endswitch
                                                    @if ($config->notes)
                                                        <small id="emailHelp" class="form-text text-muted">{{ $config->notes }}</small>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </form>
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
                <legend>Add A Variable</legend>
                <form method="post" action="{{ route('admin.configuration.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control bankey lowerCase" id="name" placeholder="Enter a variable name" required="required" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" name="section" class="form-control" id="section" placeholder="Enter a section" required="required" aria-required="true" value="Site">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="custom-select form-control">
                            <option value="text">Text</option>
                            <option value="select">Select</option>
                            <option value="switch">Switch</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Class</label>
                        <input type="text" name="class" class="form-control" id="form-control" placeholder="Enter an extra class">
                    </div>
                    <div class="form-group">
                        <label for="options">Options</label>
                        <input type="text" name="options" class="form-control" id="form-control" placeholder="Enter extra options">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <input type="text" name="notes" class="form-control" id="form-control" placeholder="Enter extra notes">
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

@section('scripts')
@endsection

@section('js')
@endsection
