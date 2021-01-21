$(function(){
	grilla();
})

function guardar(){
	var idproveedor = $("#idproveedor").val();
	var tipo = $("#tipo").val();
	var ruc = $("#ruc").val();
	var razonsocial = $("#razonsocial").val();
	var nombrecomercial = $("#nombrecomercial").val();
	var telefono = $("#telefono").val();
	var email = $("#email").val();
	var estado = $("#estado").val();
	var direccion = $("#direccion").val();

	if(ruc == ''){
		alertify.error("Ingrese el número de R.U.C");
		$("#ruc").focus();
		return;
	}
	if(tipo == ''){
		alertify.error("Ingrese el tipo de proveedor");
		$("#tipo").focus();
		return;
	}
	if(razonsocial == ''){
		alertify.error('Ingrese razon social');
		$("#razonsocial").focus();
		return;
	}

	if(estado == ''){
		alertify.error('Ingrese estado');
		$("#estado").focus();
		return;
	}
	$.ajax({
		url:url+'proveedores/guardar',
		type:'post',
		data:$("#formulario").serialize(),
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

function editar(idproveedor){
	$.ajax({
		url:url+'proveedores/verregistro',
		type:'post',
		data:{idproveedor:idproveedor},
		dataType:'json',
		success:function(response){
			$("#idproveedor").val(idproveedor);
			$("#tipo").val(response.tipo);
			$("#ruc").val(response.ruc);
			$("#razonsocial").val(response.razonsocial);
			$("#nombrecomercial").val(response.nombrecomercial);
			$("#telefono").val(response.telefono);
			$("#email").val(response.email);
			$("#estado").val(response.estado);
			$("#direccion").val(response.direccion);
			modal('myModal1','open');
		}
	})
}

function meliminar(idproveedor){
	$.ajax({
		url:url+'proveedores/verregistro',
		type:'post',
		data:{idproveedor:idproveedor},
		dataType:'json',
		success:function(response){
			$("#idproveedor").val(idproveedor);
			$(".item").html(response.razonsocial);
			modal('myModal2','open');
		}
	})
}

function eliminar(){

}

function limpiar(){
	$("#idproveedor").val('');
	$("#tipo").val('');
	$("#ruc").val('');
	$("#razonsocial").val('');
	$("#nombrecomercial").val('');
	$("#telefono").val('');
	$("#email").val('');
	$("#estado").val('');
	$("#direccion").val('');
}

function grilla(){
	$.ajax({
		url: url + 'proveedores/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}