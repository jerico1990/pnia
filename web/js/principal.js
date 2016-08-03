
function verificar_aportes(id,ruta_consulta)
{
    var array = [];
   $.ajax({
                    url: ruta_consulta,
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   
   return array
   
}

function verificar_programado(id,ruta_consulta)
{
    var array = [];
   $.ajax({
                    url: ruta_consulta,
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   return array
   
}

 (function($) { 
$.fn.extend({
    multiselect: function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on");
 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            });
        });
    });
}    
});
})(jQuery)