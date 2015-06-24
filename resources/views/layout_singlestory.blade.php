@extends('layout_header')

@section('title', 'NewsPepa|FullStory')
@section('header_content')
@endsection

<div class="row news-item">
    @yield('story_content')
      <div class="large-12 small-12 columns">
          <div class="row panel radius">
          <div class="large-12 small-12 columns">
          <p><strong>Bacon ipsum dolor sit amet nulla ham qui</strong></p></div>
          <div class="large-12 small-12 columns"><img src="http://placehold.it/300x300&text=[img]"/></div>
          <div class="large-12 small-12 columns">
          <p> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck
           duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.
           Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong
           Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong
           Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong</p>
          </div>
       </div>
       </div>
</div>
@extends('layout_footer')
@section('footer_content')
@endsection