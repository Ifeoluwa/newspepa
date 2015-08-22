 <div id="people_comments" class="row panel radius">
                                 {{--Comments are displayed here--}}
                                 @if(count($comments) > 0)
                                    <?php $comment_counter = 0;
                                        foreach($comments as $comment){
                                        ?>
                                         <div class="large-12 medium-12 small-12 columns">
                                            <span class="publisher-name" style="margin-top:1px;"><strong>{{$comment['user_name']}}</strong></span>
                                             <span class="label" style="margin-top:1px; margin-bottom:1px">{!!$tc->getTimeDifference($comment['created_date'])!!} </span>
                                        </div>
                                        <div class="large-12 medium-12 small-12 columns" style="padding-bottom: 5px;padding-top:5px">{{$comment['comment']}}</div>
                                        <hr/>
                                        <?php $comment_counter += 1;
                                            if($comment_counter >= 3){
                                                $remaining_comments = count($comments) - 3;
                                                if($remaining_comments === 0){

                                                }elseif($remaining_comments === 1){
                                                   echo "<p class='text-center moreBtn'><button class='button tiny'>View 1 comment</button></p>";
                                                }else{
                                                    echo "<p class='text-center moreBtn'><button class='button tiny'>View ".$remaining_comments." comments</button></p>";
                                                }
                                            ?>
                                            <?php
                                               break;
                                            }
                                         ?>

                                        <?php
                                        $more_comments = array_slice($comments, 3);
                                        }
                                        foreach($more_comments as $comment){
                                        ?>
                                        <section id="moreComments" hidden>
                                        <div class="large-12 medium-12 small-12 columns">
                                            <span class="publisher-name" style="margin-top:1px;"><strong>{{$comment['user_name']}}</strong></span>
                                             <span class="label" style="margin-top:1px; margin-bottom:1px">{!!$tc->getTimeDifference($comment['created_date'])!!} </span>
                                        </div>
                                        <div class="large-12 medium-12 small-12 columns" style="padding-bottom:2px;padding-top:2px">{{$comment['comment']}}</div>
                                        <hr/>
                                        </section>

                                        <?php
                                        }

                                    ?>
                                  @else
                                     <p>Be the first to comment on this.</p>

                                 @endif
                </div>