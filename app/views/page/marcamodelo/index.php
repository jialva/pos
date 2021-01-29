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
        <h3>Registrar Marca</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <label>Marca</label>
                <input type="text" class="span12" id="marca" name="marca" style="text-transform:uppercase;"/>
                <input type="hidden" id="idmarca" name="idmarca">
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
        <h3>Registrar Modelo <span class="nommarca"></span></h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span10">
                <label>Modelo</label>
                <input type="text" class="span12" id="modelo" name="modelo" style="text-transform:uppercase;"/>
                <input type="hidden" id="idmodelo" name="idmodelo">
            </div>
            <div class="span2">
                <i title="Agregar" style="margin-top: 25px;" class="splashy-add pointer" onclick="guardarmodelo()"></i>
            </div>  
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div id="tablamodelo"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal2','close')">Close</a>
        <a href="#" class="btn btn-primary" onclick="guardarmodelo()">Guardar</a>
    </div>
</div>