 <!doctype html>
 <html class="no-js" lang="en">
    <head>
     <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale = 1,maximum-scale=1 user-scalable=no" />
        <link rel="shortcut icon" href="ui_newspaper/img/favicon.ico" />
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
    <select>
        <option value="nigeria" id="1"><a href="{{url('/')}}"> Top Stories </a></option>
        <option value="latest" id="2"><a href="{{url('/latest')}}"> Latest Stories</a></option>
        <option value="nigeria" id="3"><a href="{{url('/nigeria')}}"> Nigeria</a></option>
        <option value="entertainment" id="4"><a href="{{url('/entertainment')}}"> Entertainment</a></option>
        <option value="sports" id="5"><a href="{{url('/sports')}}"> Sports</a></option>
        <option value="politics" id="6"><a href="{{url('/politics')}}"> Politics</a></option>
        <option value="metro" id="7"><a href="{{url('/metro')}}"> Metro</a></option>
    </select>
    </body>
    </html>