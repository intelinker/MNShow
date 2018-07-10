@extends('layouts.headercontent')

<body>
<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">冰+后台管理系统</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            {{--<label>{{Auth::user()->name}}</label>--}}
            <a class="nav-link" href="/logout">退出登录</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">登录人员管理</h1>
        </div>

        <h2>登录人员列表</h2>
        <p>
            <input id="search_text" type="text" placeholder="姓名">
            <button type="button" class="btn btn-primary col-sm-1" style="margin-left: 20px" onclick="search()">搜索</button>
            <button type="button" class="btn btn-danger col-sm-1" style="margin-right: 30px; float:right" onclick="create()">添加</button>
        </p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">姓名</th>
                    <th scope="col">手机号</th>
                    <th scope="col">密码</th>
                    <th scope="col">权限</th>
                    <th scope="col">时间</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>

                @for($i=0; $i < count($users); $i++)
                    @php $user = $users[$i]; @endphp
                    <tr>
                        {!! Form::open(array('url'=>'/users/'.$user->id, 'method'=>'delete')) !!}
                        <th scope="row">{{$i + 1}}</th>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['cellphone']}}</td>
                        <td>{{$user['vipass']}}</td>
                        <td>{{$user->authority->name}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <button id={{"edit_".$i}} type="button" class="btn btn-warning" onclick="edit({{$user['id']}})">修改</button>
                            {!! Form::submit('删除', ['class' => 'btn btn-light', 'style' => 'margin-left:30px']) !!}
                        </td>
                        {!! Form::close() !!}
                    </tr>
                @endfor
                {{--<tr>--}}
                    {{--<th scope="row">2</th>--}}
                    {{--<td>正序第二位</td>--}}
                    {{--<td>产品介绍</td>--}}
                    {{--<td><img src=""></td>--}}
                    {{--<td></td>--}}
                    {{--<td></td>--}}
                {{--</tr>--}}
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript">
    function create(product) {
        $uri = '/users/create';
        window.location.assign($uri);
    }

    function search() {
        // alert($('#search_text').val());
        var content = $('#search_text').val();
        if (content != null && content.length > 0) {
            $uri = '/usersearch/' + content;
            window.location.assign($uri);
        } else {
            alert("请输入搜索内容");
        }

    }

    function edit(user) {
        $uri = '/users/' + user + '/edit';
        window.location.assign($uri);
    }

    function del(product) {
        $uri = '/products/create';
        window.location.assign($uri);

    }
</script>
