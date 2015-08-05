<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login | Newspepa</title>

    <!-- Bootstrap CSS -->
    <link href="newspepa_cms/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="newspepa_cms/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="newspepa_cms/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="newspepa_cms/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="newspepa_cms/css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="newspepa_cms/js/html5shiv.js"></script>
    <script src="newspepa_cms/js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">
     @include('admin.partials.errors')

      <form class="login-form" method="POST" action="{{ url('/auth/login') }}">
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            {!! csrf_field() !!}
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input name="username" type="text" class="form-control" placeholder="Username" autofocus value="{{ old('username') }}">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <button class="btn btn-info btn-lg btn-block" type="button">Signup</button>
        </div>
      </form>

    </div>


  </body>
</html>
