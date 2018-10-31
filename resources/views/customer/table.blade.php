
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
        {{--<th scope="col">进展</th>--}}
        <th scope="col">录入人</th>

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
            <th scope="row">{{$i}}</th>
            <td>{{$customer->name}}</td>
            <td>{{$customer->store_count}}</td>
            <td>@if($customer->channel1 != null) {{$customer->channel1->name}} @else 该渠道不存在 @endif</td>
            <td>@if($channel2 != null) {{$channel2->name}} @else - @endif</td>
            <td>@if($channel3 != null) {{$channel3->name}} @else - @endif</td>
            <td>@if($customer->image != null && count($customer->image) > 0) <img width="50px" src="{{$customer->image[0]->link}}"> @endif</td>
            <td>{{$customer->visit_time}}</td>
            <td>{{$customer->contract_time}}</td>
            <td>{{$customer->contract_duration}}</td>
            <td>
                @if($customer->product != null && count($customer->product) > 0)
                    <?php $productName = ""; ?>
                    @foreach ($customer->product as $product)
                        <?php $productName = $productName." ".$product->title; ?>
                    @endforeach
                    {{$productName}}
                @else
                    无
                @endif
            </td>
            {{--<td>合作进展</td>--}}
            <td>@if($customer->creator != null) {{ $customer->creator->name }} @else 该用户不存在 @endif</td>
        </tr>
    @endfor
    </tbody>
</table>