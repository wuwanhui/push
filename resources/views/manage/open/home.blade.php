@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">开放平台</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">开放平台</div>

                    <div class="panel-body ">
                        <ul>
                            <li>
                                <a href="{{url('/manage/open/apply')}}">应用管理</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/open/api')}}">接口开放</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/open/ota')}}">OTA对接</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-10">

                @include("common.success")
                @include("common.errors")
            </div>
        </div>
    </div>
@endsection
