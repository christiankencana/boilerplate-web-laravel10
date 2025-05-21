<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <!-- Noble<span>UI</span> -->
            <h6>{{ config('app.name') }}</h6>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
            </li> -->

            @if (auth()->user()->hasRole(['Administrator']))
                <li class="nav-item nav-category">Web Management</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#accounts" role="button" aria-expanded="false"
                        aria-controls="accounts">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Account</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="accounts">
                        <ul class="nav sub-menu">
                            @if (auth()->user()->hasAnyPermission(['users.index', 'users.create', 'users.edit', 'users.delete']))
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">User</a>
                                </li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['roles.index', 'roles.create', 'roles.edit', 'roles.delete']))
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link">Role</a>
                                </li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['permissions.index', 'permissions.create', 'permissions.edit', 'permissions.delete']))
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}" class="nav-link">Permission</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#operations" role="button" aria-expanded="false"
                        aria-controls="operations">
                        <i class="link-icon" data-feather="layers"></i>
                        <span class="link-title">Operation</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="operations">
                        <ul class="nav sub-menu">
                            @if (auth()->user()->hasAnyPermission(['clients.index', 'clients.create', 'clients.edit', 'clients.delete']))
                                <li class="nav-item">
                                    <a href="{{ route('clients.index') }}" class="nav-link">Client</a>
                                </li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['companies.index', 'companies.create', 'companies.edit', 'companies.delete']))
                                <li class="nav-item">
                                    <a href="{{ route('companies.index') }}" class="nav-link">Company</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>

@include('layouts/offcanvas')
