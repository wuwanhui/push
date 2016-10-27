@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">分销渠道</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">分销渠道</div>

                    <div class="panel-body ">
                        <ul>
                            <li>
                                <a href="{{url('/manage/distribution')}}" class="active">分销商管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/distribution/sales')}}">产品授权</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/distribution/policy')}}">默认政策</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/distribution/special')}}">特殊合同</a>
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
                                <div class="col-xs-2  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="submit" class="btn  btn-primary">保存</button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>
                                    {!! csrf_field() !!}


                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">企业名称：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('legalPerson') ? ' has-error' : '' }}">
                                        <label for="legalPerson" class="col-md-3 control-label">法人：</label>

                                        <div class="col-md-9">
                                            <input id="legalPerson" type="text" class="form-control" name="legalPerson"
                                                   style="width: auto;"
                                                   value="{{ old('legalPerson') }}">

                                            @if ($errors->has('legalPerson'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('legalPerson') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('idCard') ? ' has-error' : '' }}">
                                        <label for="idCard" class="col-md-3 control-label">身份证号：</label>

                                        <div class="col-md-9">
                                            <input id="idCard" type="text" class="form-control" name="idCard"
                                                   style="width: auto;"
                                                   value="{{ old('idCard') }}">

                                            @if ($errors->has('idCard'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('idCard') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                        <label for="birthday" class="col-md-3 control-label">生日：</label>

                                        <div class="col-md-9">
                                            <input id="birthday" type="text" class="form-control" name="legalPerson"
                                                   style="width: auto;"
                                                   value="{{ old('birthday') }}">

                                            @if ($errors->has('birthday'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label for="province" class="col-md-3 control-label">所在省：</label>

                                        <div class="col-md-9">
                                            <input id="province" type="text" class="form-control" name="province"
                                                   style="width: auto;"
                                                   value="{{ old('province') }}">

                                            @if ($errors->has('province'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label for="city" class="col-md-3 control-label">所在市：</label>

                                        <div class="col-md-9">
                                            <input id="city" type="text" class="form-control" name="city"
                                                   style="width: auto;"
                                                   value="{{ old('city') }}">

                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                                        <label for="addres" class="col-md-3 control-label">地址：</label>

                                        <div class="col-md-9">
                                            <input id="addres" type="text" class="form-control" name="addres"
                                                   value="{{ old('addres') }}">

                                            @if ($errors->has('addres'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('addres') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('linkMan') ? ' has-error' : '' }}">
                                        <label for="linkMan" class="col-md-3 control-label">联系人：</label>

                                        <div class="col-md-9">
                                            <input id="linkMan" type="text" class="form-control" name="linkMan"
                                                   style="width: auto;"
                                                   value="{{ old('linkMan') }}">

                                            @if ($errors->has('linkMan'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('linkMan') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                        <label for="sex" class="col-md-3 control-label">性别：</label>

                                        <div class="col-md-9">
                                            <select id="sex" name="sex" class="form-control" style="width: auto;">
                                                <option value="0">未知</option>
                                                <option value="1">男</option>
                                                <option value="2">女</option>
                                            </select>

                                            @if ($errors->has('sex'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">
                                            <input id="mobile" type="text" class="form-control" name="mobile"
                                                   style="width: auto;"
                                                   value="{{ old('mobile') }}">

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                        <label for="tel" class="col-md-3 control-label">联系电话：</label>

                                        <div class="col-md-9">
                                            <input id="tel" type="text" class="form-control" name="tel"
                                                   style="width: auto;"
                                                   value="{{ old('tel') }}">

                                            @if ($errors->has('tel'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                        <label for="fax" class="col-md-3 control-label">传真：</label>

                                        <div class="col-md-9">
                                            <input id="fax" type="text" class="form-control" name="fax"
                                                   style="width: auto;"
                                                   value="{{ old('fax') }}">

                                            @if ($errors->has('fax'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('qq') ? ' has-error' : '' }}">
                                        <label for="qq" class="col-md-3 control-label">QQ：</label>

                                        <div class="col-md-9">
                                            <input id="qq" type="text" class="form-control" name="qq"
                                                   style="width: auto;"
                                                   value="{{ old('qq') }}">

                                            @if ($errors->has('qq'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('qq') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-3 control-label">电子邮件：</label>

                                        <div class="col-md-9">
                                            <input id="email" type="text" class="form-control" name="email"
                                                   value="{{ old('email') }}">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('weibo') ? ' has-error' : '' }}">
                                        <label for="weibo" class="col-md-3 control-label">微博：</label>

                                        <div class="col-md-9">
                                            <input id="weibo" type="text" class="form-control" name="weibo"
                                                   value="{{ old('weibo') }}">

                                            @if ($errors->has('weibo'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('weibo') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('weixin') ? ' has-error' : '' }}">
                                        <label for="weixin" class="col-md-3 control-label">微信号：</label>

                                        <div class="col-md-9">
                                            <input id="weixin" type="text" class="form-control" name="weixin"
                                                   value="{{ old('weixin') }}">

                                            @if ($errors->has('weixin'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('weixin') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('warningTel') ? ' has-error' : '' }}">
                                        <label for="warningTel" class="col-md-3 control-label">预警联系电话：</label>

                                        <div class="col-md-9">
                                            <input id="warningTel" type="text" class="form-control" name="warningTel"
                                                   style="width: auto;"
                                                   value="{{ old('warningTel') }}">

                                            @if ($errors->has('warningTel'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('warningTel') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('warningCredit') ? ' has-error' : '' }}">
                                        <label for="warningCredit" class="col-md-3 control-label">预警额度：</label>

                                        <div class="col-md-9">
                                            <input id="warningCredit" type="text" class="form-control"
                                                   style="width: auto;"
                                                   name="warningCredit"
                                                   value="{{ old('warningCredit') }}">

                                            @if ($errors->has('warningCredit'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('warningCredit') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('openId') ? ' has-error' : '' }}">
                                        <label for="openId" class="col-md-3 control-label">微信绑定：</label>

                                        <div class="col-md-9">
                                            <input id="openId" type="text" class="form-control" name="openId"
                                                   value="{{ old('openId') }}">

                                            @if ($errors->has('openId'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('openId') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($users)
                                        <div class="form-group{{ $errors->has('liableId') ? ' has-error' : '' }}">
                                            <label for="liableId" class="col-md-3 control-label">责任人：</label>

                                            <div class="col-md-9">
                                                <select name="liableId" class="form-control" style="width: auto;">
                                                    <option value="">请选择责任人</option>
                                                    @foreach($users as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach

                                                </select>

                                                @if ($errors->has('liableId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('liableId') }}</strong>
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
                                                <option value="1">停用</option>
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
                @include("common.errors")   </div>
        </div>
    </div>
@endsection
