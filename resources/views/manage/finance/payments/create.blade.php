@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
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
                                <a href="{{url('/manage/finance/account')}}">帐户设置</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/finance/payments')}}" class="active">收支记录</a>
                            </li>


                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/credit')}}">授信管理</a>
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
                                        <label for="name" class="col-md-3 control-label">科目：</label>

                                        <div class="col-md-9">
                                            <select id="name" name="name" class="form-control" style="width: auto;">
                                                <option value="分销商充值">分销商充值</option>
                                                <option value="会员充值">会员充值</option>
                                                <option value="供应商提现">供应商提现</option>
                                                <option value="分销商佣金">分销商佣金</option>
                                            </select>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($accounts)
                                        <div class="form-group{{ $errors->has('accountId') ? ' has-error' : '' }}">
                                            <label for="accountId" class="col-md-3 control-label">资金帐户：</label>
                                            <div class="col-md-9">
                                                <select id="accountId" name="accountId" class="form-control"
                                                        style="width: auto;">
                                                    @foreach($accounts as $item)
                                                        <option value="{{$item->id}}">{{$item->bankAccount}}
                                                            -{{$item->name}}({{$item->accounts}})
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('accountId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('accountId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('money') ? ' has-error' : '' }}">
                                        <label for="money" class="col-md-3 control-label">金额：</label>

                                        <div class="col-md-9">
                                            <input id="money" type="text" class="form-control auto" name="money"
                                                   value="{{ old('money') }}">

                                            @if ($errors->has('money'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('money') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label for="type" class="col-md-3 control-label">类型：</label>

                                        <div class="col-md-9">
                                            <select id="type" name="type" class="form-control" style="width: auto;">
                                                <option value="0">收入</option>
                                                <option value="1">支出</option>
                                            </select>

                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($users)
                                        <div class="form-group{{ $errors->has('userId') ? ' has-error' : '' }}">
                                            <label for="userId" class="col-md-3 control-label">来源用户：</label>
                                            <div class="col-md-9">
                                                <select id="userId" name="userId" class="form-control"
                                                        style="width: auto;">
                                                    @foreach($users as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('userId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('userId') }}</strong>
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
                                        <label for="remark" class="col-md-3 control-label">备注：</label>

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
