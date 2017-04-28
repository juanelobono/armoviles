var Login = function() {
    var handleLogin = function() {
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    email: true
                },
                contrasenia: {
                    required: true
                },
                remember: {
                    required: false
                }
            },
            messages: {
                email: {
                    required: "Correo electr&oacute;nico requerido.",
                    email: "Direcci&oacute;n de correo electr&oacute;nico inv&aacute;lida."
                },
                contrasenia: {
                    required: "Contrase&ntilde;a requerida."
                }
            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function() {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Correo electr&oacute;nico requerido."
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   

            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function() {

        //inicializarSelectBuscador();

        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                nombre: {
                    required: true
                },
                apellido: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "/validacion/email.htm",
                        type: "POST"
                    }
                },
                localidad: {
                    required: true
                },
                provincia: {
                    required: true
                },
                pais: {
                    required: true
                },
                contrasenia: {
                    required: true
                },
                contrasenia2: {
                    equalTo: "#register_password"
                },
                tnc: {
                    required: true
                }
            },
            messages: {
                nombre: {
                    required: "Nombre requerido."
                },
                apellido: {
                    required: "Apellido requerido."
                },
                localidad: {
                    required: "Localidad requerida."
                },
                provincia: {
                    required: "Provincia requerida."
                },
                pais: {
                    required: "Pa&iacute;s requerido."
                },
                email: {
                    required: "Correo electr&oacute;nico requerido.",
                    email: "Direcci&oacute;n de correo electr&oacute;nico inv&aacute;lida.",
                    remote: "Correo electr&oacute;nico en uso."
                },
                contrasenia: {
                    required: "Contrase&ntilde;a requerida."
                },
                contrasenia2: {
                    equalTo: "Las contrase&ntilde;as ingresadas no coinciden."
                },
                tnc: {
                    required: "Debe aceptar los T&eacute;rminos y Condiciones de Uso antes de continuar."
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   

            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.register-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });

        jQuery('#register-btn').click(function() {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleLogin();
            handleForgetPassword();
            handleRegister();
        }
    };

}();