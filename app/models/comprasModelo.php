<?php
	class comprasModelo{
		private $db;

		public function __construct()
		{
			$this->db = new DataBase;
		}

		public function tabla($codsuc){
			$this->db->query("SELECT cab.idcabcompra,DATE_FORMAT(cab.fechacompra,'%d-%m-%Y') as fecha,pro.razonsocial,CONCAT(cor.abreviado,'-',cab.nrocomprobante) as documento,cab.importetotal
				FROM cabcompra cab
				INNER JOIN proveedor pro ON pro.idproveedor=cab.idproveedor
				INNER JOIN correlativo cor ON cor.idcorrelativo=cab.idcomprobante
							WHERE cab.codsuc=$codsuc");
			return $this->db->registers();
		}

		public function guardarcompra($codemp,$codsuc,$idusuario,$fechacompra,$fechareg,$idproveedor,$tipocompra,$idcomprobante,$serienumero,$moneda,$valormoneda,$origen,$subtotal,$igv,$totalventa,$codigo,$idproducto,$idunidad,$cantidad,$precio,$importe){			
			try {
				$this->db->transaccion();
				$this->db->query("INSERT INTO cabcompra(codemp,codsuc,idusuario,fechareg,fechacompra,idproveedor,tipocompra,idcomprobante,nrocomprobante,moneda,valormoneda,idsalida,subtotal,igv, importetotal,anulado,estado) VALUES($codemp,$codsuc,$idusuario,'$fechareg','$fechacompra',$idproveedor,$tipocompra,$idcomprobante,'$serienumero',$moneda,$valormoneda,$origen,$subtotal,$igv,$totalventa,0,1)");
				$this->db->execute();

				$this->db->query("SELECT idcabcompra FROM cabcompra WHERE codemp=$codemp");
				$idcabcompra = $this->db->register();
				$idcabcompra = $idcabcompra[0];

				for ($i=0; $i < count($idproducto); $i++) {
					$this->db->query("SELECT stock FROM producto WHERE idproducto=".$idproducto[$i]);
					$stock = $this->db->register();
					$stock = $stock[0]+$cantidad[$i];

					$this->db->query("UPDATE producto SET stock=$stock WHERE idproducto=".$idproducto[$i]);
					$this->db->execute();
					
					$this->db->query("INSERT INTO detcompra(codemp,codsuc,idcabcompra,idproducto,idunidad,serie,cantidad,preciounitario,importe,anulado,estado) VALUES($codemp,$codsuc,$idcabcompra,".$idproducto[$i].",".$idunidad[$i].",".$codigo[$i].",".$cantidad[$i].",".$precio[$i].",".$importe[$i].",0,1)");
					$this->db->execute();

					$this->db->query("INSERT INTO kardex_entrada(codemp,codsuc,idcabcompra,idproducto,idusuario,fechareg,cantidad,precio,estado) VALUES($codemp,$codsuc,$idcabcompra,".$idproducto[$i].",$idusuario,'$fechareg',".$cantidad[$i].",".$precio[$i].",1)");
					$this->db->execute();
				}				

				$this->db->commit();
				return 1;
			} catch (Exception $e) {
				$this->db->rollBack();
				return $e->getMessage();
			}
		}

	}
?>
