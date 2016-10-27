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
                                <a href="{{url('/manage/finance/payments')}}" class="active">收支记录</a>
                            </li>


                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/finance/credit')}}">授信管理</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">收支记录</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/finance/payments/create')}}"
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
                                    <th style="width: 100px;"><a href="">科目</a></th>
                                    <th><a href="">资金帐户</a></th>
                                    <th style="width: 100px;"><a href="">金额</a></th>
                                    <th style="width: 100px;"><a href="">类型</a></th>
                                    <th style="width: 100px;"><a href="">来源</a></th>
                                    <th style="width: 100px;"><a href="">责任人</a></th>
                                    <th style="width: 100px;"><a href="">审核状态</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 100px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr title="{{$item->attention}}">
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}}</td>
                                        <td style="text-align: center">{{$item->name}}</td>
                                        <td>
                                            @if($item->account)
                                                {{$item->account->name}}-{{$item->account->bankAccount}}
                                                ({{$item->account->accounts}})
                                            @endif
                                        </td>
                                        <td style="text-align: center"> {{$item->money}}
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->type==0)
                                                收入
                                            @else
                                                支出
                                            @endif </td>
                                        <td style="text-align: center">
                                            @if($item->user)
                                                {{$item->user->name}}
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->liable)
                                                {{$item->liable->name}}
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->reviewed==0)
                                                通过
                                            @elseif($item->reviewed==1)
                                                待审核
                                            @else
                                                拒绝
                                            @endif </td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>
                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/finance/payments/edit/'.$item->id)}}">编辑</a>
                                            |
                                            <a href="{{url('/manage/finance/payments/delete/'.$item->id)}}">删除</a>
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
                                        href="{{url('/manage/finance/payments/delete')}}"
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
