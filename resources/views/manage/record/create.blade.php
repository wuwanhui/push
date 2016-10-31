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
                    <div class="panel-heading">信息推送</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/record/create')}}" class="active">信息推送</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/record')}}">发送记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/record/receive')}}">回执报告</a>
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
                                    <button type="submit" class="btn  btn-primary" onclick="return check(this.form)">
                                        发送
                                    </button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>

                                    @if($signatures )
                                        <div class="form-group{{ $errors->has('signatureId') ? ' has-error' : '' }}">
                                            <label for="signatureId" class="col-md-3 control-label">签名：</label>

                                            <div class="col-md-9">
                                                <select id="signatureId" name="signatureId" class="form-control"
                                                        style="width: auto;">
                                                    @foreach($signatures as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('signatureId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('signatureId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if($templates )
                                        <div class="form-group{{ $errors->has('templateId') ? ' has-error' : '' }}">
                                            <label for="templateId" class="col-md-3 control-label">模板：</label>

                                            <div class="col-md-9">
                                                <select id="templateId" name="templateId" class="form-control"
                                                        style="width: auto;">
                                                    <option value="">请选择模板</option>
                                                    @foreach($templates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('templateId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('templateId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">

                                            <textarea id="mobile" type="text" class="form-control"
                                                      name="mobile"
                                                      style=" height: 100px"
                                            >{{old('mobile') }}</textarea>

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label for="content" class="col-md-3 control-label">内容：</label>

                                        <div class="col-md-9">

                                            <textarea id="content" type="text" class="form-control"
                                                      name="content"
                                                      style=" height: 100px"
                                            >{{old('content') }}</textarea>

                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" id="param" name="param">


                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                @include("common.success")
                @include("common.errors") </div>
        </div>
    </div>


    <script type="application/javascript">
        var paramJson = null;
        $(function () {
            $("#templateId").change(function () {
                var value = $(this).val();
                if (!value) {
                    return;
                }

                $.ajax({
                    url: "{{url('/manage/record/template')}}",
                    type: "post",
                    dataType: "json",
                    data: {id: value},
                    timeout: 30000,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        var param = data.param;
                        if (param) {
                            paramJson = JSON.parse(param);


                            for (var key in paramJson) {
                                var content = '<div class="form-group"><label for="param.' + key + '" class="col-md-3 control-label">' + key + '：</label><div class="col-md-9"><input id="param.' + key + '" type="text" class="form-control"  value="' + paramJson[key] + '"></div></div>';
                                $("#param").before(content);
                            }

                        }


                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                    }
                });
            });


        });

        function check(form) {
            if (!paramJson) {
                return false;
            }

            for (var key in paramJson) {
                paramJson[key] = form['param.' + key].value;
            }
            form['param'].value = JSON.stringify(paramJson);

            return true;
        }
    </script>
@endsection
