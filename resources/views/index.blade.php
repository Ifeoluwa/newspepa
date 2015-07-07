{{--{{json_encode($data}}--}}

@extends('layout')
@section('title', 'Top Stories')
@stop

@section('important_stories')
    <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
    @foreach($data['timeline_stories']['top_stories'] as $top_story)
         <div class="row panel radius">
         @if($tc->getTimeDifference($top_story['created_date'])<=12)
                  <div class="large-12 medium-6 small-12 columns">
                  <a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                   @if($top_story['image_url']!="")
                       <div class="image" style="background-image: url('{{$top_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                   @endif
                        <div class="text-details"><a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                        <header class="title-holder">
                        <h1 class="title">{{$top_story['title']}}</h1>
                        </header></a>
                         <span class="publisher-name"><i class="newspapericon"></i><b>{{$data['publishers_name'][$top_story['pub_id']]}}</b></span>
                        <span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$top_story['category_id']]}}</b></span>
                         <span class="timecount-name"><i class="time-icon"></i><b>{{$tc->getTimeDifference($top_story['created_date'])}} ago</b></span>
                    </div>
                  </a>
                  </div>
              </div>

          @else
              <a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                   <div class="large-5 small-4 columns" style="width: 100%;">
                     @if($top_story['image_url']!="")
                       <div class="smallimage"><img width="120" height="100" src="{{$top_story['image_url']}}"/></div>
                     @endif
                           <a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                               <h1 class="title">{{$top_story['title']}} </h1>
                           </a>
                            <span class="publisher-name" style="float:left; margin-right: 170px"><i class="newspapericon"></i><b>{{$data['publishers_name'][$top_story['pub_id']]}}</b></span>
                            <span class="category-name"><i class="categoryicon"></i><b>category</b></span>
                            <span class="label" style="margin-top:6px; margin-bottom:12px"><i class="time-icon"></i>{{$tc->getTimeDifference($top_story['created_date'])}} ago</span>
                   </div>
              </a>
              @endif
            @endforeach
@stop
<script>
 $(window).scroll(function () {
    if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
        alert("End Of The Page");
    }
 });
</script>

{{--@section('less_important_stories')--}}
    {{--@foreach($data['timeline_stories']['less_important'] as $less_important_story)--}}
       {{--<div class="row panel radius">--}}
         {{--<a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}">--}}
          {{--<div class="large-5 small-4 columns" style="width: 100%;">--}}
             {{--<div class="smallimage"><img width="120" height="100" src="{{$less_important_story['image_url']}}"/></div>--}}

                  {{--<a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}">--}}
                   {{--<h1 class="title">{{$less_important_story['title']}} </h1>--}}
                   {{--</a>--}}

                {{--<span class="publisher-name" style="float:left; margin-right: 170px"><i class="newspapericon"></i><b>{{$data['publishers_name'][$less_important_story['pub_id']]}}</b></span>--}}
                {{--<span class="category-name"><i class="categoryicon"></i><b>category</b></span>--}}
                {{--<span class="label" style="margin-top:6px; margin-bottom:12px"><i class="time-icon"></i>{{$tc->getTimeDifference($less_important_story['created_date'])}} ago</span>--}}
                {{--</div>--}}
                {{--</a>--}}
{{--</div>--}}

{{--</div>--}}

{{--@endforeach--}}
{{--@stop--}}


{{--@section('stories_with_no_images')--}}
    {{--@foreach($data['timeline_stories']['no_image'] as $no_image_story)--}}
              {{--<div class="row panel radius">--}}
                  {{--<a href="{{url($tc->makeStoryUrl($no_image_story['title'], $no_image_story['story_id']))}}"><div class="large-12 small-12 columns">--}}
                  {{--<p><strong>{{$no_image_story['title']}}</strong></p>--}}
                   {{--<span class="publisher-name" style="float:left; margin-right: 170px"><i class="newspapericon"></i><b>{{$data['publishers_name'][$no_image_story['pub_id']]}}</b></span>--}}
                   {{--<span class="category-name"><i class="categoryicon"></i><b>category</b></span>--}}
                   {{--<span class="label">{{$tc->getTimeDifference($no_image_story['created_date'])}} ago</span>--}}

                  {{--</div>--}}
                  {{--</a>--}}
              {{--</div>--}}
    {{--@endforeach--}}
{{--@stop--}}

