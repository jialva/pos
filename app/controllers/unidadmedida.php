<?php
	class unidadmedida extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->unidad = $this->model('unidadModelo');
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
				'titulo'=>'Administrar Unidades',
				'nombretabla'=>'Unidad de Medida',
				'url'=> Session::get('url'),
				'modulo'=> 'Configuración',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'unidadmedida.js'
	      	];
			$this->viewAdmin('unidadmedida/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->unidad->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>
                                <th>Nombre Largo</th>
                                <th>Nombre Corto</th>
                                <th>Conversi&oacute;n</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['nombrelargo'].'</td>
	                                <td>'.$row['nombrecorto'].'</td>
	                                <td>'.$row['conversion'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idunidad'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idunidad'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idunidad'].'\')"></i>';
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
			$idunidad = $_POST['idunidad'];
			$nombrelargo = $_POST['nombrelargo'];
			$nombrecorto = $_POST['nombrecorto'];
			$conversion = $_POST['conversion'];
			$codemp = 1;
			$codsuc = 1;
			if($idunidad == ''){
				$sql = $this->unidad->validardatos($nombrelargo,$nombrecorto,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'nombrelargo'=>$nombrelargo,
								'nombrecorto'=>$nombrecorto,
								'conversion'=>$conversion,
								'estado'=>1
							];
					$sql = $this->save($data,'unidadmedida');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Unidad de medida registrada!!!'
						];
					}else{
						$arr = [
							'ok'=>0,
							'message'=>'Error al registrar!!!'
						];
					}
				}else{
					$arr = [
							'ok'=>3,
							'message'=>'La unidad ingresada ya existe'
						];
				}
			}else{
				$data = [
							'idunidad'=>$idunidad,
							'nombrelargo'=>$nombrelargo,
							'nombrecorto'=>$nombrecorto,
							'conversion'=>$conversion
						];
				$sql = $this->update($data,'unidadmedida');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Unidad de medida actualizado!!!'
					];
				}else{
					$arr = [
						'ok'=>0,
						'message'=>'Error al actualizar!!!'
					];
				}
			}
			echo json_encode($arr);
		}

		public function verregistro(){
			$idunidad = $_POST['idunidad'];
			$sql = $this->unidad->verregistro($idunidad);
			$arr =[
					'nombrelargo'=>$sql['nombrelargo'],
					'nombrecorto'=>$sql['nombrecorto'],
					'conversion'=>$sql['conversion']
				];
			echo json_encode($arr);
		}
	}
?>
