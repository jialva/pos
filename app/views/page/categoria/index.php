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
        <h3>Registrar Categor&iacute;a</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <label>CATEGOR&Iacute;A</label>
                <input type="text" class="span12" id="categoria" name="categoria" style="text-transform:uppercase;"/>
                <input type="hidden" id="idcategoria" name="idcategoria">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal1','close')">Close</a>
        <a href="#" class="btn btn-primary" onclick="guardar()">Guardar</a>
    </div>
</div>