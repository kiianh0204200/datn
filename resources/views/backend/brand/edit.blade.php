@extends('backend.layouts.master')
@section('title', __('backend.Edit Brand'))
@section('content')
    <form action="{{route('admin.brand.update', $brand->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Edit Brand') }}</h2>
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
                                   name="name" value="{{old('name') ?? $brand->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Description') }}</label>
                            <textarea placeholder="Type here" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">
                                {{old('description') ?? $brand->description}}
                            </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </div> <!-- card end// -->
            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="1" @if(old('status')=='1' || $brand->is_active == 1) selected @endif>
                                    {{ __('backend.Active') }}
                                </option>
                                <option value="0" @if(old('status')=='0' || $brand->is_active == 0) selected @endif>
                                    {{ __('backend.Inactive') }}
                                </option>
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
