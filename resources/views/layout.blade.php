<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NewsPepa| @yield('title')</title>
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
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
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
    <input type="search" results="7" placeholder="Search News?" name="searchbox">
    </ul>
    </div>
    <div class="large-12 medium-12 small-12">
        <button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">Categories</button></div>
        <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
          <li><a href="{{url('/')}}">Top stories</a></li>
          <li><a href="{{url('entertainment')}}">Entertainment</a></li>
          <li><a href="{{url('politics')}}">Politics</a></li>
          <li><a href="{{url('sports')}}">Sports</a></li>
          <li><a href="{{url('nigeria')}}">Nigeria</a></li>
          <li><a href="{{url('metro')}}">Metro</a></li>
        </ul>
          <div class="large-12 small-12 columns">
             @yield('important_stories')

              @yield('less_important_stories')


              {{--Stories with no images--}}
              @yield('stories_with_no_images')

              {{--other relevant content--}}
              <br/>
              @yield('related_content')


              </div>

    <div class="row news-item" ></div>



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
