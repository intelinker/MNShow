@extends('layouts.headercontent')

<body>
<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">冰+后台管理系统</a>
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
        <div>
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">登录人员管理</h1>
        </div>

        <h2>添加</h2>
        {!! Form::open(array('url'=>'users')) !!}
        <p>
            <label for="name" class="col-sm-2">姓名：</label>
            {!! Form::text('name', null, ['class'=>'col-sm-3', 'id'=>'name', 'required'=>'required', 'autofocus'=>'autofocus']) !!}
        </p>
        <p>
            <label for="cellphone" class="col-sm-2">手机号：</label>
            {!! Form::text('cellphone', null, ['class'=>'col-sm-3', 'id'=>'cellphone', 'required'=>'required']) !!}
        </p>
        <p>
            <label for="password" class="col-sm-2">密码：</label>
            {!! Form::text('password', null, ['class'=>'col-sm-3', 'id'=>'password', 'required'=>'required']) !!}
        </p>

        <p style="margin-top: 30px">
            <label for="authority_id" class="col-sm-2">权限：</label>

            {!! Form::select('authority_id', $authorities) !!}
            {{--<select id="authority">--}}
                {{--<optgroup label="设置权限">--}}
                    {{--@for($i=1; $i <=count($authorities); $i++)--}}
                        {{--<option value="{{$i}}">--}}
                            {{--{{$authorities[$i-1]['name']}}--}}
                        {{--</option>--}}
                    {{--@endfor--}}
                {{--</optgroup>--}}
            {{--</select>--}}
        </p>

        <p>
            {!! Form::submit('保存', ['class' => 'btn btn-primary', 'style' => 'margin-left:30px']) !!}
            <button type="button" class="btn btn-light" style="margin-left: 250px" onclick="javascript:history.back(-1);">取消</button>
        </p>
    </main>
</div>
</body>
