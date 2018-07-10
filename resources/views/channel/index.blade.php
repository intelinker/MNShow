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

        @if(Session::has('branch_exist_error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('branch_exist_error') }}
            </div>
        @endif

        <h2>渠道列表</h2>
        <div>
            <button type="button" class="btn btn-danger" style="margin-right: 30px; float:right; margin-bottom: 20px" onclick="javascript:window.location.href='/channelcreate0'">添加渠道一</button>
        </div>
        <div class="table-responsive">
            <table class="table ">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">渠道一名称</th>
                    <th scope="col">渠道二名称</th>
                    <th scope="col">渠道三名称</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($channels); $i++)
                    <tr>
                        <?php $channel = $channels[$i] ?>
                        {!! Form::open(array('url'=>'/channels/'.$channel->id, 'method'=>'delete')) !!}
                        <th scope="row">{{$i +1}}</th>
                        <td>
                            @if($channel->level == 0)
                                {{$channel->name}}
                            @else
                                {{$channel->channel1->name}}
                            @endif
                        </td>
                        <td>
                            @if($channel->level == 0)
                                <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='/channelcreate1/{{$channel->id}}'">添加</button>
                            @elseif($channel->level == 1)
                                {{$channel->name}}
                            @else
                                {{$channel->channel2->name}}
                            @endif
                        </td>
                        <td>@if($channel->level == 0)
                                -
                            @elseif($channel->level == 1)
                                <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='/channelcreate/2/{{$channel->level1_id}}/{{$channel->id}}'">添加</button>
                            @else
                                {{$channel->name}}
                            @endif
                        </td>
                        <td>
                            {!! Form::submit('删除', ['class' => 'btn btn-light']) !!}
                        </td>
                        {!! Form::close() !!}
                    </tr>
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

    function create(menu_id) {
        $uri = '/channels/create';
        window.location.assign($uri);
    }

    function resetVisible(menu_id) {
        // alert($('#visible_' + menu_id)[0]);
        var viButton = $('#visible_' + menu_id)[0];
        if (viButton.textContent == '显示') {
            viButton.className = 'btn btn-light';
            viButton.textContent = '不显示';
        } else {
            viButton.className = 'btn btn-primary';
            viButton.textContent = '显示';
        }

    }
</script>