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
    <div class="modal-header">
        <button class="close" onclick="modal('myModal1','close')">×</button>
        <h3>Registrar Cliente</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span6">
                <label>Tipo documento</label>
                <select id="idtipodocumento" name="idtipodocumento"><?=$date['tipodocumento']?></select>
            </div>
            <div class="span6">
                <label>Documento</label>
                <input type="" class="" id="numero" name="numero" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <label>Nombres</label>
                <input type="text" class="" id="nombre" name="nombre" />
                <input type="hidden" id="idcliente" name="idcliente">
            </div>
            <div class="span6">
                <label>Apellidos</label>
                <input type="text" class="" id="apellido" name="apellido" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <label>Tel&eacute;fono</label>
                <input type="text" class="" id="telefono" name="telefono" />
            </div>
            <div class="span6">
                <label>Email</label>
                <input type="email" class="" id="email" name="email" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <label>Direcci&oacute;n</label>
                <input type="text" class="span11" id="direccion" name="direccion" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <label class="checkbox">
                    <input type="checkbox" name="credito" id="credito">
                    Se otorga crédito
                </label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal1','close')">Close</a>
        <a href="#" class="btn btn-primary" onclick="guardar()">Guardar</a>
    </div>    
</div>

<div class="modal hide" id="myModal2">
    <div class="modal-header">
        <button class="close" onclick="modal('myModal2','close')">×</button>
        <h3>Eliminar Cliente</h3>
    </div>
    <div class="modal-body">
        <label>Est&aacute; por eliminar al cliente <b class="item"></b>, el proceso eliminará por completo el registro, desea continuar?</label>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal2','close')">Close</a>
        <a href="#" class="btn btn-inverse" onclick="eliminar()">Continuar</a>
    </div>
</div>
