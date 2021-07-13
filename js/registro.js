function disponible(nickname) {
    $.ajax({
        url : 'config/user_NKdisponible.php',
        type : 'POST',
        dataType : 'html',
        data : { nickname: nickname },
        })

        .done(function(resultado){
        if(resultado == "Disponible"){
            $("#disponible").text(resultado);
            $("#disponible").css({'color':'#45932CFF'});
        }
        else{
            $("#disponible").text(resultado);
            $("#disponible").css({'color':'#D1322DFF'});
        }

    })
}

$(document).on('keyup', '#IDConductor', function(){
    var nickname = $(this).val();
    disponible(nickname);
});

$(document).ready(function() {
    $(".container form [name=pass2]").on("blur", function() {
        if ($(".container  form [name=pass]").val() != $(this).val()) {
            this.setCustomValidity("Las contraseñas no coinciden");
        } else {
            this.setCustomValidity("");
        }
    });
});
