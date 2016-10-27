@extends('layouts.weixin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">新增订单</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('bl') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">内部使用标志：</label>

                                <div class="col-md-6">
                                    <input id="bl" type="text" class="form-control" name="bl"
                                           value="{{ old('bl') }}" required autofocus>

                                    @if ($errors->has('bl'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bl') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">订单类型：</label>

                                <div class="col-md-6">
                                    <select id="type" name="type" class="form-control">
                                        <option value="1">普通订单（分销商已经收款）</option>
                                        <option value="2">预订订单（分销商未收款）</option>
                                    </select>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('orderid') ? ' has-error' : '' }}">
                                <label for="orderid" class="col-md-4 control-label">订单编号：</label>

                                <div class="col-md-6">
                                    <input id="orderid" type="text" class="form-control" name="orderid"
                                           placeholder="分销商校验码 利用分销商编码和订单编号进行唯一校验"
                                           value="{{ old('orderid') }}" required autofocus>

                                    @if ($errors->has('orderid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('orderid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('realprice') ? ' has-error' : '' }}">
                                <label for="realprice" class="col-md-4 control-label">成交价格：</label>

                                <div class="col-md-6">
                                    <input id="realprice" type="text" class="form-control" name="realprice"
                                           placeholder="订单实际成交价格"
                                           value="{{ old('orderid') }}" required autofocus>

                                    @if ($errors->has('realprice'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('realprice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('contactname') ? ' has-error' : '' }}">
                                <label for="contactname" class="col-md-4 control-label">联系人：</label>

                                <div class="col-md-6">
                                    <input id="contactname" type="text" class="form-control" name="contactname"
                                           value="{{ old('contactname') }}" required autofocus>

                                    @if ($errors->has('contactname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contactname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('idcardcode') ? ' has-error' : '' }}">
                                <label for="idcardcode" class="col-md-4 control-label">身份证号码 ：</label>

                                <div class="col-md-6">
                                    <input id="idcardcode" type="text" class="form-control" name="idcardcode"
                                           value="{{ old('idcardcode') }}" required autofocus>

                                    @if ($errors->has('idcardcode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('idcardcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('arrivedate') ? ' has-error' : '' }}">
                                <label for="arrivedate" class="col-md-4 control-label">到达日期：</label>

                                <div class="col-md-6">
                                    <input id="arrivedate" type="text" class="form-control" name="arrivedate"
                                           value="{{ old('arrivedate') }}" required autofocus>

                                    @if ($errors->has('arrivedate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('arrivedate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('contactarea') ? ' has-error' : '' }}">
                                <label for="contactarea" class="col-md-4 control-label">联系人行政区划：</label>

                                <div class="col-md-6">
                                    <input id="contactarea" type="text" class="form-control" name="contactarea"
                                           value="{{ old('contactarea') }}" required autofocus>

                                    @if ($errors->has('contactarea'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contactarea') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('productLists') ? ' has-error' : '' }}">
                                <label for="productLists" class="col-md-4 control-label">产品列表：</label>

                                <div class="col-md-6">
                                    <input id="productLists" type="text" class="form-control" name="productLists"
                                           value="{{ old('productLists') }}" required autofocus>

                                    @if ($errors->has('productLists'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('productLists') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                                <label for="product" class="col-md-4 control-label">产品：</label>

                                <div class="col-md-6">
                                    <input id="product" type="text" class="form-control" name="product"
                                           value="{{ old('product') }}" required autofocus>

                                    @if ($errors->has('product'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('procode') ? ' has-error' : '' }}">
                                <label for="procode" class="col-md-4 control-label">产品编码：</label>

                                <div class="col-md-6">
                                    <input id="procode" type="text" class="form-control" name="procode"
                                           value="{{ old('procode') }}" required autofocus>

                                    @if ($errors->has('procode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('procode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('buynum') ? ' has-error' : '' }}">
                                <label for="buynum" class="col-md-4 control-label">订购数量：</label>

                                <div class="col-md-6">
                                    <input id="buynum" type="text" class="form-control" name="buynum"
                                           value="{{ old('buynum') }}" required autofocus>

                                    @if ($errors->has('buynum'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('buynum') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('buyprice') ? ' has-error' : '' }}">
                                <label for="buyprice" class="col-md-4 control-label">订购单价：</label>

                                <div class="col-md-6">
                                    <input id="buyprice" type="text" class="form-control" name="buyprice"
                                           value="{{ old('buyprice') }}" required autofocus>

                                    @if ($errors->has('buyprice'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('buyprice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('buytotaoprice') ? ' has-error' : '' }}">
                                <label for="buytotaoprice" class="col-md-4 control-label">订购总价：</label>

                                <div class="col-md-6">
                                    <input id="buytotaoprice" type="text" class="form-control" name="buytotaoprice"
                                           value="{{ old('buytotaoprice') }}" required autofocus>

                                    @if ($errors->has('buytotaoprice'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('buytotaoprice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('extend') ? ' has-error' : '' }}">
                                <label for="extend" class="col-md-4 control-label">扩展属性：</label>

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
