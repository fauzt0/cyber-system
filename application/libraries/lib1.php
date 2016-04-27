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
		}


	}



}