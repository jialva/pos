<?php
	class abrircaja extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->caja = $this->model('cajaModelo');
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
				'titulo'=>'Abrir Cajas',
				'nombretabla'=>'Abrir Caja',
				'url'=> Session::get('url'),
				'modulo'=> 'Caja',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'abrircaja.js'
	      	];
			$this->viewAdmin('abrircaja/index',$js,$date);
		}

		public function tabla(){
			$codsuc = 1;
			$idusuario = Session::get('idusuario');
			$items = $this->caja->tablaapertura($codsuc,$idusuario);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>ITEM</th>
                                <th>CAJA</th>
                                <th>FECHA APERTURA</th>
                                <th>MONTO APERTURA</th>
                                <th>FECHA CIERRE</th>
                                <th>SALDO</th>
                                <th>ACCI&Oacute;N</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['caja'].'</td>
	                                <td>'.$row['apertura'].'</td>
	                                <td>'.$row['montoapertura'].'</td>
	                                <td>'.$row['cierre'].'</td>
	                                <td>'.$row['montocierre'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idapertura'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idapertura'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idapertura'].'\')"></i>';
	                                }	                                
	                            $cad .='</td>
	                            </tr>';
	                            $c++;
                        }
                $cad .='</tbody>
					</table>';
			echo $cad;
		}

		public function guardar(){
			$idapertura = $_POST['idapertura'];
			$codemp = 1;
			$codsuc = 1;
			$idusuario = Session::get('idusuario');
			$fechaapertura = $_POST['fechaapertura'];
			$montoapertura = $_POST['montoapertura'];
			$idcaja = $this->caja->validarcajausuario($idusuario,$codemp,$codsuc);
			if(empty($idcaja)){
				$arr = [
							'ok'=>3,
							'message'=>'No se encontró ninguna caja asignado a su usuario!!!'
						];
			}else{
				if($idcaja['aperturado']==1){
					$arr = [
							'ok'=>4,
							'message'=>'Tiene una caja aperturada con su usuario!!!'
						];
				}else{
					if($idapertura == ''){
						$resp = $this->caja->guardarapertura($codemp,$codsuc,$idusuario,$idcaja['idcaja'],$fechaapertura,$montoapertura);
						$arr = [
								'ok'=>1,
								'message'=>'Caja Aperturada!!!'
							];
					}else{
						$data = [
									'idcategoria'=>$idcategoria,
									'categoria'=>$categoria
								];
						$sql = $this->update($data,'categoria');
						if($sql==2){
							$arr = [
								'ok'=>1,
								'message'=>'Categoría actualizada!!!'
							];
						}else{
							$arr = [
								'ok'=>0,
								'message'=>'Error al actualizar!!!'
							];
						}
					}
				}
			}
			echo json_encode($arr);
		}

		public function verregistro(){
			$idcategoria = $_POST['idcategoria'];
			$sql = $this->categoria->verregistro($idcategoria);
			$arr =[
					'categoria'=>$sql['categoria']
				];
			echo json_encode($arr);
		}
	}
?>
