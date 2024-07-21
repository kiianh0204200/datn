@extends('backend.layouts.master')
@section('title', 'Dashboard')
@push('scripts')
    <script>
        function clearAllFilters() {
            let currentUrl = window.location.href;
            let baseUrl = currentUrl.split('?')[0]; // Lấy phần đầu của URL (không bao gồm tham số)

            history.pushState(null, '', baseUrl); // Thay đổi URL của trang về baseUrl
            location.reload(); // Tải lại trang để áp dụng URL mới
        }
    </script>
@endpush
@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">{{ __('backend.Dashboard') }} </h2>
            <p>{{ __('backend.Whole data about your business here') }}</p>
        </div>
    </div>
    @can('read report management')
    <form action="{{route('admin.home')}}" method="GET">
        <div class="row">
            <div class="card card-body mb-4">
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="form-label" for="date_from">{{ __('backend.From') }}</label>
                        <input class="form-control" type="date" name="date_from">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="form-label" for="date_to">{{ __('backend.To') }}</label>
                        <input class="form-control" type="date" name="date_to">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-4">
                        <button class="btn btn-success" type="submit">{{ __('backend.Submit') }}</button>
                        <button class="btn btn-success" onclick="clearAllFilters()">{{ __('backend.Clear') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i
                        class="text-primary material-icons md-monetization_on"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ __('backend.Revenue') }}</h6>
                        <span>{{formatPrice($revenue)}}đ</span>
                        <span class="text-sm">
                                    {{ __('backend.Shipping fees are not included') }}
                                </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i
                        class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ __('backend.Orders') }}</h6> <span>{{$order}}</span>
                        <span class="text-sm">
                                    {{ __('backend.Excluding orders in transit') }}
                                </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i
                        class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ __('backend.Products') }}</h6> <span>{{$product}}</span>
                        <span class="text-sm">
                            {{$category}} {{ __('backend.Categories') }}
                                </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i
                        class="text-info material-icons md-shopping_basket"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ __('backend.Monthly Earnings') }}</h6> <span>{{formatPrice($total)}}đ</span>
                        <span class="text-sm">
                                    {{ __('backend.Based in your local time') }}.
                                </span>
                    </div>
                </article>
            </div>
        </div>
    </div>
    @endcan
@endsection
