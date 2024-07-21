@extends('frontend.layouts.master')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">{{ __('frontend.Home') }}</a>
                    <span></span> {{ __('frontend.Post') }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container custom">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-header mb-50">
                            <h1 class="font-xxl text-brand">{{ __('frontend.Our Blog') }}</h1>
                        </div>
                        <div class="loop-grid pr-30">
                            <div class="row">
                                @foreach($posts as $post)
                                    <div class="col-12">
                                        <article class="first-post mb-30 wow fadeIn animated hover-up">
                                            <div class="img-hover-slide position-relative overflow-hidden">
                                                <span class="top-right-icon bg-dark"><i class="fi-rs-bookmark"></i></span>
                                                <div class="post-thumb img-hover-scale">
                                                    <a href="blog-post-right.html">
                                                        <img src="{{$post->thumbnail_url}}"
                                                             alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="entry-content">
                                                <div class="entry-meta meta-1 mb-30">
                                                    <a class="entry-meta meta-0" href="blog-category-grid.html"><span
                                                            class="post-in background4 text-brand font-xs">{{$post->postCategory->name}}</span></a>
                                                </div>
                                                <h2 class="post-title mb-20">
                                                    <a href="{{route('blog.detail', $post->id)}}">{{$post->title}}</a></h2>
                                                <p class="post-exerpt font-medium text-muted mb-30">{!! $post->excerpt !!}</p>
                                                <div class="mb-20 entry-meta meta-2">
                                                    <div class="font-xs ">
                                                    <span class="post-by">{{ __('frontend.By') }} <a
                                                            href="{{route('blog.detail', $post->id)}}">
                                                            {{$post->author->name}}
                                                        </a></span>
                                                        <span class="post-on">{{$post->created_at->format('d-m-Y H:i')}}</span>
                                                    </div>
                                                    <a href="{{route('blog.detail', $post->id)}}" class="btn btn-sm">{{ __('frontend.Read More') }}<i
                                                            class="fi-rs-arrow-right ml-10"></i></a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!--post-grid-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{$posts->links()}}
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
                                            <li class="cat-item cat-item-2"><a href=""
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
@push('scripts')
    <script>
        function handleFilterClick(field, filterType) {
            let currentUrl = window.location.href;
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.delete(field); // Xóa tham số field trong URL (nếu có)
            if (urlParams.has(field)) {
                // Nếu tham số đã tồn tại trong URL, lấy giá trị hiện tại của tham số
                let currentFilterValue = urlParams.get(field);

                // Tách các giá trị thành một mảng
                let filterValues = currentFilterValue.split(',');

                if (filterValues.includes(filterType)) {
                    // Nếu giá trị đã tồn tại trong mảng, loại bỏ nó khỏi mảng
                    filterValues = filterValues.filter(value => value !== filterType);
                } else {
                    // Nếu giá trị chưa tồn tại trong mảng, thêm nó vào mảng
                    filterValues.push(filterType);
                }

                // Cập nhật giá trị mới cho tham số
                urlParams.set(field, filterValues.join(','));
            } else {
                // Nếu tham số chưa tồn tại trong URL, thêm tham số mới với giá trị là filterType
                urlParams.append(field, filterType);
            }

            // Xây dựng URL mới với các tham số đã được cập nhật
            let newUrl = currentUrl.split('?')[0] + '?' + urlParams.toString();
            history.pushState(null, '', newUrl); // Thay đổi URL của trang
            location.reload();
        }

        function clearAllFilters() {
            let currentUrl = window.location.href;
            let baseUrl = currentUrl.split('?')[0]; // Lấy phần đầu của URL (không bao gồm tham số)

            history.pushState(null, '', baseUrl); // Thay đổi URL của trang về baseUrl
            location.reload(); // Tải lại trang để áp dụng URL mới
        }
    </script>
@endpush


