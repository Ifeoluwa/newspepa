@extends('layout')

@section('title', 'NewsPepa | Home')
@show

@section('header_content')
@endsection


  <div class="row news-item" >
    @yield('news_content')
      <div class="large-12 small-12 columns">
          <div class="row panel radius">
          @yield('mostImportant')
              <div class="large-12 small-12 columns">@yield('image_url')</div>
              <div class="large-12 small-12 columns">@yield('story_title')
              </div>
              {{--img src="http://placehold.it/300x300&text=[img]"--}}
             <span class="label">@yield('time_release')</span>
          </div>
          <br>

          <div class="row panel radius">
          @yield('lessImportant')
              <div class="large-5 small-6 columns">@yield('small_image_url')</div>
              <div class="large-7 small-6 columns">@yield('story_title_here')
                  {{--<ul class="inline-list">--}}
                      {{--<li><a href="">Reply</a></li>--}}
                      {{--<li><a href="">Share</a></li>--}}
                  {{--</ul>--}}


                  {{--<h6>2 Comments</h6>--}}
                  {{--<div class="row">--}}
                      {{--<div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>--}}
                      {{--<div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>--}}
                  {{--</div>--}}
                  {{--<div class="row">--}}
                      {{--<div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>--}}
                      {{--<div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>--}}
                  {{--</div>--}}
              </div>
              <span class="label">@yield('time_release')</span>
          </div>



          {{--<hr/>--}}


          <div class="row panel radius">
          @yield('noImage')
              {{--<div class="large-2 columns small-3"><img src="http://placehold.it/100x100&text=[img]"/></div>--}}
              <div class="large-12 columns small-12">@yield('story_title')
                  {{--<ul class="inline-list">--}}
                      {{--<li><a href="">Reply</a></li>--}}
                      {{--<li><a href="">Share</a></li>--}}
                  {{--</ul>--}}
              </div>
              <span class="label">@yield('time_release')</span>
          </div>


              </div>
          </div>

    @extends ('layout_footer')
    @section('footer_content')
    @endsection
      {{--</div>--}}

   <footer class="row">
        <div class="large-12 columns">
            <hr/>
            <div class="row">
                <div class="large-5 columns">
                    <p>© NewsPepa.</p>
                </div>
                {{--<div class="large-7 columns">--}}
                    {{--<ul class="inline-list right">--}}
                        {{--<li><a href="#">Section 1</a></li>--}}
                        {{--<li><a href="#">Section 2</a></li>--}}
                        {{--<li><a href="#">Section 3</a></li>--}}
                        {{--<li><a href="#">Section 4</a></li>--}}
                        {{--<li><a href="#">Section 5</a></li>--}}
                        {{--<li><a href="#">Section 6</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
    </footer>
