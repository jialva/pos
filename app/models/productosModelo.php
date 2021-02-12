<?php
	class productosModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT p.idproducto,ca.categoria,p.producto,ma.marca,mo.modelo,un.nombrelargo,p.stock
							FROM producto p
							INNER JOIN categoria ca ON ca.idcategoria=p.idcategoria  
							INNER JOIN marca ma ON ma.idmarca=p.idmarca
							INNER JOIN modelo mo ON mo.idmodelo=p.idmodelo
							INNER JOIN unidadmedida un ON un.idunidad=p.idunidad
							WHERE p.codemp = $codemp ORDER BY p.idproducto DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idproducto){
			$this->db->query("SELECT * FROM producto WHERE idproducto = $idproducto");
	      	return $this->db->register();
		}

		public function validardatos($idproducto,$producto,$idcategoria,$idunidad,$idmarca,$idmodelo,$serie,$codemp){
			$and='';
			if($idproducto!=''){
				$and = ' AND idproducto<>'.$idproducto;
			}
		    $this->db->query("SELECT * FROM producto WHERE producto='$producto' AND idcategoria=$idcategoria AND idunidad=$idunidad AND idmarca=$idmarca AND idmodelo=$idmodelo AND codemp=$codemp $and");
			$item = $this->db->register();
			if(empty($item)){
		    	if($serie !=''){
		    		$this->db->query("SELECT * FROM producto WHERE serie='$serie' AND idcategoria=$idcategoria AND codemp=$codemp $and");
		    		if(empty($this->db->register())){
		    			return 0;
		    		}else{
		    			return 4;
		    		}
		    	}
		    	return 0;    	
		    }else{
		    	return 3;
		    }
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
