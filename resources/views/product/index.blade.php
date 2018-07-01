@extends('layouts.headercontent')

<body>
<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">冰+后台管理系统</a>
    {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
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
            <h1 class="h2">产品内容管理</h1>
        </div>

        <h2>内容列表</h2>
        <p>
            <input type="text" placeholder="主标题名称">
            <select id="select" style="margin-left: 20px">
                <option value="">所属一级菜单</option>
                <optgroup label="Option group 1">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>

            <select id="select" style="margin-left: 20px">
                <option value="">所属二级菜单</option>
                <optgroup label="Option group 1">
                    @for($i=1; $i <=5; $i++)
                        <option value="{{$i}}">
                            正序第{{$i}}位
                        </option>
                    @endfor
                </optgroup>
            </select>
            <button type="button" class="btn btn-primary col-sm-1" style="margin-left: 20px">搜索</button>

            <button type="button" class="btn btn-danger col-sm-1" style="margin-left: 300px" onclick="create()">添加</button>
        </p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">主标题</th>
                    <th scope="col">副标题</th>
                    <th scope="col">净含量</th>
                    <th scope="col">图片</th>
                    <th scope="col">所属一级菜单</th>
                    <th scope="col">所属二级目录</th>
                    <th scope="col">操作</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>草莓迷情</td>
                    <td>关于我们</td>
                    <th scope="col">净含量</th>
                    <td><img src=""></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>正序第二位</td>
                    <td>产品介绍</td>
                    <th scope="col">净含量</th>
                    <td><img src=""></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>正序第三位</td>
                    <td>菜单介绍</td>
                    <th scope="col">净含量</th>
                    <td><img src=""></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>正序第四位</td>
                    <td>项目介绍</td>
                    <th scope="col">净含量</th>
                    <td><img src=""></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>
                        <button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>正序第五位</td>
                    <td>顾客信息</td>
                    <th scope="col">净含量</th>
                    <td><img src=""></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>
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
<script type="text/javascript">
    function create(product) {
        $uri = '/products/create';
        window.location.assign($uri);
    }

    function delProduct(product) {
        $uri = '/products/create';
        window.location.assign($uri);

    }
</script>