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
                                <a href="{{url('/manage/finance/account')}}">帐户设置</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/finance/payments')}}" class="active">收支记录</a>
                            </li>


                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/credit')}}">授信管理</a>
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
                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label for="type" class="col-md-3 control-label">帐户类型：</label>

                                        <div class="col-md-9">
                                            <select id="type" name="type" class="form-control" style="width: auto;">
                                                <option value="0">银行帐户</option>
                                                <option value="1">微信</option>
                                                <option value="2">支付宝</option>
                                                <option value="3">线下</option>
                                                <option value="4">其它</option>
                                            </select>

                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">开户名：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ $account->name }}">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('bankAccount') ? ' has-error' : '' }}">
                                        <label for="bankAccount" class="col-md-3 control-label">开户行：</label>

                                        <div class="col-md-9">
                                            <input id="bankAccount" type="text" class="form-control" name="bankAccount"

                                                   value="{{ $account->bankAccount }}">

                                            @if ($errors->has('bankAccount'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('bankAccount') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('accounts') ? ' has-error' : '' }}">
                                        <label for="accounts" class="col-md-3 control-label">帐号：</label>

                                        <div class="col-md-9">
                                            <input id="accounts" type="text" class="form-control" name="accounts"

                                                   value="{{ $account->accounts }}">

                                            @if ($errors->has('accounts'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('accounts') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('bankAddres') ? ' has-error' : '' }}">
                                        <label for="bankAddres" class="col-md-3 control-label">地址：</label>

                                        <div class="col-md-9">
                                            <input id="bankAddres" type="text" class="form-control" name="bankAddres"
                                                   value="{{ $account->bankAddres }}">

                                            @if ($errors->has('bankAddres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('bankAddres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('beginMoney') ? ' has-error' : '' }}">
                                        <label for="beginMoney" class="col-md-3 control-label">期初金额：</label>

                                        <div class="col-md-9">
                                            <input id="beginMoney" type="text" class="form-control auto"
                                                   name="beginMoney"
                                                   value="{{ $account->beginMoney }}">

                                            @if ($errors->has('beginMoney'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('beginMoney') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control" style="width: auto;">
                                                <option value="0">正常</option>
                                                <option value="1">停用</option>
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
                                            >{{$account->remark }}</textarea>

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
