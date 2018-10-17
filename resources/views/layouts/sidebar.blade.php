<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/') ? 'active' : '') }}" href="/">
                    <span data-feather="file"></span>
                    菜单展示管理
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('product*') ? 'active' : '') }}" href="/products">
                    <span data-feather="shopping-cart"></span>
                    产品内容管理
                </a>
            </li>

            @if(Auth::user()->authority->id == 0)
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('user*') ? 'active' : '') }}" href="/users">
                        <span data-feather="users"></span>
                        登录人员管理
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ ((Request::is('customer*') || Request::is('channel*')) ? 'active' : '') }}" href="/customers">
                    <span data-feather="bar-chart-2"></span>
                    顾客信息管理
                </a>
            </li>

        </ul>


    </div>
</nav>