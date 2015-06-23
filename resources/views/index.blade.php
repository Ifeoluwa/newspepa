<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NewsPepa |App Name - @yield('title')</title>
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
    <link rel="stylesheet" href="ui_newspaper/css/app.css" />

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
    <div class="fixed sticky">
    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index">NEWSPEPA</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="index"><span>Categories</span></a></li>
      </ul>
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="active"><a href="#">Top stories</a></li>
          <li><a href="#">Entertainment</a></li>
          <li><a href="#">Politics</a></li>
          <li><a href="#">Sports</a></li>
          <li><a href="#">Nigeria</a></li>
          <li><a href="#">Metro</a></li>

          <li class="has-form">
            <div class="row collapse">
              <div class="large-8 small-9 columns">
                <input type="text" placeholder="Find Stuff">
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

  <div class="row news-item">
      <div class="large-12 small-12 columns">
          <div class="row panel radius">
              <div class="large-6 small-12 columns"><img src="http://placehold.it/300x300&text=[img]"/></div>
              <div class="large-6 small-12 columns">
                  <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
              </div>

          </div>
          <br>
          <div class="row panel radius">
              <div class="large-3 small-4 columns"><img src="http://placehold.it/100x100&text=[img]"/></div>
              <div class="large-9 small-8 columns">
                  <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
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
          </div>
          <br/>


          {{--<hr/>--}}


          <div class="row panel radius">
              {{--<div class="large-2 columns small-3"><img src="http://placehold.it/100x100&text=[img]"/></div>--}}
              <div class="large-12 columns small-12">
                  <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                  {{--<ul class="inline-list">--}}
                      {{--<li><a href="">Reply</a></li>--}}
                      {{--<li><a href="">Share</a></li>--}}
                  {{--</ul>--}}
              </div>
          </div>


              </div>
          </div>
      {{--</div>--}}





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
  {{--{{ HTML::script("ui_newspaper/js/vendor/jquery.js") }}--}}
  {{--{{ HTML::script("ui_newspaper/js/foundation.min.js") }}--}}
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
