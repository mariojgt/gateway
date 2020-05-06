@extends('checkout::layouts.admin')

@section('title', 'Database Backup')

@section('content')

<div class="container-fluid">
    <div class="row">
        @foreach ($tables as $table)
        <div class="col-3 mb-3">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    {!! $table->{ $tablesearch } !!}
                </div>
                <div class="card-body">
                    <div class="large-icons">
                        <i class="icon-cloud-download icons large-icons"></i><br/>
                    </div>
                    <a href="{{ route('admin.backup.create', ['table' => $table->{$tablesearch}]) }}">
                        <button class="btn btn-sm btn-info">Download</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

@section('css')
@endsection

@section('scripts')
@endsection

@section('js')
@endsection
