<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/common.js"></script>
</head>
<body>
<div id="app">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">管理后台</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(isset(Base::member()->enterprise))
                        {{Base::member()->enterprise->shortName}}
                    @endif

                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li @if($_model=='member/enterprise') class="active" @endif><a
                                href="{{ url('/member/enterprise') }}">企业信息</a>
                    </li>
                    <li @if($_model=='member/record') class="active" @endif><a
                                href="{{ url('/member/record') }}">信息推送</a>
                    </li>
                    <li @if($_model=='member/directorie') class="active" @endif><a
                                href="{{ url('/member/directorie') }}">通讯录</a></li>
                    <li @if($_model=='member/report') class="active" @endif><a
                                href="{{ url('/member/report') }}">报表分析</a></li>
                    <li @if($_model=='member/open') class="active" @endif><a href="{{ url('/member/open') }}">开放平台</a>
                    </li>
                    <li @if($_model=='member/finance') class="active" @endif><a
                                href="{{ url('/member/finance') }}">财务结算</a></li>
                    <li @if($_model=='member/system') class="active" @endif><a
                                href="{{ url('/member/system') }}">系统配置</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guard("member")->guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">

                                @if(Base::member()->enterprise)
                                    {{ Base::member()->enterprise->shortName }}-@endif{{ Base::member("name") }}
                                （ @if(Base::member("type")==0)
                                    管理员
                                @else(Base::member()->type==1)
                                    普通用户

                                @endif）余额：{{Base::member()->balanceMoney}}
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/auth/member/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">退出
                                    </a>

                                    <form id="logout-form" action="{{ url('/auth/member/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <hr/>
                @if(isset(Base::member()->enterprise))
                    {{Base::member()->enterprise->name}}
                @endif
                @2010-2016

            </div>

        </div>
    </div>
</div>


</body>
</html>
