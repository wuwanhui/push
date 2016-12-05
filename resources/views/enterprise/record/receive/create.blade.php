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
                            <li>
                                <a href="{{url('/manage/record/template')}}">发送模板</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel   panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6"> 自定义模板</div>
                            <div class="col-lg-6 text-right"><a href="{{url('/manage/record/template')}}">管理 </a></div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <ul>
                            @foreach($templateList as $item)
                                <li>
                                    <a href="{{url('/manage/record/create/'.$item->id)}}">{{$item->name}}</a>
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
                                    <button type="button" class="btn btn-primary " onclick="showModal()">
                                        存为模板
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>短信发送</legend>


                                    @if($signatures )
                                        <div class="form-group">
                                            <label for="signatureId" class="col-md-3 control-label">签名：</label>

                                            <div class="col-md-9">
                                                <select id="signatureId" name="signatureId" class="form-control"
                                                        onchange="preview(this);"
                                                        style="width: auto;">
                                                    @foreach($signatures as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    @endif

                                    @if($templates )
                                        <div class="form-group ">
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

                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group ">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">

                                            <textarea id="mobile" type="text" class="form-control"
                                                      onkeyup="validateMobile()"
                                                      name="mobile"
                                                      placeholder="多个手机号录入可以使用逗号，空格或回车分隔！"
                                                      style=" height: 100px"
                                            >{{$record->mobile }}</textarea><br>
                                            <span id="charging"></span>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9 col-md-offset-3">
                                            <div id="preview" class="alert alert-success" role="alert"
                                                 style="display:none">
                                                <button type="button" class="close" data-dismiss="alert"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span>
                                                </button>
                                                <strong>短信预览!</strong>
                                                <div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="sendTime" class="col-md-3 control-label">发送时间：</label>

                                        <div class="col-md-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" onchange="isTiming()" id="checkTime">定时发送
                                                </label>
                                            </div>
                                            <input id="sendTime" type="datetime" class="form-control auto"
                                                   style="display: none;" onchange="checkTime(this)"
                                                   value="{{ date("Y-m-d H:i:s",time())}}"
                                                   name="sendTime" placeholder="格式：2016-12-01 12:30"/>

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

    <!-- 存为模板 -->
    <div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="templateModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="templateModalLabel">存为模板</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="form-group ">
                            <label for="templateName" class="col-md-3 control-label">模板名称：</label>
                            <div class="col-md-9">
                                <input id="templateName" type="text" class="form-control" name="templateName"
                                       placeholder="模板名称"
                                       autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="templateShare" class="col-md-3 control-label">是否分享：</label>
                            <div class="col-md-9">
                                <select id="templateShare" name="templateShare" class="form-control"
                                        style="width: auto;">
                                    <option value="0">私有</option>
                                    <option value="1">分享</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="saveTemplate()">保存</button>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        var _template = null;
        var _mobiles = Array();
        var _content = null;

        init();
        function init() {
            $("#templateId").focus();
        }


        //模板选择
        function template(_obj) {
            _template = null;

            $(".paramUi").empty();
            $("#preview").hide();
            var _templateId = _obj.value;
            if (!_templateId) {
                preview();
                return;
            }
            $(".state").text("加载中");
            $.ajax({
                url: "{{url('/manage/record/template')}}",
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
            if (_template) {
                _content = _template.content;
                var paramObj = JSON.parse(_template.param);
                for (var key in paramObj) {
                    _content = _content.replace("${" + key + "}", $("#" + key).val());
                }
                $("#preview div").html(_content + "【" + $("#signatureId   option:selected").text() + "】");
            }
            charging();
        }

        //计费计算
        function charging() {
            var content = _content + "【" + $("#signatureId   option:selected").text() + "】";
            if (_template) {
                $("#charging").text("有效号码：" + _mobiles.length + "条，短信内容：" + content.length + "字,计费：" + Math.ceil(content.length / 60) * _mobiles.length + "条");
            } else {
                $("#charging").text("有效号码：" + _mobiles.length + "条");
            }
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
            if (!_template) {
                return alert("未获取到模板信息，请选择!");
            }
            var postData = {};

            postData["signatureId"] = $("#signatureId").val();
            postData["templateId"] = $("#templateId").val();
            if (_mobiles.length == 0) {
                return alert("未检查到有效的手机号!");
            }
            postData["mobile"] = _mobiles.join(",");
            postData["content"] = _content;
            if ($("#checkTime").is(':checked')) {
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
                url: "{{url('/manage/record/create')}}",
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
                url: "{{url('/manage/record/template/create')}}",
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
