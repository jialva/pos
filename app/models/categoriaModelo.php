<?php
	class categoriaModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT * FROM categoria WHERE estado = 1 AND codemp=$codemp ORDER BY idcategoria DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idcategoria){
			$this->db->query("SELECT * FROM categoria WHERE idcategoria = $idcategoria");
	      	return $this->db->register();
		}

		public function validardatos($categoria,$codemp){
	      $this->db->query("SELECT * FROM categoria WHERE categoria='$categoria' AND codemp=$codemp");
	      return $this->db->register();
		}

	}
?>
