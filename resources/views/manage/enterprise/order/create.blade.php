@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">会员中心</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">会员中心</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/member')}}" class="active">会员管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/member/order')}}">订单管理</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/scenic')}}">会员统计</a>
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
                                    <legend>产品信息</legend>
                                    @if($scenics )
                                        <div class="form-group{{ $errors->has('scenicId') ? ' has-error' : '' }}">
                                            <label for="scenicId" class="col-md-3 control-label">产品选择：</label>

                                            <div class="col-md-9">
                                                <select id="scenicId" name="scenicId" class="form-control"
                                                        style="width: auto;">
                                                    <option value="">请选择产品</option>
                                                    @foreach($scenics as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('scenicId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('scenicId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('produitsId') ? ' has-error' : '' }}">
                                        <label for="produitsId" class="col-md-3 control-label">价格项：</label>

                                        <div class="col-md-9">
                                            <select id="produitsId" name="produitsId" class="form-control"
                                                    style="width: auto;">
                                                <option value="">请先选择产品</option>
                                            </select>

                                            @if ($errors->has('produitsId'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('produitsId') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('ticketDate') ? ' has-error' : '' }}">
                                        <label for="ticketDate" class="col-md-3 control-label">票面日期：</label>

                                        <div class="col-md-9">
                                            <input id="ticketDate" type="date" class="form-control" name="ticketDate"
                                                   style="width: 300px;"
                                                   value="{{ old('ticketDate') }}" autofocus>

                                            @if ($errors->has('ticketDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('ticketDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label for="price" class="col-md-3 control-label">单价：</label>

                                        <div class="col-md-9">
                                            <input id="price" type="text" class="form-control" name="price"
                                                   style="width: 300px;"
                                                   value="{{ old('price') }}" autofocus>

                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                        <label for="quantity" class="col-md-3 control-label">数量：</label>

                                        <div class="col-md-9">
                                            <input id="quantity" type="number" class="form-control" name="quantity"
                                                   style="width: 300px;"
                                                   value="1" autofocus>

                                            @if ($errors->has('quantity'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="total" class="col-md-3 control-label">合计：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static"><span style="font-size: 20px"
                                                                                 id="total">0.0</span>元</p>
                                        </div>
                                    </div>


                                </fieldset>
                                <fieldset>
                                    <legend>订单信息</legend>
                                    <div class="form-group{{ $errors->has('linkMan') ? ' has-error' : '' }}">
                                        <label for="linkMan" class="col-md-3 control-label">联系人：</label>

                                        <div class="col-md-9">
                                            <input id="linkMan" type="text" class="form-control" name="linkMan"
                                                   style="width: auto;"
                                                   value="{{ old('linkMan') }}" autofocus>

                                            @if ($errors->has('linkMan'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('linkMan') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('idCard') ? ' has-error' : '' }}">
                                        <label for="idCard" class="col-md-3 control-label">身份证号：</label>

                                        <div class="col-md-9">
                                            <input id="idCard" type="text" class="form-control" name="idCard"
                                                   style="width: 300px;"
                                                   value="{{ old('idCard') }}" autofocus>

                                            @if ($errors->has('idCard'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('idCard') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">
                                            <input id="mobile" type="text" class="form-control" name="mobile"
                                                   style="width: 300px;"
                                                   value="{{ old('mobile') }}" autofocus>

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-3 control-label">邮箱：</label>

                                        <div class="col-md-9">
                                            <input id="email" type="text" class="form-control" name="email"
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
                                                   style="width: 300px;"
                                                   value="{{ old('addres') }}" autofocus>

                                            @if ($errors->has('addres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('addres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>渠道信息</legend>
                                    @if($distributions )
                                        <div class="form-group{{ $errors->has('distributionId') ? ' has-error' : '' }}">
                                            <label for="distributionId" class="col-md-3 control-label">分销商：</label>

                                            <div class="col-md-9">
                                                <select name="distributionId" class="form-control" style="width: auto;">
                                                    <option value="">请选择分销商</option>
                                                    @foreach($distributions as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('distributionId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('distributionId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($members )
                                        <div class="form-group{{ $errors->has('memberId') ? ' has-error' : '' }}">
                                            <label for="memberId" class="col-md-3 control-label">所属会员：</label>

                                            <div class="col-md-9">
                                                <select name="memberId" class="form-control" style="width: auto;">
                                                    <option value="">未知会员</option>
                                                    @foreach($members as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('memberId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('memberId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control" style="width: auto;">
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
                                    <div class="form-group{{ $errors->has('remark') ? ' has-error' : '' }}">
                                        <label for="remark" class="col-md-3 control-label">内部备注：</label>

                                        <div class="col-md-9">

                                            <textarea id="remark" type="text" class="form-control"
                                                      name="remark"
                                                      style=" height: 100px"
                                            >{{old('refundable') }}</textarea>

                                            @if ($errors->has('remark'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('remark') }}</strong>
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

    <script type="application/javascript">
        $(function () {
            var produitList = null;
            $("#scenicId").change(function () {
                var value = $(this).val();
                $("#price").val('');
                $("#produitsId").empty();
                if (!value) {
                    $("#produitsId").append("<option value=''>请选择产品</option>");
                    produitList = null;
                    return;
                }
                $("#produitsId").append("<option value=''>加载中...</option>");

                $.ajax({
                    url: "{{url('/manage/member/order/scenic')}}",
                    type: "post",
                    dataType: "json",
                    data: {scenicId: value},
                    timeout: 30000,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        produitList = data;
                        $("#produitsId").empty();

                        if (produitList.length > 0) {
                            $("#produitsId").append("<option value=''>请选择价格项</option>");
                            for (i = 0; i < data.length; i++) {
                                $("#produitsId").append("<option value='" + data[i].id + "'>" + data[i].name + "（" + data[i].price + "元）</option>");
                            }
                        } else {
                            $("#produitsId").append("<option value=''>未查询到相关价格项</option>");
                        }
                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                    }
                });
            });

            $("#produitsId").change(function () {
                $("#price").val('');
                var quantity = $("#quantity").val();
                var index = $("#produitsId").prop('selectedIndex') - 1;
                var value = produitList[index];
                $("#price").val(value.price);
                $("#total").text(value.price * quantity);

            });

            $("#quantity,#price").change(function () {
                var quantity = $("#quantity").val();
                var price = $("#price").val();

                $("#total").text(quantity * price);

            });
        })
    </script>
@endsection
