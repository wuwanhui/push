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
                                <a href="{{url('/manage/distribution')}}">分销商管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/distribution/sales')}}" class="active">产品授权</a>
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
                                    @if($distributions )
                                        <div class="form-group{{ $errors->has('distributionId') ? ' has-error' : '' }}">
                                            <label for="distributionId" class="col-md-3 control-label">分销商：</label>

                                            <div class="col-md-9">
                                                <select name="distributionId" class="form-control" style="width: auto;">
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

                                    @if($produits)
                                        <div class="form-group{{ $errors->has('produitsId') ? ' has-error' : '' }}">
                                            <label for="produitsId" class="col-md-3 control-label">授权产品：</label>

                                            <div class="col-md-9">
                                                <select id="produitsId" name="produitsId" class="form-control"
                                                        style="width: auto;">
                                                    @foreach($produits as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('produitsId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('produitsId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

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

                                    @if($users)
                                        <div class="form-group{{ $errors->has('liableId') ? ' has-error' : '' }}">
                                            <label for="liableId" class="col-md-3 control-label">授权人：</label>

                                            <div class="col-md-9">
                                                <select name="liableId" class="form-control" style="width: auto;">
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
