<?php
	class ajaxModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function valormoneda($idmoneda,$codemp){
			$this->db->query("SELECT * FROM moneda WHERE idmoneda=$idmoneda AND codemp=$codemp");
	      	return $this->db->register();
		}

		public function seleccionarproveedor($search,$codemp){
			$this->db->query("SELECT idproveedor,razonsocial as value,razonsocial as label
								FROM proveedor
								WHERE (razonsocial LIKE '%$search%' OR ruc LIKE '%$search%') AND codemp=$codemp");
			return $this->db->registers();
		}

		public function seleccionarproductocodigo($search,$codsuc){
			$this->db->query("select p.idproducto,p.serie as value, CONCAT(p.producto,' ',m.marca,' ',mo.modelo) as producto, p.idunidad, um.nombrecorto as unidad
				from producto p
				inner join marca m on m.idmarca=p.idmarca
				inner join modelo mo on mo.idmodelo=p.idmodelo
				inner join unidadmedida um on um.idunidad=p.idunidad
				where p.estado=1 and p.codsuc=$codsuc and   p.serie like '%$search%'");
			return $this->db->registers();
		}

		public function seleccionarproductonombre($search,$codsuc){
			$this->db->query("select p.idproducto,p.serie, CONCAT(p.producto,' ',m.marca,' ',mo.modelo) as value, p.idunidad, um.nombrecorto as unidad
				from producto p
				inner join marca m on m.idmarca=p.idmarca
				inner join modelo mo on mo.idmodelo=p.idmodelo
				inner join unidadmedida um on um.idunidad=p.idunidad
				where p.estado=1 and p.codsuc=$codsuc and  CONCAT(p.producto,' ',m.marca,' ',mo.modelo) like '%$search%'");
			return $this->db->registers();
		}

	}
?>
