@extends('frontend.layouts.master')

@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-10">
                            <div
                                class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">{{ __('frontend.Your Orders') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Họ và tên</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Địa chỉ 2</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{$order->user->name}}</td>
                                                    <td>{{$order->user->email}}</td>
                                                    <td>{{$order->user->phone}}</td>
                                                    <td>{{$order->address}}</td>
                                                    <td>{{$order->address_2}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('frontend.Order ID') }}</th>
                                                    <th>{{ __('frontend.Order Date') }}</th>
                                                    <th>{{ __('frontend.Status') }}</th>
                                                    <th>Thanh toán</th>
                                                    <th>{{ __('frontend.Total') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{$order->order_id}}</td>
                                                    <td>{{$order->created_at}}</td>
                                                    <td>
                                                        @if($order->order_status === 'pending')
                                                            Đang chờ xử lý
                                                        @elseif($order->order_status === 'confirmed')
                                                            Đã xác nhận
                                                        @elseif($order->order_status === 'pending_ship')
                                                            Đang giao hàng
                                                        @elseif($order->order_status === 'shipped')
                                                            Đã giao hàng
                                                        @elseif($order->order_status === 'cancel')
                                                            Đã hủy
                                                        @elseif($order->order_status === 'completed')
                                                            Hoàn thành
                                                        @endif
                                                    </td>
                                                    <td>{{$order->payment_method}}</td>
                                                    <td>{{formatPrice($order->total)}} đ</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
                                                @foreach($order->orderItems as $item)
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
