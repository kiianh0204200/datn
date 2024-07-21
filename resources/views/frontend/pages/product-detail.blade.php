@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('frontend.home')}}" rel="nofollow">{{ __('frontend.Home') }}</a>
                    <span></span> {{$product->productCategory->name}}
                    <span></span> {{$product->name}}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @foreach($product->productImages as $image)
                                                <figure class="border-radius-10">
                                                    <img src="{{ $image->image_url }}" alt="product image">
                                                </figure>
                                            @endforeach
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">
                                            @foreach($product->productImages as $image)
                                                <div><img src="{{ $image->image_url }}" alt="product image">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{$product->name}}</h2>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                @if(productDiscount($product->price, $product->discount) < $product->price)
                                                    <ins><span class="text-brand">{{productDiscount($product->price,
                                                        $product->discount)}} đ</span></ins>
                                                    <ins><span class="old-price font-md ml-15">{{formatPrice($product->price)}}đ</span>
                                                    </ins>
                                                    <span class="save-price font-md color3 ml-15">{{formatPrice($product->discount)}} %Off</span>
                                                @else
                                                    <span class="font-md color3 ml-15">{{formatPrice($product->price)}} đ</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p>{!! $product->subtitle !!}</p>
                                        </div>
                                        <div class="product_sort_info font-xs mb-30">
                                            <ul>
                                                <li class="mb-10"><i class="fi-rs-crown mr-5"></i> {{ __('frontend.1 Year Brand Warranty') }}
                                                </li>
                                                <li class="mb-10"><i class="fi-rs-refresh mr-5"></i>{{ __('frontend.30 Day Return Policy') }}
                                                </li>
                                                <li><i class="fi-rs-credit-card mr-5"></i> {{ __('frontend.Cash on Delivery available') }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="attr-detail attr-color mb-15">
                                            <strong class="mr-10">{{ __('frontend.Color') }}</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach($product->productOptionValueColor as $color)
                                                    <li><a href="#" data-color="{{$color->id}}"
                                                           data-value="{{$color->id}}"
                                                           data-product="{{$product->id}}"><span
                                                                class="product-color-{{strtolower($color->name)}}"></span></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="attr-detail attr-size">
                                            <strong class="mr-10">{{ __('frontend.Size') }}</strong>
                                            <ul class="list-filter size-filter font-small">
                                                <li><a href="#">S</a></li>
                                                <li class="active"><a data-size="" href="#">M</a></li>
                                                <li><a href="#" data-size="">L</a></li>
                                                <li><a href="#" data-size="">XL</a></li>
                                                <li><a href="#" data-size="">XXL</a></li>
                                            </ul>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">
                                            <div class="border radius">
                                                <input type="number" class="form-control input-sm qty-value"
                                                       id="inputsm"
                                                       value="1">
                                            </div>
                                            <div class="product-extra-link2">
                                                <button type="submit" class="button button-add-to-cart">{{ __('frontend.Add to cart') }}
                                                </button>
                                            </div>
                                        </div>
                                        <ul class="product-meta font-xs color-grey mt-50">
                                            <li class="mb-5">SKU: <a href="#">{{$product->sku}}</a></li>
                                            <li>{{ __('frontend.Availability') }}:<span class="in-stock text-success ml-5">8 {{ __('frontend.Item In Stock') }}</span></li>
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 m-auto entry-main-content">
                                    <h2 class="section-title style-1 mb-30">{{ __('frontend.Description') }}</h2>
                                    <div class="description mb-50">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                    <div class="social-icons single-share">
                                        <ul class="text-grey-5 d-inline-block">
                                            <li><strong class="mr-10">{{ __('frontend.Share this') }}:</strong></li>
                                            <li class="social-facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a></li>
                                            <li class="social-twitter"> <a href="https://twitter.com/intent/tweet?text={{ $product->name }}&url={{ url()->current() }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a></li>
                                            <li class="social-instagram"><a href="https://www.instagram.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $product->name }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a></li>
                                            <li class="social-linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $product->name }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <h3 class="section-title style-1 mb-30 mt-30">{{ __('frontend.Reviews') }} {{count($comments)}}</h3>
                                    <!--Comments-->
                                    <div class="comments-area style-2">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">{{ __('frontend.Customer questions & answers') }}</h4>
                                                <div class="comment-list">
                                                    @foreach($comments as $comment)
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img
                                                                        src="{{ asset('frontend/assets/imgs/page/avatar-6.jpg') }}"
                                                                        alt="">
                                                                    <h6><a href="#">{{$comment->name}}</a></h6>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating"
                                                                             style="width: {{convertRatingToPercentage($comment->rating)}}%">
                                                                        </div>
                                                                    </div>
                                                                    <p>{{$comment->messages}}</p>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">
                                                                                {{$comment->created_at->format('d-m-Y H:i')}}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--single-comment -->
                                                    @endforeach
                                                    {{$comments->links()}}
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">{{ __('frontend.Customer reviews') }}</h4>
                                                @if (count($ratings) == 0)
                                                    <div class="progress">
                                                        <span>{{ __('frontend.No rating') }}</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                                                        </div>
                                                    </div>
                                                @else
                                                    @php
                                                        $rating = calculateRatingPercentage($ratings);
                                                    @endphp
                                                    <div>
                                                        @for ($i = 5; $i >= 1; $i--)
                                                            <div class="progress">
                                                                <span>{{ $i }} {{ __('frontend.stars') }}</span>
                                                                <div class="progress-bar" role="progressbar"
                                                                     style="width: {{ $rating[$i-1] }}%;"
                                                                     aria-valuenow="{{ $rating[$i-1] }}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100">{{ $rating[$i-1] }}%
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                @endif
                                                <a href="#" class="font-xs text-muted">{{ __('frontend.How are ratings calculated?') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    @auth()
                                        <!--comment form-->
                                        <div class="comment-form">
                                            <h4 class="mb-15">{{ __('frontend.Add a review') }}</h4>
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <form method="post" action="{{route('product.comment.store')}}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="personal-rating">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rating"
                                                                           value="5"/>
                                                                    <label for="star5" title="text">5 {{ __('frontend.stars') }}</label>
                                                                    <input type="radio" id="star4" name="rating"
                                                                           value="4"/>
                                                                    <label for="star4" title="text">4 {{ __('frontend.stars') }}</label>
                                                                    <input type="radio" id="star3" name="rating"
                                                                           value="3"/>
                                                                    <label for="star3" title="text">3 {{ __('frontend.stars') }}</label>
                                                                    <input type="radio" id="star2" name="rating"
                                                                           value="2"/>
                                                                    <label for="star2" title="text">2 {{ __('frontend.stars') }}</label>
                                                                    <input type="radio" id="star1" name="rating"
                                                                           value="1"/>
                                                                    <label for="star1" title="text">1 {{ __('frontend.stars') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                            <textarea class="form-control w-100" name="comment"
                                                                      id="comment" cols="30" rows="9"
                                                                      placeholder="Write Comment">{{old('comment')}}</textarea>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="product_id"
                                                                   value="{{$product->id}}">
                                                            <div class="form-group col-md-6">
                                                                <label>{{ __('frontend.Name') }} <span class="required">*</span></label>
                                                                <input required=""
                                                                       class="form-control square @error('name') is-invalid @enderror"
                                                                       value="{{old('name')}}" name="name">
                                                                @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>{{ __('frontend.Email Address') }} <span
                                                                        class="required">*</span></label>
                                                                <input required=""
                                                                       class="form-control square @error('email') is-invalid @enderror"
                                                                       name="email" value="{{old('email')}}"
                                                                       type="email">
                                                                @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-fill-out submit"
                                                                        name="submit" value="Submit">{{ __('frontend.Save') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endauth
                                    @guest()
                                        <div class="comment-form">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">{{ __('frontend.Please login to review') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">{{ __('frontend.Related products') }}</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @foreach($relatedProducts as $relatedProduct)
                                            <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{route('product.detail', $relatedProduct->id)}}">
                                                                <img class="default-img"
                                                                     src="{{ $relatedProduct->thumbnail_url }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="product-action-1">
                                                            <a aria-label="View" class="action-btn hover-up"
                                                               href="{{route('product.detail', $relatedProduct->id)}}"><i
                                                                    class="fi-rs-search"></i></a>
                                                        </div>
                                                        <div
                                                            class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">{{$relatedProduct->condition}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category">
                                                            <a href="{{$relatedProduct->productCategory->id}}">{{$relatedProduct->productCategory->name}}
                                                            </a>
                                                        </div>
                                                        <h2><a
                                                                href="{{route('product.detail', $relatedProduct->id)}}">{{$relatedProduct->name}}</a>
                                                        </h2>
                                                        <div class="product-price">
                                                            @if(productDiscount($relatedProduct->price,
                                                            $relatedProduct->discount) < $relatedProduct->price)
                                                                <span class="a">{{productDiscount($relatedProduct->price,
                                                            $relatedProduct->discount)}}đ</span>
                                                                <span
                                                                    class="old-price">{{formatPrice($relatedProduct->price)}} đ</span>
                                                            @else
                                                                <span>{{formatPrice($relatedProduct->price)}} đ</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="banner-img banner-big wow fadeIn f-none animated mt-50">
                                <img class="border-radius-10"
                                     src="{{ asset('frontend/assets/imgs/banner/banner-4.png') }}"
                                     alt="">
                                <div class="banner-text">
                                    <h4 class="mb-15 mt-40">{{ __('frontend.Repair Services') }}</h4>
                                    <h2 class="fw-600 mb-20">{{ __('frontend.We are an Apple Authorised Service Provider') }}</h2>
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
        $(document).ready(function () {
            // Xử lý sự kiện khi người dùng click vào một phần tử trong danh sách kích thước thì lấy giá theo size
            $('.size-filter').on('click', 'a', function (e) {
                let url = "{{ route('product.detail.size.price') }}";
                e.preventDefault();

                // Khi người dùng click vào một phần tử trong danh sách kích thước
                // thì đặt lớp active cho phần tử đó và xoá toàn bộ class đang được ative của các phần tử khác
                $(this).parent().addClass('active').siblings().removeClass('active');

                let sizeId = $(this).data('size');
                let productId = $(this).data('product');
                $.ajax({
                    type: 'GET',
                    url: url, // Đường dẫn tới route xử lý AJAX
                    data: {size_id: sizeId, product_id: productId},
                    success: function (response) {
                        $(this).addClass('active');
                        // Xử lý kết quả trả về từ server, ví dụ: cập nhật giá sản phẩm
                        let productPrice = $('.product-price');
                        let priceSale = $('.text-brand');
                        let oldPrice = $('.old-price');
                        let savePrice = $('.save-price');
                        let salePrice = {{$product->discount ?? 0}};
                        let stock = $('.in-stock');
                        let salePriceValue = response.data.price - (response.data.price * salePrice / 100)
                        // Cập nhật giá sản phẩm theo kích thước
                        if (salePriceValue < response.data.price) {
                            // Nếu sale / price < 0 thì giá sản phẩm = price - (price * sale / 100)
                            let total = response.data.price - (response.data.price * salePrice / 100);
                            let formattedTotal = total.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                            priceSale.text(formattedTotal);

                            let formattedPrice = response.data.price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                            oldPrice.text(response.data.formattedPrice);
                            savePrice.text(salePrice + ' % Off');
                        } else {
                            // Nếu sale / price > 0 thì giá sản phẩm = price - sale
                            let total = response.data.price - salePrice;
                            productPrice.text(response.data.total);
                        }
                        stock.text(response.data.in_stock + ' {{ __('frontend.Item In Stock') }}');
                    }
                });
            });

            // Xử lý sự kiện khi người dùng click vào một phần tử trong danh sách màu sắc
            $('.color-filter').on('click', 'a', function (e) {
                e.preventDefault();
                $(this).parent().addClass('active').siblings().removeClass('active');
                let url = "{{ route('product.detail.size') }}";
                let colorId = $(this).data('color');
                let productId = $(this).data('product');
                let sizeList = $('.size-filter');
                $.ajax({
                    type: 'GET',
                    url: url, // Đường dẫn tới route xử lý AJAX
                    data: {color_id: colorId, product_id: productId},
                    success: function (response) {
                        // Xử lý kết quả trả về từ server, ví dụ: cập nhật danh sách kích thước
                        sizeList.empty();
                        $.each(response.data, function (index, size) {
                            if (size.in_stock === 0) {
                                return;
                            }

                            let liClass = index === 0 ? 'active' : ''; // Đặt lớp active cho phần tử đầu tiên
                            let liElement = `
                                   <li class="${liClass}">
                                    <a href="#" data-size="${size.size_id}" data-product="${productId}">${size.size.name}</a>
                                </li>
                            `
                            sizeList.append(liElement); // Thêm phần tử kích thước vào danh sách
                        });
                    }
                });
            });

            // Xu ly su kien khi nguoi dung click vao nut add to cart thi them vao gio hang
            $('.button-add-to-cart').on('click', function (e) {
                e.preventDefault();
                let url = "{{ route('cart.add') }}";
                let productId = {{$product->id}};
                let sizeId = $('.size-filter li.active a').data('size');
                let colorId = $('.color-filter li.active a').data('color');

                let quantity = $('.qty-value').val();
                $.ajax({
                    type: 'POST',
                    url: url, // Đường dẫn tới route xử lý AJAX
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Xác thực token để tránh bị lỗi 419
                    },
                    data: {product_id: productId, size: sizeId, color: colorId, quantity: quantity},
                    success: function (response) {
                        location.reload();
                        toastr.success(response.message);
                    },
                    error: function (response) {
                        toastr.error(response.responseJSON.message);
                    }
                });
            });

        });
    </script>
@endpush
