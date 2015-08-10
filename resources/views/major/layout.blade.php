<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
    @yield('more-meta')
    <title>@yield('title') | Newspepa</title>
    <link rel="shortcut icon" href="ui_newspaper/img/favicon2.ico" />
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
     <link rel="stylesheet" href="ui_newspaper/css/app26.css" />
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


    {{--<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">--}}
        {{--<ul class="title-area">--}}
            {{--<li class="name name-m"><a href="{{url('/')}}"></a></li>--}}
            {{--<li class="toggle-topbar menu-icon"><a href="{{url('/')}}"></a></li>--}}
        {{--</ul>--}}
        {{--<section class="top-bar-section">--}}
                    {{--<!-- Right Nav Section -->--}}
                    {{--<ul class="right">--}}
                        {{--<li class="active"><a href="#">Top stories</a></li>--}}
                        {{--<li><a href="#">Entertainment</a></li>--}}
                        {{--<li><a href="#">Politics</a></li>--}}
                        {{--<li><a href="#">Sports</a></li>--}}
                        {{--<li><a href="#">Nigeria</a></li>--}}
                        {{--<li><a href="#">Metro</a></li>--}}
                    {{--</ul>--}}
        {{--</section>--}}
    {{--</nav>--}}
    <div class="off-canvas-wrap" data-offcanvas="none">
      <div class="inner-wrap">
            <nav class="tab-bar" data-options="sticky_on: small" data-tab-bar role ="navigation">
                <section class="middle tab-bar-section">
                      <a href="{{url('/')}}"> <h1 class="title"></h1></a>
                    </section>
                <div class="left-small" data-options="sticky_on: small">
                 <a href="#idOfLeftMenu" role="button" aria-controls="idOfLeftMenu" aria-expanded="false" class="left-off-canvas-toggle menu-icon" ><span></span></a>
                </div>

            </nav>

        <!-- Off Canvas Menu -->
        <aside class="left-off-canvas-menu">
            <!-- whatever you want goes here -->
             <ul class="off-canvas-list">
                  <li id="1"><label>Newspepa</label></li>
                  <li id="1"><a href="{{url('/')}}">Top stories</a></li>
                  <li id="2"><a href="{{url('/latest-news-in-nigeria')}}">Latest stories</a></li>
                  <li id="3"><a href="{{url('latest-nigeria-news-in-nigeria')}}">Nigeria</a></li>
                  <li id="4"><a href="{{url('latest-entertainment-news-in-nigeria')}}">Entertainment</a></li>
                  <li id="5"><a href="{{url('latest-business-news-in-nigeria')}}">Business</a></li>
                  <li id="5"><a href="{{url('latest-sports-news-in-nigeria')}}">Sports</a></li>
                  <li id="6"><a href="{{url('latest-politics-news-in-nigeria')}}">Politics</a></li>
                  <li id="7"><a href="{{url('latest-metro-news-in-nigeria')}}">Metro</a></li>

                  <li><label>News Sources</label></li>
                  <li ><a href="{{url('/latest-punch-news')}}">Punch</a></li>
                  <li ><a href="{{url('/latest-vanguard-news')}}">Vanguard</a></li>
                  <li ><a href="{{url('/latest-linda-ikeji-news')}}">Linda Ikeji</a></li>
                  <li ><a href="{{url('/latest-nigerian-tribune-news')}}">Nigerian Tribune</a></li>
                  <li><a href="{{url('/latest-nigerian-monitor-news')}}">Nigerian Monitor</a></li>
                   <li><a href="{{url('/latest-leadership-news')}}">Leadership</a></li>
                   <li><a href="{{url('/latest-bella-naija-news')}}">Bella Naija</a></li>
                   <li><a href="{{url('/latest-channels-tv-news')}}">Channels TV</a></li>
                   <li><a href="{{url('/latest-goal-com-news')}}">Goal</a></li>
                  <li class="has-submenu"><a href="#">View more</a>
                      <ul class="left-submenu">
                          <li class="back"><a href="#">Back</a></li>
                          <li><a href="{{url('/latest-the-cable-news')}}">The Cable</a></li>
                          <li><a href="{{url('/latest-the-guardian-news')}}">The Guardian</a></li>
                          <li><a href="{{url('/latest-kokofeed-news')}}">KokoFeed</a></li>
                          <li><a href="{{url('/latest-net-news')}}">Net</a></li>
                          <li><a href="{{url('/latest-star-gist-news')}}">Stargist</a></li>
                          <li><a href="{{url('/complete-sports')}}">Complete Sports</a></li>
                          <li><a href="{{url('/latest-daily-post-news')}}">Daily Post</a></li>
                          <li><a href="{{url('/latest-premium-times-news')}}">Premium times</a></li>
                          <li><a href="{{url('/latest-business-day-news')}}">Business day</a></li>
                          <li><a href="{{url('/latest-city-people-news')}}">City People</a></li>
                          <li><a href="{{url('/latest-encomium-news')}}">Encomium</a></li>
                          <li><a href="{{url('/latest-naira-metrics-news')}}">Naira Metrics</a></li>
                          <li><a href="{{url('/latest-business-news-news')}}">Business News</a></li>
                      </ul>
             </ul>
        </aside>

      <!-- close the off-canvas menu -->

    {{--the search bar--}}


       <form id="searchbar" method="get" action = "search">
                  <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" placeholder="Search News..." name="search_query" spellcheck="false" aria-label="search" style="font-size:16px" required></div>
                  <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
          </form>







    {{--this is the categories dropdown; asides the categories included in the navigation tab--}}

        {{--<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">@yield('dropdown')</button>--}}
        {{--<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">--}}
       <div class="row category-row" style="background-color: #0266C8;border-radius:2px">
        <ul class="inline-list">
          <li id="2"><a href="{{url('/latest-news-in-nigeria')}}">Latest</a></li>
          <li id="3" class="active"><a href="{{url('latest-nigeria-news-in-nigeria')}}">Nigeria</a></li>
          <li id="4"><a href="{{url('latest-entertainment-news-in-nigeria')}}">Entertainment</a></li>
          <li id="4"><label href="#" data-dropdown="drop" aria-controls="drop" aria-expanded="true" class="button dropdown">More</label>
            <ul id="drop" data-dropdown-content class="f-dropdown" aria-hidden="true">
            <li><a href="{{url('latest-business-news-in-nigeria')}}">Business</a></li>
            <li><a href="{{url('latest-sports-news-in-nigeria')}}">Sports</a></li>
            <li id="6"><a href="{{url('latest-politics-news-in-nigeria')}}">Politics</a>
            <li id="7"><a href="{{url('latest-metro-news-in-nigeria')}}">Metro</a>
            </ul>
          </li>

        </ul>
        </div>

{{--the stories containers starts from here--}}

          <div class="large-12 small-12 columns" id="stories_container">
             @yield('important_stories')

              @yield('less_important_stories')
              {{--Stories with no images--}}
              @yield('stories_with_no_images')

              @yield('full_story')

              {{--other relevant content--}}

              @yield('related_content')

              @yield('other_sources')

              @yield('publishers')

              @yield('about')

              </div>


              <a href="#" class="back-to-top" style="display: inline;"></a>


             <a class="exit-off-canvas"></a>

                  </div>
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
           <li id="7"><a href="{{url('/latest-complete-sports-news')}}">Complete Sports</a></li>
           <li id="9"><a href="{{url('/latest-politics-news-in-nigeria')}}">Politics</a></li>
           <li id="9"><a href="{{url('/latest-bella-naija-news')}}">Bella Naija</a></li>
           <li id="10"><a href="{{url('/latest-metro-news-in-nigeria')}}">Metro</a></li>
            <li id="11"><a href="{{url('/publishers')}}">More&raquo;</a>
                       {{--<ul id="drop1" class="tiny f-dropdown" data-dropdown-content>--}}
                                       {{--<li><a href="#">This is a link</a></li>--}}
                                       {{--<li><a href="#">This is another</a></li>--}}
                                       {{--<li><a href="#">Yet another</a></li>--}}
                                       {{--</ul>--}}
                      {{--</li>--}}

        </ul>
        </div>
    </footer>

     <a href="{{url('/')}}"><div class="panel" id="toFloat">
        <div class="name-m"></div>
    </div></a>


    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/foundation/foundation.offcanvas.js"></script>
    <script src="ui_newspaper/js/foundation/foundation.dropdown.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>

    <script>
        $(document).foundation();
//ajax call for getting number of linkouts of specific a tags
            $('.linkOut').click(function(event) {

            var token = $(this).data('token');
             var storyID = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    dataType:"jsonp"
                    url:'http://newspepa.com/linkout/'+storyID,
                    data:{_token :token},
                    success: function(msg){
                        alert(msg);
                    }
                })

             });


//this is used to specify the category that is being displayed on the dropdown list
//        if (location.pathname == "/") {
//              $(".dropdown").text("Top Stories");
//        }else if (location.pathname == "/latest") {
//              $(".dropdown").text("Latest Stories");
//         } else if (location.pathname == "/politics") {
//            $(".dropdown").text("Politics");
//         } else if (location.pathname == "/entertainment") {
//               $(".dropdown").text("Entertainment");
//         } else if (location.pathname == "/sports") {
//         $(".dropdown").text("Sports");
//         }else if (location.pathname == "/metro") {
//                       $(".dropdown").text("Metro");
//          }else if (location.pathname == "/nigeria") {
//                         $(".dropdown").text("Nigeria");
//                    }

//this is used for the back-to-top button
    var offset = 1200;  var offset2=8;
    var duration = 700;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);

        } else {
            $('.back-to-top').fadeOut(duration);

        }


        if ($(this).scrollTop() > offset2) {
            $("#toFloat").show();
            $("#toFloat").css('position','fixed');
        }else{
            $("#toFloat").hide();
        }


    });

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

    $(document).ready(function(){
        $("#toFloat").hide();
    });

     $('aside').click( function(e) {
            $(this).scrollTop(0);
        });


    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49109646-1', 'auto');
      ga('send', 'pageview');
    </script>

    </body>
</html>
