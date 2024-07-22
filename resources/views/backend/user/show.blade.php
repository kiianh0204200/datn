@extends('backend.layouts.master')
@section('title', 'User Detail')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Thông tin người dùng</h2>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin người dùng</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Địa chỉ 2</th>
                                        <th>Trạng thái</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="info"> {{$user->name}}</div>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->address_2}}</td>
                                        <td>{{$user->is_active ? 'Active' : 'InActive'}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Đơn hàng</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('frontend.Order ID') }}</th>
                                        <th>{{ __('frontend.Order Date') }}</th>
                                        <th>{{ __('frontend.Total') }}</th>
                                        <th>{{ __('frontend.Status') }}</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="info"> {{$order->order_id}}</div>
                                            </td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->total}}</td>
                                            <td><span
                                                    class='badge rounded-pill alert-success'>{{$order->order_status}}</span>
                                            </td>
                                            <td><span
                                                    class='badge rounded-pill alert-success'>{{$order->payment_status}}</span>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.order.show', $order->id)}}"
                                                   class="btn btn-primary btn-sm">Xem</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
    </section>

@endsection
