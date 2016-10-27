@extends('layouts.weixin')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">产品管理</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">产品管理</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="./product/create">新增产品</a>
                            </li>
                            <li>
                                <a href="./product/sync">同步产品</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="btn-group">
                    <button type="button" class="btn btn-default">新增订单</button>
                    <button type="button" class="btn btn-default">Middle</button>
                    <button type="button" class="btn btn-default">Right</button>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">订单列表</div>
                    <div class="panel-body">
                        <form method="Post" class="form-inline">
                            <fieldset>
                                <legend>产品列表</legend>
                                <table class="table table-bordered table-hover  table-condensed">
                                    <thead>
                                    <tr style="text-align: center" class="text-center">
                                        <th style="width: 20px"><input type="checkbox"
                                                                       name="CheckAll" value="Checkid"/></th>
                                        <th style="width: 80px;"><a href="">编号</a></th>
                                        <th><a href="">产品来源</a></th>
                                        <th><a href="">产品名称</a></th>
                                        <th><a href="">产品编码</a></th>
                                        <th><a href="">产品打印名称</a></th>
                                        <th><a href="">产品描述</a></th>
                                        <th><a href="">注意事项</a></th>
                                        <th><a href="">票面价</a></th>
                                        <th><a href="">支持到付</a></th>
                                        <th><a href="">成本价格</a></th>
                                        <th><a href="">开始日期</a></th>
                                        <th><a href="">结束日期</a></th>
                                        <th><a href="">状态</a></th>
                                        <th style="width: 120px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lists as $item)
                                        <tr>
                                            <td><input type="checkbox" value="{{$item->id}} "
                                                       name="id"/></td>
                                            <td style="text-align: center">{{$item->id}} </td>
                                            <td>{{$item->source}} </td>
                                            <td style="text-align: center">{{$item->name}}</td>
                                            <td style="text-align: center">{{$item->code}}</td>
                                            <td style="text-align: center">{{$item->pringName}}</td>
                                            <td style="text-align: center">{{$item->description}}</td>
                                            <td style="text-align: center">{{$item->attention}}</td>
                                            <td style="text-align: center">{{$item->parprice}}</td>
                                            <td style="text-align: center">{{$item->payType}}</td>
                                            <td style="text-align: center">{{$item->price}}</td>
                                            <td style="text-align: center">{{$item->beginDate}}</td>
                                            <td style="text-align: center">{{$item->endDate}}</td>

                                            <td style="text-align: center">
                                                {{$item->state==0?"正常":"禁用"}}</td>

                                            <td style="text-align: center"><a
                                                        href="{{url('/supplier/resources/guide/edit/'.$item->id)}}">编辑</a>
                                                |
                                                <a
                                                        href="{{url('/supplier/resources/guide/delete/'.$item->id)}}">删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
