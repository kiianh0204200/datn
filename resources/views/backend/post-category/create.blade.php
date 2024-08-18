@extends('backend.layouts.master')
@section('title', __('backend.Post Category List'))
@section('content')
    <form action="{{ route('admin.post-category.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Add New Post Category') }}</h2>
                    <div>
                        <button class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">{{ __('backend.Post Category title') }}</label>
                            <input type="text" placeholder="Type here"
                                class="form-control @error('name') is-invalid @enderror" id="product_title" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea placeholder="Type here" class="form-control @error('description') is-invalid @enderror" name="description"
                                rows="4">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection
