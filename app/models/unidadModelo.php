<?php
	class unidadModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT * FROM unidadmedida WHERE estado = 1 AND codemp=$codemp ORDER BY idunidad DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idunidad){
			$this->db->query("SELECT * FROM unidadmedida WHERE idunidad = $idunidad");
	      	return $this->db->register();
		}

		public function validardatos($nombrelargo,$nombrecorto,$codemp){
	      $this->db->query("SELECT * FROM unidadmedida WHERE (nombrelargo='$nombrelargo' OR nombrecorto='$nombrecorto') AND codemp=$codemp");
	      return $this->db->register();
		}

	}
?>
