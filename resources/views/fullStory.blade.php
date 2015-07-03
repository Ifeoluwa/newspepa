{{--{{json_encode($data)}}--}}
@extends('layout')

@section('title', 'story')
@endsection

@section('full_story')
@foreach($data['full_story'] as $full_story)
<?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
  <div class="row panel radius" style="padding:0.95rem">
      <div class="large-12 medium-12 small-12 columns" style="padding-bottom: 2.0rem">
          <span style="font: 24px Roboto; text-align: justify;font-weight:bolder">{{$full_story['title']}}.</span>
      </div><br/><br/>
      <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%; border-radius:2px"/></div>
      <div class="large-12 medium-12 small-12 columns"><p><p class="full-story-text">{{$full_story['description']}}...<a href="{{$full_story['url']}}" style="color: #333366">Continue to read</a></p></p>
      </div>
  </div>

   <footer class="footer">
      <div class="_2ip_" id="feedback_inline_896223087101322" data-sigil="mufi-inline">
      <div class="likecounter" id="counts_feedback">
      <a href="http://www.facebook.com/plugins/like.php?href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=#################" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;">
      <span class="likespan" id="u_6_i"><span>1 Like</span></span></a></div>
      <div class="shareboxdiv"><div class="sharebox">
      <a class="_15ko touchable _2q8z" href="http://www.facebook.com/plugins/like.php?href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=1681272065426030" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;" id="u_6_c" data-sigil="touchable unlike" data-autoid="autoid_63">Like</a></div>

      <div class="sharebox"><a class="_15kq" href="https://twitter.com/share?url={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&text={{$full_story['title']}}&via=newspepa" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Tweet</a></div>
      <div class="sharebox"><a class="_15kr" data-store="{&quot;share_id&quot;:896223087101322,&quot;feedback_source&quot;:1,&quot;behavior&quot;:&quot;custom&quot;}" href="https://www.facebook.com/dialog/share?app_id=1681272065426030&display=popup&href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-sigil="share-popup">Share</a></div></div></div></footer>
@endforeach
@stop

@section('noImageStory')
@foreach()
@stop
@section('related_content')
<div class="row panel radius"><b>RECENT STORIES</b></div>


<div class="large-12 small-12 medium-12 columns">
@foreach($data['recent_stories'] as $recent_stories)
 <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
 <a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
    <div class="row panel radius"style="padding-right: 0.4rem">
    <div class="large-3 small-3 medium-3 columns"style="padding:0.3rem"><img src="{{$recent_stories['image_url']}}" width="100px" height="100px"/></div>
    <span class="recent-stories-text">{{$recent_stories['title']}}.</span>
    </div></a>

 @endforeach
</div>

@stop

  {{--<span><b>{{$recent_stories['title']}}.</b></span>--}}
  {{--<div class="row panel radius"><b>Latest in Category</b></div>--}}
    {{--<div class="row panel radius"><b>Other Sources</b></div>--}}
