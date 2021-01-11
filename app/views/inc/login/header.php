<!DOCTYPE html>
<html lang="en" class="login_page">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$date['titulo']?></title>

    <!-- Bootstrap framework -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
    <!-- theme color-->
        <link rel="stylesheet" href="css/blue.css" />
    <!-- tooltip -->    
        <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
    <!-- main styles -->
        <link rel="stylesheet" href="css/style.css" />

    <!-- Favicon -->
        <link rel="shortcut icon" href="img/sw.ico" />

    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="alertify/alertify.min.css"/>
    <link rel="stylesheet" href="alertify/default.min.css"/>


    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="<?=BASE_URL?>pagejs/funciones.js"></script>

    <?php if(count($js)>=1){
        for ($i=0; $i < count($js); $i++) {?>
            <script src="<?=BASE_URL?>pagejs/<?=$js[$i]?>"></script>
        <?php }
    }?>

    <script>
        var url = "<?=BASE_URL?>";
    </script>
</head>
<body>





