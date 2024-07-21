@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Pages
                    <span></span> Password Reset
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
                                            <h3 class="mb-30">Password Reset</h3>
                                        </div>
                                        <form method="post" action="{{route('password.update')}}">
                                            @csrf
                                            <input type="hidden" value="{{$token}}" name="token">
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                                @error('password')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password">
                                                @error('password_confirmation')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit</button>
                                            </div>
                                        </form>
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
