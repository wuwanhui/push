<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">

</head>
<body onload='document.loginForm.email.focus();'
      style="background-color: #cccccc;">
<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="modal show " id="LoginForm" aria-labelledby="myModalLabel"
             data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content"
                     style="border-top-width: 5px; border-top-color: #336699; border-top-style: solid;">
                    <div class="modal-header">

                        <h4 class="modal-title">
                            <i class="icon-desktop"></i> {{Base::config("name") }}营销平台
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control input-lg" name="email"
                                       placeholder="电子邮件"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control input-lg" name="password"
                                       required
                                       placeholder="密码">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">记住我
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    忘记密码?
                                </a>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-lg btn-block ">登录</button>

                    </div>

                </div>


            </div>
        </div>
    </form>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
<script type="text/javascript">
    $(".modal").css("padding-top", $(window).height() / 2 - 300 + "px");
</script>

</body>
</html>