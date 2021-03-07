<?php
	class vercompras extends Controller{

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
			$date=[
				'titulo'=>'Compras',
				'nombretabla'=>'Compras',
				'url'=> Session::get('url'),
				'modulo'=> 'Compras',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'compras.js'
	      	];
			$this->viewAdmin('compras/index',$js,$date);
		}
    

		public function tabla(){
			$codsuc = 1;
			$items = $this->compras->tabla($codsuc);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>
                                <th>Fecha</th>
                                <th>Razón Social</th>
                                <th>Comprobante</th>
                                <th>Importe</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['fecha'].'</td>
	                                <td>'.$row['razonsocial'].'</td>
	                                <td>'.$row['documento'].'</td>
	                                <td>'.$row['importetotal'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idcabcompra'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idcabcompra'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idcabcompra'].'\')"></i>';
	                                }	                                
	                            $cad .='</td>
	                            </tr>';
	                            $c++;
                        }
                $cad .='</tbody>
					</table>';
			echo $cad;
		}
	}
?>
