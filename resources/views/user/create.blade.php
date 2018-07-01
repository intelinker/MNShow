@extends('layouts.headercontent')

<body>
<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">冰+后台管理系统</a>
    <input class="form-control form-control w-100" type="text" placeholder="搜索" aria-label="Search">
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
            <h1 class="h2">登录人员管理</h1>
        </div>

        <h2>添加</h2>
        <p>
            <label for="dirname" class="col-sm-2">姓名：</label>
            <input type="text" id="dirname"></input>
        </p>
        <p>
            <label for="dirname" class="col-sm-2">手机号：</label>
            <input type="text" id="dirname"></input>
        </p>
        <p>
            <label for="dirname" class="col-sm-2">密码：</label>
            <input type="text" id="dirname"></input>
        </p>

        <p style="margin-top: 30px">
            <label for="select" class="col-sm-2">权限：</label>
            <select id="select">
                <optgroup label="设置权限">
                    @for($i=1; $i <=2; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
        </p>

        <p>
            <label class="col-sm-1"></label>
            <button type="button" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-light" style="margin-left: 100px">取消</button>
        </p>
    </main>
</div>
</body>
