<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0; min-height: 0 !important; height:0">

        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('build/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                @if (Auth::check())
                    <h2 style="display: none">Login</h2>
                @else
                    <h2>Login</h2>
                @endif


                @if (Auth::check())
                <h2>{{ Auth::user()->name }}</h2>
                @endif
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li class="current-page">
                        <a href="{{route('showDashboard')}}">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="current-page">
                        <a href="{{route('showChat')}}">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            Support Chat
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Management</h3>
                <ul class="nav side-menu">
                    <li class="current-page">
                        <a href="{{route('users.index')}}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Users
                        </a>
                    </li>
                </ul>
                <ul class="nav side-menu">
                    <li class="current-page">
                        <a href="{{route('admin_users.index')}}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Admins
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Contact</h3>
                <ul class="nav side-menu">
                    <li class="current-page">
                        <a href="{{route('contact.index')}}">
                            <i class="fa fa-mail-forward" aria-hidden="true"></i>
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>News</h3>
                <ul class="nav side-menu">
                    <li class="current-page">
                        <a href="{{route('news_feeds.index')}}">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            News Feeds
                        </a>
                    </li>
                    <li class="current-page">
                        <a href="{{route('news_feeds.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Add New Feed
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('session.getLogout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
