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
            } else if (lastId == 0 && noComment) {
            	$('#listComment #comments').append('<p id="noComment">Soyez le premier à laisser un commantaire !<p>');
            	noComment = false;
            }
        },             
        dataType : 'json'
    });
    
    reloadComment()
}
function showComment(comment){
    var comment_length = comment.length;
    var arrowImg = null;
    for (var i = 0; i < comment_length; i++) {
        var parentId = comment[i]["parentId"];
        if (parentId == null) { 
            parentId = 0;
        	arrowImg = "/img/arrow.png";
            commentArticle = commentBuild();
            $('#listComment #comments').prepend(commentArticle);
        } else {
            arrowImg = "/img/arrowResponse.png";
            commentArticle = commentBuild();
        	$(commentArticle).insertAfter($('#listComment #' + comment[i]["parentId"] ));
        }
 
        lastId = comment[i]["id"];

        function commentBuild() {
        var session = $('#session').attr('name');
        var d = comment[i]["date"].split(/[- :]/);
        var date = d[2] + '/' + d[1] + '/'+ d[0] + ' à ' + d[3] + 'h' + d[4];
        var commentArticle  = '<div class="media borderTop">';
        commentArticle += '<div class="media-left"><img src="' + arrowImg + '" class="media-object" style="width:35px"></div>';
        commentArticle += '<div class="media-body">';
        commentArticle += '<p class="media-heading titlePost">' + comment[i]["author"] + '<span class="dateItem">  le ' + date + '</span></p>' ;
        if (comment[i]["moderate"] == 1) {
            commentArticle += '<p>Ce commentaire a été modéré.<p>'
        } else {
            commentArticle += '<p class="commentContent">' + comment[i]["content"].replace(/\n/g, "<"+"br/>") + '</p>';
        }
        commentArticle += '<div id="' + comment[i]["id"] + '" name="' + comment[i]["parentId"] + '">';
        if (comment[i]["report"] == 1 && comment[i]["moderate"] == 0) {
            commentArticle += '<span class="label label-info margRight15">Message signalé </span>';
        } else if(session == null) {
            commentArticle += '<div>'
            commentArticle += '<a type="button" class="commentAdd btn btn-xs btnComments" style="margin-right: 5px"> Répondre </a>';
            commentArticle += '<a type="button" class="btn btn-xs btn-warning" data-confirm="Si vous considérez que ce message est inapproprié, validez pour nous en avertir." data-action="commentReport" data-id-item="' + comment[i]["id"] + '" data-name="' + comment[i]["author"] + '" data-title="Signalement du message de"  > Signaler </a>';
            commentArticle += '</div>'
        }
        if (session != null){
            commentArticle += '<div class="iconMenu">'
            if (comment[i]["moderate"] == 0) {
                commentArticle += '<a class="commentAdd text-warning"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Répondre"></span></a>';
                commentArticle += '<a class="commentModerate text-danger margLeft15"><span class="glyphicon glyphicon-thumbs-down" data-toggle="tooltip" title="Modérer"></span></a>';
                if (comment[i]["report"] == 1) {
                    commentArticle += '<a class="commentUnreport text-success margLeft15"><span class="glyphicon glyphicon-thumbs-up" data-toggle="tooltip" title="Accepter"></span></a>';
                }
            }
            commentArticle += '<a class="text-danger margLeft15" data-confirm="Suppression du commentaire et des éventuelles commentaires liés (réponse). Validez pour confirmer." data-action="commentDelete" data-id-item="' + comment[i]["id"] + '" data-name="' + comment[i]["author"] + '" data-title="Supression du (et des) commentaire(s) de"><span class="glyphicon glyphicon-remove data-toggle="tooltip" title="Supprimer""></span></a>';      
            commentArticle += '</div>'
        }
        commentArticle += '</div></div></div>';    
        
        return commentArticle;
        }
    }
};
var timerLoadComment;
function reloadComment(){
	timerLoadComment = setTimeout(loadComment, 5000);
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
    $(".commentAdd").show();
    var parentId = $(this).parent().parent().attr('id');
    $('#formComment').attr('data-parentId', parentId);
    $(this).parent().parent().after($('#formComment'));
    $("#formComment").show();
    $('body').animate({scrollTop: $(this).parent().offset().top - 200}, 300);
    $(this).hide();
    $('#commentAuthor').focus();
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
    var parentId = $(this).parent().parent().parent().attr('data-parentId');
    var author = $('#commentAuthor').val();
    var content = $('#commentContent').val();
    if(author != "" && content != ""){
        $.post(
            '/comment-add.html',
            {
            'postId': postId,
            'parentId': parentId,
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
    $(".commentAdd").show();
    setTimeout(loadComment, 50);
});

// Report & Moderate comment
$("body").on('click', ".commentReport", function(e){
    e.preventDefault();
    var id = $(this).data('id-item');
    $.post(
        '/comment-report.html',
        { 'id': id }
    );
    $('#'+ id + '> div').remove();
    $('#'+ id).prepend('<span class="label label-info margRight15"> Message signalé </span>');
    $('#dataConfirmModal').modal('toggle');
});

$("body").on('click', ".commentUnreport", function(e){
    e.preventDefault();
    var id = $(this).parent().parent().attr('id');
    $.post(
        '/admin/comment-unreport.html',
        { 'id': id }
    );
    if ($(document).attr('title') == "Tableau de bord"){
        $('#'+ id).hide();
    } else {
        $(this).parent().parent().children('span').hide();
        $(this).hide();
    }
});

$("body").on('click', ".commentModerate", function(e){
    e.preventDefault();
    var id = $(this).parent().parent().attr('id');
    $.post(
        '/admin/comment-moderate.html',
        { 'id': id }
    );
    if ($(document).attr('title') == "Tableau de bord"){
        $('#'+ id).remove();
    } else {
        $(this).parent().parent().children('span').hide();
        $(this).parent().parent().children('.commentUnreport').hide();
        $(this).parent().parent().children('.commentAdd').hide();
        $(this).parent().parent().parent().children('.commentContent').replaceWith('<p>Ce commentaire a été modéré.</p>');
        $(this).hide();
    }
});

// Delete Comment
$("body").on('click', ".commentDelete", function(e){
    e.preventDefault();
    var id = $(this).attr('idItem');
    $.post(
        '/admin/comment-delete.html',
        { 'id': id }
    );
    $('#'+ id).parent().parent().remove();
    $('#dataConfirmModal').modal('toggle');
});

// link Comment 
$(window).load(function(){
    var anchor = window.location.hash;
    if (anchor) {
        setTimeout (function(){
            if (anchor == '#listComment'){
                $('html,body').animate({scrollTop: $(anchor).offset().top}, 'slow');
            } else {
                $('html,body').animate({scrollTop: $(anchor).parent().parent().parent().offset().top}, 'slow');
            }
            }
        , 50)
    }
});
