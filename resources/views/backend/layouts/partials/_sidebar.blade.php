<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset($company->logo) }}" alt="admin" class="brand-image  elevation-3" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(auth()->guard('admin')->user()->image) }}" class="img-circle elevation-2"
                    alt="AI">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ auth()->guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- admin --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Admin
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.auth.adminList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Admin List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.auth.createAdmin') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Create New Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.auth.customerList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Customer List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Packages Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.packages.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Package List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package_details.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Package Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package_pricings.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Package Pricing</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- company info --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Company Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.showCompanyInfo') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Company Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.pageList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
