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
                                <a href="{{url('/manage/record')}}">推送记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/record/receive')}}" class="active">回执报告</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/record/template')}}">发送模板</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">回执报告</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/record/receive/update')}}"
                                                     class="btn btn-primary">同步</a></div>
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
                        <div class="table-responsive">
                            <table class="table  table-hover table-bordered table-condensed">
                                <thead>
                                <tr style="text-align: center" class="text-center">
                                    <th style="width: 20px"><input type="checkbox"
                                                                   name="CheckAll" value="Checkid"/></th>
                                    <th style="width: 60px;"><a href="">编号</a></th>
                                    <th><a href="">手机号</a></th>
                                    <th><a href="">批号</a></th>
                                    <th style="width: 160px;"><a href="">发送时间</a></th>
                                    <th style="width: 160px;"><a href="">接收时间</a></th>
                                    <th style="width: 60px;"><a href="">耗时</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr @if($item->state==1) class="warning" @endif >
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td>
                                            <a href="{{url('/manage/record/receive?mobile='.$item->mobile)}}">{{$item->mobile}}</a>
                                        </td>
                                        <td>
                                            <a href="{{url('/manage/record/receive?bizId='.$item->bizId)}}">{{$item->bizId}}</a>
                                        </td>
                                        <td>{{$item->sendTime}}</td>

                                        <td> {{$item->reptTime}}
                                        </td>
                                        <td style="text-align: center"> {{floor((strtotime($item->reptTime)-strtotime($item->sendTime))%86400%60)}}
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->state==0)
                                                成功
                                            @else
                                                失败
                                            @endif </td>

                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/record/detail/'.$item->id)}}">详情</a>
                                            | <a
                                                    href="{{url('/manage/record/retry/'.$item->id)}}">重发</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"><a
                                        href="{{url('/record/resources/guide/create/')}}"
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
