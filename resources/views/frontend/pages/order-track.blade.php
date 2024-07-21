@extends('frontend.layouts.master')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">{{ __('frontend.Home') }}</a>
                    <span></span> {{ __('frontend.Pages') }}
                    <span></span> {{ __('frontend.Track Order') }}
                </div>
            </div>
        </div>
        <section class="pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="contact-from-area padding-20-row-col wow FadeInUp">
                            <form action="{{route('product.track.order')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-style mb-20">
                                            <input name="order_id" placeholder="Tracking Order Id" type="text">
                                            <button class="text-center" type="submit"
                                                    value="submit">{{ __('frontend.Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
