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
                                <a href="{{url('/manage/finance/invoice')}}">发票申请</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/quantity')}}" class="active">充值管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">充值管理</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/finance/quantity/create')}}"
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
                    {{v($pay)}}
                    <img src="http://pan.baidu.com/share/qrcode?w=250&h=250&url={{$pay["code_url"]}}">

                </div>
                @include("common.success")
                @include("common.errors")
            </div>
        </div>
    </div>
@endsection
