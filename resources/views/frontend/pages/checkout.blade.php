@php use Gloudemans\Shoppingcart\Cart; @endphp
@extends('frontend.layouts.master')

@section('content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">{{ __('frontend.Home') }}</a>
                <span></span> Shop
                <span></span> {{ __('frontend.Checkout') }}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50"></div>
                </div>
            </div>
            <form id="checkout-form" method="post" action="{{ route('frontend.checkout.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>{{ __('frontend.Billing Details') }}</h4>
                        </div>
                        <div class="form-group">
                            <input required type="text" name="email" placeholder="Email address *"
                                   value="{{ auth()->user()->email }}">
                        </div>
                        <div class="form-group">
                            <input type="text" required name="name" value="{{ auth()->user()->name }}"
                                   placeholder="First name *">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" required
                                   placeholder="{{ __('frontend.Address') }} *" value="{{ auth()->user()->address }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address_2"
                                   placeholder="{{ __('frontend.Address') }} line2"
                                   value="{{ auth()->user()->address_2 }}">
                        </div>
                        <div class="form-group">
                            <input required type="text" name="phone" placeholder="{{ __('frontend.Phone') }} *"
                                   value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="mb-20">
                            <h5>{{ __('frontend.Additional information') }}</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" name="notes" placeholder="{{ __('frontend.Order notes') }}"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>{{ __('frontend.Your Orders') }}</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2">{{ __('frontend.Product') }}</th>
                                        <th>{{ __('frontend.Size') }}</th>
                                        <th>{{ __('frontend.Color') }}</th>
                                        <th>{{ __('frontend.Total') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td class="image product-thumbnail"><img
                                                    src="{{ asset('uploads/products/' . $cart->options->image) }}"
                                                    alt="#"></td>
                                            <td>
                                                <h5>
                                                    <a href="{{ route('product.detail', $cart->id) }}">{{$cart->name}}</a>
                                                </h5> <span class="product-qty">x {{$cart->qty}}</span>
                                            </td>
                                            <td>{{$cart->options->size}}</td>
                                            <td>{{$cart->options->color}}</td>
                                            <td>{{ formatPrice($cart->price) }} đ</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>{{ __('frontend.Total') }}</th>
                                        <td colspan="2" class="product-subtotal"><span
                                                class="font-xl text-brand fw-900" id="total-amount">{{ formatPrice(\Cart::subTotal()) }} đ</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-25">
                                <h5>{{ __('frontend.Apply Voucher') }}</h5>
                                <div class="form-group">
                                    <input type="text" id="voucher_code" name="voucher_code" placeholder="Enter voucher code">
                                    <button type="button" id="apply-voucher" class="btn btn-fill-out btn-block ">{{ __('frontend.Apply') }}</button>
                                </div>
                                <div id="discount-info"></div>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>{{ __('frontend.Payment') }}</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <select class="form-select" name="payment_method">
                                            <option value="VnPay">Vn Pay</option>
                                            <option value="Ship cod">{{ __('frontend.Ship code') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">{{ __('frontend.Place Order') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    document.getElementById('apply-voucher').addEventListener('click', function() {
        var voucherCode = document.getElementById('voucher_code').value;
    
        fetch("{{ route('voucher.apply') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ voucher_code: voucherCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('discount-info').innerHTML = 
                    `<p>Discount: ${data.discount_amount} đ</p>
                     <p>Total after discount: ${data.total_amount} đ</p>`;
                document.getElementById('total-amount').textContent = data.total_amount + ' đ';
            } else {
                document.getElementById('discount-info').innerHTML = 
                    `<p style="color: red;">${data.message}</p>`;
            }
        });
    });
    </script>
    

@endsection

