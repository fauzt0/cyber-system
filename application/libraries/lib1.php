<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lib1 {
	/*
			Singletxtread(nombre_del_archivo.txt)
			#realiza la lectura de un txt 	
			#y devuelve una sola cadena
		*/
	public function Singletxtread($txtname){		
		//METER ENCRIPTACION IMPORTANTE
  		$fichero ="conten/".$txtname.".txt";//ruta completa carpeta conten + archivo a leer
  		$exists = file_exists( $fichero );//comprobamos que existe

  		if($exists==true){//si existe	  			
  			$file = fopen($fichero, "r");//abrimos el archivo con permisos de lectura			
				$pass = fgets($file);//obtenemos la lectura en una variable			
			fclose($file);	//cerramos el archivo       
  		}else{//si no existe
  			$pass = "NULL";
  		}  		 
  		return $pass;	  	
	}


	public function Pluraltxtread($txtname){//lectura de texto de varias lineas
		$fichero = "conten/".$txtname.".txt";//ruta completa del fichero
		$exists = file_exists($fichero);

		if($exists==true){
			$file = fopen($fichero, "r");//abrimos el fichero con propiedades de lectura
			$i=0;
			 while(!feof($file)){
     	   		$lines[$i] = fgets($file);
     	   		$i++;
        		//echo nl2br($traer);
    		}
    		
    		$result[0] = 1;
    		$result[1] = $lines;//
    		
		}else{
			$result[0] = 0;
			$result[1] = 0;
		}

		return $result;
	}

	/*############
		-funcion para eliminar contenido de un txt
		//recibe el numero de las lineas a eliminar,
		//y la ruta del archivo a eliminar
		//elimina lina por linea, por lo cual solo recibe una, 
		pero reacomoda el resto

	*/
	public function oneLinedel($params){
		extract($params);//coment, ruta
		$fichero = "conten/".$txtname.".txt";//ruta completa del fichero
		$exists = file_exists($fichero);//true or false

		if($exists==true){//si el fichero en la ruta existe

			/*Eliminamos el contenido*/			
			$file = fopen($fichero, "rw");//abrimos el fichero 
			$i=0;//contador inicial de linea			
			$m=0;
			/*
				metemos todo el contenido en un
				array ecepto la linea deseada,
				posteriormente se vuelve a escribir
			*/
			while(!feof($file)){
				if($i != $coment){//no se incluye el comentario
					$lines[$i] = fgets($file);     	   			
					$i++;	
				}					
			}

			//se reescribe el array en el txt
			for($m=0; $m<=$i; $m++){
				fwrite($file,$lines[$m]. PHP_EOL);//escribimos la nueva contraseña				
			}
			
				fclose($file);

			return 1;

		}else{
			return -1;//no existe
		}

	}


}