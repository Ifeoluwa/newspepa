@extends('major.layout')
@section ("title", "Latest ".$data['category_stories']['category_name']." news In Nigeria Today")
@endsection


@section('more-meta')

<meta property="og:title" content= "Latest {{$data['category_stories']['category_name']}} News In Nigeria Today"/>
 <meta property="og:description" content= "Latest breaking {{$data['category_stories']['category_name']}} news in nigeria today"/>
 <meta property="og:url" content= {{$data['category_stories']['category_route']}}/>
@endsection

<?php $i=0;
 ?>

@section('important_stories')
 @foreach($data['category_stories']['all'] as $category_story)
        <div class="row panel radius">
         <div class="large-12 medium-6 small-12 columns">
            <?php $tc = new \App\Http\Controllers\TimelineStoryController();
                     $i = $i + 1;
                 ?>
                 <a href="{{url($tc->makeStoryUrl($category_story['title'], $category_story['story_id']))}}">
                    <div class="image_container">
                    @if($category_story['image_url'] != "")
                       <div class="image" style="background-image: url('{{$category_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                    @endif
                        <div class="text-details"><a href="{{url($tc->makeStoryUrl($category_story['title'], $category_story['story_id']))}}">
                         <header class="title-holder">
                         @if($category_story['image_url'] == "")
                         <h1 class="title-timeline">{{$category_story['title']}}</h1>
                         @else
                            <h1 class="title-timeline title-important">{{$category_story['title']}}</h1>@endif
                         </header></a>
                         <span class="publisher-name">{{$data['publishers_name'][$category_story['pub_id']]}}</span>
                         <span class="timecount-name">{{$tc->getTimeDifference($category_story['created_date'])}}</span>
                       </div>
                    </div>
                           </a>

         </div>
      </div>
        <?php
              if($i==14){
              ?>
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- Medium Rect1 -->
                  <ins class="adsbygoogle"
                       style="display:inline-block;width:300px;height:250px"
                       data-ad-client="ca-pub-7757748461663124"
                       data-ad-slot="2137550091"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
              <?php
              }
              elseif($i==29){
              ?>
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- Medium Rect2 -->
                  <ins class="adsbygoogle"
                       style="display:inline-block;width:300px;height:250px"
                       data-ad-client="ca-pub-7757748461663124"
                       data-ad-slot="3614283293"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
              <?php
              }
              elseif($i==44){
                      ?>
                     <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                     <!-- Medium Rect3 -->
                     <ins class="adsbygoogle"
                          style="display:inline-block;width:300px;height:250px"
                          data-ad-client="ca-pub-7757748461663124"
                          data-ad-slot="8044482891"></ins>
                     <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                     </script>

              <?php
              }

               ?>
  @endforeach
  {!! $data['paginator']->render() !!}
@stop
