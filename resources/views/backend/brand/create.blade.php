@extends('backend.layouts.master')
@section('title', __('backend.Add New Brand'))
@section('content')
    <form action="{{route('admin.brand.store')}}" method="POST">
    @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Add New Brand') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">{{ __('backend.Brand title') }}</label>
                            <input type="text" placeholder="Type here" class="form-control @error('name') is-invalid @enderror" id="product_title"
                                   name="name" value="{{old('name')}}">
                        @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Description') }}</label>
                            <textarea placeholder="Type here" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">
                                {{old('description')}}
                            </textarea>
                        </div>
                        @error('description')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> <!-- card end// -->
            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="1">{{ __('backend.Published') }}</option>
                                <option value="0">{{ __('backend.Draft') }}</option>
                            </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <hr>
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection
