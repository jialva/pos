$(function(){
    if(pagina=='vercompras'){
        grilla();
    }else{
        validarapertura();
    }    

    $("#proveedor").autocomplete({
        source:function(request,response){
            $.ajax({
                url: url+"ajax/proveedor",
                type:"GET",
                dataType:"json",
                data:{
                    search: request.term
                },                    
                success:function(data){
                    response(data);
                }
            })
        },
        select: ( event, ui ) => {
            let id = ui.item.idproveedor;
            $("#idproveedor").val(id)
        }
    });

    $("#codigo").autocomplete({
        source:function(request,response){
            $.ajax({
                url: url+"ajax/productocodigo",
                type:"GET",
                dataType:"json",
                data:{
                    search: request.term
                },                    
                success:function(data){
                    response(data);
                }
            })
        },
        select: ( event, ui ) => {
            let idproducto = ui.item.idproducto;
            $("#idproducto").val(idproducto)
            $("#producto").val(ui.item.producto)
            $("#idunidad").val(ui.item.idunidad)
            $("#unidad").val(ui.item.unidad)
        }
    });

    $("#producto").autocomplete({
        source:function(request,response){
            $.ajax({
                url: url+"ajax/productonombre",
                type:"GET",
                dataType:"json",
                data:{
                    search: request.term
                },                    
                success:function(data){
                    response(data);
                }
            })
        },
        select: ( event, ui ) => {
            let idproducto = ui.item.idproducto;
            $("#idproducto").val(idproducto)
            $("#codigo").val(ui.item.serie)
            $("#idunidad").val(ui.item.idunidad)
            $("#unidad").val(ui.item.unidad)
        }
    });

    $("#moneda").change(function() {
        document.getElementById('bloquea').style.display='block';
        var moneda = $("#moneda").val();
        $.ajax({
            url:url+'ajax/valormoneda',
            type:'post',
            data:{idmoneda:moneda},
            success:function(response){
                $("#valormoneda").val(parseFloat(response).toFixed(2))
                document.getElementById('bloquea').style.display='none';
            }
        })
    });
})

$(document).on('click', '.quitar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    calcularimporte();
});

function grilla(){
    $.ajax({
        url: url + 'vercompras/tabla',
        success:function(response){
            $("#tabla").html(response);
            tabla('grilla');
        }
    })
}

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

function agregar(){
    var idproducto = $("#idproducto").val();
    var codigo = $("#codigo").val();
    var producto = $("#producto").val();
    var idunidad = $("#idunidad").val();
    var unidad = $("#unidad").val();
    var cantidad = $("#cantidad").val();
    var precio = $("#precio").val();
    if(codigo=='' || producto == '' || idunidad== 0){
        alertify.error('Ingrese un producto para continuar');
        return;
    }else{
        if(idproducto == ''){
            alertify.error('El producto no fue seleccionado correctamente');
            $("#idproducto").val('');
            $("#codigo").val('');
            $("#producto").val('');
            $("#idunidad").val(0);
            $("#cantidad").val('')
            $("#precio").val('')
            return;
        }
    }
    if(cantidad == '' || cantidad == 0 || cantidad <0){
        alertify.error('Ingrese una cantidad válida');
        return;
    }

    if(precio == '' || precio < 0){
        alertify.error('Ingrese un precio válido del producto');
        return;
    }
    if(verificar() == 1){
        alertify.error("El producto ya se encuentra seleccionado");
        $("#codigo").focus()
    }else{        
        var importe = parseFloat(cantidad) * parseFloat(precio);
        var htmlTags = '<tr style="border-bottom: 1px solid #000000;">'+
            '<td><input type="hidden" class="codigo" name=icodigo[] value="'+codigo+'">'+codigo+'</td>'+
            '<td><input type="hidden" name=iidproducto[] value="'+idproducto+'">'+producto+'</td>'+
            '<td><input type="hidden" name=iidunidad[] value="'+idunidad+'">'+unidad+'</td>'+
            '<td><input type="hidden" class="cantidad" name=icantidad[] value="'+cantidad+'">'+parseFloat(cantidad).toFixed(2)+'</td>'+
            '<td><input type="hidden" class="precio" name=iprecio[] value="'+precio+'">'+parseFloat(precio).toFixed(2)+'</td>'+
            '<td><input type="hidden" class="importe" name=iimporte[] value="'+importe+'">'+importe.toFixed(2)+'</td>'+
            '<td align="center"><i class="quitar splashy-application_windows_remove pointer"></i></td>'+
          '</tr>';
        $('#tablacompra tbody').append(htmlTags);
        $("#idproducto").val('');
        $("#codigo").val('');
        $("#producto").val('');
        $("#idunidad").val(0);
        $("#cantidad").val('')
        $("#precio").val('')
        $("#codigo").focus();
        calcularimporte();
    }    
}

function verificar(){
    var codigo = $("#codigo").val();
    var x = 0;
    $('#formcompra input[class=codigo]').each(function(){
        if($(this).val() === codigo){
            x= 1;
        }
    });
    return x;  
}

function calcularimporte(){
    var importe = 0;
    var igv = 0;
    var totalventa =0;
    $('#formcompra input[class=importe]').each(function(){
        importe += parseFloat($(this).val());   
    });
    igv = importe * 0.18;
    totalventa = importe + igv;
    $(".subtotal").html(parseFloat(importe).toFixed(2));
    $(".igv").html(parseFloat(igv).toFixed(2));
    $(".totalventa").html(parseFloat(totalventa).toFixed(2));
    $("#subtotal").val(parseFloat(importe).toFixed(2));
    $("#igv").val(parseFloat(igv).toFixed(2));
     $("#totalventa").val(parseFloat(totalventa).toFixed(2));
}

function registrar(){
    var fechacompra = $("#fechacompra").val();
    var idproveedor = $("#idproveedor").val();
    var proveedor = $("#proveedor").val();
    var tipocompra = $("#tipocompra").val();
    var idcomprobante = $("#idcomprobante").val();
    var serienumero = $("#serienumero").val();
    var moneda = $("#moneda").val();
    var origen = $("#origen").val();

    if(fechacompra == ''){
        alertify.error("Ingrese la fecha de compra");
        return;
    }
    if(proveedor == ''){
        alertify.error("Ingrese el proveedor");
        $("#proveedor").focus();
        return;
    }else{
        if(idproveedor == ''){
            alertify.error("El proveedor no fue ingresado correctamente");
            $("#proveedor").val('');
            $("#proveedor").focus();
            return;
        }
    }
    if(tipocompra == 0){
        alertify.error("Seleccione el tipo de compra");
        return;
    }
    if(idcomprobante == 0){
        alertify.error("Seleccione el comprobante de la compra");
        return;
    }
    if(serienumero == ''){
        alertify.error("Ingrese el nro del comprobante");
         $("#serienumero").focus();
        return;
    }
    if(moneda == 0){
        alertify.error("Seleccione la moneda de compra");
        return;
    }
    if(origen == 0){
        alertify.error("Seleccione la salida");
        return;
    }

    if ($('#tablacompra >tbody >tr').length == 0){
        alertify.error("Aún no ha seleccionado ningún producto para la compra");
    }else{
         document.getElementById('bloquea').style.display='block';
         $.ajax({
            url: url + 'registrarcompra/guardar',
            type:'post',
            data:$("#formcompra").serialize(),
            success:function(response){
                if(response == 1){
                    location.reload();
                }else{
                    alertify.error("Ocurrio un error inesperado");
                }
                document.getElementById('bloquea').style.display='none';
            }
         });
    }

}

function editar(id){

}