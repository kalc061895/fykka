<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mgeneral extends CI_Model{
	
	function login($user,$pass){
		
		$tabla = "login";
		$campo_user="log_user";
		$campo_pass="log_pass";
		$this->db->select("
			log_usu_ide as ide
		",false);
		$this->db->from($tabla);
		$this->db->where($campo_user,$user);
		$this->db->where($campo_pass,$pass);
		$query=$this->db->get();
		if($query->num_rows()==1){
			return $query->result();
		}
		return false;
	}
	function usuario_data($ide){
		
		$tabla = "usuarios";
		
		$where = array('usu_ide' =>$ide , 
	);
		$this->db->select("
			*
		",false);
		$this->db->from($tabla);
		$this->db->where($where);
		$query=$this->db->get();
		if($query->num_rows()==1){
			return $query->result();
		}
		return false;
	}
	
	public function query($query){
		$query=$this->db->query($query);
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	public function set_query($query){
		if($this->db->query($query)){
			return true;
		};
		return false;
	}
	
	public function insertar($tabla,$data){
		$this->db->insert($tabla,$data);
		$result=$this->db->affected_rows();
		return $result;
	}
	
	public function actualizar($tabla,$where,$data){
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update($tabla);
		$result=$this->db->affected_rows();
		return $result;
	}
	
	public function eliminar($tabla,$where){
		$this->db->delete($tabla,$where);
		$result=$this->db->affected_rows();
		return $result;
	}
	
	function ultimo_ide(){
		$this->db->select("
			last_insert_id() as ide
		",false);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	
	public function get_data($tabla,$where=false,$like=false,$order=false){
		$this->db->select("*");
		$this->db->from($tabla);
		if($where!=false)
			$this->db->where($where);
		if($like!=false)
			$this->db->like($like);
		if($order!=false)
			$this->db->order_by($order);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	public function get_data_t($tabla,$where=false,$like=false,$order=false){
		$this->db->select("*");
		$this->db->from($tabla);
		if($where!=false)
			$this->db->where($where);
		if($like!=false)
			$this->db->like($like);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $set_query;
		}
		return false;
	}
	
	public function get_data_select($select,$tabla,$where=false,$like=false,$order=false){
		$this->db->select($select,false);
		$this->db->from($tabla);
		if($where!=false)
			$this->db->where($where);
		if($like!=false)
			$this->db->like($like);
		if($order!=false)
			$this->db->order_by($order);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	
	public function get_roles(){
		$this->db->select("
			r.*
		",false);
		$this->db->from("
			tareas t,
			roles r
		");

		//$this->db->where("role_tipo_usuario",$this->session->userdata("tipo"));
		$this->db->where("r.rol_ide = t.tar_rol_ide  AND
			t.tar_usu_ide = '".$this->session->userdata("ide")."'"
			);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	public function get_tecnico(){
		$this->db->select("
			tec.*
		",false);
		$this->db->from("
			tecnicos tec,
			turnos tur
		");
		$this->db->where("tec.tecn_turn_nombre = tur.turn_nombre");
		$this->db->where("tur.turn_inicio <= substr(now(),12)");
		$this->db->where("substr(now(),12) < tur.turn_fin");
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}

	public function get_numeracion($cate_ide){
		$this->db->select("
			if(
				count(*)<10,
				concat('00',count(*)+1),
				if(
					count(*)<100,
					concat('0',count(*)+1),
					concat('',count(*)+1)
				)
			) as numeracion
		",false);
		$this->db->from("
			tickets t
		");
		$this->db->where("t.tick_cate_ide = $cate_ide");
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	
}
?>