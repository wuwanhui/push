@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="box box-primary">
            <validator name="validator">
                <input @invalid="telonInvalid" initial="off" detect-change="off" v-model="telphone" id="telphone" type="
                tel" class='phone-number' v-validate:telphone="['tel']"  placeholder='请输入手机号码'>
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
                                               placeholder="不能为空">

                                    </div>
                                    <label for="shortName" class="col-sm-2 control-label">简称：</label>

                                    <div class="col-sm-4">
                                        <input id="shortName" type="text" class="form-control" name="shortName"
                                               v-model="supplier.shortName">

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
            @{{supplier|json}}
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
                    form(true, function () {
                        if (form.invalid) {
                            //验证无效
                            _self.$set('toasttext', '请完善表单');
                            _self.$set('toastshow', true);
                        } else {
                            _self.$set('toasttext', '验证通过');
                            _self.$set('toastshow', true);
                            //验证通过做注册请求
                            /*that.$http.post('http://192.168.30.235:9999/rest/user/register',{'account':telephones,'pwd':pw1,'pwd2':pw2}).then(function(data){
                             if(data.data.code == '0'){
                             that.$set('toasttext','注册成功');
                             that.$set('toastshow',true);
                             }else{
                             that.$set('toasttext','注册失败');
                             that.$set('toastshow',true);
                             }
                             },function(error){
                             //显示返回的错误信息
                             that.$set('toasttext',String(error.status));
                             that.$set('toastshow',true);
                             })*/
                        }
                    });


                    if (form.invalid) {
                        //this.$log('supplier');
                        this.trySubmit = true;
                        return;
                    }

                    this.$http.post("{{url('/manage/supplier/create')}}", this.supplier)
                            .then(function (response) {
                                        if (response.data.code == 0) {
                                            parent.msg('新增成功');
                                            parent.layer.close(frameindex);
                                            parent.vm.init();
                                            return
                                        }
                                        parent.layer.alert(JSON.stringify(response));
                                    }
                            );
                }

            }
        });
    </script>
@endsection
 