<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class herramientas extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    /*
		//funcion que nos almacena o actualiza
		//los 3 links de favoritos en la página principal
    */

    public function addfavorite($data){
    	extract($data);//extraemos los arreglos favs[] y lfavs[]
    	$error = 0; //no tenemos error    	
    	//verificamos que los valores de los arreglos esten llenos
    	
    	for($i=0;$i<3;$i++){
    		if($favs[$i] == "" OR $lfavs[$i] == ""){
    			$error = 3;
    		}
    	}
    	//si tenemos los arreglos llenos
    	if($error!=3){    		
    		$estadoBase = $this->revisarBase("favoritos");//checamos si la base esta llena o vacia
    		for($i=0;$i<3;$i++){    		
				if($estadoBase==1){//si estamos actualizando
					$array = array(
    				'nombre' 	=> $favs[$i],
    				'url'	 	=> $lfavs[$i]    				
    				);    				
    				$this->db->where('posicion',$i);
    				$this->db->update('favoritos', $array); 	
					
				}else{//si es la primera insercion				

    				$array = array(
    				'nombre' 	=> $favs[$i],
    				'url'	 	=> $lfavs[$i],
    				'activo' 	=>1,
    				'posicion' 	=>$i
    				);
    				$this->db->insert('favoritos', $array); //insertamos los valores			
				}			    			

    			$afectado = $this->db->affected_rows();
    			if($afectado == 0){
    				$error = 1;//si no se pudo hacer alguna insercion
    			}
    		}//termina ciclo for
    	}
    	return $error;//0 no tiene error,1 no se pudo insertar un valor,3 campos vacios
    }

    public function load3Favorites(){//consulta los 3 favoritos a la base
        $baseEstado = $this->revisarBase("favoritos");
        if($baseEstado != 0){//si la base no esta vacia
            $this->db->select('nombre,url');
            $this->db->order_by("posicion","asc");
            $query = $this->db->get();
            if($query->num_rows() > 0){//si se pudieron obtener datos
                $lks[0][0] = 1;//##resultado
                $lks[0][1] = 1;//##positivo
                $i=1;
                $j=0;
                foreach ($query->result() as $row) {
                    $j=0;
                    $lks[$i][$j] = $row->nombre;
                    $j++;
                    $lks[$i][$j] = $row->url;
                    $i++;
                }
            }else{//error en la consulta
                $lks[0][0] = 2;//##error en los
                $lks[0][1] = 2;//##resultados
            }
        }else{//si la tabla esta vacia
            $lks[0][0] = 0;//##resultado
            $lks[0][1] = 0;//##vacio
        }
    }

   /*Funcion que nos indica un true si una tabla esta llena o 0 si esta vacía*/
    private function revisarBase($tabla){
    	$query = $this->db->get($tabla);
    	if($query->num_rows() > 0){
    		return 1;//tenemos datos
    	}else return 0;//no tenemos datos
    }


}