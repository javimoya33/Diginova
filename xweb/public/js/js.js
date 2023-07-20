var isIE = false;
var req;

function ComprobarUsuarioRMA(esMovil) { 
    if (esMovil == 0)
    {
        return true;
    }
    else
    {
        if (document.getElementById("cbloqueo").value == ""  && document.getElementById("cbloqueono").checked == "" )
        {
            alert("Indica el codigo de bloqueo");
            return false;
        }

        if ( (document.getElementById("uicloud").value == "" ||  document.getElementById("picloud").value == "") && document.getElementById("icloudno").checked == "" )
        {
            alert("Indica el usuario y clave de iCloud");
            return false;
        }
    }
}

function ent_cant_sumar(indice, maximo) {
    campo = document.getElementById("ent_canti"+indice);
    //if (campo.value < maximo) { campo.value++; }
    campo.value++;
}

function ent_cant_restar(indice) {
    campo = document.getElementById("ent_canti"+indice);
    if (campo.value > 1) { campo.value--; }
}

function ent_comprobar(indice, maximo) { 
    campo = document.getElementById("ent_canti"+indice);

    if (!isInt(campo.value)) { alert("Por favor, introduzca una cantidad correcta"); return false; }
    
    //if (campo.value > maximo || campo.value < 1) { alert("Por favor, introduzca una cantidad correcta"); return false; }
    if (campo.value < 1) { alert("Por favor, introduzca una cantidad correcta"); return false; }
    document.indicegen = indice;
    window.location = "#modal"+indice;
    //window.location = "index.php?page=entradas&ind"+indice+"#modal";
}

function isInt(value) {
    var er = /^-?[0-9]+$/;

    return er.test(value);
}

function celdaCantBajar(acodar, max) {
    var valor = document.getElementById("cant" + acodar).value;
    var nuevoValor = valor;

    if (valor > 1) { nuevoValor--; }

    document.getElementById("cant" + acodar).value = nuevoValor; 

    comprobarCants(acodar, nuevoValor, max);
}

function celdaCantSubir(acodar, max) {
    var valor = document.getElementById("cant" + acodar).value;

    if (valor < max)
    {
        valor++;
        document.getElementById("cant" + acodar).value = valor;
    }
    
    comprobarCants(acodar, valor, max);
}

function comprobarCants(acodar, cantidad, max) {
    var itemMenos = document.getElementById("menos" + acodar);
    var itemMas = document.getElementById("mas" + acodar);

    if (cantidad <= 1) { itemMenos.src = "public/images/artmenosoff.png"; }
    else { itemMenos.src = "public/images/artmenoson.png"; }

    if (cantidad >= max) { itemMas.src = "public/images/artmasoff.png"; }
    else { itemMas.src = "public/images/artmason.png"; }
}

function supScroll() {
    // boton de subir arriba
    $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
    });
}
function supClick() {
    // boton de subir arriba
    $('.scrollup').click(function() {
    $("html, body").animate({
        scrollTop : 0
    }, 600);
    return false;
    });
}
