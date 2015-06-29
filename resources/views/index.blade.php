{{--{{json_encode($data}}--}}

@extends('layout')
@section('title', 'Top Stories')
@stop

@section('important_stories')

    @foreach($data['timeline_stories']['important'] as $important_story)
         <div class="row panel radius">
                  <div class="large-12 small-12 columns">
                  <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
                  <a href="{{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}"><img width="300" height="194" src="{{$important_story['image_url']}}"/></a>
                  </div>
                  <div class="large-12 small-12 columns"><p><p><a href="{{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}"><strong>{{$important_story['title']}}</strong></a></p></p>
                  </div>
                  <span class="label">{{""}}</span>
                  <span class="label">{{$tc->getTimeDifference($important_story['created_date'])}}</span>
              </div>
            @endforeach
@stop

@section('less_important_stories')

    @foreach($data['timeline_stories']['less_important'] as $less_important_story)
    {{--@foreach($data['timeline_stories']['publishers_name'][$less_important_story['pub_id']] as $publisher_name)--}}
              <div class="row panel radius">
                  <div class="large-5 small-5 columns">
                    <a href="<?php echo ''?>"><img class="large-12 small-12" width="300" height="194" src="{{$less_important_story['image_url']}}"/></a>
                  </div>
                  <div class="large-7 small-7 columns">
                  <p><a href="fullStory2"><strong>{{$less_important_story['title']}}</strong></a></p>

                  <p><a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}"><strong>{{$less_important_story['title']}}</strong></a></p>

                  </div>
                  <span class="label">{{$less_important_story['no_of_reads']}}reads|{{$less_important_story['pub_id']}}|{{$tc->getTimeDifference($less_important_story['created_date'])}}</span>

                    <?php $date1 = new DateTime(strtotime($less_important_story['pub_date']));
                                            $date2 = new DateTime();
                                            $diff = $date1->diff($date2);
                    ?>
                     <span class="label">{{$less_important_story['no_of_reads']}}reads|{{$less_important_story['pub_id']}}|{{$diff->format('%a Day and %h hours')}}</span>
                     <span class="label"><b>{{$data['publishers_name'][$less_important_story['pub_id']]}}</b></span>
                     {{--[$less_important_story['pub_id']]}}</span>--}}
               </div>
    @endforeach
@stop


@section('stories_with_no_images')
    @foreach($data['timeline_stories']['no_image'] as $no_image_story)
              <div class="row panel radius">
                  {{--<div class="large-12 small-12 columns">--}}
                    {{--<a href="fullStory2"><img width="300" height="194" src="{{$no_image_story['image_url']}}"/></a>--}}
                  {{--</div>--}}
                  <div class="large-12 small-12 columns">
                  <p><a href="{{url($tc->makeStoryUrl($no_image_story['title'], $no_image_story['story_id']))}}"><strong>{{$no_image_story['title']}}</strong></a></p>

                  </div>
                  <span class="label">{{$tc->getTimeDifference($no_image_story['created_date'])}}</span>
              </div>
    @endforeach
@stop
