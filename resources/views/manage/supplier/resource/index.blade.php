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
                <div class="panel panel-info">
                    <div class="panel-heading">产品资源</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><a href="{{url('/manage/supplier/resource/create/'.request('id'))}}"
                                                     class="btn btn-primary">新增</a>{{request('id')}}</div>
                            <div class="col-md-8 text-right">
                                <form method="get" class="form-inline">
                                    <div class="input-group">
                                        <select id="supplierId" name="supplierId" class="form-control"
                                                style="width: auto;">
                                            <option value="">供应商</option>
                                        </select></div>
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="关键字"
                                               name="key" value="{{request('key')}}"> <span class="input-group-btn">
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
                                    <th><a href="">资源名称</a></th>
                                    <th><a href="">供应商</a></th>
                                    <th style="width: 80px;"><a href="">Appkey</a></th>
                                    <th style="width: 80px;"><a href="">SecretKey</a></th>
                                    <th style="width: 80px;"><a href="">余额</a></th>
                                    <th style="width: 60px;"><a href="">状态</a></th>
                                    <th style="width: 120px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $item)
                                    <tr>
                                        <td><input type="checkbox" value="{{$item->id}} "
                                                   name="id"/></td>
                                        <td style="text-align: center">{{$item->id}} </td>
                                        <td>
                                            <a href="{{url('/manage/supplier/resource/detail/'.$item->id)}}">{{$item->name}}</a>
                                        </td>
                                        <td>{{$item->supplier->name}}</td>

                                        <td style="text-align: center"> {{$item->appkey}}</td>
                                        <td style="text-align: center"> {{$item->secretKey}}</td>
                                        <td style="text-align: center"> {{$item->balance}}</td>
                                        <td style="text-align: center">
                                            {{$item->state==0?"正常":"禁用"}}</td>

                                        <td style="text-align: center"><a
                                                    href="{{url('/manage/supplier/resource/edit/'.$item->id)}}">编辑</a>
                                            | <a
                                                    href="{{url('/manage/supplier/resource/delete/'.$item->id)}}">删除</a>
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
                                        href="{{url('/supplier/resources/guide/create/')}}"
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

    <script type="application/javascript">
        $(function () {
            var supplierList = null;

            $("#supplierId").click(function () {
                var supplierId = $(this);
                if (supplierList) {
                    return;
                }
                supplierId.empty();
                supplierId.append("<option value=''>加载中...</option>");
                $.ajax({
                    url: "{{url('/manage/supplier/resource/supplier')}}",
                    type: "post",
                    dataType: "json",
                    timeout: 30000,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        supplierList = data;


                        if (data.length > 0) {
                            supplierId.empty();
                            supplierId.append("<option value=''>选择供应商</option>");
                            for (i = 0; i < data.length; i++) {
                                supplierId.append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                            }
                        } else {
                            supplierId.append("<option value=''>未找到记录</option>");
                        }
                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                    }
                });
            });

            var scenicList = null;
            $("#scenicId").click(function () {
                var scenicId = $(this);
                if (scenicList) {
                    return;
                }
                scenicId.empty();
                scenicId.append("<option value=''>加载中...</option>");
                $.ajax({
                    url: "{{url('/manage/supplier/resource/scenic')}}",
                    type: "post",
                    dataType: "json",
                    timeout: 30000,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        scenicList = data;


                        if (data.length > 0) {
                            scenicId.empty();
                            scenicId.append("<option value=''>选择景区</option>");
                            for (i = 0; i < data.length; i++) {
                                scenicId.append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                            }
                        } else {
                            scenicId.append("<option value=''>未找到记录</option>");
                        }
                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("XHR=" + XHR + "\ntextStatus=" + textStatus + "\nerrorThrown=" + errorThrown);
                    }
                });
            });
        })
    </script>
@endsection
