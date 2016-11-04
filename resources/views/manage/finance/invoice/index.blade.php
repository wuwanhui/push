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
                                <a href="{{url('/manage/finance/recharge')}}">支付记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/finance/invoice')}}" class="active">发票申请</a>
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
                    <div class="panel-heading">发票申请</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"></div>
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
                                    <th style="width: 220px;"><a href="">申请用户</a></th>
                                    <th style="width: 100px;"><a href="">发票金额</a></th>
                                    <th><a href="">发票抬头</a></th>
                                    <th style="width: 100px;"><a href="">联系人</a></th>
                                    <th style="width: 160px;"><a href="">手机号</a></th>
                                    <th><a href="">快递单号</a></th>
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
                                            {{$item->user->enterprise->name}}
                                            -{{$item->user->name}}
                                        </td>
                                        <td style="text-align: center"> {{$item->money}}
                                        </td>
                                        <td>
                                            {{$item->enterprise}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$item->linkMan}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$item->mobile}}
                                        </td>
                                        <td style="text-align: center">{{$item->express}}</td>
                                        <td style="text-align: center">
                                            @if($item->state==0)
                                                成功
                                            @elseif($item->state==1)
                                                待开具
                                            @else
                                                失败
                                            @endif </td>
                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/finance/invoice/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a href="{{url('/manage/finance/invoice/delete/'.$item->id)}}">删除</a>
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
                                        href="{{url('/manage/finance/invoice/delete')}}"
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
