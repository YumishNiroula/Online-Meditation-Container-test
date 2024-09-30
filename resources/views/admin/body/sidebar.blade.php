<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('dashboard') }}">
                    @php
                        $app = App\Models\ApplicationSettings::latest()->first();
                    @endphp
                    <img src="{{ !empty($app->image) ? url('uploads/logo/' . $app->image) : url('uploads/logo.png') }}"
                        alt="logo" height="40" />
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span data-i18n="Dashboad">Dashboad</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="active nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboad">Dashboad</span></a>
            </li>

            <li class=" navigation-header"><span data-i18n="System Setup">System Setup</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="settings"></i><span class="menu-title text-truncate"
                        data-i18n="Settings">Settings</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1">3</span></a>
                <ul class="menu-content">


                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                data-feather="settings"></i><span class="menu-title text-truncate"
                                data-i18n="Admin User">App Setup</span><span
                                class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{ route('app-settings.index') }}"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Add Admin">General
                                    </span></a>
                            </li>
                        </ul>
                    </li>


                    <li class=" nav-item"><a class="d-flex align-items-center"
                            href="{{ route('users.index') }}"><i data-feather='user'></i><span
                                class="menu-title text-truncate" data-i18n="Users">User</span><span
                                class="badge badge-light-warning rounded-pill ms-auto me-1">1</span></a>
                    </li>


                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                data-feather="settings"></i><span class="menu-title text-truncate"
                                data-i18n="Role & Permission">Role & Permission</span><span
                                class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a>
                        <ul class="menu-content">
                            @can('role_access')
                                <li><a class="d-flex align-items-center" href="{{ route('roles.index') }}"><span
                                            class="menu-item text-truncate" data-i18n="Roles">Roles</span></a>
                                </li>
                            @endcan
                            @role('Super Admin')
                                <li><a class="d-flex align-items-center" href="{{ route('permissions.index') }}"><span
                                            class="menu-item text-truncate" data-i18n="Permissions">Permissions</span></a>
                                </li>
                            @endrole
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
