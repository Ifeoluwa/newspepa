@extends('major.layout')
@foreach($data['full_story'] as $full_story2)
@section('title', $full_story2['title'])
@endsection
@endforeach


{{--@section('dropdown',$data['category_names'][$full_story2['category_id']])--}}
{{--@endsection--}}


@section('more-meta')
<?php $tc = new \App\Http\Controllers\TimelineStoryController();
  ?>
<meta property="og:title" content= "{{$full_story2['title']}} | Newspepa.com"/>
<meta property="og:image" content= "{{$full_story2['image_url']}}"/>
<meta property="og:description" content= "{{$full_story2['description']}}"/>
<meta property="og:url" content= "{{url($tc->makeStoryUrl($full_story2['title'], $full_story2['story_id']))}}"/>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('full_story')
@foreach($data['full_story'] as $full_story)

<?php $tc = new \App\Http\Controllers\TimelineStoryController();
  ?>
        <div class="row panel radius">
            <div class="large-12 medium-12 small-12 columns" style="padding-bottom: 2.0rem">
              <span class="full-story-title">{{$full_story['title']}}</span><br/>
              <span class="publisher-name">{{$data['publisher_names'][$full_story['pub_id']]}}</span>
              <span class="label" style="margin-top:6px; margin-bottom:1px">{!!$tc->getTimeDifference($full_story['created_date'])!!} </span>
            </div>
            <br/><br/>

              @if($full_story['image_url'] != "")
              <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%; border-radius:2px"/></div>
              @endif
              <div class="large-12 medium-12 small-12 columns"><p><p class="full-story-text">{{$full_story['description']}}...<a id="{{$full_story['story_id']}}"  href="{{url('linkout?id='.$full_story['story_id']."&url=".$full_story['url'])}}" style="color: #0266C8" target="_blank">Continue to read</a></p></p>
              </div>
               {{--<div>--}}

                    {{--<div class="fb-share-button" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count"></div>--}}
                     {{--<div class="fb-like" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>--}}
                     {{--<span style="line-height: 1"><a href="whatsapp://send?text= {{$full_story['title']}} | {{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}"><img src="ui_newspaper/img/whatsapp.png " width="65px" height="25px"/></a></span>--}}
                     {{--<a data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" style="font-size: 14px">Other sources&raquo; </a>--}}
                     {{--<ul id="drop1" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">--}}
                       {{--<li><a href="#">This is a link</a></li>--}}
                       {{--<li><a href="#">This is another</a></li>--}}
                       {{--<li><a href="#">Yet another</a></li>--}}
                     {{--</ul>--}}
                {{--</div>--}}
                <hr>
                <ul class="inline-list" style="overflow: visible">
                  <li><a href="#"><div class="fb-share-button" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count"></div>
                  </a>
                                     </li>
                  <li><a href="#"><span style="line-height: 1"><a href="whatsapp://send?text= {{$full_story['title']}} | {{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}"><img src="ui_newspaper/img/whatsapp.png " width="65px" height="25px"/></a></span>
                  </a>
                  </li>
                  <li><a id="comment-link"><img src="{{url('ui_newspaper/img/comment.jpg')}}" style="width: 30px"> {{count($comments)}}</a></li>
                </ul>

        </div>

        <div id="comments-box" hidden="hidden">

               <div id="people_comments">
                                 {{--Comments are displayed here--}}

                                 @if(count($comments) > 0)
                                     @foreach($comments as $comment)
                                       <div class="row panel radius">
                                           <div class="small-3 medium-3 columns"><strong style="color: #008744">{{$comment['user_name']}}</strong></div>
                                           <div class="small-9 medium-9 columns" >{{$comment['comment']}}</div>
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
                              <textarea placeholder="Comment" id="comment" name="comment" required="required"></textarea>
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
@stop


@section('other_sources')
@if(count($data['other_sources']) > 0)
<div class="row panel radius related-content"><b>Other sources</b></div>
@foreach($data['other_sources'] as $other_sources)
    <div class="row panel radius">
        <a name="linkOuts" id="{{$other_sources['id']}}" href="{{$other_sources['url']}}"> <span>{{$data['publisher_names'][$other_sources['pub_id']]}} | {{$other_sources['title']}}</span></a>
    </div>
@endforeach
@endif
@stop



@section('related_content')
<div class="row panel radius related-content">Latest stories in {{$data['category_names'][$full_story['category_id']]}}</div>
@foreach($data['recent_stories'] as $recent_stories)
        <div class="row panel radius">

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
           <span class="publisher-name">{{$data['publisher_names'][$recent_stories['pub_id']]}}</span>
           <span class="timecount-name">{{$tc->getTimeDifference($recent_stories['created_date'])}}</span>
                  </div>
    </a>
    </div>

</div>

@endforeach

{{--<div class="row panel radius">--}}
{{--<ul class="inline-list">--}}
{{--<li  style="color:#dc4218; font-weight: bold; font-size:18px">Tell a friend about newspepa</li>--}}
{{--<li><div style="position:relative; margin-bottom: 6px"><div class="fb-share-button" data-href="https://newspepa.com/" data-layout="button_count" style="float:right"></div></div></li>--}}
{{--</ul>--}}
{{--</div>--}}
 @stop

@section('more-scripts')

@include('partials.commentScript')
@stop
