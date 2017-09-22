
function loadComment(){
    var postId = parseInt($('#post').attr('name'));
    $.post(
        '/comment-listAjax.html' ,
        {id: postId} ,
        function(html){ $('#listCommentAjax').replaceWith(html);},
        'html')
};
loadComment();
setTimeout(loadComment(), 5000);

$(".commentResponse").on('click', function(){
    $(".commentForm").children().remove();
    $(this).hide();
    $(this).next().next().load("/comment-insertAjax.html"); 
});

$(".commentCancel").on('click', function(){
    $(".commentForm").children().hide();
});

$("#submitComment").on('click', function(e){
    e.preventDefault();
    var postId = parseInt($('#post').attr('name'));
    var commentParentId = $(this).parent(".comment").attr('name') ;
    var author = $('Form .author').val();
    var content = $('Form .content').val();
    if(author != "" && content != ""){
        $.post(
            '/comment-insertAjax.html',
            {
            postId: postId,
            commentParentId: commentParentId,
            author: author,
            content: content
            },
            function(){$(".commentForm").children().remove();},
            'text');
    };
    loadComment();
});
