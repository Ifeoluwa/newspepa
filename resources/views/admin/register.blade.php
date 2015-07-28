<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
        <title>Register New User | Newspepa</title>
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
                        <h4>Register New User</h4>
                        <form method="POST" action="/auth/register">
                            {!! csrf_field() !!}

                            <div>
                                First Name
                                <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                            </div>
                            <div>
                                Last Name
                                <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                            </div>

                            <div>
                                Email
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div>
                                Password
                                <input type="password" name="password" required>
                            </div>

                            <div>
                                Confirm Password
                                <input type="password" name="password_confirmation" required>
                            </div>

                            <div>
                                <button type="submit">Register</button>
                            </div>
                        </form>

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
