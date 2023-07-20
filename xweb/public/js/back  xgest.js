function controlCookies() {
	// si variable no existe se crea (al clicar en Aceptar)
	localStorage.controlcookie = (localStorage.controlcookie || 0);
	localStorage.controlcookie++; // incrementamos cuenta de la cookie
	politica_cookies.style.display = 'none'; // Esconde la política de cookies
}

function cookiesOnLoad() {
	politica_cookies.style.display = 'none';
	if (!localStorage.controlcookie > 0) {
		politica_cookies.style.display = 'block';
	}
}

function mostrarSplash() {
	$("#splash").click();
}

function supScroll() {
	// boton de subir arriba
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});
}

function scrollerTo(eeid) {
	$('#' + eeid).scrollTo(100); // Scroll individual element 100 pixels down
	$('html, body').animate({
		scrollTop: $('#' + eeid).offset().top
	}, 'fast');

}

function supClick() {
	// boton de subir arriba
	$('.scrollup').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
}

function layerHideShow(capa) {
	if (capa.css('display') === 'none') {
		capa.show()
	} else {
		capa.hide()
	}
}

function tracking(code, tip, urlCall, urlWhere) {
	//codigo
	//tipo
	//desde donde
    //var postData = $("#farti").serialize() + '&codigo=' + code + '&tipo=' + tip + '&desde=' + urlWhere;
    $
	    .ajax({
	    url : urlCall,
	    data : {
			_token: $('meta[name="csrf-token"]').attr('content'),
			codigo:code,
			tipo:tip,
			desde:urlWhere,
		},
	    type : 'POST',
	    async : false,
	    success : function(result) {
		if (result.exito) {
			alertify.set('notifier','position', 'top-center');
		    alertify.error("Operación realizada con éxito");
		    //$('#notificacionesGenerales').text("Operación realizada con éxito");
		    //$('#notificacionesGenerales').css({"background-color" : "green"});
		}
		//$("#notificacionesGenerales").fadeIn('slow').delay(1000).fadeOut('slow');
	    }
	    });
    return true;
}

function saveTextAsFile(textToWrite, fileNameToSaveAs) {
	// grab the content of the form field and place it into a variable
	//var textToWrite = document.getElementById("inputTextToSave").value;
	// create a new Blob (html5 magic) that conatins the data from your form
	// feild
	var textFileAsBlob = new Blob([textToWrite], {
		type: 'text/plain'
	});
	// Specify the name of the file to be saved
	//var fileNameToSaveAs = "myNewFile.txt";

	// Optionally allow the user to choose a file name by providing
	// an imput field in the HTML and using the collected data here
	// var fileNameToSaveAs = txtFileName.text;
	// create a link for our script to 'click'
	var downloadLink = document.createElement("a");
	// supply the name of the file (from the var above).
	// you could create the name here but using a var
	// allows more flexability later.
	downloadLink.download = fileNameToSaveAs;
	// provide text for the link. This will be hidden so you
	// can actually use anything you want.
	downloadLink.innerHTML = "My Hidden Link";

	// allow our code to work in webkit & Gecko based browsers
	// without the need for a if / else block.
	window.URL = window.URL || window.webkitURL;

	// Create the link Object.
	downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
	// when link is clicked call a function to remove it from
	// the DOM in case user wants to save a second file.
	if (1 == 2) {
		// en la anterior funcionaba correctamente aqui no
		downloadLink.onclick = destroyClickedElement;
	}
	// make sure the link is hidden.
	downloadLink.style.display = "none";
	// add the link to the DOM
	document.body.appendChild(downloadLink);

	// click the new link
	downloadLink.click();
}

 var arrAmpliaciones = ['695006AMP101', '695006AMP102', '695006AMP103', '695006AMP104', '695006AMP105', '695006AMP106', '695006AMP201', '695006AMP202', '695006AMP203', '695006AMP204', '695006AMP205', '695006AMP206', '69509901', '69509902', '69509903', 'POG', 'POA', 'POV', 'POGS', 'POAS'];

