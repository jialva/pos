$(function(){
	grilla();
})

function guardar(){
	var idmarca = $("#idmarca").val();
	var marca = $("#marca").val();
	if(marca == ''){
		alertify.error("Ingrese la marca");
		$("#marca").focus();
		return;
	}

	$.ajax({
		url:url+'marcamodelo/guardar',
		type:'post',
		data:{idmarca:idmarca,marca:marca},
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

function editar(idmarca){
	$.ajax({
		url:url+'marcamodelo/verregistro',
		type:'post',
		data:{idmarca:idmarca},
		dataType:'json',
		success:function(response){
			$("#idmarca").val(idmarca);
			$("#marca").val(response.marca);
			modal('myModal1','open');
		}
	})
}

function agregar(idmarca){
	$.ajax({
		url:url+'marcamodelo/vermodelos',
		type:'post',
		data:{idmarca:idmarca},
		dataType:'json',
		success:function(response){
			$("#idmarca").val(idmarca);
			$(".nommarca").html('('+response.marca+')');
			$("#tablamodelo").html(response.tabla);
			modal('myModal2','open');
		}
	})
}

function guardarmodelo(){
	var idmarca = $("#idmarca").val();
	var idmodelo = $("#idmodelo").val();
	var modelo = $("#modelo").val();
	if(modelo==''){
		alertify.error("Ingrese el modelo");
		$("#modelo").focus();
		return;
	}
	$.ajax({
		url:url+'marcamodelo/guardarmodelo',
		type:'post',
		data:{idmarca:idmarca,idmodelo:idmodelo,modelo:modelo},
		dataType:'json',
		success:function(response){
			switch(parseFloat(response.ok)) {
			  case 1:alertify.success(response.message);agregar(idmarca);limpiarmodelo();break;
			  case 2:alertify.success(response.message);agregar(idmarca);limpiarmodelo();break;
			  case 3:alertify.warning(response.message);break;
			  default:alertify.error(response.message);break;
			}
		}
	})
}

function editarmodelo(idmodelo){
	$.ajax({
		url:url+'marcamodelo/verregistromodelo',
		type:'post',
		data:{idmodelo:idmodelo},
		dataType:'json',
		success:function(response){
			$("#idmodelo").val(idmodelo);
			$("#modelo").val(response.modelo);
		}
	})
}

function grilla(){
	$.ajax({
		url: url + 'marcamodelo/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}

function limpiar(){
	$("#idmarca").val('')
	$("#marca").val('')
}

function limpiarmodelo(){
	$("#idmodelo").val('')
	$("#modelo").val('')
}