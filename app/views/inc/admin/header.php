<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?=$date['titulo']?></title>
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />
        <!-- code prettify -->
            <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />    
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy iconos -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
        <!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />
        <!-- stylos principales -->
            <link rel="stylesheet" href="css/style.css" />          
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
        <!-- Favicon -->
            <link rel="shortcut icon" href="img/sw.ico" />
        
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
            <script src="js/ie/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="alertify/alertify.min.css"/>
        <link rel="stylesheet" href="alertify/default.min.css"/>

        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>pagejs/funciones.js"></script>

        <?php if(count($js)>=1){
            for ($i=0; $i < count($js); $i++) {?>
                <script src="<?=BASE_URL?>pagejs/<?=$js[$i]?>?"></script>
            <?php }
        }?>

        <script>
            var url = "<?=BASE_URL?>";
        </script>
        
        <script>
            //* oculta el preloader
            document.documentElement.className += 'js';
        </script>
    </head>
    <body>      
        <div id="maincontainer" class="clearfix">
            <!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="inicio"><i class="icon-home icon-white"></i> Siincoweb POS</a>
                            <ul class="nav user_menu pull-right">
                                <li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">
                                        <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New messages">25 <i class="splashy-warning_triangle"></i></a>
                                    </div>
                                </li>
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=Session::get('nombre')?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="#">Mi cuenta</a></li>
                                    <li class="divider"></li>
                                    <li><a href="usuario/salir">Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                                <span class="icon-align-justify icon-white"></span>
                            </a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a href="#">Ventas</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#">Compras</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#">Clientes</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#">Productos</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="modal hide fade" id="myMail">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>New messages</h3>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
                        <table class="table table-condensed table-striped" data-rowlink="a">
                            <thead>
                                <tr>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Declan Pamphlett</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>23/05/2012</td>
                                    <td>25KB</td>
                                </tr>
                                <tr>
                                    <td>Erin Church</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>24/05/2012</td>
                                    <td>15KB</td>
                                </tr>
                                <tr>
                                    <td>Koby Auld</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>25/05/2012</td>
                                    <td>28KB</td>
                                </tr>
                                <tr>
                                    <td>Anthony Pound</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>25/05/2012</td>
                                    <td>33KB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Go to mailbox</a>
                    </div>
                </div>
            </header>

            <!-- sidebar -->
            <a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Ocultar barra">Ocultar barra</a>
            <br>
            <div class="sidebar">               
                <div class="antiScroll">
                    <div class="antiscroll-inner">
                        <div class="antiscroll-content">
                    
                            <div class="sidebar_inner">
                                <div id="side_accordion" class="accordion">
                                    
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="<?=BASE_URL?>inicio" class="accordion-toggle">
                                                <i class="splashy-folder_modernist"></i> Inicio
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                      $c = 0;
                                      $arraymenu = Session::get('menu');
                                      if(isset($arraymenu) && count($arraymenu)){
                                        $ac = '';
                                        for ($i=0; $i < count($arraymenu); $i++) { 
                                            if($c == 0){ $descripcion = $arraymenu[$i]['padre']; $c = 1;
                                                if($arraymenu[$i]['padre']==$date['modulo']){
                                                  $ac = 'in';
                                                }else{
                                                  $ac = '';
                                                }
                                            ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a href="#<?=$arraymenu[$i]['padre']?>" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                                      <i class="<?=$arraymenu[$i]['icono']?>"></i>
                                                        <?=$arraymenu[$i]['padre']?>
                                                      <i class="icon-arrow"></i>
                                                    </a>
                                                </div>
                                                <div class="accordion-body collapse $ac" id="<?=$arraymenu[$i]['padre']?>">
                                                    <div class="accordion-inner">
                                                        <ul class="nav nav-list">
                                                <?php }
                                                    if($descripcion == $arraymenu[$i]['padre']){ 
                                                    $url = BASE_URL.$arraymenu[$i]['url']
                                                ?>
                                                <li>
                                                    <a href="<?=$url?>">
                                                        <?=$arraymenu[$i]['modulo']?>
                                                    </a>
                                                </li>
                                                <?php }else{
                                                    $c = 0; $i = $i - 1; 
                                                ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php  }
                                        }
                                      }
                                    ?>
                                </div>
                            </div>
                        </div>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="#collapse7" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                               <i class="icon-th"></i> Calculadora
                                            </a>
                                        </div>
                                        <div class="accordion-body collapse" id="collapse7">
                                            <div class="accordion-inner">
                                                <form name="Calc" id="calc">
                                                    <div class="formSep control-group input-append">
                                                        <input type="text" style="width:142px" name="Input" /><button type="button" class="btn" name="clear" value="c" onclick="Calc.Input.value = ''"><i class="icon-remove"></i></button>
                                                    </div>
                                                    <div class="control-group">
                                                        <input type="button" class="btn btn-large" name="seven" value="7" onclick="Calc.Input.value += '7'" />
                                                        <input type="button" class="btn btn-large" name="eight" value="8" onclick="Calc.Input.value += '8'" />
                                                        <input type="button" class="btn btn-large" name="nine" value="9" onclick="Calc.Input.value += '9'" />
                                                        <input type="button" class="btn btn-large" name="div" value="/" onclick="Calc.Input.value += ' / '">
                                                    </div>
                                                    <div class="control-group">
                                                        <input type="button" class="btn btn-large" name="four" value="4" onclick="Calc.Input.value += '4'" />
                                                        <input type="button" class="btn btn-large" name="five" value="5" onclick="Calc.Input.value += '5'" />
                                                        <input type="button" class="btn btn-large" name="six" value="6" onclick="Calc.Input.value += '6'" />
                                                        <input type="button" class="btn btn-large" name="times" value="x" onclick="Calc.Input.value += ' * '" />
                                                    </div>
                                                    <div class="control-group">
                                                        <input type="button" class="btn btn-large" name="one" value="1" onclick="Calc.Input.value += '1'" />
                                                        <input type="button" class="btn btn-large" name="two" value="2" onclick="Calc.Input.value += '2'" />
                                                        <input type="button" class="btn btn-large" name="three" value="3" onclick="Calc.Input.value += '3'" />
                                                        <input type="button" class="btn btn-large" name="minus" value="-" onclick="Calc.Input.value += ' - '" />
                                                    </div>
                                                    <div class="formSep control-group">
                                                        <input type="button" class="btn btn-large" name="dot" value="." onclick="Calc.Input.value += '.'" />
                                                        <input type="button" class="btn btn-large" name="zero" value="0" onclick="Calc.Input.value += '0'" />
                                                        <input type="button" class="btn btn-large" name="DoIt" value="=" onclick="Calc.Input.value = Math.round( eval(Calc.Input.value) * 1000)/1000" />
                                                        <input type="button" class="btn btn-large" name="plus" value="+" onclick="Calc.Input.value += ' + '" />
                                                    </div>
                                                    Jalva by <a href="http://siincoweb.com">siincoweb</a>
                                                </form>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                
                                <div class="push"></div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">