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
                                <a href="{{url('/manage/record')}}" class="active">推送记录</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/record/receive')}}">回执报告</a>
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
                    <div class="panel-heading">发送记录</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"></div>
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
                                    <th style="width: 220px;"><a href="">发送者</a></th>
                                    <th style="width: 160px;"><a href="">签名</a></th>
                                    <th style="width: 140px;"><a href="">模板</a></th>
                                    <th style="width: 100px;"><a href="">手机号</a></th>
                                    <th><a href="">内容</a></th>
                                    <th style="width: 60px;"><a href="">计费</a></th>
                                    <th style="width: 80px;"><a href="">来源</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr @if($item->state==2) class="warning" @endif >
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td style="text-align: center"> {{$item->member->enterprise->name}}
                                            -{{$item->member->name}}
                                        </td>
                                        <td style="text-align: center">{{$item->signature->name}}</td>
                                        <td style="text-align: center">{{$item->template->name}}</td>

                                        <td>
                                            <a href="{{url('/manage/record/receive?mobile='.$item->mobile)}}">{{$item->mobile}}</a>
                                        </td>
                                        <td> {{$item->content}}</td>
                                        <td style="text-align: center"> {{$item->charging}}</td>
                                        <td style="text-align: center">     {{$item->source==0?"平台":"接口"}}</td>
                                        <td style="text-align: center">
                                            @if($item->state==0)
                                                成功
                                            @elseif($item->state==1)
                                                已提交
                                            @else
                                                失败
                                            @endif </td>

                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/record/receive?bizId='.$item->bizId)}}">回执-{{count($item->receives)}} </a>
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
