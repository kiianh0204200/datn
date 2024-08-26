<!DOCTYPE HTML>
<html lang="en">

@include('backend.layouts.header')

<body>
<div class="screen-overlay"></div>
<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{route('admin.home')}}" class="brand-wrap">
            <h4>Golden Era</h4>
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i>
            </button>
        </div>
    </div>
    @include('backend.layouts.nav')
</aside>
<main class="main-wrap">
    <header class="main-header navbar">
        <div class="col-search">
        </div>
        <div class="col-nav">
            <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i
                    class="material-icons md-apps"></i></button>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                </li>
                <li class="dropdown nav-item">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false"><i class="material-icons md-public"></i></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                        <a class="dropdown-item text-brand" href="locale/vi">Tiếng Việt</a>
                        <a class="dropdown-item" href="locale/en">English</a>
                    </div>
                </li>
                <li class="dropdown nav-item">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount"
                       aria-expanded="false"> <img class="img-xs rounded-circle"
                                                   src="{{asset('backend/assets/imgs/people/avatar2.jpg')}}"
                                                   alt="User"></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                        <p class="dropdown-item"><i class="material-icons md-perm_identity"></i>{{auth()->user()->name}}</p>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="material-icons md-exit_to_app"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <section class="content-main">
        @yield('content')
    </section>
    @include('backend.layouts.footer')
</main>
@include('backend.layouts.script')
</body>
</html>
