
<!--
<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalobs_" id="dalobs">Fechas</button>
-->
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="modalobs_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= $titulo; ?></h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                 <label>Por favor indicar una breve descripción:</label>   
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <div class="form-group field-<?= strtolower($maestro); ?>-observacion required">
                        <textarea class="form-control" id="<?= strtolower($maestro); ?>-observacion" name="<?= $maestro; ?>[observacion]" rows="10" requered></textarea>  
                    </div>
                </div>
                <div id="mensajeobs" ></div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
                <button type="submit" id="btn_observacion" class="btn btn-primary" >Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script>
 var tipo = <?= $tipo; ?>;
 var maestro = "<?= strtolower($maestro); ?>";
 
 $("#btn_observacion").click(function( ) {
   
   if($.trim($("#"+maestro+"-observacion").val()) != '') {
        var respuesta = confirm('Esta seguro de realizar esta Acción?');
        
        if (respuesta == true) {
            
            if (tipo == 1) {
                
                $('#'+maestro+'-respuesta_aprob').val(0);
            }
          
          jsShowWindowLoad('Procesando...');
          
          return true;
        }
    }
    else
    {
      $("#mensajeobs").html("<label style='color:red;'>Por favor ingrese la Descripción.</label>"); 
    }
    return false;
});   
    
</script>