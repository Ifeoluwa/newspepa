 @extends('major.layout')
 @section('title', 'Breaking Nigerian News From Top Sites')
 @stop
  <?php $i=0;
 ?>
 @section('important_stories')
    @foreach($data['latest_stories'] as $latest_stories)
     <?php $tc = new \App\Http\Controllers\TimelineStoryController();
         $i = $i + 1;
     ?>
         <div class="row panel radius">
                <div class="large-12 medium-6 small-12 columns">
                     <a href="{{url($tc->makeStoryUrl($latest_stories['title'], $latest_stories['story_id']))}}">
                        @if($latest_stories['image_url']!="")
                            <div class="image" style="background-image: url('{{$latest_stories['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                        @endif
                      <div class="text-details"><a href="{{url($tc->makeStoryUrl($latest_stories['title'], $latest_stories['story_id']))}}">
                      <header class="title-holder">
                     @if($latest_stories['image_url'] == "")
                       <h1 class="title-timeline">{{$latest_stories['title']}}</h1>
                       @else
                          <h1 class="title-timeline title-important">{{$latest_stories['title']}}</h1>
                      @endif
                      </header></a>
                       <span class="publisher-name">{{$data['publishers_name'][$latest_stories['pub_id']]}}</span>
                      {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$latest_stories['category_id']]}}</b></span>--}}
                       <span class="timecount-name">{{$tc->getTimeDifference($latest_stories['created_date'])}}</span>
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