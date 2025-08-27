<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="{{ asset('admin/assets/img/find_user.png')}}" class="user-image img-responsive"/>
            </li>


            <li>
                <a class="{{ Request::is('admin/dashboard*') ? 'active-menu': '' }}"  href="{{ route('super-admin.dashboard') }}"><i class="fa fa-dashboard fa-3x"></i> Go to Super Admin</a>
            </li>


            <li>
                <a class="{{ Request::is('admin/menu*') ? 'active-menu': '' }}" href="#"><i class="fa fa-bars fa-3x"></i> Menu <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('menu.create') }}">Add New Menu</a>
                    </li>
                    <li>
                        <a href="{{ route('menu.index') }}">All Menu</a>
                    </li>

                </ul>
            </li>
            <li>
                <a class="{{ Request::is('admin/page*') ? 'active-menu': '' }}" href="#"><i class="fa fa-newspaper-o fa-3x"></i> Page <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('page.create') }}">Add New Page</a>
                    </li>
                    <li>
                        <a href="{{ route('page.index') }}">All Page</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="{{ Request::is('admin/bigadvertise*') ? 'active-menu': '' }}" href="#"><i class="fa fa-desktop fa-3x"></i> Advertisement <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('bigadvertise.index') }}">All Big Advertise</a>
                    </li><li>
                        <a href="{{ route('smalladvertise.index') }}">All Small Advertise</a>
                    </li>

                </ul>
            </li>


            <li>
                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i class="fa fa-sign-out fa-3x"></i> Logout</a>
            </li>





        </ul>

    </div>

</nav>
