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
                <h1 class="h2">菜单展示管理</h1>
            </div>

            <h2>菜单列表</h2>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                    <tr>
                        <th scope="col">序号</th>
                        <th scope="col">菜单位置</th>
                        <th scope="col">菜单一级目录名称</th>
                        <th scope="col">图标</th>
                        <th scope="col">菜单二级目录名称</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>正序第一位</td>
                        <td>关于我们</td>
                        <td><img src=""></td>
                        <td></td>
                        <td>
                            <button id="edit_1" type="button" class="btn btn-warning" href="/menu/1/edit" onclick="edit(1)">修改</button>
                            <button id="visible_1" type="button" class="btn btn-primary" style="margin-left: 30px" onclick="resetVisible(1)">显示</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>正序第二位</td>
                        <td>产品介绍</td>
                        <td><img src=""></td>
                        <td></td>
                        <td>
                            <button id="edit_2" type="button" class="btn btn-warning" onclick="edit(2)">修改</button>
                            <button id="visible_2" type="button" class="btn btn-primary" style="margin-left: 30px" onclick="resetVisible(2)">显示</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>正序第三位</td>
                        <td>菜单介绍</td>
                        <td><img src=""></td>
                        <td></td>
                        <td>
                            <button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>
                            <button id="visible_3" type="button" class="btn btn-primary" style="margin-left: 30px" onclick="resetVisible(3)">显示</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>正序第四位</td>
                        <td>项目介绍</td>
                        <td><img src=""></td>
                        <td></td>
                        <td>
                            <button id="edit_4" type="button" class="btn btn-warning" onclick="edit(4)">修改</button>
                            <button id="visible_4" type="button" class="btn btn-primary" style="margin-left: 30px" onclick="resetVisible(4)">显示</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>正序第五位</td>
                        <td>顾客信息</td>
                        <td><img src=""></td>
                        <td></td>
                        <td>
                            <button id="edit_5" type="button" class="btn btn-warning" onclick="edit(5)">修改</button>
                            <button id="visible_5" type="button" class="btn btn-primary" style="margin-left: 30px" onclick="resetVisible(5)">显示</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h2>修改菜单</h2>
            <p style="margin-top: 30px">
                <label for="select" class="col-sm-3">菜单位置：</label>
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
                <label for="dirname" class="col-sm-3">菜单一级目录名称：</label>
                <input type="text" id="dirname"></input>
            </p>

            <p>
                <label for="icon" class="col-sm-3">图标：</label>
                <input type="file">
            </p>

            <p>
                <label for="dirname" class="col-sm-3">菜单二级目录名称：</label>
                <input  class="col-sm-8" type="text" id="dirname"></input>
            </p>

            <p>
                <label class="col-sm-3"></label>
                <label>如果超过1个，用英文","逗号隔开</label>
            </p>

            <p>
                <label class="col-sm-3"></label>
                <button type="button" class="btn btn-primary">保存</button>
                {{--<button type="button" class="btn btn-light" style="margin-left: 30px">取消</button>--}}
            </p>
        </main>
    </div>


</body>
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript">
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