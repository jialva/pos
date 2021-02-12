$(function(){
    validarapertura();
})

function validarapertura(){
    $.ajax({
        url:url+'registrarcaja/validarapertura',
        success:function(response){
            if(response=='si'){
                $("#bloquemensaje").hide();
                $("#bloqueformulario").show();
            }else{
                $("#bloqueformulario").hide();
                $("#bloquemensaje").show();
            }
        }
    })
}