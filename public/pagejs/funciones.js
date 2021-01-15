$(function(){
    //CargarCaptcha();
})

function modal(div,op){
  if(op == 'open'){
    $("#"+div).css('display','block');
  }else{
    if(op == 'close'){
      $("#"+div).css('display','none');
    }
  }  
}

function correovalido(email){
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(email) == false){
        return false;
    }else{
        return true;
    }
}

function tabla(id){
  $('#'+id).dataTable({
        "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap_alt",
        "oLanguage": {
            "sLengthMenu": "_MENU_ registros por pag",
            "sInfoEmpty": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "sInfo": "Mostrando_START_ a _END_ de _TOTAL_ Entradas",
            "sSearch": "Buscar:",
            "sZeroRecords": "Sin resultados encontrados",
            "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Ultimo",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
            }
        }
    });
}

function CargarCaptcha() {
     $.ajax({
    url: 'configuracion/captcha',
    type: 'post',
    dataType: 'text',
    data:{"capt":"visto"}
   })
   .done(function(data) {
    var visto=$.parseJSON(data);
    var canva=document.getElementById("capatcha");
    var dibujar=canva.getContext("2d");
    canva.width = canva.width;
    dibujar.fillStyle="red";
    dibujar.font='20pt "NeoPrint M319"';
    dibujar.fillText(visto.retornar,6,39);
   })
   .fail(function() {
   })
   .always(function() {
   });
   
}
function fecha() {
    var d = new Date();
    var mm = (d.getMonth()+1);
    if(mm<10){
        mm = '0'+mm;
    }
    var dd = d.getDate();
    if(dd<10){
        dd = '0'+dd;
    }
    var fech = d.getFullYear() + "-" + mm + "-" + dd;

    return fech;
};