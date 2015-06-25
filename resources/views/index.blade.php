
@extends('layout')
@section('title', 'Top Stories')
@stop
@section('image_url')
<a href="fullStory"><img width="300" height="169" src="{{$data['timeline_stories']['important'][0]['image_url']}}"/></a>
@endsection
@section('story_title')
<p><p><a href="fullStory"><strong>{{$data['timeline_stories']['important'][0]['title']}}</strong></a></p></p>
@endsection
@section('time_release')
5hrs ago
@endsection

@section('small_image_url')
<a href="fullStory2"><img width="300" height="194" src="{{$data['timeline_stories']['others'][0]['image_url']}}"/></a>
@endsection
@section('story_title_here')
<p><a href="fullStory2"><strong>{{$data['timeline_stories']['others'][0]['title']}}</strong></a></p>
@endsection
@section('time_release')
5hrs ago{{$data['timeline_stories']['others'][0]['created_date']}}
@endsection


@section('noImage_storyTitle')
<p><a href="fullStory3"><strong>Choosing Between A Chromebook And A Large Android Tablet</strong></a></p>
@endsection
@section('noImage_releaseTime')
7hrs ago
@endsection