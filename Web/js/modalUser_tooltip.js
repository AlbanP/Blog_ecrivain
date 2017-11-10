/* Update User 
$('.updateUser').on('click' ,function(e) {
    e.preventDefault();
    var user = checkUser.apply(this);
    $('#formCheckPass').submit(function(e){
        e.preventDefault();
        var userData = checkPass(user);
        if (userData != null){
            $('#checkUser').modal('hide');
            $('#formSaveUser .userId').val(userData.id);
            $('#formSaveUser .name').val(userData.name);
            $('#formSaveUser .email').val(userData.email);
            $('#saveUser').modal('show');
        }
    });

});
*/
/* Delete User */
$('.deleteUser').on('click' ,function(e) {
    e.preventDefault();
    var user = checkUser.apply(this);
    $('#formCheckPass').submit(function(e){
        e.preventDefault();
        var userData = checkPass(user);
        if (userData != null){
            $('#checkUser').modal('toggle');
            location.reload(true);
        }
    });
});

/* Modal checkUser */
function checkUser() {
    var dataCheck = null;
    $('#message').hide();
    name = $(this).parent().data('name');
    action = $(this).data('action');
    dataCheck = { 'id':$(this).parent().attr('id'), 'href': $(this).data('href')};
    $('#checkUser h3').text(action + ' de "' + name + '"');
    $('#checkUser').modal('show');
    $('#pass').focus();
    console.log('checkUser :'+name);
    return dataCheck;
}

function checkPass(user) {
    var pass = $('#pass').val();
    var dataUser = null;
    console.log('pass id :'+ user['id']);
    $.ajax({
        type : 'POST',
        url : user['href'],
        data : { 
        'id': user['id'],
        'pass': pass,
        },
        async : false,
        success : function(response){
            if (response == 'false'){
                $('#message').show();
                $('#pass').val('');
                $('#pass').focus();
            } else {
                $('#pass').val('');
                dataUser = JSON.parse(response);
            }
        },
    });
    return dataUser;
}

/* Close modal */
$('.closeModal').on('click', function(e) {
    e.preventDefault();
    location.reload(true);
});


/* Tooltip */
$('body').on('mouseover','[data-toggle="tooltip"]',function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
