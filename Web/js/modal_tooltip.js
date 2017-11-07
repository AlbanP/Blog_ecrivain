/* Modal confirm */
$('body').on('click' ,'a[data-confirm]' ,function(e) {
    var action = $(this).attr('data-action');
    var href = $(this).attr('data-actionHref');
    var id = $(this).attr('data-idItem');
    var title = $(this).attr('data-titleModal');
    var message = $(this).attr('data-confirm')
    var name = $(this).attr('data-nameId');
    
    $('#dataConfirmModal').remove();

    var modal = '<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">';
    modal += '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">';
    modal += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    modal += '<h3 id="dataConfirmLabel">' + title + ' "' + name + '"</h3></div>';
    modal += '<div class="modal-body">' + message + '</div>';
    modal += '<div class="modal-footer"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"> Annuler </button>';
    if (action != null) {
        modal += '<button type="submit" class="btn btn-warning ' + action + '" idItem="' + id + '"> Valider </button></div></div></div></div>';
    } else {
        modal += '<a href="' + href + '" type="submit" class="btn btn-warning"> Valider </a></div></div></div></div>';
    }
    $('body').append(modal);
    
    $('#dataConfirmModal').modal({show:true});
    $('#dataConfirmModal .btn-warning').focus();
    
    return false;
});

/* Modal checkUser */
$('.checkPass').on('click' ,function() {
    $('#message').hide();
    var id = $(this).parent().attr('id');
    var name = $(this).parent().data('name');
    var action = $(this).data('action');
    var href = $(this).data('href');
    $('#checkUser h3').text(action + ' de "' + name + '"');
    $('#checkUser').modal({show:true});
    $('#pass').focus(); 

    $('#formCheckPass').submit(function(e){
        e.preventDefault();
        var pass = $('#pass').val();
        $.post(
            href,
            { 
            'id': id,
            'pass': pass,
            },
            function(response){
                console.log(response);
                if (response == 'false'){
                    $('#message').show();
                    $('#pass').val('');
                    $('#pass').focus();
                } else {
                    $('#checkUser').modal('toggle');
                    location.reload(true);
                }
            },
        );
    });  
});


/* Tooltip */
$('body').on('mouseover','[data-toggle="tooltip"]',function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
