<?php
	class errors extends Controller{

		public function __construct(){
	      $this->menu();
		}

	    public function index(){
			$date=[
				'titulo'=>'Página no encontrada',
				'modulo'=>''
			];
				$this->viewError('error/404',$date);
		}

		public function denegado(){
			$date=[
				'titulo'=>'Acceso restringido',
				'modulo'=>''
			];
				$this->viewError('error/denegado',$date);
		}
	}
?>
