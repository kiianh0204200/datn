@extends('frontend.layouts.master')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">{{ __('frontend.Home') }}</a>
                    <span></span> {{ __('frontend.Pages') }}
                    <span></span> {{ __('frontend.My Account') }}
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                               href="#dashboard" role="tab" aria-controls="dashboard"
                                               aria-selected="false"><i
                                                    class="fi-rs-settings-sliders mr-10"></i>{{ __('frontend.Dashboard') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                               role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>{{ __('frontend.Orders') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"
                                               role="tab" aria-controls="address" aria-selected="true"><i
                                                    class="fi-rs-marker mr-10"></i>{{ __('frontend.My Address') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                               href="#account-detail" role="tab" aria-controls="account-detail"
                                               aria-selected="true"><i
                                                    class="fi-rs-user mr-10"></i>{{ __('frontend.Account details') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                               href="#account-detail-password" role="tab" aria-controls="account-detail"
                                               aria-selected="true"><i class="fi-rs-user mr-10"></i>Đổi mật khẩu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('frontend.logout')}}"><i
                                                    class="fi-rs-sign-out mr-10"></i>{{ __('frontend.Logout') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                         aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ __('frontend.Hello') }} {{auth()->user()->name}}
                                                    ! </h5>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ __('frontend.From your account dashboard.you can easily check view your recent orders, manage your shipping and billing addresses and edit your password and account details.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ __('frontend.Your Orders') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('frontend.Order') }}</th>
                                                            <th>{{ __('frontend.Date') }}</th>
                                                            <th>{{ __('frontend.Status') }}</th>
                                                            <th>{{ __('frontend.Total') }}</th>
                                                            <th>{{ __('frontend.Actions') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>#{{$order->order_id}}</td>
                                                                <td>{{$order->created_at->format('d-m-Y H:i:s')}}</td>
                                                                @if($order->order_status =='pending')
                                                                    <td>{{ __('frontend.Pending') }}</td>
                                                                @elseif($order->order_status =='processing')
                                                                    <td>{{ __('frontend.Processing') }}</td>
                                                                @elseif($order->order_status =='confirmed')
                                                                    <td>{{ __('frontend.Confirmed') }}</td>
                                                                @elseif($order->order_status =='shipped')
                                                                    <td>{{ __('frontend.Shipped') }}</td>
                                                                @elseif($order->order_status =='completed')
                                                                    <td>{{ __('frontend.Completed') }}</td>
                                                                @elseif($order->order_status =='cancelled')
                                                                    <td>{{ __('frontend.Cancelled') }}</td>
                                                                @endif
                                                                <td>{{formatPrice($order->total)}} đ</td>
                                                                <td>
                                                                    <a href="{{route('frontend.user.order-detail', $order->id)}}"
                                                                       class="btn-small d-block">{{ __('frontend.View') }}</a>
                                                                    @if($order->order_status == 'cancelled')
                                                                        <a></a>
                                                                    @else
                                                                        <a href="{{route('frontend.user.order-cancel', $order->id)}}">{{ __('frontend.Cancel') }}</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination justify-content-start">
                                                                {{$orders->links()}}
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel"
                                         aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">{{ __('frontend.Shipping Address') }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>{{ __('frontend.Address') }} 1</p>
                                                        <p>{{auth()->user()->address}}</p>
                                                        <p>{{ __('frontend.Address') }} 2</p>
                                                        <p>{{auth()->user()->address_2}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                         aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('frontend.Account details') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="post"
                                                      action="{{route('frontend.user.update', auth()->user()->id)}}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ __('frontend.Name') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   class="form-control square @error('name') is-invalid @enderror"
                                                                   value="{{old('name') ?? auth()->user()->name}}"
                                                                   name="name">
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ __('frontend.Email Address') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   class="form-control square @error('email') is-invalid @enderror"
                                                                   name="email"
                                                                   value="{{old('email') ?? auth()->user()->email}}"
                                                                   type="email">
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>{{ __('frontend.Phone') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   class="form-control square @error('phone') is-invalid @enderror"
                                                                   name="phone"
                                                                   value="{{old('phone') ?? auth()->user()->phone}}"
                                                                   type="text">
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>{{ __('frontend.Address') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   class="form-control square @error('address') is-invalid @enderror"
                                                                   value="{{old('address') ?? auth()->user()->address}}"
                                                                   name="address" type="text">
                                                            @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>{{ __('frontend.Address') }} 2 <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   class="form-control square @error('address_2') is-invalid @enderror"
                                                                   value="{{old('address_2') ?? auth()->user()->address_2}}"
                                                                   name="address_2" type="text">
                                                            @error('address_2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                    name="submit"
                                                                    value="Submit">{{ __('frontend.Save') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail-password" role="tabpanel"
                                         aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('frontend.Account details') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <form id="form-change-password">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>{{ __('frontend.Current Password') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   id="password"
                                                                   class="form-control square @error('password') is-invalid @enderror"
                                                                   name="password" type="password">
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>{{ __('frontend.New Password') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   id="new-password"
                                                                   class="form-control square @error('new_password') is-invalid @enderror"
                                                                   name="new_password" type="password">
                                                            @error('new_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>{{ __('frontend.Confirm Password') }} <span
                                                                    class="required">*</span></label>
                                                            <input required=""
                                                                   id="new-password-confirm"
                                                                   class="form-control square @error('new_password_confirmation') is-invalid @enderror"
                                                                   name="new_password_confirmation" type="password">
                                                            @error('new_password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                    name="submit"
                                                                    value="Submit">{{ __('frontend.Save') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
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
    </main>
    @push('scripts')
        <script>
            $('#form-change-password').on('submit', function (e) {
                e.preventDefault();
                let url = "{{route('frontend.user.change-password')}}";
                var password = $('#password').val();
                var new_password = $('#new-password').val();
                var new_password_confirm = $('#new-password-confirm').val();
                if (new_password !== new_password_confirm) {
                    toastr.error('Mật khẩu mới không khớp');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Xác thực token để tránh bị lỗi 419
                    },
                    data: {
                        password: password,
                        new_password: new_password,
                        new_password_confirmation: new_password_confirm
                    },
                    success: function (response) {
                        console.log(response)
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.href = "{{route('frontend.logout')}}";
                        }, 5000);
                    },
                    error: function (response) {
                        console.log(response)
                        toastr.error(response.responseJSON.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000);
                    }
                })
            });
        </script>
    @endpush
@endsection
