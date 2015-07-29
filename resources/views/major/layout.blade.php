<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
    @yield('more-meta')
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="ui_newspaper/img/favicon2.ico" />
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
     <link rel="stylesheet" href="ui_newspaper/css/app22.css" />
    <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
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

    <div class="off-canvas-wrap" data-offcanvas>
      <div class="inner-wrap">

        <a href="{{url('/')}}"><nav class="tab-bar" data-options="sticky_on: small" data-tab-bar role ="navigation" >

          <div class="left-small" data-options="sticky_on: small">
            <a href="#idOfLeftMenu" role="button" aria-controls="idOfLeftMenu" aria-expanded="false" class="left-off-canvas-toggle menu-icon" ><span></span></a>
          </div>

        </nav>
        </a>
        <!-- Off Canvas Menu -->
        <aside class="left-off-canvas-menu">
            <!-- whatever you want goes here -->
             <ul class="off-canvas-list">
                  <li id="1"><label>Newspepa</label></li>
                  <li id="1"><a href="{{url('/')}}">Top stories</a></li>
                  <li id="2"><a href="{{url('/latest')}}">Latest stories</a></li>
                  <li id="3"><a href="{{url('nigeria')}}">Nigeria</a></li>
                  <li id="4"><a href="{{url('entertainment')}}">Entertainment</a></li>
                  <li id="5"><a href="{{url('sports')}}">Sports</a></li>
                  <li id="6"><a href="{{url('politics')}}">Politics</a></li>
                  <li id="7"><a href="{{url('metro')}}">Metro</a></li>
          </ul>
        </aside>


        <!-- main content goes here -->

      <!-- close the off-canvas menu -->

    {{--the search bar--}}
    <form id="searchbar" method="get" action = "search">
        {{--<div class="row searchbar-row" style="width:100%">--}}
            <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" placeholder="Search News..." name="search_query" spellcheck="false" aria-label="search" style="font-size:16px" required></div>
            <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
        {{--</div>--}}
    </form>



    {{--this is the categories dropdown; asides the categories included in the navigation tab--}}

        {{--<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">@yield('dropdown')</button>--}}
        {{--<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">--}}
       <div class="row " style="background-color: #0266C8">
        <ul class="inline-list category-row">

          {{--<li id="1" ><a href="{{url('/')}}">Top stories</a></li>--}}
          <li id="2"><a href="{{url('/latest')}}">Latest</a></li>
          <li id="3" class="active"><a href="{{url('nigeria')}}">Nigeria</a></li>
          <li id="4"><a href="{{url('entertainment')}}">Entertainment</a></li>
          <li id="4"><label href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">More</label>
            <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
            <li><a href="{{url('business')}}">Business</a></li>
            <li><a href="{{url('sports')}}">Sports</a></li>
            <li id="6"><a href="{{url('politics')}}">Politics</a>
            <li id="7"><a href="{{url('metro')}}">Metro</a>
            </ul>
          </li>

          {{--<li id="5"><a href="{{url('sports')}}">Sports</a></li>--}}
          {{--<li id="6"><a href="{{url('politics')}}">Politics</a></li>--}}
          {{--<li id="7"><a href="{{url('metro')}}">Metro</a></li>--}}

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

              @yield('publishers')

              @yield('about')

              </div>


              <a href="#" class="back-to-top" style="display: inline;"></a>


<a class="exit-off-canvas"></a>

      </div>
    </div>

    <footer class="row" >
        {{--<div class="large-12 columns" style="border-top: solid #E0E0E0 2px">--}}
        <ul class="small-block-grid-2" style="color:#0266C8; line-height: 0.8">
           <li><label>Categories</label></li>
           <li><label>News Sources</label></li>
          <li id="1" ><a href="{{url('/')}}">Home</a></li>
          <li id="1" ><a href="{{url('/punch')}}">Punch</a></li>
           <li id="2"><a href="{{url('/latest')}}">Latest stories</a></li>
           <li id="2"><a href="{{url('/vanguard')}}">Vanguard</a></li>
           <li id="3"><a href="{{url('politics')}}">Politics</a></li>
           <li id="3"><a href="{{url('linda-ikeji')}}">Linda Ikeji</a></li>
           <li id="3">
           {{--<a href="#" data-options="align:top" data-dropdown="drop">More &raquo;</a>--}}
                <a href="#" data-options="align:top" data-dropdown="drop">More&raquo;</a>
                {{--<ul id="drop" class="[tiny small medium large content]f-dropdown" data-dropdown-content>--}}
                {{--<li><a href="#">This is a link</a></li>--}}
                {{--<li><a href="#">This is another</a></li>--}}
                {{--<li><a href="#">Yet another</a></li>--}}
                {{--</ul>--}}
           </li>
           <li id="3"><a href="#" data-options="align:top" data-dropdown="drop">More&raquo;</a></li>
        </ul>

{{--<ul class="inline-list" style="color:#0266C8">--}}
                  {{--<li id="1" ><a href="{{url('/')}}">Home</a></li>--}}
                  {{--<li id="2"><a href="{{url('/latest')}}">Latest stories</a></li>--}}
                  {{--<li id="3"><a href="{{url('politics')}}">Politics</a></li>--}}
                  {{--<li id="4"><a href="{{url('nigeria')}}">Nigeria</a></li>--}}
                  {{--<li id="5"><a href="{{url('entertainment')}}">Entertainment</a></li>--}}
                  {{--<li><a href="{{url('business')}}">Business</a></li>--}}
                  {{--<li id="6"><a href="{{url('sports')}}">Sports</a></li>--}}
                  {{--<li id="7"><a href="{{url('metro')}}">Metro</a></li>--}}
            {{--</ul>--}}
            {{--<p style="margin-left: 20px"><a href="">Choose your news source</a></p>--}}

        {{--</div>--}}
    </footer>
    <script src="ui_newspaper/js/vendor/jquery.js"></script>
    <script src="js/foundation/foundation.offcanvas.js"></script>
    <script src="js/foundation/foundation.dropdown.js"></script>
    <script src="ui_newspaper/js/vendor/fastclick.js"></script>
    <script src="ui_newspaper/js/foundation.min.js"></script>
    <script src="ui_newspaper/get_social_counts/site.js"></script>

    <script>
        $(document).foundation();

        //var next_page_url, prev_page_url, new_url;
       // $(document).ready(function(){
// var root = document.documentElement;
//            root.className += " minor-mini";
//         $("a[rel='prev']").append("<span>Previous</span>");
//         $("a[rel='next']").append("<span>Next</span>")
//        });
//            $.ajax({
//                type:"GET",
//                url:"http://localhost:8000/stories_json",
//                success:function(result){
//                console.log(result)
//                var page_id= result.current_page;
//                next_page_url= "http://localhost:8000/?page=2";
//                prev_page_url=result.prev_page_url;
//                var prev_text="Previous";
//                var next_text="Next";
//                $('#next').append('<a href="'+next_page_url+'">'+next_text+'</a>');
//                }
//            })
//            new_url= jQuery.param.querystring(window.location.href,'page=3');
//            alert(new_url);
//        });

//        function rto detect if minor browser is being used

//ajax call for getting number of linkouts of specific a tags
            $('[name= "linkOuts"]').click(function(event) {
             var storyID = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url:'http://newspepa.com/linkout/'+storyID,
                    success: function(msg){
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
    })

//    $('#home').click(function(event){
//    $('html,body').scrollTop(0);
//    });


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
