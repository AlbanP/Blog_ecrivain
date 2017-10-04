// Show comments
var lastId = 0;
var noComment = true;

function loadComment(){
    var postId = parseInt($('#postId').attr('name'));
    $.ajax({
        url :  '/comment-show.html' ,
        type : 'POST',
        data : 'postId=' + postId + '&lastId=' + lastId,
        success : function(comment){ 
            if (comment != 0){ 
                $('#noComment').remove();
                showComment(comment);
            } else if (lastId === 0 && noComment) {
            	$('#listComment li').append('<p id="noComment">Soyez le premier à laisser un commantaire !<p>');
            	noComment = false;
            }
        },             
        dataType : 'json'
    });
    reloadComment()
}
function showComment(comment){
    var comment_length = comment.length;
    for (var i = 0; i < comment_length; i++) {
    	var commentArticle  = '<article id="' + comment[i]["id"] + '" name="' + comment[i]["parentCommentId"] + '">';
        commentArticle += '<p class="media-heading" >' + comment[i]["author"] + '</p><span> le ' + comment[i]["date"]+ '</span>';
        commentArticle += '<p class="media-body">'+comment[i]["content"]+'</p>';
        commentArticle += '<div><bouton class="commentAdd" type="button" name="' + comment[i]["id"] + '" >Répondre</bouton>';
        commentArticle += '<bouton class="commentReport" type="button" name="' + comment[i]["id"] + '" >Signaler</bouton>';
        commentArticle += '<div class="commentForm" name="' + comment[i]["id"] + '"></div>';
        commentArticle += '</div></article>';
        if (comment[i]["parentCommentId"] == 0){
        	$('#listComment li').append(commentArticle);
        } else {
        	if ($('#listComment li').find('#' + comment[i]["parentCommentId"] + ' .articleChild') != 0){
	        	var startArticle = '<div class="media thumbnail articleChild">';
	        	commentArticle = startArticle + commentArticle;
	        	commentArticle += '</div>';
        	}
        	$(commentArticle).appendTo($('#listComment #' + comment[i]["parentCommentId"]));
        }
        lastId = comment[i]["id"];
    }
};
var timerLoadComment;
function reloadComment(){
	timerLoadComment = setTimeout('loadComment()', 5000);
}
function stopReloadComment(){
	clearTimeout(timerLoadComment);
}
$(loadComment());

// Add comment action 
$("#formComment").hide();

$("#listComment").on('click', ".commentAdd",function(e){
    e.preventDefault();
    stopReloadComment();
    $(this).parent().after($('#formComment'));
    $("#formComment").show();
    $(this).hide(); 
});
$("#listComment").on('click', "#commentCancel", function (e){   
    e.preventDefault();
    $("#formComment").hide();
    $(".commentAdd").show();
    reloadComment();
});
$("#listComment").on('click', "#commentSubmit" ,function(e){
    e.preventDefault();
    var postId = parseInt($('#postId').attr('name'));
    var commentParentId = $(this).parent().parent().parent().attr('id') ;
    var author = $('#commentAuthor').val();
    var content = $('#commentContent').val();
    if(author != "" && content != ""){
        $.post(
            '/comment-add.html',
            {
            'postId': postId,
            'commentParentId': commentParentId,
            'author': author,
            'content': content
            },
            function(){
                $("#formComment").hide();
                $('#commentContent').val('');
                $(".commentResponse").show();
            },
            'text');
    };
    loadComment();
});

// Report comment
$("#listComment").on('click', ".commentReport", function(e){
    e.preventDefault();
    var id = parseInt($(this).attr('name'));
    $.post(
        '/comment-report.html',
        { 'id': id }
    );
});



