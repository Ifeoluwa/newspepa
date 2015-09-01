<script>
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){
        //Shows or hides the comment box
        $('#comment-link').click(function(){
            $('#comments-box').toggle();
        });
        //Submits the comments for approval
        $('#commentPostBtn').click(function(){
            var story_id = $('#story_id').val();
            var comment = $('#comment').val();
            var user_name = $('#user_name').val();
            if(user_name !== "" && comment !== ""){
                var data = {  story_id: story_id , _token: '{!! csrf_token() !!}', user_name: user_name, comment: comment };

                $.post('story/comment', data, function(data){
                    if(data == true){
                      $('#notification_box').empty().append('<div data-alert class="alert-box success radius"> Thanks. Your comment has been submitted for approval.<a href="#" class="close">'+'&times;'+'</a></div>');
                       $('#user_name').val("");
                       $('#comment').val("");
                    }else{
                      $('#notification_box').empty().append('<div data-alert class="alert-box warning radius">Unable to submit your comment. Please try again later.<a href="#" class="close">'+'&times;'+'</a></div>');
                    }
                }, 'json').error(function(){
                      $('#notification_box').empty().append('<div data-alert class="alert-box danger radius">An error occured. Please try again later.<a href="#" class="close">'+'&times;'+'</a></div>');
                });

            }else{
                 $('#notification_box').empty().append('<div data-alert class="alert-box warning radius">Please fill all fields<a href="#" class="close">'+'&times;'+'</a></div>');
            }

        });

        $('.moreBtn').click(function(){
            $(this).hide();
            $('#moreComments').show();
        })
    });
</script>