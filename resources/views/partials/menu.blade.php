<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route('admin.home') }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    Dashboard
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>User Management</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li
                                class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <a href="{{ route('admin.permissions.index') }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>Permissions</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <a href="{{ route('admin.roles.index') }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>Roles</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>Users</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('management_mahasiswa_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>Sidang Sarjana FMIPA</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('mahasiswa_access')
                            <li
                                class="{{ request()->is('admin/mahasiswas') || request()->is('admin/mahasiswas/*') ? 'active' : '' }}">
                                <a href="{{ route('admin.mahasiswas.index') }}">
                                    <i class="fa-fw fas fa-tasks">

                                    </i>
                                    <span>Identitas Mahasiswa</span>

                                </a>
                            </li>
                        @endcan
                        @can('orangtua_access')
                            <li
                                class="{{ request()->is('admin/orangtuas') || request()->is('admin/orangtuas/*') ? 'active' : '' }}">
                                <a href="{{ route('admin.orangtuas.index') }}">
                                    <i class="fa-fw fas fa-user-friends">

                                    </i>
                                    <span>Identitas Orang Tua</span>

                                </a>
                            </li>
                        @endcan
                        @can('syarat_access')
                            <li
                                class="{{ request()->is('admin/syarats') || request()->is('admin/syarats/*') ? 'active' : '' }}">
                                <a href="{{ route('admin.syarats.index') }}">
                                    <i class="fa-fw fas fa-user-friends">

                                    </i>
                                    <span>Dokumen Persyaratan Sidang</span>

                                </a>
                            </li>
                        @endcan
                        @can('nilai_access')
                            <li class="{{ request()->is("admin/nilais") || request()->is("admin/nilais/*") ? "active" : "" }}">
                                <a href="{{ route("admin.nilais.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>Penilaian</span>

                                </a>
                            </li>
                        @endcan
                        @can('skpi_access')
                            <li class="{{ request()->is("admin/skpis") || request()->is("admin/skpis/*") ? "active" : "" }}">
                                <a href="{{ route("admin.skpis.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>Data SKPI</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li
                        class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            Ganti Password
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    Keluar
                </a>
            </li>
        </ul>
    </section>
</aside>
