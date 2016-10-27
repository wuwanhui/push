@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">短信测试</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/sms') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('mobel') ? ' has-error' : '' }}">
                                <label for="model" class="col-md-4 control-label">手机号：</label>

                                <div class="col-md-6">
                                    <input id="mobel" type="text" class="form-control" name="model"
                                           value="{{ old('model') }}" required autofocus>

                                    @if ($errors->has('mobel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobel') }}</strong>
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
                                    <input id="template" type="text" class="form-control" name="param"
                                           value="{{ old('template') }}" required autofocus>

                                    @if ($errors->has('template'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('template') }}</strong>
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
