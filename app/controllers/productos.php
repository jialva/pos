<?php
	class productos extends Controller{

		public function __construct(){
			if(Session::get('autenticado')){
				$this->productos = $this->model('productosModelo');
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
			$codemp = 1;
			$marca = $this->select('marca','marca','idmarca',1,' AND codemp='.$codemp);
			$unidad = $this->select('unidadmedida','nombrelargo','idunidad',1,' AND codemp='.$codemp);
			$categoria = $this->select('categoria','categoria','idcategoria',1,' AND codemp='.$codemp);
			$date=[
				'titulo'=>'Administrar Productos',
				'nombretabla'=>'Productos Registrados',
				'url'=> Session::get('url'),
				'modulo'=> 'Registrar',
				'add'=> $this->ver,
				'marca'=>$marca,
				'unidad'=>$unidad,
				'categoria'=>$categoria
			];
			$js = [
	      		'0'=>'productos.js'
	      	];
			$this->viewAdmin('productos/index',$js,$date);
		}

		public function tabla(){
			$codemp = 1;
			$items = $this->productos->tabla($codemp);
			$c=1;
			$cad = '<table class="table table-striped table-bordered dTableR" id="grilla">
						<thead>
                            <tr>
                                <th>Item</th>                                
                                <th>CATEGORIA</th>
                                <th>PRODUCTO</th>
                                <th>MARCA</th>
                                <th>MODELO</th>
                                <th>UNI. MEDIDA</th>
                                <th>STOCK</th>
                                <th>ACCI&Oacute;N</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($items as $row) {
                        $cad .='<tr>
                        			<td>'.$c.'</td>
                        			<td>'.$row['categoria'].'</td>
	                                <td>'.$row['producto'].'</td>
	                                <td>'.$row['marca'].'</td>
	                                <td>'.$row['modelo'].'</td>
	                                <td>'.$row['nombrelargo'].'</td>
	                                <td>'.$row['stock'].'</td>
	                                <td>';
	                                if($this->editar == 1){
	                                	$cad .='<i class="splashy-application_windows_edit pointer" onclick="editar(\''.$row['idproducto'].'\')"></i>';
	                                }else{
	                                	if($this->ver == 1){
	                                		$cad .='<i title="Ver" class="splashy-zoom pointer" onclick="editar(\''.$row['idproducto'].'\')"></i>';
	                                	}
	                                }
	                                if($this->eliminar == 1){
	                                	$cad .=' <i class="splashy-application_windows_remove pointer" onclick="meliminar(\''.$row['idproducto'].'\')"></i>';
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
			$idproducto = $_POST['idproducto'];
			$producto = strtoupper($_POST['producto']);
			$idcategoria = $_POST['idcategoria'];
			$idunidad = $_POST['idunidad'];
			$idmarca = $_POST['idmarca'];
			$idmodelo = $_POST['idmodelo'];
			$serie = $_POST['serie'];
			$minimo = $_POST['minimo'];
			$precioventa_uno = $_POST['precioventa_uno'];
			$precioventa_dos = $_POST['precioventa_dos'];
			$precioventa_tres = $_POST['precioventa_tres'];
			$codemp = 1;
			$codsuc = 1;
			if($idproducto == ''){
				$sql = $this->productos->validardatos($idproducto,$producto,$idcategoria,$idunidad,$idmarca,$idmodelo,$serie,$codemp);
				if($sql==0){
					$data = [
								'codemp'=>$codemp,
								'codsuc'=>$codsuc,
								'producto'=>$producto,
								'idcategoria'=>$idcategoria,
								'idunidad'=>$idunidad,
								'idmarca'=>$idmarca,
								'idmodelo'=>$idmodelo,
								'serie'=>$serie,
								'minimo'=>$minimo,
								'stock'=>0,
								'precioventa_uno'=>$precioventa_uno,
								'precioventa_dos'=>$precioventa_dos,
								'precioventa_tres'=>$precioventa_tres,
								'estado'=>1
							];
					$sql = $this->save($data,'producto');
					if($sql==1){
						$arr = [
							'ok'=>1,
							'message'=>'Producto registrado!!!'
						];
					}else{
						$arr = [
							'ok'=>0,
							'message'=>'Error al registrar!!!'
						];
					}
				}else{
					$message = '';
					switch ($sql) {
						case 3:$message='El producto ingresado ya existe';break;
						case 4:$message='La serie ingresada ya existe';break;
					}
					$arr = [
							'ok'=>$sql,
							'message'=>$message
						];
				}
			}else{
				$sql = $this->productos->validardatos($idproducto,$producto,$idcategoria,$idunidad,$idmarca,$idmodelo,$serie,$codemp);
				if($sql==0){
					$data = [
							'idproducto'=>$idproducto,
							'producto'=>$producto,
							'idcategoria'=>$idcategoria,
							'idunidad'=>$idunidad,
							'idmarca'=>$idmarca,
							'idmodelo'=>$idmodelo,
							'serie'=>$serie,
							'minimo'=>$minimo,
							'precioventa_uno'=>$precioventa_uno,
							'precioventa_dos'=>$precioventa_dos,
							'precioventa_tres'=>$precioventa_tres
						];
					$sql = $this->update($data,'producto');
					if($sql==2){
						$arr = [
							'ok'=>1,
							'message'=>'Producto actualizado!!!'
						];
					}else{
						$arr = [
							'ok'=>0,
							'message'=>'Error al actualizar!!!'
						];
					}
				}else{
					$message = '';
					switch ($sql) {
						case 3:$message='El producto ingresado ya existe';break;
						case 4:$message='La serie ingresada ya existe';break;
					}
					$arr = [
							'ok'=>$sql,
							'message'=>$message
						];
				}			
			}
			echo json_encode($arr);
		}

		public function verregistro(){
			$idproducto = $_POST['idproducto'];
			$sql = $this->productos->verregistro($idproducto);
			$arr =[
					'idmarca'=>$sql['idmarca'],
					'idmodelo'=>$sql['idmodelo'],
					'idunidad'=>$sql['idunidad'],
					'idcategoria'=>$sql['idcategoria'],
					'producto'=>$sql['producto'],
					'serie'=>$sql['serie'],
					'stock'=>$sql['stock'],
					'minimo'=>$sql['minimo'],
					'precioventa_uno'=>$sql['precioventa_uno'],
					'precioventa_dos'=>$sql['precioventa_dos'],
					'precioventa_tres'=>$sql['precioventa_tres']
				];
			echo json_encode($arr);
		}
	}
?>
