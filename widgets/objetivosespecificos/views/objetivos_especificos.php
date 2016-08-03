
<div class="clearfix"></div>
<div id="divobjetivo" class="col-xs-12 col-sm-9 col-md-12">
		<?php //if($objetivoespecifico) {?>
                <div class="col-xs-12 col-sm-9 col-md-12" id="proyecto-div_id_<?= $correlativo; ?>" >
		    <input type="hidden" value="<?= $objetivoespecifico->id?>" id="proyecto-obj_id_<?= $correlativo; ?>" name="Proyecto[objetivos_ids][]" />
		    <input type="hidden" value="<?= $objetivoespecifico->gestion;?>" id="proyecto-gestion_<?= $correlativo; ?>" name="Proyecto[gestion][]" /> 
		    <!--<div class="col-md-1" >
			<?= ($correlativo+1); ?>
		    </div>-->
		    <div class="col-md-1" >
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $correlativo; ?>">
			     <span style="color:black" class="glyphicon <?=($correlativo == 0)?'glyphicon-minus':'glyphicon-plus' ?> "></span>
			</a>
			</div>
		    <div class="col-xs-10 col-sm-10 col-md-8" >
			<div class="form-group field-proyecto-objetivos_descripciones_<?= $correlativo; ?> required">
			    <!--<label for="proyecto-obj_descripcion_<?= $correlativo; ?>">Descripción:</label>-->
			    <!--<input class="form-control" type="text" value="<?= $objetivoespecifico->descripcion;?>" placeholder="" maxlength="1980" id="proyecto-objetivos_descripciones_<?= $correlativo; ?>" name="Proyecto[objetivos_descripciones][]"  required/>-->
			    <textarea class="form-control" rows="2" placeholder="" maxlength="1980" id="proyecto-objetivos_descripciones_<?= $correlativo; ?>" name="Proyecto[objetivos_descripciones][]"  required><?= $objetivoespecifico->descripcion;?></textarea>
			</div> 
		    </div>
		    <div class="col-md-1">
			Peso:
			</div>
		    <div class="col-xs-12 col-sm-9 col-md-2" >
			
			<div class="form-group field-proyecto-objetivos_peso_<?= $correlativo; ?> required">
			    
			    <input class="form-control entero text-center" type="text" maxlength="3" value="<?= $objetivoespecifico->peso;?>" placeholder="" id="proyecto-objetivos_peso_<?= $correlativo; ?>" name="Proyecto[objetivos_peso][]"  required>
			</div>    
		    </div>

                    
                    <br>
                </div>
		
		<?php // } else {?>
		
		<?php //} ?>
                <div class="clearfix"></div>
</div>

<?php
    $eliminaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarobjetivoespecifico');
    $rutagrabaroe= Yii::$app->getUrlManager()->createUrl('objetivoe/registrar');
    $rutagrabarog= Yii::$app->getUrlManager()->createUrl('proyecto/grabarog');
    $rutaobetivoeindex= Yii::$app->getUrlManager()->createUrl('objetivoe/index');
    $rutaobteneog= Yii::$app->getUrlManager()->createUrl('objetivoe/obteneog');
    $ruraeliminaroe= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarobjetivoespecifico');
?>
<script>


    var oe=''; 
    
    
    $("#objetivo_row_1").click(function(){
       console.log(oe);
        if($('#proyecto-objetivos_descripciones_'+(oe-1)).val()=='')
        {
            var error='ingrese el objetivo #'+oe+' <br>';
            $('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');
            $.notify({
                message: error 
            },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'bottom',
                    align: 'right'
                },
            });
            return false;
        }
        
            $('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-success');
            $('.field-proyecto-objetivos_descripciones_'+(oe-1)).removeClass('has-error');
            $('#objetivo_addr_1_'+oe).html("<td>"+ (oe+1) +"</td><td><div class='form-group field-proyecto-objetivos_descripciones_"+oe+" required'><input id='proyecto-objetivos_descripciones_"+oe+"' name='Proyecto[objetivos_descripciones_a][]' type='text' placeholder='Descripción #"+(oe+1)+"' class='form-control'  /></div></td><td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
            $('#objetivos_especificos_tabla').append('<tr id="objetivo_addr_1_'+(oe+1)+'"></tr>');
            oe++;
        
        
        
        return true;
    });
    
    $("#objetivos-especificos").click(function( ) {
	var id='1';
	if (id=='') {
	    $.notify({
                message: 'No existe proyecto registrado'
            },{
                type: 'danger',
                offset: 20,
                spacing: 10,
                z_index: 1031,
                placement: {
                    from: 'top',
                    align: 'right'
                },
            });
            return false;
	}
	return true;
    });
    
</script>