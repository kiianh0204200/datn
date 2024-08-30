@extends('backend.layouts.master')
@section('title', __('backend.Add New Voucher'))
@section('content')
    <h1>Create Voucher</h1>
    <form action="{{ route('admin.voucher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Add New Voucher') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">

                    <div class="mb-4">
                        <label class="form-label">{{ __('backend.Voucher Code') }}</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                               value="{{ old('code') }}"/>
                        @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                 
                    <div class="mb-4">
                        <label class="form-label">{{ __('backend.Description') }}</label>
                        <textarea placeholder="Type here"
                                  class="form-control @error('description') is-invalid @enderror" name="description"
                                  rows="4">
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
        <div class="mb-4">
            <label for="discount_type">Loại Giẩm Giấ</label>
            <select class="form-control" id="discount_type" name="discount_type">
                <option value="1">Tiền</option>
                <option value="0">Phầm trăm</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label">{{ __('backend.Discount Value') }}</label>
            <input type="number" placeholder="{{ __('Số tiền giảm)') }}" class="form-control @error('discount_value') is-invalid @enderror" name="discount_value"
                   value="{{ old('discount_value') }}" step="0.01"/>
            @error('discount_value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="voucher_quantity">Số Lượng</label>
            <input type="number" class="form-control" id="voucher_quantity" name="voucher_quantity" step="1">
        </div>
        <div class="form-group">
            <label for="min_order_value">Giá trị đơn hàng tối thiểu</label>
            <input type="number" class="form-control" id="min_order_value" name="min_order_value" step="1">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="usage_limit">Usage Limit</label>
            <input type="number" class="form-control" id="usage_limit" name="usage_limit">
        </div>
        
    </form>
@endsection
