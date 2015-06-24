@extends('layout_header')

@section('title', 'NewsPepa|Welcome')
@show


@section('header_content')
@endsection


  <div class="row news-item">
    @yield('news_content')
      <div class="large-12 small-12 columns">
          <div class="row panel radius">
              <div class="large-6 small-12 columns"><a href="fullStory"><img src="http://placehold.it/300x300&text=[img]"/></a></div>
              <div class="large-6 small-12 columns">
                  <p><a href="fullStory"><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation.</a></p>
              </div>

          </div>
          <br>
          <div class="row panel radius">
              <div class="large-3 small-4 columns"><a href="fullStory"><img src="http://placehold.it/100x100&text=[img]"/></a></div>
              <div class="large-9 small-8 columns">
                   <p><a href="fullStory"><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation.</a></p>
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
          </div>
          <br/>


          {{--<hr/>--}}


          <div class="row panel radius">
              {{--<div class="large-2 columns small-3"><img src="http://placehold.it/100x100&text=[img]"/></div>--}}
              <div class="large-12 columns small-12">
                  <p><a href="fullStory">Some Person said:Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</a></p>
                  {{--<ul class="inline-list">--}}
                      {{--<li><a href="">Reply</a></li>--}}
                      {{--<li><a href="">Share</a></li>--}}
                  {{--</ul>--}}
              </div>
          </div>


              </div>
          </div>

    @extends ('layout_footer')
    @section('footer_content')
    @endsection
      {{--</div>--}}
