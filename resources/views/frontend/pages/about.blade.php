@extends('frontend.layouts.master')

@section('content')

<main class="main single-page">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">{{ __('frontend.Home') }}</a>
                <span></span> {{ __('frontend.Pages') }}
                <span></span> {{ __('frontend.About Us') }}
            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container pt-25">
            <div class="row">
                <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                    <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">{{ __('frontend.Our Company') }}</h6>
                    <h1 class="font-heading mb-40">
                        {{ __('frontend.We are Building The Destination For Getting Things Done') }}
                    </h1>
                    <p>{{ __('frontend.Launched in 2015, the commerce platform is built to provide users with an easy, safe and fast experience when shopping online through a strong payment and operations support system. We strongly believe that the online shopping experience should be simple, easy and enjoyable. This belief inspires and motivates us every day.') }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('frontend/assets/imgs/page/about-1.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="work" class="mt-40 pt-50 pb-50 section-border">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-12 col-md-12 text-center">
                    <h6 class="mt-0 mb-5 text-uppercase  text-brand font-sm wow fadeIn animated">{{ __('frontend.Evara Coporation') }}</h6>
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated">{{ __('frontend.Our main branches') }}<br> {{ __('frontend.around the world') }}</h2>
                    <p class="w-50 m-auto text-grey-3 wow fadeIn animated"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center mb-md-0 mb-4">
                    <img class="btn-shadow-brand hover-up border-radius-10 bg-brand-muted wow fadeIn animated" src="{{ asset('frontend/assets/imgs/page/company-1.jpg') }}" alt="">
                    <h4 class="mt-30 mb-15 wow fadeIn animated">Hanoi, Vietnam</h4>
                    <p class="text-grey-3 wow fadeIn animated">123 Tran Duy Hung St<br>Hanoi, Vietnam</p>
                </div>
                <div class="col-md-4 text-center mb-md-0 mb-4">
                    <img class="btn-shadow-brand hover-up border-radius-10 bg-brand-muted wow fadeIn animated" src="{{ asset('frontend/assets/imgs/page/company-2.jpg') }}" alt="">
                    <h4 class="mt-30 mb-15 wow fadeIn animated">Paris, France</h4>
                    <p class="text-grey-3 wow fadeIn animated">22 Rue des Carmes<br> 75005 Paris</p>
                </div>
                <div class="col-md-4 text-center">
                    <img class="btn-shadow-brand hover-up border-radius-10 bg-brand-muted wow fadeIn animated" src="{{ asset('frontend/assets/imgs/page/company-3.jpg') }}" alt="">
                    <h4 class="mt-30 mb-15 wow fadeIn animated">Jakarta, Indonesia</h4>
                    <p class="text-grey-3 wow fadeIn animated">2476 Raya Yogyakarta,<br>89090 Indonesia</p>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
