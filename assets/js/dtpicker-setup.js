
jQuery(function ($) {
	
	$(document).ready(function(){
		$('.input-group.date').datetimepicker({			
			format: 'DD/MM/YYYY',
    		todayBtn: true,
    		language: 'pt-BR',
			pickTime: false
    	});
    	
	});		
});

