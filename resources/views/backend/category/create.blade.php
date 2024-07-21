@extends('backend.layouts.master')
@section('title', __('backend.Add New Category'))
@section('content')
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Add New Category') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Category title</label>
                            <input type="text" placeholder="Type here"
                                class="form-control @error('name') is-invalid @enderror" id="product_title" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Parent Category</label>
                            <select class="form-select @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="">Select</option>
                                {!! generateCategoryOptions($categories) !!}
                            </select>
                            @error('parent_id')
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
                        <div class="mb-4">
                            <div class="input-upload">
                                <label class="form-label">Image</label>
                                <img src="{{asset('backend/assets/imgs/theme/upload.svg')}}" alt="">
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="images"
                                       name="image">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="image-upload">
                                <div id="image_preview" style="width:100%;"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- card end// -->
            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="1">Published</option>
                                <option value="0">Draft</option>
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

@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
@endpush

@php
    function generateCategoryOptions($categories, $parent = '')
    {
        $options = '';
        foreach ($categories as $category) {
            $options .= '<option value="' . $category->id . '">' . $parent . $category->name . '</option>';
            if ($category->children) {
                $options .= generateCategoryOptions($category->children, $parent . '--- ');
            }
        }
        return $options;
    }
@endphp
