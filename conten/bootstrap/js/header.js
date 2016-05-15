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

/*
	funcion que muestra tabla con comentarios
*/
function showComents(){

	$("#espejo").empty();//vaciamos el contenido principal (espejo constructor)	
	$.post('http://192.168.100.45/cyber-system/index.php/login/showComents',
	{	},
	function(result){
		var aray2 = JSON.parse(result);
		switch (aray2[0]){
			case "NULL"://sin archivo de comentarios
			$("#espejo").append('<div class="col-sm-6 col-md-12"><table class="table table-hover table-striped">'+
					'<th>'+
					'No existen comentarios'+ aray2[0]+
					'</th>'+
					'</table></div>'
					);			
			break;

			case 1://llenado de comentarios
			var mem  = 1;//contador de comentarios
			var mem2 = 0;//puntero de primer comentario
			var comens = aray2[1];//
				$("#espejo").append('<div class="col-sm-6 col-md-12">'+
					'<table  border="1" id="table_coments" class="table table-hover table-striped"'+
					'style=" border:2px solid #000; background-color:#F2F2F2">'+
					'<th colspan="4">Comentarios de Cyber Visión:</th></table></div>');					
				
					while(mem < aray2[2]){//cantidad de comentarios
						var i,j=0,k=0;
						var n = comens[mem2].length;//tamaño de la cadena por comentario
						var ar = [];
						for(i = 0; i <=n; i++){
							var an = comens[mem2].charAt(i);//caracter por caracter							
							if(an !="|" && an !="/" ){//si no es ||
								if(k==0){
									ar[j] = an;//inicio de fila
									k=1;
								}else{
									ar[j] = ar[j] + an;
								}								
							}else{ //si es ||
								k=0;
								j++;
								i++;
							}
						}
						
						
						/*segciona los comentarios hasta encontrar una linea*/
						//$("#table_coments").append('<tr><td>'+comens[mem2]+'</td><td>Tam:'+n+'</td></tr>');						
						$("#table_coments").append('<tr><td>'+ar[0]+'</td><td>'+ar[1]+'</td><td>'+ar[2]+'</td>'+
							'<td>'+
								'<button type="button" class="btn btn-danger btn-sm" onclick="delComent(\''+mem2+'\');">'+
  								'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar'+
								'</button>'+
								'</td> </tr>');						
						mem++;
						mem2++;
					}
			break;

			default:
				$("#espejo").append('<div class="col-sm-6 col-md-12"><table class="table table-hover table-striped">'+
					'<th>'+
					'ERROR desconocido'+ aray2[0]+
					'</th>'+
					'</table></div>'
					);							
			break;

		}
		

	});

}


function delComent(coment)//recibe como parametro el numero de comentario a eliminar
{
	/*Para eliminar un comentario mandamos como parametro
		el numero de linea donde se almacena el comentario,
		si el resultado es el desado por medio de ajax se
		actualiza la tabla sin el comentario eliminado
	*/
	.$post('http://192.168.100.45/cyber-system/index.php/login/delComent',
		{
			'coment':coment
		},
		function(result){

			switch(result){
				case "-1":
					$("#mensajesUp").empty();
					$("#mensajesUp").append('<div class="alert alert-danger" role="alert">Error desconocido: '+result+'</div>');
					
				break;

				case "1":
				break;

				case "2":
				break;
				
				

				default:
					$("#mensajesUp").empty();
					$("#mensajesUp").append('<div class="alert alert-danger" role="alert">Error desconocido: '+result+'</div>');
					
				break;

			}
	});

}
