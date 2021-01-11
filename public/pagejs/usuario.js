$(function(){
	grilla();
})

function grilla(){
	$.ajax({
		url: url + 'usuario/tabla',
		success:function(response){
			$("#tabla").html(response);
		}
	})
}