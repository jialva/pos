$(function(){
	grilla();
})

function guardar(){
	var idusuario = $("#idusuario").val();
	var nombres = $("#nombres").val();
	var apellidos = $("#apellidos").val();
	var telefono = $("#telefono").val();
	var email = $("#email").val();
	var usuario = $("#usuario").val();
	var password = $("#password").val();
	if(nombres == ''){
		alertify.error('Ingrese el nombre');
		$("#nombres").focus();
		return;
	}
	if(apellidos == ''){
		alertify.error('Ingrese el apellido');
		$("#apellidos").focus();
		return;
	}
	if(email != ''){
		if(!correovalido(email)){
			alertify.error('Email inválido');
			$("#email").focus();
			return;
		}
	}
	if(usuario == ''){
		alertify.error('Ingrese el usuario');
		$("#usuario").focus();
		return;
	}
	if(password == ''){
		alertify.error('Ingrese el password');
		$("#password").focus();
		return;
	}
	$.ajax({
		url:url+'usuario/guardar',
		type:'post',
		data:{idusuario:idusuario,nombres:nombres,apellidos:apellidos,telefono:telefono,email:email,usuario:usuario,password:password},
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

function editar(idusuario){
	$.ajax({
		url:url+'usuario/verregistro',
		type:'post',
		data:{idusuario:idusuario},
		dataType:'json',
		success:function(response){
			$("#idusuario").val(idusuario);
			$("#nombres").val(response.nombres);
			$("#apellidos").val(response.apellido);
			$("#telefono").val(response.telefono);
			$("#email").val(response.email);
			$("#usuario").val(response.usuario);
			$("#password").val(response.password);
			$("#usuario").prop('readonly',true);
			$("#password").prop('readonly',true);
			modal('myModal1','open');
		}
	})
}

function meliminar(idusuario){
	$.ajax({
		url:url+'usuario/verregistro',
		type:'post',
		data:{idusuario:idusuario},
		dataType:'json',
		success:function(response){
			$("#idusuario").val(idusuario);
			$(".usuario").html(response.nombres+' '+response.apellido);
			modal('myModal2','open');
		}
	})
}

function eliminar(){

}

function limpiar(){
	$("#idusuario").val('');
	$("#nombres").val('');
	$("#apellidos").val('');
	$("#telefono").val('');
	$("#email").val('');
	$("#usuario").val('');
	$("#password").val('');
	$("#usuario").prop('readonly',false);
	$("#password").prop('readonly',false);
}

function grilla(){
	$.ajax({
		url: url + 'usuario/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}