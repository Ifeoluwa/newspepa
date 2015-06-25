<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NewsPepa @yield('title')</title>
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
    <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
    <link rel="stylesheet" href="ui_newspaper/css/app.css" />

  </head>
  <body>
    <div class="fixed">

    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index">NEWSPEPA</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Categories</span></a></li>
      </ul>
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="active"><a href="{{url('/')}}">Top stories</a></li>
          <li><a href="{{url('entertainment')}}">Entertainment</a></li>
          <li><a href="{{url('politics')}}">Politics</a></li>
          <li><a href="{{url('sports')}}">Sports</a></li>
          <li><a href="{{url('nigeria')}}">Nigeria</a></li>
          <li><a href="{{url('metro')}}">Metro</a></li>

          {{--<li class="has-form">--}}
            {{--<div class="row collapse">--}}
              {{--<div class="large-8 small-9 columns">--}}
                {{--<input type="text" placeholder="What's happening?">--}}
              {{--</div>--}}
              {{--<div class="large-4 small-3 columns">--}}
                {{--<a href="#" class="alert button expand">Search</a>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</li>--}}
        </ul>
      </section>
    </nav>
    </div>


     {{--<div class="large-12 small-12 columns">--}}
     {{--<div class="large-10 small-8 columns"><input type="search" results="7" placeholder="What's happening?" name="searchbox">--}}
     {{--</div>--}}
     {{--<div class="large-2 small-4 columns"><a href="#" class="alert button expand">Search</a></div>--}}
     {{--</div>--}}

     {{--</div>--}}


    <div class="row news-item" >

          <div class="large-12 small-12 columns">
             @yield('important_stories')
              <br>

              @yield('less_important_stories')
              <br/>


              {{--Stories with no images--}}
              @yield('stories_with_no_images')


              </div>
    </div>



    <footer class="row">
        <div class="large-12 columns">
            <hr/>
            <div class="row">
                <div class="large-5 columns">
                    <p>© NewsPepa.</p>
                </div>

            </div>
        </div>
    </footer>
    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>

    </body>
</html>
