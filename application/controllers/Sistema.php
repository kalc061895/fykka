<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sistema extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata("login")!="!s10g!n"){
			//$this->cerrar_session();
			$this->load->view("sessionexpired");
		}
		$this->load->model("mgeneral");
	}
	/*****************************************************************************/

	public function cerrar_session(){
		$this->session->sess_destroy();
		redirect(site_url());
	}
	public function perfil(){
		$this->load->view("perfil/perfil");
	}


	/*****************************************************************************/

	public function index(){
		if($this->session->userdata("login")!="!s10g!n"){
			$this->cerrar_session();
		}

		$this->load->view("project/header");
		
		if ($this->session->userdata("tipo")=="SUPER USUARIO") {
			$data_menu=array("menu"=>$this->mgeneral->get_roles());

			$this->load->view("project/menu_sa",$data_menu);
		} 
		else if ($this->session->userdata("tipo")=="USUARIO SIMPLE") {
			$data_menu=array("menu"=>$this->mgeneral->get_roles());

			$this->load->view("project/menu_usua",$data_menu);
		}
		$this->load->view("project/footer_2");
		$this->load->view("project/footer");
	}
	/*****************************************************************************/
	private function menu_admin(){
		$usuide = $this->session->userdata("ide");
		$this->load->view("project/menu_sa");
	}	
	/*****************************************************************************/
	public function completar_perfil(){
		$usuide = $this->session->userdata("login");
		$this->load->view("project/header");
		$this->load->view("perfil/form_completar");
		$this->load->view("project/footer");

	}
	public function cargardatos(){

		$datausu=$this->mgeneral->usuario_data($this->session->userdata("ide")) ;
		
		$misession=array(
			"datos"=>$datausu[0]->usu_nombre.", ".$datausu[0]->usu_apellidos,
			"ide"=>$datausu[0]->usu_ide,
			"tipo"=>$datausu[0]->usu_tipo,
			"nivel"=>$datausu[0]->usu_nivel,
			);
		
		$this->session->set_userdata($misession);
	}
	/*****************************************************************************/
	public function actualizar_usuario(){
		$where = array(
			'usu_ide' => $this->session->userdata("ide"), );
		$this->mgeneral->actualizar("usuarios",$where,$_POST);
		$this->cargardatos();
		redirect(site_url(""));
	}
	/*****************************************************************************/

	public function fin_mant($ide){
		$set = array(
			'maqu_estado' =>'LISTO',);
		$this->mgeneral->actualizar('maquina',"maqu_ide = '".$ide."'",$set);
	}
	public function elim_mant(){
		$ide_maqu=$_POST['ide_maqu'];
		$fecha=$_POST['fecha'];
		$set = array(
			'mant_maqu_ide' =>$ide_maqu,
			'mant_fecha' =>$fecha,
			);
		$tisma=$this->mgeneral->get_data_select('mant_ide as ide','mantenimiento',$set);
		$query="delete from tisma where tisma_mant_ide = ".$tisma[0]->ide;
		$this->mgeneral->set_query($query);
		$query="delete from mantenimiento where mant_maqu_ide = ".$ide_maqu.", mant_fecha = STR_TO_DATE('".$fecha."','%d/%m/%y') ";
		$this->mgeneral->set_query($query);
		//$this->mgeneral->eliminar('tisma',array('tisma_mant_ide'=>$tisma[0]->ide));
		//$this->mgeneral->eliminar('mantenimiento',$set);
	}
	/*****************************************************************************/
	public function guardar_insu(){
		extract($_POST);
		$insu=$this->mgeneral->get_data('insumos',array("insu_ide"=>$tisma_insu_ide) );	
		
		$insu_costo=$insu[0]->insu_costoxunidad*$tisma_insu_cant;
		$insu_estado=$insu[0]->insu_estado-$tisma_insu_cant;

		$this->mgeneral->actualizar('insumos',"insu_ide = '".$tisma_insu_ide."'",array('insu_estado' =>$insu_estado)
			);
		$set=array(
			"tisma_mant_ide" => $tisma_mant_ide,
			"tisma_insu_ide" => $tisma_insu_ide,
			"tisma_insu_cant" => $tisma_insu_cant,
			"tisma_insu_costo" => $insu_costo,
		);		
		$this->mgeneral->insertar("tisma",$set);
		$ide_cont=$this->mgeneral->ultimo_ide();

		echo "
		<tr id='tr".$ide_cont[0]->ide."'>
		<td>".$insu[0]->insu_nombre."</td>
		<td class='text-center'>".$tisma_insu_cant."</td>
		<td class='text-center'>".$insu[0]->insu_costoxunidad."</td>
		<td class='text-right'>".$insu_costo."</td>
		<td><button class='btn btn-info btn-sm' onclick=elim_insu('".$ide_cont[0]->ide."')><i class='fa fa-times'></i></button></td>
		</tr>";
	}
	public function elim_insu($ide_tisma){
		$cant=$this->mgeneral->get_data_select(
			"tisma_insu_cant,tisma_insu_ide","tisma","tisma_ide = '".$ide_tisma."'");
	
		$act=$this->mgeneral->get_data_select(
			"insu_estado","insumos","insu_ide = '".$cant[0]->tisma_insu_ide."'");

		$this->mgeneral->actualizar(
			"insumos",
			"insu_ide ='".$cant[0]->tisma_insu_ide."'",
			array('insu_estado' =>$act[0]->insu_estado + $cant[0]->tisma_insu_cant)
			);		
		
		$set = array('tisma_ide' =>$ide_tisma , );		
		$this->mgeneral->eliminar("tisma",$set);
		echo ' '.$act[0]->insu_estado.' '.$cant[0]->tisma_insu_cant;
	}
	/*****************************************************************************/

	public function info_maqu($ide_maqu){
			
		$set = array(
			'maquina'=>$this->mgeneral->get_data_select(
             	"m.*,
             	ma.marc_nombre",
             	 "maquina m,
             	 marca ma",
             	 "m.maqu_ide = '".$ide_maqu."' AND 
             	 ma.marc_ide = m.maqu_marc_ide"
             	 ),
			'ide'=>$ide_maqu,
			);		
		$this->load->view("mantenimiento/info_maqu",$set);
	}
	/*****************************************************************************/
	public function oper_camb_acei(){
		$set = array(
			'aceite' =>$this->mgeneral->get_data_select(
				"m.maqu_descripcion as descripcion,
				m.maqu_tipo as tipo,
				m.maqu_codigo_minag as codigo,
				h.horo_actual,
				h.horo_ultimo_cambio as ulti_ca,
				(h.horo_ultimo_cambio + m.maqu_cambio_aceite) as cambiar_en,
				",
				"maquina m,
				horometro h",
				"m.maqu_ide = h.horo_maqu_ide AND 
				((h.horo_actual - h.horo_ultimo_cambio) > 245 )"
				),
			'aceite2' =>$this->mgeneral->get_data_select(
				"m.maqu_descripcion as descripcion,
				m.maqu_tipo as tipo,
				m.maqu_codigo_minag as codigo,
				h.horo_actual,
				h.horo_ultimo_cambio as ulti_ca,
				(h.horo_ultimo_cambio + m.maqu_cambio_aceite) as cambiar_en,
				",
				"maquina m,
				horometro h",
				"m.maqu_ide = h.horo_maqu_ide AND 
				((h.horo_actual - h.horo_ultimo_cambio) > 245 )"
				),
			'maqu_lista' =>$this->mgeneral->get_data_select(
				"CONCAT_WS( ' / ',
					maqu_descripcion,maqu_codigo_minag,maqu_tipo,maqu_modelo,maqu_ubicacion) AS nombre,
					maqu_ide as ide",
				"maquina",
				"maqu_estado != 'MANTENIMIENTO' ",
				false,
				'maqu_descripcion'
				),
			'horometro' =>$this->mgeneral->get_data_select(
				"maqu_cambio_aceite",
				"maquina",
				"maqu_cambio_aceite + 9584 < 10000"
				),
				 );
		$this->load->view('mantenimiento/cambio_aceite',$set);
	}
