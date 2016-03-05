<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	//clase principal

	      public function __construct()
       {
            parent::__construct();
            // Your own constructor code
            $this->load->library('session');
            $this->load->helper('url');        
       }


	public function index()//funcion principal que carga(VISTA)
	{

		$logged_in = $this->session->userdata('logged_in');
	  	if( $logged_in== TRUE )
	  	{ 	
			$this->starter();
		}
		else
		{

			$this->load->view('headers/header1');//cabecera
			$this->load->view('bodys/loginBody');//cuerpo
			$this->load->view('footers/loginFooter');//pie de página
		}		
	}

/*Funciones de usuarios logueados (vistas)*/
	public function starter()
	{
		$logged_in = $this->session->userdata('logged_in');
	  	if( $logged_in== TRUE )
	  	{
			//vistas principales, sesion iniciada..
			$this->load->view('headers/header_ses1');
			$this->load->view('bodys/princ_ses1');
			$this->load->view('bodys/body_ses1');
			$this->load->view('footers/footer_ses1');
		}else {echo "Sesión requerida";}//pantalla de error de sesión

		

	}

	public function addfavorite()//agrega nuevos favoritos(vista)
	{
		$logged_in = $this->session->userdata('logged_in');
	  	if( $logged_in== TRUE )
	  	{	  		
	  		$favs 	= $_POST['favs'] ;//recibimos los datos
	  		$lfavs 	= $_POST['lfavs'] ;//de los favoritos
	  		//almacenamos nuestro arreglo en un arreglo mas
	  		$data['favs'] = $favs;
	  		$data['lfavs'] = $lfavs;	  		
	  		//mandamos el arreglo data
	  		$this->load->model('herramientas');
	  		$result = $this->herramientas->addfavorite($data);
	  		echo $result;
	  	}else {echo "Sesión requerida";}//pantalla de error de sesión
	}
	
	public function pruebanivel()
	{
		$logged_in = $this->session->userdata('logged_in');
		if( $logged_in== TRUE )
	  	{ 
	  		$permiso = $this->session->userdata('level');
	  		switch ($permiso) {
	  			case 0:
	  				echo "Tienes acceso total";
	  				break;
				case 1:
	  				echo "Tienes acceso a administracion de blog, contenido web, bases_datos";
	  				break;	  			

	  			case 2:
	  				echo "Tienes acceso restringido, solo puedes agregar contenido al blog que debera ser verificado";	
	  			
	  			case 3:
	  				echo "acceso limitado, solo funciones primarias";
	  			break;

	  			default:
	  				echo "No se pudo comprobar tu sesion, no podemos otorgar permiso alguno.";
	  				break;
	  		}

	  		echo "<br>Ya iniciaste sesion";
	  	}
	  	else
	  	{
	  		echo "Necesitas una sesion";
	  	}
	}




/*Fin de funciones de usuarios logueados¡¡¡*/
///////
/*Funciones de usuarios logueados (procesos*/

/*Fin funciones de usuarios logueados (procesos*/	

//Inicios de sesion, peticiones de sesion, permisos, terminos de sesion, etc.

	public function logear()//funcion de verificacion de login
	{
		if(isset($_POST['usuario']) && isset($_POST['contraseña']))
		{
			$params['usuario'] 		= $_POST['usuario'];//recivimos nombre de usuario
			$params['contraseña']	= $_POST['contraseña'];//recibimos contraseña		
			$errors['erro_code']	=0;//sin error inicial
			/* Si se dejan campos vacios*/
			if($params['usuario'] =="" || $params['contraseña']=="")//NO DEJAR CAMPOS VACIOS
			{
				$errors['erro_code'] = 2;//error de campos vacios			
				$this->load->view('headers/header1');//cabecera
				$this->load->view('bodys/loginBody',$errors);//cuerpo
				$this->load->view('footers/loginFooter');//pie de página
			}
			/*Si se llenaron los campos se verifica la sesion*/
			else//se valida el usuario y contraseña
			{
				$this->load->model('users_model');//cargamos el modelo
				$result = $this->users_model->valida($params);//
				if($result==1)//si se valida correctamente
				{//cargamos los datos de sesion
					$this->user_info($params['usuario']);//llamamos a la funcion de informacion
				}
				else
				{
					$errors['erro_code'] =$result;
					$this->load->view('headers/header1');//cabecera
					$this->load->view('bodys/loginBody',$errors);//cuerpo
					$this->load->view('footers/loginFooter');//pie de página
				}
			}

		}else{$this->index();}
	}//FIN DE FUNCTION logear

	/*proporciona informacion del usuario*/
	private function user_info($usuario)
	{
		$this->load->model('users_model');//cargamos el modelo de usuarios 
		$result=$this->users_model->users_permiso($usuario);//llamamos a la funcion que nos regresa la informacion en array	
		/*Asignamos el permiso a una variable*/
		foreach ($result->result() as $row)
			{
				$permiso=$row->permiso;
				$nombre=$row->nombre;	
			}
		//echo "Permisos de usuario:";
		//echo $permiso;
		//echo $nombre;
		/*Iniciamos la sesión*/
	   $dato['username'] = $nombre;
	   $dato['permiso']	 =$permiso;
	    $newdata = array(
                   'username'  => $dato['username'], 
                   'level'	   => $dato['permiso'],                 
                   'logged_in' => TRUE
                   
               );
	   $this->session->set_userdata($newdata);//set the data and level of the user
	   $session_id 		= $this->session->userdata('username');
	   $session_permiso	= $this->session->userdata('level');	  
	   $session_logeado	= $this->session->userdata('logged_in');	  

	   if($session_logeado==TRUE)
	   {
	   	$this->starter();
	   }
					
	}
	//cierra sesion

public function removeCache()
    {
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }
	public function close_session()
	{
		$logged_in = $this->session->userdata('logged_in');
	  	if( $logged_in== TRUE )
	  	{ 	
	  		$this->session->sess_destroy();
	  		$this->removeCache();	
	  		header("location:http://localhost/index.php/login/index");
	  	}
	  	else
	  	{
	  		$this->index();
	  	}
	  
	}
}