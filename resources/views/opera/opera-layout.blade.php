 <!doctype html>
 <html class="no-js" lang="en">
    <head>
     <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
        <title>@yield('title') | Newspepa</title>
        <link rel="shortcut icon" href="ui_newspaper/img/favicon2.ico" />
        <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
        <link rel="stylesheet" href="ui_newspaper/css/opera-app27.css" />
        <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
        <script src="ui_newspaper/js/vendor/modernizr.js"></script>
    </head>
     <body>
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
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
                <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" results="7" placeholder="Search News..." name="search_query" autocomplete="on" aria-autocomplete="both" spellcheck="false" aria-label="search" style="font-size:16px" required></div>
                <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
            </div>
        </form>

 <div class="row opera-panel radius" style="background-color: #0266C8;">
   <ul class="inline-list" >
             <li id="2"><a href="{{url('/latest-news-in-nigeria')}}" style="color:#ffffff; font-size: 15px;font-weight: bold">Latest stories</a></li>
             <li id="3"><a href="{{url('latest-nigeria-news-in-nigeria')}}" style="color:#ffffff; font-size: 15px;font-weight: bold">Nigeria</a></li>
             <li id="4"><a href="{{url('latest-politics-news-in-nigeria')}}" style="color:#ffffff; font-size: 15px;font-weight: bold">Politics</a></li>
			 <li id="5"><a href="{{url('latest-business-news-in-nigeria')}}" style="color:#ffffff; font-size: 15px;font-weight: bold">Business</a></li>
             <li id="5"><a href="{{url('latest-entertainment-news-in-nigeria')}}" style="color:#ffffff; font-size: 15px;font-weight: bold">Entertainment</a></li>
             <li id="6"><a href="{{url('latest-sports-news-in-nigeria')}}"  style="color:#ffffff; font-size: 15px;font-weight: bold">Sports</a></li>
             <li id="7"><a href="{{url('latest-metro-news-in-nigeria')}}" style="color:#ffffff; font-size: 15px;font-weight: bold">Metro</a></li>

   </ul>
    </div>

    @yield('category_name')

    <div class="large-12 small-12 columns" id="stories_container">
                 @yield('important_stories')

                  @yield('less_important_stories')
                  {{--Stories with no images--}}
                  @yield('stories_with_no_images')

                  @yield('full_story')

                  {{--other relevant content--}}
                  <br/>
                  @yield('related_content')

                  @yield('publishers')

                   @yield('about')
    </div>

       <footer class="row" id="footer-list" >
               <div class="large-12 columns" style="border-top: solid #E0E0E0 2px; margin-top:1px">
               <ul class="small-block-grid-2" style="color:#0266C8; line-height: 0.8; margin-top:5px">
                 <li id="1" ><a href="{{url('/')}}">Home</a></li>
                 <li id="2" ><a href="{{url('/latest-punch-news')}}">Punch</a></li>
                  <li id="3"><a href="{{url('/latest-news-in-nigeria')}}">Latest stories</a></li>
                  <li id="4"><a href="{{url('/latest-vanguard-news')}}">Vanguard</a></li>
                  <li id="5"><a href="{{url('latest-entertainment-news-in-nigeria')}}">Entertainment</a></li>
                  <li id="6"><a href="{{url('/latest-linda-ikeji-news')}}">Linda Ikeji</a></li>
                  <li id="5"><a href="{{url('latest-business-news-in-nigeria')}}">Business</a></li>
                  <li><a href="{{url('/latest-nigerian-monitor-news')}}">Nigerian Monitor</a></li>
                  <li id="7"><a href="{{url('/latest-sports-news-in-nigeria')}}">Sports</a></li>
                  {{--<li id="7"><a href="{{url('/latest-complete-sports-news')}}">Complete Sports</a></li>--}}
                  <li id="8"><a href="{{url('/latest-bbc-hausa-news')}}">BBC Hausa</a>
                  <li id="9"><a href="{{url('/latest-politics-news-in-nigeria')}}">Politics</a></li>
                  {{--<li id="9"><a href="{{url('/latest-bella-naija-news')}}">Bella Naija</a></li>--}}
                   <li id="11"><a href="{{url('/publishers')}}">More&raquo;</a>
                  <li id="10"><a href="{{url('/latest-metro-news-in-nigeria')}}">Metro</a></li>
                  <li id="13">
                     <div class="fb-like" data-href="https://www.facebook.com/pages/Newspepa/1165261366833416" data-width="150" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                  </li>
               </ul>
               </div>
           </footer>


    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>

   <script>
   $(document).foundation();
      </script>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-49109646-1', 'auto');
        ga('send', 'pageview');

      </script>
      @yield('more-scripts')
    </body>
    </html>