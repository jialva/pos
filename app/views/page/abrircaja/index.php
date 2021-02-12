<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">
            <?php echo $date['nombretabla'];
                if($date['add']==1){
            ?>
                <button class="btn" style="float: right;" onclick="limpiar(),modal('myModal1','open')"><i class="splashy-application_windows_add"></i> Abrir</button>
            <?php }?>     
        </h3>
        <div id="tabla"></div>
    </div>
</div>

<div class="modal hide" id="myModal1">
    <div class="modal-header">
        <button class="close" onclick="modal('myModal1','close')">×</button>
        <h3>Aperturar Caja</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span6">
                <label>Fecha</label>
                <input type="date" class="span12" id="fechaapertura" name="fechaapertura" readonly="readonly" value="<?=date('Y-m-d')?>">
                <input type="hidden" id="idapertura" name="idapertura">
            </div>
            <div class="span6">
                <label>Monto</label>
                <input type="number" class="span12" id="montoapertura" name="montoapertura" value="0" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="modal('myModal1','close')">Close</a>
        <a href="#" class="btn btn-primary" onclick="guardar()">Guardar</a>
    </div>    
</div>