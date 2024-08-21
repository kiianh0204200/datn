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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route('admin.homes.chart-data') }}')
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById('combinedChart').getContext('2d');
                    var combinedChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [
                                {
                                    label: 'Số lượng sản phẩm',
                                    data: data.productCounts,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    fill: true,
                                    yAxisID: 'y1'
                                },
                                {
                                    label: 'Số lượng đơn hàng',
                                    data: data.orderCounts,
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    fill: true,
                                    yAxisID: 'y1'
                                },
                                {
                                    label: 'Doanh thu',
                                    data: data.revenues,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    fill: true,
                                    yAxisID: 'y2'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                }
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Tháng'
                                    }
                                },
                                y: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Số lượng'
                                    },
                                    beginAtZero: true,
                                    position: 'left',
                                    id: 'y1'
                                },
                                y2: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Doanh thu'
                                    },
                                    beginAtZero: true,
                                    position: 'right',
                                    id: 'y2'
                                }
                            }
                        }
                    });
                });

            fetch('{{ route('admin.orders.status-chart-data') }}')
                .then(response => response.json())
                .then(data => {
                    var statusLabels = data.map(stat => stat.status);
                    var statusCounts = data.map(stat => stat.total);
                    
                    var ctx = document.getElementById('orderStatusChart').getContext('2d');
                    var orderStatusChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: statusLabels,
                            datasets: [{
                                label: 'Trạng thái đơn hàng',
                                data: statusCounts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                }
                            },
                        }
                    });
                });
        });
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
                        <h6 class="mb-1 card-title">{{ __('backend.Monthly Earnings') }}</h6> <span>{{($total)}}đ</span>
                        <span class="text-sm">
                                    {{ __('backend.Based in your local time') }}.
                                </span>
                    </div>
                </article>
            </div>
        </div>
    </div>
   
    @endcan
    
    <div>
        <h2 class="content-title card-title">{{ __('Dư liệu các tháng ') }} </h2>
    </div>
    <div class="col-lg-12">
        <canvas id="combinedChart" width="150" height="50"></canvas>
    </div>
    <div class="col-lg-12 mt-4">
        <h2 class="content-title card-title">{{ __('Trạng thái đơn hàng') }} </h2>
        <canvas id="orderStatusChart" width="150" height="50"></canvas>
    </div>
  
@endsection
