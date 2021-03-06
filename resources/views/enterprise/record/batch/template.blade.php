@extends('layouts.member')

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
                                <a href="{{url('/member/record/create')}}" class="active">信息推送</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/member/record/batch')}}">发送记录</a>
                            </li>
                            <li>
                                <a href="{{url('/member/record/receive')}}" >回执报告</a>
                            </li>
                            <li>
                                <a href="{{url('/member/record/template')}}">发送模板</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel   panel-info">
                    <div class="panel-heading  ">
                        <div class="row">
                            <div class="col-lg-6"> 自定义模板</div>
                            <div class="col-lg-6 text-right"><a href="{{url('/member/record/template')}}">管理 </a></div>
                        </div>
                    </div>

                    <div class="panel-body ">
                        <ul>
                            @foreach($templateList as $item)
                                <li>
                                    <a href="{{url('/member/record/create/'.$item->id)}}">{{$item->name}}</a>
                                </li>
                            @endforeach
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
                                    <span class="state"></span>
                                </div>
                                <div class="col-xs-6 text-right ">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <input id="signatureId" type="hidden"
                                   value="{{$template->signatureId}}">
                            <input id="templateId" type="hidden"
                                   value="{{$template->templateId}}">
                            <input id="contentTemplate" type="hidden"
                                   value="{{$template->template->content}}">


                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>

                                    <div class="form-group{{ $errors->has('signatureId') ? ' has-error' : '' }}">
                                        <label for="signatureId" class="col-md-3 control-label">签名：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$template->signature->name}}</p>

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('templateId') ? ' has-error' : '' }}">
                                        <label for="templateId" class="col-md-3 control-label">模板：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$template->template->name}}</p>

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">

                                            <textarea id="mobile" type="text" class="form-control"
                                                      onkeyup="validateMobile()"
                                                      name="mobile"
                                                      placeholder="多个手机号录入可以使用逗号，空格或回车分隔！"
                                                      style=" height: 100px"
                                            >{{$template->mobile}}</textarea><br>
                                            <span id="charging"></span>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-md-offset-3">
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span>
                                                </button>
                                                <strong>短信预览!</strong>
                                                <div id="contentPreview">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('sendTime') ? ' has-error' : '' }}">
                                        <label for="sendTime" class="col-md-3 control-label">发送时间：</label>

                                        <div class="col-md-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" onchange="isTiming()">定时发送
                                                </label>
                                            </div>
                                            <input id="sendTime" type="datetime" class="form-control auto"
                                                   style="display: none;" onchange="checkTime(this)"
                                                   value="{{ date("Y-m-d H:i:s",time())}}"

                                                   name="sendTime" placeholder="格式：2016-12-01 12:30"
                                            />

                                        </div>
                                    </div>
                                    <input type="hidden" id="param" name="param" value="{{$template->param}}">
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
        var _mobiles = Array();
        var _contentTemplate = null;
        var _contentPreview = null;
        var _paramObj = null;

        init();
        function init() {
            $("#mobile").focus();
            _contentTemplate = $("#contentTemplate").val();
            _paramObj = JSON.parse($("#param").val());
            for (var key in _paramObj) {
                $(".paramUi").append('<div class="form-group"><label for="' + key + '" class="col-md-3 control-label">' + key + '：</label><div class="col-md-9"><input id="' + key + '" type="text" class="form-control"  value="' + _paramObj[key] + '" onkeyup="preview();"></div></div>');
            }
            preview();
            validateMobile();
        }
        //手机号验证
        function validateMobile() {
            _mobiles = Array();
            var _obj = $("#mobile").val();
            if (_obj.trim().length > 0) {
                var mobiles = _obj.replace("，", ",").replace(/\s+/g, ",").replace(/\r\n/g, ",").replace(/\n/g, ",").split(',');
                var hash = {}, len = mobiles.length, result = [];
                for (var i = 0; i < len; i++) {
                    var _mobile = mobiles[i].trim();
                    if (!hash[mobiles[i]]) {
                        hash[mobiles[i]] = true;

                        if (/^1[34578]{1}\d{9}$/.test(_mobile)) {
                            _mobiles.push(_mobile);
                        }
                    }
                }
            }
            charging();
        }


        //短信预览
        function preview() {
            var content = _contentTemplate;
            for (var key in _paramObj) {
                content = content.replace("${" + key + "}", $("#" + key).val());
            }
            _contentPreview = content;
            $("#contentPreview").html(_contentPreview + "【{{$template->signature->name}}】");
            charging();
        }

        //计费计算
        function charging() {
            var content = _contentPreview + "【{{$template->signature->name}}】";

            $("#charging").text("有效号码：" + _mobiles.length + "条，短信内容：" + content.length + "字,计费：" + Math.ceil(content.length / {{$template->words}}) * _mobiles.length + "条");

        }

        //定时发送
        function isTiming() {
            $("#sendTime").toggle();
        }
        //定时发送时间检查
        function checkTime(_obj) {

            var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
            var r = _obj.value.match(reg);
            if (r == null) {
                return alert("定时发送时间格式错误!如:2016-12-20 12:00");
            }
        }

        //短信发送
        function send() {

            var postData = {};

            postData["signatureId"] = $("#signatureId").val();
            postData["templateId"] = $("#templateId").val();
            if (_mobiles.length == 0) {
                return alert("未检查到有效的手机号!");
            }
            postData["mobile"] = _mobiles.join(",");
            postData["content"] = _contentPreview;

            var _sendTime = $("#sendTime").val();
            if (_sendTime.length > 0) {
                var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
                var r = _sendTime.match(reg);
                if (r == null) {
                    return alert("定时发送时间格式错误!如:2016-12-20 12:00");
                } else {
                    postData["sendTime"] = _sendTime;
                }
            }


            for (var key in _paramObj) {
                var _key = $("#" + key + "").val();
                if (!_key || _key.length == 0) {
                    return alert("参数：" + key + "不能为空！")
                }
                _paramObj[key] = _key;
            }
            postData["param"] = JSON.stringify(_paramObj);

            var submit = $(this);

            submit.text("发送中");
            submit.attr("disabled", "true"); //设置变灰按钮
            //setTimeout("$('#submit').removeAttr('disabled')", 3000); //设置三秒后提交按钮 显示

            $(".state").text("发送中");
//            alert(JSON.stringify(postData));
            $.ajax({
                url: "{{url('/member/record/create')}}",
                type: "post",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=utf-8",
                data: postData,
                timeout: 30000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $(".state").text(data.msg);
                    if (data.code == 0) {
                        $("#mobile").val("");
                    }
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
        function showModal() {

            var _signatureId = $("#signatureId").val();
            if (!_signatureId) {
                return alert("请选择签名!");
            }
            var _templateId = $("#templateId").val();
            if (!_templateId) {
                return alert("请选择模板!");
            }


            $('#templateModal').modal('toggle')
        }


        //模板保存
        function saveTemplate() {
            if (!_template) {
                return alert("未获取到模板信息，请选择!");
            }
            var postData = {};
            var _signatureId = $("#signatureId").val();
            if (!_signatureId) {
                return alert("请选择签名!");
            }
            postData["signatureId"] = _signatureId;
            var _templateId = $("#templateId").val();
            if (!_templateId) {
                return alert("请选择模板!");
            }
            postData["templateId"] = _templateId;

            if (_mobiles.length > 0) {
                postData["mobile"] = _mobiles.join(",");
            }
            postData["content"] = _content;

            var _templateName = $("#templateName").val();
            if (!_templateName) {
                return alert("模板名称不能为空!");
            }
            postData["name"] = _templateName;

            postData["share"] = $("#templateShare").val();
            var _sendTime = $("#sendTime").val();
            if (_sendTime.length > 0) {
                postData["sendTime"] = _sendTime;
            }

            var paramObj = JSON.parse(_template.param);

            for (var key in paramObj) {
                paramObj[key] = $("#" + key + "").val();
            }
            postData["param"] = JSON.stringify(paramObj);

            $.ajax({
                url: "{{url('/member/record/template/create')}}",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=utf-8",
                type: "post",
                data: postData,
                timeout: 30000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $(".state").text(data.msg);
                    if (data.code == 0) {
                        $('#templateModal').modal('toggle')
                    }
                },
                error: function (XHR, textStatus, errorThrown) {
                    alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                }
            });
        }


    </script>
@endsection
