@extends('layout_header')

@section('title', 'NewsPepa|FullStory')
@section('header_content')
@endsection

<div class="row news-item">
    @yield('story_container')
      <div class="large-12 medium-12 small-12 columns">
          <div class="row panel radius">
          <div class="large-12 medium-12 small-12 columns">
          <p><strong>@yield('storyheadline')</strong></p></div>
          <div class="large-12 medium-12 small-12 columns">@yield('image_url')</div>
          <div class="large-12 medium-12 small-12 columns">
          @yield('story_content')
          </div>
       </div>
       </div>
</div>
@extends('layout_footer')
@section('footer_content')
@endsection