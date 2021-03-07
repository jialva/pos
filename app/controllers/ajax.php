<?php
	class ajax extends Controller{

		public function __construct(){
	      if(Session::get('autenticado')){
				$this->ajax = $this->model('ajaxModelo');
	      	}
		}

	    public function index(){}

	    public function valormoneda(){
	    	$idmoneda = $_POST['idmoneda'];
	    	$codemp = 1;
	    	$valor = $this->ajax->valormoneda($idmoneda,$codemp);
	    	echo $valor['valor'];
	    }

	    public function proveedor(){
	    	$codemp = 1;
			$search = $_GET['search'];
			$resp = $this->ajax->seleccionarproveedor($search,$codemp);
			foreach ($resp as $row) {
				$var[]=$row;
			}
			echo json_encode($var);
	    }

	    public function productocodigo(){
	    	$codsuc = 1;
			$search = $_GET['search'];
			$resp = $this->ajax->seleccionarproductocodigo($search,$codsuc);
			foreach ($resp as $row) {
				$var[]=$row;
			}
			echo json_encode($var);
	    }

	    public function productonombre(){
	    	$codsuc = 1;
			$search = $_GET['search'];
			$resp = $this->ajax->seleccionarproductonombre($search,$codsuc);
			foreach ($resp as $row) {
				$var[]=$row;
			}
			echo json_encode($var);
	    }

	    
	}
?>
