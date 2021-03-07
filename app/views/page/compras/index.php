<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">
            <?=$date['nombretabla']?>
            <button class="btn" style="float: right;" onclick="limpiar(),modal('myModal1','open')"><i class="splashy-application_windows_add"></i> Nuevo</button>        
        </h3>
        <div id="tabla"></div>
    </div>
</div>

<div class="modal hide" id="myModal1">
    <div class="modal-header">
        <button class="close" onclick="modal('myModal1','close')">×</button>
        <h3>Registrar Unidad de Medida</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <label>Nombre Largo</label>
                <input type="text" class="span12" id="nombrelargo" name="nombrelargo" />
                <input type="hidden" id="idunidad" name="idunidad">
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <label>Nombre Corto</label>
                <input type="text" class="span12" id="nombrecorto" name="nombrecorto" />
            </div>
            <div class="span6">
                <label>Conversi&oacute;n</label>
                <input type="number" class="span12" id="conversion" name="conversion" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal1','close')">Close</a>
        <a href="#" class="btn btn-primary" onclick="guardar()">Guardar</a>
    </div>
</div>