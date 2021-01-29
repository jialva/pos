$(function(){
	grilla();
})

function guardar(){
	var idunidad = $("#idunidad").val();
	var nombrelargo = $("#nombrelargo").val();
	var nombrecorto = $("#nombrecorto").val();
	var conversion = $("#conversion").val();
	if(nombrelargo == ''){
		alertify.error("Ingrese el nombre largo");
		$("#nombrelargo").focus();
		return;
	}
	if(nombrecorto == ''){
		alertify.error("Ingrese el nombre corto");
		$("#nombrecorto").focus();
		return;
	}
	if(conversion == ''){
		alertify.error("Ingrese la conversión");
		$("#conversion").focus();
		return;
	}
	$.ajax({
		url:url+'unidadmedida/guardar',
		type:'post',
		data:{idunidad:idunidad,nombrelargo:nombrelargo,nombrecorto:nombrecorto,conversion:conversion},
		dataType:'json',
		success:function(response){
			switch(parseFloat(response.ok)) {
			  case 1:alertify.success(response.message);grilla();modal('myModal1','close');break;
			  case 2:alertify.success(response.message);grilla();modal('myModal1','close');break;
			  case 3:alertify.warning(response.message);break;
			  default:alertify.error(response.message);break;
			}
		}
	});
}

function editar(idunidad){
	$.ajax({
		url:url+'unidadmedida/verregistro',
		type:'post',
		data:{idunidad:idunidad},
		dataType:'json',
		success:function(response){
			$("#idunidad").val(idunidad);
			$("#nombrelargo").val(response.nombrelargo);
			$("#nombrecorto").val(response.nombrecorto);
			$("#conversion").val(response.conversion);
			modal('myModal1','open');
		}
	})
}

function grilla(){
	$.ajax({
		url: url + 'unidadmedida/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}

function limpiar(){
	$("#idunidad").val('')
	$("#nombrelargo").val('')
	$("#nombrecorto").val('')
	$("#conversion").val('')
}