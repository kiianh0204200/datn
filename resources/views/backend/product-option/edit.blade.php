@extends('backend.layouts.master')
@section('title', 'Update Option')

@section('content')
    <form action="{{ route('admin.product-option.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">Update Option</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">Publish</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="mb-4">
                            <label for="product_title" class="form-label">Name</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('name') is-invalid @enderror" id="product_title"
                                   name="name"
                                   value="{{ old('name') ?? $productOption->name }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" name="type">
                                <option value="color" @if($productOption->type == 'color') selected @endif>Color</option>
                                <option value="size" @if($productOption->type == 'size') selected @endif>Size</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="product_title" class="form-label">Value</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('type') is-invalid @enderror" id="product_title"
                                   name="value"
                                   value="{{ old('value') ?? $productOption->value }}">
                            @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection
