@extends('layouts.manage')

@section('content')
    <section class="content-header">
        <h1>
            资源应用
            <small>列表</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 资源管理</a></li>
            <li class="active">资源应用</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success" v-on:click="create()">新增</button>
                    </div>
                    <div class="col-md-10 text-right">
                        <form method="get" class="form-inline">
                            <div class="input-group">
                                <select id="type" name="type" class="form-control" style="width: auto;"
                                        v-model="params.state">
                                    <option value="" selected>资源应用状态</option>
                                    <option v-bind:value="0">正常</option>
                                    <option v-bind:value="1">禁用</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="关键字"
                                       name="key" v-model="params.key">
                                <span class="input-group-btn">
								<button class="btn btn-default" type="button" v-on:click="search()">搜索</button>
                                     <button type="button" class="btn btn-default" v-on:click="params={};init();">
                                    重置
                                </button>
							</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <form method="Post" class="form-inline">
                <table class="table table-bordered table-hover  table-condensed">
                    <thead>
                    <tr style="text-align: center" class="text-center">
                        <th style="width: 20px"><input type="checkbox"
                                                       name="CheckAll" value="Checkid"/></th>
                        <th style="width: 80px;"><a href="">编号</a></th>
                        <th><a href="">资源名称</a></th>
                        <th><a href="">资源应用</a></th>
                        <th style="width: 80px;"><a href="">Appkey</a></th>
                        <th style="width: 80px;"><a href="">SecretKey</a></th>
                        <th style="width: 80px;"><a href="">余额</a></th>
                        <th style="width: 60px;"><a href="">状态</a></th>
                        <th style="width: 120px;">操作</th>
                    </tr>
                    </thead>
 
                    <tbody>
                    <tr v-for="item in list.data">
                        <td><input type="checkbox" v-model="ids" v-bind:value="item.id"/></td>
                        <td style="text-align: center" v-text="item.id"></td>
                        <td v-text="item.name"></td>
                        <td style="text-align: center" v-text="item.name"></td>
                        <td style="text-align: center" v-text="item.appkey"></td>
                        <td style="text-align: center" v-text="item.secretKey"></td>
                        <td style="text-align: center" v-text="item.balance"></td>

                        
                        <td style="text-align: center" v-text="item.state==0?'正常':'禁用'">
                        </td>
                        

                        <td style="text-align: center">
                            <a
                                    v-bind:href="'{{url('/manage/supplier/resource/resource?supplier/resourceId=')}}'+item.id"
                                    v-text="'资源('+item.resources_count+')'"></a>
                            |<a
                                    v-on:click="edit(item)">编辑</a>
                            |
                            <a v-on:click="delete(item)">删除</a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </form>
            <div class="box-footer no-padding">
                <div class="mailbox-controls">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"
                                                                                v-on:click="delete(ids)"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"
                                                                                v-on:click="btnBank()"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                        <page v-bind:lists="list"></page>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="application/javascript">
        sidebar.menu = {type: 'supplier', item: 'resource'};
        var vm = new Vue({
            el: '.content',
            data: {
                ids: [],
                params: {page: '', state: ''},
                list: jsonFilter('{{json_encode($list)}}')
            },
            watch: {
                'params.state': function () {
                    //this.init();
                },
                'params.page': function () {
                    //this.init();
                }
            },
            ready: function () {
                //this.init();
            },

            methods: {
                init: function () {
                    var _self = this;
                    this.$http.get("{{url('/manage/supplier/resource?json')}}", {params: this.params})
                        .then(function (response) {
                                if (response.data.code == 0) {
                                    _self.list = response.data.data;
                                    return
                                }
                                layer.alert(JSON.stringify(response.data.data));
                            }
                        );

                },
                search: function () {
                    this.init();
                },
                create: function () {
                    openUrl('{{url('/manage/supplier/resource/create')}}', '新增资源应用', 800, 500);
                },
                edit: function (item) {
                    this.enterprise = item;
                    openUrl('{{url('/manage/supplier/resource/edit')}}?id=' + item.id, '编辑"' + item.name + '"资源应用', 800, 600);
                },
                delete: function (item) {
                    layer.confirm('您确认要删除“' + item.name + '”吗？', {
                        btn: ['确认', '取消']
                    }, function () {
                        layer.msg('的确很重要', {icon: 1});
                    }, function () {
                        layer.msg('也可以这样', {
                            time: 20000, //20s后自动关闭
                            btn: ['明白了', '知道了']
                        });
                    });
                },


            }
        });
    </script>
@endsection
