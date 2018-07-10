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

        <h2>添加渠道</h2>
        {!! Form::open(array('url'=>'/channels')) !!}
        <p style="margin-top: 30px">
            <label for="level" class="col-sm-3">渠道等级：</label>
            @if(count($level1) == 0)
                {!! Form::label('level', '渠道一', array('class'=>'col-sm-3', 'id'=>'level')) !!}
            @elseif(count($level1) != 0 && count($level2) == 0)
                {!! Form::select('level', array('渠道一', '渠道二'), array('class'=>'col-sm-3','id'=>'level')) !!}
            @else
                {!! Form::select('level', array('渠道一', '渠道二', '渠道三'), array('class'=>'col-sm-3', 'id'=>'level')) !!}
            @endif
        </p>


        <p id="channel1_container" style="margin-top: 30px" hidden>
            <label for="level1_id" class="col-sm-3">所属渠道一：</label>
            @if (count($level1)> 0)
                {{--{!! Form::select('level1_id', $level1, array('id'=>'level1_id')) !!}--}}
                {{--<form></form>--}}
                <select id="level1_id" name="level1_id">
                    @for($i=0; $i< count($level1); $i++)
                        <?php $channel = $level1[$i]; ?>
                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endfor
                </select>
            @endif

        </p>

        <p id="channel2_container" style="margin-top: 30px" hidden>
            <label for="level2_id" class="col-sm-3">所属渠道二：</label>
            @if (count($level2)> 0 && count($level2[0]) > 0)
{{--                {!! Form::select('level2_id', $level2[0], array('id'=>'level2_id')) !!}--}}
                <select id="level2_id" name="level2_id">
                    @for($i=0; $i< count($level2[0]); $i++)
                        <?php $channel = $level1[$i]; ?>
                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endfor
                </select>
            @endif

        </p>

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
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript">
    document.getElementsByName("level")[0].onchange = function() {
        // console.log($(this).val());
        var level2_container = $('#channel2_container')[0];

        if ($(this).val() == 0) {
            $('#channel1_container')[0].hidden = true;
            level2_container.hidden = true;
        }  else if ($(this).val() == 1) {

            $('#channel1_container')[0].hidden = false;
            level2_container.hidden = true;

            var channel1 = "<?php echo urlencode(json_encode($level1)); ?>";
            channel1 = eval(decodeURIComponent(channel1));
            // console.log(channel1);

            // var submenu = channel1[$(this).val()];

            var level1 = document.getElementsByName('level1_id')[0];
            level1.innerHTML = "";

            if (channel1.length > 0) {
                level1_container.hidden = false;
                for (var i=0; i<channel1.length; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.textContent = submenu[i];
                    level2.appendChild(option);
                }
            } else {
                level2_container.hidden = true;
            }

        } else {
            $('#channel1_container')[0].hidden = false;
            level2_container.hidden = false;
            var level1 = document.getElementsByName('level1_id')[0];
            var level2 = document.getElementsByName('level2_id')[0];

            var channel2 = "<?php echo urlencode(json_encode($level2)); ?>";
            channel2 = eval(decodeURIComponent(channel2));

            var submenu = channel2[level1.selectedIndex];
            console.log('submenu' + submenu);

            level2.innerHTML = "";

            if (submenu.length > 0) {
                level2_container.hidden = false;
                for (var i=0; i<submenu.length; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.textContent = submenu[i];
                    level2.appendChild(option);
                }
                // console.log(level2_container);
            } else {
                // level2_container.hidden = true;
            }
        }
    }
    $('#level').on('change', function (e) {

    });

</script>