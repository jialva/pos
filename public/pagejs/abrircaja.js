$(function(){
	grilla();
})

function guardar(){
	var idapertura = $("#idapertura").val();
	var montoapertura = $("#montoapertura").val();
	var fechaapertura = $("#fechaapertura").val();
	if(montoapertura==''){
		alertify.error("Ingrese un monto válido");
		$("#montoapertura").focus();
		return;
	}else{
		if(montoapertura<0){
			alertify.error("El monto no puede ser menor a 0");
			$("#montoapertura").focus();
			return;
		}
	}
	$.ajax({
		url:url+'abrircaja/guardar',
		type:'post',
		data:{idapertura:idapertura,fechaapertura:fechaapertura,montoapertura:montoapertura},
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

function limpiar(){
	$("#idapertura").val('');
	$("#montoapertura").val(0)
}

function grilla(){
	$.ajax({
		url: url + 'abrircaja/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}