<?php
	class marcamodeloModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT * FROM marca WHERE estado = 1 AND codemp=$codemp ORDER BY idmarca DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idmarca){
			$this->db->query("SELECT * FROM marca WHERE idmarca = $idmarca");
	      	return $this->db->register();
		}

		public function validardatos($marca,$codemp){
	      $this->db->query("SELECT * FROM marca WHERE marca='$marca' AND codemp=$codemp");
	      return $this->db->register();
		}

		public function vermodelos($idmarca){
			$this->db->query("SELECT idmodelo,modelo
								FROM modelo
								WHERE idmarca=$idmarca ORDER BY idmodelo DESC");
	      	return $this->db->registers();
		}

		public function verregistromodelo($idmodelo){
			$this->db->query("SELECT * FROM modelo WHERE idmodelo=$idmodelo");
	      	return $this->db->register();
		}

		public function validardatosmodelo($modelo,$idmarca){
			$this->db->query("SELECT * FROM modelo WHERE modelo='$modelo' AND idmarca=$idmarca");
	      return $this->db->register();
		}

	}
?>
