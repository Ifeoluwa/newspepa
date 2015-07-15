 <!doctype html>
 <html class="no-js" lang="en">
    <head>
     <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
        <title>NewsPepa | @yield('title')</title>
        <link rel="shortcut icon" href="ui_newspaper/img/favicon.ico" />
        <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
        <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="ui_newspaper/css/opera-app12.css" />
        <script src="ui_newspaper/js/vendor/modernizr.js"></script>
    </head>
     <body>
    <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=222521117951114";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

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

    <select id= "catDropdown" onchange="window.open(this.options[this.selectedIndex].value)">
        <option value="{{url('/index')}}" id="1">Top Stories</option>
        <option value="{{url('/latest')}}" id="2"> Latest Stories</option>
        <option value="{{url('/nigeria')}}" id="3">Nigeria</option>
        <option value="{{url('/entertainment')}}" id="4">Entertainment</option>
        <option value="{{url('/sports')}}" id="5">Sports</option>
        <option value="{{url('/politics')}}" id="6">Politics</option>
        <option value="{{url('/metro')}}" id="7">Metro</option>
    </select>
    <script>
      if (location.pathname == "/") {
                 $("#catDropdown").selected()
            }else if (location.pathname == "/latest") {
                  $("#catDropdown").text("Latest Stories");
             } else if (location.pathname == "/politics") {
                $("#catDropdown").text("Politics");
             } else if (location.pathname == "/entertainment") {
                   $("#catDropdown").text("Entertainment");
             } else if (location.pathname == "/sports") {
             $("#catDropdown").text("Sports");
             }else if (location.pathname == "/metro") {
                           $("#catDropdown").text("Metro");
              }else if (location.pathname == "/nigeria") {
                             $("#catDropdown").text("Nigeria");
                        }
    </script>

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

    </body>
    </html>