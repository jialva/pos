<?php
	class proveedores extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->proveedores = $this->model('proveedoresModelo');
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
				'titulo'=>'Administrar Proveedores',
				'nombretabla'=>'Administrar Proveedores',
				'url'=> Session::get('url'),
				'modulo'=> 'Registrar',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'proveedores.js'
	      	];
			$this->viewAdmin('proveedores/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->proveedores->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>
                                <th>Raz&oacute;n Social</th>
                                <th>Nombre Comercial</th>
                                <th>Tipo</th>
                                <th>R.U.C</th>
                                <th>Tel&eacute;fono</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['razonsocial'].'</td>
	                                <td>'.$row['nombrecomercial'].'</td>
	                                <td>'.$row['tipo'].'</td>
	                                <td>'.$row['ruc'].'</td>
	                                <td>'.$row['telefono'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idproveedor'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idproveedor'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idproveedor'].'\')"></i>';
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
			$idproveedor = $_POST['idproveedor'];
			$tipo = $_POST['tipo'];
			$ruc = $_POST['ruc'];
			$razonsocial = $_POST['razonsocial'];
			$nombrecomercial = $_POST['nombrecomercial'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];
			$estado = $_POST['estado'];
			$codemp = 1;
			$codsuc = 1;
			if($idproveedor == ''){
				$sql = $this->proveedores->validardatos($ruc,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'tipo'=>$tipo,
								'ruc'=>$ruc,
								'razonsocial'=>$razonsocial,
								'nombrecomercial'=>$nombrecomercial,
								'telefono'=>$telefono,
								'email'=>$email,
								'direccion'=>$direccion,
								'estado'=>$estado,
								'fecha_reg'=>date('Y-m-d')
							];
					$sql = $this->save($data,'proveedor');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Proveedor registrado!!!'
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
							'message'=>'El proveedor ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idproveedor'=>$idproveedor,
							'tipo'=>$tipo,
							'ruc'=>$ruc,
							'razonsocial'=>$razonsocial,
							'nombrecomercial'=>$nombrecomercial,
							'telefono'=>$telefono,
							'email'=>$email,
							'direccion'=>$direccion,
							'estado'=>$estado
						];
				$sql = $this->update($data,'proveedor');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Proveedor actualizado!!!'
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
			$idproveedor = $_POST['idproveedor'];
			$sql = $this->proveedores->verregistro($idproveedor);
			$arr =[
					'idproveedor'=>$sql['idproveedor'],
					'tipo'=>$sql['tipo'],
					'ruc'=>$sql['ruc'],
					'razonsocial'=>$sql['razonsocial'],
					'nombrecomercial'=>$sql['nombrecomercial'],
					'telefono'=>$sql['telefono'],
					'email'=>$sql['email'],
					'direccion'=>$sql['direccion'],
					'estado'=>$sql['estado']
				];
			echo json_encode($arr);
		}
	}
?>
