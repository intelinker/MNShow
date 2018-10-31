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

        <h2>内容列表</h2>
        <p>
            <input id="search_input" type="text" placeholder="主标题名称">
            <select id="level1" name="level1" style="margin-left: 20px">
                <option value="100">全部产品</option>
                @for($i=0; $i <count($menu); $i++)
                    <option value="{{$i}}">
                        {{$menu[$i]}}
                    </option>
                @endfor
            </select>

            <select id="level2" name="level2" style="margin-left: 20px"   hidden>
                @if(count($menu2[0]) == 0)
                    @for($i=0; $i <count($menu2[0]); $i++)
                        <option value="{{$i}}">
                            {{$menu2[0]->name}}
                        </option>
                    @endfor
                @endif
            </select>
            <button type="button" class="btn btn-primary col-sm-1" style="margin-left: 20px" onclick="search()">搜索</button>

            <button type="button" class="btn btn-danger col-sm-1" style="margin-right: 30px; float:right" onclick="create()">添加</button>
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
                    <th scope="col" style="min-width: 180px">操作</th>

                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($products); $i++)
<!--                    --><?php
//                        $product = $products[$i];
//                        if (substr(strrchr($product->avatar, '.'), 1) == 'mp4' || substr(strrchr($product->avatar, '.'), 1) == 'mpeg'|| substr(strrchr($product->avatar, '.'), 1) == 'avi') {
//                            $product->avatar = explode(".", $product->avatar)[0].".jpg";
//                        }
//                    ?>
                    <tr>
                        {!! Form::open(array('url'=>'/products/'.$product->id, 'method'=>'delete')) !!}
                        <th scope="row">{{$i +1}}</th>
                        <td>{{$product->title}}</td>
                        <td>{{$product->subtitle}}</td>
                        <td>{{$product->weight}}</td>
                        <td><img src="{{$product->image_path}}" width="40px"></td>
                        <td>{{$product->menu->name}}</td>
                        <td>{{count($menu2[$product->level1]) == 0 ? '无' : $menu2[$product->level1][$product->level2]}}</td>
                        <td>
                            <button id="edit_3" type="button" class="btn btn-warning" onclick="edit({{$product->id}})">修改</button>
                            {!! Form::submit('删除', ['class' => 'btn btn-light', 'style' => 'margin-left:30px']) !!}
                            {{--<button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="delProduct({{$product->id}})">删除</button>--}}
                        </td>
                        {!! Form::close() !!}
                    </tr>
                @endfor
                {{--<tr>--}}
                    {{--<th scope="row">2</th>--}}
                    {{--<td>正序第二位</td>--}}
                    {{--<td>产品介绍</td>--}}
                    {{--<th scope="col">净含量</th>--}}
                    {{--<td><img src=""></td>--}}
                    {{--<td></td>--}}
                    {{--<td></td>--}}
                    {{--<td>--}}
                        {{--<button id="edit_3" type="button" class="btn btn-warning" onclick="edit(3)">修改</button>--}}
                        {{--<button id="visible_3" type="button" class="btn btn-light" style="margin-left: 30px" onclick="resetVisible(3)">删除</button>--}}
                    {{--</td>--}}
                {{--</tr>--}}

                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
<script type="text/javascript" src="/js/jQuery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript">
    document.getElementsByName('level1')[0].onchange = function () {
        var level2 = document.getElementsByName('level2')[0];
        if ($(this).val() == 100) {
            level2.hidden = true;
        } else {
            var menu2 = "<?php echo urlencode(json_encode($menu2)); ?>";
            menu2 = eval(decodeURIComponent(menu2));
            var submenu = menu2[$(this).val()];
            console.log($(this).val());
            level2.innerHTML = "";
            if (submenu.length > 0) {
                level2.hidden = false;
                for (var i=0; i<submenu.length; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.textContent = submenu[i];
                    level2.appendChild(option);
                }
            } else {
                level2.hidden = true;
            }
        }

    }
    function create(product) {
        $uri = '/products/create';
        window.location.assign($uri);
    }
    function edit(product) {
        // alert(menu_id);
        $uri = '/products/' + product +'/edit';
        window.location.assign($uri);
    }
    function delProduct(product) {
        $uri = '/products/create';
        window.location.assign($uri);

    }
    
    function search() {
        var search_input = $('#search_input').val();
        if (search_input.length > 0) {
            var uri = '/productsearch/' + search_input + '/' + $('#level1').val() + '/' + $('#level2').val();
            window.location.assign(uri);
        } else {
            alert("请输入搜索关键字");

        }

    }
</script>