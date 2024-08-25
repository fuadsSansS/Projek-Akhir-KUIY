<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion hide-print" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center hide-print" href="dashboard">
        <div class="sidebar-brand-icon hide-print">
            <img src="{{asset('image/logo-yarsi.png')}}" alt="Logo" style="height: 2.5rem" class="hide-print">
        </div>
        <div class="sidebar-brand-text mx-3 hide-print">KUI YARSI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active hide-print">
        <a class="nav-link" href="{{route('index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Akomodation
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) === 'homestay' ? 'active' : '' }}" href="{{ route('homestay') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Apartment</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) === 'dormitory' ? 'active' : '' }}" href="{{ route('dormitory') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Dormitory</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) === 'hotel' ? 'active' : '' }}" href="{{ route('hotel') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Hotel</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administration
    </div>

    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) === 'asuransi' ? 'active' : '' }}" href="{{ route('asuransi') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Insurance</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) === 'keimigrasian' ? 'active' : '' }}"
            href="{{ route('keimigrasian') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Immigration</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) === 'visa' ? 'active' : '' }}" href="{{ route('visa') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Form Study Exchange </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Charts -->

    @if (Auth::user()->role === 'admin')
        <div class="sidebar-heading">
            Report
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('rincian') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Details</span></a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
