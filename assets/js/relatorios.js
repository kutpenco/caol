jQuery(function ($) {
	
	$(document).ready(function(){
		
    	
        $("#peopleLst").on('change', function(event) {
    		event.preventDefault();
    		

    		$.fn.extend({
                htmlReport: function (data) {
                    $("#relatorio_table").html(data);
                },
                jsonGraph: function(){
                    alert('graph');
                }

            });

            var form = $("#frmFilterPeople");
            var ajaxDataType = $("#peopleLst").data("ajax-data-type");
    		
            $("#loading").removeClass('hide');

    		$.ajax({
                url:  form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'html',
                success: function(data) {

                    //alert(ajaxDataType);
                    $("#relatorio_table").html(data);
                    //$("#peopleLst").htmlReport(data);
                    

                },
                error: function(){

                    bootbox.dialog({
                      title: "Erro ao consultar relatório",
                      message: "Tivemos erro na consulta de relatórios.",
                      buttons: {
                        'Ok': {
                          label: "Ok!",
                          className: "btn-danger"
                        }
                      }
                    });
                },
                complete: function() {

                    $("#loading").addClass('hide');

                }
            });

    		


    	});

    	




	});		
});