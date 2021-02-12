<?php
	class cajaModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codemp){
			$this->db->query("SELECT * FROM caja WHERE estado = 1 AND codemp=$codemp ORDER BY idcaja DESC");
	      	return $this->db->registers();
		}

		public function tablaapertura($codsuc,$idusuario){
			$this->db->query("SELECT ac.idapertura,c.caja,date_format(ac.fechaapertura,'%d-%m-%Y') as apertura,ac.montoapertura,date_format(ac.fechacierre,'%d-%m-%Y') as cierre,ac.montocierre,ac.aperturado,ac.estado
								FROM aperturacaja ac 
								INNER JOIN caja c ON c.idcaja=ac.idcaja
								WHERE ac.estado = 1 AND ac.codsuc=$codsuc AND ac.idusuario=$idusuario ORDER BY ac.idapertura DESC");
	      	return $this->db->registers();
		}

		public function verregistro($idcaja){
			$this->db->query("SELECT * FROM caja WHERE idcaja = $idcaja");
	      	return $this->db->register();
		}

		public function validardatos($caj,$codemp){
	      $this->db->query("SELECT * FROM caja WHERE caja='$caja' AND codemp=$codemp");
	      return $this->db->register();
		}

		public function validarapertura($idusuario,$codemp,$codsuc){
			$this->db->query("SELECT * FROM aperturacaja WHERE idusuario=$idusuario AND aperturado=1 AND codsuc=$codsuc AND codemp=$codemp");
	      	return $this->db->register();
		}

		public function validarcajausuario($idusuario,$codemp,$codsuc){
			$this->db->query("SELECT idcaja,aperturado FROM caja WHERE idusuario=$idusuario AND codsuc=$codsuc AND codemp=$codemp");
	      	return $this->db->register();
		}

		public function guardarapertura($codemp,$codsuc,$idusuario,$idcaja,$fechaapertura,$montoapertura){
			try {
				$fechaapertura = $fechaapertura.' '.date('H:i:s');
				$this->db->transaccion();

				$this->db->query("INSERT INTO aperturacaja(codemp,codsuc,idusuario,idcaja,fechaapertura,montoapertura,montocierre,aperturado,estado) VALUES($codemp,$codsuc,$idusuario,$idcaja,'$fechaapertura',$montoapertura,$montoapertura,1,1)");
				$this->db->execute();

				$this->db->query("UPDATE caja SET aperturado=1 WHERE idcaja=$idcaja");
				$this->db->execute();

				$this->db->commit();
				return 1;
			} catch (Exception $e) {
				$this->db->rollBack();
				return $e->getMessage();	
			}
		}

	}
?>
