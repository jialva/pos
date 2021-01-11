<?php
	class usuario extends Controller{

		public function __construct(){
			$this->usuario = $this->model('usuarioModelo');
		}

		public function index(){
			$rol = $this->select('rol','rol','idrol',1,'');
	    	
			$date=[
				'titulo'=>'Administrar Usuarios',
				'nombretabla'=>'Administrar Usuarios',
				'select'=> $rol,
				'url'=> 'usuario',
				'modulo'=> 'Seguridad'
			];
			$js = [
	      		'0'=>'usuario.js'
	      	];
			$this->viewAdmin('usuario/index',$js,$date);
		}

		public function tabla(){
			$items = $this->usuario->tabla();
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>
                                <th>Nombres</th>
                                <th>Tel&eacute;fono</th>
                                <th>Email</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<td>'.$c.'</td>
                                <td>'.utf8_encode($row['nombre'].' '.$row['apellido']).'</td>
                                <td>'.$row['telefono'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>
                                	<i class="splashy-application_windows_edit pointer"></i>
                                	<i class="splashy-application_windows_remove pointer"></i>
                                </td>';
                        }
                $cad .='</tbody>
					</table>';
			echo $cad;
		}

		public function validar(){
			$usuario = strtoupper($_POST['usuario']);
			$password = trim($_POST['password']);
			$datos = $this->usuario->validardatos(trim($usuario));
			$pass = strtoupper(trim($password));
			if(!empty($datos)){
				if($pass === $this->desencriptar($datos['password'])){
					Session::set('autenticado',true);
					Session::set('usuario',$datos['usuario']);
					Session::set('nombre',$datos['nombre']);
					Session::set('idrol',$datos['idrol']);
					$data['mensaje'] ='Ingresando al sistema';
					$data['res']=1;
				}else{
					$data['mensaje'] ='La clave es incorrecta';
					$data['res']=2;
				}
			}else{
				$data['mensaje'] ='El usuario ingresado no existe';
				$data['res']=3;
			}
			echo json_encode($data);
		}

		public function salir(){
			Session_destroy();
			$this->redireccionar('salir');
		}
	}
?>
