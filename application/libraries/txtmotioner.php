<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class txtmotioner  {

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




}