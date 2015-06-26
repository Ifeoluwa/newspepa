{{--{{json_encode($data)}}--}}
@extends('layout')
@section('title', 'Top Stories')
@stop

@section('important_stories')

    @foreach($data['timeline_stories']['important'] as $important_story)
              <div class="row panel radius">
                  <div class="large-12 small-12 columns">
                  <a href="fullStory2"><img width="300" height="194" src="{{$important_story['image_url']}}"/></a>
                  </div>
                  <div class="large-12 small-12 columns"><p><p><a href="fullStory.blade.php"><strong>{{$important_story['title']}}</strong></a></p></p>
                  </div>
                  <?php $date1 = new DateTime(strtotime($important_story['pub_date']));
                        $date2 = new DateTime();
                        $diff = $date1->diff($date2);
                   ?>
                  <span class="label">{{$diff->format('%a Day and %h hours')}}</span>
                  {{--<span class="label">{{$important_story['pub_date']}}</span>--}}
              </div>
              {{--<br>--}}
    @endforeach
@stop

@section('less_important_stories')
    @foreach($data['timeline_stories']['others'] as $less_important_story)
              <div class="row panel radius">
                  <div class="large-5 small-5 columns">
                    <a href="fullStory2"><img class="large-12 small-12" width="300" height="194" src="{{$less_important_story['image_url']}}"/></a>
                  </div>
                  <div class="large-7 small-7 columns">
                  <p><a href="fullStory2"><strong>{{$less_important_story['title']}}</strong></a></p>

                  </div>
                  <div>
                     <span class="label">{{$less_important_story['pub_date']}}</span>
                  </div>
               </div>
              <br>
    @endforeach
@stop


{{--@section('stories_with_no_images')--}}
    {{--@foreach($data['timeline_stories']['others'] as $less_important_story)--}}
    {{--@foreach($data['timeline_stories']['no_image_story'] as $no_image_story)--}}
              {{--<div class="row panel radius">--}}
                  {{--<div class="large-12 small-12 columns">--}}
                    {{--<a href="fullStory2"><img width="300" height="194" src="{{$no_image_story['image_url']}}"/></a>--}}
                  {{--</div>--}}
                  {{--<div class="large-12 small-12 columns">--}}
                  {{--<p><a href="fullStory2"><strong>{{$no_image_story['title']}}</strong></a></p>--}}

                  </div>
                  <span class="label">{{$no_image_story['pub_date']}}</span>
              </div>
              <br>
    @endforeach
@stop
