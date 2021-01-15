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
        <h3>Registrar Rol</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <label>Rol</label>
                <input type="text" class="span12" id="rol" name="rol" />
                <input type="hidden" id="idrol" name="idrol">
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
        <h3>Eliminar Rol</h3>
    </div>
    <div class="modal-body">
        <label>Est&aacute; por eliminar el rol <b class="rol"></b>, el proceso eliminará por completo el registro, desea continuar?</label>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal2','close')">Close</a>
        <a href="#" class="btn btn-inverse" onclick="eliminar()">Continuar</a>
    </div>
</div>

<div class="modal hide" id="myModal3">
    <div class="modal-header">
        <button class="close" onclick="modal('myModal3','close')">×</button>
        <h3>Usuarios por roles</h3>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-bordered dTableR">
            <thead>
                <tr>
                    <th width="8">Item</th>
                    <th width="180">Nombres y Apellidos</th>
                    <th width="20">Usuario</th>
                    <th width="15">Acci&oacute;n</th>
                </tr>
                <tr>
                    <td width="8"><input type="hidden" id="idusuario" name="idusuario"></td>
                    <td width="180"><input type="" id="addnombre" name="addnombre" style="width: 90%"></td>
                    <td width="20"><input type="" id="addusuario" name="addusuario" style="width: 90%"></td>
                    <td width="15"><i title="Agregar" class="splashy-application_windows_add pointer" onclick="addusuariorol()"></td>
                </tr>
            </thead>
            <tbody id="tablausuarios">
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal3','close')">Close</a>
    </div>
</div>

<div class="modal hide" id="myModal4">
    <div class="modal-header">
        <button class="close" onclick="modal('myModal4','close')">×</button>
        <h3>Accesos</h3>
    </div>
    <div class="modal-body">
        <div id="divaccesos"></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal4','close')">Close</a>
    </div>
</div>

<div id="dialogConfirm"></div>
<script type="text/javascript">
    $("#addnombre").autocomplete({
        source:function(request,response){
            $.ajax({
                url: url+"usuario/autocomplete",
                type:"GET",
                dataType:"json",
                data:{
                    search: request.term,opcion:1
                },                    
                success:function(data){
                    response(data);
                }
            })
        },
        select: ( event, ui ) => {
            $("#idusuario").val(ui.item.idusuario)
            $("#addusuario").val(ui.item.usuario)
        }
    });

    $("#addusuario").autocomplete({
        source:function(request,response){
            $.ajax({
                url: url+"usuario/autocomplete",
                type:"GET",
                dataType:"json",
                data:{
                    search: request.term,opcion:0
                },                    
                success:function(data){
                    response(data);
                }
            })
        },
        select: ( event, ui ) => {
            $("#idusuario").val(ui.item.idusuario)
            $("#addnombre").val(ui.item.nombre)
        }
    });
</script>