<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title')</title>
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
    <link rel="stylesheet" href="ui_newspaper/css/app.css" />
    <script src="ui_newspaper/js/vendor/jquery.js"></script>
      <script src="ui_newspaper/js/foundation.min.js"></script>

  </head>
  <body>

  {{--<div class="row">--}}
      {{--<div class="large-12 medium-12 small-12 columns">--}}
        {{--<div class="panel">--}}
            {{--<div class="large-3 medium-3 small-3"><img src="ui_newspaper/img/search-icon-gray-small.png" width="44px" height="44px"/></div>--}}
            {{--<div class="large-9 medium-9 small-9"><p>NewsPepa</p></div>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
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

          <li class="has-form">
            <div class="row collapse">
              <div class="large-8 small-9 columns">
                <input type="text" placeholder="What's happening?">
              </div>
              <div class="large-4 small-3 columns">
                <a href="#" class="alert button expand">Search</a>
              </div>
            </div>
          </li>
        </ul>

          {{--<li class="has-dropdown">--}}
            {{--<a href="#">Right Button Dropdown</a>--}}
            {{--<ul class="dropdown">--}}
              {{--<li><a href="#">First link in dropdown</a></li>--}}
              {{--<li class="active"><a href="#">Active link in dropdown</a></li>--}}
            {{--</ul>--}}
          {{--</li>--}}


        <!-- Left Nav Section -->
        {{--<ul class="left">--}}
          {{--<li><a href="#">Left Nav Button</a></li>--}}
        {{--</ul>--}}
      </section>
    </nav>
    </div>

  <script>
    $(document).foundation();
  </script>
 </body>
 </html>