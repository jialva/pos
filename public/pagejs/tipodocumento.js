$(function(){
	grilla();
})

function guardar(){
	var idtipodocumento = $("#idtipodocumento").val();
	var nombrelargo = $("#nombrelargo").val();
	var nombrecorto = $("#nombrecorto").val();
	var codigo = $("#codigo").val();
	if(nombrelargo == ''){
		alertify.error('Ingrese el nombre del tipo de documento');
		$("#nombrelargo").focus();
		return;
	}
	if(nombrecorto == ''){
		alertify.error('Ingrese la abreviatura del tipo de documento');
		$("#nombrecorto").focus();
		return;
	}
	if(codigo == ''){
		alertify.error('Ingrese el código');
		$("#codigo").focus();
		return;
	}
	$.ajax({
		url:url+'tipodocumento/guardar',
		type:'post',
		data:{idtipodocumento:idtipodocumento,nombrelargo:nombrelargo,nombrecorto:nombrecorto,codigo:codigo},
		dataType:'json',
		success:function(response){
			switch(parseFloat(response.ok)) {
			  case 1:alertify.success(response.message);grilla();modal('myModal1','close');break;
			  case 2:alertify.success(response.message);grilla();modal('myModal1','close');break;
			  case 3:alertify.warning(response.message);break;
			  default:alertify.error(response.message);break;
			}
		}
	})
}

function editar(idtipodocumento){
	$.ajax({
		url:url+'tipodocumento/verregistro',
		type:'post',
		data:{idtipodocumento:idtipodocumento},
		dataType:'json',
		success:function(response){
			$("#idtipodocumento").val(idtipodocumento);
			$("#nombrelargo").val(response.nombrelargo);
			$("#nombrecorto").val(response.nombrecorto);
			$("#codigo").val(response.codigo);
			modal('myModal1','open');
		}
	})
}

function meliminar(idtipodocumento){
	$("#idtipodocumento").val(idtipodocumento)
	$.ajax({
		url:url+'tipodocumento/verregistro',
		type:'post',
		data:{idtipodocumento:idtipodocumento},
		dataType:'json',
		success:function(response){
			$("#idtipodocumento").val(idtipodocumento);
			$(".tipodocumento").html(response.nombrecorto);
			modal('myModal2','open');
		}
	})
}

function eliminar(){
	var idtipodocumento = $("#idtipodocumento").val();
	$.ajax({
		url:url+'tipodocumento/eliminar',
		type:'post',
		data:{idtipodocumento:idtipodocumento},
		dataType:'json',
		success:function(response){
			switch(parseFloat(response.ok)){
				case 0:alertify.error(response.message);break;
				case 1:alertify.success(response.message);grilla();modal('myModal2','close');;break;
				case 2:alertify.error(response.message);break;
				default:alertify.error("Ocurrio un error inesperado al eliminar");break;
			}
		}
	});
}

function limpiar(){
	$("#idtipodocumento").val('');
	$("#nombrelargo").val('');
	$("#nombrecorto").val('');
	$("#codigo").val('');
}

function grilla(){
	$.ajax({
		url: url + 'tipodocumento/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}