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
                <div class="panel panel-default">
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-2  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="submit" class="btn  btn-primary">保存</button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="type" class="col-md-3 control-label">可转金额：</label>

                                        <div class="col-md-9">

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('userId') ? ' has-error' : '' }}">
                                        <label for="userId" class="col-md-3 control-label">接收者用户ID：</label>

                                        <div class="col-md-9">
                                            <input id="userId" type="text" class="form-control auto" name="userId"
                                                   value="{{ old('userId') }}">

                                            @if ($errors->has('userId'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('userId') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('money') ? ' has-error' : '' }}">
                                        <label for="money" class="col-md-3 control-label">转账金额：</label>

                                        <div class="col-md-9">
                                            <input id="money" type="text" class="form-control auto" name="money"
                                                   value="{{ old('money') }}">

                                            @if ($errors->has('money'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('money') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('remark') ? ' has-error' : '' }}">
                                        <label for="remark" class="col-md-3 control-label">备注：</label>

                                        <div class="col-md-9">

                                            <textarea id="remark" type="text" class="form-control"
                                                      name="remark"
                                                      style=" height: 100px"
                                            >{{old('refundable') }}</textarea>

                                            @if ($errors->has('remark'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('remark') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                @include("common.success")
                @include("common.errors")   </div>
        </div>
    </div>
@endsection
