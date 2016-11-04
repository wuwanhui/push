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
                                    <div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
                                        <label for="source" class="col-md-3 control-label">充值方式：</label>

                                        <div class="col-md-9">
                                            <select id="source" name="source" class="form-control" style="width: auto;">
                                                <option value="0">现金</option>
                                                <option value="1">支付宝</option>
                                                <option value="2">微信</option>
                                                <option value="3">银行转账</option>
                                                <option value="4">其它</option>
                                            </select>

                                            @if ($errors->has('source'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('source') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('money') ? ' has-error' : '' }}">
                                        <label for="money" class="col-md-3 control-label">充值金额：</label>

                                        <div class="col-md-9">
                                            <input id="money" type="text" class="form-control auto" name="money"
                                                   value="{{ $recharge->money }}">

                                            @if ($errors->has('money'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('money') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">到账状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control" style="width: auto;">
                                                <option value="0">正常</option>
                                                <option value="1">无效</option>
                                            </select>

                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
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
                                            >{{$recharge->refundable}}</textarea>

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
