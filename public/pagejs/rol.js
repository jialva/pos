$(function(){
	grilla();
})

function guardar(){
	var idrol = $("#idrol").val();
	var rol = $("#rol").val();
	if(rol == ''){
		alertify.error('Ingrese el rol');
		$("#rol").focus();
		return;
	}
	
	$.ajax({
		url:url+'rol/guardar',
		type:'post',
		data:{idrol:idrol,rol:rol},
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

function editar(idrol){
	$.ajax({
		url:url+'rol/verregistro',
		type:'post',
		data:{idrol:idrol},
		dataType:'json',
		success:function(response){
			$("#idrol").val(idrol);
			$("#rol").val(response.rol);
			modal('myModal1','open');
		}
	})
}

function magregarusuario(idrol){	
	$("#tablausuarios").html('');
	$("#idrol").val(idrol)
	$("#idusuario").val('')
	$("#addusuario").val('')
	$("#addnombre").val('')
	$.ajax({
		url:url+'rol/usuariosagregados',
		type:'post',
		data:{idrol:idrol},
		success:function(response){
			$("#tablausuarios").html(response);
			modal('myModal3','open');
		}
	})
}

function addusuariorol(){
	var idusuario = $("#idusuario").val();
	var idrol = $("#idrol").val();
	var addusuario = $("#addusuario").val()
	var addnombre = $("#addnombre").val()
	if(addnombre == ''){
		alertify.error("Seleccione el nombre del usuario para continuar");
		$("#addnombre").focus();
		return;
	}
	if(addusuario == ''){
		alertify.error("Seleccione el usuario para continuar");
		$("#addusuario").focus();
		return;
	}
	if(idusuario == ''){
		alertify.error("El usuario no fue guardado correctamente, intente nuevamente");
		$("#idusuario").val('')
		$("#addusuario").val('')
		$("#addnombre").val('')
	}else{
		$.ajax({
			url:url+'rol/addusuariorol',
			type:'post',
			data:{idrol:idrol,idusuario:idusuario},
			dataType:'json',
			success:function(response){
				if(response.ok == 1){
					alertify.success("El rol fue asignado!!!");
					magregarusuario(idrol);
				}else{
					alertify.error("Ocurrio un error al asignar el rol al usuario!!");
				}
			}
		})
	}
}

function meliminar(idrol){
	$.ajax({
		url:url+'rol/verregistro',
		type:'post',
		data:{idrol:idrol},
		dataType:'json',
		success:function(response){
			$("#idrol").val(idrol);
			$(".rol").html(response.rol);
			modal('myModal2','open');
		}
	})
}

function quitarusuario(idusuario,idrol){
	smoke.confirm('Está a punto de quitar el rol al usuario seleccionado, no tendrá acceso a los distintos módulos de sistema. Continuar?',
	function(e){
		if (e){
			$.ajax({
				url:url+'rol/quitarrolusuario',
				type:'post',
				data:{idusuario:idusuario},
				dataType:'json',
				success:function(response){
					if(response.ok==1){
						alertify.success("El rol fue quitado del usuario");
						magregarusuario(idrol);
					}else{
						alertify.error("Ocurrio un error inesperado");
					}
				}
			})
		}
	}, 
	{
		ok:"Si", 
		cancel:"No"
	});
}

function accesos(idusuario,idrol){
	$.ajax({
		url:url+'rol/accesos',
		type:'post',
		data:{idusuario:idusuario,idrol:idrol},
		success:function(response){
			$("#divaccesos").html(response);
			modal('myModal4','open');
		}
	})
}

function otorgar(idrol,idusuario,idmodulo,opcion){
	if(opcion==0){
		if($("#permitir"+idmodulo).prop('checked')){
			$("#ver"+idmodulo).prop('disabled',false)
			$("#crear"+idmodulo).prop('disabled',false)
			$("#editar"+idmodulo).prop('disabled',false)
			$("#eliminar"+idmodulo).prop('disabled',false)
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:0,operacion:1}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al agregar el accesos");
			  }
			});
		}else{		
			$("#ver"+idmodulo).prop('checked',false)
			$("#crear"+idmodulo).prop('checked',false)
			$("#editar"+idmodulo).prop('checked',false)
			$("#eliminar"+idmodulo).prop('checked',false)
			$("#ver"+idmodulo).prop('disabled',true)
			$("#crear"+idmodulo).prop('disabled',true)
			$("#editar"+idmodulo).prop('disabled',true)
			$("#eliminar"+idmodulo).prop('disabled',true)
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:0,operacion:0}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al quitar el accesos");
			  }
			});
		}
		return;
	}
	if(opcion==1){
		if($("#ver"+idmodulo).prop('checked')){
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:1,valor:1,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al marcar");
			  }
			});
		}else{
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:1,valor:0,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al quitar marcado");
			  }
			});
		}
		return;
	}
	if(opcion==2){
		if($("#crear"+idmodulo).prop('checked')){
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:2,valor:1,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al marcar");
			  }
			});
		}else{
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:2,valor:0,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al quitar marcado");
			  }
			});
		}
		return;
	}
	if(opcion==3){
		if($("#editar"+idmodulo).prop('checked')){
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:3,valor:1,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al marcar");
			  }
			});
		}else{
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:3,valor:0,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al quitar marcado");
			  }
			});
		}
		return;
	}
	if(opcion==4){
		if($("#eliminar"+idmodulo).prop('checked')){
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:4,valor:1,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al marcar");
			  }
			});
		}else{
			$.post(url+"rol/marcar",{idmodulo:idmodulo,idusuario:idusuario,idrol:idrol,opcion:4,valor:0,operacion:2}, function(response){
			  if(response==0){
			  	alertify.error("Ocurrio un error al quitar marcado");
			  }
			});
		}
		return;
	}
}

function grilla(){
	$.ajax({
		url: url + 'rol/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}

function limpiar(){
	$("#idrol").val('')
	$("#rol").val('')
}