@extends('layouts.headercontent')

<body>
    <nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">冰+后台管理系统</a>
        {{--<input class="form-control form-control w-100" type="text" placeholder="搜索" aria-label="Search">--}}
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/logout">退出登录</a>
            </li>
        </ul>
    </nav>
    @csrf
    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidebar')
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">菜单展示管理</h1>
            </div>

            <h2>菜单列表</h2>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                    <tr>
                        <th scope="col">序号</th>
                        <th scope="col">菜单位置</th>
                        <th scope="col">菜单一级目录名称</th>
                        <th scope="col">图标</th>
                        <th scope="col">菜单二级目录名称</th>
                        <th scope="col" style="min-width: 200px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0; $i < count($menus); $i++)
                        <?php $menu = $menus[$i] ?>
                        <tr>
                            <th scope="row">{{$i + 1}}</th>
                            <td>正序第{{$i + 1}}位</td>
                            <td>{{$menu['name']}}</td>
                            <td><img src="{{$menu['avatar']}}" width="40px"></td>
                            <td>{{$menu['level2_contents'] == null ? '无' : $menu['level2_contents']}}</td>
                            <td>
                                <button id="edit_1" type="button" class="btn btn-warning" href="/menu/1/edit" onclick="edit({{$menu->id}})">修改</button>
                                <button id={{"visible_".$menu->id}} type="button"
                                        @if($menu->visible == 0)
                                            class="btn btn-light"
                                        @else
                                            class="btn btn-primary"
                                        @endif
                                        style="margin-left: 30px" onclick="resetVisible({{$menu->id}})">
                                    @if($menu->visible == 0)
                                        不显示
                                    @else
                                        显示
                                    @endif
                                </button>
                            </td>
                    @endfor
                    </tbody>
                </table>
            </div>

        </main>
    </div>


</body>
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript">
    function edit(menu) {
        // alert(menu_id);
        $uri = '/menus/' + menu +'/edit';
        window.location.assign($uri);
    }

    function resetVisible(menu_id) {
        // alert($('#visible_' + menu_id)[0]);
        var viButton = $('#visible_' + menu_id)[0];
        var visible;
        if (viButton.className == 'btn btn-primary') {
            visible = 0;
            viButton.className = 'btn btn-light';
            viButton.textContent = '不显示';
        } else {
            viButton.className = 'btn btn-primary';
            viButton.textContent = '显示';
            visible = 1;
        }
        $uri = 'menuvisible/' + menu_id + '/' + visible;
        $.get($uri, function(res) {
            console.log(res);
        });
    }
</script>