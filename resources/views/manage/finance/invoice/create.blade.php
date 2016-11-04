@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">

            <li><a href="#">管理中心</a></li>
            <li class="active">财务结算</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">财务结算</div>

                    <div class="panel-body ">
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/recharge')}}">支付记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/finance/invoice')}}"   class="active">发票申请</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/quantity')}}">充值管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <form class="form-horizontal" role="form" method="POST" onsubmit="formCheck(this)">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-2  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="submit" class="btn  btn-primary">提交</button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>发票信息</legend>
                                    {!! csrf_field() !!}

                                    <div class="form-group{{ $errors->has('enterprise') ? ' has-error' : '' }}">
                                        <label for="enterprise" class="col-md-3 control-label">发票抬头：</label>

                                        <div class="col-md-9">
                                            <input id="enterprise" type="text" class="form-control  " name="enterprise"
                                                   value="{{$invoice->enterprise}}">

                                            @if ($errors->has('enterprise'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('enterprise') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('money') ? ' has-error' : '' }}">
                                        <label for="money" class="col-md-3 control-label">发票金额：</label>

                                        <div class="col-md-9">
                                            <input id="money" type="text" class="form-control auto" name="money"
                                                   placeholder="最多可申请{{$invoice->money}}元发票金额"
                                                   value="{{$invoice->money}}">

                                            @if ($errors->has('money'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('money') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>快递信息</legend>

                                    <div class="form-group{{ $errors->has('linkMan') ? ' has-error' : '' }}">
                                        <label for="linkMan" class="col-md-3 control-label">收件人：</label>

                                        <div class="col-md-9">
                                            <input id="linkMan" type="text" class="form-control auto" name="linkMan"
                                                   value="{{$invoice->linkMan}}">

                                            @if ($errors->has('linkMan'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('linkMan') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">
                                            <input id="mobile" type="text" class="form-control auto" name="mobile"
                                                   value="{{$invoice->mobile}}">

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                        <label for="tel" class="col-md-3 control-label">座机电话：</label>

                                        <div class="col-md-9">
                                            <input id="tel" type="text" class="form-control auto" name="tel"
                                                   value="{{$invoice->tel}}">

                                            @if ($errors->has('tel'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                                        <label for="addres" class="col-md-3 control-label">收件地址：</label>

                                        <div class="col-md-9">

                                            <textarea id="addres" type="text" class="form-control"
                                                      name="addres"
                                                      style=" height:60px"
                                            >{{$invoice->addres}}</textarea>

                                            @if ($errors->has('addres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('addres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('remark') ? ' has-error' : '' }}">
                                        <label for="remark" class="col-md-3 control-label">备注：</label>

                                        <div class="col-md-9">

                                            <textarea id="remark" type="text" class="form-control"
                                                      name="remark"
                                                      style=" height: 100px"
                                            >{{old('remark') }}</textarea>

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
                @include("common.errors")   </div>
        </div>
    </div>

    <script type="application/javascript">
        function formCheck(_obj) {
            return false;
        }


    </script>
@endsection
