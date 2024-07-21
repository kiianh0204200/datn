@extends('frontend.layouts.master')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">{{ __('frontend.Home') }}</a>
                <span></span> {{$post->postCategory->name}}
                <span></span> {{ __('frontend.Post') }}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-page pr-30">
                        <div class="single-header style-2">
                            <h1 class="mb-30">{{ $post->title }}</h1>
                            <div class="single-header-meta">
                                <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                    <span class="post-by">{{ __('frontend.By') }} <a href="#">{{$post->author->name}}</a></span>
                                    <span class="post-on has-dot">{{$post->created_at->format('d/m/y H:i')}}</span>
                                    <span class="hit-count  has-dot">{{ $post->views }} {{ __('frontend.Views') }}</span>
                                </div>
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">{{ __('frontend.Share this') }}:</strong></li>
                                        <li class="social-facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a></li>
                                        <li class="social-twitter"> <a href="https://twitter.com/intent/tweet?text={{ $post->title }}&url={{ url()->current() }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a></li>
                                        <li class="social-instagram"><a href="https://www.instagram.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $post->title }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a></li>
                                        <li class="social-linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $post->title }}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <figure class="single-thumbnail">
                            <img src="{{ $post->thumbnail_url }}" alt="">
                        </figure>
                        <div class="single-content">
                            <p>{!! $post->content !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <div class="sidebar-widget widget_search mb-50">
                            <div class="search-form">
                                <form action="{{ route('blog') }}" method="GET">
                                    <input type="text" placeholder="Search…" name="title">
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!--Widget categories-->
                        <div class="sidebar-widget widget_categories mb-40">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">{{ __('frontend.Category') }}</h5>
                            </div>
                            <div class="post-block-list post-module-1 post-module-5">
                                <ul>
                                    @foreach($postCategories as $category)
                                        <li class="cat-item cat-item-2"><a href="/blog?category={{$category->id}}"
                                            onclick="handleFilterClick('category', {{$category->id}})">{{$category->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
