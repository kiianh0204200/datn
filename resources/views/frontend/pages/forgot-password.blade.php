@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">{{ __('frontend.Home') }}</a>
                    <span></span> {{ __('frontend.Pages') }}
                    <span></span> {{ __('frontend.Forgot Pasword') }}
                </div>
            </div>
        </div>
        <section class="pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30"> {{ __('frontend.Forgot Pasword') }} </h3>
                                        </div>
                                        <form method="post" action="{{route('password.email')}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">{{ __('frontend.Submit') }}</button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">{{ __('frontend.Already have an account?') }} <a href="/login">{{ __('frontend.Login now') }}</a></div>
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
