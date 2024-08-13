<main class="main">
    <section class="home-slider position-relative pt-50">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
            @foreach ($banners as $banner)
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">{{ $banner->header_title }}</h4>
                                    <h2 class="animated fw-900">{{ $banner->title }}</h2>
                                    <h1 class="animated fw-900 text-brand">{{ $banner->sub_title }}</h1>
                                    <p class="animated">{!! $banner->description !!}</p>
                                    <a class="animated btn btn-brush btn-brush-3" href="{{ route('shop') }}">{{ __('frontend.Shop Now') }}</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="{{ $banner->image_url }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>
    <section class="featured section-padding position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/feature-1.png') }}" alt="">
                        <h4 class="bg-1"> {{ __('frontend.Free Shipping') }}</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/feature-2.png') }}" alt="">
                        <h4 class="bg-3">{{ __('frontend.Online Order') }}</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/feature-3.png') }}" alt="">
                        <h4 class="bg-2">{{ __('frontend.Save Money') }}</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/feature-4.png') }}" alt="">
                        <h4 class="bg-4">{{ __('frontend.Promotion') }}</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/feature-5.png') }}" alt="">
                        <h4 class="bg-5">{{ __('frontend.Happy Sell') }}</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/feature-6.png') }}" alt="">
                        <h4 class="bg-6">{{ __('frontend.24/7 Support') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                            type="button" role="tab" aria-controls="tab-one"
                            aria-selected="true">{{ __('frontend.New') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                            type="button" role="tab" aria-controls="tab-two"
                            aria-selected="false">{{ __('frontend.Hot') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three"
                            type="button" role="tab" aria-controls="tab-three"
                            aria-selected="false">{{ __('frontend.Best Sale') }}
                        </button>
                    </li>
                </ul>
                <a href="{{ route('shop') }}" class="view-more d-none d-md-flex">{{ __('frontend.View More') }}<i
                        class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @foreach ($productNews as $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.detail', $product->id) }}">
                                                <img class="default-img" src="{{ $product->thumbnail_url }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="View" class="action-btn hover-up"
                                                href="{{ route('product.detail', $product->id) }}"><i
                                                    class="fi-rs-search"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">{{ __('frontend.New') }}</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{ $product->productCategory->id }}">{{ $product->productCategory->name }}
                                            </a>
                                        </div>
                                        <h2><a
                                                href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                        </h2>
                                        <div class="product-price">
                                            @if (productDiscount($product->price, $product->discount) < $product->price)
                                                <span
                                                    class="a">{{ productDiscount($product->price, $product->discount) }}
                                                    đ</span>
                                                <span class="old-price">{{ formatPrice($product->price) }} đ</span>
                                            @else
                                                <span>{{ formatPrice($product->price) }} đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--End product-grid-4-->
                </div>
            <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                    <div class="row product-grid-4">
                        @foreach ($productHot as $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.detail', $product->id) }}">
                                                <img class="default-img" src="{{ $product->thumbnail_url }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="View" class="action-btn hover-up"
                                                href="{{ route('product.detail', $product->id) }}"><i
                                                    class="fi-rs-search"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{ $product->productCategory->id }}">{{ $product->productCategory->name }}
                                            </a>
                                        </div>
                                        <h2><a
                                                href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                        </h2>
                                        <div class="product-price">
                                            @if (productDiscount($product->price, $product->discount) < $product->price)
                                                <span
                                                    class="a">{{ productDiscount($product->price, $product->discount) }}
                                                    đ</span>
                                                <span class="old-price">{{ formatPrice($product->price) }} đ</span>
                                            @else
                                                <span>{{ formatPrice($product->price) }} đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--End product-grid-4-->
                </div>
            <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                    <div class="row product-grid-4">
                        @foreach ($productBestSeller as $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.detail', $product->id) }}">
                                                <img class="default-img" src="{{ $product->thumbnail_url }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="View" class="action-btn hover-up"
                                                href="{{ route('product.detail', $product->id) }}"><i
                                                    class="fi-rs-search"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale">{{ __('frontend.Best Sale') }}</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{ $product->productCategory->id }}">{{ $product->productCategory->name }}
                                            </a>
                                        </div>
                                        <h2><a
                                                href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                        </h2>
                                        <div class="product-price">
                                            @if (productDiscount($product->price, $product->discount) < $product->price)
                                                <span
                                                    class="a">{{ productDiscount($product->price, $product->discount) }}
                                                    đ</span>
                                                <span class="old-price">{{ formatPrice($product->price) }} đ</span>
                                            @else
                                                <span>{{ formatPrice($product->price) }} đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <section class="popular-categories section-padding mt-15 mb-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>{{ __('frontend.Popular Categories') }}</span></h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows">
                </div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    @foreach ($categories as $category)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{ route('shop') }}"><img src="{{ $category->image_url }}"
                                        alt=""></a>
                            </figure>
                            <h5><a href="{{ route('shop') }}">{{ $category->name }}</a></h5>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>
    <section class="banners mb-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow fadeIn animated">
                        <img src="{{ asset('frontend/assets/imgs/banner/banner-1.png') }}" alt="">
                        <div class="banner-text">
                            <span>{{ __('frontend.Smart Offer') }}</span>
                            <h4>{{ __('frontend.Save to up 20% on Woman Bag') }}</h4>
                            <a href="{{ route('shop') }}">{{ __('frontend.Shop Now') }} <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow fadeIn animated">
                        <img src="{{ asset('frontend/assets/imgs/banner/banner-2.png') }}" alt="">
                        <div class="banner-text">
                            <span>{{ __('frontend.Sale off') }}</span>
                            <h4>{{ __('frontend.Great Summer Collection') }}</h4>
                            <a href="{{ route('shop') }}">{{ __('frontend.Shop Now') }} <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img wow fadeIn animated  mb-sm-0">
                        <img src="{{ asset('frontend/assets/imgs/banner/banner-3.png') }}" alt="">
                        <div class="banner-text">
                            <span>{{ __('frontend.New Arrivals') }}</span>
                            <h4>{{ __('frontend.Shop Today’s Deals & Offers') }}</h4>
                            <a href="{{ route('shop') }}">{{ __('frontend.Shop Now') }}<i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>{{ __('frontend.New Arrivals') }}</span></h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows">
                </div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    @foreach ($products as $product)
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product.detail', $product->id) }}">
                                        <img class="default-img" src="{{ $product->thumbnail_url }}" alt="">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="View" class="action-btn small hover-up"
                                        href="{{ route('product.detail', $product->id) }}" tabindex="0"><i
                                            class="fi-rs-search"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($product->condition == 'new')
                                        <span class="new">{{ __('frontend.New') }}</span>
                                    @elseif($product->condition == 'best_sale')
                                        <span class="sale">{{ __('frontend.Best Sale') }}</span>
                                    @else
                                        <span class="hot">{{ __('frontend.Hot') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                </h2>
                                <div class="rating-result" title="90%">
                                    <span>
                                    </span>
                                </div>
                                <div class="product-price">
                                    @if ($product->discount > 0)
                                        <span>{{ productDiscount($product->price, $product->discount) }} đ</span>
                                    @endif
                                    <span
                                        class="@if ($product->discount > 0) old-price @endif">{{ formatPrice($product->price) }}
                                        đ</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--End product-cart-wrap-2-->
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <h3 class="section-title mb-20 wow fadeIn animated"><span>{{ __('frontend.Featured Brands') }}</span></h3>
            <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows">
                </div>
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-1.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-2.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-3.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-4.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-5.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-6.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('frontend/assets/imgs/banner/brand-3.png') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container pt-25 pb-20">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="section-title mb-20"><span>{{ __('frontend.From the Blog') }}</span></h3>
                    <div class="post-list mb-4 mb-lg-0">
                        @foreach ($blogs as $blog)
                        @if ($loop->index < 2)
                            <article class="wow fadeIn animated">
                                <div class="d-md-flex d-block">
                                    <div class="post-thumb d-flex mr-15">
                                        <a class="color-white" href="{{ route('blog.detail', $blog->id) }}">
                                            <img src="{{ $blog->thumbnail_url }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <div class="entry-meta mb-10 mt-10">
                                            <a class="entry-meta meta-2"
                                                href="{{ route('blog.detail', $blog->id) }}"><span
                                                    class="post-in font-x-small">{{ $blog->postCategory->name }}</span></a>
                                        </div>
                                        <h4 class="post-title mb-25 text-limit-2-row">
                                            <a
                                                href="{{ route('blog.detail', $blog->id) }}">{!! $blog->excerpt !!}</a>
                                        </h4>
                                        <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                            <div>
                                                <span
                                                    class="post-on">{{ $blog->created_at->format('d/m/y H:i') }}</span>
                                            </div>
                                            <a
                                                href="{{ route('blog.detail', $blog->id) }}">{{ __('frontend.Read More') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="banner-img banner-1 wow fadeIn animated">
                                <img src="{{ asset('frontend/assets/imgs/banner/banner-5.jpg') }}" alt="">
                                <div class="banner-text">
                                    <span>{{ __('frontend.Accessories') }}</span>
                                    <h4>{{ __('frontend.Save to up 17% on Autumn Hat') }}</h4>
                                    <a href="{{ route('shop') }}">{{ __('frontend.Shop Now') }} <i
                                            class="fi-rs-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner-img mb-15 wow fadeIn animated">
                                <img src="{{ asset('frontend/assets/imgs/banner/banner-6.jpg') }}" alt="">
                                <div class="banner-text">
                                    <span>{{ __('frontend.Big Offer') }}</span>
                                    <h4>{{ __('frontend.Save to up 20% onWomen is socks') }}</h4>
                                    <a href="{{ route('shop') }}">{{ __('frontend.Shop Now') }} <i
                                            class="fi-rs-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="banner-img banner-2 wow fadeIn animated">
                                <img src="{{ asset('frontend/assets/imgs/banner/banner-7.jpg') }}" alt="">
                                <div class="banner-text">
                                    <span>{{ __('frontend.Smart Offer') }}</span>
                                    <h4>{{ __('frontend.Save to up 20% on Eardrop') }}</h4>
                                    <a href="{{ route('shop') }}">{{ __('frontend.Shop Now') }} <i
                                            class="fi-rs-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner-bg wow fadeIn animated"
                        style="background-image: url('{{ asset('frontend/assets/imgs/banner/banner-8.jpg') }}')">
                        <div class="banner-content">
                            <h5 class="text-grey-4 mb-15">{{ __('frontend.Shop Today’s Deals') }}</h5>
                            <h2 class="fw-600">{{ __('frontend.Happy Mother is Day Big Sale Up to 40%') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
