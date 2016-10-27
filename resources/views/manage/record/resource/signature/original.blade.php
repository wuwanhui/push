@extends('layouts.manage')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">微利分销</a></li>
            <li><a href="#">管理中心</a></li>
            <li class="active">资源供应</li>
        </ol>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">资源供应</div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier')}}">供应商</a>
                            </li>
                            <li>
                                <a href="{{url('/manage/supplier/resource')}}" class="active">产品资源</a>
                            </li>

                        </ul>
                        <hr/>
                        <ul>
                            <li>
                                <a href="{{url('/manage/supplier/scenic')}}">景区配置</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-2  text-left">
                                    <button type="button" class="btn btn-default"
                                            onclick="vbscript:window.history.back()">返回
                                    </button>
                                    <button type="submit" class="btn  btn-primary">保存</button>

                                </div>
                                <div class="col-xs-10 text-right"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>基本信息</legend>
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="productId" value="{{ $produits->productId }}"/>
                                    <input type="hidden" name="supplierId" value="{{ $produits->supplierId }}"/>
                                    @if($scenics)
                                        <div class="form-group{{ $errors->has('scenicId') ? ' has-error' : '' }}">
                                            <label for="scenicId" class="col-md-3 control-label">所属景区：</label>

                                            <div class="col-md-9">
                                                <select name="scenicId" class="form-control" style="width: auto;">
                                                    <option value="">不关联</option>
                                                    @foreach($scenics as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('scenicId'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('scenicId') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">价格项名称：</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ $produits->name }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('attention') ? ' has-error' : '' }}">
                                        <label for="attention" class="col-md-3 control-label">注意事项：</label>

                                        <div class="col-md-9">

                                            <textarea id="attention" type="text" class="form-control"
                                                      name="attention"
                                                      style=" height: 100px"
                                            >{{$produits->attention }}</textarea>

                                            @if ($errors->has('attention'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('attention') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('refundable') ? ' has-error' : '' }}">
                                        <label for="refundable" class="col-md-3 control-label">改退规则：</label>

                                        <div class="col-md-9">

                                            <textarea id="refundable" type="text" class="form-control"
                                                      name="refundable"
                                                      style=" height: 100px"
                                            >{{$produits->refundable }}</textarea>

                                            @if ($errors->has('refundable'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('refundable') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('parprice') ? ' has-error' : '' }}">
                                        <label for="parprice" class="col-md-3 control-label">票面价格：</label>

                                        <div class="col-md-9">
                                            <input id="parprice" type="text" class="form-control" name="parprice"
                                                   style="width:auto;"
                                                   value="{{ $produits->parprice }}">

                                            @if ($errors->has('parprice'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('parprice') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label for="price" class="col-md-3 control-label">成本价格：</label>

                                        <div class="col-md-9">
                                            <input id="price" type="text" class="form-control" name="price"
                                                   style="width:auto;"
                                                   value="{{ $produits->price }}">

                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('fixedPrice') ? ' has-error' : '' }}">
                                        <label for="fixedPrice" class="col-md-3 control-label">市场限价：</label>

                                        <div class="col-md-9">
                                            <input id="fixedPrice" type="text" class="form-control" name="fixedPrice"
                                                   style="width:auto;"
                                                   value="{{ $produits->fixedPrice }}">

                                            @if ($errors->has('fixedPrice'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('fixedPrice') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('payType') ? ' has-error' : '' }}">
                                        <label for="payType" class="col-md-3 control-label">支持到付：</label>

                                        <div class="col-md-9">
                                            <select id="payType" name="payType" class="form-control"
                                                    style="width: auto;">
                                                <option value="0">支持</option>
                                                <option value="1">不支持</option>
                                            </select>

                                            @if ($errors->has('payType'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('payType') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('beginDate') ? ' has-error' : '' }}">
                                        <label for="beginDate" class="col-md-3 control-label">开始日期：</label>

                                        <div class="col-md-9">
                                            <input id="beginDate" type="text" class="form-control" name="beginDate"
                                                   style="width:auto;"
                                                   value="{{ $produits->beginDate }}">

                                            @if ($errors->has('beginDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('beginDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                                        <label for="endDate" class="col-md-3 control-label">结束日期：</label>

                                        <div class="col-md-9">
                                            <input id="endDate" type="text" class="form-control" name="endDate"
                                                   style="width:auto;"
                                                   value="{{ $produits->endDate }}">

                                            @if ($errors->has('endDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('endDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                                        <label for="stock" class="col-md-3 control-label">库存数量：</label>

                                        <div class="col-md-9">
                                            <input id="stock" type="text" class="form-control" name="stock"
                                                   style="width:auto;"
                                                   value="{{ $produits->stock }}">

                                            @if ($errors->has('stock'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('singleNum') ? ' has-error' : '' }}">
                                        <label for="singleNum" class="col-md-3 control-label">限购数量：</label>

                                        <div class="col-md-9">
                                            <input id="singleNum" type="text" class="form-control"
                                                   style="width:auto;"
                                                   name="singleNum"
                                                   placeholder="单人限购数量"
                                                   value="{{ $produits->singleNum }}" required autofocus>

                                            @if ($errors->has('singleNum'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('singleNum') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('bankTime') ? ' has-error' : '' }}">
                                        <label for="bankTime" class="col-md-3 control-label">退票时限：</label>

                                        <div class="col-md-9">
                                            <input id="bankTime" type="text" class="form-control" name="bankTime"
                                                   style="width:auto;"
                                                   value="{{$produits->bankTime }}">

                                            @if ($errors->has('bankTime'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('bankTime') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-3 control-label">状态：</label>

                                        <div class="col-md-9">
                                            <select id="state" name="state" class="form-control" style="width: auto;">
                                                <option value="0">在售</option>
                                                <option value="1">下架</option>
                                            </select>

                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('remark') ? ' has-error' : '' }}">
                                        <label for="remark" class="col-md-3 control-label">内部备注：</label>

                                        <div class="col-md-9">

                                            <textarea id="remark" type="text" class="form-control"
                                                      name="remark"
                                                      style=" height: 100px"
                                            >{{old('refundable') }}</textarea>

                                            @if ($errors->has('remark'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('remark') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                @include("common.success")
                @include("common.errors")   </div>
        </div>
    </div>
@endsection
