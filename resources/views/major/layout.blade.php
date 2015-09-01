<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
    @yield('more-meta')
    <title>@yield('title') | Newspepa</title>
    <link rel="shortcut icon" href="ui_newspaper/img/favicon2.ico" />
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
     <link rel="stylesheet" href="ui_newspaper/css/app27.css" />
     <link rel="stylesheet" href="ui_newspaper/css/test.css" />
    <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
    {{--<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>--}}
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
    <div class="off-canvas-wrap">
      <div class="inner-wrap">
        <div class="header">
            <nav class="tab-bar" data-offcanvas>

                <section class="middle tab-bar-section">
                    <div class="small-9 medium-9 columns">
                      <a href="{{url('/')}}"> <h1 class="title"></h1></a></div>
                    <div class="small-2 columns" style="overflow-x:visible">
                      <div id="searchChange" class="search-prompt" style="float:right"></div>
                      {{--<div class="close-search" style="float:right"></div>--}}
                    </div>
                </section>

                {{--<section class="right tab-bar-section">--}}
                      {{--<h1>Foundation 5 test</h1>--}}
                      {{--<h1 class="searchbutton"></h1>--}}
                {{--</section>--}}
                {{--<div class="left-small" data-options="sticky_on: small">--}}
                 {{--<a href="#idOfLeftMenu" role="button" aria-controls="idOfLeftMenu" aria-expanded="false" class="left-off-canvas-toggle menu-icon" ><span></span></a>--}}
                {{--</div>--}}
                 <section class="right-small" data-options="sticky_on: small">
                      <a href="#idOfRightMenu" role="button" class="right-off-canvas-toggle menu-icon" aria-controls="idOfRightMenu" aria-expanded="false" ><span></span></a>
                 </section>

            </nav>
             <div class="large-12 small-12 medium-12 columns search-column">
                       <form id="searchbar" method="get" action = "search">
                              <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" placeholder="Search News..." name="search_query" spellcheck="false" aria-label="search" style="font-size:16px" required></div>
                              <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
                      </form>
                   </div>
        </div>

        <!-- Off Canvas Menu -->
        <aside class="right-off-canvas-menu">
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
                      <ul class="right-submenu" style="position:inherit">
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
             </ul>
        </aside>

      <!-- close the off-canvas menu -->

    {{--the search bar--}}

       <article class="large-12 small-12 medium-12 columns">


    {{--this is the categories dropdown; asides the categories included in the navigation tab--}}

        {{--<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">@yield('dropdown')</button>--}}
        {{--<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">--}}
       <div id="category-list" class="row category-row" style="overflow: visible">
          <div class="small-12">
            <ul class="inline-list">
              <li id="first-child"><a href="{{url('/latest-news-in-nigeria')}}">Latest</a></li>
              <li id="2" class="active"><a href="{{url('latest-nigeria-news-in-nigeria')}}">Nigeria</a></li>
              <li id="3"><a href="{{url('latest-entertainment-news-in-nigeria')}}">Entertainment</a></li>
              <li id="more"><label href="#" data-dropdown="drop" aria-controls="drop" aria-expanded="true" class="button dropdown">More</label>
                <ul id="drop" data-dropdown-content class="f-dropdown" aria-hidden="true">
                <li><a href="{{url('latest-business-news-in-nigeria')}}">Business</a></li>
                <li><a href="{{url('latest-sports-news-in-nigeria')}}">Sports</a></li>
                <li id="6"><a href="{{url('latest-politics-news-in-nigeria')}}">Politics</a>
                <li id="7"><a href="{{url('latest-metro-news-in-nigeria')}}">Metro</a>
                </ul>
              </li>

            </ul>
      </div>
        </div>

{{--the stories containers starts from here--}}

          {{--<div class="large-12 small-12 columns" id="stories_container">--}}

             @yield('trending stories')
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





        {{--</div>--}}



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

                       {{--<ul id="drop1" class="tiny f-dropdown" data-dropdown-content>--}}
                                       {{--<li><a href="#">This is a link</a></li>--}}
                                       {{--<li><a href="#">This is another</a></li>--}}
                                       {{--<li><a href="#">Yet another</a></li>--}}
                                       {{--</ul>--}}
                      {{--</li>--}}

        </ul>
        {{--<div class="row" style="text-align: center"><a id="feedback">Click here to give us some feedback</a></div>--}}
            {{--<div id="fdbk-rvl" class="row" style="display:none">--}}
                {{--<div class="large-12 small-12 medium-12 columns" style="padding-left: 20px;padding-right: 20px">--}}
                    {{--<textarea class="textarea" placeholder="Enter Feedback" id="comment" name="comment" required="required"></textarea>--}}
                {{--</div>--}}
                {{--<div class="large-12 small-12 medium-12 columns" style="padding-left: 20px;padding-right: 20px; margin-top:10px">--}}
                    {{--<button id="feedbackBtn" type="button" class="button radius small searchbar-button">Submit</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </footer>

    {{--<a href="#" class="back-to-top" style="display: inline;"></a>--}}
    </article>
    <a class="exit-off-canvas"></a>

       </div>
   </div>




     {{--<a href="{{url('/')}}"><div class="panel" id="toFloat">--}}
        {{--<div class="name-m"></div>--}}
    {{--</div></a>--}}


    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="ui_newspaper/js/foundation/foundation.offcanvas.js"></script>
    <script src="ui_newspaper/js/foundation/foundation.dropdown.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>

    <script>
        $(document).foundation();

//this is used for the back-to-top button
    var offset = 1200;
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
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

//click event to unhide the search bar

$('.search-prompt').click(function() {
  var clicks = $(this).data('clicks');
  if (clicks) {
     $(".search-column").css('display','none');
     $(".category-row").css('margin-top','65px');
  } else {
  $(".category-row").css('margin-top','105px');
  $(".search-column").css('display','inherit');
  }
  $(this).data("clicks", !clicks);
});

//click event to handle the feedback column
$('#feedback').click(function() {
$("#fdbk-rvl").css('display','inherit');
});



//click event to change the search background icon
var searchObj, className,search_column, index;

searchObj = document.getElementById('searchChange');
search_column=document.getElementsByClassName('search-column')
index = 1;
className = [
    'search-prompt',
    'close-search'
];

function updateIndex(){
    if(index === 0){
        index = 1;
    }else{
        index = 0;
    }
}

searchObj.onclick = function(e){
    e.currentTarget.className = className[index];
    updateIndex();
}


    </script>
    <script>
    //ajax call for getting number of linkouts of specific a tags

                $('.linkOut').click(function(event) {

                var token = $(this).data('token');
                 var storyID = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        dataType:"jsonp",
                        url:'http://newspepa.com/linkout/'+storyID,
                        data:{_token :token},
                        success: function(msg){
                            alert(msg);
                        }
                    })

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
    @yield('more-scripts')

    </body>
</html>
