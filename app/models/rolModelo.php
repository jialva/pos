<?php
	class rolModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($idrol = ''){
			$and='';
			if($idrol != ''){
				$and ="AND idrol=$idrol";
			}
			$this->db->query("SELECT * FROM rol WHERE estado = 1 $and ORDER BY idrol DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idusuario){
			$this->db->query("SELECT * FROM usuario WHERE idusuario = $idusuario");
	      	return $this->db->register();
		}

		public function validardatos($usuario){
	      $this->db->query("SELECT * FROM usuario WHERE usuario='$usuario'");
	      return $this->db->register();
		}

		public function usuariosagregados($idrol,$codemp){
			$this->db->query("SELECT codemp,codsuc,idusuario,nombre,apellido,usuario FROM usuario WHERE idrol = $idrol AND codemp = $codemp");
	      	return $this->db->registers();
		}

		public function addusuariorol($idrol,$idusuario){
			$this->db->query("UPDATE usuario SET idrol=$idrol WHERE idusuario=$idusuario");
			if($this->db->execute()){
				return 1;
			}else{
				return 0;
			}
		}

		public function modulos($codemp){
			$this->db->query("SELECT * FROM modulo WHERE codemp = $codemp AND modulo_padre = 1");
	      	return $this->db->registers();
		}

		public function submodulo($idmodulo){
			$this->db->query("SELECT idmodulo,modulo FROM modulo WHERE modulo_padre = $idmodulo");
	      	return $this->db->registers();
		}

		public function accesos($idusuario,$idmodulo){
			$this->db->query("SELECT * FROM permisos WHERE idusuario = $idusuario AND idmodulo=$idmodulo");
	      	return $this->db->register();
		}

		public function quitar($idusuario,$idmodulo){
			$this->db->query("DELETE FROM permisos WHERE idusuario=$idusuario AND idmodulo=$idmodulo");
			if($this->db->execute()){
				return 1;
			}else{
				return 0;
			}
		}

		public function agregar($idusuario,$idmodulo,$idrol){
			$this->db->query("INSERT INTO permisos(idmodulo,idrol,idusuario,ver,editar,crear,eliminar) VALUES($idmodulo,$idrol,$idusuario,0,0,0,0)");
			if($this->db->execute()){
				return 1;
			}else{
				return 0;
			}
		}

		public function marcar($idusuario,$idmodulo,$idrol,$opcion,$valor){
			switch ($opcion) {
				case 1:$this->db->query("UPDATE permisos SET ver=$valor WHERE idusuario=$idusuario AND idrol=$idrol AND idmodulo=$idmodulo");break;
				case 2:$this->db->query("UPDATE permisos SET crear=$valor WHERE idusuario=$idusuario AND idrol=$idrol AND idmodulo=$idmodulo");break;
				case 3:$this->db->query("UPDATE permisos SET editar=$valor WHERE idusuario=$idusuario AND idrol=$idrol AND idmodulo=$idmodulo");break;
				case 4:$this->db->query("UPDATE permisos SET eliminar=$valor WHERE idusuario=$idusuario AND idrol=$idrol AND idmodulo=$idmodulo");break;
			}
			if($this->db->execute()){
				return 1;
			}else{
				return 0;
			}
		}

		public function eliminar($idrol){
			$this->db->query("SELECT estado FROM usuario WHERE idrol=$idrol");
			$items = $this->db->registers();
			if(empty($items)){
				$this->db->query("DELETE FROM rol WHERE idrol=$idrol");
				if($this->db->execute()){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		}

	}
?>
