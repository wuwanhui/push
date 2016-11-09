@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">

            <li><a href="#">管理中心</a></li>
            <li class="active">资源管理</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">资源管理</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier')}}">供应商</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/supplier/resource')}}" class="active">产品资源</a>
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
                                    <input type="hidden" id="resourceId" name="resourceId"
                                           value="{{$template->resourceId}}">

                                    @if($enterprises )
                                        <div class="form-group{{ $errors->has('enterpriseId') ? ' has-error' : '' }}">
                                            <label for="enterpriseId" class="col-md-3 control-label">企业绑定：</label>

                                            <div class="col-md-9">
                                                <select name="enterpriseId" class="form-control" style="width: auto;">
                                                    <option value="0">公共模板</option>
                                                    @foreach($enterprises as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('enterpriseId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('enterpriseId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label for="type" class="col-md-3 control-label">类型：</label>

                                        <div class="col-md-9">
                                            <select id="type" name="type" class="form-control" style="width: auto;">
                                                <option value="0">验证码</option>
                                                <option value="1">通知</option>
                                                <option value="2">营销</option>
                                            </select>

                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">模板名称：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ $template->name }}" autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                                        <label for="number" class="col-md-3 control-label">模板编号：</label>

                                        <div class="col-md-9">
                                            <input id="number" type="text" class="form-control" name="number"
                                                   value="{{ $template->number }}" autofocus>

                                            @if ($errors->has('number'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('words') ? ' has-error' : '' }}">
                                        <label for="words" class="col-md-3 control-label">计费字数：</label>

                                        <div class="col-md-9">
                                            <input id="words" type="text" class="form-control" name="words"
                                                   style="width:auto;"
                                                   value="{{ $template->words }}">

                                            @if ($errors->has('words'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('words') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label for="content" class="col-md-3 control-label">模板内容：</label>

                                        <div class="col-md-9">

                                            <textarea id="content" type="text" class="form-control"
                                                      name="content"
                                                      style=" height: 100px"
                                            >{{ $template->content }}</textarea>

                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('param') ? ' has-error' : '' }}">
                                        <label for="param" class="col-md-3 control-label">模板参数：</label>

                                        <div class="col-md-9">

                                            <textarea id="param" type="text" class="form-control"
                                                      name="param"
                                                      style=" height: 100px"
                                            >{{$template->param }}</textarea>

                                            @if ($errors->has('param'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('param') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control" style="width: auto;">
                                                <option value="0">启用</option>
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
                                            >{{$template->remark }}</textarea>

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
