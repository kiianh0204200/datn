@extends('frontend.layouts.master')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">{{ __('frontend/Home') }}</a>
                <span></span> Shop
                <span></span> {{ __('frontend.Your Cart') }}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">{{ __('frontend.Image') }}</th>
                                    <th scope="col">{{ __('frontend.Name') }}</th>
                                    <th scope="col">{{ __('frontend.Size') }}</th>
                                    <th scope="col">{{ __('frontend.Color') }}</th>
                                    <th scope="col">{{ __('frontend.Price') }}</th>
                                    <th scope="col">{{ __('frontend.Quantity') }}</th>
                                    <th scope="col">{{ __('frontend.Subtotal') }}</th>
                                    <th scope="col">{{ __('frontend.Remove') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                                <tr>
                                    <td class="image product-thumbnail"><img src="{{asset('uploads/products/' . $cart->options->image)}}"
                                                                             alt="#"></td>
                                    <td class="product-des product-name">
                                        <h5 class="product-name"><a href="{{route('product.detail', $cart->id)}}">{{$cart->name}}</a></h5>
                                    </td>
                                    <td>{{$cart->options->size ?? ''}}</td>
                                    <td>{{$cart->options->color ?? ''}}</td>
                                    <td class="price" data-title="Price"><span>{{formatPrice($cart->price)}} đ</span></td>
                                    <td class="text-center" data-title="Stock">
                                        <div class="detail-qty border radius  m-auto">
                                            <a href="#" class="qty-down"><i
                                                    class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">{{$cart->qty}}</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <span>{{subTotal($cart->price, $cart->qty)}} đ</span>
                                    </td>
                                    <td class="action remove-cart" data-title="Remove" data-cart="{{$cart->rowId}}"><a href="#" class="text-muted"><i
                                                class="fi-rs-trash"></i></a></td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <a href="#" class="text-muted"> <i class="fi-rs-cross-small"></i>{{ __('frontend.Clear Cart') }}</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-action text-end">
                        <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>{{ __('frontend.Update Cart') }}</a>
                        <a class="btn" href="{{ route('shop') }}"><i class="fi-rs-shopping-bag mr-10"></i>{{ __('frontend.Continue Shopping') }}</a>
                    </div>
                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                    <div class="row mb-50">
                        <div class="col-lg-6 col-md-12">
                            <div class="border p-md-4 p-30 border-radius cart-totals">
                                <div class="heading_s1 mb-3">
                                    <h4>{{ __('frontend.Cart Totals') }}</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="cart_total_label">{{ __('frontend.Cart Subtotal') }}</td>
                                                <td class="cart_total_amount"><span
                                                        class="font-lg fw-900 text-brand">{{formatPrice(\Cart::subTotal()) }} đ</span></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">{{ __('frontend.Shipping') }}</td>
                                                <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>{{ __('frontend.Free Shipping') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">{{ __('frontend.Total') }}</td>
                                                <td class="cart_total_amount"><strong><span
                                                            class="font-xl fw-900 text-brand">{{formatPrice(\Cart::total())}} đ</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{route('checkout')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i>{{ __('frontend.Proceed to Checkout') }}</a>
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
            $('.remove-cart').click(function (e) {
                e.preventDefault();
                let cartId = $(this).data('cart');
                let url = '/cart/remove/' + cartId
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
            });

            $('.detail-qty').on('click', '.qty-up', function (e) {
                e.preventDefault();
                let qty = parseInt($(this).closest('td').find('.qty-val').text(), 10);
                let cartId = $(this).closest('tr').find('.remove-cart').data('cart');
                let url = "{{route('cart.update')}}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Xác thực token để tránh bị lỗi 419
                    },
                    data: {
                        qty: qty + 1,
                        cartId: cartId,
                        type: 'up'
                    },
                    success: function (response) {
                        location.reload();
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.message);
                    }
                })
            });

            $('.detail-qty').on('click', '.qty-down', function (e) {
                e.preventDefault();
                let qty = parseInt($(this).closest('td').find('.qty-val').text(), 10);
                let cartId = $(this).closest('tr').find('.remove-cart').data('cart');
                let url = "{{route('cart.update')}}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Xác thực token để tránh bị lỗi 419
                    },
                    data: {
                        qty: qty - 1,
                        cartId: cartId,
                        type: 'down'
                    },
                    success: function (response) {
                        location.reload();
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.message);
                    }
                })
            });

            $('.text-muted').click(function (e) {
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
