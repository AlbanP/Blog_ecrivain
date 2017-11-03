
/* Modal */
$('body').on('click' ,'a[data-confirm]' ,function(e) {
    var action = $(this).attr('action');
    var href = $(this).attr('actionHref');
    var id = $(this).attr('idItem');
    var title = $(this).attr('titleModal');
    var message = $(this).attr('data-confirm')
    var name = $(this).attr('nameId');
    
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
    
    return false;
});

/* Tooltip */
$('body').on('mouseover','[data-toggle="tooltip"]',function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
