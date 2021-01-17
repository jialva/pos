$(function(){
	grilla();
})

function guardar(){
	var idmodulo = $("#idmodulo").val();
	var modulo = $("#modulo").val();
	var modulo_padre = $("#modulo_padre").val()
	var urlw = $("#url").val()
	var icono = $("#icono").val()
	var orden = $("#orden").val()
	$.ajax({
		url:url+'modulo/guardar',
		type:'post',
		data:{idmodulo:idmodulo,modulo:modulo,modulo_padre:modulo_padre,url:urlw,icono:icono,orden:orden},
		dataType:'json',
		success:function(response){
			if(response.ok == 1){
				alertify.success(response.message);
				grilla();
				modal('myModal1','close');
			}else{
				alertify.error(response.message);
			}
		}
	})
}

function editar(idmodulo){
	$.ajax({
		url:url+'modulo/verregistro',
		type:'post',
		data:{idmodulo:idmodulo},
		dataType:'json',
		success:function(response){
			$("#idmodulo").val(idmodulo)
			$("#modulo").val(response.modulo)
			$("#modulo_padre").val(response.modulo_padre)
			$("#url").val(response.url)
			$("#icono").val(response.icono)
			$("#orden").val(response.orden)
			modal('myModal1','open');
		}
	})
}

function limpiar(){
	$("#idmodulo").val('')
	$("#modulo").val('')
	$("#idmodulo_padre").val(0)
	$("#url").val('')
	$("#icono").val('')
	$("#orden").val(0)
}

function grilla(){
	$.ajax({
		url: url + 'modulo/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}