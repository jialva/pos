<?php
	class tipodocumento extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->configuracion = $this->model('configuracionModelo');
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
				'titulo'=>'Tipo de Documentos',
				'nombretabla'=>'Tipo de Documentos',
				'url'=> Session::get('url'),
				'modulo'=> 'Tipo Documento',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'tipodocumento.js'
	      	];
			$this->viewAdmin('tipodocumento/index',$js,$date);
		}
    

		public function tabla(){
			$codemp = 1;
			$items = $this->configuracion->tablatipodocumento($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Nombre Largo</th>
                                <th>Nombre Corto</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
	                                <td>'.$row['codigo'].'</td>
	                                <td>'.$row['nombrelargo'].'</td>
	                                <td>'.$row['nombrecorto'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idtipodocumento'].'\',1)"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idtipodocumento'].'\',0)"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idtipodocumento'].'\')"></i>';
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
			$idtipodocumento = $_POST['idtipodocumento'];
			$nombrelargo = $_POST['nombrelargo'];
			$nombrecorto = $_POST['nombrecorto'];
			$codigo = $_POST['codigo'];
			$codemp = 1;
			if($idtipodocumento == ''){
				$sql = $this->configuracion->validartipodocumento($codigo,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>1,
								'nombrelargo'=>$nombrelargo,
								'nombrecorto'=>$nombrecorto,
								'codigo'=>$codigo,
								'estado'=>1
							];
					$sql = $this->save($data,'tipodocumento');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Tipo de documento registrado!!!'
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
							'message'=>'El tipo de documento o código ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idtipodocumento'=>$idtipodocumento,
							'nombrelargo'=>$nombrelargo,
							'nombrecorto'=>$nombrecorto,
							'codigo'=>$codigo,
						];
				$sql = $this->update($data,'tipodocumento');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Tipo de documento actualizado!!!'
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
			$idtipodocumento = $_POST['idtipodocumento'];
			$sql = $this->configuracion->vertipodocumento($idtipodocumento);
			$arr =['nombrelargo'=>$sql['nombrelargo'],'nombrecorto'=>$sql['nombrecorto'],'codigo'=>$sql['codigo']];
			echo json_encode($arr);
		}

		public function eliminar(){
			$idtipodocumento = $_POST['idtipodocumento'];
			$sql = $this->configuracion->eliminartipodocumento($idtipodocumento);
			$ok=0;
			$message = '';
			switch ($sql) {
				case 0:$ok=0;$message="Ocurrio un error al eliminar!!!";break;
				case 1:$ok=1;$message="El registro fue eliminado!!!";break;
				case 2:$ok=2;$message="No se puede eliminar, el registro se encuentra en uso!!!";break;
				default :$ok=0;$message="Ocurrio un error inesperado!!!";break;
			}
			$arr = [
				'ok'=>$ok,
				'message'=>$message
			];			
			echo json_encode($arr);
		}

	}
?>
