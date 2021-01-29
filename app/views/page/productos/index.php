<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">
            <?php echo $date['nombretabla'];
                if($date['add']==1){
            ?>
                <button class="btn" style="float: right;" onclick="limpiar(),modal('myModal1','open')"><i class="splashy-application_windows_add"></i> Nuevo</button>
            <?php }?>     
        </h3>
        <div id="tabla"></div>
    </div>
</div>

<div class="modal hide" id="myModal1">
    <form id="formulario" onsubmit="return false;">
        <div class="modal-header">
            <button class="close" onclick="modal('myModal1','close')">×</button>
            <h3>Registrar Proveedor</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span12">
                    <label>PRODUCTO *</label>
                    <input type="" class="span12" id="producto" name="producto" style="text-transform:uppercase;"/>
                    <input type="hidden" id="idproducto" name="idproducto">
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <label>CATEGOR&Iacute;A *</label>
                    <select class="span12" id="idcategoria" name="idcategoria"><?=$date['categoria']?></select>
                </div>
                <div class="span6">
                    <label>UNIDAD DE MEDIDAD *</label>
                    <select class="span12" id="idunidad" name="idunidad"><?=$date['unidad']?></select>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <label>MARCA *</label>
                    <select class="span12" id="idmarca" name="idmarca" onchange="modelo()"><?=$date['marca']?></select>
                </div>
                <div class="span6">
                    <label>MODELO *</label>
                    <select class="span12" id="idmodelo" name="idmodelo"></select>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label>SERIE</label>
                    <input type="" class="span12" id="serie" name="serie" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <label>CANTIDAD M&Iacute;NIMA *</label>
                    <input type="number" class="span12" id="minimo" name="minimo" />
                </div>
                <div class="span6">
                    <label>STOCK</label>
                    <input type="number" class="span12" id="stock" name="stock" readonly="readonly" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <label>PRECIO VENTA 1 *</label>
                    <input type="number" class="span12" id="precioventa_uno" name="precioventa_uno" />
                </div>
                <div class="span4">
                    <label>PRECIO VENTA 2</label>
                    <input type="number" class="span12" id="precioventa_dos" name="precioventa_dos" />
                </div>
                <div class="span4">
                    <label>PRECIO VENTA 3</label>
                    <input type="number" class="span12" id="precioventa_tres" name="precioventa_tres" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" onclick="modal('myModal1','close')">Close</a>
            <a href="#" class="btn btn-primary" onclick="guardar()">Guardar</a>
        </div>
    </form>
</div>

<div class="modal hide" id="myModal2">
    <div class="modal-header">
        <button class="close" onclick="modal('myModal2','close')">×</button>
        <h3>Eliminar Proveedor</h3>
    </div>
    <div class="modal-body">
        <label>Est&aacute; por eliminar al proveedoe <b class="item"></b>, el proceso eliminará por completo el registro, desea continuar?</label>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal2','close')">Close</a>
        <a href="#" class="btn btn-inverse" onclick="eliminar()">Continuar</a>
    </div>
</div>