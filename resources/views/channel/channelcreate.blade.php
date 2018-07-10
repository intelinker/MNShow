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
            <h1 class="h2">顾客渠道管理</h1>
        </div>

        <h2>添加渠道{{$level + 1}}</h2>
        {!! Form::open(array('url'=>'/channels')) !!}
        {!! Form::text('level', $level, ['hidden'=>'hidden']) !!}
        @if($level > 0)
            <p id="channel1_container" style="margin-top: 30px">
                <label for="level1_id" class="col-sm-3">所属渠道一：</label>
                <label id="level1_id" class="col-sm-3">{{$channel1->name}}</label>
                {!! Form::text('level1_id', $channel1->id, ['hidden'=>'hidden']) !!}

                {{--<input type="text" id="level1_id" class="col-sm-3" value="{{$channel1->id}}">{{$channel1->name}}</input>--}}
            </p>
        @endif

        @if($level == 2)
            <p id="channel2_container" style="margin-top: 30px">
                <label for="level2_id" class="col-sm-3">所属渠道二：</label>
                <label id="level2_id" class="col-sm-3" va>{{$channel2->name}}</label>
                {!! Form::text('level2_id', $channel2->id, ['hidden'=>'hidden']) !!}

            </p>
        @endif

        <p>
            <label for="name" class="col-sm-3">渠道名称：</label>
            {!! Form::text('name', null, ['class'=>'col-sm-3', 'id'=>'name']) !!}
        </p>

        <p>
            {!! Form::submit('保存', ['class' => 'btn btn-primary', 'style' => 'margin-left:30px']) !!}
            <button type="button" class="btn btn-light" style="margin-left: 250px" onclick="javascript:history.back(-1);">取消</button>
        </p>

        {!! Form::close() !!}
    </main>
</div>


</body>