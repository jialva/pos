<?php
	class usuario extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->usuario = $this->model('usuarioModelo');
				$this->menu();
	      	}else{
	       		$this->redireccionar();
	      	}
		}

		public function index(){	    	
			$date=[
				'titulo'=>'Administrar Usuarios',
				'nombretabla'=>'Administrar Usuarios',
				'url'=> 'usuario',
				'modulo'=> 'Seguridad'
			];
			$js = [
	      		'0'=>'usuario.js'
	      	];
			$this->viewAdmin('usuario/index',$js,$date);
		}

		public function autocomplete(){
        $search = $_GET['search'];
        $opcion = $_GET['opcion'];
        $resp = $this->usuario->autocomplete($search,$opcion);
        $var = [];
        foreach ($resp as $row) {
            $var[]=$row;
        }
        echo json_encode($var);
    }

		public function tabla(){
			$items = $this->usuario->tabla();
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>
                                <th>Nombres</th>
                                <th>Rol</th>
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
	                                <td>'.$row['rol'].'</td>
	                                <td>'.$row['telefono'].'</td>
	                                <td>'.$row['email'].'</td>
	                                <td>
	                                	<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idusuario'].'\')"></i>
	                                	<i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idusuario'].'\')"></i>
	                                </td>
	                            </tr>';
	                            $c++;
                        }
                $cad .='</tbody>
					</table>';
			echo $cad;
		}

		public function guardar(){
			$idusuario = $_POST['idusuario'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];
			if($idusuario == ''){
				$sql = $this->usuario->validardatos($usuario);
				if(empty($sql)){
					$data = [
								'codemp'=>1,
								'codsuc'=>1,
								'nombre'=>$nombres,
								'apellido'=>$apellidos,
								'telefono'=>$telefono,
								'email'=>$email,
								'usuario'=>$usuario,
								'password'=>$this->encriptar($password),
								'fecha_reg'=>date('Y-m-d'),
								'estado'=>1
							];
					$sql = $this->save($data,'usuario');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Usuario registrado!!!'
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
							'message'=>'El usuario ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idusuario'=>$idusuario,
							'nombre'=>$nombres,
							'apellido'=>$apellidos,
							'telefono'=>$telefono,
							'email'=>$email,
						];
				$sql = $this->update($data,'usuario');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Usuario actualizado!!!'
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
			$idusuario = $_POST['idusuario'];
			$sql = $this->usuario->verregistro($idusuario);
			$arr =['nombres'=>$sql['nombre'],'apellido'=>$sql['apellido'],'telefono'=>$sql['telefono'],'email'=>$sql['email'],
					'usuario'=>$sql['usuario'],'password'=>$this->desencriptar($sql['password'])];
			echo json_encode($arr);
		}

		public function salir(){
			Session_destroy();
			$this->redireccionar('salir');
		}
	}
?>
