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
                    <div class="panel-heading">通讯录</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/directorie')}}" class="active">通讯录</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">通讯录</div>
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
                        <table class="table table-bordered table-hover  table-condensed">
                            <thead>
                            <tr style="text-align: center" class="text-center">
                                <th style="width: 20px"><input type="checkbox"
                                                               name="CheckAll" value="Checkid"/></th>
                                <th style="width: 60px;"><a href="">编号</a></th>
                                <th style="width: 120px;"><a href="">姓名</a></th>
                                <th style="width: 80px;"><a href="">性别</a></th>
                                <th style="width: 120px;"><a href="">手机号</a></th>
                                <th><a href="">QQ</a></th>
                                <th><a href="">电子邮件</a></th>
                                <th style="width: 60px;"><a href="">分享</a></th>
                                <th style="width: 220px;"><a href="">所有者</a></th>
                                <th style="width: 60px;"><a href="">状态</a></th>
                                <th style="width: 80px;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $item)
                                <tr>
                                    <td><input type="checkbox" value="{{$item->id}} "
                                               name="id"/></td>
                                    <td style="text-align: center">{{$item->id}} </td>

                                    <td style="text-align: center">{{$item->name}}</td>
                                    <td style="text-align: center">  @if($item->sex==0)
                                            未知
                                        @elseif($item->sex==1)
                                            先生
                                        @else
                                            女士
                                        @endif</td>
                                    <td><a
                                                href="{{url('/manage/directorie/edit/'.$item->id)}}">{{$item->mobile}}</a>
                                    </td>
                                    <td> {{$item->qq}}
                                    </td>
                                    <td> {{$item->email}}</td>
                                    <td style="text-align: center">
                                        {{$item->share==0?"私有":"分享"}}
                                    </td>
                                    <td style="text-align: center">
                                        {{$item->user->enterprise->name}}
                                        -{{$item->user->name}}
                                    </td>

                                    <td style="text-align: center">
                                        {{$item->state==0?"正常":"禁用"}}
                                    </td>

                                    <td style="text-align: center">
                                        <a
                                                href="{{url('/manage/directorie/detail/'.$item->id)}}">详情</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"><a
                                        href="{{url('/directorie/resources/guide/create/')}}"
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
