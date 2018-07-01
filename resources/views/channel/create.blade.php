@extends('layouts.headercontent')

<body>
<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">冰+后台管理系统</a>
    {{--<input class="form-control form-control w-100" type="text" placeholder="搜索" aria-label="Search">--}}
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">退出登录</a>
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
        <p style="margin-top: 30px">
            <label for="channel_level" class="col-sm-3">渠道等级：</label>
            <select id="channel_level">
                <optgroup label="渠道等级">
                    @for($i=1; $i <=3; $i++)
                        <option value="{{$i}}">
                            渠道{{$i}}
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>


        <p id="channel1_container" style="margin-top: 30px" hidden>
            <label for="channel1" class="col-sm-3">所属渠道一：</label>
            <select id="channel1">
                <optgroup label="渠道等级">
                    @for($i=1; $i <=3; $i++)
                        <option value="{{$i}}">
                            渠道{{$i}}
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>

        <p id="channel2_container" style="margin-top: 30px" hidden>
            <label for="channel2" class="col-sm-3">所属渠道二：</label>
            <select id="channel2">
                <optgroup label="渠道等级">
                    @for($i=1; $i <=3; $i++)
                        <option value="{{$i}}">
                            渠道{{$i}}
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>

        <p>
            <label for="dirname" class="col-sm-3">渠道名称：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p>
            <label class="col-sm-1"></label>
            <button type="button" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-light" style="margin-left: 30px" onclick="javascript:history.back(-1);">取消</button>
        </p>
    </main>
</div>


</body>
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript">
    $('#channel_level').on('change', function (e) {
       if ($(this).val() == 1) {
           $('#channel1_container')[0].hidden = true;
           $('#channel2_container')[0].hidden = true;
       }  else if ($(this).val() == 2) {
           $('#channel1_container')[0].hidden = false;
           $('#channel2_container')[0].hidden = true;
       } else {
           $('#channel1_container')[0].hidden = false;
           $('#channel2_container')[0].hidden = false;
       }
    });
    function edit(menu_id) {
        // alert(menu_id);
        $uri = '/menu/' + menu_id +'/edit';
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