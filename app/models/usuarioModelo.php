<?php
	class usuarioModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla(){
			$this->db->query("SELECT * FROM usuario WHERE estado = 1");
	      	return $this->db->registers();
		}

		public function validardatos($usuario){
	      $this->db->query("SELECT * FROM usuario WHERE usuario='$usuario'");
	      return $this->db->register();
		}


	}
?>
