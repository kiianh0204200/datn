@extends('backend.layouts.master')
@section('title', __('backend.Order List'))

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">{{ __('backend.Order List') }} </h2>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