function addArticulo(code, canti, urlCall, element = null, ampl1 = '', ampl2 = '', ampl3 = '') 
{
	if (code != 'POG' && code != 'POA'  && code != 'POV'  && code != 'POGS'  && code != 'POAS')
	{
		alertify.set('notifier', 'position', 'top-center');
		alertify.success("Añadido");
	}

	if ($('#cestaAjax').is(':visible')) 
	{
		$('#cestaAjax').css('visibility', 'hidden');
		$('.divLoading').css('visibility', 'visible');

		setTimeout(function()
		{
			$('.divLoading').css('visibility', 'hidden');
			$('#cestaAjax').css('visibility', 'visible');
		}, 4000);
	}

	setTimeout(function()
	{
		console.log('Adiooooos1 ' + code + ' *** ' + canti + ' *** ' + ampl1 + ' *** ' + ampl2 + ' *** ' + ampl3);
		$.ajax({
			url: urlCall,
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				codigo: code,
				cantidad: canti,
				ampl1: ampl1,
				ampl2: ampl2,
				ampl3: ampl3,
			},
			type: 'POST',
			async: false,
			success: function (result) {
				console.log('Adiooooos2 ' + result.msg);
				if (result.exito) 
				{
					$('#counterCesta').text(result.cesta);
					$('#importeCesta').text(result.importe);
					alertify.set('notifier', 'position', 'top-center');



					$(element).css('background-image', 'none');
					$(element).css('background-color', 'green');
					$(element).empty();
					$(element).text('Añadido');

				} 
				else 
				{
					alertify.set('notifier', 'position', 'top-center');
				}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
    		console.log(jqXHR + ' ---- ' + textStatus + ' **** ' + errorThrown);
		}); 
	}, 100);

	setTimeout(function()
    {
        $(element).css('background-image', 'url(/public/images/btnverarticulo0.jpg)');
		$(element).css('background-color', 'red');
		$(element).empty();
		$(element).text('Añadir');
    }, 7000);

	return true;
}

function cambiarCantidad(numArti, cantiArt, sumar)
{
	if (sumar)
	{
		$('#cantiArti' + numArti).val(parseInt(cantiArt) + parseInt(1));
	}
    else 
    {
    	$('#cantiArti' + numArti).val(parseInt(cantiArt) - parseInt(1));
    }
}

function modifyArticulo(code, urlCall, tipo, numArtCesta) {
	//var postData = $("#farti").serialize() + '&codigo=' + code + '&cantidad=' + canti;
	if (tipo == 0)
	{
		$('#canti' + numArtCesta).val(parseInt($('#canti' + numArtCesta).val()) - parseInt(1));
	}
	else if (tipo == 1)
	{
		$('#canti' + numArtCesta).val(parseInt($('#canti' + numArtCesta).val()) + parseInt(1));
	}

	var canti = $('#canti' + numArtCesta).val();

	$.ajax({
		url: urlCall,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			codigo: code,
			cantidad: canti,
		},
		type: 'POST',
		async: false,
		success: function (result) {
			console.log(result);

			if (result.exito) {
				$('#counterCesta').text(result.cesta);
				$('#importeCesta').text(result.importe);
				alertify.set('notifier', 'position', 'top-center');
				$('#cantiArti' + code).val(canti);
				//alertify.success("Artículo agregado a la cesta.");
				//$('#notificacionesGenerales').text("Artículo agregado a la cesta.");
				//$('#notificacionesGenerales').css({"background-color" : "green"});
			} else {
				alertify.set('notifier', 'position', 'top-center');
				alertify.error("No se ha podido añadir el artículo, es posible que no se disponga de stock suficiente.");
				//$('#notificacionesGenerales').text("No se ha podido añadir el artículo, es posible que no se disponga de stock suficiente.");
				//$('#notificacionesGenerales').css({"background-color" : "red"});
				console.log(result.msg);
			}
			//$("#notificacionesGenerales").fadeIn('slow').delay(1000).fadeOut('slow');
		}
	});
	return true;
}

