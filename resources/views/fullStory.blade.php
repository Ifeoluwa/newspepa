{{--{{json_encode($data)}}--}}
@extends('layout')

@section('title', 'Top stories')
@endsection
@foreach($data as $full_story)
@section('full_story')
  <div class="row panel radius">
      <div class="large-12 medium-12 small-12 columns">
          <b>{{$full_story['title']}}.</b>
      </div>
      <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%"/></div>
      <div class="large-12 medium-12 small-12 columns"><p><p style="line-height: 1.5;text-align:justify;text-justify:inter-word">{{$full_story['description']}}...<a href="{{$full_story['url']}}" style="color: #4C9ED9">Continue to read</a></p></p>
      </div>
  </div>
@endsection
@section('related_content')
  <div class="row panel radius"><b>Other Sources</b></div>
  <div class="row panel radius"><b>Related Stories</b></div>
  <div class="row panel radius"><b>Latest in Category</b></div>
@endsection
@endforeach