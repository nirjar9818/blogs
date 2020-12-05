<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active">
                    <a href="#">Dashboard</a>
                </li>
                
                <li>
                    <a href="{{route('user.index')}}">
                        <i class="fas fa-chart-bar"></i>Users</a>
                </li>
                <li>
                    <a href="{{route('category.index')}}">
                        <i class="fas fa-chart-bar"></i>Categories</a>
                </li>
                <li>
                    <a href="{{route('post.index')}}">
                        <i class="fas fa-chart-bar"></i>Posts</a>
                </li>
               
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->