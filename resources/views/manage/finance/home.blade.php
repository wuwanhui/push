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
                                <a href="{{url('/manage/finance/quantity')}}">充值管理</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">财务管理</div>
                    <div class="panel-body">


                    </div>
                    @include("common.success")
                    @include("common.errors")
                </div>
            </div>
        </div>
@endsection
