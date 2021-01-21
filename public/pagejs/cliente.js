$(function(){
	grilla();
})

function guardar(){
	var idcliente = $("#idcliente").val();
	var idtipodocumento = $("#idtipodocumento").val();
	var numero = $("#numero").val();
	var nombre = $("#nombre").val();
	var apellido = $("#apellido").val();
	var telefono = $("#telefono").val();
	var email = $("#email").val();
	var direccion = $("#direccion").val();
	var credito = 0;
	if( $('#credito').prop('checked')){
	    credito = 1;
	}
	if(idtipodocumento == 0){
		alertify.error("Seleccione el tipo de documento");
		return;
	}
	if(numero == ''){
		alertify.error("Ingrese el nro de documento");
		$("#numero").focus();
		return;
	}
	if(nombre == ''){
		alertify.error('Ingrese el nombre');
		$("#nombre").focus();
		return;
	}
	if(apellido == ''){
		alertify.error('Ingrese el apellido');
		$("#apellido").focus();
		return;
	}

	$.ajax({
		url:url+'cliente/guardar',
		type:'post',
		data:{idcliente:idcliente,idtipodocumento:idtipodocumento,numero:numero,nombre:nombre,apellido:apellido,telefono:telefono,email:email,direccion:direccion,credito:credito},
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

function editar(idcliente){
	$.ajax({
		url:url+'cliente/verregistro',
		type:'post',
		data:{idcliente:idcliente},
		dataType:'json',
		success:function(response){
			$("#idcliente").val(idcliente);
			$("#idtipodocumento").val(response.idtipodocumento);
			$("#numero").val(response.numero);
			$("#nombre").val(response.nombre);
			$("#apellido").val(response.apellido);
			$("#telefono").val(response.telefono);
			$("#email").val(response.email);
			$("#direccion").val(response.direccion);
			if(response.credito == 1){
				$("#credito").prop('checked',true);
			}else{
				$("#credito").prop('checked',false);
			}
			modal('myModal1','open');
		}
	})
}

function meliminar(idcliente){
	$.ajax({
		url:url+'cliente/verregistro',
		type:'post',
		data:{idcliente:idcliente},
		dataType:'json',
		success:function(response){
			$("#idcliente").val(idcliente);
			$(".item").html(response.nombre+' '+response.apellido);
			modal('myModal2','open');
		}
	})
}

function eliminar(){

}

function limpiar(){
	$("#idcliente").val('');
	$("#idtipodocumento").val(0);
	$("#numero").val('');
	$("#nombre").val('');
	$("#apellido").val('');
	$("#telefono").val('');
	$("#email").val('');
	$("#direccion").val('');
	$("#credito").prop('checked',false);
}

function grilla(){
	$.ajax({
		url: url + 'cliente/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}