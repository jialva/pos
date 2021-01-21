<?php
	class proveedoresModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT * FROM proveedor WHERE codemp = $codemp ORDER BY idproveedor DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idproveedor){
			$this->db->query("SELECT * FROM proveedor WHERE idproveedor = $idproveedor");
	      	return $this->db->register();
		}

		public function validardatos($ruc,$codemp){
	      $this->db->query("SELECT * FROM proveedor WHERE ruc='$ruc' AND codemp=$codemp");
	      return $this->db->register();
		}

		public function autocomplete($search,$opcion){
			if($opcion == 1){
				$this->db->query("SELECT idusuario,CONCAT(nombre,' ',apellido) as value,usuario FROM usuario WHERE CONCAT(nombre,' ',apellido) LIKE '%$search%' AND idrol=0");
			}else{
				$this->db->query("SELECT idusuario,usuario as value,CONCAT(nombre,' ',apellido) as nombre FROM usuario WHERE usuario LIKE '%$search%' AND idrol=0");
			}	      
	      	return $this->db->registers();
		}

	}
?>
