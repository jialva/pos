<?php
	class cliente extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->cliente = $this->model('clienteModelo');
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
			$tipodoc = $this->select('tipodocumento','nombrecorto','idtipodocumento',1,'');
			$date=[
				'titulo'=>'Administrar Clientes',
				'nombretabla'=>'Administrar Clientes',
				'url'=> Session::get('url'),
				'modulo'=> 'Registrar',
				'tipodocumento'=> $tipodoc,
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'cliente.js'
	      	];
			$this->viewAdmin('cliente/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->cliente->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>
                                <th>Nombre y Apellido</th>
                                <th>Tipo</th>
                                <th>Documento</th>
                                <th>Tel&eacute;fono</th>
                                <th>Email</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.utf8_encode($row['nombre'].' '.$row['apellido']).'</td>
	                                <td>'.$row['nombrecorto'].'</td>
	                                <td>'.$row['numero'].'</td>
	                                <td>'.$row['telefono'].'</td>
	                                <td>'.$row['correo'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idcliente'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idcliente'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idcliente'].'\')"></i>';
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
			$idcliente = $_POST['idcliente'];
			$idtipodocumento = $_POST['idtipodocumento'];
			$numero = $_POST['numero'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];
			$credito = $_POST['credito'];
			$codemp = 1;
			$codsuc = 1;
			if($idcliente == ''){
				$sql = $this->cliente->validardatos($numero,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'idtipodocumento'=>$idtipodocumento,
								'numero'=>$numero,
								'nombre'=>$nombre,
								'apellido'=>$apellido,
								'telefono'=>$telefono,
								'correo'=>$email,
								'direccion'=>$direccion,
								'credito'=>$credito,
								'fecha_reg'=>date('Y-m-d'),
								'estado'=>1
							];
					$sql = $this->save($data,'cliente');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Cliente registrado!!!'
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
							'message'=>'El cliente ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idcliente'=>$idcliente,
							'idtipodocumento'=>$idtipodocumento,
							'numero'=>$numero,
							'nombre'=>$nombre,
							'apellido'=>$apellido,
							'telefono'=>$telefono,
							'correo'=>$email,
							'direccion'=>$direccion,
							'credito'=>$credito
						];
				$sql = $this->update($data,'cliente');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Cliente actualizado!!!'
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
			$idcliente = $_POST['idcliente'];
			$sql = $this->cliente->verregistro($idcliente);
			$arr =[
					'idtipodocumento'=>$sql['idtipodocumento'],
					'numero'=>$sql['numero'],
					'nombre'=>$sql['nombre'],
					'apellido'=>$sql['apellido'],
					'telefono'=>$sql['telefono'],
					'email'=>$sql['correo'],
					'direccion'=>$sql['direccion'],
					'credito'=>$sql['credito']
				];
			echo json_encode($arr);
		}
	}
?>