function deleteArticulo(code, urlCall, numArticulos = 0) 
{
	//var postData = $("#farti").serialize() + '&codigo=' + code;
	$.ajax({
		url: urlCall,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			codigo: code,
			numArticulos: numArticulos
		},
		type: 'POST',
		async: false,
		success: function (result) {
			console.log(result);
			if (result.exito) {
				$('#counterCesta').text(result.cesta);
				$('#importeCesta').text(result.importe);
				alertify.set('notifier', 'position', 'top-center');

				if ($.inArray('Rojo', arrAmpliaciones) == 0)
				{
					alertify.error("Artículo eliminado de la cesta.");
				}

				console.log('He entrado1 *** ' + numArticulos);
			} 
			else 
			{
				alertify.set('notifier', 'position', 'top-center');

				if (code != 'POA' && code != 'POAS')
				{
					alertify.error("No se ha podido eliminar el artículo.");
				}
				
				console.log(result.msg);
			}
		}
	});

	if (numArticulos == 1)
	{
		$.ajax({
			url: urlCall,
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				codigo: 'POG',
			},
			type: 'POST',
			async: false,
			success: function (result) {
				
				if (result.exito) {
					$('#counterCesta').text(result.cesta);
					$('#importeCesta').text(result.importe);
					alertify.set('notifier', 'position', 'top-center');
				} else {
					alertify.set('notifier', 'position', 'top-center');
					console.log(result.msg);
				}

				console.log('He entrado2 *** ' + numArticulos);
			}
		});
	}

	return true;
}

function selecFormasCesta(ruta, elemento) {
	// cambia formas de pago y envio en la cesta
	//var postData = $("#farti").serialize();
	console.log('Ruta1: ' + ruta);

	$('.nomFPago').each(function()
    {
        $(this).removeClass("formaPagoEnvioSelected");
    });

    $(elemento).children().find("formaPagoEnvioSelected");

	$.ajax({
		url: ruta,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
		},
		type: 'POST',
		async: false,
		success: function (result) {
			console.log('Ruta1: ' + result);
		}
	});
	return true;
}

function finalizarCompra(ruta) {console.log("Ruta: " + ruta);
	var retorno = "error";
	$.ajax({
		url: ruta,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
		},
		type: 'POST',
		async: false,
		success: function (result) {
			if (result.exito) {
				console.log(result.errors);
				retorno = result.ruta;
			}
			if (!result.exito) {
				console.log(result.errors);
				alertify.set('notifier', 'delay', 10);
				alertify.set('notifier', 'position', 'top-center');
				alertify.alert('', "se ha producido un error, " + result.errors + ".");
				alertify.error("Error al finalizar la compra. " + result.errors);
			}
		},
		error: function (ee) {
			retorno = 'errorMail';
		}
	});
	return retorno;
}

function cambiarDesgloseCesta(ruta, objeto, valor) {
	//var postData = $("#farti").serialize() + '&objeto=' + objeto + '&valor=' + valor;
	$.ajax({
		url: ruta,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			objeto: objeto,
			valor: valor,
		},
		type: 'POST',
		async: false,
		success: function (result) {}
	});
	return true;
}

function cambiarPagoPedido(ruta, numero, valor) {
	//var postData = $("#farti").serialize() + '&numero=' + numero + '&valor=' + valor;
	$.ajax({
		url: ruta,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			numero: numero,
			valor: valor,
		},
		type: 'POST',
		async: false,
		success: function (result) {}
	});
	return true;
}

function cambiarPropiedades(ruta) {
	//var postData = $("#farti").serialize();// + '&prop=' + codprop+ '&val=' +
	$.ajax({
		url: ruta,
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
		},
		type: 'POST',
		async: false,
		success: function (result) {}
	});
	console.log(ruta);
	return true;
}