$(function(){
	grilla();
})

function guardar(){
	var idcategoria = $("#idcategoria").val();
	var categoria = $("#categoria").val();
	if(categoria == ''){
		alertify.error("Ingrese la categoría");
		$("#categoria").focus();
		return;
	}
	$.ajax({
		url:url+'categoria/guardar',
		type:'post',
		data:{idcategoria:idcategoria,categoria:categoria},
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

function editar(idcategoria){
	$.ajax({
		url:url+'categoria/verregistro',
		type:'post',
		data:{idcategoria:idcategoria},
		dataType:'json',
		success:function(response){
			$("#idcategoria").val(idcategoria);
			$("#categoria").val(response.categoria);
			modal('myModal1','open');
		}
	})
}

function grilla(){
	$.ajax({
		url: url + 'categoria/tabla',
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