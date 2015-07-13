@extends ('layout')
@section('title', 'results')
@stop

{{--the search results page also carries the same layout as the index page. Probably will be fetching from the timeline table. so carries
the important section, lessImportant and noImage stories--}}
@if($search_results['found']!=0)
@section('important_stories')
<span class="title"><b>{{$search_results['found']}}Results found for '{{$search_results['search_query']}}'</b></span>
@foreach($search_results as $search_result)
<?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
<div class="large-12 medium-6 small-12 columns">
    <a href="{{url($tc->makeStoryUrl($search_result['title'], $search_result['story_id']))}}">
     @if($search_result['image_url']!="")
         <div class="image" style="background-image: url('{{$search_result['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
     @endif
          <div class="text-details"><a href="{{url($tc->makeStoryUrl($search_result['title'], $search_result['story_id']))}}">
          <header class="title-holder">
         @if($search_result['image_url'] == "")
           <h1 class="title">{{$search_result['title']}}</h1>
           @else
              <h1 class="title title-important">{{$search_result['title']}}</h1>
          @endif
          </header></a>
           <span class="publisher-name"><i class="newspapericon"></i><b>{{$data['publishers_name'][$search_result['pub_id']]}}</b></span>
          {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$top_story['category_id']]}}</b></span>--}}
           <span class="timecount-name"><i class="time-icon"></i><b>{{$tc->getTimeDifference($search_result['created_date'])}} ago</b></span>
      </div>
    </a>
    </div>
@endforeach
@endsection

@section('related_content')
  <div class="row panel radius related-content"><b>Trending Searches</b></div>
  <div class="row panel radius related-content"><b>Related Searches</b></div>
  {{--<div class="row panel radius"><b>Latest in Category</b></div>--}}
@endsection
@else
<span class="title"><b>Oops!No Results Found</b></span>
@endif


