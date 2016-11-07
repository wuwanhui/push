@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/member/register') }}">
            {{ csrf_field() }}

            <div class="modal show " aria-labelledby="myModalLabel"
                 data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content"
                         style="border-top-width: 5px; border-top-color: #336699; border-top-style: solid;">
                        <div class="modal-header">

                            <h4 class="modal-title">
                                <i class="icon-desktop"></i>营销平台-注册
                            </h4>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <legend>企业信息</legend>
                                <div class="form-group">
                                    <label for="enterprise" class="col-md-4 control-label">企业名称</label>

                                    <div class="col-md-6">
                                        <input id="enterprise" type="text" class="form-control" name="enterprise"
                                               value="{{ old('enterprise') }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="linkMan" class="col-md-4 control-label">联系人</label>

                                    <div class="col-md-6">
                                        <input id="linkMan" type="text" class="form-control" name="linkMan"
                                               value="{{ old('linkMan') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">手机号</label>

                                    <div class="col-md-6">
                                        <input id="mobile" type="text" class="form-control" name="mobile"
                                               value="{{ old('mobile') }}" required autofocus>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>用户信息</legend>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">用户名</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">电子邮件</label>

                                    <div class="col-md-6">
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
                                    <label for="password" class="col-md-4 control-label">密码</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn-block ">注册</button>

                        </div>

                    </div>


                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $("#email").focus();
    </script>
@endsection
