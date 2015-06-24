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

      </section>
    </nav>
    </div>
    <div class="row news-item" >
        @yield('news_content')
          <div class="large-12 small-12 columns">
              <div class="row panel radius">
              @yield('mostImportant')
                  <div class="large-12 small-12 columns">@yield('image_url')</div>
                  <div class="large-12 small-12 columns">@yield('story_title')
                  </div>
                  {{--img src="http://placehold.it/300x300&text=[img]"--}}
                 <span class="label">@yield('time_release')</span>
              </div>
              <br>

              <div class="row panel radius">
              @yield('lessImportant')
                  <div class="large-5 small-6 columns">@yield('small_image_url')</div>
                  <div class="large-7 small-6 columns">@yield('story_title_here')
                      {{--<ul class="inline-list">--}}
                          {{--<li><a href="">Reply</a></li>--}}
                          {{--<li><a href="">Share</a></li>--}}
                      {{--</ul>--}}


                      {{--<h6>2 Comments</h6>--}}
                      {{--<div class="row">--}}
                          {{--<div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>--}}
                          {{--<div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>--}}
                      {{--</div>--}}
                      {{--<div class="row">--}}
                          {{--<div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>--}}
                          {{--<div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>--}}
                      {{--</div>--}}
                  </div>
                  <span class="label">@yield('time_release')</span>
              </div>
              <br/>


              {{--<hr/>--}}


              <div class="row panel radius">
              @yield('noImage')
                  {{--<div class="large-2 columns small-3"><img src="http://placehold.it/100x100&text=[img]"/></div>--}}
                  <div class="large-12 columns small-12">@yield('story_title')
                      {{--<ul class="inline-list">--}}
                          {{--<li><a href="">Reply</a></li>--}}
                          {{--<li><a href="">Share</a></li>--}}
                      {{--</ul>--}}
                  </div>
                  <span class="label">@yield('time_release')</span>
              </div>


                  </div>
              </div>

              <footer class="row">
                  @yield ('footer_content')
                    <div class="large-12 columns">
                        <hr/>
                        <div class="row">
                            <div class="large-5 columns">
                                <p>© NewsPepa.</p>
                            </div>
                            {{--<div class="large-7 columns">--}}
                                {{--<ul class="inline-list right">--}}
                                    {{--<li><a href="#">Section 1</a></li>--}}
                                    {{--<li><a href="#">Section 2</a></li>--}}
                                    {{--<li><a href="#">Section 3</a></li>--}}
                                    {{--<li><a href="#">Section 4</a></li>--}}
                                    {{--<li><a href="#">Section 5</a></li>--}}
                                    {{--<li><a href="#">Section 6</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
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