
 <!doctype html>
 <html class="no-js" lang="en">
    <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
     @yield('more-meta')
     <title>@yield('title') | Newspepa</title>
     <link rel="shortcut icon" href="ui_newspaper/img/favicon2.ico" />
     <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
      <link rel="stylesheet" href="ui_newspaper/css/test.css" />
      {{--<link rel="stylesheet" href="ui_newspaper/css/app26.css" />--}}
     <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
     <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
     {{--<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>--}}
     <script src="ui_newspaper/js/vendor/modernizr.js"></script>
   </head>
   <body>
   {{--this is for showing the facebook like button. Delete this and fire & brimstone rains--}}
   <div id="fb-root"></div>
   <script>(function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
     js.async=true;js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=222521117951114";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));</script>

 <a href="#" class="back-to-top" style="display: inline;"></a>
        <div class="off-canvas-wrap">
            <div class="inner-wrap">
                <div class="header">
                    <nav class="tab-bar" data-offcanvas>
                        <section class="left-small"> <a class="left-off-canvas-toggle menu-icon"><span></span></a>

                        </section>
                        <section class="right tab-bar-section">
                             <h1>Foundation 5 test</h1>
                        </section>
                    </nav>
                </div>
                <aside class="left-off-canvas-menu">
                    <ul class="off-canvas-list">
                        <li>
                            <label>Foundation</label>
                        </li>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                         <li class="has-submenu"><a href="#">View more</a>
                              <ul class="right-submenu">
                                  <li class="back"><a href="#">Back</a></li>
                                  <li><a href="{{url('/latest-the-guardian-news')}}">The Guardian</a></li>
                                  <li id="8"><a href="{{url('/latest-bbc-hausa-news')}}">BBC Hausa</a>
                                  <li><a href="{{url('/latest-kokofeed-news')}}">KokoFeed</a></li>
                                  <li><a href="{{url('/latest-net-news')}}">Net</a></li>
                                  <li><a href="{{url('/latest-star-gist-news')}}">Stargist</a></li>
                                  <li><a href="{{url('/complete-sports')}}">Complete Sports</a></li>
                                  <li id="8"><a href="{{url('/latest-the-nation-news')}}">The Nation</a>
                                  <li><a href="{{url('/latest-daily-post-news')}}">Daily Post</a></li>
                                  <li><a href="{{url('/latest-premium-times-news')}}">Premium times</a></li>
                                  <li><a href="{{url('/latest-business-day-news')}}">Business day</a></li>
                                  <li><a href="{{url('/latest-city-people-news')}}">City People</a></li>
                                  <li><a href="{{url('/latest-encomium-news')}}">Encomium</a></li>
                                  <li><a href="{{url('/latest-naira-metrics-news')}}">Naira Metrics</a></li>
                                  <li><a href="{{url('/latest-business-news-news')}}">Business News</a></li>
                              </ul>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        <li><a href="#">The Psychohistorians</a>
                        </li>
                    </ul>
                </aside>
                <article class="small-12 columns">
                    <p>Content</p>
                    <p>Content</p>
                    <div data-magellan-expedition="fixed">
                      <dl class="sub-nav panel">
                        <dd data-magellan-arrival="build"><a href="#build">Build with HTML</a></dd>
                        <dd data-magellan-arrival="js"><a href="#js">Arrival 2</a></dd>
                      </dl>
                    </div>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                  <a data-dropdown="drop1" aria-controls="drop1" aria-expanded="false">Has Dropdown</a>
<ul id="drop1" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
  <li><a href="#">This is a link</a></li>
  <li><a href="#">This is another</a></li>
  <li><a href="#">Yet another</a></li>
</ul>
<a data-dropdown="drop2" aria-controls="drop2" aria-expanded="false">Has Content Dropdown</a>
<div id="drop2" data-dropdown-content class="f-dropdown content" aria-hidden="true" tabindex="-1">
  <p>Some text that people will think is awesome! Some text that people will think is awesome! Some text that people will think is awesome!</p>
</div>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>
                    <p>Content</p>

                </article> <a class="exit-off-canvas"></a>

                <footer class="small-12 columns">
                    <div><ul class="small-block-grid-2" style="color:#0266C8; line-height: 0.8; margin-top:5px">
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
                                    <li id="12"><a href="{{url('/about')}}">About</a>
                                    <li id="9"><a href="{{url('/latest-politics-news-in-nigeria')}}">Politics</a></li>
                                    {{--<li id="9"><a href="{{url('/latest-bella-naija-news')}}">Bella Naija</a></li>--}}
                                     <li id="11"><a href="{{url('/publishers')}}">More&raquo;</a>
                                    <li id="10"><a href="{{url('/latest-metro-news-in-nigeria')}}">Metro</a></li>
                                    <li id="13">
                                       <div class="fb-like" data-href="https://www.facebook.com/pages/Newspepa/1165261366833416" data-width="150" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                    </li>

                                                {{--<ul id="drop1" class="tiny f-dropdown" data-dropdown-content>--}}
                                                                {{--<li><a href="#">This is a link</a></li>--}}
                                                                {{--<li><a href="#">This is another</a></li>--}}
                                                                {{--<li><a href="#">Yet another</a></li>--}}
                                                                {{--</ul>--}}
                                               {{--</li>--}}

                                 </ul></div>
                </footer>

            </div>
        </div>


<script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/foundation/foundation.offcanvas.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
<script>
        $(document).foundation();
var offset = 100;
    var duration = 700;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);

        } else {
            $('.back-to-top').fadeOut(duration);

        }


    });

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 20}, duration);
        return false;
    });

</script>

    {{--@section('trending stories')--}}

    {{--<div class="row row-trending">--}}
        {{--<div class="large-12 small-12 medium-12 columns heading-trending">--}}
            {{--<span class="span-trending">TRENDING NOW</span>--}}
        {{--</div>--}}
        {{--<div  id="trend1" class="large-12 small-12 medium-12 columns column-trending" >--}}
            {{--<span class="title-timeline">some content in here title of a trending story</span>--}}
        {{--</div>--}}
        {{--<div  id="trend2" class="large-12 small-12 medium-12 columns column-trending">--}}
            {{--<span class="title-timeline">some content in here the title of a trending story</span>--}}
        {{--</div>--}}
        {{--<div id="trend3"class="large-12 small-12 medium-12 columns column-trending">--}}
            {{--<span class="title-timeline">some content in here  title of a trending story</span>--}}
        {{--</div>--}}
        {{--<div id="trend4" class="large-12 small-12 medium-12 columns column-trending">--}}
            {{--<span class="title-timeline">some content in here  title of a trending story</span>--}}
        {{--</div>--}}
        {{--<div id="trend5" class="large-12 small-12 medium-12 columns column-trending">--}}
             {{--<span class="title-timeline">some content in here  title of a trending story</span>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--@stop--}}