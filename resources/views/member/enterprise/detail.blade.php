@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">推送平台</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">企业管理</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">企业管理</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/member/enterprise')}}" class="active">企业管理</a>
                            </li>
                            @if(Base::user("type")==2)
                                <li>
                                    <a href="{{url('/member/enterprise/user')}}">用户管理</a>
                                </li>
                            @endif
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

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">全称：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->name}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">简称：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->abbreviation}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">联系人：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->linkMan}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">手机号：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->mobile}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">电话：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->tel}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">传真：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->fax}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">QQ：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->qq}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">电子邮件：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->email}}</p>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">地址：</label>

                                        <div class="col-md-9">
                                            <p class="form-control-static">{{$enterprise->addres}}</p>
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
@endsection
