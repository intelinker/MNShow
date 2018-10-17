@extends('layouts.headercontent')

<body>
<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">冰+后台管理系统</a>
    {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
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
            <h1 class="h2">产品内容管理</h1>
        </div>

        <h2>添加产品</h2>
        {!! Form::open(array('url'=>'/products', 'files'=>true)) !!}

        <p style="margin-top: 30px">
            <label for="title" class="col-sm-2">主标题：</label>
            {!! Form::text('title', null, ['class'=>'col-sm-3', 'id'=>'title', 'required'=>'required', 'autofocus'=>'autofocus']) !!}
        </p>

        <p>
            <label for="subtitle" class="col-sm-2">副标题：</label>
            {!! Form::text('subtitle', null, ['class'=>'col-sm-3', 'id'=>'subtitle']) !!}
        </p>

        <p>
            <label for="weight" class="col-sm-2">净含量：</label>
            {!! Form::text('weight', null, ['class'=>'col-sm-3', 'id'=>'weight']) !!}
        </p>

        <p>
            <label for="intro" class="col-sm-2">介绍：</label>
            {!! Form::textarea('intro', null, ['class'=>'col-sm-8', 'id'=>'intro']) !!}
        </p>

        <p>
            <label for="avatar" class="col-sm-2">图片：</label>
            {!! Form::file('avatar', array('class'=>'col-md-3', 'id'=>'avatar', 'required'=>'required')) !!}
            <img id="avatar_image" width="100"/>
        </p>


        <p>
            <label for="select" class="col-sm-2">所属一级菜单：</label>
            {!! Form::select('level1', $menu) !!}
            {{--<select id="select">--}}
                {{--<optgroup label="所属一级菜单">--}}
                    {{--@for($i=0; $i <count($menu); $i++)--}}
                        {{--<option value="{{$i}}">--}}
                            {{--{{$menu[$i]}}--}}
                        {{--</option>--}}
                    {{--@endfor--}}
                {{--</optgroup>--}}
            {{--</select>--}}
        </p>

        <p id="level2_container" @if(count($menu2[0]) == 0) hidden @endif>
            <label for="select" class="col-sm-2">所属二级菜单：</label>
            {!! Form::select('level2', $menu2[0])!!}

            {{--<select id="select">--}}
                {{--<optgroup label="所属二级菜单">--}}
                    {{--@for($i=1; $i <=count($menu2); $i++)--}}
                        {{--<option value="{{$i}}">--}}
                            {{--正序第{{$i}}位--}}
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
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript">
    document.getElementsByName('level1')[0].onchange = function () {
        var menu2 = "<?php echo urlencode(json_encode($menu2)); ?>";
        menu2 = eval(decodeURIComponent(menu2));
        var submenu = menu2[$(this).val()];
        var level2_container = document.getElementById('level2_container');
        var level2 = document.getElementsByName('level2')[0];
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
            level2_container.hidden = true;
        }
    }

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