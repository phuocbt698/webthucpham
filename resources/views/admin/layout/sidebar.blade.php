<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link d-flex justify-content-center">
        <div>
            <img src="{{ asset('asset/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin</span>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(Auth::guard('admin')->user()->path_image) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::guard('admin')->user()->name }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ !empty($title) && $title == 'Dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Article' ? 'menu-open' : '' }}">
                    <a href="{{ route('article.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Article</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Banner' ? 'menu-open' : '' }}">
                    <a href="{{ route('banner.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>
                        <p>Banner</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Brand' ? 'menu-open' : '' }}">
                    <a href="{{ route('brand.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-copyright"></i>
                        <p>Brand</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Category' ? 'menu-open' : '' }}">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Product' ? 'menu-open' : '' }}">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>Product</p>
                    </a>
                </li>
                
                <li class="nav-item {{ !empty($title) && $title == 'Order' ? 'menu-open' : '' }}">
                    <a href="{{ route('order.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Contact' ? 'menu-open' : '' }}">
                    <a href="{{ route('contact.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Contact</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Vendor' ? 'menu-open' : '' }}">
                    <a href="{{ route('vendor.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck-moving"></i>
                        <p>Vendor</p>
                    </a>
                </li>
                @if (Auth::guard('admin')->user()->superAdmin())
                    <li class="nav-item {{ !empty($title) && $title == 'Role' ? 'menu-open' : '' }}">
                        <a href="{{ route('role.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ !empty($title) && $title == 'User' ? 'menu-open' : '' }}">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item {{ !empty($title) && $title == 'Member' ? 'menu-open' : '' }}">
                    <a href="{{ route('member.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Member</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
