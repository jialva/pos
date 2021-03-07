<?php
	class registrarcompra extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->compras = $this->model('comprasModelo');
				$this->menu();
				$acc = $this->acceso(Session::get('idrol'),Session::get('idusuario'),Session::get('url'));
				if(!$acc){
					$this->redireccionar('errors/denegado');
				}else{
					$this->ver = $acc['ver'];
					$this->editar = $acc['editar'];
					$this->eliminar = $acc['eliminar'];
					$this->crear = $acc['crear'];
				}
	      	}else{
	       		$this->redireccionar();
	      	}
		}

		public function index(){
			$codemp = 1;
			$documento = $this->select('correlativo','descripcion','idcorrelativo',1,' AND categoria in(1,2) AND codemp='.$codemp);
			$moneda = $this->select('moneda','moneda','idmoneda',1,' AND codemp='.$codemp);
			$unidad = $this->select('unidadmedida','nombrelargo','idunidad',1,' AND codemp='.$codemp);
			$date=[
				'titulo'=>'Registrar Compra',
				'nombretabla'=>'Registrar Compra',
				'url'=> Session::get('url'),
				'modulo'=> 'Compras',
				'add'=> $this->ver,
				'documento'=>$documento,
				'moneda'=>$moneda,
				'unidad'=>$unidad
			];
			$js = [
	      		'0'=>'compras.js'
	      	];
			$this->viewAdmin('compras/registrar',$js,$date);
		}

		public function guardar(){
			$codemp = 1;
			$codsuc = 1;
			$idusuario = Session::get('idusuario');
			$fechacompra = $_POST['fechacompra'];
			$fechareg = date('Y-m-d');
			$idproveedor = $_POST['idproveedor'];
			$tipocompra = $_POST['tipocompra'];
			$idcomprobante = $_POST['idcomprobante'];
			$serienumero = $_POST['serienumero'];
			$moneda = $_POST['moneda'];
			$valormoneda = $_POST['valormoneda'];
			$origen = $_POST['origen'];
			$subtotal = $_POST['subtotal'];
			$igv = $_POST['igv'];
			$totalventa = $_POST['totalventa'];
			$codigo = $_POST['icodigo'];
			$idproducto = $_POST['iidproducto'];
			$idunidad = $_POST['iidunidad'];
			$cantidad = $_POST['icantidad'];
			$precio = $_POST['iprecio'];
			$importe = $_POST['iimporte'];
			$resp = $this->compras->guardarcompra($codemp,$codsuc,$idusuario,$fechacompra,$fechareg,$idproveedor,$tipocompra,$idcomprobante,$serienumero,$moneda,$valormoneda,$origen,$subtotal,$igv,$totalventa,$codigo,$idproducto,$idunidad,$cantidad,$precio,$importe);
			echo $resp;
		}

	}
?>
