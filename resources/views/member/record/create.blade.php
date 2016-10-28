@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">推送平台</a></li>
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
                                <a href="{{url('/member/record/create')}}" class="active">信息推送</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/member/record')}}">发送记录</a>
                            </li>
                            <li>
                                <a href="{{url('/member/record/receive')}}">回执报告</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <form class="form-horizontal" role="form" method="POST" id="form">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="button" class="btn  btn-primary" onclick="send()">
                                        发送
                                    </button>

                                </div>
                                <div class="col-xs-6 text-right state"></div>
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
                                                        onchange="preview(this);"
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
                                                        onchange="template(this);"
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
                                                      onchange="validateMobile()"
                                                      name="mobile"
                                                      style=" height: 100px"
                                            >{{old('mobile') }}</textarea><br>
                                            <span id="mobileNo"></span>

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label for="content" class="col-md-3 control-label">内容预览：</label>

                                        <div class="col-md-9">

                                            <textarea id="content" type="text" class="form-control" disabled
                                                      name="content"
                                                      style=" height: 100px"
                                            > </textarea>
                                            <div id="preview" class="alert alert-success" role="alert"
                                                 style="display:none">
                                                <button type="button" class="close" data-dismiss="alert"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span>
                                                </button>
                                                <strong>短信预览!</strong>
                                                <div>Better check yourself, you're not looking too good.
                                                </div>

                                            </div>

                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('sendTime') ? ' has-error' : '' }}">
                                        <label for="sendTime" class="col-md-3 control-label">发送时间：</label>

                                        <div class="col-md-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="isTiming">定时发送
                                                </label>
                                            </div>
                                            <input id="sendTime" type="datetime" class="form-control auto"
                                                   style="display: none;"
                                                   name="sendTime" placeholder="格式：2016-12-01 12:30"
                                            />

                                            @if ($errors->has('sendTime'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('sendTime') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" id="param" name="param">
                                    <div class="paramUi">

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


    <script type="application/javascript">
        var _template = null;
        var _mobileNo = 0;

        //短信预览
        function preview() {
            if (_template) {
                var content = _template.content;
                var paramObj = JSON.parse(_template.param);
                for (var key in paramObj) {
                    content = content.replace("${" + key + "}", $("#" + key).val());
                }
                content = content + "【" + $("#signatureId   option:selected").text() + "】";
                $("#preview div").html(content + "<br/>-共计：" + content.length + "字,计费：" + Math.ceil(content.length / 60) * _mobileNo + "条");
            }
        }

        //模板选择
        function template(_obj) {
            _template = null;

            $("#content").val('');
            $(".paramUi").empty();
            $("#preview").hide();
            var _templateId = _obj.value;
            if (!_templateId) {
                return;
            }
            $(".state").text("加载中");
            $.ajax({
                url: "{{url('/member/record/template')}}",
                type: "post",
                dataType: "json",
                data: {id: _templateId},
                timeout: 30000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    _template = data;
                    $(".state").empty();
                    $("#preview").show();
                    $("#content").val(_template.content);

                    var paramObj = JSON.parse(_template.param);

                    for (var key in paramObj) {
                        $(".paramUi").append('<div class="form-group"><label for="' + key + '" class="col-md-3 control-label">' + key + '：</label><div class="col-md-9"><input id="' + key + '" type="text" class="form-control"  value="' + paramObj[key] + '" onkeyup="preview();"></div></div>');
                    }
                    preview();

                },
                error: function (XHR, textStatus, errorThrown) {
                    $(".state").text("获取模板信息失败");
                    alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                }
            });
        }

        //手机号验证
        function validateMobile() {
            var _obj = $("#mobile").val();
            var validNo = 0;
            var invalidNo = 0;
            if (_obj.trim().length > 0) {
                var _mobiles = _obj.replace("，", ",").replace("\n", ",").split(',');
                for (i in _mobiles) {
                    var _mobile = _mobiles[i].trim();
                    if (/^1[34578]{1}\d{9}$/.test(_mobile)) {
                        validNo++;
                    } else {
                        invalidNo++;
                        //alert("对不起，第" + (i + 1) + "条电话号码格式错误！" + _mobiles[i]);
                    }
                }
            }

            _mobileNo = validNo;

            $("#mobileNo").text("有效号码：" + validNo + "条，无效号码：" + invalidNo + "条");
            preview();
        }


        //定时发送
        function isTiming() {
            $("#sendTime").toggle();
        }


        //短信发送
        function send() {
            if (!_template) {
                return alert("未获取到模板信息，请选择!");
            }
            var postData = {};

            var _signatureId = $("#signatureId").val();
            postData["signatureId"] = _signatureId;
            var _templateId = $("#templateId").val();
            postData["templateId"] = _templateId;
            var _mobile = $("#mobile").val();
            if (_mobile.length < 11) {
                alert("请输入准确的手机号!");

            }
            postData["mobile"] = _mobile;
            var _content = $("#content").val();
            postData["content"] = _content;

            var _sendTime = $("#sendTime").val();
            if (_sendTime.length > 0) {
                postData["sendTime"] = _sendTime;
            }

            var paramObj = JSON.parse(_template.param);

            for (var key in paramObj) {
                var _key = $("#" + key + "").val();
                if (!_key || _key.length == 0) {
                    return alert("参数：" + key + "不能为空！")
                }
                paramObj[key] = _key;
            }
            var _paramJson = JSON.stringify(paramObj)
            postData["param"] = _paramJson;

            var submit = $(this);

            submit.text("发送中");
            submit.attr("disabled", "true"); //设置变灰按钮
            //setTimeout("$('#submit').removeAttr('disabled')", 3000); //设置三秒后提交按钮 显示

            $(".state").text("发送中");

            $.ajax({
                url: "{{url('/member/record/create')}}",
                type: "post",
                contentType: "application/x-www-form-urlencoded; charset=utf-8",
                data: postData,
                timeout: 30000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $(".state").html(data);
                    $("#mobile").val("");
                    preview();

                    submit.text("发送");
                    submit.removeAttr('disabled'); //设置按钮可用
                },
                error: function (XHR, textStatus, errorThrown) {
                    submit.text("发送");
                    submit.removeAttr('disabled'); //设置按钮可用
                    alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                }
            });
        }


        $(function () {

            $("#isTiming").change(function () {
                $("#sendTime").toggle();
            });
            $("#templateId11").change(function () {
                _template = null;
                var _templateId = $(this).val();
                $("#content").val('');
                $(".paramUi").empty();

                if (!value) {
                    $("#preview").hide();
                    return;
                }
                $(".state").text("加载中");
                $.ajax({
                    url: "{{url('/member/record/template')}}",
                    type: "post",
                    dataType: "json",
                    data: {id: _templateId},
                    timeout: 30000,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        _template = data;
                        $(".state").empty();
                        $("#preview").show();
                        $("#content").val(_template.content);

                        for (var key in  JSON.parse(_template.param)) {
                            $(".paramUi").append('<div class="form-group"><label for="' + key + '" class="col-md-3 control-label">' + key + '：</label><div class="col-md-9"><input id="' + key + '" type="text" class="form-control"  value="' + paramJson[key] + '" onkeyup="preview();"></div></div>');
                        }

                        preview();

                    },
                    error: function (XHR, textStatus, errorThrown) {
                        $(".state").text("获取模板信息失败");
                        alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                    }
                });
            });

            $("#submit").click(function () {

                var submit = $(this);
                var form = $("#form");
                submit.text("发送中");
                submit.attr("disabled", "true"); //设置变灰按钮
                //setTimeout("$('#submit').removeAttr('disabled')", 3000); //设置三秒后提交按钮 显示
                if (!paramJson) {
                    return false;
                }

                for (var key in paramJson) {
                    paramJson[key] = $("#" + key + "").val();
                }
                $("#param").val(JSON.stringify(paramJson));

                $(".state").text("发送中");

                $.ajax({
                    url: "{{url('/member/record/create')}}",
                    type: "post",
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    data: form.serialize(),
                    timeout: 30000,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $(".state").text(data);

                        submit.text("发送");
                        submit.removeAttr('disabled'); //设置按钮可用
                    },
                    error: function (XHR, textStatus, errorThrown) {
                        submit.text("发送");
                        submit.removeAttr('disabled'); //设置按钮可用
                        alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                    }
                });

            });


        });

        function check(form) {

        }
    </script>
@endsection
