<?php
	class marcamodelo extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->marca = $this->model('marcamodeloModelo');
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
				'titulo'=>'Administrar Marcas',
				'nombretabla'=>'Marcas',
				'url'=> Session::get('url'),
				'modulo'=> 'Configuración',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'marcamodelo.js'
	      	];
			$this->viewAdmin('marcamodelo/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->marca->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th width="10%">Item</th>
                                <th width="80%">Marca</th>
                                <th width="10%">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['marca'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idmarca'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idmarca'].'\')"></i>';
	                                	}
	                                }
	                                if($this->editar == 1){
	                                	$cad .=' <i title="Agregar modelos" class="splashy-view_list_with_thumbnail pointer" onclick="agregar(\''.$row['idmarca'].'\')"></i>';
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idmarca'].'\')"></i>';
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
			$idmarca = $_POST['idmarca'];
			$marca = strtoupper($_POST['marca']);
			$codemp = 1;
			$codsuc = 1;
			if($idmarca == ''){
				$sql = $this->marca->validardatos($marca,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'marca'=>$marca,
								'estado'=>1
							];
					$sql = $this->save($data,'marca');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Marca registrada!!!'
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
							'message'=>'La marca ingresada ya existe'
						];
				}
			}else{
				$data = [
							'idmarca'=>$idmarca,
							'marca'=>$marca
						];
				$sql = $this->update($data,'marca');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Marca actualizado!!!'
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
			$idmarca = $_POST['idmarca'];
			$sql = $this->marca->verregistro($idmarca);
			$arr =[
					'marca'=>$sql['marca']
				];
			echo json_encode($arr);
		}

		public function guardarmodelo(){
			$idmodelo = $_POST['idmodelo'];
			$idmarca = $_POST['idmarca'];
			$modelo = strtoupper($_POST['modelo']);
			$codemp = 1;
			$codsuc = 1;
			if($idmodelo == ''){
				$sql = $this->marca->validardatosmodelo($modelo,$idmarca);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'idmarca'=>$idmarca,
								'modelo'=>$modelo,
								'estado'=>1
							];
					$sql = $this->save($data,'modelo');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Modelo registrada!!!'
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
							'message'=>'El modelo ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idmodelo'=>$idmodelo,
							'idmarca'=>$idmarca,
							'modelo'=>$modelo
						];
				$sql = $this->update($data,'modelo');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Modelo actualizado!!!'
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

		public function verregistromodelo(){
			$idmodelo = $_POST['idmodelo'];
			$sql = $this->marca->verregistromodelo($idmodelo);
			$arr =[
					'modelo'=>$sql['modelo']
				];
			echo json_encode($arr);
		}

		public function vermodelos(){
			$idmarca = $_POST['idmarca'];
			$marca = '';
			$mar = $this->marca->verregistro($idmarca);
			$marca = $mar['marca'];
			$sql = $this->marca->vermodelos($idmarca);
			$cad = '<table class="table table-striped table-bordered dTableR" id="gmodelo">
						<thead>
                            <tr>
                                <th width="10%">Item</th>
                                <th width="80%">Modelo</th>
                                <th width="10%">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $c=1;
                        foreach ($sql as $row) {       
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['modelo'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editarmodelo(\''.$row['idmodelo'].'\')"></i>';
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminarmodelo(\''.$row['idmodelo'].'\')"></i>';
	                                }	                                
	                            $cad .='</td>
	                            </tr>';
	                            $c++;
                        }
                $cad .='</tbody>
					</table>';
			$arr =[
					'marca'=>$marca,
					'tabla'=>$cad
				];
			echo json_encode($arr);
		}

		public function select_modelo(){
			$codemp = 1;
			$idmarca = $_POST['idmarca'];
			$modelo = $this->select('modelo','modelo','idmodelo',1,' AND idmarca='.$idmarca.' AND codemp='.$codemp);
			echo $modelo;
		}
	}
?>
