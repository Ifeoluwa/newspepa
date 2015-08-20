@extends('minor.opera-layout')
@foreach($data['full_story'] as $full_story2)
@section('title', $full_story2['title'])
@endsection
@endforeach

@section('more-meta')
<?php $tc = new \App\Http\Controllers\TimelineStoryController();
  ?>
<meta property="og:title" content= "{{$full_story2['title']}} | Newspepa.com"/>
<meta property="og:image" content= "{{$full_story2['image_url']}}"/>
<meta property="og:description" content= "{{$full_story2['description']}}"/>
<meta property="og:url" content= "{{url($tc->makeStoryUrl($full_story2['title'], $full_story2['story_id']))}}"/>

@endsection

@section('full_story')
@foreach($data['full_story'] as $full_story)

<?php $tc = new \App\Http\Controllers\TimelineStoryController();
  ?>
  <div class="row opera-panel radius">
       <div class="large-12 medium-12 small-12 columns" style="padding-bottom: 2.0rem">
          <span class="full-story-title">{{$full_story['title']}}</span><br/>
          <span class="publisher-name">{{$data['publisher_names'][$full_story['pub_id']]}}</span>
          <span class="label" style="margin-top:6px; margin-bottom:1px">{!! $tc->getTimeDifference($full_story['created_date'])!!} </span>

       </div><br/><br/>
      @if($full_story['image_url'] != "")
      <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%; border-radius:2px"/></div>
      @endif
      <div class="large-12 medium-12 small-12 columns"><p><p class="full-story-text">{{$full_story['description']}}...
      @if($full_story['url'] != "" || $full_story['pub_id'])
            <a id="{{$full_story['story_id']}}"  href="{{url('linkout?id='.$full_story['story_id']."&url=".$full_story['url'])}}" style="color: #0266C8" target="_blank">Continue to read</a></p></p>
      @endif
      </div>
      <hr/>
       <div class="large-12 small-12 medium-12 columns" style="padding-left: 25px">
         <a class="fbicon" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="box_count"></a>
         <a class="twitterIcon" target="_blank" href="https://twitter.com/home?status={{$full_story['title']}} at {{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}"></a>
         <a class="whatsappIcon" href="whatsapp://send?text= {{$full_story['title']}} | {{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}"></a>
         <a id="comment-link" style="font-size: 22px"><img src="{{url('ui_newspaper/img/join-conversation.png')}}" style="width: 45px; margin-bottom: 8px;"> {{count($comments)}}</a>
       </div>
  </div>

  <div id="comments-box" hidden="hidden">
                <div>
                  <div id="people_comments">
                  {{--Comments are displayed here--}}

                  @if(count($comments) > 0)
                      @foreach($comments as $comment)
                        <div class="row panel callout radius">
                            <div class="small-2"><strong>{{$comment['user_name']}}</strong></div>
                            <div class="small-10">{{$comment['comment']}}</div>
                        </div>
                      @endforeach
                  @else
                      <blockquote>Be the first to comment on this.</blockquote>

                  @endif


                  </div>
                  <div id="notification_box">
                  {{--Displays notification when user posts comment--}}
                  </div>

                  <form id="commentForm" action="{{url('story/')}}" method="post" target="commentFrame">
                      {!! csrf_field() !!}
                  <div class="row">
                      <div class="large-12 columns">

                      <input id="user_name" type="text" name="user_name" placeholder="Your name" required="required" />

                      </div>
                    </div>
                    <div class="row" hidden>
                      <div class="large-12 columns">

                      <input type="text" id="story_id" name="story_id" value="{{$full_story['story_id']}}" required="required" />

                      </div>
                    </div>
                        <div class="row">
                          <div class="large-12 columns">
                            <div class="row collapse">
                              <div class="small-12 columns">
                                <textarea placeholder="Comment" id="comment" name="comment" required="required" rows="3"></textarea>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="large-12 columns">
                                <button id="commentPostBtn" type="button" class="button radius searchbar-button">Submit</button>

                          </div>
                        </div>

                  </form>

                 </div>

            </div>

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
               <!-- Medium Rect1 -->
               <ins class="adsbygoogle"
                    style="display:inline-block;width:300px;height:250px"
                    data-ad-client="ca-pub-7757748461663124"
                    data-ad-slot="2137550091"></ins>
               <script>
               (adsbygoogle = window.adsbygoogle || []).push({});
               </script>


@endforeach
@endsection


@section('other_sources')
@if(count($data['other_sources']) > 0)
<div class="row opera-panel minors related-content"><b>other sources</b></div>
@foreach($data['other_sources'] as $other_sources)
    <div class="row opera-panel minors">
   <a name= linkOuts id="{{$other_sources['story_id']}}" href="{{$other_sources['url']}}"> <span>{{$data['publisher_names'][$other_sources['pub_id']]}}|{{$other_sources['url']}}</span></a>
    </div>
@endforeach
@endif
@stop

@section('related_content')
<div class="row opera-panel radius related-content">Latest stories in {{$data['category_names'][$full_story['category_id']]}}</div>
@foreach($data['recent_stories'] as $recent_stories)
        <div class="row opera-panel radius">

     <div class="large-12 medium-6 small-12 columns">
    <a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
     @if($recent_stories['image_url']!="")
         <div class="image" style="background-image: url('{{$recent_stories['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
     @endif
          <div class="text-details"><a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
          <header class="title-holder">
         @if($recent_stories['image_url'] == "")
           <h1 class="title-timeline">{{$recent_stories['title']}}</h1>
           @else
              <h1 class="title-timeline title-important">{{$recent_stories['title']}}</h1>
          @endif
          </header></a>
           <span class="publisher-name"><b>{{$data['publisher_names'][$recent_stories['pub_id']]}}</b></span>
           <span class="timecount-name"><b>{{$tc->getTimeDifference($recent_stories['created_date'])}} </b></span>
      </div>
    </a>
    </div>
             
</div>

@endforeach
 @stop

@section('more-scripts')
@include('partials.commentScript')
@stop

