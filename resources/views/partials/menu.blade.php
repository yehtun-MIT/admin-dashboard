<!-- partial:../../partials/_settings-panel.html -->
<div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="ti-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
        </div>
    </div>
</div>
<!-- partial -->
{{-- <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item ">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu  {{ request()->is('admin/permissions*') ? 'active open' : '' }} {{ request()->is('admin/roles*') ? 'active open' : '' }} {{ request()->is('admin/users*') ? 'active open' : '' }}">
                    <li class="nav-item  {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                    <li class="nav-item  {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="nav-item  {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                </ul>
            </div>
            
        </li>
       
        <li class="nav-item {{ request()->is('admin/posts*') && !request()->is('admin/users*') ? 'active open' : '' }} ">
            <a class="nav-link" href="{{ route('admin.posts.index') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>
    </ul>
</nav> --}}
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="http://127.0.0.1:8000">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
    @can('user_management_access')
    <li
    class="nav-item {{ Request::is('admin/permissions*') ? 'active' : '' }} {{ Request::is('admin/roles*') ? 'active' : '' }} {{ Request::is('admin/users*') ? 'active' : '' }} {{ Request::is('admin/audit_logs*') ? 'active' : '' }}">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">User Management</span>
        <i class="menu-arrow"></i>
    </a>

    <div class="collapse {{ Request::is('admin/permissions*') ? 'show' : '' }} {{ Request::is('admin/roles*') ? 'show' : '' }} {{ Request::is('admin/users*') ? 'show' : '' }} {{ Request::is('admin/audit_logs*') ? 'show' : '' }}"
        id="ui-basic">
        <ul class="nav flex-column sub-menu">
            @can('permission_access')
                <li class="nav-item {{ Request::is('admin/permissions*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.permissions.index') }}">Permissions</a>
                </li>
            @endcan

            @can('role_access')
                <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a>
                </li>
            @endcan

            @can('user_access')
                <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                </li>
            @endcan

            @can('audit_logs_access')
                <li class="nav-item {{ Request::is('admin/audit_logs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.audit_logs.index') }}">Audit Logs</a>
                </li>
            @endcan
        </ul>
    </div>
</li>
    @endcan
        

        <li class="nav-item {{ Request::is('admin/posts*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.posts.index') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/system-calendar*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.systemCalendar') }}">
                <i class="mdi mdi-calendar menu-icon"></i>
                <span class="menu-title">System Calander</span>
            </a>
        </li>
    </ul>
</nav>



@section('scripts')
@endsection
