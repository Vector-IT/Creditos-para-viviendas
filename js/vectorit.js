$(document).ready(function () {
    $("#txtCUIT").change(function() {
        var cuit = $("#txtCUIT").val().trim();
        var url = "https://soa.afip.gob.ar/sr-padron/v2/persona/" + cuit;

        $.get(url, function(data) {
            if (data.success) {
                $(".resultadoCuit").html(data.data.nombre);
            }
            else {
                $("#resultadoCuit").html("Error al procesar su CUIL/CUIT, por favor verifique el dato ingresado.");
                $("#txtCUIT").focus();
            }
        });
    });

    $("#frmPrestamo").submit(function() {
		if (($("#resultadoCuit").html().indexOf("Error") > -1) || ($("#resultadoCuit").html() == '')) {
			alert("Antes de continuar debe ingresar un CUIT válido!");
			$("#txtCUIT").focus();
			return false;
		}

        $('#prestamoON').fadeIn();

        setTimeout(function() {
            var mensaje = "";
            mensaje+= "Registro de solicitud de crédito<br><br>";
            mensaje+= "Apellido y Nombre: " + $('#resultadoCuit').html().trim() + "<br>";
            mensaje+= "CUIT: " + $("#txtCUIT").val().trim() + "<br>";
            mensaje+= "Ingreso aproximado: " + $("#cmbIngreso").val().trim() + "<br>";
            mensaje+= "Tipo de ingreso: " + $('input[name = "radIngreso"]:checked').val() + "<br>";
            mensaje+= "Monto deseado: " + $("#txtMonto").val().trim() + "<br>";
            mensaje+= "Email: " + $("#txtEmail").val().trim() + "<br>";
            mensaje+= "Provincia: " + $("#cmbProvincia").val() + "<br>";
            mensaje+= "Ciudad: " + $("#txtCiudad").val().trim() + "<br>";
            mensaje+= "Telefono: " + $("#txtTelefono").val().trim() + "<br>";
            mensaje+= "Horario de contacto: de " + $("#horaDesde").val() + " a " + $("#horaHasta").val() + "<br>";
            mensaje+= "Domicilio: " + $("#txtDomicilio").val().trim() + "<br>";
            mensaje+= "Consulta: " + $("#txtConsulta").val().trim() + "<br>";

            var frmData = new FormData();
            frmData.append("Nombre", $('#resultadoCuit').html().trim());
            frmData.append("Email", $("#txtEmail").val().trim());
            frmData.append("Mensaje", mensaje);

            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    $('#prestamoON').hide();

                    if (xmlhttp.responseText.indexOf('Error') == -1) {
                        $('#frmPrestamo').hide();

                        $("#prestamoOK").fadeIn(function() {
                            var targetOffset = $("#prestamoOK").offset().top-200;
                            $('html,body').animate({scrollTop: targetOffset}, 500);
                        });
                    }
                    else {
                        alert("Error al procesar, intente nuevamente.");
                    }
                }
            };

            xmlhttp.open("POST","php/enviarMail.php", true);
            xmlhttp.send(frmData);
        }, 5000);

        return false;
    });
});