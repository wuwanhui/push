@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="box box-primary">
            <validator name="validator">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST" novalidate>

                    <div class="box-body">
                        <div class="col-xs-12">

                            <fieldset>
                                <legend>基本信息</legend>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">全称：</label>
                                    <div class="col-sm-4">
                                        <input id="name" type="text" class="form-control" name="name"
                                               v-model="supplier.name"
                                               :class="{ 'error': $validator.name.invalid && trySubmit }"
                                               v-validate:name="{ required: true}"    placeholder="不能为空">

                                    </div>
                                    <label for="shortName" class="col-sm-2 control-label">简称：</label>

                                    <div class="col-sm-4">
                                        <input id="shortName" type="text" class="form-control" name="shortName"
                                               :class="{ 'error': $validator.name.invalid && trySubmit }"
                                               v-validate:name="{ required: true}"   v-model="supplier.shortName">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="linkMan" class="col-sm-2 control-label">联系人：</label>
                                    <div class="col-sm-4">
                                        <input id="linkMan" name="linkMan" type="text" class="form-control "
                                               v-model="supplier.linkMan"
                                        >
                                    </div>
                                    <label for="mobile" class="col-sm-2 control-label">手机号：</label>
                                    <div class="col-sm-4">
                                        <input id="mobile" name="mobile" type="text" class="form-control "
                                               v-model="supplier.mobile">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tel" class="col-sm-2 control-label">电话：</label>
                                    <div class="col-sm-4">
                                        <input id="tel" name="tel" type="text" class="form-control "
                                               v-model="supplier.tel"
                                        >
                                    </div>
                                    <label for="fax" class="col-sm-2 control-label">传真：</label>
                                    <div class="col-sm-4">
                                        <input id="fax" name="fax" type="text" class="form-control "
                                               v-model="supplier.fax">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qq" class="col-sm-2 control-label">QQ：</label>
                                    <div class="col-sm-4">
                                        <input id="qq" name="qq" type="text" class="form-control "
                                               v-model="supplier.qq"
                                        >
                                    </div>
                                    <label for="email" class="col-sm-2 control-label">邮箱：</label>
                                    <div class="col-sm-4">
                                        <input id="email" name="email" type="text" class="form-control "
                                               v-model="supplier.email">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addres" class="col-sm-2 control-label">联系地址：</label>

                                    <div class="col-sm-10">
                                        <input id="addres" name="addres" type="text" class="form-control "
                                               v-model="supplier.addres">

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="remark" class="col-sm-2 control-label">内部备注：</label>

                                    <div class="col-sm-10">
                                            <textarea id="remark" type="text" class="form-control"
                                                      style="width: 100%;height:50px;"
                                                      v-model="supplier.remark"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-xs-12  text-center">
                                <button type="button" class="btn btn-default" onclick="parent.layer.close(frameindex)">
                                    关闭
                                </button>
                                <button type="button" class="btn  btn-primary" v-on:click="save($validate)">保存
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
            </validator>
        </div>
    </section>
@endsection
@section('script')
    <script type="application/javascript">
        var frameindex = parent.layer.getFrameIndex(window.name);
        parent.layer.iframeAuto(frameindex);
        var vm = new Vue({
            el: '.content',
            data: {
                trySubmit: false,
                supplier: {}
            },
            watch: {},
            ready: function () {

            },

            methods: {

                save: function (form) {
                    var _self = this;

                    if (form.invalid) {
                        //this.$log('supplier');
                        this.trySubmit = true;
                        return;
                    }

                    this.$http.post("{{url('/manage/supplier/create')}}", this.supplier)
                            .then(function (response) {
                                        if (response.data.code == 0) {
                                            msg('新增成功');
                                            parent.layer.close(frameindex);
                                            parent.vm.init();
                                            return;
                                        }
                                        parent.layer.alert(JSON.stringify(response));
                                    }
                            );
                }

            }
        });
    </script>
@endsection
 