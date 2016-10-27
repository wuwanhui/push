@extends('layouts.weixin')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">订单列表</div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">
                        <a href="#" class="thumbnail">
                            <img data-src="holder.js/100%x180" alt="...">
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <select id="type" name="type" class="form-control">
                            <option value="1">普通订单（分销商已经收款）</option>
                            <option value="2">预订订单（分销商未收款）</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        产品名称
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        描述
                    </div>
                </div>
            </div>
            <div class="panel-footer">预定</div>
        </div>
    </div>
@endsection
