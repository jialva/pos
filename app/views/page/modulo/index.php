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
        <h3>Registrar Usuario</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <label>M&oacute;dulo</label>
                <input type="text" class="span11" id="modulo" name="modulo" />
                <input type="hidden" id="idmodulo" name="idmodulo">
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <label>M&oacute;dulo Padre</label>
                <select id="modulo_padre" name="modulo_padre"><?=$date['mp']?></select>
            </div>
            <div class="span6">
                <label>URL</label>
                <input type="text" class="" id="url" name="url" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <label>Icono</label>
                <input type="" class="" id="icono" name="icono" />
            </div>
            <div class="span6">
                <label>Orden</label>
                <input type="text" class="" id="orden" name="orden" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal1','close')">Close</a>
        <a href="#" class="btn btn-primary" onclick="guardar()">Guardar</a>
    </div>
</div>