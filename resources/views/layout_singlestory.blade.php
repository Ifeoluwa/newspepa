@extends('layout')

@section('title', 'Top stories')
@endsection
@yield('story_container')
  <div class="row panel radius">
      <div class="large-12 medium-12 small-12 columns">
          <p><strong>@yield('storyheadline')</strong></p>
      </div>
      <div class="large-12 medium-12 small-12 columns">@yield('image_url')</div>
      <div class="large-12 medium-12 small-12 columns">@yield('story_content')</div>
  </div>
@endsection
@section('related_content')
  <div class="row panel radius"><b>Other Sources</b></div>
  <div class="row panel radius"><b>Related Stories</b></div>
  <div class="row panel radius"><b>Latest in Category</b></div>
@endsection