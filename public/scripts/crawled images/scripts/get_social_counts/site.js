$(document).ready(function(){
		get_social_counts();
		//maybe_some_other_functions_too();
	});
    		

function get_social_counts() {
	var thisUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
	$.ajax({
		type: "GET",
		url: 'http://newspepa.com/scripts/get_social_counts.php?thisurl='+thisUrl,
		dataType: "json",
		success: function (data){
			$('a.post-share.twitter span').html(data.twitter);
			$('a.post-share.facebook span').html(data.facebook);
			$('a.post-share.gplus span').html(data.gplus);
			$('a.post-share.stumble span').html(data.stumble);
		}
	});
}
