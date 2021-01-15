<?php
	class usuarioModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla(){
			$this->db->query("SELECT * FROM usuario WHERE estado = 1 ORDER BY idusuario DESC");
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
