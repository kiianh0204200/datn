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
<script>
    function setFilterTime(period) {
        let now = new Date();
        let fromDate = new Date();

        if (period === '1M') {
            fromDate.setMonth(now.getMonth() - 1);
        } else if (period === '6M') {
            fromDate.setMonth(now.getMonth() - 6);
        } else if (period === '1Y') {
            fromDate.setFullYear(now.getFullYear() - 1);
        }

        document.querySelector('input[name="date_from"]').value = fromDate.toISOString().split('T')[0];
        document.querySelector('input[name="date_to"]').value = now.toISOString().split('T')[0];

        document.getElementById('filterForm').submit();
    }
</script>
@section('content')
    <form action="{{ route('admin.home') }}" method="GET">
        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                                    <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-lg-4">
                                                <div class="mb-4">
                                                    <label class="form-label"
                                                        for="date_from">{{ __('backend.From') }}</label>
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
                                                    <button class="btn btn-success"
                                                        type="submit">{{ __('backend.Submit') }}</button>
                                                    <button class="btn btn-success"
                                                        onclick="clearAllFilters()">{{ __('backend.Clear') }}</button>
                                                </div>
                                             
                                            </div>
                                        
                                        </div>
                                      
                                        <!--end row-->
                                    </form>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card card-body mb-4">
                                <article class="icontext">
                                    <span class="icon icon-sm rounded-circle bg-primary-light">
                                        <i class="text-primary material-icons md-monetization_on"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="mb-1 card-title">{{ __('backend.Revenue') }}</h6>
                                        <span>{{ formatPrice($revenue) }}đ</span>
                                        <span class="text-sm">{{ __('backend.Shipping fees are not included') }}</span>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card-body mb-4">
                                <article class="icontext">
                                    <span class="icon icon-sm rounded-circle bg-success-light">
                                        <i class="text-success material-icons md-local_shipping"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="mb-1 card-title">{{ __('backend.Orders') }}</h6>
                                        <span>{{ $order }}</span>
                                        <span class="text-sm">{{ __('backend.Excluding orders in transit') }}</span>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card-body mb-4">
                                <article class="icontext">
                                    <span class="icon icon-sm rounded-circle bg-warning-light">
                                        <i class="text-warning material-icons md-qr_code"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="mb-1 card-title">{{ __('backend.Products') }}</h6>
                                        <span>{{ $product }}</span>
                                        <span class="text-sm">{{ $category }} {{ __('backend.Categories') }}</span>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card-body mb-4">
                                <article class="icontext">
                                    <span class="icon icon-sm rounded-circle bg-info-light">
                                        <i class="text-info material-icons md-shopping_basket"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="mb-1 card-title">{{ __('backend.Monthly Earnings') }}</h6>
                                        <span>{{ formatPrice($total) }}đ</span>
                                        <span class="text-sm">{{ __('backend.Based in your local time') }}.</span>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                    <form>
                                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="setFilterTime('1M')">1M</button>
                                                <button type="button" class="btn btn-soft-primary btn-sm" onclick="setFilterTime('6M')">6M</button>
                                                <button type="button" class="btn btn-soft-primary btn-sm" onclick="setFilterTime('1Y')">1Y</button>
                                    </form>
                                </div><!-- end card header -->

                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row g-0 text-center">

                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h6 class="mb-1 card-title">{{ __('backend.Revenue') }}</h6>
                                                <span>{{ formatPrice($revenue) }}đ</span>

                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h6 class="mb-1 card-title">{{ __('backend.Orders') }}</h6>
                                                <span>{{ $order }}</span>

                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h6 class="mb-1 card-title">{{ __('backend.Products') }}</h6>
                                                <span>{{ $product }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h6 class="mb-1 card-title">{{ __('backend.Monthly Earnings') }}</h6>
                                                <span>{{ formatPrice($total) }}đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

                                <div id="customer_impression_charts"></div>

    <script>
        // Convert PHP data to JavaScript
        
        
        var months = @json($months);
        var orderCounts = @json($orderCounts);
        var revenues = @json($revenues);

        var options = {
            series: [
                {
                    name: 'Đơn hàng',
                    type: 'line',
                    data: orderCounts // Dữ liệu đơn hàng từ PHP
                },
                {
                    name: 'Doanh thu',
                    type: 'column',
                    data: revenues // Dữ liệu doanh thu từ PHP
                }
            ],
            chart: {
                height: 350,
                type: 'line'
            },
            stroke: {
                width: [0, 4]
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [1] // Hiển thị nhãn chỉ cho chuỗi cột (Doanh thu)
            },
            labels: months.map(month => `Tháng ${month}`),
            yaxis: [
                {
                    title: {
                        text: 'Đơn hàng'
                    },
                },
                {
                    opposite: true,
                    title: {
                        text: 'Doanh thu'
                    }
                }
            ],
            xaxis: {
                categories: months.map(month => `Tháng ${month}`),
                title: {
                    text: 'Tháng'
                }
            },
            colors: ['#77B6EA', '#75a5e2']
        };

        var chart = new ApexCharts(document.querySelector("#customer_impression_charts"), options);
        chart.render();
    </script>
    
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <!-- card -->
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">{{ __('backend.Order Status Distribution') }}</h4>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->
                        
                                <!-- card body -->
                                <div class="card-body">
                                    <div id="order-status-distribution"
                                        data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px"
                                        dir="ltr"></div>
                                    <div class="px-2 py-2 mt-1">
                                        @foreach($orderStatusData as $status => $count)
                                            <p class="mb-1">{{ ucfirst($status) }} <span class="float-end">{{ $count }}</span></p>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                    style="width: {{ ($count / array_sum($orderStatusData)) * 100 }}%" aria-valuenow="{{ ($count / array_sum($orderStatusData)) * 100 }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var orderStatusData = @json($orderStatusData);
                        
                                var series = Object.values(orderStatusData);
                                var labels = Object.keys(orderStatusData);
                                var colors = ['#77B6EA', '#545454', '#FF4560', '#00E396'];
                        
                                var options = {
                                    series: series,
                                    chart: {
                                        type: 'donut',
                                        height: 269
                                    },
                                    labels: labels,
                                    colors: colors,
                                    plotOptions: {
                                        pie: {
                                            donut: {
                                                size: '70%'
                                            }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                        
                                var chart = new ApexCharts(document.querySelector("#order-status-distribution"), options);
                                chart.render();
                            });
                        </script>
                        


                </div> <!-- end .h-100-->

            </div> <!-- end col -->

        </div>
    </form>
@endsection

@section('script-libs')
    <!-- apexcharts -->
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('backend/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('backend/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('backend/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Giả sử bạn đã có dữ liệu cho một tháng
            var data = [{
                    x: new Date('2024-07-01').getTime(),
                    y: 10
                },
                {
                    x: new Date('2024-07-02').getTime(),
                    y: 15
                },
                {
                    x: new Date('2024-07-03').getTime(),
                    y: 12
                },
                // Thêm dữ liệu cho các ngày còn lại trong tháng
                {
                    x: new Date('2024-07-31').getTime(),
                    y: 18
                }
            ];

            var options = {
                series: [{
                    name: 'Data',
                    data: data
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    zoom: {
                        enabled: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    title: {
                        text: 'Ngày'
                    },
                    labels: {
                        format: 'dd/MM'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Giá trị'
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yyyy'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#customer_impression_charts"), options);
            chart.render();
        });
    </script>

@endsection

@section('style-libs')
    <!-- jsvectormap css -->
    <link href="{{ asset('backend/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('backend/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
