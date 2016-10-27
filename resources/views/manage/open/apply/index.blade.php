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
                                <a href="{{url('/manage/open/apply')}}" class="active">应用管理</a>
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
                <div class="panel panel-info">
                    <div class="panel-heading">应用中心</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/open/apply/create')}}"
                                                     class="btn btn-primary">新增</a></div>
                            <div class="col-md-8 text-right">
                                <form method="get" class="form-inline">
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="关键字"
                                               name="key" value=""> <span class="input-group-btn">
								<button class="btn btn-default" type="submit">搜索</button>
							</span>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form method="Post" class="form-inline">
                        <fieldset>
                            <table class="table table-bordered table-hover  table-condensed">
                                <thead>
                                <tr style="text-align: center" class="text-center">
                                    <th style="width: 20px"><input type="checkbox"
                                                                   name="CheckAll" value="Checkid"/></th>
                                    <th style="width: 60px;"><a href="">编号</a></th>
                                    <th><a href="">所属用户</a></th>
                                    <th><a href="">应用名称</a></th>
                                    <th style="width: 100px;"><a href="">appId</a></th>
                                    <th style="width: 100px;"><a href="">appSecret</a></th>
                                    <th style="width: 120px;"><a href="">授信IP</a></th>
                                    <th style="width: 160px;"><a href="">回调地址</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 120px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr title="{{$item->attention}}">
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td>{{$item->user->name}}</td>
                                        <td style="text-align: center">{{$item->name}}</td>
                                        <td> {{$item->appId}}
                                        </td>
                                        <td> {{$item->appSecret}}</td>
                                        <td style="text-align: center"> {{$item->ip}}</td>
                                        <td> {{$item->callback}}</td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>
                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/open/apply/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a href="{{url('/manage/open/apply/delete/'.$item->id)}}">删除</a> |
                                            <a href="{{url('/manage/open/apply/test/'.$item->id)}}">测试</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                    </form>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"><a
                                        href="{{url('/manage/apply/delete')}}"
                                        class="btn btn-primary">批量删除</a></div>
                            <div class="col-md-8 text-right">
                                {!! $lists->links() !!}
                            </div>
                        </div>

                    </div>
                </div>
                @include("common.success")
                @include("common.errors")
            </div>
        </div>
    </div>
@endsection
