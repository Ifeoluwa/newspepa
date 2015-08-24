<div class="row row-trending">
        <div class="large-12 small-12 medium-12 columns heading-trending">
            <span class="span-trending">Trending on {{$data['category_stories']['category_name']}}</span>
        </div>
        <?php $counter = 1; ?>
        @foreach($data['category_stories']['trending'] as $trending)
        <div  id="{{'trend'.$counter}}" class="large-12 small-12 medium-12 columns column-trending">
            <a href="{{url($tc->makeStoryUrl($trending['title'], $trending['story_id']))}}"><span class="title-timeline" style="font-weight: normal">{{$trending['title']}}</span></a>
        </div>
        <?php $counter += 1; ?>
        @endforeach

    </div>