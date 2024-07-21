@extends('frontend.layouts.master')

@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">{{ __('frontend.Your Orders') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('frontend.Image') }}</th>
                                                    <th>{{ __('frontend.Product') }}</th>
                                                    <th>{{ __('frontend.Size') }}</th>
                                                    <th>{{ __('frontend.Color') }}</th>
                                                    <th>{{ __('frontend.Quantity') }}</th>
                                                    <th>{{ __('frontend.Total') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order ->orderItems as $item)
                                                    <tr>
                                                        <td>
                                                            <img style="width: 30%" src="{{$item->image_url}}">
                                                        </td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->size}}</td>
                                                        <td>{{$item->color}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>{{formatPrice($item->total)}} đ</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
