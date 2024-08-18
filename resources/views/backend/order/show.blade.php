@extends('backend.layouts.master')
@section('title', __('backend.Order Detail'))

@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">{{ __('backend.Order Detail') }}</h2>
                <p>{{ __('backend.Details for Order ID') }}: {{$order->order_id}}</p>
            </div>
        </div>
        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                            <span>
                                <i class="material-icons md-calendar_today"></i> <b>{{$order->created_at->format('d-m-Y H:i:s')}}</b>
                            </span> <br>
                        <small class="text-muted">{{ __('backend.Order ID') }}: {{$order->order_id}}</small>
                    </div>
                    <form method="POST" action="{{route('admin.order.update', $order->id)}}">
                        @csrf
                        @method('PATCH')

                        <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                            <label class="form-label d-inline-block me-2 mb-0">{{ __('backend.Payment Status') }}:</label>
                            <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200" name="payment_status">
                                <option>{{ __('backend.Change status') }}</option>
                                <option value="pending" @if($order->payment_status == 'pending') selected @endif>{{ __('backend.Pending') }}</option>
                                <option value="paid" @if($order->payment_status == 'paid') selected @endif>{{ __('backend.Paid') }}</option>
                                <option value="refunded" @if($order->payment_status == 'refunded') selected @endif>{{ __('backend.Refunded') }}</option>
                                <option value="cancel" @if($order->payment_status == 'cancel') selected @endif>{{ __('backend.Cancel') }}</option>
                            </select>
                        </br>
                            <label class="form-label d-inline-block me-2 mb-0">{{ __('backend.Status') }}:</label>
                            <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200" name="order_status" @if($order->order_status === 'completed') disabled @endif>
                                <option>{{ __('backend.Change status') }}</option>
                                <option value="pending" @if($order->order_status == 'pending') selected @endif>{{ __('backend.Pending') }}</option>
                                <option value="confirmed" @if($order->order_status == 'confirmed') selected @endif>{{ __('backend.Confirmed') }}</option>
                                <option value="shipped" @if($order->order_status == 'shipped') selected @endif>{{ __('backend.Shipped') }}</option>
                                <option value="completed" @if($order->order_status == 'completed') selected @endif>{{ __('backend.Completed') }}</option>
                            </select>

                            <button type="submit" class="btn btn-primary" href="#">{{ __('backend.Save') }}</button>
                        <a class="btn btn-secondary print ms-2" href="#"><i
                                class="icon material-icons md-print"></i></a>
                        </div>
                    </form>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-primary material-icons md-person"></i>
                                </span>
                            <div class="text">
                                <h6 class="mb-1">{{ __('backend.Customer') }}</h6>
                                <p class="mb-1">
                                    {{$order->user->name}}
                                    <br>
                                    {{$order->user->email}}
                                    <br>
                                    {{$order->user->phone}}
                                </p>
                            </div>
                        </article>
                    </div> <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-primary material-icons md-local_shipping"></i>
                                </span>
                            <div class="text">
                                <h6 class="mb-1">{{ __('backend.Order information') }}</h6>
                                <p class="mb-1">
                                    {{ __('backend.Shipping') }}: Ship code <br> {{ __('backend.Pay method') }}: {{$order->payment_method}} <br>
                                    {{ __('backend.Status') }}:{{$order->order_status}}
                                </p>
                            </div>
                        </article>
                    </div> <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-primary material-icons md-place"></i>
                                </span>
                            <div class="text">
                                <h6 class="mb-1">{{ __('backend.Deliver to') }}</h6>
                                <p class="mb-1">
                                    {{$order->address}}
                                    <br>
                                    {{$order->address_2}}
                                </p>
                            </div>
                        </article>
                    </div> <!-- col// -->
                </div> <!-- row // -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="60%">{{ __('frontend.Product') }}</th>
                                    <th width="5%">{{ __('frontend.Size') }}</th>
                                    <th width="5%">{{ __('frontend.Color') }}</th>
                                    <th width="5%">{{ __('backend.Unit Price') }}</th>
                                    <th width="5%">{{ __('frontend.Quantity') }}</th>
                                    <th width="10%" class="text-end">{{ __('frontend.Total') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderItems as $orderItem)
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    <img src="{{$orderItem->image_url}}" width="40" height="40"
                                                         class="img-xs" alt="Item">
                                                </div>
                                                <div class="info"> {{$orderItem->name}} </div>
                                            </a>
                                        </td>
                                        <td>{{$orderItem->size}}</td>
                                        <td>{{$orderItem->color}}</td>
                                        <td> {{number_format($orderItem->price, 0, '', ',')}} </td>
                                        <td> {{$orderItem->quantity}} </td>
                                        <td class="text-end"> {{number_format($orderItem->total, 0, '', ',')}} </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>{{ __('backend.Shipping cost') }}:</dt>
                                                <dd>0</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>{{ __('frontend.Total') }}:</dt>
                                                <dd><b class="h5">{{number_format($order->total, 0, '', ',')}}</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt class="text-muted">{{ __('backend.Status') }}:</dt>
                                                <dd>
                                                    <span
                                                        class="badge rounded-pill alert-success text-success">{{$order->payment_status}}</span>
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div> <!-- table-responsive// -->
                    </div> <!-- col// -->
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4">
                        <div class="box shadow-sm bg-light">
                            <h6 class="mb-15">{{ __('backend.Payment information') }}</h6>
                            <p>
                                @if($order->payment_method == 'VnPay')
                                <img src="{{asset('frontend/assets/imgs/vnpay.png')}}" class="border" height="20"> {{$order->payment_method}}: {{$order->payment_id}} <br>
                                @else
                                    <img src="{{asset('frontend/assets/imgs/shipcod.jpg')}}" class="border" height="20"> {{$order->payment_method}}: {{$order->payment_id}} <br> <br>
                                @endif
                            </p>
                        </div>
                        <div class="box shadow-sm bg-light">
                            <h6 class="mb-15">{{ __('backend.Notes') }}</h6>
                            <p>
                                {{$order->notes}}
                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </section> <!-- content-main end// -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.print').click(function () {
                window.print();
            })
        })
    </script>
@endpush
