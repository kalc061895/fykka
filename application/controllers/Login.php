<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata("login")=="!s10g!n"){
			redirect(site_url('sistema'));
		}
		$this->load->model("mgeneral");
	}

	public function index($param=false){
		$data=array("param"=>$param);
		$this->load->view("login/login",$data);
	}
	public function otro(){
		echo "string";
				}

	public function verifica(){
		$this->load->model("mgeneral");
		$_POST['tipo']="SA";
		
		$result=$this->mgeneral->login($_POST['user'],$_POST['pass']);
		
		if($result==false){
			redirect(site_url('login/index/error-usuario-clave-incorrectos#team'));
		}
		else {
			$datausu=$this->mgeneral->usuario_data($result[0]->ide);
			if ($datausu==false) {
				redirect(site_url('login/index/error-usuario-clave-incorrectos#team'));
			} else {
				$misession=array(
				"login"=>"!s10g!n",
				"datos"=>$datausu[0]->usu_nombre.", ".$datausu[0]->usu_apellidos,
				"ide"=>$datausu[0]->usu_ide,
				"tipo"=>$datausu[0]->usu_tipo,
				"nivel"=>$datausu[0]->usu_tipo,
				);
			}
			
			if ($_POST['tipo']=='SUPER USUARIO') {
				$misession=array(
				"login"=>"!s10g!n",
				"datos"=>$result[0]->usua_apellidos.", ".$result[0]->usua_nombres,
				"ide"=>$result[0]->usua_ide,
				"tipo"=>$_POST["tipo"],
				);
			} 
			$this->session->set_userdata($misession);

			redirect(site_url('sistema'));
		}
	}
	public function registrar(){
		$data1 = array(
			'usu_correo' => $_POST['email'] , 
			'usu_telefono' => $_POST['tel'] , 
//			'usu_tipo' => $_POST['tipo'] , 
		);

		

		$this->mgeneral->insertar("usuarios",$data1);
		
		$ide = $this->mgeneral->ultimo_ide();	
		$data2 = array(
			'log_user' => $_POST['name'] , 
			'log_pass' => $_POST['pass'] , 
			'log_usu_ide' => $ide[0]->ide
		);
		$where = array(
			'log_usu_ide' =>$ide[0]->ide , 
		);
		$this->mgeneral->insertar("login",$data2,$where );

		$datausu=$this->mgeneral->usuario_data($ide[0]->ide) ;

		if($datausu==false){
			redirect(site_url('login/index/error-usuario-clave-incorrectos'));
		}
		else {
				$misession=array(
				"login"=>"!s10g!n",
				"datos"=>$datausu[0]->usu_nombre.", ".$datausu[0]->usu_apellidos,
				"ide"=>$datausu[0]->usu_ide,
				"tipo"=>$datausu[0]->usu_tipo,
				"nivel"=>$datausu[0]->usu_tipo,
				);
			}
		

			$this->session->set_userdata($misession);
			redirect(site_url('sistema/completar_perfil'));
	}
	public function user(){
		$result=false;

		if($this->mgeneral->get_data_select("log_user","login",$_POST)){
			$result=true;
		}
		echo $result;
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */