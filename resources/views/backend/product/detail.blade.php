@extends('backend.layouts.master')
@section('title', 'Product Detail')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">{{ __('backend.Product detail') }}</h2>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('frontend.Name') }}</th>
                                        <th>Danh mục</th>
                                        <th>Thương hiệu</th>
                                        <th>Giá</th>
                                        <th>Giảm giá</th>
                                        <th>Tình trạng</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Trạng thái</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="info"> {{$product->name}}</div>
                                        </td>
                                        <td>{{$product->productCategory->name}}</td>
                                        <td>{{$product->brand->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->discount}} %</td>
                                        <td>{{$product->condition}}</td>
                                        <td>{{$product->slug}}</td>
                                        <td>
                                            <img src="{{$product->thumbnail_url}}" width="100" height="100" alt="Item">
                                        </td>
                                        <td>{{$product->is_active ? 'Active' : 'InActive'}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Thuộc tính sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('frontend.Size') }}</th>
                                    <th>{{ __('frontend.Color') }}</th>
                                    <th>{{ __('backend.Stock') }}</th>
                                    <th>{{ __('frontend.Price') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $value)
                                    <tr>
                                        <td>{{$value->size_name}}</td>
                                        <td><span style="color: {{$value->color_value}}">
                                                {{$value->color_name}}
                                            </span>
                                        </td>
                                        <td>{{$value->in_stock}}</td>
                                        <td>{{$value->price}}</td>
                                        <td class="text-end"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive// -->
                    </div> <!-- col// -->
                </div>
            </div>
        </div> <!-- card-body end// -->
        <div class="card">
            <div class="card-header">
                <h4>{{ __('backend.Product Image') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach($images as $value)
                            <img src="{{$value->image_url}}" width="100" height="100" alt="Item">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ __('backend.Product Description') }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <h5>{{ __('backend.Sub Title') }}:</h5>
                    <div class="col-lg-12">{!! $product->subtitle !!}</div>
                </div>
                <div class="row mt-4">
                    <h5>{{ __('frontend.Description') }}:</h5>
                    <div class="col-lg-12">{!! $product->description !!}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>{{ __('backend.Comment') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>{{ __('frontend.Name') }}</th>
                                    <th>{{ __('backend.Message') }}</th>
                                    <th>{{ __('backend.Rating') }}</th>
                                    <th>{{ __('backend.Status') }}</th>
                                    <th>Create at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{$comment->email}}</td>
                                        <td>{{$comment->name}}</td>
                                        <td>{{$comment->messages}}</td>
                                        <td>{{$comment->rating}}</td>
                                        <td>{{$comment->is_active}}</td>
                                        <td>{{$comment->created_at}}</td>
                                        <td>
                                            <form action="{{route('admin.product.comment-status', $comment->id)}}">
                                                <select name="status" onchange="this.form.submit();"
                                                        class="form-select">
                                                    <option
                                                        value="1" {{$comment->is_active == 1 ? 'selected' : ''}}>{{ __('backend.Approve') }}</option>
                                                    <option
                                                        value="0" {{$comment->is_active == 0 ? 'selected' : ''}}>{{ __('backend.Reject') }}</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$comments->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- content-main end// -->
@endsection
