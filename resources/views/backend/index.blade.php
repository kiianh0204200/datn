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
                                    <div>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">ALL</button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">1M</button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">6M</button>
                                        <button type="button" class="btn btn-soft-primary btn-sm">1Y</button>
                                    </div>
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
                                    var options = {
                                        series: [{
                                                name: 'Orders',
                                                type: 'line',
                                                data: [80, 90, 70, 120, 80, 60, 50, 60, 70, 90, 80, 50] // Dữ liệu cho số lượng đơn hàng
                                            },
                                            {
                                                name: 'Earnings',
                                                type: 'column',
                                                data: [100, 120, 90, 130, 100, 80, 70, 80, 100, 110, 90, 60] // Dữ liệu cho doanh thu
                                            },
                                            {
                                                name: 'Refunds',
                                                type: 'line',
                                                data: [10, 20, 15, 10, 20, 25, 30, 20, 15, 10, 20, 25] // Dữ liệu cho hoàn tiền
                                            }
                                        ],
                                        chart: {
                                            height: 350,
                                            type: 'line'
                                        },
                                        stroke: {
                                            width: [0, 4, 3]
                                        },
                                        plotOptions: {
                                            bar: {
                                                columnWidth: '50%'
                                            }
                                        },
                                        dataLabels: {
                                            enabled: true,
                                            enabledOnSeries: [1] // Hiển thị nhãn chỉ cho chuỗi cột (Earnings)
                                        },
                                        labels: [
                                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                        ],
                                        yaxis: [{
                                                title: {
                                                    text: 'Orders'
                                                },
                                            },
                                            {
                                                opposite: true,
                                                title: {
                                                    text: 'Earnings'
                                                }
                                            },
                                            {
                                                opposite: true,
                                                title: {
                                                    text: 'Refunds'
                                                }
                                            }
                                        ],
                                        xaxis: {
                                            categories: [
                                                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                            ],
                                            title: {
                                                text: 'Months'
                                            }
                                        },
                                        colors: ['#77B6EA', '#75a5e2', '#FF4560']
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
                                    <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-primary btn-sm">Export Report</button>
                                    </div>
                                </div><!-- end card header -->

                                <!-- card body -->
                                <div class="card-body">
                                    <div id="sales-by-locations"
                                        data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px"
                                        dir="ltr"></div>
                                    <div class="px-2 py-2 mt-1">
                                        <p class="mb-1">Hồ Chí Minh <span class="float-end">45%</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 45%" aria-valuenow="45" aria-valuemin="0"
                                                aria-valuemax="45"></div>
                                        </div>

                                        <p class="mt-3 mb-1">Hà Nội <span class="float-end">30%</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                aria-valuemax="30"></div>
                                        </div>

                                        <p class="mt-3 mb-1">Đà Nẵng <span class="float-end">15%</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                                aria-valuemax="15"></div>
                                        </div>

                                        <p class="mt-3 mb-1">Các khu vực khác <span class="float-end">10%</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 10%" aria-valuenow="10" aria-valuemin="0"
                                                aria-valuemax="10"></div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <script>
                            var options = {
                                series: [45, 30, 15, 10], // Tỷ lệ phần trăm cho các khu vực
                                chart: {
                                    type: 'donut',
                                    height: 269
                                },
                                labels: ['Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng', 'Các khu vực khác'],
                                colors: ['#77B6EA', '#545454', '#FF4560', '#00E396'],
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

                            var chart = new ApexCharts(document.querySelector("#sales-by-locations"), options);
                            chart.render();
                        </script>

                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold text-uppercase fs-12">Sort by:
                                                </span><span class="text-muted">Today<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                                <a class="dropdown-item" href="#">This Month</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                <!-- Ví dụ về một hàng sản phẩm -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="{{ asset('backend/assets/imgs/items/1.jpg') }}"
                                                                    alt="Hình ảnh sản phẩm" class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a href="product-details.html"
                                                                        class="text-reset">Áo cardinal</a></h5>
                                                                <span class="text-muted">01 Tháng 8, 2024</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">500.000đ</h5>
                                                        <span class="text-muted">Giá</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">120</h5>
                                                        <span class="text-muted">Đơn hàng</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">300</h5>
                                                        <span class="text-muted">Tồn kho</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">60.000.000đ</h5>
                                                        <span class="text-muted">Tổng tiền</span>
                                                    </td>
                                                </tr>
                                                <!-- Ví dụ về một hàng sản phẩm khác -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="{{ asset('backend/assets/imgs/items/9.jpg') }}"
                                                                    alt="Hình ảnh sản phẩm" class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a href="product-details.html"
                                                                        class="text-reset">Giày JBV</a></h5>
                                                                <span class="text-muted">05 Tháng 8, 2024</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">450.000đ</h5>
                                                        <span class="text-muted">Giá</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">80</h5>
                                                        <span class="text-muted">Đơn hàng</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">150</h5>
                                                        <span class="text-muted">Tồn kho</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">36.000.000đ</h5>
                                                        <span class="text-muted">Tổng tiền</span>
                                                    </td>
                                                </tr>
                                                <!-- Thêm các hàng sản phẩm khác nếu cần -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <div
                                        class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                        <div class="col-sm">
                                            <div class="text-muted">
                                                Hiển thị <span class="fw-semibold">2</span> trong tổng số <span
                                                    class="fw-semibold">20</span> kết quả
                                            </div>
                                        </div>
                                        <div class="col-sm-auto mt-3 mt-sm-0">
                                            <ul
                                                class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">←</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">1</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a href="#" class="page-link">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">→</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Leading supplier
                                    </h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted">Báo cáo<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Tải báo cáo</a>
                                                <a class="dropdown-item" href="#">Xuất dữ liệu</a>
                                                <a class="dropdown-item" href="#">Nhập dữ liệu</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="{{ asset('backend/assets/imgs/brands/brand-1.jpg') }}"
                                                                    alt="Quần áo" class="avatar-sm p-2" />
                                                            </div>
                                                            <div>
                                                                <span class="text-muted">cardinal</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">100</p>
                                                        <span class="text-muted">Tồn kho</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">30.000.000 đ</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">40%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="{{ asset('backend/assets/imgs/brands/brand-7.jpg') }}"
                                                                    alt="Quần áo" class="avatar-sm p-2" />
                                                            </div>
                                                            <div>
                                                                <span class="text-muted">JBV</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">100</p>
                                                        <span class="text-muted">Tồn kho</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">30.000.000 đ</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">40%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->

                                            </tbody>
                                        </table><!-- end table -->
                                    </div>

                                    <div
                                        class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                        <div class="col-sm">
                                            <div class="text-muted">
                                                Hiển thị <span class="fw-semibold">5</span> trong tổng số <span
                                                    class="fw-semibold">25</span> kết quả
                                            </div>
                                        </div>
                                        <div class="col-sm-auto mt-3 mt-sm-0">
                                            <ul
                                                class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">←</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">1</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a href="#" class="page-link">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">→</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div> <!-- .card-body-->
                            </div> <!-- .card-->
                        </div> <!-- .col-->

                    </div> <!-- end row-->

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
