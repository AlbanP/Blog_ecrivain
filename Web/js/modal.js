$(function(){
    $("form").submit(function(e){
        e.preventDefault();
        var $form = $(this);
        console.log($form);
        $.post($form.attr("action"), $form.serialize())
        .done(function(data) {
            $(".response").html(data);
            if (!data){
                $("#form").modal("hide");
                location.reload();
            } 
        })
        .fail(function() {
            alert("Probléme...");
        });
    });
});



