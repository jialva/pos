<?php
	class modulo extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->menu();
				if(!$this->acceso(Session::get('idrol'),Session::get('idusuario'),Session::get('url'))){
					$this->redireccionar('errors/denegado');
				}
	      	}else{
	       		$this->redireccionar();
	      	}
		}

		public function index(){
	    	$mp = $this->select('modulo','modulo','idmodulo',1,' AND modulo_padre IN(0,1) ');
			$date=[
				'titulo'=>'Administrar Módulo',
				'nombretabla'=>'Administrar Módulos',
				'url'=> 'modulo',
				'mp'=>$mp,
				'modulo'=> 'Seguridad'
			];
			$js = [
	      		'0'=>'modulo.js'
	      	];
			$this->viewAdmin('modulo/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->verregistros('modulo','estado=1 AND codemp='.$codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th width="10">Item</th>
                                <th width="80">M&oacute;dulo</th>
                                <th width="80">URL</th>
                                <th width="80">Icono</th>
                                <th width="20">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
	                                <td>'.$row['modulo'].'</td>
	                                <td>'.$row['url'].'</td>
	                                <td>'.$row['icono'].'</td>
	                                <td>
	                                	<i title="Editar" class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idmodulo'].'\')"></i>
	                                	<i title="Eliminar rol" class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idmodulo'].'\')"></i>
	                                </td>
	                            </tr>';
	                            $c++;
                        }
                $cad .='</tbody>
					</table>';
			echo $cad;
		}

		public function guardar(){
			$idmodulo = $_POST['idmodulo'];
			$modulo = $_POST['modulo'];
			$modulo_padre = $_POST['modulo_padre'];
			$url = $_POST['url'];
			$icono = $_POST['icono'];
			$orden = $_POST['orden'];
			$codemp = 1;
			$codsuc = 1;
			if($idmodulo == ''){
				$sql = $this->existe($modulo,'modulo','modulo','AND codemp='.$codemp);
				if(empty($sql)){
					$data = [
								'modulo'=>$modulo,
								'modulo_padre'=>$modulo_padre,
								'url'=>$url,
								'icono'=>$icono,
								'orden'=>$orden,
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'estado'=>1
							];
					$sql = $this->save($data,'modulo');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Registrado!!!'
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
							'message'=>'El modulo ingresado ya existe'
						];
				}
			}else{
				$data = [
							'idmodulo'=>$idmodulo,
							'modulo'=>$modulo,
							'modulo_padre'=>$modulo_padre,
							'url'=>$url,
							'icono'=>$icono,
							'orden'=>$orden
						];
				$sql = $this->update($data,'modulo');
				if($sql==2){
					$arr = [
						'ok'=>1,
						'message'=>'Actualizado!!!'
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
			$idmodulo = $_POST['idmodulo'];
			$codemp = 1;
			$sql = $this->verregistros('modulo','idmodulo='.$idmodulo.' AND codemp='.$codemp);
			$arr =[
				'modulo'=>$sql[0]['modulo'],
				'modulo_padre'=>$sql[0]['modulo_padre'],
				'url'=>$sql[0]['url'],
				'icono'=>$sql[0]['icono'],
				'orden'=>$sql[0]['orden']
			];
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
				            					<td><input type="checkbox" id="crear'.$sub['idmodulo'].'" onclick="otorgar(\''.$idrol.'\',\''.$idusuario.'\',\''.$sub['idmodulo'].'\',2)" name="" disabled="disabled"></td>
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

		public function eliminar(){
			$idrol = $_POST['idrol'];
			$sql = $this->rol->eliminar($idrol);
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
