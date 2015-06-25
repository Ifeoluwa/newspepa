@extends('layout')
@section('title', 'Top Stories')
@stop
@section('news_content')
@section('moreImportant')
@section('image_url')
<a href="fullStory"><img width="300" height="169" src="{{$data['timeline_stories']['important'][0]['image_url']}}"/></a>
@endsection
@section('story_title')
<p><p><a href="fullStory"><strong>{{$data['timeline_stories']['important'][0]['title']}}</strong></a></p></p>
@endsection
@section('time_release')
5hrs ago
@endsection

@section('lessImportant')
@section('small_image_url')
<a href="fullStory2"><img width="300" height="194" src="http://www.techsuplex.com/wp-content/uploads/2015/04/g4-fb-300x194.jpg"/></a>
@endsection
@section('story_title_here')
<p><a href="fullStory2"><strong>LG unveils the LG G4</strong></a></p>
@endsection
@section('time_release')
5hrs ago
@endsection

@section('noImage')
@section('story_title')
<p><a href="fullStory3"><strong>Choosing Between A Chromebook And A Large Android Tablet</strong></a></p>
@endsection
@section('time_release')
7hrs ago
@endsection