@extends('backend.layouts.master')
@section('title', __('backend.Edit New Category'))
@section('content')
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Edit New Category') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">{{ __('backend.Category title') }}</label>
                            <input type="text" placeholder="Type here"
                                class="form-control @error('name') is-invalid @enderror" id="product_title" name="name"
                                value="{{ old('name') ?? $category->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Parent Category</label>
                            <select class="form-select @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="">{{ __('backend.Select') }}</option>
                                {!! generateCategoryOptions($categories, '', $category->parent_id) !!}
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="input-upload">
                                <label class="form-label">{{ __('backend.Image') }}</label>
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

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Description') }}</label>
                            <textarea placeholder="Type here" class="form-control @error('description') is-invalid @enderror" name="description"
                                rows="4">
                                {{ old('description') ?? $category->description }}
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
                                <option value="1" @if (old('status') == '1' || $category->is_active == 1) selected @endif>
                                    {{ __('backend.Active') }}
                                </option>
                                <option value="0" @if (old('status') == '0' || $category->is_active == 0) selected @endif>
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

@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
@endpush

@php
    function generateCategoryOptions($categories, $parent = '', $selectedId = null)
    {
        $options = '';
        foreach ($categories as $category) {
            $isSelected = $selectedId !== null && $category->id == $selectedId; // kiểm tra nếu id của danh mục trùng với
            $options .= '<option value="' . $category->id . '" ' . ($isSelected ? ' selected' : '') . '>' . $parent . $category->name . '</option>';
            if ($category->children) {
                $options .= generateCategoryOptions($category->children, $parent . '--- ', $selectedId);
            }
        }
        return $options;
    }
@endphp
