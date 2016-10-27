@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">资源供应</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">资源供应</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier')}}">供应商列表</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/supplier/product')}}" class="active">原始资源</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/scenic')}}">景区配置</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/supplier/produits')}}">产品中心</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">原始资源</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/manage/supplier/product/create')}}"
                                   class="btn btn-primary">新增</a></div>
                            <div class="col-md-8 text-right">
                                <form method="get" class="form-inline">
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="关键字"
                                               name="key" value=""> <span class="input-group-btn">
								<button class="btn btn-default" type="submit">搜索</button>
							</span>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form method="Post" class="form-inline">
                        <fieldset>
                            <table class="table table-bordered table-hover  table-condensed">
                                <thead>
                                <tr style="text-align: center" class="text-center">
                                    <th style="width: 20px"><input type="checkbox"
                                                                   name="CheckAll" value="Checkid"/></th>
                                    <th style="width: 60px;"><a href="">编号</a></th>
                                    <th><a href="">供应商</a></th>
                                    <th><a href="">产品名称</a></th>
                                    <th><a href="">产品编码</a></th>
                                    <th style="width: 120px;"><a href="">价格</a></th>
                                    <th style="width: 140px;"><a href="">日期</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 120px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr title="{{$item->attention}}">
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td style="text-align: center">{{$item->supplier->name}}</td>
                                        <td>{{$item->name}}
                                            @if($item->payType==0)
                                                <span class="label label-primary">支持到付</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{$item->code}}</td>
                                        <td>票面价:{{$item->parprice}}<br>成本价:{{$item->price}}
                                        </td>
                                        <td>开始日期:{{$item->beginDate}}
                                            <br>结束日期:{{$item->endDate}}</td>

                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>

                                        <td><a
                                                    href="{{url('/manage/supplier/product/edit/'.$item->id)}}">编辑</a> | <a
                                                    href="{{url('/manage/supplier/product/delete/'.$item->id)}}">删除</a>
                                            <hr/>
                                            <a href="{{url('/manage/supplier/produits/original/'.$item->id)}}">加入产品中心</a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                    </form>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"><a
                                        href="{{url('/supplier/resources/guide/create/')}}"
                                        class="btn btn-primary">批量删除</a></div>
                            <div class="col-md-8 text-right">
                                {!! $lists->links() !!}
                            </div>
                        </div>

                    </div>
                </div>
                @include("common.success")
                @include("common.errors")
            </div>
        </div>
    </div>
@endsection
