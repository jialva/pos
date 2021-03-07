<div class="row-fluid" id="bloquemensaje">
    <div class="span12">
        <div class="alert">
            Aperture una caja para realizar esta operaci&oacute;n. <a href="<?=BASE_URL?>abrircaja" class="btn btn-primary">Aperturar</a> 
        </div>
    </div>
</div>

<div class="row-fluid" style="margin-top: -10px;">
    <div class="span12">
        <h3 class="heading">
            <?php echo $date['nombretabla'];?>
        </h3>
        <div class="body">
            <form id="formcompra" class="form" onsubmit="return false;">
                <div class="formSep">
                    <div class="row-fluid">
                        <div class="span3">
                            <label>FECHA DE COMPRA <span class="f_req">*</span></label>
                            <input type="date" name="fechacompra" id="fechacompra" class="span12" value="<?=date('Y-m-d')?>"/>
                        </div>
                        <div class="span7">
                            <label>PROVEEDOR <span class="f_req">*</span></label>
                            <input type="" name="proveedor" id="proveedor" class="span12" value=""/>
                            <input type="hidden" name="idproveedor" id="idproveedor" value=""/>
                        </div>
                        <div class="span2">
                            <label>TIPO DE COMPRA <span class="f_req">*</span></label>
                            <select name="tipocompra" id="tipocompra" class="span12">
                                <option value="0">--SELECCIONE--</option>
                                <option value="1">CONTADO</option>
                                <option value="2">CREDITO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="formSep">
                    <div class="row-fluid">
                        <div class="span3">
                            <label>COMPROBANTE <span class="f_req">*</span></label>
                            <select name="idcomprobante" id="idcomprobante" class="span12">
                                <?=$date['documento']?>
                            </select>
                        </div>
                        <div class="span3">
                            <label>SERIE Y NUMERO <span class="f_req">*</span></label>
                            <input type="" name="serienumero" id="serienumero" class="span12" value=""/>
                        </div>
                        <div class="span2">
                            <label>MONEDA <span class="f_req">*</span></label>
                            <select name="moneda" id="moneda" class="span12">
                                <?=$date['moneda']?>
                            </select>
                        </div>
                        <div class="span2">
                            <label>VALOR <span class="f_req">*</span></label>
                            <input type="" name="valormoneda" id="valormoneda" class="span12" value="" readonly="readonly" />
                        </div>
                        <div class="span2">
                            <label>SALIDA <span class="f_req">*</span></label>
                            <select name="origen" id="origen" class="span12">
                                <option value="0">--SELECCIONE--</option>
                                <option value="1">CAJA</option>
                                <option value="2">BANCOS</option>
                                <option value="3">OTROS</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="formSep">
                    <div class="row-fluid">
                        <div class="span2">
                            <label>CODIGO</label>
                            <input type="" name="codigo" id="codigo" class="span12" value=""/>
                            <input type="hidden" name="idproducto" id="idproducto" value=""/>
                        </div>
                        <div class="span4">
                            <label>PRODUCTO</label>
                            <input type="" name="producto" id="producto" class="span12" value=""/>
                        </div>
                        <div class="span2">
                            <label>UNIDAD </label>
                            <input type="hidden" name="unidad" id="unidad" value=""/>
                            <select name="idunidad" id="idunidad" class="span12">
                                <?=$date['unidad']?>
                            </select>
                        </div>
                        <div class="span1">
                            <label>CANTIDAD </label>
                            <input type="" name="cantidad" id="cantidad" class="span12" value=""/>
                        </div>
                        <div class="span1">
                            <label>P. UNI. </label>
                            <input type="" name="precio" id="precio" class="span12" value=""/>
                        </div>
                        <div class="span1">
                            <label>AGREGAR</label>
                            <button class="btn" onclick="agregar()"><i class="splashy-application_windows_add"></i></button>
                        </div>
                    </div>
                </div>
                <div class="formSep">
                    <div class="row-fluid">
                        <table id="tablacompra" width="100%" border="0">
                            <thead>
                                <tr style="border-bottom: 1px solid #000000;">
                                    <th width="10" align="left">CODIGO</th>
                                    <th width="250" align="left">DESCRIPCION</th>
                                    <th width="10" align="left">UNIDAD</th>
                                    <th width="10" align="left">CANTIDAD</th>
                                    <th width="10" align="left">P. UNITARIO</th>
                                    <th width="10" align="left">IMPORTE</th>
                                    <th width="10"></th>
                                </tr>
                            </thead>
                            <tbody>
                                                             
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><b>SUB TOTAL S/.</b></td>
                                    <td><input type="hidden" id="subtotal" name="subtotal"><b class="subtotal">0.00</b></td>
                                    <td><b>I.G.V 18% S/.</b></td>
                                    <td><input type="hidden" id="igv" name="igv"><b class="igv">0.00</b></td>
                                    <td><b>TOTAL VENTA S/.</b></td>
                                    <td><input type="hidden" id="totalventa" name="totalventa"><b class="totalventa">0.00</b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="form-actions" align="right">
                    <button class="btn">CANCELAR</button>
                    <button class="btn btn-inverse" onclick="registrar()">REGISTRAR</button>
                </div>
            </form>
        </div>
    </div>
</div>