$(document).ready(function()
{
	
});



function califica()/*comentarios y calificacion del cyber*/
{	
	var califica 	= $("#calf").val();
 	var comentario = $("#coment").val();
 	var name		= $("#comen_name").val();
	califica =	parseInt(califica);
 	if(califica=="" || comentario=="")
 	{
 		$("#error_comen").empty();
 		$("#error_comen").fadeIn();
 		$("#error_comen").append("<b>Por favor</b> no olvides comentar y calificarnos, eso nos ayudara a proporcionarte un <b>mejor servicio</b>");
 	}
	else
	{
		$("#error_comen").empty();//eliminamos mensaje
		$("#error_comen").fadeOut();
							 //eliminamos formulario para evitar reenvios
		$.post('http://192.168.100.45/cyber-system/index.php/welcome/comenta',
		{
			'comentario':comentario,
			'califica':califica,
			'name':name
		},
		function(result)
		{			
			if(result==1)
			{
				$("#comen1").fadeOut();
				$("#comen2").fadeOut();
				$("#comen3").fadeOut();
				$("#comen_send").fadeOut();
				$("#good_comen").fadeIn();
				$("#good_comen").append("Gracias por tus comentarios =)");	
			}
			else
			{
				alert(result);
				$("#error_comen").empty();//eliminamos mensaje
				$("#error_comen").fadeIn();
				$("#error_comen").empty();//eliminamos mensaje
				$("#error_comen").append("UPS. No se pudo calificar el servicio, contacta por favor al administrador =(");
			}
		});
	}
}


function addfavorite()/*manda los favoritos al modulo para almecenar en base de datos*/
{
	var favs 	= [];//nombre de favoritos
	var lfavs	= [];//link de los favoritos}
	var i;
	var j=0;
	//almacenamos el nombre de los favoritos
	favs[0] =  $("#fav1").val();
	favs[1] =  $("#fav2").val();
	favs[2] =  $("#fav3").val();
	//almacenamos el link de los favoritos
	lfavs[0] = $("#linkfav1").val();
	lfavs[1] = $("#linkfav2").val();
	lfavs[2] = $("#linkfav3").val();
	//verificamos que todos los espacion tengan valores
	for(i=0; i<3; i++){
		if(favs[i] =="" || lfavs[i] =="")
		{
			j=1;
		}else{j=0;}
	}

	if(j==0){//si todos los valores estan llenos
		$.post('http://192.168.100.45/cyber-system/index.php/login/addfavorite',
		{
			'favs':favs,
			'lfavs':lfavs
		},
		function(result){	
			var est = result;
			switch (est){				
				case '0':
					$("#errores").empty();
					$("#errores").append('<div class="alert alert-success" role="alert" >Favoritos actualizados exitosamente.</div>');		
					

				break;

				case '1':
					$("#errores").empty();
					$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups!</strong>No se pudieron actualizar o añadir los valores, consulta con el administrador.</div>');		
				break;

				case '3':
					$("#errores").empty();
					$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups!</strong>No puedes dejar espacios en blanco.</div>');		
				break;

				default:
					$("#errores").empty();	
					$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups!</strong>Error desconocido,consulta con el administrador, error:</div>' + est );		
				break;
			}
		});	
	}else{//si no estan llenos los valores
			$("#errores").empty();
			$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups!</strong>No puedes dejar espacios en blanco.</div>');		
	}	
}

function load3Favorites(){//nos llena la lista de 3 favoritos
	
	/*traemos en un arreglo los 3 favoritos con sus links*/
	$.post('http://192.168.100.45/cyber-system/index.php/login/load3Favorites',	
	{},
	function(result){
		var aray1 = JSON.parse(result);
		switch(aray1[0][0]){
			case 0:
				alert("No se tienen favoritos en la base de datos");
			break;
			
			case 1:
				var i,j,k;				
				for(var i=1;i<=3;i++){
					j=1;
					k=0;
					$("#3favorites").append('<a href="'+aray1[i][j]+'" class="list-group-item">'+aray1[i][k]+'</a>');																				
				}
			break;

			case 2:
				alert("Error en la consulta de los 3 favoritos.");
			break;

			default:
				alert("No se pueden cargar los 3 Links favoritos. Error desconocido");
			break;
		}
		
	});

}


function addwifipass(){//agregas nueva contraseña

	var newWipass = $("#wifipass").val();
	if(newWipass!=""){//si el campo no esta vacio
		$.post('http://192.168.100.45/cyber-system/index.php/login/wifiEditor',
			{
				'newWipass':newWipass
			},
			function(result){
				var err = parseInt(result);
				switch(err){
					case -1:
						$("#errores").empty();
						$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups! =(</strong>Se necesitan permisos de administrador.</div>');							
					break;

					case 0:
						$("#errores").empty();
						$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups! =(</strong>No se pudo crear o abrir el archivo.</div>');							
					break;

					case 1:
					$("#errores").empty();
					$("#errores").append('<div class="alert alert-success" role="alert" ><strong>Finalizado Correctamente.</strong>Se actualizo la contraseña WIFI.</div>');							

					$("#pass1").val(newWipass);//NUEVA contraseña
					$("#wifipass").val("");
					break;

					default:
						$("#errores").empty();
						$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups! =(</strong>Error desconocido, contacta al administrador.</div>'+result);							
					break;
				}
			});

	}else{//si el campo esta vacio
		$("#errores").empty();
		$("#errores").append('<div class="alert alert-danger" role="alert" ><strong>ups! =(</strong>No dejar campos vacios.</div>');		
	}
}
