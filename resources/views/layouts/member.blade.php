<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '易游天下') }}</title>
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/js/AdminLTE/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/js/AdminLTE/css/skins/_all-skins.min.css">
    <link href="/css/common.css" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="/js/app.js"></script>
    <script src="/js/layer/layer.js"></script>
    {{--<!-- AdminLTE App -->--}}
    <script src="/js/AdminLTE/js/app.min.js"></script>
    <script src="/js/common.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" id="app">
    <!-- 头部信息 -->
    <header class="main-header">
        <!-- 标志 -->
        <a href="/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">PUSH</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>易讯通</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- 左侧菜单切换按键-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">公告通知</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that
                                            may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">查看全部</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">任务提醒</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                     role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Create a nice theme
                                                <small class="pull-right">40%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%"
                                                     role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Some task I need to do
                                                <small class="pull-right">60%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-red" style="width: 60%"
                                                     role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Make beautiful transitions
                                                <small class="pull-right">80%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                     role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- 用户信息 -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/js/AdminLTE/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::guard('member')->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/js/AdminLTE/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::guard('member')->user()->name}}
                                    <small>{{Auth::guard('member')->user()->email}}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">用户信息</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" v-on:click="logout()">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </nav>
    </header>
    <!-- 左侧菜单 -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel hide">
                <div class="pull-left image">
                    <img src="/js/AdminLTE/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::guard('member')->user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">业务操作角色</li>



                <li   class="treeview"><a
                            href="{{ url('/member/enterprise') }}"><i class="fa fa-circle-o"></i>企业信息</a>
                </li>
                <li   class="treeview">
                    <a>
                        <i class="fa fa-dashboard"></i> <span>信息推送</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a
                                    href="{{ url('/member/record') }}"><i class="fa fa-circle-o"></i>信息推送</a></li>
                        <li>
                            <a href="{{url('/member/record/batch')}}" class="active"><i class="fa fa-circle-o"></i>发送记录</a>
                        </li>
                        <li>
                            <a href="{{url('/member/record/receive')}}"><i class="fa fa-circle-o"></i>回执报告</a>
                        </li>
                        <li>
                            <a href="{{url('/member/record/template')}}"><i class="fa fa-circle-o"></i>发送模板</a>
                        </li>
                    </ul>
                </li>
                <li   class="treeview"><a
                            href="{{ url('/member/directorie') }}"><i class="fa fa-circle-o"></i>通讯录</a></li>
                <li  class="treeview" ><a
                            href="{{ url('/member/report') }}"><i class="fa fa-circle-o"></i>报表分析</a></li>
                <li   class="treeview"><a href="{{ url('/member/open') }}"><i class="fa fa-circle-o"></i>开放平台</a>
                </li>
                <li  class="treeview" ><a
                            href="{{ url('/member/finance') }}"><i class="fa fa-circle-o"></i>财务结算</a></li>
            </ul>
        </section>
    </aside>

    <!-- 内容区-->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.内容区 -->
    <!-- 页脚-->
    <footer class="main-footer hide">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>易游通 Copyright &copy; 2016-2019 <a href="http://www.4255.cn">4255.cn</a>.</strong>
        reserved.
    </footer>
    <div class="control-sidebar-bg"></div>

</div>

<script type="application/javascript">
    var header = new Vue({
        el: '.main-header',
        data: {},
        watch: {},

        methods: {
            logout: function () {
                var _self = this;
                //加载数据
                $.ajax({
                    type: 'POST',
                    url: "{{url('/member/logout')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (_obj) {
                        layer.msg("欢迎再次光临！");
                        window.location.href = "/member/login";
                    }
                });
            }
        }
    });

    var sidebar = new Vue({
        el: '.main-sidebar',
        data: {menu: {type: 'system'}},
        watch: {},

        methods: {}
    });

</script>
@yield('script')
</body>
</html>