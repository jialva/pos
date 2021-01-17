<?php
	
	class funciones extends Controller{

		public function __construct(){
			$this->funcionesModel = $this->model('funcionesModelo');
		}

		public function index(){}

		public function validarusuario(){
			$usuario = strtoupper($_POST['usuario']);
			$password = trim($_POST['password']);
			$datos = $this->funcionesModel->validar(trim($usuario));
			$pass = trim($password);
			if(!empty($datos)){
				if($pass === $this->desencriptar($datos['password'])){
					Session::set('autenticado',true);
					Session::set('usuario',$datos['usuario']);
					Session::set('nombre',$datos['nombre']);
					Session::set('idrol',$datos['idrol']);
					Session::set('idusuario',$datos['idusuario']);
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

		public function captcha(){
			//require BASE_URL.'library/classphp/PasswordLib/PasswordLib.php';
			if(!empty($_POST['capt'])){
				$_SESSION["valor"]=rand(0,50);
			}
			if(!empty($_SESSION["valor"])){
				if(strlen($_SESSION["valor"])>0){
			    $PasswordLib = new PasswordLib\PasswordLib();
			    $numaleatorio=NumerAletorios();
			    echo $numaleatorio;exit;
			    $hash = $PasswordLib->createPasswordHash(Operacion($numaleatorio));
				setcookie('captcha',$hash,time()+60*3);
				if(NumerAletorios()!=""){
					echo '{"retornar":"'.$numaleatorio.'"}';
				}else{
					echo '{"retornar":false}';
				}
				}
			}
		}

		public function NumerAletorios(){
		  $operacion =array('+','-','*','/');
		  $mostrar   =null;
		  $num1      =rand(0,50);
		  $num2      =rand(0,20);
		  $op        =rand(0,count($operacion)-1);
		  $optiom    =$operacion[$op];
		  $mostrar   =$num1.$optiom.$num2;
		  return $mostrar;
		}

		public function Operacion($string){
		$resutado=0;
	    $valor=array('+','-',
	  	         '*','/');
		foreach ($valor as $key => $value) {
			if(preg_match("/(\d+)\\".$value."(\d+)/",$string, $results)!=0){
				switch ($value) {
					case '+':
				        $resutado=($results[1])+($results[2]);
						break;
					case '-':
				        $resutado=($results[1])-($results[2]);
						break;
					case '*':
				        $resutado=($results[1])*($results[2]);
						break;
					case '/':
				        $resutado=round(($results[1])/($results[2]),2);
						break;	
					default:
						break;
				}
		}
		}
	return $resutado;	
	}

	}
?>
