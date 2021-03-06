// Update User 
$('.updateUser').on('click' ,function(e) {
    e.preventDefault();
        var data = $(this).parent().data();
        $('#saveUser h3').text('Modification de l\'utilisateur " ' + data.name + ' "');
        $('#formUser').attr('action', '/admin/user-update.html');
        $('#formUser .user_id').attr('value', data.user_id);
        $('#formUser .name').attr('value', data.name);
        $('#formUser .name').attr('readonly', 'readonly');
        $('#formUser .email').attr('value', data.email);
        $('#saveUser').modal('show');
});

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
    dataCheck = { 'id':$(this).parent().data('user_id'), 'href': $(this).data('href')};
    $('#checkUser h3').text(action + ' de "' + name + '"');
    $('#checkUser').modal('show');
    $('#pass').focus();
    return dataCheck;
}
/* Check password user Ajax */
function checkPass(user) {
    var pass = $('#pass').val();
    var dataUser = null;
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

/* Validate save and update user */
$(document).ready(function(){
    $("#formUser").validate({
        rules: {
            name : "required",
            passUser: "required",
            confirmPass : {
                required : true,
                equalTo : "#passUser"
            }
        },
        messages: {
            name : "Champs obligatoire.",
            passUser : "Champs obligatoire.",
            confirmPass : {
                required : "",
                equalTo : "Les mots depasse ne sont pas identique."
            }
        }
    });
});
