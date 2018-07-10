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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">顾客信息管理</h1>
        </div>

        <h2>添加顾客</h2>

        {!! Form::open(array('url'=>'/customers/create', 'files'=>true)) !!}
        <p>
            <label for="dirname" class="col-sm-3">顾客名称：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p>
            <label for="dirname" class="col-sm-3">门店数量：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p style="margin-top: 30px">
            <label for="select" class="col-sm-3">渠道分类一：</label>
            <select id="select">
                <optgroup label="Option group 1">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>

        <p style="margin-top: 30px">
            <label for="select" class="col-sm-3">渠道分类二：</label>
            <select id="select">
                <optgroup label="Option group 1">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>

        <p style="margin-top: 30px">
            <label for="select" class="col-sm-3">渠道分类三：</label>
            <select id="select">
                <optgroup label="Option group 1">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>

        <p>
            <label for="icon" class="col-sm-3">图片：</label>
            <input type="file">
        </p>

        <p>
            <label for="dirname" class="col-sm-3">拜访时间：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p>
            <label for="icon" class="col-sm-3">签订合同时间：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p>
            <label for="dirname" class="col-sm-3">签订合同期限：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p>
            <label for="dirname" class="col-sm-3">合作产品：</label>
            <input  class="col-sm-8" type="text" id="dirname"></input>
        </p>

        <p>
            <label for="dirname" class="col-sm-3">进展：</label>
            <input  class="col-sm-8" type="text" id="dirname"></input>
        </p>

        <p>
            <label for="dirname" class="col-sm-3">录入人：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p>
            {!! Form::submit('保存', ['class' => 'btn btn-primary', 'style' => 'margin-left:30px']) !!}
            <button type="button" class="btn btn-light" style="margin-left: 250px" onclick="javascript:history.back(-1);">取消</button>
        </p>
        {!! Form::close() !!}
    </main>
</div>
</body>
