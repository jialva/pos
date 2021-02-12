$(function(){
	grilla();
})

function guardar(){
	var idcaja = $("#idcaja").val();
	var caja = $("#caja").val();
	if(caja == ''){
		alertify.error("Ingrese la caja");
		$("#caja").focus();
		return;
	}
	$.ajax({
		url:url+'registrarcaja/guardar',
		type:'post',
		data:{idcaja:idcaja,caja:caja},
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

function editar(idcaja){
	$.ajax({
		url:url+'registrarcaja/verregistro',
		type:'post',
		data:{idcaja:idcaja},
		dataType:'json',
		success:function(response){
			$("#idcaja").val(idcaja);
			$("#caja").val(response.caja);
			modal('myModal1','open');
		}
	})
}

function grilla(){
	$.ajax({
		url: url + 'registrarcaja/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}

function limpiar(){
	$("#idcategoria").val('')
	$("#categoria").val('')
}