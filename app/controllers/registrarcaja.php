<?php
	class registrarcaja extends Controller{

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
				'titulo'=>'Administrar Cajas',
				'nombretabla'=>'Cajas',
				'url'=> Session::get('url'),
				'modulo'=> 'Caja',
				'add'=> $this->ver
			];
			$js = [
	      		'0'=>'registrarcaja.js'
	      	];
			$this->viewAdmin('registrarcaja/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->caja->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th width="10%">ITEM</th>
                                <th width="65%">CAJA</th>
                                <th width="15%">ESTADO</th>
                                <th width="10%">ACCIO&Oacute;N</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row){
                        	if($row['aperturado']==1){
                        		$estado = 'APERTURADO';
                        	}else{
                        		$estado = 'CERRADO';
                        	}
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['caja'].'</td>
	                                <td>'.$estado.'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idcaja'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idcaja'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idcaja'].'\')"></i>';
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
			$idcaja = $_POST['idcaja'];
			$caja = strtoupper($_POST['caja']);
			$codemp = 1;
			$codsuc = 1;
			if($idcaja == ''){
				$sql = $this->caja->validardatos($caja,$codemp);
				if(empty($sql)){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'caja'=>$caja,
								'aperturado'=>0,
								'estado'=>1
							];
					$sql = $this->save($data,'caja');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Caja registrada!!!'
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
							'message'=>'La caja ingresada ya existe'
						];
				}
			}else{
				$data = [
							'idcaja'=>$idcaja,
							'caja'=>$caja
						];
				$sql = $this->update($data,'caja');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Caja actualizada!!!'
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
			$idcaja = $_POST['idcaja'];
			$sql = $this->caja->verregistro($idcaja);
			$arr =[
					'caja'=>$sql['caja']
				];
			echo json_encode($arr);
		}

		public function validarapertura(){
			$codemp = 1;
			$codsuc = 1;
			$idusuario = Session::get('idusuario');
			$resp = $this->caja->validarapertura($idusuario,$codemp,$codsuc);
			if(empty($resp)){
				$existe = 'no';
			}else{
				$existe = 'si';
			}
			echo $existe;
		}
	}
?>
