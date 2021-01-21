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
        <h3>Registrar Tipo de documento</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <label>Nombre Largo</label>
                <input type="text" class="span11" id="nombrelargo" name="nombrelargo" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <label>Nombre corto</label>
                <input type="text" class="" id="nombrecorto" name="nombrecorto" />
                <input type="hidden" id="idtipodocumento" name="idtipodocumento">
            </div>
            <div class="span6">
                <label>C&oacute;digo</label>
                <input type="text" class="" id="codigo" name="codigo" />
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
        <h3>Eliminar Tipo de documento</h3>
    </div>
    <div class="modal-body">
        <label>Est&aacute; por eliminar tipo de documento <b class="tipodocumento"></b>, el proceso eliminará por completo el registro, desea continuar?</label>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal2','close')">Close</a>
        <a href="#" class="btn btn-inverse" onclick="eliminar()">Continuar</a>
    </div>
</div>
