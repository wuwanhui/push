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
                                <a href="{{url('/manage/finance/payments')}}">收支记录</a>
                            </li>
                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/credit')}}" class="active">授信管理</a>
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
                                    @if($users )
                                        <div class="form-group{{ $errors->has('userId') ? ' has-error' : '' }}">
                                            <label for="userId" class="col-md-3 control-label">被授信者：</label>

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


                                    <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
                                        <label for="credit" class="col-md-3 control-label">授信金额：</label>

                                        <div class="col-md-9">
                                            <input id="credit" type="text" class="form-control" name="credit"
                                                   style="width: auto;"
                                                   value="{{ old('credit') }}">

                                            @if ($errors->has('credit'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('credit') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('beginDate') ? ' has-error' : '' }}">
                                        <label for="beginDate" class="col-md-3 control-label">开始日期：</label>

                                        <div class="col-md-9">
                                            <input id="beginDate" type="text" class="form-control" name="beginDate"
                                                   style="width: auto;"
                                                   value="{{ old('beginDate') }}">

                                            @if ($errors->has('beginDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('beginDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                                        <label for="endDate" class="col-md-3 control-label">结束日期：</label>

                                        <div class="col-md-9">
                                            <input id="endDate" type="text" class="form-control" name="endDate"
                                                   style="width: auto;"
                                                   value="{{ old('endDate') }}">

                                            @if ($errors->has('endDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('endDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

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
