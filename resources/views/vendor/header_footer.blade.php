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
          <h1><a href="#">NEWSPEPA</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Categories</span></a></li>
      </ul>
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="active"><a href="#">Top stories</a></li>
          <li><a href="categories">Entertainment</a></li>
          <li><a href="categories">Politics</a></li>
          <li><a href="categories">Sports</a></li>
          <li><a href="categories">Nigeria</a></li>
          <li><a href="categories">Metro</a></li>

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


 <footer class="row">
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