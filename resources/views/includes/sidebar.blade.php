<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
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
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>


            <li class="nav-item nav-category">Sidebar Content</li>

            {{-- Role & Permission --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#user" role="button" aria-expanded="false"
                    aria-controls="user">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Role & Permission</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>


                <div class="collapse" id="user">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('role') }}" class="nav-link">Role Manage</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('permission') }}" class="nav-link">Permission Manage</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('add.role.permission') }}" class="nav-link">Add Role in Permission</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('role.permission') }}" class="nav-link">Permission Under Role</a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#customer" role="button" aria-expanded="false"
                    aria-controls="customer">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">User Manage</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>


                <div class="collapse" id="customer">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user') }}" class="nav-link">User</a>
                        </li>


                    </ul>
                </div>
            </li>



        </ul>
    </div>
</nav>
