<?php
	class configuracionModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tablatipodocumento($codemp){
			$this->db->query("SELECT * FROM tipodocumento WHERE codemp = $codemp");
	      	return $this->db->registers();
		}

		public function vertipodocumento($idtipodocumento){
			$this->db->query("SELECT * FROM tipodocumento WHERE idtipodocumento = $idtipodocumento");
	      	return $this->db->register();
		}

		public function validartipodocumento($codigo,$codemp){
	      $this->db->query("SELECT * FROM tipodocumento WHERE codigo = $codigo AND codemp=$codemp");
	      return $this->db->register();
		}

		public function eliminartipodocumento($idtipodocumento){
			$this->db->query("SELECT estado FROM cliente WHERE idtipodocumento=$idtipodocumento");
			$items = $this->db->registers();
			if(empty($items)){
				$this->db->query("DELETE FROM tipodocumento WHERE idtipodocumento=$idtipodocumento");
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
