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
                    <div class="panel-heading">{{$resource->name}}-资源详情</div>
                    <div class="panel-body">
                        <div style="line-height: 30px;">
                            <div class="row">
                                <div class="col-md-6">资源名称：{{$resource->name}}</div>
                                <div class="col-md-6">所属供应商：{{$resource->supplier->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">计费字算：{{$resource->words}}</div>
                                <div class="col-md-6">当前余额：{{$resource->balance}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">appkey：{{$resource->appkey}}</div>
                                <div class="col-md-6">secretKey：{{$resource->secretKey}}</div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div style="padding: 10px;">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#signature" role="tab"
                                                                      data-toggle="tab">签名</a>
                            </li>
                            <li role="presentation"><a href="#template" role="tab" data-toggle="tab">模板</a></li>
                        </ul>
                        <br/>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="signature">

                                <table class="table table-bordered table-hover  table-condensed">
                                    <thead>
                                    <tr style="text-align: center" class="text-center">
                                        <th style="width: 20px"><input type="checkbox"
                                                                       name="CheckAll" value="Checkid"/></th>
                                        <th style="width: 60px;"><a href="">编号</a></th>
                                        <th><a href="">签名名称</a></th>
                                        <th><a href="">所属企业</a></th>
                                        <th style="width: 80px;"><a href="">签名编号</a></th>
                                        <th style="width: 60px;"><a href="">状态</a></th>
                                        <th style="width: 120px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($resource->signatures as $item)
                                        <tr>
                                            <td><input type="checkbox" value="{{$item->id}} "
                                                       name="id"/></td>
                                            <td style="text-align: center">{{$item->id}} </td>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>{{$item->enterprise->name}}</td>

                                            <td style="text-align: center"> {{$item->number}}
                                            </td>

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
                                    <tfoot>
                                    <tr>
                                        <td colspan="100">
                                            <div class="row" style="padding: 10px;">
                                                <div class="col-md-4"><a
                                                            href="{{url('/manage/supplier/resource/signature/create/'.$resource->id)}}"
                                                            class="btn btn-primary">新增</a></div>
                                                <div class="col-md-8 text-right">

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="template">
                                <div class="row">
                                    <div class="col-md-4"><a
                                                href="{{url('/manage/supplier/resource/create/'.request('id'))}}"
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
                                                       name="key" value="{{request('key')}}"> <span
                                                        class="input-group-btn">
								<button class="btn btn-default" type="submit">搜索</button>
							</span>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover  table-condensed">
                                    <thead>
                                    <tr style="text-align: center" class="text-center">
                                        <th style="width: 20px"><input type="checkbox"
                                                                       name="CheckAll" value="Checkid"/></th>
                                        <th style="width: 60px;"><a href="">编号</a></th>
                                        <th><a href="">资源名称</a></th>
                                        <th><a href="">供应商</a></th>
                                        <th style="width: 80px;"><a href="">计费字算</a></th>
                                        <th style="width: 80px;"><a href="">Appkey</a></th>
                                        <th style="width: 80px;"><a href="">SecretKey</a></th>
                                        <th style="width: 80px;"><a href="">余额</a></th>
                                        <th style="width: 60px;"><a href="">状态</a></th>
                                        <th style="width: 120px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($resource->templates as $item)
                                        <tr >
                                            <td><input type="checkbox" value="{{$item->id}} "
                                                       name="id"/></td>
                                            <td style="text-align: center">{{$item->id}} </td>
                                            <td>
                                                <a href="{{url('/manage/supplier/resource/detail/'.$item->id)}}">{{$item->name}}</a>
                                            </td>
                                            <td>{{$item->supplier->name}}</td>

                                            <td style="text-align: center"> {{$item->words}}
                                            </td>
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
                            </div>
                        </div>

                    </div>
                </div>

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
