@extends('backend.layouts.master')
@section('title', __('backend.Create New Product'))
@push('css')
    <link href="{{asset('backend/assets/css/product.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
    <script>
        $('#add-option').click(function (e) {
            e.preventDefault();
            const attribute = $('#product-option').html();
            $('#product-option-clone').append(attribute);
        });
        $(document).on('click', '.remove-option', function (e) {
            e.preventDefault();
            const parent = $(this).closest('.option-attribute');

            if ($('.option-attribute').length > 1) {
                parent.remove();
            }
        });
    </script>
@endpush

@section('content')
    <form method="POST" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Create New Product') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('backend.Product Info') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_name" class="form-label">{{ __('backend.Product title') }}</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('product_name') is-invalid @enderror"
                                   value="{{old('product_name')}}" name="product_name">
                            @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label class="form-label">{{ __('frontend.Price') }}</label>
                                    <div class="row gx-2">
                                        <input placeholder="Price ..." type="number" name="price"
                                               class="form-control @error('price') is-invalid @enderror"
                                               value="{{old('price')}}">
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label class="form-label">{{ __('frontend.Discount') }}</label>
                                    <input placeholder="%" type="number" name="discount"
                                           class="form-control @error('discount') is-invalid @enderror"
                                           value="{{old('discount')}}">
                                    @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label"> SKU </label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{old('sku')}}">
                                @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div> <!-- card end// -->

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('backend.Product Content') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Sub Content') }} </label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('sub_content') is-invalid @enderror" name="sub_content"
                                      rows="4">{{old('sub_content')}}</textarea>
                            @error('sub_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Full description') }}</label>
                            <textarea placeholder="Type here" class="form-control @error('description') is-invalid @enderror" name="description"
                                      rows="4">{{old('description')}}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('backend.Product Image') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Image') }} </label>
                            <input class="form-control @error('images') is-invalid @enderror" type="file" id="images_all" name="images[]" multiple>
                            @error('sub_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <div class="image-upload">
                                <div id="image_previews" style="width:50%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="product-option">
                    <div class="card mb-4 option-attribute">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary btn-sm remove-option">X</button>
                        </div>
                        <div class="card-header">
                            <h4>{{ __('backend.Product Option') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">{{ __('frontend.Color') }}</label>
                                        <select class="form-select @error('color[]') is-invalid @enderror" name="color[]">
                                            <option> {{ __('backend.Select Color') }}</option>
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}"> {{ $color->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('color[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="md-4">
                                        <label class="form-label">{{ __('frontend.Size') }}</label>
                                        <select class="form-select @error('size[]') is-invalid @enderror"
                                                name="size[]">
                                            <option value="">{{ __('backend.Select Size') }}</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}"> {{ $size->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('size[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">{{ __('frontend.Price') }}</label>
                                        <input type="number" placeholder="Type here"
                                               class="form-control @error('price_option[]') is-invalid @enderror"
                                               name="price_option[]"
                                               id="product_name">
                                        @error('price_option[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">{{ __('backend.Stock') }}</label>
                                        <input type="number" placeholder="Type here"
                                               class="form-control @error('stock[]') is-invalid @enderror" name="stock[]"
                                               id="product_name"
                                        >
                                        @error('stock[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="product-option-clone">

                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button id="add-option" class="btn btn-primary">{{ __('backend.Add option') }}</button>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('backend.Image') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-upload">
                            <label class="form-label">{{ __('backend.Image') }}</label>
                            <img src="{{asset('backend/assets/imgs/theme/upload.svg')}}" alt="">
                            <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="images"
                                   name="thumbnail">
                            @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="image-upload">
                            <div id="image_preview" style="width:100%;"></div>
                        </div>
                    </div>
                </div> <!-- card end// -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('backend.Organization') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">{{ __('backend.Brand') }}</label>
                                <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id">
                                    <option> {{ __('backend.Select Brand') }}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">{{ __('frontend.Category') }}</label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    <option> {{ __('backend.Select Category') }}</option>
                                    {!! generateCategoryOptions($categories) !!}
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="product_name" class="form-label">{{ __('backend.Tags') }}</label>
                                <input type="text" class="form-control @error('tag') is-invalid @enderror" name="tag"
                                       multiple value="{{old('tag')}}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> {{ __('backend.Condition') }} </label>
                                <select class="form-select @error('condition') is-invalid @enderror" name="condition">
                                    <option value="new"> {{ __('frontend.New') }}</option>
                                    <option value="hot"> {{ __('frontend.Hot') }}</option>
                                    <option value="best_sale"> {{ __('frontend.Best Sale') }}</option>
                                </select>
                                @error('condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">{{ __('backend.Status') }}</label>
                                <select class="form-select" name="status">
                                    <option value="1">{{ __('frontend.Published') }}</option>
                                    <option value="0">{{ __('frontend.Draft') }}</option>
                                </select>
                            </div>
                        </div> <!-- row.// -->
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection

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
