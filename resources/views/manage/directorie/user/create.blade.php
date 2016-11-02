@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">

            <li><a href="#">管理中心</a></li>
            <li class="active">企业管理</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">企业管理</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/enterprise')}}">企业管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/enterprise/user')}}" class="active">用户管理</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST">
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
                                    {{ csrf_field() }}
                                    @if($enterprises )
                                        <div class="form-group{{ $errors->has('enterpriseId') ? ' has-error' : '' }}">
                                            <label for="enterpriseId" class="col-md-3 control-label">所属企业：</label>

                                            <div class="col-md-9">
                                                <select id="enterpriseId" name="enterpriseId" class="form-control"
                                                        style="width: auto;">
                                                    <option value="">请选择企业</option>
                                                    @foreach($enterprises as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('enterpriseId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('enterpriseId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">用户名</label>

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

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-3 control-label">电子邮件</label>

                                        <div class="col-md-9">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-3 control-label">密码</label>

                                        <div class="col-md-9">
                                            <input id="password" type="password" class="form-control auto"
                                                   name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="col-md-3 control-label">确认密码</label>

                                        <div class="col-md-9">
                                            <input id="password-confirm" type="password" class="form-control auto"
                                                   name="password_confirmation" required>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label for="type" class="col-md-3 control-label">类型：</label>

                                        <div class="col-md-9">
                                            <select id="type" name="type" class="form-control" style="width: auto;">
                                                <option value="0">系统帐户</option>
                                                <option value="1">普通帐户</option>
                                                <option value="2">企业管理员</option>
                                            </select>

                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
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
