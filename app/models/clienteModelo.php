<?php
	class clienteModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT cl.*,td.nombrecorto
								FROM cliente cl
								INNER JOIN tipodocumento td ON td.idtipodocumento=cl.idtipodocumento
								WHERE cl.codemp = $codemp ORDER BY cl.idcliente DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idcliente){
			$this->db->query("SELECT * FROM cliente WHERE idcliente = $idcliente");
	      	return $this->db->register();
		}

		public function validardatos($numero,$codemp){
	      $this->db->query("SELECT * FROM cliente WHERE numero='$numero' AND codemp=$codemp");
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
