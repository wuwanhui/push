@extends('layouts.manage')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">短信测试</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/manage/sms/create') }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">手机号：</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile"
                                           value="{{ old('mobile') }}" required autofocus>

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('param') ? ' has-error' : '' }}">
                                <label for="param" class="col-md-4 control-label">参数：</label>

                                <div class="col-md-6">

                                    <textarea id="param" type="text" class="form-control" name="param"
                                              value="{{ old('param') }}" autofocus></textarea>

                                    @if ($errors->has('param'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('param') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('template') ? ' has-error' : '' }}">
                                <label for="template" class="col-md-4 control-label">模板ID：</label>

                                <div class="col-md-6">
                                    <input id="template" type="text" class="form-control" name="template"
                                           value="{{ old('template') }}" required autofocus>

                                    @if ($errors->has('template'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('template') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('sign') ? ' has-error' : '' }}">
                                <label for="sign" class="col-md-4 control-label">签名：</label>

                                <div class="col-md-6">
                                    <input id="sign" type="text" class="form-control" name="sign"
                                           value="元佑科技" required autofocus>

                                    @if ($errors->has('sign'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sign') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">类型：</label>

                                <div class="col-md-6">
                                    <input id="type" type="text" class="form-control" name="type"
                                           value="normal" required autofocus>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('extend') ? ' has-error' : '' }}">
                                <label for="extend" class="col-md-4 control-label">扩展码：</label>

                                <div class="col-md-6">
                                    <input id="extend" type="text" class="form-control" name="extend"
                                           value="{{ old('extend') }}" required autofocus>

                                    @if ($errors->has('extend'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('extend') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        发送
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
