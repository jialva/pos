$(function(){
	grilla();
})

function guardar(){
	var idproducto = $("#idproducto").val();
	var producto = $("#producto").val();
	var idcategoria = $("#idcategoria").val();
	var idunidad = $("#idunidad").val();
	var idmarca = $("#idmarca").val();
	var idmodelo = $("#idmodelo").val();
	var serie = $("#serie").val();
	var minimo = $("#minimo").val();
	var precioventa_uno = $("#precioventa_uno").val();
	var precioventa_dos = $("#precioventa_dos").val();
	var precioventa_tres = $("#precioventa_tres").val();
	if(producto==''){
		alertify.error("Ingrese el nombre el producto");
		$("#producto").focus();
		return;
	}
	if(idcategoria==0){
		alertify.error("Seleccione la categoría");
		return;
	}
	if(idunidad==0){
		alertify.error("Seleccione la unida de medida");
		return;
	}
	if(idmarca==0){
		alertify.error("Seleccione la marca");
		return;
	}
	if(idmodelo==0){
		alertify.error("Seleccione el modelo");
		return;
	}
	if(minimo==''){
		minimo = 0;
	}
	if(precioventa_uno==''){
		precioventa_uno = 0;
	}
	if(precioventa_dos==''){
		precioventa_dos = 0;
	}
	if(precioventa_tres==''){
		precioventa_tres = 0;
	}
	$.ajax({
		url:url+'productos/guardar',
		type:'post',
		data:$("#formulario").serialize(),
		dataType:'json',
		success:function(response){
			switch(parseFloat(response.ok)) {
			  case 1:alertify.success(response.message);grilla();modal('myModal1','close');break;
			  case 2:alertify.success(response.message);grilla();modal('myModal1','close');break;
			  case 3:alertify.error(response.message);break;
			  case 4:alertify.error(response.message);break;
			  default:alertify.error(response.message);break;
			}
		}
	})
}

function modelo(){
	var idmarca = $("#idmarca").val();
	$.post(url +"marcamodelo/select_modelo",{idmarca:idmarca},function(data){$("#idmodelo").html(data)});
}

function limpiar(){
	$("#idproducto").val('');
	$("#producto").val('');
	$("#idmarca").val(0);
	$("#idmodelo").html('<option value="0">--SELECCIONE--<option>');
	$("#idcategoria").val(0);
	$("#idunidad").val(0);
	$("#serie").val('');
	$("#minimo").val(0);
	$("#stock").val(0);
	$("#precioventa_uno").val(0);
	$("#precioventa_dos").val(0);
	$("#precioventa_tres").val(0);
}

function grilla(){
	$.ajax({
		url: url + 'productos/tabla',
		success:function(response){
			$("#tabla").html(response);
			tabla('grilla');
		}
	})
}