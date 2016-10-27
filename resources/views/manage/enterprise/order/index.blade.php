@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">会员中心</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">会员中心</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/member')}}">会员管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/member/order')}}" class="active">订单管理</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/scenic')}}">会员统计</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">订单管理</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/member/order/create')}}"
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
                                    <th style="min-width: 40px;"><a href="">编号</a></th>
                                    <th><a href="">产品名称</a></th>
                                    <th style="width: 60px;"><a href="">单价</a></th>
                                    <th style="width: 60px;"><a href="">数量</a></th>
                                    <th style="width: 60px;"><a href="">合计</a></th>
                                    <th style="width: 100px;"><a href="">票面日期</a></th>
                                    <th><a href="">预定信息</a></th>
                                    <th style="width: 70px;"><a href="">审核状态</a></th>
                                    <th style="width: 70px;"><a href="">支付状态</a></th>
                                    <th style="width: 70px;"><a href="">出票状态</a></th>
                                    <th style="width: 70px;"><a href="">订单来源</a></th>
                                    <th style="width: 70px;"><a href="">订单状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr>
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>

                                        <td>{{$item->scenic->name}}
                                            <hr/>{{$item->produits->name}}
                                        </td>
                                        <td style="text-align: center">{{$item->price}}</td>
                                        <td style="text-align: center">{{$item->quantity}}</td>
                                        <td style="text-align: center">{{$item->total()}}</td>
                                        <td style="text-align: center">{{$item->ticketDate}}</td>
                                        <td>{{$item->linkMan}}
                                            <hr/>{{$item->mobile}}</td>
                                        <td style="text-align: center">
                                            @if($item->auditState==0)通过
                                            @elseif($item->auditState==1)
                                                待审核
                                            @else
                                                拒绝
                                            @endif
                                        </td>
                                        <td style="text-align: center"> @if($item->payState==0)支付成功
                                            @elseif($item->payState==1)
                                                待支付
                                            @else
                                                支付失败
                                            @endif </td>
                                        <td style="text-align: center">
                                            @if($item->payState==0)成功
                                            @elseif($item->payState==1)
                                                待出票
                                            @else
                                                失败
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->source==0)分销平台
                                            @elseif($item->source==1)
                                                微信
                                            @else
                                                电商
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"无效"}}</td>

                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/member/order/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a
                                                    href="{{url('/manage/member/order/delete/'.$item->id)}}">删除</a>

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
                                        href="{{url('/order/resources/guide/create/')}}"
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
