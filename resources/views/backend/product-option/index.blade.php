@extends('backend.layouts.master')
@section('title', 'Product Option')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Product Option </h2>
        </div>
        @can('create product option management')
            <div>
                <a href="{{route('admin.product-option.create')}}"
                   class="btn btn-primary btn-sm rounded">{{ __('backend.Create new') }}</a>
            </div>
        @endcan
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
