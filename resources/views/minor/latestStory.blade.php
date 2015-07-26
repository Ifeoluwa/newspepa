@extends ('minor.opera-layout')
@section('title', 'Breaking Nigerian News From Top Sites')
 @stop

 @section('dropdown','Latest Stories')
 @stop

 @section('important_stories')
 <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
     @foreach($data['latest_stories'] as $latest_stories)
          <div class="row opera-panel radius">
                <div class="large-12 medium-6 small-12 columns">
                     <a href="{{url($tc->makeStoryUrl($latest_stories['title'], $latest_stories['story_id']))}}">
                        @if($latest_stories['image_url']!="")
                            <div class="image" style="background-image: url('{{$latest_stories['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                        @endif
                      <div class="text-details"><a href="{{url($tc->makeStoryUrl($latest_stories['title'], $latest_stories['story_id']))}}">
                      <header class="title-holder">
                     @if($latest_stories['image_url'] == "")
                       <h1 class="title">{{$latest_stories['title']}}</h1>
                       @else
                          <h1 class="title title-important">{{$latest_stories['title']}}</h1>
                      @endif
                      </header></a>
                       <span class="publisher-name">{{$data['publishers_name'][$latest_stories['pub_id']]}}</span>
                      {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$latest_stories['category_id']]}}</b></span>--}}
                       <span class="timecount-name">{{$tc->getTimeDifference($latest_stories['created_date'])}}</span>
                  </div>
                </a>
                </div>

</div>
            @endforeach
            @stop