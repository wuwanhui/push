@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
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
                            </div>
                        </div>
                    </form>
                </div>
                @include("common.success")
                @include("common.errors")   </div>
        </div>
    </div>
@endsection
