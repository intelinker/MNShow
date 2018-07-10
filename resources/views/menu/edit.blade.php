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

<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">菜单展示管理</h1>
        </div>

        <h2>修改菜单</h2>
        {!! Form::open(array('url'=> '/menus/'.$menu->id, 'method'=>'put', 'files'=>true)) !!}
        {{--<input type="hidden" name="_method" value="PUT">--}}
        <p style="margin-top: 30px">
            <label for="position" class="col-sm-3">菜单位置：</label>
            <label id="position">正序第{{$menu->level1_seq}}位</label>
            {{--<select id="select">--}}
                {{--<optgroup label="Option group 1">--}}
                    {{--@for($i=1; $i <=5; $i++)--}}
                        {{--<option value="{{$i}}">--}}
                            {{--正序第{{$i}}位--}}
                        {{--</option>--}}
                    {{--@endfor--}}
                {{--</optgroup>--}}
            {{--</select>--}}
        </p>

        <p>
            <label for="name" class="col-sm-3">菜单一级目录名称：</label>
            {!! Form::text('name', $menu->name, ['class'=>'col-sm-3', 'id'=>'name', 'required'=>'required', 'autofocus'=>'autofocus']) !!}
        </p>

        <p>
            <label for="avatar" class="col-sm-3">图标：</label>
            {!! Form::file('avatar', array('class'=>'col-md-3', 'id'=>'avatar')) !!}
            <img id="avatar_image" width="100" src="{{ $menu->avatar }}"/>

            {{--            {!! Form::file('avatar') !!}--}}
            {{--<input type="file">--}}
        </p>

        <p>
            <label for="level2_contents" class="col-sm-3">菜单二级目录名称：</label>
            {!! Form::text('level2_contents', $menu->level2_contents, ['class'=>'col-sm-8', 'id'=>'level2_contents']) !!}
        </p>

        <p>
            <label class="col-sm-3"></label>
            <label>如果超过1个，用英文","逗号隔开</label>
        </p>

        <p>
            <label class="col-sm-1"></label>
            {!! Form::submit('保存', ['class' => 'btn btn-primary', 'style' => 'margin-left:10px']) !!}
            <button type="button" class="btn btn-light" style="margin-left: 300px">取消</button>
        </p>
        {!! Form::close() !!}
    </main>
</div>
</body>

<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript">
    document.getElementById("avatar").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
    // get loaded data and render thumbnail.
    document.getElementById("avatar_image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    };
</script>