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
                <div class="span6">
                    <label>R.U.C</label>
                    <input type="" class="span12" id="ruc" name="ruc" />
                    <input type="hidden" id="idproveedor" name="idproveedor">
                </div>
                <div class="span6">
                    <label>Tipo</label>
                    <input type="" class="span12" id="tipo" name="tipo" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label>Raz&oacute;n Social</label>
                    <input type="text" class="span12" id="razonsocial" name="razonsocial" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label>Nombre Comercial</label>
                    <input type="text" class="span12" id="nombrecomercial" name="nombrecomercial" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <label>Tel&eacute;fono</label>
                    <input type="text" class="span12" id="telefono" name="telefono" />
                </div>
                <div class="span4">
                    <label>Email</label>
                    <input type="email" class="span12" id="email" name="email" />
                </div>
                <div class="span4">
                    <label>Estado</label>
                    <input type="text" class="span12" id="estado" name="estado" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label>Direcci&oacute;n</label>
                    <input type="text" class="span12" id="direccion" name="direccion" />
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
