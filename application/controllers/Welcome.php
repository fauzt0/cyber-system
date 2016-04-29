<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		//carga de datos iniciales
		$this->load->library('lib1');
		$this->load->model('herramientas');/*Cargamos los 3 favoritos*/
		//
		$favoritos3 = $this->herramientas->load3Favorites();
		$oldWipass = $this->lib1->Singletxtread("wifipass");//hacemos lectura de antigua contraseña wifi
		//	
		$data["favoritos3"] = $favoritos3;
		$data["wifipsw"] = $oldWipass;


		$this->load->view('headers/header1');
		$this->load->view('bodys/principal',$data);
		$this->load->view('footers/footer1');
	}


	public function sesion()
	{
		$this->load->view('headers/header1');
		$this->load->view('bodys/principal');
		$this->load->view('footers/footer1');
	}

	public function registro()
	{
		$this->load->view('headers/header1');
		$this->load->view('bodys/principal');
		$this->load->view('footers/footer1');
	}

/**/
	public function comenta()
	{			
		$califica = $_POST["califica"];
		$comentario = $_POST["comentario"];
		$name = $_POST["name"];
		$conten=$name . "||" .$comentario. "||" . $califica."/" ;
		$file = fopen("conten/comentarios/comentarios.txt" ,"a") or die("Problemas");
		//
		if( fwrite($file,$conten.PHP_EOL))
		{
			$this->load->model("comentarios");
			$res= $this->comentarios->comenta();
			echo $res;
		}else{ echo 0;}

		fclose($file);					
	}
}
