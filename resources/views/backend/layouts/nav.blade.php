<nav>
    <ul class="menu-aside">
        <li class="menu-item {{request()->is('admin') ? 'active' : ''}}">
            <a class="menu-link" href="{{route('admin.home')}}"> <i class="icon material-icons md-home"></i>
                <span class="text">{{ __('backend.Dashboard') }}</span>
            </a>
        </li>

        @can('read banner management')
            <li class="menu-item {{request()->is('admin/banner') ? 'active' : ''}}">
                <a class="menu-link" href="{{route('admin.banner.index')}}"> <i
                        class="icon material-icons md-shopping_bag"></i>
                    <span class="text">{{ __('backend.Banner Management') }}</span>
                </a>
            </li>
        @endcan

        @can('read brand management')
            <li class="menu-item {{request()->is('admin/brand') ? 'active' : ''}}">
                <a class="menu-link" href="{{route('admin.brand.index')}}"> <i
                        class="icon material-icons md-shopping_bag"></i>
                    <span class="text">{{ __('backend.Brand Management') }}</span>
                </a>
            </li>
        @endcan

        @can('read product management')
            <li class="menu-item {{request()->is('admin/product') || request()->is('admin/category') || request()->is('admin/product-option') ? 'active' : ''}} has-submenu">
                <a class="menu-link" href="{{route('admin.product.index')}}"> <i class="icon material-icons md-category"></i>
                    <span class="text">{{ __('backend.Products') }}</span>
                </a>
                <div class="submenu">
                    @can('read product management')
                        <a href="{{route('admin.product.index')}}">{{ __('backend.Product List') }}</a>
                    @endcan
                    @can('read category management')
                        <a href="{{route('admin.category.index')}}">{{ __('backend.Product Category') }}</a>
                    @endcan
                    @can('read product option management')
                        <a href="{{route('admin.product-option.index')}}">{{ __('backend.Product Option') }}</a>
                    @endcan
                </div>
            </li>
        @endcan

        @can('read order management')
            <li class="menu-item {{request()->is('admin/order') || request()->is('admin/order/*') ? 'active' : ''}}">
                <a class="menu-link" href="{{route('admin.order.index')}}"> <i
                        class="icon material-icons md-shopping_cart"></i>
                    <span class="text">{{ __('backend.Order Management') }}</span>
                </a>
            </li>
        @endcan

        @can('read blog management')
            <li class="menu-item {{request()->is('admin/post') ? 'active' : ''}} has-submenu">
                <a class="menu-link" href="{{route('admin.post.index')}}"> <i
                        class="icon material-icons md-category"></i>
                    <span class="text">{{ __('backend.Post Management') }}</span>
                </a>
                <div class="submenu">
                    <a href="{{route('admin.post.index')}}">{{ __('backend.Post List') }}</a>
                    <a href="{{route('admin.post-category.index')}}">{{ __('backend.Post Category') }}</a>
                </div>
            </li>
        @endcan

        @can('read contact management')
            <li class="menu-item {{request()->is('admin/contact') ? 'active' : ''}}">
                <a class="menu-link" href="{{ route('admin.contact.index') }}"> <i
                        class="icon material-icons md-contacts"></i>
                    <span class="text">{{ __('backend.Contact Management') }}</span>
                </a>
            </li>
        @endcan
        @can('read user management')
            <li class="menu-item {{request()->is('admin/users') ? 'active' : ''}}">
                <a class="menu-link" href="{{ route('admin.users.index') }}"> <i
                        class="icon material-icons md-contacts"></i>
                    <span class="text">{{ __('backend.User Management') }}</span>
                </a>
            </li>
        @endcan
    </ul>
    <hr>
    <ul class="menu-aside">
        <li class="menu-item has-submenu">
            <a class="menu-link" href="#"> <i class="icon material-icons md-settings"></i>
                <span class="text">{{ __('backend.Other settings') }}</span>
            </a>
            <div class="submenu">
                @can('read role management')
                    <a href="{{route('admin.role.index')}}">{{ __('backend.Role User') }}</a>
                @endcan
            </div>
        </li>
    </ul>
    <br>
    <br>
</nav>
