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
                                <a href="{{url('/manage/record/create')}}">信息推送</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/record')}}" class="active">发送记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/record/receive')}}">回执报告</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">发送详情</div>
                    <div class="panel-body">
                        <div style="line-height: 30px;">
                            <div class="row">
                                <div class="col-md-4">发送者：{{$record->user->name}}</div>
                                <div class="col-md-4">签名：{{$record->signature->name}}</div>
                                <div class="col-md-4">模板：{{$record->template->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">手机号：{{$record->mobile}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">内容：{{$record->content}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">短信参数：{{$record->param}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">计费数量：{{$record->charging}}</div>
                                <div class="col-md-6">发送来源：{{$record->source}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">发送时间：{{$record->sendTime}}</div>
                                <div class="col-md-6">回执时间：{{$record->receiptTime}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">发送日志：{{$record->sendLog}}</div>
                                <div class="col-md-6">成功标识：{{$record->bizId}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">回执报告：{{$record->receiptLog}}</div>

                            </div>

                        </div>
                    </div>

                    @include("common.success")
                    @include("common.errors")
                </div>
            </div>
        </div>
    </div>
@endsection
