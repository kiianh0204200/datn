@extends('frontend.layouts.master')

@section('content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">{{ __('frontend.Home') }}</a>
                <span></span> {{ __('frontend.Pages') }}
                <span></span>{{ __('frontend.Register') }}
            </div>
        </div>
    </div>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-12">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">{{ __('frontend.Create an Account') }}</h3>
                                    </div>
                                    <p class="mb-50 font-sm">
                                        {{ __('frontend.Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.') }}
                                    </p>
                                    <form method="post" action="{{route('frontend.register')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Username">
                                            @error('email')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('frontend.Password') }}">
                                            @error('password')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('frontend.Confirm Password') }}">
                                            @error('password_confirmation')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>{{ __('frontend.I agree to terms') }} &amp; {{ __('frontend.Policy') }}.</span></label>
                                                </div>
                                            </div>
                                            <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>{{ __('frontend.Lean more') }}</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">{{ __('frontend.Submit') }} &amp; {{ __('frontend.Register') }}</button>
                                        </div>
                                    </form>
                                    <div class="text-muted text-center">{{ __('frontend.Already have an account?') }} <a href="/login">{{ __('frontend.Sign in now') }}</a></div>
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
