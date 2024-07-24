<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><i class="fi-rs-smartphone"></i> <a href="#">(+01) - 2345 - 6789</a></li>
                            <li action="{{route('product.track.order')}}" method="post" novalidate="novalidate">
                                @csrf
                                  <a class="language-dropdown-active" href="{{route('order.track')}}"
                                      <i class="fi-rs-truck"></i>{{ __('frontend.Track Order') }}
                                  </a>
                                  <li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    {{-- <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Get great devices up to 50% off <a href="/shop">View details</a>
                                </li>
                                <li>Trendy 25silver jewelry, save up 35% off today <a
                                        href="/shop">Shop now</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>
                                <a class="language-dropdown-active">
                                    <i class="fi-rs-world"></i>
                                    @if(app()->getLocale() == 'vi')
                                        Tiếng Việt
                                    @elseif(app()->getLocale() == 'en')
                                        English
                                    @endif
                                    <i class="fi-rs-angle-small-down"></i>
                                </a>
                                <ul class="language-dropdown">
                                    <li><a href="locale/vi">Tiếng Việt</a></li>
                                    <li><a href="locale/en">English</a></li>
                                </ul>
                            </li>
                            <li>
                                @if(!auth()->user())
                                    <i class="fi-rs-user"></i><a class="lang-curr-dropdown" href="/login">{{ __('frontend.Login') }}</a>
                                @else
                                <a class="language-dropdown-active" href="#">{{auth()->user()->name}}</a>
                                    <ul class="language-dropdown">
                                        <li><a href="{{route('frontend.logout')}}">{{ __('frontend.Logout') }}</a></li>
                                    </ul>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{route('frontend.home')}}"><h4>Golden Era</h4></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{route('shop')}}">
                            <input type="text" placeholder="{{ __('frontend.Search for items') }}..." name="name">
                            <button type="submit">{{ __('frontend.Search') }}</button>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="/cart">
                                    <img alt="Evara"
                                         src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                                    <span class="pro-count blue">{{\Cart::content()->count()}}</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        @foreach(\Cart::content() as $cart)
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="/product-detail"><img alt="Evara" src="{{asset('uploads/products/' . $cart->options->image)}}"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="/product-detail">{{$cart->name}}</a></h4>
                                                    <h3><span>{{$cart->qty}} × </span>{{formatPrice($cart->price)}} đ</h3>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#" class="clear-cart"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>{{ __('frontend.Total') }} <span>{{formatPrice(\Cart::total())}} đ</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="/cart" class="outline">{{ __('frontend.View Cart') }}</a>
                                            <a href="/checkout">{{ __('frontend.Checkout') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{route('frontend.home')}}">Golden Era</a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categori-button-active" href="#">
                            <span class="fi-rs-apps"></span> {{ __('frontend.Browse Categories') }}
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-large">
                            <ul>
                                @foreach($categories as $category)
                                    @if($category->children->count() > 0)
                                        <li class="has-children">
                                            <a href="{{route('shop')}}?category={{$category->id}}">{{$category->name}}</a>
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu d-lg-flex">
                                                    <li class="mega-menu-col col-lg-7">
                                                        <ul class="d-lg-flex">
                                                            <li class="mega-menu-col col-lg-6">
                                                                <ul>
                                                                    @foreach($category->children as $child)
                                                                        @if($child->parent_id)
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item"
                                                                                   href="{{route('shop')}}?category={{$child->id}}">{{$child->name}}</a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @else
                                        <li><a href="{{route('shop')}}?category={{$category->id}}">{{$category->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li><a class="active" href="/">{{ __('frontend.Home') }}</a>
                                </li>
                                <li>
                                    <a href="/about-us">{{ __('frontend.About') }}</a>
                                </li>
                                <li><a href="{{route('shop')}}">{{ __('frontend.Shop') }}</a>
                                </li>
                                <li><a href="/blog">{{ __('frontend.Post') }}</a></li>
                                <li>
                                    <a href="/contact">{{ __('frontend.Contact') }}</a>
                                </li>
                                <li><a href="{{route('frontend.user.index')}}">{{ __('frontend.My Account') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p><i class="fi-rs-headset"></i><span>Hotline</span> 1900 - 888 </p>
                </div>
                <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%
                </p>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        {{-- <div class="header-action-icon-2">
                            <a href="shop-wishlist.html">
                                <img alt="Evara"
                                     src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}">
                                <span class="pro-count white">4</span>
                            </a>
                        </div> --}}
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="/cart">
                                <img alt="Evara"
                                     src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                                <span class="pro-count blue">{{\Cart::content()->count()}}</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    @foreach(\Cart::content() as $cart)
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="/product-detail"><img alt="Evara" src="{{asset('uploads/products/' . $cart->options->image)}}"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="/product-detail">{{$cart->name}}</a></h4>
                                                <h3><span>{{$cart->qty}} × </span>{{formatPrice($cart->price)}} đ</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#" class="clear-cart"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>{{ __('frontend.Total') }} <span>{{formatPrice(\Cart::total())}} đ</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="/cart" class="outline">{{ __('frontend.View Cart') }}</a>
                                        <a href="/checkout">{{ __('frontend.Checkout') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="={{route('frontend.home')}}">Golden Era</a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{route('shop')}}">
                    <input type="text" placeholder="{{ __('frontend.Search for items') }}..." name="name">
                    <button type="submit">{{ __('frontend.Search') }}</button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span>{{ __('frontend.Browse Categories') }}
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            @foreach($categories as $category)
                                @if($category->children->count() > 0)
                                    <li class="has-children">
                                        <a href="{{route('shop')}}?category={{$category->id}}"><i
                                                class="evara-font-dress"></i>{{$category->name}}</a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        <li class="mega-menu-col col-lg-6">
                                                            <ul>
                                                                @foreach($category->children as $child)
                                                                    @if($child->parent_id)
                                                                        <li>
                                                                            <a class="dropdown-item nav-link nav_item"
                                                                               href="{{route('shop')}}?category={{$child->id}}">{{$child->name}}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li><a href="{{route('shop')}}?category={{$category->id}}"></i>{{$category->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children active"><span class="menu-expand"></span><a
                                href="/">{{ __('frontend.Home') }}</a>
                        </li>
                        <li><a href="{{route('shop')}}">{{ __('frontend.Shop') }}</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="/blog">{{ __('frontend.Post') }}</a>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="#">{{ __('frontend.Pages') }}</a>
                            <ul class="dropdown">
                                <li><a href="/about">{{ __('frontend.About') }}</a></li>
                                <li><a href="/contact">{{ __('frontend.Contact') }}</a></li>
                                <li><a href="/my-account">{{ __('frontend.My Account') }}</a></li>
                                @if(!auth()->user())
                                    <li><a href="/login">{{ __('frontend.Login') }}</a></li>
                                @else
                                    <li><a href="{{route('frontend.logout')}}">{{ __('frontend.Logout') }}</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="#">{{ __('frontend.Language') }}</a>
                            <ul class="dropdown">
                                <li><a href="locale/vi">Tiếng Việt</a></li>
                                <li><a href="locale/en">English</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a href="/contact"> {{ __('frontend.Our location') }} </a>
                </div>
                <div class="single-mobile-header-info">
                    @if(!auth()->user())
                    <a href="/login">{{ __('frontend.Log In / Sign Up') }}</a>
                    @else
                    <a href="{{route('frontend.user.index')}}">{{ __('frontend.My Account') }}</a>
                    @endif
                </div>
                <div class="single-mobile-header-info">
                    <a href="#">(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div action="{{route('product.track.order')}}" method="post" novalidate="novalidate" class="mobile-social-icon">
                    @csrf
                      <a class="mb-15 text-grey-4" href="{{route('order.track')}}">
                          {{ __('frontend.Track Order') }}
                      </a>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script>
    $(document).ready(function (){
        $('.clear-cart').click(function (e) {
                e.preventDefault();

                let url = "{{route('cart.clear')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        location.reload();
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.message);
                    }
                })
            })
    })
</script>

@endpush
