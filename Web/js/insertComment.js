/*$('.formComment').on('click', function(){
	$('.formComment').after('<form>');
});
*/
function loadComment(){
    setTimeout( function(){
    	var postId =""
    	$.get(
    		'../../App/Frontend/Modules/Blog/BlogController.php',
    		'false',
    		Listcomment(),
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
    		message : message 
    		},
    		loadComment(),
    		'text');
    };
});

charger();