/*****************************************************************************/
	public function gest_usua(){
		$data=array(
			"usuarios"=>$this->mgeneral->get_data_select(
				"usua_ide as USUA_IDE,
				 usua_nombres as USUA_NOM,
				 usua_apellidos as USUA_APE,
				 usua_dni as USUA_DNI,
				 usua_user as USUA_USER,
				 usua_pass as USUA_PASS,
				 usua_tipo as USUA_TIPO,
				 usua_estado as USUA_ESTA,
				 usua_freg as USUA_FRE,
				",
				"usuarios",
				false,
				false,"usua_ide asc"),
		);
		$this->load->view("gestion/usua_config",$data);
	}
	public function usua_edit($usua_ide){
			$data=array(
			"usuario"=>$this->mgeneral->get_data(
				"usuarios",
				"usua_ide = '".$usua_ide."'",
				false,"usua_ide"),
			);
			$this->load->view("gestion/form_usua",$data);
	}
	public function usua_func($usua_ide){
			$data=array(
			"usuario"=>$this->mgeneral->get_data_select(
				"CONCAT_WS(', ',u.usua_nombres,u.usua_apellidos) as nombre,
				u.usua_ide as ide",
				"usuarios u",
				"u.usua_ide = '".$usua_ide."'",
				false,""),
			"tareas"=>$this->mgeneral->get_data_select(
				"r.role_ide,r.role_ide as ide,
				r.role_nombre as nombre,
				r.role_tipo as tipo",
				"roles r",
				false,
				false,"r.role_tipo"),
			"tareas_dadas"=>$this->mgeneral->get_data_select(
				"r.role_ide as ide",
				"tareas t,
				roles r",
				"t.tare_usua_ide = '".$usua_ide."' AND
				r.role_ide = t.tare_role_ide",
				false,"r.role_tipo"),
			);
			$this->load->view("gestion/func_usua",$data);
	}
	public function usua_func_edit(){
			
			$this->mgeneral->eliminar('tareas',"tare_usua_ide ='".$_POST['tare_usua_ide']."'");
			$ntare=$this->mgeneral->get_data_select('count(*) as total','roles');
			$set['tare_usua_ide']=$_POST['tare_usua_ide'];
			$i=0;
			foreach ($_POST as $row => $value) {
				if($i !=0){
					$set['tare_role_ide']=$value;
					$this->mgeneral->insertar('tareas',$set);
				}
				$i++;
			}	
	}
	public function usua_nuevo(){
			$this->load->view("gestion/form_empty");
	}
	public function usua_action(){

		if ($_POST['ope_type']=='edit') {
			$set = array(
				'usua_nombres'=>$_POST['usua_nombres'],
				'usua_apellidos'=>$_POST['usua_apellidos'],
				'usua_dni'=>$_POST['usua_dni'],
				'usua_tipo'=>$_POST['usua_tipo'],
				'usua_estado'=>$_POST['usua_estado'],
				'usua_user'=>$_POST['usua_user'],
				'usua_pass'=>$_POST['usua_pass'],
				);
			$this->mgeneral->actualizar('usuarios',"usua_ide = '".$_POST['usua_ide']."'",$set);
			echo $_POST['usua_ide'];

		} elseif ($_POST['ope_type']=='elim') {
			$this->mgeneral->eliminar('usuarios',"usua_ide = '".$_POST['usua_ide']."'");
		} elseif ($_POST['ope_type']=='nuev') {
			$set = array(
				'usua_nombres'=>$_POST['usua_nombres'],
				'usua_apellidos'=>$_POST['usua_apellidos'],
				'usua_dni'=>$_POST['usua_dni'],
				'usua_tipo'=>$_POST['usua_tipo'],
				'usua_estado'=>$_POST['usua_estado'],
				'usua_user'=>$_POST['usua_user'],
				'usua_pass'=>$_POST['usua_pass'],
				);
			$this->mgeneral->insertar('usuarios',$set);
			$ide=$this->mgeneral->ultimo_ide();
			echo $ide[0]->ide;
		}
	}

	/*****************************************************************************/
	public function gest_maqu(){
		$data=array(
			"maquina"=>$this->mgeneral->get_data_select(
				"maqu_ide as MAQU_IDE,
				maqu_modelo as MAQU_MOD,
				maqu_descripcion as MAQU_DES,
				maqu_codigo as MAQU_COD,
				maqu_tipo as MAQU_TIP,
				maqu_ubicacion as MAQU_UBI,
				maqu_estado as MAQU_EST,
				marc_nombre as MAQU_MARC,
				(marc_ide-1) as color_ide 
				",
				"maquina,marca",
				'marc_ide = maqu_marc_ide',
				false,"marc_ide asc"),
		);
		$this->load->view("gestion/maqu_config",$data);
	}
	/*****************************************************************************/
	public function gest_marc(){
		$set = array(
			'marca' =>$this->mgeneral->get_data('marca'),
			'marc_lista' =>$this->mgeneral->get_data_select(
				'marc_ide as ide, marc_nombre as nombre','marca',false,false,'marc_ide'),
			);
		$this->load->view('gestion/marc_config',$set);
	}
	public function act_marc(){
		extract($_POST);
		$set = array(
			'marc_nombre' =>$marc_nombre,
			'marc_gasolina' =>$marc_gasolina,
			);
		$this->mgeneral->actualizar('marca',"marc_ide ='".$marc_ide."'",$set);
		$marc=$this->mgeneral->get_data('marca',"marc_ide ='".$marc_ide."'");
        $this->list_marc();
	}
	public function new_marc(){
		extract($_POST);
		$set = array(
			'marc_nombre' =>$marc_nombre,
			'marc_gasolina' =>$marc_gasolina,
			);
		$this->mgeneral->insertar('marca',$set);
        $this->list_marc();
	}
	public function list_marc(){
		$set = array(
			'marca' =>$this->mgeneral->get_data('marca',false,false,'marc_nombre asc')
			);
		$this->load->view('gestion/list_marc',$set);
	}
	/*****************************************************************************/
	public function gest_insu(){
		$set = array(
			'insumos' =>$this->mgeneral->get_data('insumos'),
			'insu_lista' =>$this->mgeneral->get_data_select(
				'insu_ide as ide, insu_nombre as nombre','insumos',false,false,'insu_nombre'),
			);
		$this->load->view('gestion/insu_config',$set);
	}
	public function act_insu(){
		extract($_POST);
		$set = array(
			'insu_estado' =>$insu_estado,
			'insu_unidad_medida' =>$insu_unidad_medida,
			'insu_costoxunidad' =>$insu_costoxunidad,
			);
		$this->mgeneral->actualizar('insumos',"insu_ide ='".$insu_ide."'",$set);
		$insu=$this->mgeneral->get_data('insumos',"insu_ide ='".$insu_ide."'");
        $this->list_insu();
	}
	public function new_insu(){
		extract($_POST);
		$set = array(
			'insu_estado' =>$insu_estado,
			'insu_nombre' =>$insu_nombre,
			'insu_unidad_medida' =>$insu_unidad_medida,
			'insu_costoxunidad' =>$insu_costoxunidad,
			);
		$this->mgeneral->insertar('insumos',$set);
        $this->list_insu();
	}
	public function list_insu(){
		$set = array(
			'insumos' =>$this->mgeneral->get_data('insumos',false,false,'insu_nombre asc')
			);
		$this->load->view('gestion/list_insu',$set);
	}

	/*****************************************************************************/
	

	/*****************************************************************************/
}