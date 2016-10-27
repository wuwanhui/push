@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
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
                                <a href="{{url('/manage/finance/account')}}" class="active">帐户设置</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/finance/payments')}}">收支记录</a>
                            </li>
                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/credit')}}" >授信管理</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">资金帐户</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/finance/account/create')}}"
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
                                    <th style="width: 100px;"><a href="">帐户类型</a></th>
                                    <th><a href="">开户名</a></th>
                                    <th><a href="">开户行</a></th>
                                    <th style="width: 160px;"><a href="">帐号</a></th>
                                    <th><a href="">开户行地址</a></th>
                                    <th style="width: 100px;"><a href="">期初金额</a></th>
                                    <th style="width: 100px;"><a href="">余额</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr title="{{$item->attention}}">
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td style="text-align: center">
                                            @if($item->type==0)
                                                银行帐户
                                            @elseif($item->type==1)
                                                微信
                                            @elseif($item->type==2)
                                                支付宝
                                            @elseif($item->type==3)
                                                线下
                                            @else
                                                其它
                                            @endif </td>
                                        <td style="text-align: center">{{$item->name}}</td>
                                        <td> {{$item->bankAccount}}
                                        </td>
                                        <td> {{$item->accounts}}</td>
                                        <td> {{$item->bankAddres}}</td>
                                        <td style="text-align: center"> {{$item->beginMoney}}</td>
                                        <td style="text-align: center"> {{$item->balance}}</td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>
                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/finance/account/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a href="{{url('/manage/finance/account/delete/'.$item->id)}}">删除</a>
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
                                        href="{{url('/manage/finance/account/delete')}}"
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
