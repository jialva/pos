<?php
	class rol extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->rol = $this->model('rolModelo');
				$this->menu();
	      	}else{
	       		$this->redireccionar();
	      	}
		}

		public function index(){
			$rol = $this->select('rol','rol','idrol',1,'');
	    	
			$date=[
				'titulo'=>'Administrar Roles',
				'nombretabla'=>'Administrar Roles',
				'select'=> $rol,
				'url'=> 'rol',
				'modulo'=> 'Seguridad'
			];
			$js = [
	      		'0'=>'rol.js'
	      	];
			$this->viewAdmin('rol/index',$js,$date);
		}

		public function tabla(){
			$items = $this->rol->tabla();
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th width="10">Item</th>
                                <th width="200">Rol</th>
                                <th width="20">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['rol'].'</td>
	                                <td>
	                                	<i title="Editar" class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idrol'].'\')"></i>
	                                	<i title="Asignar rol" class="splashy-contact_blue_add pointer" onclick="magregarusuario(\''.$row['idrol'].'\')"></i>
	                                	<i title="Eliminar rol" class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idrol'].'\')"></i>
	                                </td>
	                            </tr>';
	                            $c++;
                        }
                $cad .='</tbody>
					</table>';
			echo $cad;
		}

		public function guardar(){
			$idrol = $_POST['idrol'];
			$rol = $_POST['rol'];
			$codemp = 1;
			$codsuc = 1;
			if($idrol == ''){
				$sql = $this->existe($rol,'rol','rol','AND codsuc='.$codsuc);
				if(empty($sql)){
					$data = [
								'codemp'=>1,
								'codsuc'=>1,
								'rol'=>$rol,
								'estado'=>1
							];
					$sql = $this->save($data,'rol');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Rol registrado!!!'
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
							'message'=>'El rol ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idrol'=>$idrol,
							'rol'=>$rol
						];
				$sql = $this->update($data,'rol');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Rol actualizado!!!'
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
			$idrol = $_POST['idrol'];
			$sql = $this->rol->tabla($idrol);
			$arr =['rol'=>$sql[0]['rol']];
			echo json_encode($arr);
		}

		public function usuariosagregados(){
			$idrol = $_POST['idrol'];
			$codemp = 1;
			$items = $this->rol->usuariosagregados($idrol,$codemp);
			$c=1;
			$cad = '';
            foreach ($items as $row) {
            $cad .='<tr>
	        			<td>'.$c.'</td>
	                    <td>'.utf8_encode($row['nombre'].' '.$row['apellido']).'</td>
	                    <td>'.$row['usuario'].'</td>
	                    <td>
	                    	<i title="Dar accesos" class="splashy-document_a4_locked pointer" onclick="accesos(\''.$row['idusuario'].'\',\''.$idrol.'\')"></i>
	                    	<i title="Quitar" class="splashy-application_windows_remove pointer" onclick="quitarusuario(\''.$row['idusuario'].'\',\''.$idrol.'\')"></i>
	                    </td>
	                </tr>';
	                $c++;
            }
			echo $cad;
		}

		public function addusuariorol(){
			$idrol = $_POST['idrol'];
			$idusuario = $_POST['idusuario'];
			$sql = $this->rol->addusuariorol($idrol,$idusuario);
			$arr = [
				'ok'=>$sql
			];			
			echo json_encode($arr);
		}

		public function quitarrolusuario(){
			$idusuario = $_POST['idusuario'];
			$idrol = 0;
			$sql = $this->rol->addusuariorol($idrol,$idusuario);
			$arr = [
				'ok'=>$sql
			];			
			echo json_encode($arr);
		}

		public function accesos(){
			$idrol = $_POST['idrol'];
			$idusuario = $_POST['idusuario'];
			$codemp = 1;
			$modulos = $this->rol->modulos($codemp);
			$html ='<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
			                <li class="active"><a href="#tab_0" data-toggle="tab">Inicio</a></li>';
			            foreach ($modulos as $row) {
			            	$html .='<li><a href="#tab_'.$row['idmodulo'].'" data-toggle="tab">'.utf8_encode($row['modulo']).'</a></li>';
			            }
			    $html .='</ul>
			    		<div class="tab-content">
			    			<div class="tab-pane active" id="tab_0"></div>';
			    		foreach ($modulos as $row) {
				            $submodulo = $this->rol->submodulo($row['idmodulo']);
				            $html .='<div class="tab-pane" id="tab_'.$row['idmodulo'].'">
				            			<table class="table">';
				            	foreach ($submodulo as $sub) {
				            		$marcar = $this->rol->accesos($idusuario,$sub['idmodulo']);
			            			$html .='<tr>
				            					<th>'.$sub['modulo'].'</th>
				            					<th>Ver</th>
				            					<th>Crear</th>
				            					<th>Editar</th>
				            					<th>Eliminar</th>
				            				</tr>
				            				<tr>';
				            			if(empty($marcar)){
				            				$html .='<td><input type="checkbox" id="permitir'.$sub['idmodulo'].'" onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',0)"></td>
				            					<td><input type="checkbox" id="ver'.$sub['idmodulo'].'" onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',1)" name="" disabled="disabled"></td>
				            					<td><input type="checkbox" id="crear'.$sub['idmodulo'].'" onclick="otorgar\''.$idrol.'\',(\''.$idusuario.'\',\''.$sub['idmodulo'].'\',2)" name="" disabled="disabled"></td>
				            					<td><input type="checkbox" id="editar'.$sub['idmodulo'].'" onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',3)" name="" disabled="disabled"></td>
				            					<td><input type="checkbox" id="eliminar'.$sub['idmodulo'].'" onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',4)" name="" disabled="disabled"></td>';
				            			}else{
				            				$ver='';$editar='';$eliminar='';$crear='';
				            				if($marcar['ver']==1){
				            					$ver = 'checked';
				            				}
				            				if($marcar['editar']==1){
				            					$editar = 'checked';
				            				}
				            				if($marcar['eliminar']==1){
				            					$eliminar = 'checked';
				            				}
				            				if($marcar['crear']==1){
				            					$crear = 'checked';
				            				}
				            				$html .='<td><input type="checkbox" id="permitir'.$sub['idmodulo'].'" checked onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',0)" name=""></td>
				            					<td><input type="checkbox" id="ver'.$sub['idmodulo'].'" '.$ver.' onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',1)" name=""></td>
				            					<td><input type="checkbox" id="crear'.$sub['idmodulo'].'" '.$crear.' onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',2)" name=""></td>
				            					<td><input type="checkbox" id="editar'.$sub['idmodulo'].'" '.$editar.' onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',3)" name=""></td>
				            					<td><input type="checkbox" id="eliminar'.$sub['idmodulo'].'" '.$eliminar.' onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',4)" name=""></td>';
				            			}		            			
				            		$html .='</tr>';			            		
						            }
					            $html .='</table>
				            </div>';
			            }			    		
		    	$html .='</div>
				</div>';
			echo $html;
		}

		public function marcar(){
			$idusuario = $_POST['idusuario'];
			$idrol = $_POST['idrol'];
			$idmodulo = $_POST['idmodulo'];
			$opcion = $_POST['opcion'];
			$operacion = $_POST['operacion'];
			switch ($operacion){
				case 0:$sql=$this->rol->quitar($idusuario,$idmodulo);break;
				case 1:$sql=$this->rol->agregar($idusuario,$idmodulo,$idrol);break;
				case 2:$sql=$this->rol->marcar($idusuario,$idmodulo,$idrol,$opcion,$_POST['valor']);break;
			}
			echo $sql;
		}

	}
?>
