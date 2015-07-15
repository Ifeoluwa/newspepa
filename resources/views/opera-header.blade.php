 <!doctype html>
 <html class="no-js" lang="en">
    <head>
     <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
        <title>NewsPepa | @yield('title')</title>
        <link rel="shortcut icon" href="ui_newspaper/img/favicon.ico" />
        <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
        <link rel="stylesheet" href="ui_newspaper/css/opera-app13.css" />
        <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
        <script src="ui_newspaper/js/vendor/modernizr.js"></script>
    </head>
     <body>
    {{--<div id="fb-root"></div>--}}
      {{--<script>(function(d, s, id) {--}}
        {{--var js, fjs = d.getElementsByTagName(s)[0];--}}
        {{--if (d.getElementById(id)) return;--}}
        {{--js = d.createElement(s); js.id = id;--}}
        {{--js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=222521117951114";--}}
        {{--fjs.parentNode.insertBefore(js, fjs);--}}
      {{--}(document, 'script', 'facebook-jssdk'));</script>--}}

        <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">
            <ul class="title-area">
                <a href="{{url('/')}}"><li class="name"></li></a>
            </ul>
        </nav>
        {{--the search bar--}}
        <form id="searchbar" method="get" action = "search">
            <div class="row searchbar-row" style="width:100%">
                <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" results="7" placeholder="Search News..." name="search_query" autocomplete="on" aria-autocomplete="both" aria-haspopup="true" spellcheck="false" aria-label="search"></div>
                <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
            </div>
        </form>

 <div class="row opera-panel radius" style="background-color: #336;">
   <a href="{{url('/index')}}"> <span style="color:#ffffff"><b>Top Stories| </b></span></a>
    <a href="{{url('/latest')}}"><span style="color:#ffffff"><b>Latest Stories| </b></span></a>
    <a href="{{url('/nigeria')}}"><span style="color:#ffffff"><b>Nigeria </b></span></a>
    <br/>
        <a href="{{url('/entertainment')}}"><span style="color:#ffffff"><b>Entertainment| </b></span></a>
        <a href="{{url('/sports')}}"><span style="color:#ffffff"><b>Sports| </b></span></a>
        <a href="{{url('/politics')}}"><span style="color:#ffffff"><b>Politics| </b></span></a>
       <a href="{{url('/metro')}}"><span style="color:#ffffff"><b>Metro </b></span></a>
    </div>

    @yield('category_name')
    {{--<form id="page-changer" action="" method="post">--}}
        {{--<select id= "catDropdown" onchange= "window.location.replace(this.options[this.selectedIndex].value)">--}}
            {{--<option value="{{url('/index')}}">Top Stories</option>--}}
            {{--<option value="{{url('/latest')}}"> Latest Stories</option>--}}
            {{--<option value="{{url('/nigeria')}}">Nigeria</option>--}}
            {{--<option value="{{url('/entertainment')}}">Entertainment</option>--}}
            {{--<option value="{{url('/sports')}}">Sports</option>--}}
            {{--<option value="{{url('/politics')}}">Politics</option>--}}
            {{--<option value="{{url('/metro')}}">Metro</option>--}}
        {{--</select>--}}
        {{--<input type="submit" value="Go" id="submit" />--}}
    {{--</form>--}}


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
        {{--<script src="ui_newspaper/js/foundation.min.js"></script>--}}
        <script src="ui_newspaper/get_social_counts/site.js"></script>

   <script>
   $(document).foundation();

      $(document).ready(function() {
        if (location.pathname == "/") {
                   $("#catDropdown").val("Top Stories");
              }else if (location.pathname == "/latest") {
                   $("#catDropdown").val("Latest Stories");
               } else if (location.pathname == "/politics") {
                  $("#catDropdown").val("Politics");
               } else if (location.pathname == "/entertainment") {
                     $("#catDropdown").val("Entertainment");
               } else if (location.pathname == "/sports") {
               $("#catDropdown").val("Sports");
               }else if (location.pathname == "/metro") {
                             $("#catDropdown").val("Metro");
                }else if (location.pathname == "/nigeria") {
                               $("#catDropdown").val("Nigeria");
                          }
          });


//          this is used for google analytics
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-49109646-1', 'auto');
     ga('send', 'pageview');

      </script>
    </body>
    </html>