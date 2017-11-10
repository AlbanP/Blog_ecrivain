/* Modal confirm */
$('body').on('click' ,'a[data-confirm]' ,function(e) {
    var action = $(this).data('action');
    var href = $(this).data('href');
    var id = $(this).data('id-item');
    var title = $(this).data('title');
    var message = $(this).data('confirm');
    var name = $(this).data('name');
    
    $('#dataConfirmLabel').text(title + ' "' + name + '"');
    $('#dataConfirmModal .modal-body').text(message);
    if (action != null) {
        $('#modal-valid-href').hide();
        $('#modal-valid-action').show();
        $('#modal-valid-action').removeClass().addClass('btn btn-warning ' + action);
        $('#modal-valid-action').attr('data-id-item', id);
    } else {
        $('#modal-valid-action').hide();
        $('#modal-valid-href').show();
        $('#modal-valid-href').attr('href', href);
    } 

    $('#dataConfirmModal').modal({show:true});
    $('#dataConfirmModal .btn-warning').focus();
    
    return false;
});

/* Tooltip */
$('body').on('mouseover','[data-toggle="tooltip"]',function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
