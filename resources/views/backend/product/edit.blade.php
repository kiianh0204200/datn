@extends('backend.layouts.master')
@section('title', 'Edit Product')
@push('css')
    <link href="{{asset('backend/assets/css/product.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
    <script>
        $('#add-option').click(function (e) {
            e.preventDefault();
            const attribute = $('#product-option').clone(true); // Clone with data and event handlers
            attribute.removeAttr('id'); // Ensure the clone does not have the same ID
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
    <form method="POST" action="{{route('admin.product.update', $product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">Edit Product</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">Publish</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Product Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_name" class="form-label">Product title</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('product_name') is-invalid @enderror"
                                   value="{{old('product_name') ?? $product->name}}" name="product_name">
                            @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label class="form-label">Price</label>
                                    <div class="row gx-2">
                                        <input placeholder="Price ..." type="number" name="price"
                                               class="form-control @error('price') is-invalid @enderror"
                                               value="{{old('price') ?? $product->price}}">
                                    </div>
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label class="form-label">Discount</label>
                                    <input placeholder="$" type="number" name="discount"
                                           class="form-control @error('discount') is-invalid @enderror"
                                           value="{{old('discount') ?? $product->discount}}">
                                    @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label"> SKU </label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku"
                                       value="{{old('sku') ?? $product->sku}}">
                                @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div> <!-- card end// -->

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Product Content</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Sub Content </label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('sub_content') is-invalid @enderror" name="sub_content"
                                      rows="4">{{old('sub_content') ?? $product->subtitle}}</textarea>
                            @error('sub_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Full description</label>
                            <textarea placeholder="Type here" class="form-control" name="description"
                                      rows="4">{{old('description') ?? $product->description}}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Product Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Image </label>
                            <input class="form-control @error('images') is-invalid @enderror" type="file"
                                   name="images[]" multiple>
                            @foreach($product->productImages as $key => $image)
                                <img src="{{$image->image_url}}" alt="" width="100px" height="100px" class="mt-2">
                                <button id="remove_image" class="btn btn-danger"><i class='fa fa-trash'></i></button>
                            @endforeach
                            @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                @forelse($product->productOptionValues as $optionValue)
                    <div id="product-option">
                        <div class="card mb-4 option-attribute">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary btn-sm remove-option">X</button>
                            </div>
                            <div class="card-header">
                                <h4>Product Option</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label">Color</label>
                                            <select class="form-select @error('color') is-invalid @enderror"
                                                    name="color[]">
                                                <option> Select Color</option>
                                                @foreach($colors as $color)
                                                    <option
                                                        value="{{ $color->id }}" {{$optionValue->color_id == $color->id ? 'selected' : ''}}> {{ $color->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('color[]')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="md-4">
                                            <label class="form-label">Size</label>
                                            <select class="form-select @error('size') is-invalid @enderror"
                                                    name="size[]">
                                                <option value="">Select Size</option>
                                                @foreach($sizes as $size)
                                                    <option
                                                        value="{{ $size->id }}"
                                                        {{$optionValue->size_id == $size->id ? 'selected' : ''}}>
                                                        {{ $size->name }}
                                                    </option>
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
                                            <label for="product_name" class="form-label">Price</label>
                                            <input type="number" placeholder="Type here"
                                                   class="form-control @error('price_option') is-invalid @enderror"
                                                   name="price_option[]"
                                                   value="{{$optionValue->price}}"
                                                   id="product_name">
                                            @error('price_option[]')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="product_name" class="form-label">Stock</label>
                                            <input type="number" placeholder="Type here"
                                                   class="form-control @error('stock') is-invalid @enderror"
                                                   name="stock[]"
                                                   id="product_name"
                                                   value="{{$optionValue->in_stock}}"
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
                @empty
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
                                            <select class="form-select @error('color[]') is-invalid @enderror"
                                                    name="color[]">
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
                                            <label for="product_name"
                                                   class="form-label">{{ __('frontend.Price') }}</label>
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
                                            <label for="product_name"
                                                   class="form-label">{{ __('backend.Stock') }}</label>
                                            <input type="number" placeholder="Type here"
                                                   class="form-control @error('stock[]') is-invalid @enderror"
                                                   name="stock[]"
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
                @endforelse

                <div id="product-option-clone">

                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button id="add-option" class="btn btn-primary">Add option</button>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Media</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-upload">
                            <label class="form-label">Thumbnail</label>
                            <img src="{{asset('backend/assets/imgs/theme/upload.svg')}}" alt="">
                            <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="images"
                                   name="thumbnail" value="{{$product->image}}">
                            @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="image-upload">
                            <div id="image_preview" style="width:100%;"></div>
                            <img src="{{$product->thumbnail_url}}" alt="" width="100px" height="100px" class="mt-2">
                            <button id="remove_image" class="btn btn-danger"><i class='fa fa-trash'></i></button>
                        </div>
                    </div>
                </div> <!-- card end// -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Organization</h4>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Brand</label>
                                <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id">
                                    <option> Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option
                                            value="{{ $brand->id }}" {{$product->brand_id == $brand->id ? 'selected' : ''}}> {{ $brand->name }} </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    <option> Select Category</option>
                                    {!! generateCategoryOptions($categories, '', $product->product_category_id) !!}
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> Condition </label>
                                <select class="form-select @error('condition') is-invalid @enderror" name="condition">
                                    <option value="">Select</option>
                                    <option value="new" @if($product->condition === 'new') selected @endif>New</option>
                                    <option value="hot" @if($product->condition === 'hot') selected @endif>Hot</option>
                                    <option value="best_sale" @if($product->condition === 'best_sale') selected @endif>
                                        BestSale
                                    </option>
                                </select>
                                @error('condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1">Published</option>
                                    <option value="0">Draft</option>
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
