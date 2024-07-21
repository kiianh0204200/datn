@extends('frontend.layouts.master')

@section('content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">{{ __('frontend.Home') }}</a>
                <span></span> {{ __('frontend.Pages') }}
                <span></span> {{ __('frontend.Contact Us') }}
            </div>
        </div>
    </div>
    <section class="hero-2 bg-green">
        <div class="hero-content">
            <div class="container">
                <div class="text-center">
                    <h4 class="text-brand mb-20">{{ __('frontend.Get in touch') }}</h4>
                    <h1 class="mb-20 wow fadeIn animated font-xxl fw-900">
                        {{ __('frontend.Let is Talk About') }} <br><span class="text-style-1">{{ __('frontend.Your Idea') }}</span>
                    </h1>
                    <p class="w-50 m-auto mb-50 wow fadeIn animated">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum quam eius placeat, a quidem mollitia at accusantium reprehenderit pariatur provident nam ratione incidunt magnam sequi.</p>
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="/about">{{ __('frontend.About Us') }}</a>
                        <a class="btn btn-outline btn-lg btn-brand-outline font-weight-bold text-brand bg-white text-hover-white ml-15 border-radius-5 btn-shadow-brand hover-up">{{ __('frontend.Support Center') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 m-auto">
                    <div class="contact-from-area padding-20-row-col wow FadeInUp">
                        <h3 class="mb-10 text-center">{{ __('frontend.Drop Us a Line') }}</h3>
                        <p class="text-muted mb-30 text-center font-sm">{{ __('frontend.Contact with us') }}.</p>
                        <form class="contact-form-style text-center" id="contact-form" action="{{ route('contact.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="name" placeholder="{{ __('frontend.Your Name') }}" id="name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="email" placeholder="{{ __('frontend.Your Email') }}" id="email" type="email">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="phone" placeholder="{{ __('frontend.Your Phone') }}" id="phone" type="tel">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="subject" placeholder="{{ __('frontend.Subject') }}" id="subject" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="textarea-style mb-30">
                                        <textarea name="message" placeholder="{{ __('frontend.Your Message') }}" id="message"></textarea>
                                    </div>
                                    <button class="submit submit-auto-width" name="send" type="submit">{{ __('frontend.Send message') }}</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
