<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style = "z-index: 1040 !important;">
    <!-- Brand Logo -->
    <a 
    @can('admin-access')
        href="{{ route('admin.index') }}"
    @endcan
    class="brand-link text-center">
        <span class="brand-text font-weight-light ">Absence Here!</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">      
                <img
                    src="/dist/img/firyanul.png"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
                
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >
                @can('admin-access')

                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                                Dashboard Admin
                            
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.employees.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs(['admin.employees.index']) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Karyawan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.employees.index') }}" class="nav-link {{ request()->routeIs('admin.employees.index') ? 'active' : '' }}">
                                <p>&nbsp; Daftar Karyawan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('admin.timetable.index', 'admin.breaktime.index', 'admin.shift.index', 'admin.schedule.index') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.timetable.index', 'admin.breaktime.index', 'admin.shift.index', 'admin.schedule.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-clock"></i>
                        <p>
                            Manajemen Waktu
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.breaktime.index') }}" class="nav-link {{ request()->routeIs('admin.breaktime.index') ? 'active' : '' }}">
                                <p>&nbsp; Breaktime</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.timetable.index') }}" class="nav-link {{ request()->routeIs('admin.timetable.index') ? 'active' : '' }}">
                                <p>&nbsp; Timetable</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.shift.index') }}" class="nav-link {{ request()->routeIs('admin.shift.index') ? 'active' : '' }}">
                                <p>&nbsp; Shift</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.schedule.index') }}" class="nav-link {{ request()->routeIs('admin.schedule.index') ? 'active' : '' }}">
                                <p>&nbsp; Schedule</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Menu Organisasi -->
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.employees.department', 'admin.positions']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs(['admin.employees.department', 'admin.positions']) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            Organisasi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.employees.department') }}" class="nav-link {{ request()->routeIs('admin.employees.department') ? 'active' : '' }}">
                                <p>&nbsp; Departemen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.positions') }}" class="nav-link {{ request()->routeIs('admin.positions') ? 'active' : '' }}">
                                <p>&nbsp; Jabatan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('admin.employees.attendance') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.employees.attendance') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.employees.attendance') }}" class="nav-link {{ request()->routeIs('admin.employees.attendance') ? 'active' : '' }}">
                                <p>&nbsp;Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @endcan
              
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    
</aside>
