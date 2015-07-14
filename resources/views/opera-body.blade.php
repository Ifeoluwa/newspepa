<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
    <title>NewsPepa | @yield('title')</title>
    <link rel="shortcut icon" href="ui_newspaper/img/favicon.ico" />
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
    <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
    <link rel="stylesheet" href="ui_newspaper/css/app11.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
    <script src="ui_newspaper/js/vendor/modernizr.js"></script>
  </head>
  <body>
<div class="large-12 small-12 columns" id="stories_container">
             @yield('important_stories')

              @yield('less_important_stories')
              {{--Stories with no images--}}
              @yield('stories_with_no_images')

              @yield('full_story')

              {{--other relevant content--}}
              <br/>
              @yield('related_content')


              </div>
              <a href="#" class="back-to-top" style="display: inline;"></a>
    <footer class="row">
        <div class="large-12 columns">
            <hr/>
            <div class="row">
                <div class="large-5 columns">
                    <p style="text-align: center">
                        <i class="newspepaicon"> </i> 2015 Iconway
                        <a href="{{url('/')}}"><button class="home-button" id="home">Home</button></a>
                    </p>

                </div>

            </div>
        </div>
    </footer>
    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>
    </body>
    </html>