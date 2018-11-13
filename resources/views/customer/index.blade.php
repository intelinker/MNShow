@extends('layouts.headercontent')

<body>
<link href="/css/datetimepicker.css" rel="stylesheet">

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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">顾客信息管理</h1>
        </div>

        <h2>顾客信息</h2>
        {!! Form::open(array('url'=>'customersearch')) !!}
        <div>
            {!! Form::text('name', null, ['id'=>'name', 'placeholder'=>'顾客名称']) !!}
            {!! Form::text('visit_time', null, ['class'=>'form_datetime', 'id'=>'visit_time', 'placeholder'=>'拜访时间', 'readonly'=>'readonly']) !!}

            {!! Form::select('channel_category1', ['10000'=>'所有渠道一']) !!}
            {!! Form::select('channel_category2', ['20000'=>'所属渠道二']) !!}
            {!! Form::select('channel_category3', ['30000'=>'所属渠道三']) !!}
        </div>
        <div>
            {!! Form::text('created_by', null, ['id'=>'created_by', 'placeholder'=>'录入人']) !!}
            {!! Form::text('contract_time', null, ['class'=>'form_datetime', 'id'=>'contract_time', 'placeholder'=>'签订合同时间', 'readonly'=>'readonly']) !!}
            {!! Form::text('contract_duration', null, ['id'=>'contract_duration', 'placeholder'=>'签订合同期限']) !!}
            {!! Form::text('corpration_product', null, ['id'=>'corpration_product', 'placeholder'=>'合作产品']) !!}
            {!! Form::submit('搜索', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <button type="button" class="btn btn-warning" style="margin-right: 30px; float:right" onclick="channels()">渠道管理</button>
            {{--<button type="button" class="btn btn-danger col-sm-1" style="margin-right: 30px; float:right" onclick="create()">添加顾客</button>--}}
            <button type="button" class="btn btn-success" style="margin-right: 30px; float:right" onclick="exportExcel()">报表导出</button>
        </div>
        {{--<div style="margin-top:30px; margin-bottom: 80px">--}}
            {{--<button type="button" class="btn btn-warning" style="margin-right: 30px; float:right" onclick="channels()">渠道管理</button>--}}
            {{--<button type="button" class="btn btn-danger col-sm-1" style="margin-right: 30px; float:right" onclick="create()">添加顾客</button>--}}
            {{--<button type="button" class="btn btn-success" style="margin-right: 30px; float:right" onclick="exportExcel()">报表导出</button>--}}
        {{--</div>--}}
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">顾客名称</th>
                    <th scope="col">门店数量</th>
                    <th scope="col">渠道分类一</th>
                    <th scope="col">渠道分类二</th>
                    <th scope="col">渠道分类三</th>
                    <th scope="col">图片</th>
                    <th scope="col">拜访时间</th>
                    <th scope="col">签订合同时间</th>
                    <th scope="col">签订合同期限</th>
                    <th scope="col">合作产品</th>
                    {{--<th scope="col">进展</th>--}}
                    <th scope="col">录入人</th>
                    <th scope="col">操作</th>

                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($customers); $i++)
                    <?php
                        $customer = $customers[$i];
                        $channel2 = $customer->channel2;
                        $channel3 = $customer->channel3;
                    ?>
                    <tr>
                        {!! Form::open(array('url'=>'/customers/'.$customer->id, 'method'=>'delete')) !!}
                        <th scope="row">{{$i + 1}}</th>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->store_count}}</td>
                        <td>@if($customer->channel1 != null) {{$customer->channel1->name}} @else 该渠道不存在 @endif</td>
                        <td>@if($channel2 != null) {{$channel2->name}} @else - @endif</td>
                        <td>@if($channel3 != null) {{$channel3->name}} @else - @endif</td>
                        <td>@if($customer->image != null && count($customer->image) > 0) <img width="50px" src="{{$customer->image[0]->link}}"> @endif</td>
                        <td>{{$customer->visit_time}}</td>
                        <td>{{$customer->contract_time}}</td>
                        <td>{{$customer->contract_duration}}</td>
                        <td>{{$customer->corpration_products}}</td>
                        {{--<td>合作进展</td>--}}
                        <td>@if($customer->creator != null) {{ $customer->creator->name }} @else 该用户不存在 @endif</td>
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
<script src="/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
    window.onload = function(){
        var level1 = document.getElementsByName('channel_category1')[0];
        var level2 = document.getElementsByName('channel_category2')[0];
        var level3 = document.getElementsByName('channel_category3')[0];
        level1.id = "channel_category1";
        level2.hidden = true;
        level3.hidden = true;
        var channels = "<?php echo urlencode(json_encode($channels)); ?>";
        channels = eval(decodeURIComponent(channels));

        for (var i=0; i<channels.length; i++) {
            var channel = channels[i];

            if (channel['level'] == 0) {
                var option = document.createElement('option');
                option.value = channel['id'];
                option.textContent = channel['name'];
                // alert(option.textContent);

                level1.appendChild(option);

            }
        }
    };

    // $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii',minView: "month", language: 'cn'});
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd',minView: "month", language: 'cn', autoclose: 1});

    document.getElementsByName('channel_category1')[0].onchange = function () {
        var level2 = document.getElementsByName('channel_category2')[0];
        var level3 = document.getElementsByName('channel_category3')[0];
        level2.innerHTML = "";
        if ($(this).val() == 10000) {
            level2.hidden = true;
            level3.hidden = true;
        } else {
            level2.hidden = false;
            var option = document.createElement('option');
            option.value = 20000;
            option.textContent = '所属渠道二';
            level2.appendChild(option);
            var channels = "<?php echo urlencode(json_encode($channels)); ?>";
            channels = eval(decodeURIComponent(channels));
            for (var i=0; i<channels.length; i++) {
                var channel = channels[i];
                if (channel['level'] == 1 && channel['level1_id'] == $(this).val()) {
                    var option = document.createElement('option');
                    option.value = channel['id'];
                    option.textContent = channel['name'];
                    level2.appendChild(option);
                }
            }
        }
    }

    document.getElementsByName('channel_category2')[0].onchange = function () {
        var level1 = $('#channel_category1');
        var level3 = document.getElementsByName('channel_category3')[0];
        level3.innerHTML = "";
        if ($(this).val() == 20000) {
            level3.hidden = true;
        } else {
            level3.hidden = false;
            var option = document.createElement('option');
            option.value = 30000;
            option.textContent = '所属渠道三';
            level3.appendChild(option);
            var channels = "<?php echo urlencode(json_encode($channels)); ?>";
            channels = eval(decodeURIComponent(channels));
            for (var i=0; i<channels.length; i++) {
                var channel = channels[i];
                // level2.hidden = false;
                // console.log('level:' + channel['level'] + '/ level1_id:' + level1 + "/this:" + $(this));
                if (channel['level'] == 2 && channel['level1_id'] == level1.val() && channel['level2_id'] == $(this).val()) {
                    // console.log(channel);
                    var option = document.createElement('option');
                    option.value = channel['id'];
                    option.textContent = channel['name'];
                    level3.appendChild(option);
                }
            }
        }
    }

    function exportExcel() {
        $uri = '/customersexport';
        // $.get($uri, function(res) {
        //     // console.log(res);
        // });
        window.location.assign($uri);
    }

    function channels() {
        $uri = '/channels';
        window.location.assign($uri);
    }

    function channelManage() {
        $uri = '/customers/create';
        window.location.assign($uri);
    }

    function delProduct(product) {
        $uri = '/products/create';
        window.location.assign($uri);

    }
</script>
