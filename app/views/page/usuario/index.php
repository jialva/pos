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
            <div class="span6">
                <label>Nombres</label>
                <input type="text" class="" id="nombres" name="nombres" />
                <input type="hidden" id="idusuario" name="idusuario">
            </div>
            <div class="span6">
                <label>Apellidos</label>
                <input type="text" class="" id="apellidos" name="apellidos" />
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
            <div class="span6">
                <label>Usuario</label>
                <input type="text" class="" id="usuario" name="usuario" />
            </div>
            <div class="span6">
                <label>Password</label>
                <input type="password" class="" id="password" name="password" />
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
        <h3>Eliminar Usuario</h3>
    </div>
    <div class="modal-body">
        <label>Est&aacute; por eliminar al usuario <b class="usuario"></b>, el proceso eliminará por completo el registro, desea continuar?</label>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal2','close')">Close</a>
        <a href="#" class="btn btn-inverse" onclick="eliminar()">Continuar</a>
    </div>
</div>
