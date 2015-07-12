<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
    <title>NewsPepa| @yield('title')</title>
    <link rel="stylesheet" href="ui_newspaper/css/foundation.css" />
    <link rel="stylesheet" href="ui_newspaper/css/normalize.css" />
    <link rel="stylesheet" href="ui_newspaper/css/app10.css" />
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
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=222521117951114";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
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
    <form id="searchbar" method="get" action = "search">
    <div class="row searchbar-row" style="width:100%">
            <div class="large-8 medium-8 small-10 columns"style="padding-right:0;padding-left:0; border-color:#ffffff"><input class="searchbar-input-text" type="text" results="7" placeholder="Search News..." name="search_query" autocomplete="on" aria-autocomplete="both" aria-haspopup="true" spellcheck="false" aria-label="search"></div>
            <div class="large-4 medium-4 small-2 columns" style="padding-right:0;padding-left:0"><button type="submit" class="searchbar-button searchbutton"></button></div>
              </div>
    </form>
              </div>



    {{--this is the categories dropdown; asides the categories included in the navigation tab--}}

    <div class="large-12 medium-12 small-12 columns">

        <button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="true" class="button dropdown">@yield('dropdown')</button></div>
        <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
          <li id="1" ><a href="{{url('/')}}">Top stories</a></li>
          <li id="1" ><a href="{{url('/')}}">Latest stories</a></li>
          <li id="2" class="active"><a href="{{url('entertainment')}}">Entertainment</a></li>
          <li id="3"><a href="{{url('politics')}}">Politics</a></li>
          <li id="4"><a href="{{url('sports')}}">Sports</a></li>
          <li id="5"><a href="{{url('nigeria')}}">Nigeria</a></li>
          <li id="6"><a href="{{url('metro')}}">Metro</a></li>
        </ul>

{{--the stories containers starts from here--}}

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

              <a href="#" class="back-to-top" style="display: inline;"></a>



    <footer class="row">
        <div class="large-12 columns">
            <hr/>
            <div class="row">
                <div class="large-5 columns">
                    <p style="text-align: center;  ">

                        <i class="newspepaicon"> </i>  © 2015 Iconway</p>
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
        var last_page, current_page, next_page_url;
        $(document).ready(function(){
        var story_url = 'http://localhost:8000/stories_json'

        var prev_page_url;

            $.ajax({
                      type: "GET",
                      url: story_url,
                      dataType: 'json',

                       success: function (result) {
                      next_page_url= result.next_page_url;
                      last_page=result.last_page;
                      current_page=result.current_page;
              }

                          });
        });


        var isPreviousEventComplete= true;
        var isDataAvailable= true;
        $(window).scroll(function () { //When user clicks
	    if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
	         alert("last");

            if(current_page!=last_page){
//////	isPreviousEventComplete=false;
//////	//$(".LoaderImage").show();
            stories = "";
            $.ajax({
                  type: "GET",
                  url: next_page_url,
                  dataType: 'json',

                       success: function (result) {
                              for(var i=0; i<result.data.length; i++){
                                stories += "<?php echo 'something' ?>"
                              }
                              $("#stories_container").append(stories);
                              isPreviousEventComplete = true;
                              },
                                error: function (error) {
                                    alert(error);
                                }
              });

	}
	}
	});



        if (location.pathname == "/") {
              $(".dropdown").text("Top Stories");
         } else if (location.pathname == "/politics") {
            $(".dropdown").text("Politics");
         } else if (location.pathname == "/entertainment") {
               $(".dropdown").text("Entertainment");
         } else if (location.pathname == "/sports") {
         $(".dropdown").text("Sports");
         }else if (location.pathname == "/metro") {
                       $(".dropdown").text("Metro");
          }else if (location.pathname == "/nigeria") {
                         $(".dropdown").text("Nigeria");
                    }




    var offset = 1000;
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })


    </script>

    </body>
</html>
