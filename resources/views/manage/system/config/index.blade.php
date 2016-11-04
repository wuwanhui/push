@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">

            <li><a href="#">管理中心</a></li>
            <li class="active">系统配置</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">系统配置</div>

                    <div class="panel-body ">
                        <ul>
                            <li>
                                <a href="{{url('/manage/system/config')}}" class="active">系统参数</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/system/user')}}">用户管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/system/base')}}">基础数据</a>
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


                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">平台名称：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control auto" name="name"
                                                   value="{{ $config->name}}">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('enterprise') ? ' has-error' : '' }}">
                                        <label for="enterprise" class="col-md-3 control-label">企业名称：</label>

                                        <div class="col-md-9">
                                            <input id="enterprise" type="text" class="form-control" name="enterprise"

                                                   value="{{ $config->enterprise}}">

                                            @if ($errors->has('enterprise'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('enterprise') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                                        <label for="logo" class="col-md-3 control-label">标志：</label>

                                        <div class="col-md-9">
                                            <input id="logo" type="text" class="form-control" name="logo"

                                                   value="{{ $config->logo}}">

                                            @if ($errors->has('logo'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                                        <label for="domain" class="col-md-3 control-label">平台地址：</label>

                                        <div class="col-md-9">
                                            <input id="domain" type="text" class="form-control" name="domain"

                                                   value="{{ $config->domain}}">

                                            @if ($errors->has('domain'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('assetsDomain') ? ' has-error' : '' }}">
                                        <label for="assetsDomain" class="col-md-3 control-label">资源地址：</label>

                                        <div class="col-md-9">
                                            <input id="assetsDomain" type="text" class="form-control"
                                                   name="assetsDomain"

                                                   value="{{ $config->assetsDomain}}">

                                            @if ($errors->has('assetsDomain'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('assetsDomain') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                        <label for="tel" class="col-md-3 control-label">联系电话：</label>

                                        <div class="col-md-9">
                                            <input id="tel" type="text" class="form-control auto" name="tel"

                                                   value="{{ $config->tel}}">

                                            @if ($errors->has('tel'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                        <label for="fax" class="col-md-3 control-label">传真：</label>

                                        <div class="col-md-9">
                                            <input id="fax" type="text" class="form-control auto" name="fax"

                                                   value="{{ $config->fax}}">

                                            @if ($errors->has('fax'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="fax" class="col-md-3 control-label">电子邮件：</label>

                                        <div class="col-md-9">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   style="width: 300px"
                                                   value="{{ $config->email}}">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('qq') ? ' has-error' : '' }}">
                                        <label for="qq" class="col-md-3 control-label">QQ：</label>

                                        <div class="col-md-9">
                                            <input id="qq" type="text" class="form-control auto" name="qq"

                                                   value="{{ $config->qq}}">

                                            @if ($errors->has('qq'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('qq') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                                        <label for="addres" class="col-md-3 control-label">地址：</label>

                                        <div class="col-md-9">
                                            <input id="addres" type="text" class="form-control" name="addres"

                                                   value="{{ $config->fax}}">

                                            @if ($errors->has('addres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('addres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>微信公众号</legend>

                                    <div class="form-group{{ $errors->has('weixinToken') ? ' has-error' : '' }}">
                                        <label for="weixinToken" class="col-md-3 control-label">Token：</label>

                                        <div class="col-md-9">
                                            <input id="weixinToken" type="text" class="form-control"
                                                   name="weixinToken"

                                                   value="{{ $config->weixinToken}}">

                                            @if ($errors->has('weixinToken'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('weixinToken') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('weixinAppID') ? ' has-error' : '' }}">
                                        <label for="weixinAppID" class="col-md-3 control-label">AppID：</label>

                                        <div class="col-md-9">
                                            <input id="weixinAppID" type="text" class="form-control auto"
                                                   name="weixinAppID"

                                                   value="{{ $config->weixinAppID}}">

                                            @if ($errors->has('weixinAppID'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('weixinAppID') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('wexinAppSecret') ? ' has-error' : '' }}">
                                        <label for="wexinAppSecret" class="col-md-3 control-label">AppSecret：</label>

                                        <div class="col-md-9">
                                            <input id="wexinAppSecret" type="text" class="form-control"
                                                   name="wexinAppSecret"

                                                   value="{{ $config->wexinAppSecret}}">

                                            @if ($errors->has('wexinAppSecret'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('wexinAppSecret') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('wexinAES') ? ' has-error' : '' }}">
                                        <label for="wexinAES" class="col-md-3 control-label">EncodingAESKey：</label>

                                        <div class="col-md-9">
                                            <input id="wexinAES" type="text" class="form-control  " name="wexinAES"

                                                   value="{{ $config->wexinAES}}">

                                            @if ($errors->has('wexinAES'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('wexinAES') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                </fieldset>

                                <fieldset>
                                    <legend>微信支付配置</legend>

                                    <div class="form-group{{ $errors->has('payMchId') ? ' has-error' : '' }}">
                                        <label for="weixinToken" class="col-md-3 control-label">商户号：</label>

                                        <div class="col-md-9">
                                            <input id="payMchId" type="text" class="form-control"
                                                   name="payMchId"

                                                   value="{{ $config->payMchId}}">

                                            @if ($errors->has('payMchId'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('payMchId') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('payKey') ? ' has-error' : '' }}">
                                        <label for="payKey" class="col-md-3 control-label">支付密钥：</label>

                                        <div class="col-md-9">
                                            <input id="payKey" type="text" class="form-control  "
                                                   name="payKey"

                                                   value="{{ $config->payKey}}">

                                            @if ($errors->has('payKey'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('payKey') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('payNotifyUrl') ? ' has-error' : '' }}">
                                        <label for="payNotifyUrl" class="col-md-3 control-label">支付回调：</label>

                                        <div class="col-md-9">
                                            <input id="payNotifyUrl" type="text" class="form-control"
                                                   name="payNotifyUrl"
                                                   value="{{ $config->payNotifyUrl}}">
                                            @if ($errors->has('payNotifyUrl'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('payNotifyUrl') }}</strong>
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
                @include("common.errors")
            </div>
        </div>
    </div>
@endsection
