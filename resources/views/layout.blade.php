<!doctype html>
<html class="no-js" lang="en">
   <head>
   <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
    <title>NewsPepa| @yield('title')</title>
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
    <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
    <link rel="stylesheet" href="ui_newspaper/css/app.css" />
    <script src="ui_newspaper/js/vendor/modernizr.js"></script>

  </head>
  <body>
    <div class="fixed">

    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">
      <ul class="title-area">
        <a href="{{url('/')}}"><li class="name"></li></a>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        {{--<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>--}}
      </ul>
      {{--<section class="top-bar-section">--}}
        {{--<!-- Right Nav Section -->--}}
        {{--<ul class="right">--}}
          {{--<li class="active"><a href="{{url('/')}}">Top stories</a></li>--}}
          {{--<li><a href="{{url('entertainment')}}">Entertainment</a></li>--}}
          {{--<li><a href="{{url('politics')}}">Politics</a></li>--}}
          {{--<li><a href="{{url('sports')}}">Sports</a></li>--}}
          {{--<li><a href="{{url('nigeria')}}">Nigeria</a></li>--}}
          {{--<li><a href="{{url('metro')}}">Metro</a></li>--}}
        {{--</ul>--}}
      {{--</section>--}}
    </nav>

    {{--the search bar--}}
    <div class="row searchbar-row" style="width:100%">
            <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" results="7" placeholder="Search News..." name="searchbox" autocomplete="on" aria-autocomplete="both" aria-haspopup="true" spellcheck="false" aria-label="search"></div>
            <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
              </div>
              </div>
    {{--<button type="submit" style="height:100%"></button>--}}

    {{--this is the categories dropdown; asides the categories included in the navigation tab--}}

    <div class="large-12 medium-12 small-12 columns">
    @section('dropdown')
        <button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">Filter By</button></div>@show
        <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
          <li id="1" ><a href="{{url('/')}}">Top stories</a></li>
          <li id="2" class="active"><a href="{{url('entertainment')}}">Entertainment</a></li>
          <li id="3"><a href="{{url('politics')}}">Politics</a></li>
          <li id="4"><a href="{{url('sports')}}">Sports</a></li>
          <li id="5"><a href="{{url('nigeria')}}">Nigeria</a></li>
          <li id="6"><a href="{{url('metro')}}">Metro</a></li>
        </ul>

{{--the stories containers starts from here--}}

          <div class="large-12 small-12 columns">
             @yield('important_stories')

              @yield('less_important_stories')


              {{--Stories with no images--}}
              @yield('stories_with_no_images')

              @yield('full_story')

              {{--other relevant content--}}
              <br/>
              @yield('related_content')


              </div>





    <footer class="row">
        <div class="large-12 columns">
            <hr/>
            <div class="row">
                <div class="large-5 columns">
                    <p style="text-align: center;  ">

                        <i class="newspepaicon"> </i>  © 2015 ICONWAY</p>
                </div>

            </div>
        </div>
    </footer>
    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>
    <script src="ui_newspaper/js/foundation/foundation.dropdown.js"></script>

    <script>
        $(document).foundation();


// $(window).scroll(function () {
//    if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
//        alert("End Of The Page");
//    }
// });

        if (location.pathname == "/") {
              $(".dropdown").text("Top Stories");
         } else if (location.pathname == "/politics") {
            $(".dropdown").text("Politics");
         } else if (location.pathname == "/entertainment") {
               $(".dropdown").text("Entertainment");
         } else if (location.pathname == "/sports") { // to add aditional pages, replace CAPS
         $(".dropdown").text("Sports");
         }else if (location.pathname == "/metro") { // to add aditional pages, replace CAPS
                       $(".dropdown").text("Metro");
          }else if (location.pathname == "/nigeria") { // to add aditional pages, replace CAPS
                         $(".dropdown").text("Nigeria");
                    }



    </script>

    </body>
</html>
