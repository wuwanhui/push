@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">

            <li><a href="#">管理中心</a></li>
            <li class="active">信息推送</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">通讯录</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/directorie')}}" class="active">通讯录</a>
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
                                <div class="col-xs-12  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="submit" class="btn  btn-primary">保存</button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">姓名：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control auto" name="name"

                                                   value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">性别：</label>

                                        <div class="col-md-9">
                                            <select id="sex" name="sex" class="form-control auto">
                                                <option value="0">未知</option>
                                                <option value="1">先生</option>
                                                <option value="2">女士</option>
                                            </select>

                                            @if ($errors->has('sex'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('idCard') ? ' has-error' : '' }}">
                                        <label for="idCard" class="col-md-3 control-label">身份证号：</label>

                                        <div class="col-md-9">
                                            <input id="idCard" type="text" class="form-control"
                                                   name="idCard"
                                                   style="width: auto;"
                                                   value="{{ old('idCard') }}" autofocus>

                                            @if ($errors->has('idCard'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('idCard') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                        <label for="birthday" class="col-md-3 control-label">生日：</label>

                                        <div class="col-md-9">
                                            <input id="birthday" type="date" class="form-control" name="birthday"
                                                   style="width: auto;"
                                                   value="{{ old('birthday') }}" autofocus>

                                            @if ($errors->has('birthday'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">
                                            <input id="mobile" type="tel" class="form-control" name="mobile"
                                                   placeholder="必填"
                                                   style="width: auto;"
                                                   value="{{ old('mobile') }}" required autofocus>

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                        <label for="tel" class="col-md-3 control-label">电话：</label>

                                        <div class="col-md-9">
                                            <input id="tel" type="tel" class="form-control" name="tel"
                                                   placeholder="电话"
                                                   style="width: auto;"
                                                   value="{{ old('tel') }}" autofocus>

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
                                            <input id="fax" type="fax" class="form-control" name="fax"
                                                   placeholder="传真号码"
                                                   style="width: auto;"
                                                   value="{{ old('fax') }}" autofocus>

                                            @if ($errors->has('fax'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('qq') ? ' has-error' : '' }}">
                                        <label for="qq" class="col-md-3 control-label">QQ：</label>

                                        <div class="col-md-9">
                                            <input id="qq" type="text" class="form-control" name="qq"
                                                   style="width: 300px;"
                                                   value="{{ old('qq') }}" autofocus>

                                            @if ($errors->has('qq'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('qq') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-3 control-label">电子邮件：</label>

                                        <div class="col-md-9">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   style="width: 300px;"
                                                   value="{{ old('email') }}" autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                                        <label for="addres" class="col-md-3 control-label">地址：</label>

                                        <div class="col-md-9">
                                            <input id="addres" type="text" class="form-control" name="addres"
                                                   value="{{ old('addres') }}" autofocus>

                                            @if ($errors->has('addres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('addres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('share') ? ' has-error' : '' }}">
                                        <label for="share" class="col-md-3 control-label">共享：</label>

                                        <div class="col-md-9">
                                            <select id="share" name="share" class="form-control auto">
                                                <option value="0">私有</option>
                                                <option value="1">分享</option>
                                            </select>

                                            @if ($errors->has('share'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('share') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control auto">
                                                <option value="0">正常</option>
                                                <option value="1">禁用</option>
                                            </select>

                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
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
                @include("common.errors") </div>
        </div>
    </div>
@endsection
