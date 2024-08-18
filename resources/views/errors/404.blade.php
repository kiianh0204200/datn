@extends('frontend.layouts.master')

@section('content')

<main class="main page-404">
    <div class="container">
        <div class="row align-items-center height-100vh text-center">
            <div class="col-lg-8 m-auto">
                <p class="mb-50"><img src="{{ asset('frontend/assets/imgs/theme/404.png') }}" alt="" class="hover-up"></p>
                <h2 class="mb-30">{{ __('frontend.Page Not Found') }}</h2>
                <p class="font-lg text-grey-700 mb-30">
                    {{ __('frontend.The link you clicked may be broken or the page may have been removed.') }}
                </p>
                <form class="contact-form-style text-center" id="contact-form" action="#" method="post">
                    <div class="row">
                    </div>
                    <a class="btn btn-default submit-auto-width font-xs hover-up" href="/">{{ __('frontend.Back To Home Page') }}</a>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
