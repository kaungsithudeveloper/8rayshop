<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <img src="{{ url('backend/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ url('backend/images/brand/logo-1.png') }}" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ url('backend/images/brand/logo-2.png') }}" class="header-brand-img light-logo"
                    alt="logo">
                <img src="{{ url('backend/images/brand/logo-3.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide ">
                    <a class="side-menu__item " data-bs-toggle="slide" href="{{ url('#') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>

                @if (Auth::user()->can('admin.menu'))
                    <li class="sub-category">
                        <h3>Admin</h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item " data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Admin
                                Manage</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="#">Admin Manage</a></li>
                            @if (Auth::user()->can('admin.list'))
                                <li><a href="{{ route('all.admin') }}" class="slide-item"> All Admin</a></li>
                            @endif
                            @if (Auth::user()->can('admin.add'))
                                <li><a href="{{ route('add.admin') }}" class="slide-item"> Create New Admin</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->can('blog.menu'))
                    <li class="sub-category">
                        <h3>Blog</h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item " data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Blog
                                Manage</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="#">Blog Manage</a></li>
                            @if (Auth::user()->can('blog.list'))
                                <li><a href="{{ route('blogs') }}" class="slide-item"> All Post</a></li>
                            @endif
                            @if (Auth::user()->can('blog.add'))
                                <li><a href="{{ route('posts.create') }}" class="slide-item"> Create New Post</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->can('role.permission.menu'))
                    <li class="sub-category">
                        <h3>Role & Permission</h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item " data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Role &
                                Permission</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="#">Role & Permission</a></li>
                            <li><a href="{{ route('all.permission') }}" class="slide-item"> All Permission</a></li>
                            <li><a href="{{ route('all.roles') }}" class="slide-item"> All Role</a></li>
                            <li><a href="{{ route('add.roles.permission') }}" class="slide-item"> Roles in
                                    Permission</a></li>
                            <li><a href="{{ route('all.roles.permission') }}" class="slide-item"> All Roles in
                                    Permission </a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- APP-SIDEBAR END -->
