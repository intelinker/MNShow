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
        <div>
            <input type="text" placeholder="顾客名称">
            <input type="text" placeholder="拜访时间" class="form_datetime" readonly>
            <select id="select">
                <optgroup label="渠道分类一">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
            <select id="select">
                <optgroup label="渠道分类二">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
            <select id="select">
                <optgroup label="渠道分类三">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
        </div>
        <div>
            <input type="text" placeholder="录入人">
            <input type="text" placeholder="签订合同时间" class="form_datetime" readonly>
            <input type="text" placeholder="签订合同期限">
            <input type="text" placeholder="合作产品">
            <button type="button" class="btn btn-primary" style="margin-left: 20px">搜索</button>
        </div>

        <div style="margin-top:30px; margin-bottom: 80px">
            <button type="button" class="btn btn-warning" style="margin-right: 30px; float:right" onclick="channels()">渠道管理</button>
            {{--<button type="button" class="btn btn-danger col-sm-1" style="margin-right: 30px; float:right" onclick="create()">添加顾客</button>--}}
            <button type="button" class="btn btn-success" style="margin-right: 30px; float:right" onclick="exportExcel()">报表导出</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
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
                    <th scope="col">进展</th>
                    <th scope="col">录入人</th>
                    <th scope="col">操作</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>沈阳万豪大酒店</td>
                    <td>4</td>
                    <td>餐饮</td>
                    <td>酒店</td>
                    <td>星级</td>
                    <td><img src=""></td>
                    <td>2018-09-03</td>
                    <td>2018-09-03</td>
                    <td>3年</td>
                    <td>桶冰系列</td>
                    <td>合作进展</td>
                    <td>小红</td>
                    <td>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>沈阳万豪大酒店</td>
                    <td>4</td>
                    <td>餐饮</td>
                    <td>酒店</td>
                    <td>星级</td>
                    <td><img src=""></td>
                    <td>2018-09-03</td>
                    <td>2018-09-03</td>
                    <td>3年</td>
                    <td>桶冰系列</td>
                    <td>合作进展</td>
                    <td>小红</td>
                    <td>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>沈阳万豪大酒店</td>
                    <td>4</td>
                    <td>餐饮</td>
                    <td>酒店</td>
                    <td>星级</td>
                    <td><img src=""></td>
                    <td>2018-09-03</td>
                    <td>2018-09-03</td>
                    <td>3年</td>
                    <td>桶冰系列</td>
                    <td>合作进展</td>
                    <td>小红</td>
                    <td>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>沈阳万豪大酒店</td>
                    <td>4</td>
                    <td>餐饮</td>
                    <td>酒店</td>
                    <td>星级</td>
                    <td><img src=""></td>
                    <td>2018-09-03</td>
                    <td>2018-09-03</td>
                    <td>3年</td>
                    <td>桶冰系列</td>
                    <td>合作进展</td>
                    <td>小红</td>
                    <td>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>沈阳万豪大酒店</td>
                    <td>4</td>
                    <td>餐饮</td>
                    <td>酒店</td>
                    <td>星级</td>
                    <td><img src=""></td>
                    <td>2018-09-03</td>
                    <td>2018-09-03</td>
                    <td>3年</td>
                    <td>桶冰系列</td>
                    <td>合作进展</td>
                    <td>小红</td>
                    <td>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script src="/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
    // $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii',minView: "month", language: 'cn'});
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd',minView: "month", language: 'cn', autoclose: 1});

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
