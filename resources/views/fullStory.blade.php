{{--{{json_encode($data)}}--}}
@extends('layout')

@section('title', 'story')
@endsection
@foreach($data['full_story'] as $full_story)
@section('full_story')
  <div class="row panel radius" style="padding:0.95rem">
      <div class="large-12 medium-12 small-12 columns" style="font-size:20px">
          <b>{{$full_story['title']}}.</b>
      </div><br/><br/>
      <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%; border-radius:2px"/></div>
      <div class="large-12 medium-12 small-12 columns"><p><p style="line-height: 1.5;text-align:justify;text-justify:inter-word">{{$full_story['description']}}...<a href="{{$full_story['url']}}" style="color: #333366">Continue to read</a></p></p>
      </div>
  </div>
@endsection
@section('related_content')
{{--@foreach($data['recent_stories'] as $recent_stories)--}}
  <div class="row panel radius"><b>Other Sources</b></div>
  <div class="row panel radius"><b>Related Stories</b></div>
  <div class="row panel radius"><b>Latest in Category</b></div>
@endsection
@endforeach