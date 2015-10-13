jQuery(function ($) {
	$(document).ready(function() {
	    $('#frmLogin')
	        .bootstrapValidator({
	            container: 'tooltip',
	            feedbackIcons: {
	                //valid: 'glyphicon glyphicon-ok',
	                valid: 'glyphicon',
	                invalid: 'glyphicon glyphicon-remove',
	                validating: 'glyphicon glyphicon-refresh'
	            },
	            fields: {
	                inputUser: {
	                    validators: {
	                        notEmpty: {
	                            message: 'Usuário não deve estar vazio'
	                        }
	                    }
	                },
	                inputPassword: {
	                    validators: {
	                        notEmpty: {
	                            message: 'Senha não deve estar vazio'
	                        },
	                        identical: {
                        		field: 'inputConfirmPassword',
                        		message: 'Senha e confirmação de senha devem ter o mesmo valor'
                    		}
	                    }
	                },
	                inputConfirmPassword: {
	                    validators: {
	                        notEmpty: {
	                            message: 'Confirmação de Senha não deve estar vazio'
	                        },
	                        identical: {
                        		field: 'inputPassword',
                        		message: 'Senha e confirmação de senha devem ter o mesmo valor'
                    		}
	                    }
	                },
	                inputEmail: {
		                validators: {
		                    notEmpty: {
		                        message: 'O campo E-Mail é obrigatório'
		                    },
		                    emailAddress: {
		                        //message: 'The email address is not valid'
		                    }
		                }
            }
	            }
	        })
	        .on('error.field.bv', function(e, data) {
	            // Get the tooltip
	            
	            var $parent = data.element.parents('.form-group'),
	                $icon   = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
	                title   = $icon.data('bs.tooltip').getTitle();
	
	            // Destroy the old tooltip and create a new one positioned to the right
	            $icon.tooltip('destroy').tooltip({
	                html: true,
	                placement: 'right',
	                title: title,
	                container: 'body'
	            });
				
	        });
	
	    // Reset the Tooltip container form
	    $('#resetButton').on('click', function(e) {
	        var fields = $('#frmLogin').data('bootstrapValidator').getOptions().fields,
	            $parent, $icon;
	
	        for (var field in fields) {
	            $parent = $('[name="' + field + '"]').parents('.form-group');
	            $icon   = $parent.find('.form-control-feedback[data-bv-icon-for="' + field + '"]');
	            $icon.tooltip('destroy');
	        }
	
	        // Then reset the form
	        $('#frmLogin').data('bootstrapValidator').resetForm(true);
	    });

	});
});