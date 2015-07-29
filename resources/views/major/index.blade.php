@extends('major.layout')
@section('title', 'Newspepa | Breaking Nigerian News From Top Sites')
@stop
@section('dropdown','Top Stories')
@stop

@section('important_stories')
    @foreach($data['timeline_stories']['top_stories'] as $top_story)
    <?php $tc = new \App\Http\Controllers\TimelineStoryController();
    ?>
            <div class="row panel radius">
              <div class="large-12 medium-6 small-12 columns">
                                <a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                                 @if($top_story['image_url']!="")
                                     <div class="image" style="background-image: url('{{$top_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                                 @endif
                                      <div class="text-details"><a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                                      <header class="title-holder">
                                     @if($top_story['image_url'] == "")
                                       <h1 class="title">{{$top_story['title']}}</h1>
                                       @else
                                          <h1 class="title title-important">{{$top_story['title']}}</h1>
                                      @endif
                                      </header></a>
                                       <span class="publisher-name">{{$data['publishers_name'][$top_story['pub_id']]}}</span>
                                      {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$top_story['category_id']]}}</b></span>--}}
                                       <span class="timecount-name">{{$tc->getTimeDifference($top_story['created_date'])}}</span>
                                  </div>
                                </a>
                                </div>

              </div>
            @endforeach


            {!! $data['paginator']->render() !!}
@stop
