<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
        <title>Login | Newspepa</title>
        <link rel="shortcut icon" href="ui_newspaper/img/favicon.ico" />
        <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
        <link rel="stylesheet" href="ui_newspaper/css/app22.css" />
        <link rel="stylesheet" href="ui_newspaper/css/cms.css" />
        <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
        <script src="ui_newspaper/js/vendor/modernizr.js"></script>
    </head>
    <body>

        <div class="fixed">
            <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">
                <ul class="title-area">
                    <a href="{{url('/')}}"><li class="name name-m"></li></a>
                </ul>
            </nav>

        </div>
        <div class="container-fluid-full">
            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="login-box">
                        <h4>Login to your account</h4>
                        <form method="POST" action="/auth/login">
                            {!! csrf_field() !!}

                            <div>
                                Email
                                <input type="email" name="email" value="{{ old('email') }}">
                            </div>

                            <div>
                                Password
                                <input type="password" name="password" id="password">
                            </div>

                            <div>
                                <input type="checkbox" name="remember"> Remember Me
                            </div>

                            <div>
                                <button type="submit">Login</button>
                            </div>
                        </form>
                        <hr />
                        <h5>Forgot Password?</h5>
                        <p>
                            No problem, <a href="#">click here</a> to get a new password.
                        </p>
                    </div>
                </div><!--/row-->

            </div><!--/fluid-row-->

        </div>
    <footer class="row">

    </footer>
    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>

    <script>
        $(document).foundation();

    </script>
    <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-49109646-1', 'auto');
          ga('send', 'pageview');

    </script>

    </body>
</html>
