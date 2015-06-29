@extends ('layout')
@section('title', 'results')
@stop

<span style="font-size:x-large;text-align: center; font-family: Roboto ;float:center"><b>"Search Results"</b></span>

{{--the search results page also carries the same layout as the index page. Probably will be fetching from the timeline table. so carries
the important section, lessImportant and noImage stories--}}
@section('important_stories')
@endsection
@section('less_important_stories')
@endsection
@section('stories_with_no_images')
@endsection
@section('related_content')
  <div class="row panel radius"><b>Trending Searches</b></div>
  <div class="row panel radius"><b>Related Searches</b></div>
  <div class="row panel radius"><b>Latest in Category</b></div>
@endsection