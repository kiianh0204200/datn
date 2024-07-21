@php use function Termwind\style; @endphp
@extends('frontend.layouts.master')
@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">{{ __('frontend.Home') }}</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> {{ __('frontend.We found') }} <strong class="text-brand">{{count($products)}}</strong> {{ __('frontend.items for you') }}!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <a href="#" onclick="clearAllFilters()">{{ __('frontend.Reset fillter') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product.detail', $product->id)}}">
                                                    <img class="default-img"
                                                         src="{{ $product->thumbnail_url }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="View" class="action-btn hover-up"
                                                   href="{{route('product.detail', $product->id)}}"><i class="fi-rs-search"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if($product->condition=='hot')
                                                    <span class="hot">Hot</span>
                                                @elseif($product->condition=='new')
                                                    <span class="new">{{ __('frontend.New') }}</span>
                                                @else
                                                <span class="sale">{{ __('frontend.Best Sale') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="/shop?category={{$product->productCategory->id}}">{{$product->productCategory->name}} </a>
                                            </div>
                                            <h2><a href="{{route('product.detail', $product->id)}}">{{$product->name}}</a></h2>
                                            <div class="product-price">
                                                @if(productDiscount($product->price, $product->discount) < $product->price)
                                                    <span class="a">{{productDiscount($product->price, $product->discount)}} đ</span>
                                                    <span class="old-price">{{formatPrice($product->price)}} đ</span>
                                                @else
                                                    <span>{{formatPrice($product->price)}} đ</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div>

                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">{{ __('frontend.Category') }}</h5>
                            <ul class="categories">
                                @foreach($categories as $category)
                                    <li><a href="#"
                                           onclick="handleFilterClick('category', {{$category->id}})">{{$category->name}}</a>
                                    </li>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">{{ __('frontend.Fill by price') }}</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <form action="shop">
                                        <label class="form-label">{{ __('frontend.Min') }}</label>
                                        <input class="form-control" name="price_min" type="text" value="{{request()->input('price_min')}}">
                                        <label class="form-label">{{ __('frontend.Max') }}</label>
                                        <input class="form-control" name="price_max" type="text" value="{{request()->input('price_max')}}">
                                        <button type="submit" class="btn btn-sm btn-default"><i
                                                class="fi-rs-filter mr-5"></i> {{ __('frontend.Fillter') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900">{{ __('frontend.Color') }}</label>
                                    <div class="custome-checkbox">
                                        @foreach($colors as $color)
                                            <input class="form-check-input"
                                                   onclick="handleFilterClick('color', {{$color->id}})" type="checkbox"
                                                   {{ request()->input('color') == $color->id ? 'checked' : '' }}
                                                   id="exampleCheckbox{{$color->id}}">
                                            <label class="form-check-label"
                                                   for="exampleCheckbox{{$color->id}}"><span>{{$color->name}}</span></label>
                                        @endforeach
                                    </div>

                                    <label class="fw-900">{{ __('frontend.Size') }}</label>
                                    <div class="custome-checkbox">
                                        @foreach($sizes as $size)
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   {{ request()->input('size') == $size->id ? 'checked' : '' }}
                                                   id="exampleCheckbox{{$size->id}}"
                                                   onclick="handleFilterClick('size', {{$size->id}})">
                                            <label class="form-check-label"
                                                   for="exampleCheckbox{{$size->id}}"><span>{{$size->name}}</span></label>
                                        @endforeach
                                    </div>

                                    <label class="fw-900 mt-15">{{ __('frontend.Item Condition') }}</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox"
                                               {{ request()->input('condition') == 'new' ? 'checked' : '' }}
                                               onclick="handleFilterClick('condition', 'new')"
                                               id="exampleCheckbox110">
                                        <label class="form-check-label" for="exampleCheckbox110"><span>{{ __('frontend.New') }}</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox"
                                               {{ request()->input('condition') == 'hot' ? 'checked' : '' }}
                                               onclick="handleFilterClick('condition', 'hot')"
                                               id="exampleCheckbox210">
                                        <label class="form-check-label" for="exampleCheckbox210"><span>{{ __('frontend.Hot') }}</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox"
                                               {{ request()->input('condition') == 'best_sale' ? 'checked' : '' }}
                                               onclick="handleFilterClick('condition', 'best_sale')"
                                               id="exampleCheckbox310">
                                        <label class="form-check-label" for="exampleCheckbox310"><span>{{ __('frontend.Best Sale') }}</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        function handleFilterClick(field, filterType) {
            let currentUrl = window.location.href;
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.delete(field); // Xóa tham số field trong URL (nếu có)
            if (urlParams.has(field)) {
                // Nếu tham số đã tồn tại trong URL, lấy giá trị hiện tại của tham số
                let currentFilterValue = urlParams.get(field);

                // Tách các giá trị thành một mảng
                let filterValues = currentFilterValue.split(',');

                if (filterValues.includes(filterType)) {
                    // Nếu giá trị đã tồn tại trong mảng, loại bỏ nó khỏi mảng
                    filterValues = filterValues.filter(value => value !== filterType);
                } else {
                    // Nếu giá trị chưa tồn tại trong mảng, thêm nó vào mảng
                    filterValues.push(filterType);
                }

                // Cập nhật giá trị mới cho tham số
                urlParams.set(field, filterValues.join(','));
            } else {
                // Nếu tham số chưa tồn tại trong URL, thêm tham số mới với giá trị là filterType
                urlParams.append(field, filterType);
            }

            // Xây dựng URL mới với các tham số đã được cập nhật
            let newUrl = currentUrl.split('?')[0] + '?' + urlParams.toString();
            history.pushState(null, '', newUrl); // Thay đổi URL của trang
            location.reload();
        }

        function clearAllFilters() {
            let currentUrl = window.location.href;
            let baseUrl = currentUrl.split('?')[0]; // Lấy phần đầu của URL (không bao gồm tham số)

            history.pushState(null, '', baseUrl); // Thay đổi URL của trang về baseUrl
            location.reload(); // Tải lại trang để áp dụng URL mới
        }
    </script>
@endpush

