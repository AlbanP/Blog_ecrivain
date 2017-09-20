/*$('.formComment').on('click', function(){
	$('.formComment').after('<form>');
});

function loadComment(){
    setTimeout( function(){
    	var postId = $('#comments p:first').attr('id');
    	$.get(
    		'BlogController.php?app=Frontend&module=Blog&action=Show',
    		'false',
    		function(html){ $('comments').prepend(html);},
    		'html');
        loadComment();
    }, 5000);
}
loadComment();


$("#submit").on(click, function(e){
    e.preventDefault();
    var author = encodeUriComponent($('#authorComment').val());
    var message = encodeUriComponent($('#messageComment').val());
    var parentCommentId;
    if(author != "" && message != ""){
    	$.post(
    		'../../App/Frontend/Modules/Blog/BlogController.php',
    		{
    		author : author,
    		content : message 
    		},
    		loadComment(),
    		'text');
    };
}); 
*/