<?php
	class registrarcompra extends Controller{

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
				'titulo'=>'Registrar Compra',
				'nombretabla'=>'Nueva Compra',
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
			$codemp = 1;
			$items = $this->categoria->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th width="10%">ITEM</th>
                                <th width="80%">CATEGO&Iacute;A</th>
                                <th width="10%">ACCIO&Oacute;N</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['categoria'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idcategoria'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idcategoria'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idcategoria'].'\')"></i>';
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
			$idcategoria = $_POST['idcategoria'];
			$categoria = strtoupper($_POST['categoria']);
			$codemp = 1;
			$codsuc = 1;
			if($idcategoria == ''){
				$sql = $this->categoria->validardatos($categoria,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'categoria'=>$categoria,
								'estado'=>1
							];
					$sql = $this->save($data,'categoria');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Categoría registrada!!!'
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
							'message'=>'La categoría ingresada ya existe'
						];
				}
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
