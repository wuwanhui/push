@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">

            <li><a href="#">管理中心</a></li>
            <li class="active">财务结算</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">财务结算</div>

                    <div class="panel-body ">
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/recharge')}}" class="active">支付记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/finance/invoice')}}">发票申请</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/quantity')}}">充值管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">支付记录</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/finance/recharge/create')}}"
                                                     class="btn btn-primary">充值</a></div>
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
                                    <th style="width: 220px;"><a href="">充值用户</a></th>
                                    <th style="width: 100px;"><a href="">金额</a></th>
                                    <th style="width: 100px;"><a href="">支付方式</a></th>
                                    <th style="width: 160px;"><a href="">时间</a></th>
                                    <th><a href="">备注</a></th>
                                    <th style="width: 100px;"><a href="">经办人</a></th>
                                    <th style="width: 100px;"><a href="">状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr>
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}}</td>
                                        <td style="text-align: center">
                                            {{$item->member->enterprise->name}}
                                            -{{$item->member->name}}
                                        </td>
                                        <td style="text-align: center"> {{$item->money}}
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->source==0)
                                                现金
                                            @elseif($item->source==1)
                                                支付宝
                                            @else
                                                微信
                                            @endif </td>


                                        <td style="text-align: center">{{$item->created_at}}</td>
                                        <td style="text-align: center">{{$item->remark}}</td>
                                        <td style="text-align: center">
                                            @if($item->user)
                                                {{$item->user->name}}
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->state==0)
                                                成功
                                            @elseif($item->state==1)
                                                待审核
                                            @else
                                                失败
                                            @endif </td>
                                        <td style="text-align: center">  @if($item->state==0)<a
                                                    href="{{url('/manage/finance/recharge/detail/'.$item->id)}}">详情</a> @endif
                                            @if($item->state!=0) <a
                                                    href="{{url('/manage/finance/recharge/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a href="{{url('/manage/finance/recharge/delete/'.$item->id)}}">删除</a>
                                            @endif
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
                                        href="{{url('/manage/finance/recharge/delete')}}"
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
