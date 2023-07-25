var isIE = false;
var req;

var arrFondosDia = [0, 11, 15, 16, 17, 19, 2, 20, 21, 22, 23, 24, 28, 30, 31, 33, 34, 35, 4, 41, 42, 43, 50, 51, 52, 53, 55, 94, 96, 99, 990, 25];
var d = new Date();
var hoy = d.getDate();
var int01;

var nombreImagen1;
var nombreImagen2;
var nombreImagen3;
var nombreImagen4;

var averiaTipoSoloPieza = false;

var popupOcultado = true;

function cambBloqueo(campo)
{
    if (campo.checked) 
    {
        document.getElementById('cbloqueo').disabled = true;
    } 
    else 
    {
        document.getElementById('cbloqueo').disabled = false;
    }
}

function cambICloud(campo)
{
    if (campo.checked) 
    {
        document.getElementById('uicloud').disabled = true;
        document.getElementById('picloud').disabled = true;
    } 
    else 
    {
        document.getElementById('uicloud').disabled = false;
        document.getElementById('picloud').disabled = false;
    }
}

function comprobarCampos() {
    var correcto = true;

    if (document.getElementById("rma_nombre").value == "") { correcto = false; }
    if (document.getElementById("rma_apellidos").value == "") { correcto = false; }
    if (document.getElementById("rma_email").value == "") { correcto = false; }
    if (document.getElementById("rma_email").value.indexOf("@") == -1 ) { correcto = false; }
    if (document.getElementById("rma_telefono").value == "" ) { correcto = false; }
    if (document.getElementById("rma_direccion").value == "") { correcto = false; }
    if (document.getElementById("rma_localidad").value == "") { correcto = false; }
    if (document.getElementById("rma_provincia").value == "") { correcto = false; }
    if (document.getElementById("rma_codpostal").value == "") { correcto = false; }

    if (!correcto) { alert("Por favor, introduce todos los campos"); }
    
    return correcto;
}


// ============================================

function comprobarCod(cod,codcli) {//alert(cod);
    //url = "comprobarFoto.php?cadenaFoto=" + cadFoto;
    url = "rma2/comprobarCod.php?cod="+cod+"&codcli="+codcli;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send(null);
        //	Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChange() {
    var campo = document.getElementById("cont_artic");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}


// -----------------------------------------------------------------------------------------

function comprobarCod_(cod,codcli) {//alert(cod);
    //url = "comprobarFoto.php?cadenaFoto=" + cadFoto;
    url = "rma2/comprobarCod_.php?cod="+cod+"&codcli="+codcli;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChange() {
    var campo = document.getElementById("cont_artic");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}


// -----------------------------------------------------------------------------------------

var campos = 1;

function agregarCampo(){
  campos = campos + 1;
  var NvoCampo= document.createElement("div");
  NvoCampo.id= "divcampo_"+(campos);
  NvoCampo.innerHTML= 
     "<tr>" +
     "     <td nowrap='nowrap'>" +
     "        <input type='text' size='70' maxlenght='300' name='sintoma_" + campos + 
                   "' id='sintoma_" + campos + "'>" +
     "     </td>" +
     "     <td nowrap='nowrap'>" +
     "        <a href='JavaScript:quitarCampo(" + campos +");'> Quitar </a>" +
     "     </td>" +
     "</tr>";
   var contenedor= document.getElementById("contenedorcampos");
   contenedor.appendChild(NvoCampo);
}

function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
}

// -----------------------------------------------------------------------------------------

function comprobarCod2(cod,codcli,codrma) {//alert(cod);
    //url = "comprobarFoto.php?cadenaFoto=" + cadFoto;
    url = "rma2/comprobarCod2.php?cod="+cod+"&codcli="+codcli+"&codrma="+codrma;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChange() {
    var campo = document.getElementById("cont_artic");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}

// ========================================

function comprobarCod2_(cod,codcli,codrma) {//alert(cod);
    //url = "comprobarFoto.php?cadenaFoto=" + cadFoto;
    url = "rma2/comprobarCod2_.php?cod="+cod+"&codcli="+codcli+"&codrma="+codrma;
    //alert(url);
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeRMA;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeRMA;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChangeRMA() {
    var campo = document.getElementById("cont_artic");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}

// ========================================


function comprobarNombre(nombre,codcli) {
    
    url = "rma2/comprobarNombre.php?nombre="+nombre+"&codcli="+codcli;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeNom;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeNom;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChangeNom() {
    var campo = document.getElementById("cont_artic");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}

//========================================================================================================================

function actualizarBusqueda(texto, marca, familia, tarifa) { 
    var marc = marca || "0";
    var fami = familia || "0";
    var tarif = tarifa || "0";

    url = "view/buscadorraul.php?cadena=" + texto + "&marca=" + marc + "&familia=" + fami + "&tarif=" + tarif;
    //alert(url);
    //url = "view/buscadorraul.php?cadena=" + texto;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeBusq;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeBusq;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChangeBusq() {
    var campo = document.getElementById("cont_busq");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img src="images/cargando.gif" align="middle" /> Cargando...';
    }
}





function actualizarBusqueda2(texto, marca, familia, tarifa) { 
    var marc = marca || "0";
    var fami = familia || "0";
    var tarif = tarifa || "0";

    url = "view/buscadorraul3.php?cadena=" + texto + "&marca=" + marc + "&familia=" + fami + "&tarif=" + tarif;
    //alert(url);
    //url = "view/buscadorraul.php?cadena=" + texto;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeBusq2;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeBusq2;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChangeBusq2() {
    var campo = document.getElementById("cont_busq2");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img src="images/cargando.gif" align="middle" /> Cargando...';
    }
}


function abrirBuscador(tarifa, cadena) { //alert(tarifa+"--"+cadena+"--"+marca+"--"+familia);
    var tarif = tarifa || "0";

    url = "view/buscadorraul0.php?tarif=" + tarif + "&cad=" + cadena;
    
    //alert(url);
    //url = "view/buscadorraul.php?cadena=" + texto;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeBusq0;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeBusq0;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChangeBusq0() {
    var campo = document.getElementById("cont_busq2");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img src="images/cargando.gif" align="middle" /> Cargando...';
    }
}


function actualizarBusqueda3(texto, marca, familia, tarifa) {
    var marc = marca || "0";
    var fami = familia || "0";
    var tarif = tarifa || "0";

    url = "view/buscadorraul.php?cadena=" + texto + "&marca=" + marc + "&familia=" + fami + "&tarif=" + tarif;
    //alert(url);
    //url = "view/buscadorraul.php?cadena=" + texto;
    
      if(url=='') {
        return;
    }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeBusq3;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeBusq3;
            req.open("GET", url, true);
            req.send();
        }
    }
}


function processReqChangeBusq3() {
    var campo = document.getElementById("contbusq2");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img src="images/cargando.gif" align="middle" /> Cargando...';
    }
}

function actualizarSelectores_fam(codF,arrSelectores,rango, tari)
{
    url="view/selectoresres1.php?codf="+codF;

    if(arrSelectores.length>0)
    {
        url+="&cadenasel=";

        for(var i=0;i<arrSelectores.length;i++)
        {
            url+=arrSelectores[i]+"_";
        }
    }

    url+="&rango="+rango+"&tari="+tari;

    if(url=='')
    {
        return;
    }

    if(window.XMLHttpRequest)
    {
        reqself=new XMLHttpRequest();
        reqself.onreadystatechange=processReqChangeSelF;
        reqself.open("GET",url,true);reqself.send(null);
    }
    else if(window.ActiveXObject)
    {
        isIE=true;
        reqself=new ActiveXObject("Microsoft.XMLHTTP");
        if(reqself)
        {
            reqself.onreadystatechange=processReqChangeSelF;
            reqself.open("GET",url,true);reqself.send();
        }
    }
}

function processReqChangeSelF()
{
    var campo=document.getElementById("contselects");

    if(reqself.readyState==4)
    {
        campo.innerHTML=reqself.responseText;
    }
    else
    {
        campo.innerHTML='<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}


// ==================================================

function aniadirCesta2(acodar, cantidad)
{
    url="view/aniadircesta.php?codart="+acodar+"&cant="+cantidad;

    if(url=='')
    {
        return;
    }

    if(window.XMLHttpRequest)
    {
        reqself=new XMLHttpRequest();
        reqself.onreadystatechange=processReqChangeCe2;
        reqself.open("GET",url,true);reqself.send(null);
    }
    else if(window.ActiveXObject)
    {
        isIE=true;
        reqself=new ActiveXObject("Microsoft.XMLHTTP");
        if(reqself)
        {
            reqself.onreadystatechange=processReqChangeCe2;
            reqself.open("GET",url,true);reqself.send();
        }
    }
}

function processReqChangeCe2()
{
    var campo=document.getElementById("contcomprar");

    if(reqself.readyState==4)
    {
        campo.innerHTML=reqself.responseText;
    }
    else
    {
        campo.innerHTML='<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}


function filtroAjaxCat(codCat, codFilt, tarifa, minP = -1, maxP = -1, ordenar = 0) { 

    var cadenaFiltros = "0,";
    //var verdes = document.getElementsByClassName("fbValor fbValor_2");
    var verdes = document.getElementsByClassName("catFilt catFilt_2");
    var i;
    for (i = 0; i < verdes.length; i++) 
    {
        cadenaFiltros = cadenaFiltros + verdes[i].id + ",";
    } 
    cadenaFiltros = cadenaFiltros.slice(0, -1);
    cadenaFiltros = cadenaFiltros.substring(2);

/*
    var minP = $("#slider-range").slider("values", 0);
    var maxP = $("#slider-range").slider("values", 1);
*/
    //if (document.getElementById("filtprecios").value == 0) { minP = -1; maxP = -1; }
    //else {  }
    
    url = "/xweb/view/celdasArticulosFiltrados2.php?codcat=" + codCat + "&strfiltros=" + cadenaFiltros + "&orden=" + ordenar + "&tari=" + tarifa;
    url += "&minp=" + minP + "&maxp=" + maxP;

    //if (minP != -1 && maxP != -1) { url += "&minp=" + minP + "&maxp=" + maxP; }
   
    if (window.XMLHttpRequest) {
        reqFCat = new XMLHttpRequest();
        reqFCat.onreadystatechange = processReqChangeCat;
        reqFCat.open("GET", url, true);
        reqFCat.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat) {
            reqFCat.onreadystatechange = processReqChangeCat;
            reqFCat.open("GET", url, true);
            reqFCat.send();
        }
    }
}


function processReqChangeCat() { 
    var campo = document.getElementById("filtradosCat");

    if(reqFCat.readyState == 4) {
        campo.innerHTML = reqFCat.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}



function filtroAjaxCatCheck(codCat, codFilt, tarifa, minP = -1, maxP = -1, ordenar = 0) { 

    var cadenaFiltros = "0,";
    var verdes = document.getElementsByClassName("catFilt catFilt_2");
    var i;
    for (i = 0; i < verdes.length; i++) 
    {
        cadenaFiltros = cadenaFiltros + verdes[i].id + ",";
    } 
    cadenaFiltros = cadenaFiltros.slice(0, -1);
    cadenaFiltros = cadenaFiltros.substring(2);


    var minP = $("#slider-range").slider("values", 0);
    var maxP = $("#slider-range").slider("values", 1);

    //if (document.getElementById("filtprecios").value == 0) { minP = -1; maxP = -1; }
    //else {  }
    
    url = "/xweb/view/celdasArticulosFiltrados2.php?codcat=" + codCat + "&strfiltros=" + cadenaFiltros + "&orden=" + ordenar + "&tari=" + tarifa;
    url += "&minp=" + minP + "&maxp=" + maxP;
    //url = "";

    //if (minP != -1 && maxP != -1) { url += "&minp=" + minP + "&maxp=" + maxP; }
   
    if (window.XMLHttpRequest) {
        reqFCat = new XMLHttpRequest();
        reqFCat.onreadystatechange = processReqChangeCatCheck;
        reqFCat.open("GET", url, true);
        reqFCat.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat) {
            reqFCat.onreadystatechange = processReqChangeCatCheck;
            reqFCat.open("GET", url, true);
            reqFCat.send();
        }
    }

    // ======== ACTIVADOS ======================

    url2 = "/xweb/view/filtrosActivos.php?codcat=" + codCat + "&strfiltros=" + cadenaFiltros;
    //url2 = "";
    
    document.getElementById("filtrosActivos").style.display = "block";

    if (cadenaFiltros == "") { document.getElementById("filtrosActivos").style.display = "none"; }


   
    if (window.XMLHttpRequest) {
        reqFCat2 = new XMLHttpRequest();
        reqFCat2.onreadystatechange = processReqChangeCatCheckActiv;
        reqFCat2.open("GET", url2, true);
        reqFCat2.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat2 = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat2) {
            reqFCat2.onreadystatechange = processReqChangeCatCheckActiv;
            reqFCat2.open("GET", url2, true);
            reqFCat2.send();
        }
    }
}


function processReqChangeCatCheck() { 
    var campo = document.getElementById("filtradosCat");

    if(reqFCat.readyState == 4) {
        campo.innerHTML = reqFCat.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}

function processReqChangeCatCheck2() { 
    var campo = document.getElementById("filtradosCat");

    if(reqFCat.readyState == 4) {
        campo.innerHTML = reqFCat.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}

function processReqChangeCatCheckActiv() { 
    var campo = document.getElementById("filtrosActivos");

    if(reqFCat2.readyState == 4) {
        campo.innerHTML = reqFCat2.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="/xweb/public/images/loading.gif" align="middle" /> Cargando...';
    }
}


// ==================================================

function filtroAjaxConsumibles(codFam, codFilt, tarifa, minP = -1, maxP = -1, ordenar = 0) 
{ 
    var cadenaFiltros = "0,";
    var verdes = document.getElementsByClassName("catFilt catFilt_2");
    var i;
    for (i = 0; i < verdes.length; i++) 
    {
        cadenaFiltros = cadenaFiltros + verdes[i].id + ",";
    } 
    cadenaFiltros = cadenaFiltros.slice(0, -1);
    cadenaFiltros = cadenaFiltros.substring(2);
    
    url = "/xweb/view/celdasArticulosConsumiblesFiltro.php?codfam=" + codFam + "&strfiltros=" + cadenaFiltros + "&orden=" + ordenar + "&tari=" + tarifa;
    url += "&minp=" + minP + "&maxp=" + maxP;

    //if (minP != -1 && maxP != -1) { url += "&minp=" + minP + "&maxp=" + maxP; }
   
    if (window.XMLHttpRequest) {
        reqFCat = new XMLHttpRequest();
        reqFCat.onreadystatechange = processReqChangeFilConsumibles;
        reqFCat.open("GET", url, true);
        reqFCat.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat) {
            reqFCat.onreadystatechange = processReqChangeFilConsumibles;
            reqFCat.open("GET", url, true);
            reqFCat.send();
        }
    }
}

function filtroAjaxConsumiblest(codFam, codFilt, pvdPorcentaje, minP = -1, maxP = -1, ordenar = 0) 
{ 
    var cadenaFiltros = "0,";
    var verdes = document.getElementsByClassName("catFilt catFilt_2");
    var i;
    for (i = 0; i < verdes.length; i++) 
    {
        cadenaFiltros = cadenaFiltros + verdes[i].id + ",";
    } 
    cadenaFiltros = cadenaFiltros.slice(0, -1);
    cadenaFiltros = cadenaFiltros.substring(2);
    
    url = "/xweb/view/celdasOFTcons.php?codfam=" + codFam + "&strfiltros=" + cadenaFiltros + "&orden=" + ordenar + 
    "&pvdPorcentaje=" + pvdPorcentaje;
    url += "&minp=" + minP + "&maxp=" + maxP;

    //if (minP != -1 && maxP != -1) { url += "&minp=" + minP + "&maxp=" + maxP; }
   
    if (window.XMLHttpRequest) {
        reqFCat = new XMLHttpRequest();
        reqFCat.onreadystatechange = processReqChangeFilConsumibles;
        reqFCat.open("GET", url, true);
        reqFCat.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat) {
            reqFCat.onreadystatechange = processReqChangeFilConsumibles;
            reqFCat.open("GET", url, true);
            reqFCat.send();
        }
    }
}

function processReqChangeFilConsumibles() { 
    var campo = document.getElementById("homeContArts");

    if(reqFCat.readyState == 4) {
        campo.innerHTML = reqFCat.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}



// ===================  Modal descuento popup   ===============================

function enviarDescuento(codcli) 
{ 
    var url = "/xweb/view/avisardescuento.php?codusu=" + codcli;

    if (window.XMLHttpRequest) {
        reqDesc = new XMLHttpRequest();
        reqDesc.onreadystatechange = processReqChangeDescuento;
        reqDesc.open("GET", url, true);
        reqDesc.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqDesc = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqDesc) {
            reqDesc.onreadystatechange = processReqChangeDescuento;
            reqDesc.open("GET", url, true);
            reqDesc.send();
        }
    }
}

function processReqChangeDescuento() { 
    var campo = document.getElementById("modalImg");

    if(reqDesc.readyState == 4) {
        campo.innerHTML = reqDesc.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}


function clickAcordeon(div)
{
    if ($(div).hasClass("open")) 
    {
        $(div).removeClass('open');

        $(div).parent('.catFiltGrupo ').find('.catFilGru').css('height', 'auto');
        $(div).parent('.catFiltGrupo ').find('.catFilGru').css('max-height', '224px');
        $(div).parent('.catFiltGrupo ').find('.catFilGru').css('transition', 'max-height 300ms ease 0s');
    }
    else
    {
        $(div).addClass('open');

        $(div).parent('.catFiltGrupo ').find('.catFilGru').css('height', '0px');
        $(div).parent('.catFiltGrupo ').find('.catFilGru').css('max-height', '0px');
        $(div).parent('.catFiltGrupo ').find('.catFilGru').css('transition', 'max-height 300ms ease 0s');
    }
}

function filtroAjaxCatCheck2(codCat, codFilt, tarifa, ccodcl, minP = -1, maxP = -1, ordenar = 0) 
{
    setTimeout(function()
    {
        if ($("#catOrd1").hasClass("catOrdNeg")) 
        {
            ordenar = 0;
        }

        if ($("#catOrd2").hasClass("catOrdNeg")) 
        {
            ordenar = 1;
        }

        if ($("#catOrd3").hasClass("catOrdNeg")) 
        {
            ordenar = 2;
        }

        $('#filtradosCat .celdaArt').each(function()
        {
            $(this).css('display', 'none');
        });


        if (codFilt == 134 || codFilt == 135 || codFilt == 136)
        {
            if ($('#134').hasClass('catFilt_2'))
            {
                $('#filtradosCat .celdaArt').each(function()
                {
                    var valueRefArt = $(this).find('#refArticulo').val();

                    if (valueRefArt.indexOf("6910") >= 0)
                    {
                        $(this).css('display', 'block');
                    }
                });
            }

            if ($('#135').hasClass('catFilt_2'))
            {
                $('#filtradosCat .celdaArt').each(function()
                {
                    var valueRefArt = $(this).find('#refArticulo').val();

                    if (valueRefArt.indexOf("6920") >= 0)
                    {
                        $(this).css('display', 'block');
                    }
                });
            }

            if ($('#136').hasClass('catFilt_2'))
            {
                $('#filtradosCat .celdaArt').each(function()
                {
                    var valueRefArt = $(this).find('#refArticulo').val();

                    if (valueRefArt.indexOf("6940") >= 0)
                    {
                        $(this).css('display', 'block');
                    }
                });
            }
        }

        var topCelda = 0;
        var leftCelda = 0;
        var numCeldas = 0;
        var filtroPulsado = false;
        var arrFiltrosActivos = [];
        var hayFiltrosActivos = false;
        var arrArticulosFiltrados = [];
        var arrPrecioArtsFiltrados = [];
        var arrRefArtsFiltrados = [];

        $('#filtradosCat .celdaArt').each(function()
        {
            var tieneFiltrosDeTodasLasCategorias = true;

            var clasesFilArticulo = $(this).attr("class");
            clasesFilArticulo = clasesFilArticulo.replaceAll("fil", "");

            var arrClasesFilArticulo = clasesFilArticulo.split(' ');

            $('.catFilGru').each(function()
            {
                hayFiltrosActivos = true;
                var tieneFiltrosActivos = false;
                var artTieneFiltrosDeEstaCategoria = false;

                $('.catFilt_2', this).each(function()
                {
                    tieneFiltrosActivos = true;

                    for (var i = 0; i < arrClasesFilArticulo.length; i++)
                    {
                        if (arrClasesFilArticulo[i] == $(this).attr('id'))
                        {
                            artTieneFiltrosDeEstaCategoria = true;
                        }
                    }
                });

                if (tieneFiltrosActivos && !artTieneFiltrosDeEstaCategoria)
                {
                    tieneFiltrosDeTodasLasCategorias = false;
                }
            });

            if (tieneFiltrosDeTodasLasCategorias)
            {
                if ($(this).is(":hidden"))
                {
                    var refArticulo = $(this).find('#refArticulo').val();

                    var precioArticulo = $(this).find('.celdaPrecio').text();
                    precioArticulo = parseInt(precioArticulo);

                    arrArticulosFiltrados.push([refArticulo, precioArticulo]);

                    if (ordenar == 0)
                    {
                        $(this).css('display', 'block');
                        $(this).css('top', topCelda + 'px');
                        $(this).css('left', leftCelda + 'px');

                        numCeldas += 1;
                        
                        if (codCat == 5)
                        {
                            leftCelda += 315;
                        }
                        else
                        {
                            leftCelda += 225;
                        }

                        if ((numCeldas % 4) == 0)
                        {
                            topCelda += 430;
                            leftCelda = 0;
                        }
                    }
                }
            }
        });

        if (numCeldas == 0 && hayFiltrosActivos == false)
        {
            $('#filtradosCat .celdaArt').each(function()
            {
                $(this).css('display', 'block');
                $(this).css('top', topCelda + 'px');
                $(this).css('left', leftCelda + 'px');

                numCeldas += 1;

                if (codCat == 5)
                {
                    leftCelda += 315;
                }
                else
                {
                    leftCelda += 225;
                }

                if ((numCeldas % 4) == 0)
                {
                    topCelda += 430;
                    leftCelda = 0;
                }
            });
        }
        else 
        {
            if (ordenar > 0)
            {
                arrArticulosFiltrados.sort(function(a, b){
                        return a[1] - b[1];
                    });

                if (ordenar == 1)
                {
                    var index, entry;

                    for (index = 0; index < arrArticulosFiltrados.length; ++index)
                    {
                        entry = arrArticulosFiltrados[index];

                        $('#filtradosCat .celdaArt').each(function()
                        {
                            var refArticulo = $(this).find('#refArticulo').val();

                            if (entry[0] == refArticulo)
                            {
                                $(this).css('display', 'block');
                                $(this).css('top', topCelda + 'px');
                                $(this).css('left', leftCelda + 'px');

                                numCeldas += 1;
                                leftCelda += 225;

                                if ((numCeldas % 4) == 0)
                                {
                                    topCelda += 430;
                                    leftCelda = 0;
                                }
                            }
                        });
                    }
                }
                else
                {
                    var index, entry;

                    for (index = arrArticulosFiltrados.length - 1; index >= 0; index--)
                    {
                        entry = arrArticulosFiltrados[index];

                        $('#filtradosCat .celdaArt').each(function()
                        {
                            var refArticulo = $(this).find('#refArticulo').val();

                            if (entry[0] == refArticulo)
                            {
                                $(this).css('display', 'block');
                                $(this).css('top', topCelda + 'px');
                                $(this).css('left', leftCelda + 'px');

                                numCeldas += 1;
                                leftCelda += 225;

                                if ((numCeldas % 4) == 0)
                                {
                                    topCelda += 430;
                                    leftCelda = 0;
                                }
                            }
                        });
                    }
                }
            }
        }
    }, 500);
}



function filtroTienda(codCat, codFilt, pvdPorcentaje, ccodcl, minP = -1, maxP = -1, ordenar = 0) { 

    var cadenaFiltros = "0,";
    var verdes = document.getElementsByClassName("catFilt catFilt_2");
    var i;
    for (i = 0; i < verdes.length; i++) 
    {
        cadenaFiltros = cadenaFiltros + verdes[i].id + ",";
    } 
    cadenaFiltros = cadenaFiltros.slice(0, -1);
    cadenaFiltros = cadenaFiltros.substring(2);

    url2 = "/filtrosactivos/" + codCat + "/" + cadenaFiltros;
    
    document.getElementById("filtrosActivos").style.display = "block";

    if (cadenaFiltros == "") { document.getElementById("filtrosActivos").style.display = "none"; }


   
    if (window.XMLHttpRequest) {
        reqFCat2 = new XMLHttpRequest();
        reqFCat2.onreadystatechange = processReqChangeCatCheckActiv;
        reqFCat2.open("GET", url2, true);
        reqFCat2.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFCat2 = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFCat2) {
            reqFCat2.onreadystatechange = processReqChangeCatCheckActiv;
            reqFCat2.open("GET", url2, true);
            reqFCat2.send();
        }
    }
}

function favorito(ccodcl, acodar, marcar)
{
    var url = "/xweb/view/favoritoMod.php?ccodcl=" + ccodcl + "&acodar=" + acodar + "&marcar=" + marcar;

    if (window.XMLHttpRequest) {
        reqFav = new XMLHttpRequest();
        reqFav.onreadystatechange = processReqChangeFav;
        reqFav.open("GET", url, true);
        reqFav.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFav = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFav) {
            reqFav.onreadystatechange = processReqChangeFav;
            reqFav.open("GET", url, true);
            reqFav.send();
        }
    }

    var campo = document.getElementById("celdaFavGuardado"+acodar);
    var campoImg = document.getElementById("celdaFavIcon"+acodar);
    var celdaFav = document.getElementById("celdaFav"+acodar);

    if (marcar == 1) 
    { 
        campo.innerHTML = "Guardado en favoritos"; 
        campoImg.src = "images/fav1.png"; 
        campoImg.setAttribute('onclick',"favorito(" + ccodcl + ", '" + acodar + "', 0);");
        celdaFav.setAttribute('style',"visibility: visible !important;");
    }
    else 
    { 
        campo.innerHTML = "Quitado de favoritos"; 
        campoImg.src = "images/fav0.png";
        campoImg.setAttribute('onclick',"favorito(" + ccodcl + ", '" + acodar + "', 1);");
        celdaFav.setAttribute('style',"visibility: none;");
    }
}

function processReqChangeFav() { 
    var campo = document.getElementById("celdaFavGuardado");

    if(reqFav.readyState == 4) {
        campo.innerHTML = reqFav.responseText;
    } else {
        //campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}



function actualizarCestaAjax(acodar)
{
    document.getElementById("cestaAdd" + acodar).innerHTML = "A&ntilde;adido";
    document.getElementById("cestaAdd" + acodar).style.backgroundImage = "url(../public/images/btnverarticulo1.jpg)";

    var url = "https://diginova.es/xweb/index.php?page=cestaajax";

    setTimeout(function(){
        if (window.XMLHttpRequest) {
            reqDesc = new XMLHttpRequest();
            reqDesc.onreadystatechange = processReqChangeCesta;
            reqDesc.open("GET", url, true);
            reqDesc.send(); // reqDesc.send();
            //  Internet Explorer
        } else if (window.ActiveXObject) {
            isIE = true;
            reqDesc = new ActiveXObject("Microsoft.XMLHTTP");
            if (reqDesc) {
                reqDesc.onreadystatechange = processReqChangeCesta;
                reqDesc.open("GET", url, true);
                reqDesc.send();
            }
        }
    }, 650);

    setTimeout(function()
    {
        document.getElementById("cestaAdd" + acodar).style.backgroundImage = "url(../public/images/btnverarticulo0.jpg)";
    }, 1500);
}

function actualizarCestaAjaxFicha(acodar)
{
    document.getElementById("cestaAdd" + acodar).innerHTML = "A&ntilde;adido";
    document.getElementById("cestaAdd" + acodar).style.backgroundImage = "url(../public/images/btnverarticulo1.jpg)";

    var url = "https://diginova.es/xweb/index.php?page=cestaajax";

    setTimeout(function(){
        if (window.XMLHttpRequest) {
            reqDesc = new XMLHttpRequest();
            reqDesc.onreadystatechange = processReqChangeCesta;
            reqDesc.open("GET", url, true);
            reqDesc.send(null);
            //  Internet Explorer
        } else if (window.ActiveXObject) {
            isIE = true;
            reqDesc = new ActiveXObject("Microsoft.XMLHTTP");
            if (reqDesc) {
                reqDesc.onreadystatechange = processReqChangeCesta;
                reqDesc.open("GET", url, true);
                reqDesc.send();
            }
        }
    }, 650);

    setTimeout(function()
    {
        document.getElementById("cestaAdd" + acodar).style.backgroundImage = "url(../public/images/btnverarticulo0.jpg)";
    }, 1500);
}

function processReqChangeCesta() { 
    var campo = document.getElementById("cestaAjax");

    if(reqDesc.readyState == 4) {
        campo.innerHTML = reqDesc.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> ';
    }
}






function rmaBuscarAcc(ccodcl, acodar)
{
    url = "view/rmaarticulo.php?ccodcl=" + ccodcl + "&acodar=" + acodar + "&esquipo=0";
    
    if (url=='') { return; }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeRmaAcc;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeRmaAcc;
            req.open("GET", url, true);
            req.send();
        }
    }
}

function processReqChangeRmaAcc() {
    var campo = document.getElementById("contacc");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" />';
    }
}



function rmaBuscarEq(ccodcl, nnumserie)
{
    url = "view/rmaarticulo.php?ccodcl=" + ccodcl + "&nnumserie=" + nnumserie + "&esquipo=1";
    
    if (url=='') { return; }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeRmaEq;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeRmaEq;
            req.open("GET", url, true);
            req.send();
        }
    }
}

function processReqChangeRmaEq() {
    var campo = document.getElementById("contequipo");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" />';
    }
}




function devolucionesGuardarTemp(ccodcl, acodar, nnumser, fdoc, averia, observaciones)
{
    url = "view/devolcuionesguardar.php?ccodcl=" + ccodcl + "&acodar=" + acodar +  "&nnumser=" + nnumser +  "&fdoc=" + fdoc +  "&averia=" + averia +  "&observaciones=" + observaciones;
    
    if (url=='') { return; }

    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeRmaTemp;
        req.open("GET", url, true);
        req.send(null);
        //  Internet Explorer
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeRmaTemp;
            req.open("GET", url, true);
            req.send();
        }
    }
}

function processReqChangeRmaTemp() {
    var campo = document.getElementById("devoluciones2");

    if(req.readyState == 4) {
        campo.innerHTML = req.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="img/cargando.gif" align="middle" />';
    }
}

function celdaCantBajar(acodar) {
    var valor = document.getElementById("cant" + acodar).value;

    if (valor > 1) { valor--; }

    document.getElementById("cant" + acodar).value = valor; 

    comprobarCants(acodar, valor, 1000);
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

    if (cantidad <= 1) { itemMenos.src = "/xweb/public/images/artmenosoff.png"; }
    else { itemMenos.src = "/xweb/public/images/artmenoson.png"; }

    if (cantidad >= max) { itemMas.src = "/xweb/public/images/artmasoff.png"; }
    else { itemMas.src = "/xweb/public/images/artmason.png"; }
}

function hoverImg(element) 
{ 
    element.setAttribute('src', '/xweb/public/images/rma_elim1.png'); 
}

function unHoverImg(element) 
{ 
    element.setAttribute('src', '/xweb/public/images/rma_elim0.png'); 
}

function mostrarCatGrupo(elemento)
{
    $(elemento).animate({
        height: $(elemento).get(0).scrollHeight
    }, 500, function(){
        $(this).height('auto');
    });
}

function ocultarCatGrupo(elemento)
{
    $(elemento).animate({'height': '72px'}, 500);
}

function calcularTotalArticulo()
{
    const formatter = new Intl.NumberFormat('es-PE', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    var precioTotal = 0;

    $('.table_ampliaciones .td_precios_ampl div').each(function()
    {
        var precioArticulo = $(this).text().replace("€", "");

        precioTotal = parseInt(precioTotal) + parseInt(precioArticulo);
        precioTotal = formatter.format(precioTotal);
        precioTotal = precioTotal.replace(".", ",");
    });

    var precioConIVA = parseInt(precioTotal) + (parseInt(precioTotal) * parseInt(21) / parseInt(100));
    precioConIVA = formatter.format(precioConIVA);
    precioConIVA = precioConIVA.replace(".", ",");

    $('.fPrecios').empty();
    $('.fPrecios').text(precioTotal + '€');
    $('.fPrecios').append('<span>' + precioConIVA + '€ I.V.A incluido</span>');
}

function elegirGrado(num_grados, grado, precio)
{
    $("#div_anadir_cesta_disabled").hide();
    $("input[name = 'cant_" + grado + "']").val(1);

    for (var a = 0; a < num_grados; a++)
    {
        (function(a)
        {
            if (a == grado)
            {
                $('#nom_art_' + a).show();
                $('#nom_completo_art_' + a).show();
                $('#nom_descr_' + a).show();
                $('#div_stock_' + a).show();
                $('#div_precio_' + a).show();
                $('#span_descr_' + a).show();
                $('#div_anadir_cesta_' + a).show()
                $('#div_ajustes_' + a).show();
            }
            else
            {
                $('#nom_art_' + a).hide();
                $('#nom_completo_art_' + a).hide();
                $('#nom_descr_' + a).hide();
                $('#div_stock_' + a).hide();
                $('#div_precio_' + a).hide();
                $('#span_descr_' + a).hide();
                $('#div_anadir_cesta_' + a).hide()
                $('#div_ajustes_' + a).hide();
            }

        }(a));
    }

    $('#div_precio_grados').empty();
    $('#div_precio_grados').text(precio + '€');
}

function elegirMemoriaRAM(precio, referencia, elemento)
{
    $("input[name='refMemoriasRAM']").each(function() 
    {
        $(this).prop('checked', false);
    });

    if ($('#input_ref_ram').val() == referencia) 
    {
        $(elemento).prop('checked', false);
        $('#sinAmplMemoriaRAM').prop('checked', true);

        $('#div_precio_ram').empty();
        $('#div_precio_ram').text('0€');

        $('#input_ref_ram').val('');
    }
    else
    {
        $(elemento).prop('checked', true);

        $('#div_precio_ram').empty();
        $('#div_precio_ram').text(precio + '€');

        $('#input_ref_ram').val(referencia);
    }
}

function elegirDiscoDuro(precio, referencia, elemento)
{
    $("input[name='refDiscosDuros']").each(function() 
    {
        $(this).prop('checked', false);
    });

    if ($('#input_ref_discoduro').val() == referencia) 
    {
        $(elemento).prop('checked', false);
        $('#sinAmplDiscoDuro').prop('checked', true);

        $('#div_precio_discoduro').empty();
        $('#div_precio_discoduro').text('0€');

        $('#input_ref_discoduro').val('');
    }
    else
    {
        $(elemento).prop('checked', true);

        $('#div_precio_discoduro').empty();
        $('#div_precio_discoduro').text(precio + '€');

        $('#input_ref_discoduro').val(referencia);
    }
}

function elegirIdiomaTeclado(precio, referencia, elemento)
{
    $("input[name='idioma_teclado']").each(function() 
    {
        $(this).prop('checked', false);
    });

    if ($('#input_ref_teclado').val() == referencia) 
    {
        $(elemento).prop('checked', false);
        $('#sin_teclado').prop('checked', true);

        $('#div_precio_teclado').empty();
        $('#div_precio_teclado').text('0€');

        $('#input_ref_teclado').val('');
    }
    else
    {
        $(elemento).prop('checked', true);

        $('#div_precio_teclado').empty();
        $('#div_precio_teclado').text(precio + '€');

        $('#input_ref_teclado').val(referencia);
    }
}

function cerrarVentanaBusqueda()
{
    $('#suggestionsBusq').css('display', 'none');
}

function clickPregTecnicas(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas1').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_tecnicas_' + a).hide(500);
            $('#tr_preg_tecnicas_' + a).css('background', '#f6f6f6');
            $('#tr_preg_tecnicas_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_tecnicas_' + i).css("display") == "none")
    {
        $('#tr_resp_tecnicas_' + i).show(500);
        $('#tr_preg_tecnicas_' + i).css('background', '#0c2e49');
        $('#tr_preg_tecnicas_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_tecnicas_' + i).hide(500);
        $('#tr_preg_tecnicas_' + i).css('background', '#f6f6f6');
        $('#tr_preg_tecnicas_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregEnvios(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas2').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_envios_' + a).hide(500);
            $('#tr_preg_envios_' + a).css('background', '#f6f6f6');
            $('#tr_preg_envios_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_envios_' + i).css("display") == "none")
    {
        $('#tr_resp_envios_' + i).show(500);
        $('#tr_preg_envios_' + i).css('background', '#0c2e49');
        $('#tr_preg_envios_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_envios_' + i).hide(500);
        $('#tr_preg_envios_' + i).css('background', '#f6f6f6');
        $('#tr_preg_envios_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregProductos(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas6').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_productos_' + a).hide(500);
            $('#tr_preg_productos_' + a).css('background', '#f6f6f6');
            $('#tr_preg_productos_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_productos_' + i).css("display") == "none")
    {
        $('#tr_resp_productos_' + i).show(500);
        $('#tr_preg_productos_' + i).css('background', '#0c2e49');
        $('#tr_preg_productos_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_productos_' + i).hide(500);
        $('#tr_preg_productos_' + i).css('background', '#f6f6f6');
        $('#tr_preg_productos_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregOtros(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas3').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_otros_' + a).hide(500);
            $('#tr_preg_otros_' + a).css('background', '#f6f6f6');
            $('#tr_preg_otros_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_otros_' + i).css("display") == "none")
    {
        $('#tr_resp_otros_' + i).show(500);
        $('#tr_preg_otros_' + i).css('background', '#0c2e49');
        $('#tr_preg_otros_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_otros_' + i).hide(500);
        $('#tr_preg_otros_' + i).css('background', '#f6f6f6');
        $('#tr_preg_otros_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPregAdmin(i, idPregunta)
{
    var numPreguntas = $('#num_preguntas5').val();

    for (var a = 0; a <= numPreguntas; a++)
    {
        (function(a) {

            $('#tr_resp_admin_' + a).hide(500);
            $('#tr_preg_admin_' + a).css('background', '#f6f6f6');
            $('#tr_preg_admin_' + a + ' .div_faq').css('color', '#0c2e49');
        }(a));
    }

    if ($('#tr_resp_admin_' + i).css("display") == "none")
    {
        $('#tr_resp_admin_' + i).show(500);
        $('#tr_preg_admin_' + i).css('background', '#0c2e49');
        $('#tr_preg_admin_' + i + ' .div_faq').css('color', '#f6f6f6');
    }
    else
    {
        $('#tr_resp_admin_' + i).hide(500);
        $('#tr_preg_admin_' + i).css('background', '#f6f6f6');
        $('#tr_preg_admin_' + i + ' .div_faq').css('color', '#0c2e49');
    }
}

function clickPreguntasFrecuentes()
{
    $('#div_preguntas_frecuentes').show(200);
    $('.table_tickets_abiertos').hide();
    $('.table_tickets_cerrados').hide();
    $('#btn_preg_frecuentes').addClass('active_consultas');
    $('#btn_consultas_abiertas').removeClass('active_consultas');
    $('#btn_consultas_cerradas').removeClass('active_consultas');
}

function clickBtnConsultas(activo)
{
    if (activo)
    {
        $('#div_preguntas_frecuentes').hide();
        $('.table_tickets_abiertos').show(200);
        $('.table_tickets_cerrados').hide();
        $('#btn_preg_frecuentes').removeClass('active_consultas');
        $('#btn_consultas_abiertas').addClass('active_consultas');
        $('#btn_consultas_cerradas').removeClass('active_consultas');
    }
    else
    {
        $('#div_preguntas_frecuentes').hide();
        $('.table_tickets_abiertos').hide();
        $('.table_tickets_cerrados').show(200);
        $('#btn_preg_frecuentes').removeClass('active_consultas');
        $('#btn_consultas_abiertas').removeClass('active_consultas');
        $('#btn_consultas_cerradas').addClass('active_consultas');
    }
}

function mostrarTicket(elemento)
{
    console.log('Entraa');

    var tr_comentario = $(elemento).parent().parent().find('.tr_comentarios');

    console.log('Entraa' + tr_comentario.css('display'));

    if (tr_comentario.css('display') == 'none')
    {
        tr_comentario.show(200);
    }
    else
    {
        tr_comentario.hide(200);
    }
}

function cerrarConsulta(refTicket)
{
    if (window.confirm('¿Estás seguro que quieres cerrar esta consulta?'))
    {
        var formData = new FormData();
        formData.append('refTicket', refTicket);
        formData.append('_token', $('#_token').val());

        $.ajax({
            url: '/xweb/cerrarconsulta',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                location.reload();
            }
        }); 
    }
}

function activarCentro(cliente, centro, elemento)
{
    var formData = new FormData();
    formData.append('cliente', cliente);
    formData.append('centro', centro);
    formData.append('_token', $('#_token').val());

    if ($(elemento).prop('checked')) 
    {
        formData.append('desactivar', 'N');
    }
    else
    {
        formData.append('desactivar', 'S');
    }

    $.ajax({
        url: '/xweb/activarCentro',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {

            $('.mensaje_exito_activar_centro').css('display', 'none');
            $('.mensaje_exito_desactivar_centro').css('display', 'none');

            if ($(elemento).prop('checked')) 
            {
                $('.mensaje_exito_activar_centro').css('display', 'table-row');
            }
            else
            {
                $('.mensaje_exito_desactivar_centro').css('display', 'table-row');
            }
        }
    });
}

function filtrarDireccion(elemento)
{
    var idDireccion = $(elemento).val();

    $('.div_direccion_editar').css('display', 'none');
    $('#div_direccion_editar_' + idDireccion).css('display', 'block');
}

function buscadorConsultas(){

    var input_buscador_consultas = document.getElementById("input_buscador_consultas");
    var filter = input_buscador_consultas.value.toUpperCase();

    var titulo_preguntas_tecnicas = document.getElementById("titulo_preg_tecnicas");
    var titulo_preguntas_envios = document.getElementById("titulo_preg_envios");
    var titulo_preguntas_productos = document.getElementById("titulo_preg_productos");
    var titulo_preguntas_rma = document.getElementById("titulo_preg_rma");
    var titulo_preguntas_administrativas = document.getElementById("titulo_preg_admin");

    var cont_preguntas_tecnicas = 0;
    var cont_preguntas_envios = 0;
    var cont_preguntas_productos = 0;
    var cont_preguntas_rma = 0;
    var cont_preguntas_administrativas = 0;

    var ul = document.getElementById("ul_preguntas_consultas");
    var li = ul.getElementsByTagName("li");

    var tablePregunta;

    titulo_preguntas_tecnicas.style.display = "";
    titulo_preguntas_envios.style.display = "";
    titulo_preguntas_productos.style.display = "";
    titulo_preguntas_rma.style.display = "";
    titulo_preguntas_administrativas.style.display = "";

    for (i = 0; i < li.length; i++) 
    {
        id = li[i].getElementsByTagName("p")[0];
        txtId = id.textContent || id.innerText;

        tipo_pregunta = li[i].getElementsByTagName("span")[0];
        txtTipo_pregunta = tipo_pregunta.textContent || tipo_pregunta.innerText;

        pregunta = li[i].getElementsByTagName("a")[0];
        txtPregunta = pregunta.textContent || pregunta.innerText;

        tablePregunta = document.getElementById("table_pregunta_" + txtId);

        if (txtPregunta.toUpperCase().indexOf(filter) > -1) 
        {
            li[i].style.display = "";
            tablePregunta.style.display = "";

            if (txtTipo_pregunta == 1)
            {
                cont_preguntas_tecnicas += 1;
            }
            else if (txtTipo_pregunta == 2)
            {
                cont_preguntas_envios += 1;
            }
            else if (txtTipo_pregunta == 3)
            {
                cont_preguntas_rma += 1;
            }
            else if (txtTipo_pregunta == 5)
            {
                cont_preguntas_administrativas += 1;
            }
            else if (txtTipo_pregunta == 6)
            {
                cont_preguntas_productos += 1;
            }
        } 
        else 
        {
            li[i].style.display = "none";
            tablePregunta.style.display = "none";
        }
    }

    if (cont_preguntas_tecnicas == 0)
    {
        titulo_preguntas_tecnicas.style.display = "none";
    }

    if (cont_preguntas_envios == 0)
    {
        titulo_preguntas_envios.style.display = "none";
    }

    if (cont_preguntas_productos == 0)
    {
        titulo_preguntas_productos.style.display = "none";
    }

    if (cont_preguntas_rma == 0)
    {
        titulo_preguntas_rma.style.display = "none";
    }

    if (cont_preguntas_administrativas == 0)
    {
        titulo_preguntas_administrativas.style.display = "none";
    }
}

function envioMailSolicitudMayor(ccodcl, cliente, elemento)
{
    var formData = new FormData();
    formData.append('ccodcl', ccodcl);
    formData.append('cliente', cliente);
    formData.append('_token', $('#_token').val());

    $.ajax({
        url: '/xweb/envioMailSolicitudMayor',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {

            $(elemento).css('pointer-events', 'none');
            $(elemento).css('background', 'linear-gradient(to bottom, #b8e356 5%, #a5cc52 100%)');
            $(elemento).css('margin-left', '192px');
            $(elemento).text('✓ Solicitud enviada');
        }
    });
}

function solicitarCambioFiscal()
{
    var txtCambioFiscal = $('#tt_cambio_fiscal').val();
    var btnCambioFiscal = $('#btn_cambio_fiscal')[0].files[0];

    if ($('#btn_cambio_fiscal').get(0).files.length === 0)
    {
        $('#mensaje_error_solicitud').css('display', 'block');
    }
    else if (txtCambioFiscal == '')
    {
        $('#mensaje_error_solicitud').css('display', 'block');
    }
    else
    {
        var formData = new FormData();
        formData.append('txtCambioFiscal', txtCambioFiscal);
        formData.append('btnCambioFiscal', btnCambioFiscal);
        formData.append('_token', $('#_token2').val());

        $.ajax({
            url: '/xweb/envioMailCambioUsuario',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                $('#mensaje_exito_solicitud').css('display', 'block');
            }
        });
    }
}

function mostrarArticulos(limiteArt)
{
    for (var i = 0; i <= limiteArt; i++) 
    {
        (function(i) 
        {
            $('#table_list_articulo_' + i).css('display', 'table');

            var acodar = $('#input_seleccion_articulo_' + i).val();
            var img = $("<img src='https://diginova.es/xweb/fotobanners/art_" + acodar + "_1 copia.png' />");

            img.on('error', function(e) {
                //$('#table_list_articulo_' + i).css('display', 'none');
                $('#img_seleccion_' + i).attr('src', 'https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg');
            });
        }(i));
    }

    $('#num_art_mostrados').val(limiteArt);
}

function pulsarArticuloParaAnuncio(nombreArticulo, precio, imagen)
{
    var posLimite = nombreArticulo.indexOf('(');

    if (posLimite < 0)
    {
        posLimite = nombreArticulo.length;
    }

    var nombreArtAbreviado = nombreArticulo.substr(0, posLimite - 2);
    var nombreygrafica = nombreArtAbreviado.split(' + ');

    $('#input_nombre_anuncio').val(nombreygrafica[0]);
    var texto = $("#input_nombre_anuncio").val().split("\\u00e1").join("á");
    texto = texto.split("\\u00e9").join("é"); 
    texto = texto.split("\\u00ed").join("í"); 
    texto = texto.split("\\u00f3").join("ó"); 
    texto = texto.split("\\u00fa").join("ú");
    texto = texto.split("\\").join("");
    texto = texto.split("/").join(""); 
    $('#input_nombre_anuncio').val(texto);

    var precio1 = parseInt(precio).toFixed();
    var precio2 = parseInt(precio * 0.95).toFixed();
    var precio3 = parseInt(precio * 0.85).toFixed();

    cambiarImgAnuncio(imagen);
    cambiarNombreArtAnuncio(texto);
    cambiarGraficaAnuncio(nombreArtAbreviado, true);
    cambiarPrecioAnuncio(1, precio1, true);
    cambiarPrecioAnuncio(2, precio2, true);
    cambiarPrecioAnuncio(3, precio3, true);

    $('#input_nombre_lote_articulo_1').val(nombreArticulo);
    $('#input_nombre_abrev_lote_articulo_1').val(obtNombreAbreviadoArt(nombreArticulo));
    calcularPrecioLote();

    if ($('.precio2_control').css('display') != 'none')
    {
        $('#input_text_precio_anuncio').val('Precio para 1 ud');
        $('#input_text_precio2_anuncio').val('Precio para 3 uds');
        $('#input_text_precio3_anuncio').val('Precio para 5 uds');
    }

    setTimeout(function()
    {
        mostrarCaracteristicasArtAnuncio(nombreArticulo);
        cambiarCaractPrincipalAnuncio('#input_text_pantalla');
    }, 1500);

    if (checkBrowser() == 'Firefox')
    {
        cambiosEnFirefox(2000);
    }
}

function obtNombreAbreviadoArt(nombreArticulo)
{
    var palabras = nombreArticulo.split(' ');

    var tipoArt = palabras[0];
    var marcaArt = palabras[1];

    return tipoArt + ' ' + marcaArt;
}

function obtNombreArtParaAnuncio(nombreArticulo, limiteCaracteres)
{
    var posLimite = nombreArticulo.indexOf('(');

    if (posLimite < 0)
    {
        posLimite = nombreArticulo.length;
    }

    var nombreArtAbreviado = nombreArticulo.substr(0, posLimite - 2);
    var nombreygrafica = nombreArtAbreviado.split(' + ');

    console.log("nombreArtAbreviado: " + nombreArtAbreviado);
    console.log("nombreygrafica: " + nombreygrafica);

    if (posLimite > limiteCaracteres)
    {
        nombreygrafica = nombreygrafica + "";
        nombreygrafica = obtSplitNombreArtAnuncio(nombreygrafica, limiteCaracteres)
    }

    $('#input_nombre_anuncio').val(nombreygrafica[0]);
    var texto = $("#input_nombre_anuncio").val().split("\\u00e1").join("á");
    texto = texto.split("\\u00e9").join("é"); 
    texto = texto.split("\\u00ed").join("í"); 
    texto = texto.split("\\u00f3").join("ó"); 
    texto = texto.split("\\u00fa").join("ú");
    texto = texto.split("\\").join("");
    texto = texto.split("/").join(""); 
    $('#input_nombre_anuncio').val(texto);
}

function obtSplitNombreArtAnuncio(nombreArtAbreviado, limiteCaracteres)
{
    var palabras = nombreArtAbreviado.split(" ");
    var resultado = "";
    var contador = 0;

    for (var i = 0; i < palabras.length; i++) 
    {
        if ((contador + palabras[i].length) <= limiteCaracteres)
        {
            resultado += palabras[i] + " ";
            contador += palabras[i].length + 1;
        }
        else
        {
            break;
        }
    }

    resultado = resultado.trim();

    return resultado;
}

function mostrarCaracteristicasArtAnuncio(nombreArticulo)
{
    $("#img_caract_discoduro").css('display', 'none');
    $("#img_caract_ram").css('display', 'none');
    $("#img_caract_dvd").css('display', 'none');
    $("#img_caract_so").css('display', 'none');

    var esOrdenador = false;
    var esPortatil = false;
    var descrArticulo = '';

    if (nombreArticulo.indexOf('(') > -1)
    {
        if (nombreArticulo.indexOf(')') > -1)
        {
            esOrdenador = true;
        }
    }

    if (esOrdenador)
    {
        var arrCaractArticulo = nombreArticulo.split("(");
        var arrCaractArticulo2 = arrCaractArticulo[1].split(")");
        var arrCaractArticulo3 = arrCaractArticulo2[0].split("/");
    }
    else
    {
        var arrCaractArticulo3 = nombreArticulo.split(" - ");
    }

    if (arrCaractArticulo[0].indexOf('Portátil') !== -1) 
    {
        esPortatil = true;
    }

    $('#table_caract_generador_anuncios tr').remove();

    var yaTieneRAM = false;

    var pulgadas = '';

    for (var i = 0; i < arrCaractArticulo3.length; i++) 
    {
        var nombreCaract = '';
        var arrCaractArticulo4 = arrCaractArticulo3[i].toUpperCase();

        if (i == 0 && !esOrdenador)
        {
            arrCaractArticulo3[i] = arrCaractArticulo3[i].substr(1);
        }

        if (i == 0 && esOrdenador)
        {
            if ($('#input_text_procesador').val() == null)
            {
                nombreCaract = 'Procesador';
            }
            else
            {
                nombreCaract = $('#input_text_procesador').val();
            }

            arrCaractArticulo3[i] = arrCaractArticulo3[i].replace("\\", "");

            $('#table_caract_generador_anuncios').append(
                '<tr>' + 
                    '<td style="width: 21%">' + 
                        '<div class="div_caract_generador_anuncios">' + 
                            '<input type="checkbox" id="check_caract_procesador" name="check_caract" checked ' + 
                            'onchange="mostrarCaractProcesadorAnuncio(this, ' + '\'#div_carac_text_articulo_seleccionado\'' + ')" style="height: 50px; width: 16px; margin-left: 4px;">' + 
                            '<div style="float: left;padding: 18px 8px 0px 9px;">' + nombreCaract + '</div>' + 
                        '</div>' + 
                    '</td>' + 
                    '<td style="width: 29%">' + 
                        '<input type="text" id="input_text_procesador" name="input_text_procesador" oninput="cambiarCaractPrincipalAnuncio(this)" style="width: 225px; margin-right: 8px;" value="' + nombreCaract + '">' + 
                    '</td>' + 
                    '<td colspan="2" style="width: 50%">' + 
                        '<input type="text" id="input_caract_procesador" name="input_caract_procesador" oninput="cambiarCaractPrincipalAnuncio(this)" style="width: 350px;" value="' + arrCaractArticulo3[i] + '">' + 
                    '</td>' + 
                '</tr>');
        }
        else if (arrCaractArticulo3[i].indexOf('"') > -1)
        {
            if (arrCaractArticulo3[i].indexOf('Disco Duro') == -1)
            {
                var valorPantalla = arrCaractArticulo3[i].split(" ");
                var vPantalla = "";

                for (var a = 0; a < valorPantalla.length; a++) 
                {
                    if (valorPantalla[a].indexOf('"') > -1)
                    {
                        vPantalla = valorPantalla[a];
                    }
                }

                if ($('#input_text_pantalla').val() == null)
                {
                    nombreCaract = 'Pantalla';
                }
                else
                {
                    nombreCaract = $('#input_text_pantalla').val();
                }

                vPantalla = vPantalla.replace("\\", "");
                vPantalla = vPantalla.replace('"', '');
                vPantalla += "''";

                $('#table_caract_generador_anuncios').append(
                    '<tr>' + 
                        '<td style="width: 21%">' + 
                            '<div class="div_caract_generador_anuncios">' + 
                                '<input type="checkbox" id="check_caract_pantalla" name="check_caract" checked style="height: 50px; width: 16px; margin-left: 4px;">' + 
                                '<div style="float: left;padding: 18px 8px 0px 9px;">' + nombreCaract + '</div>' + 
                            '</div>' + 
                        '</td>' + 
                        '<td colspan="1" style="width: 29%">' + 
                            '<input type="text" style="width: 225px; margin-right: 8px;" id="input_text_pantalla' + '" name="input_text_pantalla' + '" oninput="cambiarCaractPrincipalAnuncio(this)" value="' + nombreCaract + '">' +
                        '</td>' + 
                        '<td colspan="2" style="width: 50%">' +  
                            '<input type="text" id="input_caract_pantalla' + '" name="input_caract_pantalla' + '" style="width: 350px;" oninput="cambiarCaractPrincipalAnuncio(this)" value="' + vPantalla + '">' + 
                        '</td>' + 
                    '</tr>' + 
                    '<tr>' + 
                        '<td style="width: 21%">' + 
                            '<div class="div_caract_generador_anuncios">' + 
                                '<input type="checkbox" id="check_caract_pulgadas" name="check_caract" onclick="mostrarCaractProcesadorAnuncio(this, ' + '\'#div_carac3_text_articulo_seleccionado\'' + ')" ' + 
                                'checked style="height: 50px; width: 16px; margin-left: 4px;">' + 
                                '<div style="float: left;padding: 18px 8px 0px 9px;">Pulgadas</div>' + 
                            '</div>' + 
                        '</td>' +
                        '<td colspan="1" style="width: 29%"></td>' + 
                        '<td colspan="2" style="width: 50%"></td>' + 
                    '</tr>');
            }
        }
        else if (((arrCaractArticulo4.indexOf('1GB') > -1) || (arrCaractArticulo4.indexOf('2GB') > -1) || (arrCaractArticulo4.indexOf('4GB') > -1) || (arrCaractArticulo4.indexOf('8GB') > -1) || (arrCaractArticulo4.indexOf('12GB') > -1) || (arrCaractArticulo4.indexOf('16GB') > -1) || (arrCaractArticulo4.indexOf('32GB') > -1)) && (!yaTieneRAM))
        {
            $("#img_caract_ram").css('display', 'block');

            yaTieneRAM = true;

            nombreCaract = 'Memoria RAM';

            arrCaractArticulo3[i] = arrCaractArticulo3[i].replace("\\", "");

            var valCaract = arrCaractArticulo4.replace("GB", "");
            valCaract = valCaract.replace("-EMMC", "");
            var ddr = 0;

            if (descrArticulo.indexOf('DDR1') > -1)
            {
                nombreImagen2 = 'ram-' + valCaract + '-ddr1.png';
                ddr = 1;
            }
            else if (descrArticulo.indexOf('DDR2') > -1)
            {
                nombreImagen2 = 'ram-' + valCaract + '-ddr2.png';
                ddr = 2;
            }
            else if (descrArticulo.indexOf('DDR3') > -1)
            {
                nombreImagen2 = 'ram-' + valCaract + '-ddr3.png';
                ddr = 3;
            }
            else if (descrArticulo.indexOf('DDR4') > -1)
            {
                nombreImagen2 = 'ram-' + valCaract + '-ddr4.png';
                ddr = 4;
            }
            else if (descrArticulo.indexOf('DDR5') > -1)
            {
                nombreImagen2 = 'ram-' + valCaract + '-ddr5.png';
                ddr = 5;
            }

            $('#table_caract_generador_anuncios').append(
                '<tr>' + 
                    '<td style="width: 100%">' + 
                        '<div class="div_caract_generador_anuncios">' + 
                            '<input type="checkbox" id="check_caract_ram" name="check_caract" checked onchange="mostrarCaractAnuncio(' + '\'ram\'' + ', ' + 2 + ')" style="height: 50px; width: 16px; margin-left: 4px;">' + 
                            '<div style="float: left;padding: 18px 8px 0px 9px;">' + nombreCaract + '</div>' + 
                        '</div>' + 
                    '</td>' + 
                    '<td style="width: 100%">' + 
                        '<div style="width: 45%; float: left; font-size: 10pt; font-weight: 100; margin-left: 10px;">Capacidad: </div>' + 
                        '<select id="radio_caract_gb_ram" name="radio_caract_gb_ram" class="select_caract_anuncio" onchange="cambiarMemoriaRAMAnuncio()" style="width: 45%; margin-bottom: -2px;">' + 
                            '<option value="1">1GB</option>' + 
                            '<option value="2">2GB</option>' + 
                            '<option value="4">4GB</option>' + 
                            '<option value="8">8GB</option>' + 
                            '<option value="12">12GB</option>' + 
                            '<option value="16">16GB</option>' + 
                            '<option value="32">32GB</option>' + 
                        '</select>' + 
                    '</td>' + 
                    '<td colspan="3">' + 
                        '<div style="width: 18%; float: left; font-size: 10pt; font-weight: 100;">DDR: </div>' + 
                        '<select id="radio_caract_ddr_ram" name="radio_caract_ddr_ram" class="select_caract_anuncio" onchange="cambiarMemoriaRAMAnuncio()" style="width: 22%; float: left; margin-bottom: -2px;">' + 
                            '<option value="1">1</option>' + 
                            '<option value="2">2</option>' + 
                            '<option value="3">3</option>' + 
                            '<option value="4" selected>4</option>' + 
                            '<option value="5">5</option>' + 
                        '</select>' + 
                    '</td>' +
                '</tr>');

            $('#radio_caract_gb_ram option[value=' + valCaract + ']').attr('selected','selected');
            $('#radio_caract_ddr_ram option[value=' + ddr + ']').attr('selected','selected');                                            
        }
        else if ((arrCaractArticulo4.indexOf('1TB') > -1) || (arrCaractArticulo4.indexOf('120GB') > -1) || (arrCaractArticulo4.indexOf('128GB') > -1) || (arrCaractArticulo4.indexOf('160GB') > -1) || (arrCaractArticulo4.indexOf('180GB') > -1) || (arrCaractArticulo4.indexOf('240GB') > -1) || (arrCaractArticulo4.indexOf('250GB') > -1) || (arrCaractArticulo4.indexOf('256GB') > -1) || (arrCaractArticulo4.indexOf('320GB') > -1) || (arrCaractArticulo4.indexOf('480GB') > -1) || (arrCaractArticulo4.indexOf('500GB') > -1) || (arrCaractArticulo4.indexOf('512GB') > -1) || (arrCaractArticulo4.indexOf('120') > -1) || (arrCaractArticulo4.indexOf('128') > -1) || (arrCaractArticulo4.indexOf('160') > -1) || (arrCaractArticulo4.indexOf('180') > -1) || (arrCaractArticulo4.indexOf('240') > -1) || (arrCaractArticulo4.indexOf('250') > -1) || (arrCaractArticulo4.indexOf('256') > -1) || (arrCaractArticulo4.indexOf('320') > -1) || (arrCaractArticulo4.indexOf('480') > -1) || (arrCaractArticulo4.indexOf('500') > -1) || (arrCaractArticulo4.indexOf('512') > -1) || (arrCaractArticulo4.indexOf('32GB') > -1))
        {
            nombreCaract = 'Disco duro';

            $("#img_caract_discoduro").css('display', 'block');

            arrCaractArticulo3[i] = arrCaractArticulo3[i].replace("\\", "");

            var tipoDiscoDuro = '';
            var valCaract = arrCaractArticulo4.replace("GB", "");
            valCaract = valCaract.replace("TB", "");
            valCaract = valCaract.replace("-SSD", "");
            valCaract = valCaract.replace(" SSD", "");
            valCaract = valCaract.replace("SSD", "");
            valCaract = valCaract.replace("-HDD", "");
            valCaract = valCaract.replace(" HDD", "");
            valCaract = valCaract.replace("HDD", "");
            valCaract = valCaract.replace("-eMMC", "");
            valCaract = valCaract.replace("-EMMC", "");
            valCaract = valCaract.replace(" eMMC", "");
            valCaract = valCaract.replace(" EMMC", "");
            valCaract = valCaract.replace("eMMC", "");
            valCaract = valCaract.replace("EMMC", "");
            valCaract = valCaract.replace("-NVMe", "");
            valCaract = valCaract.replace("-NVME", "");
            valCaract = valCaract.replace(" NVMe", "");
            valCaract = valCaract.replace(" NVME", "");
            valCaract = valCaract.replace("NVMe", "");
            valCaract = valCaract.replace("NVME", "");
            valCaract = valCaract.replace("-M.2", "");
            valCaract = valCaract.replace("M.2", "");

            if (nombreArticulo.indexOf('SSD') > -1)
            {
                tipoDiscoDuro = 'ssd';
                nombreImagen = 'discoduro-' + valCaract + '-ssd.png';
            }
            else if (nombreArticulo.indexOf('HDD') > -1)
            {
                tipoDiscoDuro = 'hdd';
                nombreImagen = 'discoduro-' + valCaract + '-hdd.png';
            }
            else if (nombreArticulo.indexOf('eMMC') > -1)
            {
                tipoDiscoDuro = 'emmc';
                nombreImagen = 'discoduro-' + valCaract + '-emmc.png';
            }
            else if (nombreArticulo.indexOf('NVMe') > -1)
            {
                tipoDiscoDuro = 'nvme';
                nombreImagen = 'discoduro-' + valCaract + '-nvme.png';
            }
            else if (nombreArticulo.indexOf('M.2') > -1)
            {
                tipoDiscoDuro = 'm2';
                nombreImagen = 'discoduro-' + valCaract + '-m2.png';
            }
            else
            {
                tipoDiscoDuro = 'hdd';
                nombreImagen = 'discoduro-' + valCaract + '-hdd.png';
            }

            $('#table_caract_generador_anuncios').append(
                '<tr>' + 
                    '<td style="width: 100%">' + 
                        '<div class="div_caract_generador_anuncios">' + 
                            '<input type="checkbox" id="check_caract_discoduro" name="check_caract" checked onchange="mostrarCaractAnuncio(' + '\'discoduro\'' + ', ' + '\'\'' + ')" style="height: 50px; width: 16px; margin-left: 4px;">' + 
                            '<div style="float: left;padding: 18px 8px 0px 9px;">' + nombreCaract + '</div>' + 
                        '</div>' + 
                    '</td>' + 
                    '<td style="width: 100%">' + 
                        '<div style="width: 45%; float: left; font-size: 10pt; font-weight: 100; margin-left: 10px;">Capacidad: </div>' + 
                        '<select id="radio_caract_gb_dd" name="radio_caract_gb_dd" class="select_caract_anuncio" onchange="cambiarDiscoDuroAnuncio()" style="width: 45%; margin-bottom: -2px;">' + 
                            '<option value="32">32GB</option>' + 
                            '<option value="120">120GB</option>' + 
                            '<option value="128">128GB</option>' + 
                            '<option value="160">160GB</option>' + 
                            '<option value="240">240GB</option>' + 
                            '<option value="250">250GB</option>' + 
                            '<option value="256">256GB</option>' + 
                            '<option value="320">320GB</option>' + 
                            '<option value="480">480GB</option>' + 
                            '<option value="500">500GB</option>' + 
                            '<option value="512">512GB</option>' + 
                            '<option value="1">1TB</option>' + 
                        '</select>' + 
                    '</td>' + 
                    '<td colspan="3">' + 
                        '<div style="width: 18%; float: left; font-size: 10pt; font-weight: 100;">Tipo: </div>' + 
                        '<select id="radio_caract_tipo_dd" name="radio_caract_tipo_dd" class="select_caract_anuncio" onchange="cambiarDiscoDuroAnuncio()" style="width: 22%; float: left; margin-bottom: -2px;">' + 
                            '<option value="ssd">SSD</option>' + 
                            '<option value="hdd">HDD</option>' + 
                            '<option value="emmc">eMMC</option>' +
                            '<option value="nvme">NVMe</option>' +
                            '<option value="m2">M.2</option>' +
                        '</select>' + 
                    '</td>' +
                '</tr>');

            $('#radio_caract_gb_dd option[value=' + valCaract + ']').attr('selected','selected');
            $('#radio_caract_tipo_dd option[value=' + tipoDiscoDuro + ']').attr('selected','selected');
        }
        else if ((arrCaractArticulo4.indexOf('DVD') > -1) && (arrCaractArticulo4.indexOf('NO-DVD') == -1) && (arrCaractArticulo4.indexOf('NODVD') == -1))
        {
            nombreCaract = 'DVD';

            $("#img_caract_dvd").css('display', 'block');

            arrCaractArticulo3[i] = arrCaractArticulo3[i].replace("\\", "");

            var valCaract = arrCaractArticulo4.replace("-", "");

            if (valCaract.indexOf('DVDRW') > -1)
            {
                nombreImagen4 = 'dvd-rw.png';
                versionDVD = 'dvd-rw';
            }
            else if (valCaract.indexOf('DVDR') > -1)
            {
                nombreImagen4 = 'dvd-rw.png';
                versionDVD = 'dvd-r';
            }
            else if (valCaract.indexOf('DVD') > -1)
            {
                nombreImagen4 = 'dvd.png';
                versionDVD = 'dvd';
            }

            $('#table_caract_generador_anuncios').append(
                '<tr>' + 
                    '<td style="width: 100%">' + 
                        '<div class="div_caract_generador_anuncios">' + 
                            '<input type="checkbox" id="check_caract_dvd" name="check_caract" checked onchange="mostrarCaractAnuncio(' + '\'dvd\'' + ', ' + 4 + ')" style="height: 50px; width: 16px; margin-left: 4px;">' + 
                            '<div style="float: left;padding: 18px 2px 0px 9px;">' + nombreCaract + '</div>' + 
                        '</div>' + 
                    '</td>' + 
                    '<td style="width: 100%">' + 
                        '<div style="width: 28%; float: left; font-size: 10pt; font-weight: 100;"></div>' + 
                        '<select id="radio_caract_version_dvd" name="radio_caract_version_dvd" class="select_caract_anuncio" onchange="cambiarDVDAnuncio()" ' + 
                        'style="width: 65%; margin-bottom: -2px;float: right; margin-right: 10px;">' + 
                            '<option value="dvd-rw">DVD-RW</option>' + 
                            '<option value="dvd-r">DVD-R</option>' + 
                            '<option value="dvd">DVD</option>' +
                        '</select>' + 
                    '</td>' + 
                    '<td colspan="3">' + 
                    '</td>' +
                '</tr>');

            $('#radio_caract_version_dvd option[value=' + versionDVD + ']').attr('selected','selected');

            $("#radio_caract_version_dvd").change(function()
            {
                var enlace = '/xweb/public/fotobanners/iconos/' + $('#radio_caract_version_dvd').val() + '.png';
                $("#img_caract_dvd").attr("src", enlace);
            });
        }
        else if ((arrCaractArticulo4.indexOf('W7') > -1) || (arrCaractArticulo4.indexOf('W8') > -1) || (arrCaractArticulo4.indexOf('W9') > -1) || (arrCaractArticulo4.indexOf('W10') > -1) || (arrCaractArticulo4.indexOf('CHROME') > -1))
        {
            nombreCaract = 'Sistema Operativo';

            $("#img_caract_so").css('display', 'block');

            arrCaractArticulo3[i] = arrCaractArticulo3[i].replace("\\", "");

            var valCaract = arrCaractArticulo4.replace("GB", "");
            var versionSO = 0;
            var tipoSO = '';

            if (valCaract.indexOf('W7') > -1)
            {
                nombreImagen3 = 'windows-7-';
                versionSO = 7;
            }
            else if (valCaract.indexOf('W8') > -1)
            {
                nombreImagen3 = 'windows-8-';
                versionSO = 8;
            }
            else if (valCaract.indexOf('W9') > -1)
            {
                nombreImagen3 = 'windows-9-';
                versionSO = 9;
            }
            else if (valCaract.indexOf('W10') > -1)
            {
                nombreImagen3 = 'windows-10-';
                versionSO = 10;
            }
            else if (valCaract.indexOf('CHROME') > -1)
            {
                nombreImagen3 = 'chrome-os';
                versionSO = 10;
            }

            if ((valCaract.indexOf('W7P') > -1) || (valCaract.indexOf('W8P') > -1) || (valCaract.indexOf('W9P') > -1) || (valCaract.indexOf('W10P') > -1))
            {
                nombreImagen3 += 'pro.png';
                tipoSO = 'pro';
            }
            else if ((valCaract.indexOf('W7HP') > -1) || (valCaract.indexOf('W8HP') > -1) || (valCaract.indexOf('W9HP') > -1) || (valCaract.indexOf('W10HP') > -1))
            {
                nombreImagen3 += 'hp.png';
                tipoSO = 'hp';
            }
            else
            {
                nombreImagen3 += '.png';
                tipoSO = '';
            }

            $('#table_caract_generador_anuncios').append(
                '<tr>' + 
                    '<td style="width: 100%">' + 
                        '<div class="div_caract_generador_anuncios">' + 
                            '<input type="checkbox" id="check_caract_so" name="check_caract" checked onchange="mostrarCaractAnuncio(' + '\'so\'' + ', ' + 3 + ')" style="height: 50px; width: 16px; margin-left: 4px;">' + 
                            '<div style="float: left;padding: 18px 2px 0px 9px;">' + nombreCaract + '</div>' + 
                        '</div>' + 
                    '</td>' + 
                    '<td style="width: 100%">' + 
                        '<div style="width: 28%; float: left; font-size: 10pt; font-weight: 100; margin-top: 8px;"></div>' + 
                        '<select id="radio_caract_version_so" name="radio_caract_version_so" class="select_caract_anuncio" onchange="cambiarSistemaOperativoAnuncio()" style="width: 65%; margin-bottom: -2px;">' + 
                            '<option value="7">Windows 7</option>' + 
                            '<option value="8">Windows 8</option>' + 
                            '<option value="9">Windows 9</option>' + 
                            '<option value="10">Windows 10</option>' + 
                            '<option value="Chrome">Chrome OS</option>' + 
                        '</select>' + 
                    '</td>' + 
                    '<td colspan="3">' + 
                        '<div style="width: 18%; float: left; font-size: 10pt; font-weight: 100;">Versión: </div>' + 
                        '<select id="radio_caract_tipo_so" name="radio_caract_tipo_so" class="select_caract_anuncio" onchange="cambiarSistemaOperativoAnuncio()" style="width: 22%; float: left; margin-bottom: -2px;">' + 
                            '<option value=""></option>' + 
                            '<option value="hp">HP</option>' + 
                            '<option value="pro">PRO</option>' + 
                        '</select>' + 
                    '</td>' +
                '</tr>');

            $('#radio_caract_version_so option[value=' + versionSO + ']').attr('selected','selected');                   
        }

        if (i == 3 && esPortatil)
        {
            nombreCaract = 'Pantalla';
            var esTactil = '';

            if (arrCaractArticulo[0].indexOf('Táctil'))
            {
                esTactil = 'Táctil';
            }

            $('#table_caract_generador_anuncios').append(
                '<tr>' + 
                    '<td style="width: 21%">' + 
                        '<div class="div_caract_generador_anuncios">' + 
                            '<input type="checkbox" id="check_caract_pantalla" name="check_caract" checked ' + 
                            'onchange="mostrarTextoPantalla(' + '\'check_caract_pantalla\'' + ', ' + '\'div_texto_pantalla\'' + ')" style="height: 50px; width: 16px; margin-left: 4px;">' + 
                            '<div style="float: left;padding: 18px 8px 0px 9px;">' + nombreCaract + '</div>' + 
                        '</div>' + 
                    '</td>' + 
                    '<td style="width: 29%">' + 
                        '<input type="text" id="input_text_pantalla" name="input_text_pantalla" oninput="escribirTextPantalla(' + '\'check_caract_pantalla\'' + ', ' + '\'input_text_pantalla\'' + ', ' + '\'span_texto_pantalla\'' + ', ' + '\'div_texto_pantalla\'' + ')" style="width: 225px; margin-right: 8px;" value="' + arrCaractArticulo3[i] + '">' + 
                    '</td>' + 
                    '<td colspan="2" style="width: 50%">' + 
                        '<input type="text" id="input_caract_pantalla" name="input_caract_pantalla" oninput="escribirTextPantalla(' + '\'check_caract_pantalla\'' + ', ' + '\'input_caract_pantalla\'' + ', ' + '\'span_texto_tactil\'' + ', ' + '\'div_texto_tactil\'' + ')" style="width: 350px;" value="' + esTactil + '">' + 
                    '</td>' + 
                '</tr>');
        }
    }
}

function mostrarCaractProcesadorAnuncio(elemento, elemento2)
{
    if ($(elemento).is(":checked"))
    {
        $(elemento2).css('display', 'flex');
    }
    else
    {
        $(elemento2).css('display', 'none');
    }
}

function mostrarCaractAnuncio(caract, tipo)
{
    if ($('#check_caract_' + caract).is(":checked"))
    {
        if (tipo == 1)
        {
            $('#div_carac2_icon_articulo_seleccionado').append('<img src="/xweb/public/fotobanners/iconos/' + nombreImagen + '" id="img_caract_' + caract + '" />');
        }
        else if (tipo == 2)
        {
            $('#div_carac2_icon_articulo_seleccionado').append('<img src="/xweb/public/fotobanners/iconos/' + nombreImagen2 + '" id="img_caract_' + caract + '" />');
        }
        else if (tipo == 3)
        {
            $('#div_carac2_icon_articulo_seleccionado').append('<img src="/xweb/public/fotobanners/iconos/' + nombreImagen2 + '" id="img_caract_' + caract + '" />');
        }
        else if (tipo == 4)
        {
            $('#div_carac2_icon_articulo_seleccionado').append('<img src="/xweb/public/fotobanners/iconos/' + nombreImagen2 + '" id="img_caract_' + caract + '" />');
        }  
    }
    else
    {
        $('#img_caract_' + caract).remove();
    }
}

function cambiarCaractPrincipalAnuncio(elemento)
{
    mostrarTextoPantalla();

    var caract = $(elemento).val();

    setTimeout(function()
    {
        if (caract == $(elemento).val())
        {
            $('#div_carac_text_articulo_seleccionado div').remove();

            var colorB = $('#input_colorb_fuente_anuncio').val();
            var colorC = $('#input_colorc_fuente_anuncio').val();

            var txtCaract = "<div>";

            if ($('#check_caract_procesador').is(":checked"))
            {
                var txtProcesador = $('#input_text_procesador').val();
                var txtCaractProcesador = $('#input_caract_procesador').val();
                txtCaract += '<div class="nombre_caract" style="margin-right: 5px; color: ' + colorB + '; white-space: nowrap;">' + txtProcesador + ' </div><div class="valor_caract" style="color: ' + colorC + '; margin-right: 15px; white-space: nowrap;">' + txtCaractProcesador + '</div>';

                $("#input_text_procesador").prop('disabled', false);
                $("#input_caract_procesador").prop('disabled', false);
            }
            else
            {
                $("#input_text_procesador").prop('disabled', true);
                $("#input_caract_procesador").prop('disabled', true);
            }

            txtCaract += "</div>";

            $('#div_carac_text_articulo_seleccionado').append(txtCaract);
        }
    }, 2000);
}



function cambiarFondoAnuncio(elemento)
{
    if (elemento.files && elemento.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function(e) 
        {
              $('#img_fondo_articulo_seleccionado').attr('src', e.target.result);
        }

        reader.readAsDataURL(elemento.files[0]);
    }
}

function cambiarColorA()
{
    var colorA = $('#input_colora_fuente_anuncio').val();

    $('#titulo_articulo_seleccionado div').css('color', colorA);

    if (checkBrowser() == 'Firefox')
    {
        cambiosEnFirefox(2000);
    }
}

function cambiarColorB()
{
    var colorB = $('#input_colorb_fuente_anuncio').val();

    $('.nombre_caract').css('color', colorB);
    $('.div_texto_dato_usuario_seleccionado').css('color', colorB);
    $('.div_dato_usuario_seleccionado').css('color', colorB);
    $('.span_texto_pantalla').css('color', colorB);
}

function cambiarColorC()
{
    var colorC = $('#input_colorc_fuente_anuncio').val();

    $('.valor_caract').css('color', colorC);
}

function cambiarColorD()
{
    var colorD = $('#input_colord_fuente_anuncio').val();

    $('#tachado_articulo_seleccionado').css('color', colorD);
    $('#precio_articulo_seleccionado').css('color', colorD);
    $('#euro_articulo_seleccionado').css('color', colorD);

    $('#tachado2_articulo_seleccionado').css('color', colorD);
    $('#precio2_articulo_seleccionado').css('color', colorD);
    $('#euro2_articulo_seleccionado').css('color', colorD);

    $('#tachado3_articulo_seleccionado').css('color', colorD);
    $('#precio3_articulo_seleccionado').css('color', colorD);
    $('#euro3_articulo_seleccionado').css('color', colorD);

    if (checkBrowser() == 'Firefox')
    {
        cambiosEnFirefox(2000);
    }
}

function topElement(elemento, sumar) 
{
    var top = parseInt($(elemento).css('top'));

    if (sumar)
    {
        top = parseInt(top) + 1;
    }
    else
    {
        top = parseInt(top) - 1;
    }

    $(elemento).css('top', top + 'px');
}

function leftElement(elemento, sumar) 
{
    var left = parseInt($(elemento).css('left'));

    if (sumar)
    {
        var left = parseInt(left) + 1;
    }
    else
    {
        var left = parseInt(left) - 1;
    }

    $(elemento).css('left', left + 'px');
}

function cambiarColorE()
{
    var colorE = $('#input_colore_fuente_anuncio').val();

    const r = parseInt(colorE.substr(1,2), 16);
    const g = parseInt(colorE.substr(3,2), 16);
    const b = parseInt(colorE.substr(5,2), 16);

    var h = rgbToHsl(r, g, b);
    var s = rgbToHsl2(r, g, b);
    var l = rgbToHsl3(r, g, b);

    var colorF = $('#input_colore_fuente_anuncio').val();

    const r2 = parseInt(colorF.substr(1,2), 16);
    const g2 = parseInt(colorF.substr(3,2), 16);
    const b2 = parseInt(colorF.substr(5,2), 16);

    var h2 = rgbToHsl(r2, g2, b2);
    var s2 = rgbToHsl2(r2, g2, b2);
    var l2 = rgbToHsl3(r2, g2, b2);

    if ($('#input_flecha_est1').is(':checked'))
    {
        $('#div_panel_articulo_seleccionado').css({background: 'linear-gradient(to bottom, hsl(' + h + ' ' + s + '% 56%) 0%, hsl(' + h + ' ' + s + '% 53%) 50%, hsl(' + h + ' ' + s + '% 47%) 50%, hsl(' + h + ' ' + s + '% 50%))'});
        $('#div_panel_articulo_seleccionado').css({border: '2px hsl(' + h + ' ' + s + '% 75%) solid'});
        $('#div_img_flecha_panel').css('border', '1px hsl(' + h + ', ' + s + '%, 25%, 0.5) solid');
        $('#img_flecha_panel').css('background', 'hsl(' + h + ' ' + s + '% 25%)');
    }
    else
    {
        $('#div_panel_articulo_seleccionado').css({background: 'linear-gradient(to bottom, ' + colorE + ' 0%, ' + colorF + ' 100%)'});
    }
}

function cambiarImgAnuncio(imagen)
{
    $('#img_foto_articulo_seleccionado').attr('src', imagen);
}

function cambiarNombreArtAnuncio(nombreArt)
{
    setTimeout(function()
    {
        if (nombreArt == $('#input_nombre_anuncio').val())
        {
            var numDiv = 0;

            $('#nombre_articulo_seleccionado div').each(function()
            {
                if (numDiv == 0)
                {
                    if (nombreArt.indexOf('Ordenador') > -1)
                    {
                        $(this).empty();
                        $(this).text('Ordenador');
                    }
                    else if (nombreArt.indexOf('Portátil') > -1)
                    {
                        $(this).empty();
                        $(this).text('Portátil');
                    }
                    else if (nombreArt.indexOf('Monitor') > -1)
                    {
                        $(this).empty();
                        $(this).text('Monitor');
                    }
                }
                else 
                {
                    nombreArt = nombreArt.split("Ordenador").join("");
                    nombreArt = nombreArt.split("Portátil").join("");
                    nombreArt = nombreArt.split("Monitor").join("");

                    $(this).empty();
                    $(this).text(nombreArt);
                }

                numDiv = parseInt(numDiv) + parseInt(1);
            });
        }

    }, 2000);
}

function cambiarGraficaAnuncio(nombreArtAbreviado, pulsado)
{
    $('#grafica_articulo_seleccionado').remove();
    var fontSize = $('#titulo_articulo_seleccionado div').css('font-size');

    if (pulsado)
    {
        var nombreygrafica = nombreArtAbreviado.split(' + ');
        var tieneGrafica = nombreArtAbreviado.indexOf(' + ');
        var grafica = '';

        if (tieneGrafica > 0)
        {
            $('#input_grafica_anuncio').val('+ ' + nombreygrafica[1]);
            $('#input_grafica_anuncio').trigger('input');
            grafica = nombreygrafica[1];

            $('#titulo_articulo_seleccionado').append(
                '<div id="grafica_articulo_seleccionado" ' + 
                'style="float: left; margin-right: 10px; margin-top: 5px; font-size: ' + fontSize + 'pt">' + grafica + '</div>');
        }
        else
        {
            $('#input_grafica_anuncio').val('');
        }
    }
    else
    {
        var grafica = $('#input_grafica_anuncio').val();
        setTimeout(function()
        {
            if ($('#input_grafica_anuncio').val() == grafica)
            {
                $('#titulo_articulo_seleccionado').append(
                    '<div id="grafica_articulo_seleccionado" ' + 
                    'style="float: left; margin-right: 10px; margin-top: 5px; font-size: ' + fontSize + 'pt">' + grafica + '</div>');
            }
        }, 1500);
    }
}

function cambiarPrecioAnuncio(itPrecio, precio, pulsado)
{
    if (itPrecio == 1)
    {
        itPrecio = '';
    }

    if (pulsado)
    {
        var precioArticulo = precio + '€';
        $('#input_precio' + itPrecio + '_anuncio').val(precioArticulo);
    }
    else 
    {
        var precioArticulo = $('#input_precio' + itPrecio + '_anuncio').val();
    }

    var lengthPrecio = precioArticulo.length + 2;
    var contentTachado = '';

    for (var i = 0; i < lengthPrecio; i++) 
    {
        contentTachado += '_';
    }

    $('#tachado' + itPrecio + '_articulo_seleccionado').text(contentTachado);

    setTimeout(function()
    {
        if (precioArticulo == $('#input_precio' + itPrecio + '_anuncio').val())
        {
            precioArticulo = precioArticulo.replace('€', '');

            $('#precio' + itPrecio + '_articulo_seleccionado').text('');
            $('#precio' + itPrecio + '_articulo_seleccionado span').remove();
            $('#euro' + itPrecio + '_articulo_seleccionado').css('display', 'none');

            if (precioArticulo.indexOf(".") > -1)
            {
                var numPrecio = precioArticulo.substr(0, precioArticulo.indexOf("."));
                var decPrecio = precioArticulo.substr(precioArticulo.indexOf("."), precioArticulo.length);
                var colorD = $('#input_colord_fuente_anuncio').val();
                var fontSizeDecimal = $('#fontsize_precio' + itPrecio).val() * 0.87;

                $('#precio' + itPrecio + '_articulo_seleccionado').append(numPrecio + '<span style="font-size: ' + fontSizeDecimal + 'pt; color: ' + colorD + '">' + decPrecio + '</span>');
            }
            else if (precioArticulo.indexOf(",") > -1)
            {
                var numPrecio = precioArticulo.substr(0, precioArticulo.indexOf(","));
                var decPrecio = precioArticulo.substr(precioArticulo.indexOf(","), precioArticulo.length);
                var colorD = $('#input_colord_fuente_anuncio').val();
                var fontSizeDecimal = $('#fontsize_precio' + itPrecio).val() * 0.87;

                $('#precio' + itPrecio + '_articulo_seleccionado').append(numPrecio + '<span style="font-size: ' + fontSizeDecimal + 'pt; color: ' + colorD + '">' + decPrecio + '</span>');
            }
            else
            {
                $('#precio' + itPrecio + '_articulo_seleccionado').text(precioArticulo);
            }

            $('#input_dir_precio' + itPrecio + '_anuncio').val(precioArticulo + '€');

            if ($('#input_precio' + itPrecio + '_anuncio').val().trim().indexOf('€') > -1)
            {
                $('#euro' + itPrecio + '_articulo_seleccionado').css('display', 'table-cell');
            }

            if (checkBrowser() == 'Firefox')
            {
                cambiosEnFirefox(7000);
            }
        }
    }, 2000);
}

function tacharPrecio(elemento, num)
{
    if ($(elemento).is(':checked'))
    {
        $('#tachado' + num + '_articulo_seleccionado').css('display', 'table-cell');
    }
    else
    {
        $('#tachado' + num + '_articulo_seleccionado').css('display', 'none');
    }
}

function escribirTextoPrecio(elemento, itPrecio)
{
    var txtPrecioArticulo = $(elemento).val();

    if (itPrecio == 1)
    {
        itPrecio = '';
    }

    setTimeout(function()
    {
        if (txtPrecioArticulo == $(elemento).val())
        {
            var fontsizePrecio = $('#fontsize_precio' + itPrecio).val();
            var fontsizeTxtPrecio = fontsizePrecio * 0.15;

            var colorD = $('#input_colord_fuente_anuncio').val();
            $('#txt_precio' + itPrecio + '_articulo_seleccionado span').remove();
            $('#txt_precio' + itPrecio + '_articulo_seleccionado').append('<span class="span_txt_precio_articulo" style="font-weight: bold; color: ' + colorD + '; font-size: ' + fontsizeTxtPrecio + 'pt;">' + txtPrecioArticulo + '</span>');

            if ($('#radio_plantilla2').is(":checked"))
            {
                $('#txt_precio' + itPrecio + '_articulo_seleccionado').css('text-align', 'right');
                $('#txt_precio' + itPrecio + '_articulo_seleccionado span').css('font-size', '12pt');
                $('#txt_precio' + itPrecio + '_articulo_seleccionado span').css('font-family', 'montserratbolditalic');
            }
            else if ($('#radio_plantilla5').is(":checked"))
            {
                $('#txt_precio' + itPrecio + '_articulo_seleccionado').css('text-align', 'left');
                $('#txt_precio' + itPrecio + '_articulo_seleccionado span').css('font-size', '12pt');
                $('#txt_precio' + itPrecio + '_articulo_seleccionado span').css('color', '#ffffff');
            }
        }

    }, 2000);
}

function desplegarFondos()
{
    var desplegado = $('#input_fondos_desplegados').val();

    if (desplegado == 'false')
    {
        $('#div_fondos_anuncios').css('height', 'auto');
        $("#desplegar_fondos i").removeClass("fas fa-sort-down");
        $("#desplegar_fondos i").addClass("fas fa-sort-up");
        $('#input_fondos_desplegados').val('true');
    }
    else
    {
        $('#div_fondos_anuncios').css('height', '36px');
        $("#desplegar_fondos i").removeClass("fas fa-sort-up");
        $("#desplegar_fondos i").addClass("fas fa-sort-down");
        $('#input_fondos_desplegados').val('false');
    }
}

function elegirFondo(elemento)
{
    $('.img_icon_fondo_cartel').css('border', 'none');
    $('.img_icon_fondo_cartel').css('margin', '3px');

    $(elemento).css('border', '1px solid red');
    $(elemento).css('margin', '3px');

    $('#img_fondo_articulo_seleccionado').attr('src', $(elemento).attr('src'));
}

function cambiarOrientacionAnuncio()
{
    var anchoAnuncio = $('#img_fondo_articulo_seleccionado').css('width');
    var altoAnuncio = $('#img_fondo_articulo_seleccionado').css('height');

    $('#img_fondo_articulo_seleccionado').css('width', altoAnuncio);
    $('#img_fondo_articulo_seleccionado').css('height', anchoAnuncio);
}

function cambiarTamanioAnuncio()
{
    if ($('input[type=radio][name=orientMarco]:checked').val() == 'horizontal')
    {
        switch ($('input[type=radio][name=sizeMarco]:checked').val()) {
            case 'a6':
                  $('#img_fondo_articulo_seleccionado').css('width', '420px');
                  $('#img_fondo_articulo_seleccionado').css('height', '298px');
                  break;
              case 'a5':
                  $('#img_fondo_articulo_seleccionado').css('width', '595px');
                  $('#img_fondo_articulo_seleccionado').css('height', '420px');
                  break;
              case 'a4':
                  $('#img_fondo_articulo_seleccionado').css('width', '842px');
                  $('#img_fondo_articulo_seleccionado').css('height', '595px');
                  break;
              case 'r1':
                  $('#img_fondo_articulo_seleccionado').css('width', '600px');
                  $('#img_fondo_articulo_seleccionado').css('height', '300px');
                  break;
              case 'r2':
                  $('#img_fondo_articulo_seleccionado').css('width', '800px');
                  $('#img_fondo_articulo_seleccionado').css('height', '400px');
                  break;
              case 'r3':
                  $('#img_fondo_articulo_seleccionado').css('width', '1000px');
                  $('#img_fondo_articulo_seleccionado').css('height', '500px');
                  break;
              case 'c1':
                  $('#img_fondo_articulo_seleccionado').css('width', '340px');
                  $('#img_fondo_articulo_seleccionado').css('height', '340px');
                  break;
              case 'c2':
                  $('#img_fondo_articulo_seleccionado').css('width', '425px');
                  $('#img_fondo_articulo_seleccionado').css('height', '425px');
                  break;
              case 'c3':
                  $('#img_fondo_articulo_seleccionado').css('width', '595px');
                  $('#img_fondo_articulo_seleccionado').css('height', '595px');
                  break;
              case 'x1':
                  $('#img_fondo_articulo_seleccionado').css('width', '750px');
                  $('#img_fondo_articulo_seleccionado').css('height', '300px');
                  break;
          }
    }
    else
    {
        switch ($('input[type=radio][name=sizeMarco]:checked').val()) {
            case 'a6':
                  $('#img_fondo_articulo_seleccionado').css('height', '420px');
                  $('#img_fondo_articulo_seleccionado').css('width', '298px');
                  break;
              case 'a5':
                  $('#img_fondo_articulo_seleccionado').css('height', '595px');
                  $('#img_fondo_articulo_seleccionado').css('width', '420px');
                  break;
              case 'a4':
                  $('#img_fondo_articulo_seleccionado').css('height', '842px');
                  $('#img_fondo_articulo_seleccionado').css('width', '595px');
                  break;
              case 'r1':
                  $('#img_fondo_articulo_seleccionado').css('height', '600px');
                  $('#img_fondo_articulo_seleccionado').css('width', '300px');
                  break;
              case 'r2':
                  $('#img_fondo_articulo_seleccionado').css('height', '800px');
                  $('#img_fondo_articulo_seleccionado').css('width', '400px');
                  break;
              case 'r3':
                  $('#img_fondo_articulo_seleccionado').css('height', '1000px');
                  $('#img_fondo_articulo_seleccionado').css('width', '500px');
                  break;
              case 'c1':
                  $('#img_fondo_articulo_seleccionado').css('height', '340px');
                  $('#img_fondo_articulo_seleccionado').css('width', '340px');
                  break;
              case 'c2':
                  $('#img_fondo_articulo_seleccionado').css('height', '425px');
                  $('#img_fondo_articulo_seleccionado').css('width', '425px');
                  break;
              case 'c3':
                  $('#img_fondo_articulo_seleccionado').css('height', '595px');
                  $('#img_fondo_articulo_seleccionado').css('width', '595px');
                  break;
              case 'x1':
                  $('#img_fondo_articulo_seleccionado').css('width', '750px');
                  $('#img_fondo_articulo_seleccionado').css('height', '300px');
                  break;
          }
    }
}

function cambiarTamanioPersAnuncio(cambiarAncho)
{
    if (cambiarAncho)
    {
        var anchoImagen = $('#input_ancho_anuncio').val();
        setTimeout(function()
        {
            if (anchoImagen == $('#input_ancho_anuncio').val())
            {
                $('#img_fondo_articulo_seleccionado').css('width', anchoImagen + 'px');
            }

        }, 2000);
    }
    else
    {
        var altoImagen = $('#input_alto_anuncio').val();
        setTimeout(function()
        {
            if (altoImagen == $('#input_alto_anuncio').val())
            {
                $('#img_fondo_articulo_seleccionado').css('height', altoImagen + 'px');
            }

        }, 2000);
    }
}

function mostrarBotonAnuncio()
{
    if ($('#check_dato_panel').is(":checked"))
    {
        $('#panel_articulo_seleccionado').css('display', 'block');
    }
    else
    {
        $('#panel_articulo_seleccionado').css('display', 'none');
    }
}

function escribirBotonAnuncio()
{
    var datoPanel = $('#input_dato_panel').val();

    setTimeout(function()
    {
        if (datoPanel == $('#input_dato_panel').val())
        {
            $('#div_panel_articulo_seleccionado div:first-child').text(datoPanel);
        }

    }, 2000);
}

function apuntarBotonIzqAnuncio()
{
    $('#div_panel_articulo_seleccionado div:first-child').css('float', 'right');    

    $('#div_img_flecha_panel').css('float', 'left');
    $('#div_img_flecha_panel').css('margin-left', '0px');
    $('#div_img_flecha_panel').css('margin-right', '3px');

     $('#input_flecha_der').attr('checked', false);

     rotacionFlecha();
}

function apuntarBotonDerAnuncio()
{
    $('#div_panel_articulo_seleccionado div:first-child').css('float', 'left');

    $('#div_img_flecha_panel').css('float', 'right');
    $('#div_img_flecha_panel').css('margin-left', '3px');
    $('#div_img_flecha_panel').css('margin-right', '0px');

     $('#input_flecha_izq').attr('checked', false);

     rotacionFlecha();
}

function apuntarBotonArrAnuncio()
{
    $('#input_flecha_aba').attr('checked', false);

    rotacionFlecha();
}

function apuntarBotonAbjAnuncio()
{
    $('#input_flecha_arr').attr('checked', false);

    rotacionFlecha();
}

function rotacionFlecha()
{
    $('#img_flecha_panel').css({'-webkit-transform' : 'rotate(0deg)',
         '-moz-transform' : 'rotate(0deg)',
         '-ms-transform' : 'rotate(0deg)',
         'transform' : 'rotate(0deg)'});

    if ($('#input_flecha_arr').is(':checked'))
    {
        $('#img_flecha_panel').css({'-webkit-transform' : 'rotate(90deg)',
         '-moz-transform' : 'rotate(90deg)',
         '-ms-transform' : 'rotate(90deg)',
         'transform' : 'rotate(90deg)'});

         $('#div_img_flecha_panel img').css({'-webkit-transform' : 'rotate(90deg)',
         '-moz-transform' : 'rotate(90deg)',
         '-ms-transform' : 'rotate(90deg)',
         'transform' : 'rotate(90deg)'});
    }
    else if ($('#input_flecha_aba').is(':checked'))
    {
        $('#img_flecha_panel').css({'-webkit-transform' : 'rotate(270deg)',
         '-moz-transform' : 'rotate(270deg)',
         '-ms-transform' : 'rotate(270deg)',
         'transform' : 'rotate(270deg)'});

         $('#div_img_flecha_panel img').css({'-webkit-transform' : 'rotate(270deg)',
         '-moz-transform' : 'rotate(270deg)',
         '-ms-transform' : 'rotate(270deg)',
         'transform' : 'rotate(270deg)'});
    }
    else if ($('#input_flecha_izq').is(':checked'))
    {
        $('#img_flecha_panel').css({'-webkit-transform' : 'rotate(0deg)',
         '-moz-transform' : 'rotate(0deg)',
         '-ms-transform' : 'rotate(0deg)',
         'transform' : 'rotate(0deg)'});

         $('#div_img_flecha_panel img').css({'-webkit-transform' : 'rotate(0deg)',
         '-moz-transform' : 'rotate(0deg)',
         '-ms-transform' : 'rotate(0deg)',
         'transform' : 'rotate(0deg)'});
    }
    else if ($('#input_flecha_der').is(':checked'))
    {
        $('#img_flecha_panel').css({'-webkit-transform' : 'rotate(180deg)',
         '-moz-transform' : 'rotate(180deg)',
         '-ms-transform' : 'rotate(180deg)',
         'transform' : 'rotate(180deg)'});

         $('#div_img_flecha_panel img').css({'-webkit-transform' : 'rotate(180deg)',
         '-moz-transform' : 'rotate(180deg)',
         '-ms-transform' : 'rotate(180deg)',
         'transform' : 'rotate(180deg)'});
    }
}

function cambiarEstiloBotonAnuncio()
{
    if ($('#input_flecha_izq').is(':checked'))
    {
        if ($('#input_flecha_est1').is(':checked'))
        {
            addBoton('izq', 1);
            $('#input_colorf_fuente_anuncio').css('display', 'none');
        }
        else if ($('#input_flecha_est2').is(':checked'))
        {
            addBoton('izq', 2);
            $('#input_colorf_fuente_anuncio').css('display', 'block');
        }
    }
    else if ($('#input_flecha_der').is(':checked'))
    {
        if ($('#input_flecha_est1').is(':checked'))
        {
            addBoton('der', 1);
            $('#input_colorf_fuente_anuncio').css('display', 'none');
        }
        else if ($('#input_flecha_est2').is(':checked'))
        {
            addBoton('der', 2);
            $('#input_colorf_fuente_anuncio').css('display', 'block');
        }
    }

    rotacionFlecha();

    var fontSize = $('#fontsize_panel').val();
    changePanel(fontSize);
}

function voltearImgAnuncio()
{
    var voltearImg = $('#voltear_imagen').val();

    if (voltearImg == '0')
    {
        $('#voltear_imagen').val('1');
        rotateImg('#rotacion_imagen', '#img_foto_articulo_seleccionado', false); 
    }
    else
    {
        $('#voltear_imagen').val('0');
        rotateImg('#rotacion_imagen', '#img_foto_articulo_seleccionado', true); 
    }
}

function girarImgAnuncio(giro)
{
    int01 = setInterval(function() 
    { 
        rotateImg('#rotacion_imagen', '#img_foto_articulo_seleccionado', giro); 
    }, 15);
}

function rotateImg(campo1, campo2, sumar)
{
    if (sumar)
    {
        var rotacion = parseInt($(campo1).val()) + 1;
    }
    else
    {
        var rotacion = parseInt($(campo1).val()) - 1;
    }

    var voltearImg = $('#voltear_imagen').val();

    if (voltearImg == 0)
    {
        var scale = 1;
    }
    else
    {
        var scale = -1;
    }

    $(campo1).val(rotacion);
    $(campo2).css({'-webkit-transform' : 'rotate('+ rotacion +'deg) scaleX(' + scale + ')',
         '-moz-transform' : 'rotate('+ rotacion +'deg) scaleX(' + scale + ')',
         '-ms-transform' : 'rotate('+ rotacion +'deg) scaleX(' + scale + ')',
         'transform' : 'rotate('+ rotacion +'deg) scaleX(' + scale + ')'});
}

function addBoton(direccion, estilo)
{
    if (direccion == 'izq')
    {
        var dir1 = 'right';
        var dir2 = 'left';
    }
    else
    {
        var dir1 = 'left';
        var dir2 = 'right';
    }

    var txtBoton = $('#input_dato_panel').val();

    $('#div_img_flecha_panel i').remove();
    $('#div_img_flecha_panel img').remove();

    if (estilo == 1)
    {
        $('#div_panel_articulo_seleccionado div:first-child').text(txtBoton);
        $('#div_panel_articulo_seleccionado div:first-child').css('float', dir1);
        $('#div_panel_articulo_seleccionado div:first-child').css('font-family', 'montserratextralight');
        $('#div_img_flecha_panel').append('<i class="fas fa-chevron-left" id="img_flecha_panel"></i>');
    }
    else
    {
        $("#panel_articulo_seleccionado").removeAttr("style");
        $("#div_panel_articulo_seleccionado").removeAttr("style");

        $('#div_panel_articulo_seleccionado').css('border', 'none');
        $('#div_panel_articulo_seleccionado div:first-child').text(txtBoton);
        $('#div_panel_articulo_seleccionado div:first-child').css('float', dir1);
        $('#div_panel_articulo_seleccionado div:first-child').css('font-family', 'montserratextralight');
        $('#div_img_flecha_panel').append('<img src="public/images/arrow-left.png" style="float: ' + dir2 + '; width: 9px; margin-top: 3px;" />');
        $('#div_img_flecha_panel').css('border', 'none');
    }

    $('#input_colore_fuente_anuncio').trigger('change');
}

function changePanel(fontSize)
{
    $('#fontsize_panel').val(fontSize);
    $('#div_panel_articulo_seleccionado').css('font-size', fontSize + 'pt');

    var fontSize2 = parseInt(fontSize) * 1.27;
    $('#div_panel_articulo_seleccionado i').css('font-size', fontSize2 + 'pt');

    var padding1 = fontSize * 1.36;
    var padding2 = fontSize * 0.54;
    var height = fontSize * 0.75;
    var width = fontSize * 0.73;

    $('#div_panel_articulo_seleccionado').css('padding', padding1 + 'px ' + padding2 + 'px');
    $('#div_panel_articulo_seleccionado').css('height', height + 'px');

    $('#div_img_flecha_panel img').css('width', width + 'px');

    var divPadding1 = fontSize * 0.30;
    var divPadding2 = fontSize * 0.60;
    var divPadding3 = fontSize * 0.30;
    var divPadding4 = fontSize * 0.30;

    if ($('#input_flecha_est1').is(':checked'))
    {
        $('#div_panel_articulo_seleccionado').css('border-radius', '5px');

        var marginTop = fontSize * 0.76;
    }
    else
    {
        $('#div_panel_articulo_seleccionado').css('border-radius', '10px');

        var marginTop = fontSize;
    }

    var divPadding1 = fontSize * 0.23;
    var divPadding2 = fontSize * 0.38;

    $('#div_img_flecha_panel').css('margin-top', '-' + marginTop + 'px');
    $('#div_img_flecha_panel').css('border-radius', padding1 + 'px');
    $('#div_img_flecha_panel i').css('border-radius', padding1 + 'px');
    $('#div_img_flecha_panel i').css('font-size', fontSize + 'pt');
}

function mostrarTelefonoAnuncio()
{
    var txtTelefono = $('#input_text_telefono').val();
    var datoTelefono = $('#input_dato_telefono').val();

    if ($('#check_dato_telefono').is(":checked"))
    {
        $('#div_texto_dato1_usuario_seleccionado').append('<div>' + txtTelefono + '</div>');
        $('#div_dato1_usuario_seleccionado').append('<div>' + datoTelefono + '</div>');
    }
    else
    {
        $('#div_texto_dato1_usuario_seleccionado div').remove();
        $('#div_dato1_usuario_seleccionado div').remove();
    }

    var colorB = $('#input_colorb_fuente_anuncio').val();
    $('.div_texto_dato_usuario_seleccionado').css('color', colorB);
    $('.div_dato_usuario_seleccionado').css('color', colorB);
}

function escribirTextTelefono()
{
    var textoTelefono = $('#input_text_telefono').val();

    var colorB = $('#input_colorb_fuente_anuncio').val();

    $('.div_texto_dato_usuario_seleccionado').css('color', colorB);
    $('.div_dato_usuario_seleccionado').css('color', colorB);

    setTimeout(function()
    {
        if (textoTelefono == $('#input_text_telefono').val())
        {
            $('#div_texto_dato1_usuario_seleccionado div').remove();
            $('#div_texto_dato1_usuario_seleccionado').append('<div>' + textoTelefono + '</div>');
        }

    }, 2000);
}

function escribirDatoTelefono()
{
    var datoTelefono = $('#input_dato_telefono').val();

    var colorB = $('#input_colorb_fuente_anuncio').val();

    $('.div_texto_dato_usuario_seleccionado').css('color', colorB);
    $('.div_dato_usuario_seleccionado').css('color', colorB);

    setTimeout(function()
    {
        if (datoTelefono == $('#input_dato_telefono').val())
        {
            $('#div_dato1_usuario_seleccionado div').remove();
            $('#div_dato1_usuario_seleccionado').append('<div>' + datoTelefono + '</div>');
        }

    }, 2000);
}

function mostrarCorreoAnuncio()
{
    var txtCorreo = $('#input_text_correo').val();
    var datoCorreo = $('#input_dato_correo').val();

    if ($('#check_dato_correo').is(":checked"))
    {
        $('#div_texto_dato2_usuario_seleccionado').append('<div>' + txtCorreo + '</div>');
        $('#div_dato2_usuario_seleccionado').append('<div>' + datoCorreo + '</div>');
    }
    else
    {
        $('#div_texto_dato2_usuario_seleccionado div').remove();
        $('#div_dato2_usuario_seleccionado div').remove();
    }
}

function escribirTextCorreo()
{
    var textoCorreo = $('#input_text_correo').val();

    var colorB = $('#input_colorb_fuente_anuncio').val();

    $('.div_texto_dato_usuario_seleccionado').css('color', colorB);
    $('.div_dato_usuario_seleccionado').css('color', colorB);

    setTimeout(function()
    {
        if (textoCorreo == $('#input_text_correo').val())
        {
            $('#div_texto_dato2_usuario_seleccionado div').remove();
            $('#div_texto_dato2_usuario_seleccionado').append('<div>' + textoCorreo + '</div>');
        }

    }, 2000);
}

function escribirDatoCorreo()
{
    var datoCorreo = $('#input_dato_correo').val();

    var colorB = $('#input_colorb_fuente_anuncio').val();

    $('.div_texto_dato_usuario_seleccionado').css('color', colorB);
    $('.div_dato_usuario_seleccionado').css('color', colorB);

    setTimeout(function()
    {
        if (datoCorreo == $('#input_dato_correo').val())
        {
            $('#div_dato2_usuario_seleccionado div').remove();
            $('#div_dato2_usuario_seleccionado').append('<div>' + datoCorreo + '</div>');
        }

    }, 2000);
}

function mostrarTecladoAnuncio()
{
    if ($('#check_dato_teclado').is(":checked"))
    {
        $('#img_teclado_castellano').css('display', 'block');
        $('#check_dato_teclado_con10').prop('checked', true);
        $('#check_dato_teclado_con10').trigger('change');
    }
    else
    {
        $('#img_teclado_castellano').css('display', 'none');
        $('#check_dato_teclado_con10').prop('checked', false);
        $('#check_dato_teclado_con10').trigger('change');
    }
}

function mostrarTecladoConDiezAnuncio()
{
    if ($('#check_dato_teclado_con10').is(":checked"))
    {
        $('#check_dato_teclado').prop('checked', true);
        $('#img_teclado_castellano').css('display', 'block');
        $('#img_teclado_castellano').attr('src', '/xweb/public/images/teclado_castellano_con10.png');
    }
    else
    {
        $('#img_teclado_castellano').attr('src', '/xweb/public/images/teclado_castellano.png');
    }
}

function mostrarOfertaValida()
{
    if ($('#check_oferta_valida').is(":checked"))
    {
        $('#div_oferta_valida').css('display', 'block');
        escribirTextOferta();
    }
    else
    {
        $('#div_oferta_valida').css('display', 'none');
    }
}

function escribirTextOferta(cambioFecha = false)
{
    $('#check_oferta_valida').prop('checked', true);

    if (cambioFecha)
    {
        $('#check_fecha_oferta_valida').prop('checked', true);
    }

    var txtInputOferta = $('#input_text_oferta').val();
    var fechaInputOferta = $('#input_fecha_oferta').val();
    fechaInputOferta = dayjs(fechaInputOferta).format('DD-MM-YYYY');

    setTimeout(function()
    {
        if (txtInputOferta == $('#input_text_oferta').val())
        {
            var fontSize = $("#span_oferta_valida").css("font-size");

            if (fontSize === "") 
            {
                fontSize = '15pt'; // Establecer un valor por defecto
            }

            if ($('#check_fecha_oferta_valida').is(":checked"))
            {
                $('#span_oferta_valida').remove();
                $('#div_oferta_valida').append('<span id="span_oferta_valida" style="font-size: ' + fontSize + '">' + txtInputOferta + ' ' + fechaInputOferta + '</span>');
            }
            else
            {
                $('#span_oferta_valida').remove();
                $('#div_oferta_valida').append('<span id="span_oferta_valida" style="font-size: ' + fontSize + '">' + txtInputOferta + '</span>');
            }
        }

    }, 2000);
}

function mostrarTextoPantalla()
{
    if ($('#check_caract_pantalla').is(":checked"))
    {
        $('#div_texto_pantalla').css('display', 'block');
        $('#div_texto_tactil').css('display', 'block');
        escribirTextPantalla('check_caract_pantalla', 'input_text_pantalla', 'span_texto_pantalla', 'div_texto_pantalla');
        escribirTextPantalla('check_caract_pantalla', 'input_caract_pantalla', 'span_texto_tactil', 'div_texto_tactil');
    }
    else
    {
        $('#div_texto_pantalla').css('display', 'none');
        $('#div_texto_tactil').css('display', 'none');
    }
}

function escribirTextPantalla(check, input, span, div)
{
    $('#' + check).prop('checked', true);

    var txtInputPantalla = $('#' + input).val();

    setTimeout(function()
    {
        if (txtInputPantalla == $('#' + input).val())
        {
            var fontSize = $("#" + span).css("font-size");
            var colorB = $('#input_colorb_fuente_anuncio').val();

            if (fontSize === "") 
            {
                fontSize = '11pt';
            }

            $('#' + span).remove();
            $('#' + div).append('<span id="' + span + '" class="span_texto_pantalla" style="font-size: ' + fontSize + '; color: ' + colorB + '">' + txtInputPantalla + '</span>');
        }
    }, 2000);
}

function mostrarLoteArticulos()
{
    if ($('#check_lote_articulos').is(":checked"))
    {
        $('#div_lote_articulos').css('display', 'block');
    }
    else
    {
        $('#div_lote_articulos').css('display', 'none');
    }
}

function anadirArticuloALote()
{
    var numeroFilas = $('.tr_lote_articulo').length;

    if (numeroFilas < 5)
    {
        numeroFilas = numeroFilas + 1;

        var nuevaFila = '<tr class="tr_lote_articulo">' + 
                            '<td>' + 
                                '<div>' + 
                                    '<input type="text" id="input_nombre_lote_articulo_' + numeroFilas + '" name="input_nombre_lote" placeholder="Artículo para el lote" oninput="editarNombreLote(this)" style="width: 275px; margin-right: 10px;" value="" />' + 
                                '</div>' + 
                                '<div class="div_otros_datos" style="float: right; padding-top: 5px;">Abrev.</div>' + 
                            '</td>' + 
                            '<td style="width: 35%; vertical-align: top;">' + 
                                '<input type="text" id="input_nombre_abrev_lote_articulo_' + numeroFilas + '" name="input_nombre_abrev_lote_articulo" oninput="editarAbrevNombreLote()" style="width: 100%; margin-right: 10px;" value="" />' + 
                                '<input type="hidden" id="input_precio_art_lote_' + numeroFilas + '" class="input_precio_art_lote" value="" />' + 
                            '</td>' + 
                            '<td style="width: 17%; vertical-align: top;">' + 
                                '<div class="div_control_lote">' + 
                                    '<button id="btn_eliminar_art_lote_' + numeroFilas + '" name="btn_eliminar_art_lote" onclick="eliminarArticuloALote(this)" class="btn_articulo_lote">' + 
                                        '<i class="fa fa-times i_btn_generador_formulario i_btn_lote" style="color: #dc3545"></i>' + 
                                    '</button>' + 
                                    '<button id="btn_subir_art_lote_' + numeroFilas + '" name="btn_subir_art_lote" onclick="subirArticuloALote(this)" class="btn_articulo_lote">' + 
                                        '<i class="fa fa-arrow-up i_btn_generador_formulario i_btn_lote" style="color: #17a2b8"></i>' + 
                                    '</button>' + 
                                    '<button id="btn_bajar_art_lote_' + numeroFilas + '" name="btn_bajar_art_lote" onclick="bajarArticuloALote(this)" class="btn_articulo_lote">' + 
                                        '<i class="fa fa-arrow-down i_btn_generador_formulario i_btn_lote" style="color: #17a2b8"></i>' + 
                                    '</button>' + 
                                '</div>' + 
                            '</td>' + 
                        '</tr>';

        $('#table_lote_articulos').append(nuevaFila);

        deshabilitarBotonesPosicionLote();

        escribirLoteArticulos();
    }
}

function editarNombreLote(elemento)
{
    var tarifa = $('#tarifa_usuario').val();
    var criterioBusq = $(elemento).val();

    setTimeout(function()
    {
        if (criterioBusq == $(elemento).val())
        {
            var divPadre = $(elemento).parent();
            divPadre.children('div').remove();

            if (criterioBusq.length > 3)
            {
                $.ajax({
                    url: '/xweb/buscararticulosanuncio/' + $(elemento).val(),
                    type: 'get',
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        var arrArtEncontrados = response;

                        for (var i = 0; i < 3; i++) 
                        {
                            (function(i) 
                            {
                                var nombreArt = arrArtEncontrados[i].ADESCR;
                                var nombreAbrev = nombreArt;
                                var precio = 0;

                                if (nombreAbrev.length > 25)
                                {
                                    nombreAbrev = nombreAbrev.substring(0, 22) + '...';
                                }

                                if (tarifa == 1)
                                {
                                    precio = arrArtEncontrados[i].APVP1;
                                }
                                else if (tarifa == 2)
                                {
                                    precio = arrArtEncontrados[i].APVP2;
                                }
                                else if (tarifa == 3)
                                {
                                    precio = arrArtEncontrados[i].APVP3;
                                }
                                else if (tarifa == 4)
                                {
                                    precio = arrArtEncontrados[i].APVP4;
                                }
                                else if (tarifa == 5)
                                {
                                    precio = arrArtEncontrados[i].ARESNUM5;
                                }
                                else if (tarifa == 6)
                                {
                                    precio = arrArtEncontrados[i].ARESNUM6;
                                }

                                $(elemento).parent().append('<div class="div_busq_lote" onclick="seleccionarBusqLote(this, ' + precio + ')">' + nombreAbrev + '</div>');
                            }(i));
                        }
                    }
                });
            }
        }
    }, 2000);
}

function seleccionarBusqLote(elemento, precio)
{
    var divPadre = $(elemento).parent();
    var inputNombreLoteArt = divPadre.children('input');

    inputNombreLoteArt.val($(elemento).text());

    var idInputNombreLoteArt = inputNombreLoteArt.attr('id');
    var numId = idInputNombreLoteArt.charAt(idInputNombreLoteArt.length - 1);

    $('#input_nombre_abrev_lote_articulo_' + numId).val(obtNombreAbreviadoArt(inputNombreLoteArt.val()));
    $('#input_precio_art_lote_' + numId).val(precio);

    divPadre.children('div').remove();

    calcularPrecioLote();

    escribirLoteArticulos();
}

function calcularPrecioLote()
{
    setTimeout(function()
    {
        var precioTotal = 0;
        var precioArtPrincipal = $('#precio_articulo_seleccionado').text();

        precioTotal = precioArtPrincipal;
        console.log('PrecioPrincipal ' + precioArtPrincipal);

        $('.input_precio_art_lote').each(function()
        {
            precioTotal = parseFloat(precioTotal) + parseFloat($(this).val());
            console.log('PrecioLote ' + precioTotal);
        });

        $('#input_precio_lote').val(precioTotal);
    }, 2000);
}

function eliminarArticuloALote(elemento)
{
    var trAEliminar = $(elemento).closest('tr');
    trAEliminar.remove();

    renombrarIdsInputLote('input_nombre_lote_articulo_', 'input_nombre_lote', 'input');
    renombrarIdsInputLote('input_nombre_abrev_lote_articulo_', 'input_nombre_abrev_lote_articulo', 'input');
    renombrarIdsInputLote('btn_eliminar_art_lote_', 'btn_eliminar_art_lote', 'button');
    renombrarIdsInputLote('btn_subir_art_lote_', 'btn_subir_art_lote', 'button');
    renombrarIdsInputLote('btn_bajar_art_lote_', 'btn_bajar_art_lote', 'button');
    deshabilitarBotonesPosicionLote();
    escribirLoteArticulos();
}

function renombrarIdsInputLote(idInput, nameInput, tipoElem)
{
    var elements = $(tipoElem + '[name="' + nameInput + '"]');

    elements.each(function(index)
    {
        var newId = idInput + (index + 1);
        $(this).attr('id', newId);
    });
}

function deshabilitarBotonesPosicionLote()
{
    var inputElements = $('input[name="input_nombre_lote"]');

    inputElements.each(function(index)
    {
        $('#btn_subir_art_lote_' + (index + 1)).removeAttr('disabled');
        $('#btn_bajar_art_lote_' + (index + 1)).removeAttr('disabled');

        if (index === 1)
        {
            $('#btn_subir_art_lote_' + (index + 1)).prop('disabled', true);
        }

        if (index === inputElements.length - 1)
        {
            $('#btn_bajar_art_lote_' + (index + 1)).prop('disabled', true);
        }
    });
}

function subirArticuloALote(elemento)
{
    var filaActual = $(elemento).closest('tr');
    var filaPrevia = filaActual.prev('tr');

    // Si hay una fila anterior
    if (filaPrevia.length)
    {
        filaActual.insertBefore(filaPrevia);
    }

    renombrarIdsInputLote('input_nombre_lote_articulo_', 'input_nombre_lote', 'input');
    renombrarIdsInputLote('input_nombre_abrev_lote_articulo_', 'input_nombre_abrev_lote_articulo', 'input');
    renombrarIdsInputLote('btn_eliminar_art_lote_', 'btn_eliminar_art_lote', 'button');
    renombrarIdsInputLote('btn_subir_art_lote_', 'btn_subir_art_lote', 'button');
    renombrarIdsInputLote('btn_bajar_art_lote_', 'btn_bajar_art_lote', 'button');
    deshabilitarBotonesPosicionLote();
    escribirLoteArticulos();
}

function bajarArticuloALote(elemento)
{
    var filaActual = $(elemento).closest('tr');
    var filaSiguiente = filaActual.next('tr');

    // Si hay una fila siguiente
    if (filaSiguiente.length)
    {
        filaActual.insertAfter(filaSiguiente);
    }

    renombrarIdsInputLote('input_nombre_lote_articulo_', 'input_nombre_lote', 'input');
    renombrarIdsInputLote('input_nombre_abrev_lote_articulo_', 'input_nombre_abrev_lote_articulo', 'input');
    renombrarIdsInputLote('btn_eliminar_art_lote_', 'btn_eliminar_art_lote', 'button');
    renombrarIdsInputLote('btn_subir_art_lote_', 'btn_subir_art_lote', 'button');
    renombrarIdsInputLote('btn_bajar_art_lote_', 'btn_bajar_art_lote', 'button');
    deshabilitarBotonesPosicionLote();
    escribirLoteArticulos();
}

function escribirLoteArticulos()
{
    setTimeout(function()
    {
        $('#div_lista_lote_articulos ul').empty();

        $('input[name="input_nombre_abrev_lote_articulo"]').each(function(index, element) {

            $('#div_lista_lote_articulos ul').append('<li>' + $(element).val() + '</li>');
        });

        var precioLote = $('#input_precio_lote').val();
        $('#precio_articulo_seleccionado').text(precioLote);
    }, 2000);
}

function editarPrecioLote()
{
    var precioLote = $('#input_precio_lote').val();

    setTimeout(function()
    {
        if (precioLote == $('#input_precio_lote').val())
        {
            $('#precio_articulo_seleccionado').text(precioLote);
        }
    }, 2000);
}

function moverElementoAnuncio(elemento, vertical, sumar)
{
    int01 = setInterval(function() 
    {
        if (vertical)
        {
            topElement(elemento, sumar); 
        }
        else
        {
            leftElement(elemento, sumar);
        }
    }, 15);
}

function cambiarTamanioImagenAnuncio(elemento, agrandar, ancho, alto)
{
    int01 = setInterval(function() 
    {
        cambiarTamanioImagen(elemento, agrandar, ancho, alto);
    }, 15);
}

function soltarElementoAnuncio()
{
    clearInterval(int01);
}

function cambiarTamanioImagen(elemento, agrandar, ancho, alto) 
{
    if (agrandar)
    {
        var ancho = parseFloat($(elemento).css('width')) + parseFloat(ancho);
        var alto = parseFloat($(elemento).css('height')) + parseFloat(alto);
    }
    else
    {
        var ancho = parseFloat($(elemento).css('width')) - parseFloat(ancho);
        var alto = parseFloat($(elemento).css('height')) - parseFloat(alto);
    }

    $(elemento).css('max-width', ancho + 'px');
    $(elemento).css('max-height', alto + 'px');
}

function cambiarTamanioFuente(elemento, sumar, valor) {

    if (sumar)
    {
        var fontSize = (parseFloat($(elemento).css("font-size")) * 72.0 / 96.0) + parseFloat(valor);
        console.log('fontsize' + fontSize);
    }
    else 
    {
        var fontSize = (parseFloat($(elemento).css("font-size")) * 72.0 / 96.0) - parseFloat(valor);
        console.log('fontsize' + fontSize);
    }

    $(elemento).css('font-size', fontSize + 'pt');
}

function cambiarTamanioPrecioAnuncio(precio, sumar)
{
    int01 = setInterval(function() 
    {
        cambiarTamanioFuente('#tachado' + precio + '_articulo_seleccionado', sumar, 0.1);
        cambiarTamanioFuente('#precio' + precio + '_articulo_seleccionado', sumar, 0.1);
        cambiarTamanioFuente('#euro' + precio + '_articulo_seleccionado', sumar, 0.06); 
        cambiarTamanioFuente('#txt_precio' + precio + '_articulo_seleccionado span', sumar, 0.015); 
    }, 15);
}

function cambiarBoton(sumar)
{
    if (sumar)
    {
        var fontSize = (parseFloat($('#div_panel_articulo_seleccionado').css("font-size")) * 72.0 / 96.0) + parseFloat(1);
    }
    else
    {
        var fontSize = (parseFloat($('#div_panel_articulo_seleccionado').css("font-size")) * 72.0 / 96.0) - parseFloat(1);
    }

    $('#div_panel_articulo_seleccionado').css('font-size', fontSize + 'pt');

    var fontSize2 = parseInt(fontSize) * 1.27;
    $('#div_panel_articulo_seleccionado i').css('font-size', fontSize2 + 'pt');

    var padding1 = fontSize * 1.36;
    var padding2 = fontSize * 0.23;
    var padding3 = fontSize * 0.46;
    var padding4 = fontSize * 0.30;
    var padding5 = fontSize * 0.60;

    var width = fontSize * 0.73;

    $('#div_img_flecha_panel img').css('width', width + 'px');

    if ($('#input_flecha_est1').is(':checked'))
    {
        $('#div_panel_articulo_seleccionado').css('border-radius', '5px');
    }
    else
    {
        $('#div_panel_articulo_seleccionado').css('border-radius', '10px');
    }

    $('#div_img_flecha_panel').css('border-radius', padding1 + 'px');
    $('#div_img_flecha_panel i').css('border-radius', padding1 + 'px');
    $('#div_img_flecha_panel i').css('font-size', fontSize + 'pt');

    var lineHeightIconBtn = $('#div_img_flecha_panel').outerHeight();
    $('#div_txt_panel_articulo_seleccionado').css('line-height', lineHeightIconBtn + 'px');

    $('#img_flecha_panel').css('padding', padding2 + 'px' + ' ' + padding3 + 'px');
    $('#div_panel_articulo_seleccionado').css('padding', padding4 + 'px' + ' ' + padding5 + 'px');
}

function mostrarPrecio(mostrar)
{
    var numPreciosMostrados = 0;

    $('.div_precio_articulo_seleccionado').each(function()
    {
        if ($(this).css('display') == 'table')
        {
            numPreciosMostrados = parseInt(numPreciosMostrados) + parseInt(1);
        }
    });

    if (!mostrar)
    {
        if (numPreciosMostrados > 1)
        {
            numPreciosMostrados = parseInt(numPreciosMostrados) - parseInt(1);
        }
    }
    else
    {
        if (numPreciosMostrados < 3)
        {
            numPreciosMostrados = parseInt(numPreciosMostrados) + parseInt(1);
        }
    }

    mostrarPrecio2(numPreciosMostrados);
}

function mostrarPrecio2(numPrecios)
{
    if (numPrecios == 3)
    {
        $('#div_precio_articulo_seleccionado').css('display', 'table');
        $('#div_precio2_articulo_seleccionado').css('display', 'table');
        $('#div_precio3_articulo_seleccionado').css('display', 'table');

        $('.precio_control').css('display', 'table');
        $('.precio2_control').css('display', 'table');
        $('.precio3_control').css('display', 'table');

        $('#tr_precio_anuncio').css('display', 'table-row');
        $('#tr_precio2_anuncio').css('display', 'table-row');
        $('#tr_precio3_anuncio').css('display', 'table-row');

        var precio3 = $('#input_precio_anuncio').val();
        var precio2 = parseInt(precio3 * 0.95);
        var precio1 = parseInt(precio3 * 0.85);

        $('#input_precio_anuncio').val(precio1);
        $('#input_precio2_anuncio').val(precio2);
        $('#input_precio3_anuncio').val(precio3);

        $('#input_precio_anuncio').trigger('input');
        $('#input_precio2_anuncio').trigger('input');
        $('#input_precio3_anuncio').trigger('input');
    }
    else if (numPrecios == 2)
    {
        $('#div_precio_articulo_seleccionado').css('display', 'table');
        $('#div_precio2_articulo_seleccionado').css('display', 'table');
        $('#div_precio3_articulo_seleccionado').css('display', 'none');

        $('.precio_control').css('display', 'table');
        $('.precio2_control').css('display', 'table');
        $('.precio3_control').css('display', 'none');

        $('#tr_precio_anuncio').css('display', 'table-row');
        $('#tr_precio2_anuncio').css('display', 'table-row');
        $('#tr_precio3_anuncio').css('display', 'none');

        var precio2 = $('#input_precio_anuncio').val();
        var precio1 = parseInt(precio2 * 0.95);

        console.log('Mostrar precios -> ' + precio1 + ' - ' + precio2);

        $('#input_precio_anuncio').val(precio1);
        $('#input_precio2_anuncio').val(precio2);

        $('#input_precio_anuncio').trigger('input');
        $('#input_precio2_anuncio').trigger('input');
    }
    else if (numPrecios == 1)
    {
        $('#div_precio_articulo_seleccionado').css('display', 'table');
        $('#div_precio2_articulo_seleccionado').css('display', 'none');
        $('#div_precio3_articulo_seleccionado').css('display', 'none');

        $('.precio_control').css('display', 'table');
        $('.precio2_control').css('display', 'none');
        $('.precio3_control').css('display', 'none');

        $('#tr_precio_anuncio').css('display', 'table-row');
        $('#tr_precio2_anuncio').css('display', 'none');
        $('#tr_precio3_anuncio').css('display', 'none');

        var precio1 = $('#input_precio_anuncio').val();

        $('#input_precio_anuncio').val(precio1);

        $('#input_precio_anuncio').trigger('input');
    }
}

function buscarArticulosAnuncio()
{
    $('#buscar_generador').on('input', function()
    {
        codeBuscarArticulosAnuncio();
    });

    $('#buscar_generador').on('paste', function()
    {
        codeBuscarArticulosAnuncio();
    });
}

function codeBuscarArticulosAnuncio()
{
    var txtBuscador = $('#buscar_generador').val();

    setTimeout(function()
    {
        if (txtBuscador == $('#buscar_generador').val())
        {
            $.ajax({
                url: '/xweb/buscararticulosanuncio/' + $('#buscar_generador').val(),
                type: 'get',
                contentType: false,
                processData: false,
                success: function(response) {

                    if ($('#buscar_generador').val() == '')
                    {
                        $('.table_seleccion_articulo').css('display', 'table');
                    }
                    else
                    {
                        $('.table_seleccion_articulo').css('display', 'none');

                        var arrArtEncontrados = response;
                        for (var i = 0; i < arrArtEncontrados.length; i++) 
                        {
                            (function(i) 
                            {
                                var acodar = arrArtEncontrados[i].ACODAR.toLowerCase();
                                console.log('ACODAR: ' + '#table_list_articulo_' + acodar);
                                $('#table_list_articulo_' + acodar).css('display', 'table');
                            }(i));
                        }
                    }
                }
            });
        }

    }, 2000);
}

function cambiarImagenAnuncio(input) 
{
      if (input.files && input.files[0]) 
      {
        var reader = new FileReader();

        reader.onload = function(e) 
        {
              $('#img_foto_articulo_seleccionado').attr('src', e.target.result);

              $('#msj_aviso_resolucion').css('display', 'none');

            var destino = e.target.result;

            var tmpImg = new Image();
            tmpImg.src = destino;
            $(tmpImg).on('load',function()
            {
                var orgWidth = tmpImg.width;
                  var orgHeight = tmpImg.height;

                  console.log('Ancho -> ' + orgWidth + ' --- Alto -> ' + orgHeight);

                  if (orgWidth < 600 && orgHeight < 500)
                  {
                      $('#msj_aviso_resolucion').show(300);
                  }
            });
        }

        reader.readAsDataURL(input.files[0]);
      }
}

function buscadorDevoluciones()
{
    var txtBuscador = $('#devolbuscar').val();

    setTimeout(function()
    {
        if (txtBuscador == $('#devolbuscar').val())
        {
            if (txtBuscador == "")
            {
                $('.devoArtCodsTD').each(function()
                {
                    $(this).parent().parent().parent().css('display', 'table');
                });
            }
            else 
            {
                var contador = 0;
                var encontrado = false;

                $('.devoArtCodsTD').each(function()
                {
                    contador = parseInt(contador) + parseInt(1);

                    if (contador == 1)
                    {
                        var articulo = $(this).parent().parent().find(">:first-child").text();
                        articulo = articulo.toUpperCase(); 
                        txtBuscador = txtBuscador.toUpperCase(); 

                        if (articulo.indexOf(txtBuscador) > -1)
                        {
                            encontrado = true;
                        }
                    }
                    
                    var articulo = $(this).text();
                    articulo = articulo.toUpperCase(); 
                    txtBuscador = txtBuscador.toUpperCase(); 

                    if (articulo.indexOf(txtBuscador) > -1)
                    {
                        encontrado = true;
                    }

                    if (contador == 4)
                    {
                        if (encontrado)
                        {
                            $(this).parent().parent().parent().css('display', 'table');
                        }
                        else
                        {
                            $(this).parent().parent().parent().css('display', 'none');
                        }

                        contador = 0;
                        encontrado = false;
                    }
                });
            }
        }

    }, 1500);
}


function pulsarPlantillaAnuncio1()
{
    //pulsarArticuloParaAnuncio('Ordenador Lenovo M93P SFF GRADO B (Intel Core i3 4130T 2.9GHz/8GB/120SSD/DVDRW/W8P) Preinstalado', 99, '/xweb/public/fotobanners/art_6910lenm93p3gb_1 copia.png');

    $('#titulo_articulo_seleccionado').css('top', '28px');
    $('#titulo_articulo_seleccionado').css('left', '45px');
    $('#titulo_articulo_seleccionado').css('right', 'auto');

    $(".div_nombre_articulo:first-child").css('margin-bottom', '4px');
    $(".div_nombre_articulo:first-child").css('font-size', '18pt');
    $(".div_nombre_articulo:last-child").css('font-size', '23pt');

    $('#div_carac_text_articulo_seleccionado').css('top', '60px');
    $('#div_carac_text_articulo_seleccionado').css('left', '46px');
    $('#div_carac_text_articulo_seleccionado').css('right', 'auto');

    $('#panel_articulo_seleccionado').css('top', '242px');
    $('#panel_articulo_seleccionado').css('left', '327px');
    $('#panel_articulo_seleccionado').css('right', 'auto');

    $('.nombre_caract').css('color', '#ffffff');
    $('.nombre_caract').css('font-size', '15pt');

    $('.valor_caract').css('color', '#5fa4e4');
    $('.valor_caract').css('font-size', '15pt');

    $('#div_carac2_icon_articulo_seleccionado').css('top', '89px');
    $('#div_carac2_icon_articulo_seleccionado').css('left', '40px');
    $('#div_carac2_icon_articulo_seleccionado').css('right', 'auto');

    $('#div_carac2_icon_articulo_seleccionado img').css('max-width', '60px');
    $('#div_carac2_icon_articulo_seleccionado img').css('max-height', '60px');

    $('#panel_articulo_seleccionado').css('top', '228px');
    $('#panel_articulo_seleccionado').css('left', '405px');
    $('#panel_articulo_seleccionado').css('right', 'auto');

    $('#button_anadir_precio').trigger('click');
    mostrarPrecio2(1);

    $('#input_text_precio_anuncio').val('');
    escribirTextoPrecio('#input_text_precio_anuncio', 1)

    $('#div_precio_articulo_seleccionado').css('top', '140px');
    $('#div_precio_articulo_seleccionado').css('left', '40px');
    $('#div_precio_articulo_seleccionado').css('right', 'auto');

    $('#tachado_articulo_seleccionado').css('z-index', '9999');
    $('#tachado_articulo_seleccionado').css('font-size', '109pt');
    $('#precio_articulo_seleccionado').css('font-size', '109pt');
    $('#euro_articulo_seleccionado').css('font-size', '65.8pt');

    $('#img_foto_articulo_seleccionado').css('top', '75px');
    $('#img_foto_articulo_seleccionado').css('left', '385px');
    $('#img_foto_articulo_seleccionado').css('right', 'auto');
    $('#img_foto_articulo_seleccionado').css('max-width', '330px');
    $('#img_foto_articulo_seleccionado').css('max-height', '275px');

    var txtPanel = $('#input_dato_panel').val();
    
    setTimeout(function()
    {
        $('#div_panel_articulo_seleccionado').css({background: 'linear-gradient(hsl(209deg 72% 66%) 0%, hsl(209deg 61% 53%) 50%, hsl(209deg 67% 46%) 50%, hsl(209deg 57% 55%))'});
        $('#div_panel_articulo_seleccionado').css('border-radius', '5px');
        $('#div_panel_articulo_seleccionado').css('padding', '8px');
        $('#div_panel_articulo_seleccionado').css('border', '2px solid hsl(209deg 51% 64%)');

        $('#div_panel_articulo_seleccionado div').css('float', 'left');
        $('#div_panel_articulo_seleccionado div').css('margin-top', '-2px');

        $('#input_colore_fuente_anuncio').val('#2778c4');
        $('#input_colore_fuente_anuncio').trigger('change');

        $('#input_flecha_est1').trigger('click');

        if ($("#input_flecha_der").prop('checked') == false)
        {
            $('#input_flecha_der').trigger('click');
        }

        if ($("#input_flecha_arr").prop('checked') == false)
        {
            $('#input_flecha_arr').trigger('click');
        }

        if ($("#input_flecha_aba").prop('checked') == true)
        {
            $('#input_flecha_aba').trigger('click');
        }

        $('#div_img_flecha_panel').css('margin-top', '-3px');

    }, 2000);

    if (checkBrowser() == 'Firefox')
    {
        $('#div_precio_articulo_seleccionado').css('top', '124px');
        $('#panel_articulo_seleccionado').css('top', '236px');
    }

    $('#img_fondo_cartel_25').trigger('click');
}

function pulsarPlantillaAnuncio2()
{
    //pulsarArticuloParaAnuncio('Ordenador Lenovo M93P SFF GRADO B (Intel Core i3 4130T 2.9GHz/8GB/120SSD/DVDRW/W8P) Preinstalado', 99, '/xweb/public/fotobanners/art_6910lenm93p3gb_1 copia.png');

    setTimeout(function()
    {
        $('#titulo_articulo_seleccionado').css('top', '25px');
        $('#titulo_articulo_seleccionado').css('left', 'auto');
        $('#titulo_articulo_seleccionado').css('right', '40px');

        $('#input_colora_fuente_anuncio').val('#f1eff2');
        $('#input_colorb_fuente_anuncio').val('#f1eff2');
        $('#input_colorc_fuente_anuncio').val('#f7de98');
        $('#input_colore_fuente_anuncio').val('#ece2c6');

        $('#input_colora_fuente_anuncio').trigger('change');
        $('#input_colorb_fuente_anuncio').trigger('change');
        $('#input_colorc_fuente_anuncio').trigger('change');
        $('#input_colore_fuente_anuncio').trigger('change');

        $('#div_carac_text_articulo_seleccionado').css('top', '60px');
        $('#div_carac_text_articulo_seleccionado').css('left', 'auto');
        $('#div_carac_text_articulo_seleccionado').css('right', '27px');

        $('.nombre_caract').css('font-size', '12pt');
        $('.valor_caract').css('font-size', '12pt');

        $('#div_carac2_icon_articulo_seleccionado').css('top', '88px');
        $('#div_carac2_icon_articulo_seleccionado').css('left', 'auto');
        $('#div_carac2_icon_articulo_seleccionado').css('right', '34px');

        $('#div_carac2_icon_articulo_seleccionado img').css('max-width', '60px');
        $('#div_carac2_icon_articulo_seleccionado img').css('max-height', '60px');

        $('#input_text_precio_anuncio').val('3 UNIDADES');
        $('#input_text_precio_anuncio').trigger('input');

        $('#div_precio_articulo_seleccionado').css('top', '165px');
        $('#div_precio_articulo_seleccionado').css('left', 'auto');
        $('#div_precio_articulo_seleccionado').css('right', '49px');

        $('#tachado_articulo_seleccionado').css('z-index', '9999');
        $('#tachado_articulo_seleccionado').css('font-size', '84pt');
        $('#precio_articulo_seleccionado').css('font-size', '84pt');
        $('#euro_articulo_seleccionado').css('font-size', '50.8pt');

        $('#input_num_precios').val('3');
        $('#button_quitar_precio').trigger('click');

        $('#input_text_precio2_anuncio').val('1 UNIDAD');
        $('#input_text_precio2_anuncio').trigger('input');

        $('#div_precio2_articulo_seleccionado').css('top', '192px');
        $('#div_precio2_articulo_seleccionado').css('left', '259px');
        $('#div_precio2_articulo_seleccionado').css('right', 'auto');

        $('#tachado2_articulo_seleccionado').css('font-size', '65pt');
        $('#precio2_articulo_seleccionado').css('font-size', '65pt');
        $('#euro2_articulo_seleccionado').css('font-size', '39.4pt');

        $('#img_foto_articulo_seleccionado').css('top', '39px');
        $('#img_foto_articulo_seleccionado').css('left', '55px');
        $('#img_foto_articulo_seleccionado').css('right', 'auto');
        $('#img_foto_articulo_seleccionado').css('max-width', '380px');
        $('#img_foto_articulo_seleccionado').css('max-height', '178px');

    }, 1000);
    
    setTimeout(function()
    {
        $('#input_flecha_est1').trigger('click');

        if ($("#input_flecha_der").prop('checked') == false)
        {
            $('#input_flecha_der').trigger('click');
        }

        if ($("#input_flecha_arr").prop('checked') == false)
        {
            $('#input_flecha_arr').trigger('click');
        }

        if ($("#input_flecha_aba").prop('checked') == true)
        {
            $('#input_flecha_aba').trigger('click');
        }

        $(".div_nombre_articulo:first-child").css('margin-bottom', '1px');
        $(".div_nombre_articulo:first-child").css('font-size', '16pt');
        $(".div_nombre_articulo:last-child").css('font-size', '21pt');

        $('#panel_articulo_seleccionado').css('top', '234px');
        $('#panel_articulo_seleccionado').css('left', '22px');
        $('#panel_articulo_seleccionado').css('right', 'auto');

        $('#div_panel_articulo_seleccionado').css('border-radius', '5px');
        $('#div_panel_articulo_seleccionado').css('padding', '8px');
        $('#div_panel_articulo_seleccionado').css('background', 'linear-gradient(rgb(199, 169, 87) 0%, rgb(195, 163, 75) 50%, rgb(180, 148, 60) 50%, rgb(199 166 73))');
        $('#div_panel_articulo_seleccionado').css('border', '2px solid rgb(193 179 141)');

        $('#div_panel_articulo_seleccionado div').css('float', 'left');

        $('#div_img_flecha_panel').css('border', '1px solid rgba(142, 119, 54, 0.7)');
        $('#div_img_flecha_panel').css('margin-left', '3px');
        $('#div_img_flecha_panel').css('margin-right', '0px');
        $('#div_img_flecha_panel').css('margin-top', '-1px');
        $('#div_img_flecha_panel').css('border-radius', '20px');

        $('#div_img_flecha_panel i').css('border-radius', '20px');
        $('#div_img_flecha_panel i').css('background', 'rgb(142 119 54)');
        $('#div_img_flecha_panel i').css('margin-top', '-1px');
        $('#div_img_flecha_panel i').css('margin-left', '-3px');

        $('#txt_precio_articulo_seleccionado').css('text-align', 'right');
        $('#txt_precio_articulo_seleccionado span').css('font-size', '12pt');
        $('#txt_precio_articulo_seleccionado span').css('font-family', 'montserratbolditalic');

        $('#txt_precio2_articulo_seleccionado').css('text-align', 'right');
        $('#txt_precio2_articulo_seleccionado span').css('font-size', '10pt');
        $('#txt_precio2_articulo_seleccionado span').css('font-family', 'montserratbolditalic');

    }, 3000);

    $('#img_fondo_cartel_23').trigger('click');
}

function pulsarPlantillaAnuncio3()
{
    $('#titulo_articulo_seleccionado').css('top', '28px');
    $('#titulo_articulo_seleccionado').css('left', '45px');
    $('#titulo_articulo_seleccionado').css('right', 'auto');

    $('#input_colora_fuente_anuncio').val('#ffae00');
    $('#input_colorb_fuente_anuncio').val('#ffae00');
    $('#input_colorc_fuente_anuncio').val('#f3dd9f');
    $('#input_colore_fuente_anuncio').val('#d80c25');
    $('#input_colorf_fuente_anuncio').val('#770411');

    $('#input_colora_fuente_anuncio').trigger('change');
    $('#input_colorb_fuente_anuncio').trigger('change');
    $('#input_colorc_fuente_anuncio').trigger('change');
    $('#input_colore_fuente_anuncio').trigger('change');

    $(".div_nombre_articulo:first-child").css('font-size', '18pt');
    $(".div_nombre_articulo:last-child").css('font-size', '23pt');

    $('#div_carac_text_articulo_seleccionado').css('top', '60px');
    $('#div_carac_text_articulo_seleccionado').css('left', '46px');
    $('#div_carac_text_articulo_seleccionado').css('right', 'auto');

    $('.nombre_caract').css('font-size', '13pt');
    $('.valor_caract').css('font-size', '13pt');

    $('#div_carac2_icon_articulo_seleccionado').css('top', '88px');
    $('#div_carac2_icon_articulo_seleccionado').css('left', '40px');
    $('#div_carac2_icon_articulo_seleccionado').css('right', 'auto');

    $('#div_carac2_icon_articulo_seleccionado img').css('max-width', '60px');
    $('#div_carac2_icon_articulo_seleccionado img').css('max-height', '60px');

    mostrarPrecio2(1);

    $('#input_text_precio_anuncio').val('');
    $('#input_text_precio_anuncio').trigger('input');

    $('#div_precio_articulo_seleccionado').css('top', '125px');
    $('#div_precio_articulo_seleccionado').css('left', '40px');
    $('#div_precio_articulo_seleccionado').css('right', 'auto');

    $('#tachado_articulo_seleccionado').css('z-index', '9999');
    $('#tachado_articulo_seleccionado').css('font-size', '111pt');
    $('#precio_articulo_seleccionado').css('font-size', '111pt');
    $('#euro_articulo_seleccionado').css('font-size', '67pt');

    $('#img_foto_articulo_seleccionado').css('top', '15px');
    $('#img_foto_articulo_seleccionado').css('left', '372px');
    $('#img_foto_articulo_seleccionado').css('right', 'auto');
    $('#img_foto_articulo_seleccionado').css('max-width', '460px');
    $('#img_foto_articulo_seleccionado').css('max-height', '256px');

    var txtPanel = $('#input_dato_panel').val();
    
    setTimeout(function()
    {
        $('#input_flecha_est2').trigger('click');

        if ($("#input_flecha_der").prop('checked') == false)
        {
            $('#input_flecha_der').trigger('click');
        }

        if ($("#input_flecha_arr").prop('checked') == false)
        {
            $('#input_flecha_arr').trigger('click');
        }

        if ($("#input_flecha_aba").prop('checked') == true)
        {
            $('#input_flecha_aba').trigger('click');
        }

        $('#panel_articulo_seleccionado').css('top', '234px');
        $('#panel_articulo_seleccionado').css('left', '382px');
        $('#panel_articulo_seleccionado').css('right', 'auto');

        $('#div_panel_articulo_seleccionado').css('padding', '8px');
        $('#div_panel_articulo_seleccionado').css('border', 'none');

        $('#div_panel_articulo_seleccionado div').css('float', 'left');

        $('#div_img_flecha_panel').css('margin-left', '3px');
        $('#div_img_flecha_panel').css('margin-right', '0px');
        $('#div_img_flecha_panel').css('margin-top', '-1px');

        $('#div_img_flecha_panel img').css('width', '8px');
        $('#div_img_flecha_panel img').css('margin-top', '4px');

        if (checkBrowser() == 'Firefox')
        {
            $('#div_precio_articulo_seleccionado').css('top', '122px');
            $('#panel_articulo_seleccionado').css('top', '244px');
        }


    }, 2000);

    $('#img_fondo_cartel_24').trigger('click');
}

function pulsarPlantillaAnuncio4()
{
    setTimeout(function()
    {
        $('#titulo_articulo_seleccionado').css('top', '25px');
        $('#titulo_articulo_seleccionado').css('left', 'auto');
        $('#titulo_articulo_seleccionado').css('right', '40px');

        $('#input_colora_fuente_anuncio').val('#f1eff2');
        $('#input_colorb_fuente_anuncio').val('#f1eff2');
        $('#input_colorc_fuente_anuncio').val('#ffffff');
        $('#input_colore_fuente_anuncio').val('#ece2c6');

        $('#input_colora_fuente_anuncio').trigger('change');
        $('#input_colorb_fuente_anuncio').trigger('change');
        $('#input_colorc_fuente_anuncio').trigger('change');
        $('#input_colore_fuente_anuncio').trigger('change');

        $('#div_carac_text_articulo_seleccionado').css('top', '60px');
        $('#div_carac_text_articulo_seleccionado').css('left', 'auto');
        $('#div_carac_text_articulo_seleccionado').css('right', '27px');

        $('.nombre_caract').css('font-size', '14pt');
        $('.valor_caract').css('font-size', '14pt');

        $('#div_carac2_icon_articulo_seleccionado').css('top', '88px');
        $('#div_carac2_icon_articulo_seleccionado').css('left', 'auto');
        $('#div_carac2_icon_articulo_seleccionado').css('right', '34px');

        $('#div_carac2_icon_articulo_seleccionado img').css('max-width', '65px');
        $('#div_carac2_icon_articulo_seleccionado img').css('max-height', '65px');

        mostrarPrecio2(1);

        $('#input_text_precio_anuncio').val('');
        $('#input_text_precio_anuncio').trigger('input');

        $('#div_precio_articulo_seleccionado').css('top', '150px');
        $('#div_precio_articulo_seleccionado').css('left', 'auto');
        $('#div_precio_articulo_seleccionado').css('right', '50px');

        $('#tachado_articulo_seleccionado').css('z-index', '9999');
        $('#tachado_articulo_seleccionado').css('font-size', '94pt');
        $('#precio_articulo_seleccionado').css('font-size', '94pt');
        $('#euro_articulo_seleccionado').css('font-size', '56.8pt');

        $('#img_foto_articulo_seleccionado').css('top', '65px');
        $('#img_foto_articulo_seleccionado').css('left', '55px');
        $('#img_foto_articulo_seleccionado').css('right', 'auto');
        $('#img_foto_articulo_seleccionado').css('max-width', '330px');
        $('#img_foto_articulo_seleccionado').css('max-height', '185px');

    }, 1000);
    
    setTimeout(function()
    {
        $('#input_flecha_est1').trigger('click');

        if ($("#input_flecha_izq").prop('checked') == false)
        {
            $('#input_flecha_izq').trigger('click');
        }

        if ($("#input_flecha_arr").prop('checked') == false)
        {
            $('#input_flecha_arr').trigger('click');
        }

        if ($("#input_flecha_aba").prop('checked') == true)
        {
            $('#input_flecha_aba').trigger('click');
        }

        $('#panel_articulo_seleccionado').css('top', '231px');
        $('#panel_articulo_seleccionado').css('left', '166px');
        $('#panel_articulo_seleccionado').css('right', 'auto');

        $('#div_panel_articulo_seleccionado').css('border-radius', '5px');
        $('#div_panel_articulo_seleccionado').css('padding', '8px');
        $('#div_panel_articulo_seleccionado').css('background', 'linear-gradient(#23d9fe 0%, #1cbefe 50%, #0fabff 50%, #66cfff)');
        $('#div_panel_articulo_seleccionado').css('border', '2px solid rgb(128, 232, 255)');
        $('#div_panel_articulo_seleccionado').css('font-size', '11pt');

        $('#div_panel_articulo_seleccionado div').css('float', 'right');

        $('#div_img_flecha_panel').css('border', '1px solid rgba(0, 104, 128, 0.5)');
        $('#div_img_flecha_panel').css('margin-left', '0px');
        $('#div_img_flecha_panel').css('margin-right', '3px');
        $('#div_img_flecha_panel').css('margin-top', '0px');
        $('#div_img_flecha_panel').css('border-radius', '20px');
        $('#div_img_flecha_panel').css('font-size', '12pt');

        $('#div_img_flecha_panel i').css('border-radius', '20px');
        $('#div_img_flecha_panel i').css('background', 'rgb(0, 104, 128)');
        $('#div_img_flecha_panel i').css('margin-top', '-1px');
        $('#div_img_flecha_panel i').css('margin-left', '-3px');

    }, 3000);

    $('#img_fondo_cartel_30').trigger('click');
}

function pulsarPlantillaAnuncio5()
{
    setTimeout(function()
    {
        $('#titulo_articulo_seleccionado').css('top', '25px');
        $('#titulo_articulo_seleccionado').css('left', '45px');
        $('#titulo_articulo_seleccionado').css('right', 'auto');

        $('#input_colora_fuente_anuncio').val('#f1eff2');
        $('#input_colorb_fuente_anuncio').val('#f1eff2');
        $('#input_colorc_fuente_anuncio').val('#d625bd');
        $('#input_colore_fuente_anuncio').val('#d625bd');
        $('#input_colorf_fuente_anuncio').val('#6b1e9e');

        $('#input_colora_fuente_anuncio').trigger('change');
        $('#input_colorb_fuente_anuncio').trigger('change');
        $('#input_colorc_fuente_anuncio').trigger('change');
        $('#input_colore_fuente_anuncio').trigger('change');

        $('#div_carac_text_articulo_seleccionado').css('top', '60px');
        $('#div_carac_text_articulo_seleccionado').css('left', '46px');
        $('#div_carac_text_articulo_seleccionado').css('right', 'auto');

        $('.nombre_caract').css('font-size', '12pt');
        $('.valor_caract').css('font-size', '12pt');

        $('#div_carac2_icon_articulo_seleccionado').css('top', '88px');
        $('#div_carac2_icon_articulo_seleccionado').css('left', '40px');
        $('#div_carac2_icon_articulo_seleccionado').css('right', 'auto');

        $('#div_carac2_icon_articulo_seleccionado img').css('max-width', '60px');
        $('#div_carac2_icon_articulo_seleccionado img').css('max-height', '60px');

        $('#div_carac3_text_articulo_seleccionado').css('left', '670px');
        $('#div_carac3_text_articulo_seleccionado').css('top', '118px');

        $('#input_text_precio_anuncio').val('AL COMPRAR 3 UNIDADES');
        $('#input_text_precio_anuncio').trigger('input');

        $('#div_precio_articulo_seleccionado').css('top', '165px');
        $('#div_precio_articulo_seleccionado').css('left', '40px');
        $('#div_precio_articulo_seleccionado').css('right', 'auto');

        $('#tachado_articulo_seleccionado').css('z-index', '9999');
        $('#tachado_articulo_seleccionado').css('font-size', '84pt');
        $('#precio_articulo_seleccionado').css('font-size', '84pt');
        $('#euro_articulo_seleccionado').css('font-size', '50.8pt');

        $('#input_num_precios').val('3');
        $('#button_quitar_precio').trigger('click');

        $('#input_text_precio2_anuncio').val('AL COMPRAR 1 UNIDAD');
        $('#input_text_precio2_anuncio').trigger('input');

        $('#div_precio2_articulo_seleccionado').css('top', '127px');
        $('#div_precio2_articulo_seleccionado').css('left', '300px');
        $('#div_precio2_articulo_seleccionado').css('right', 'auto');

        $('#tachado2_articulo_seleccionado').css('font-size', '65pt');
        $('#precio2_articulo_seleccionado').css('font-size', '65pt');
        $('#euro2_articulo_seleccionado').css('font-size', '39.4pt');

        $('#img_foto_articulo_seleccionado').css('top', '85px');
        $('#img_foto_articulo_seleccionado').css('left', '400px');
        $('#img_foto_articulo_seleccionado').css('right', 'auto');
        $('#img_foto_articulo_seleccionado').css('max-width', '380px');
        $('#img_foto_articulo_seleccionado').css('max-height', '212.5px');

    }, 1000);
    
    setTimeout(function()
    {
        $('#input_flecha_est2').trigger('click');

        if ($("#input_flecha_der").prop('checked') == false)
        {
            $('#input_flecha_der').trigger('click');
        }

        if ($("#input_flecha_arr").prop('checked') == true)
        {
            $('#input_flecha_arr').trigger('click');
        }

        if ($("#input_flecha_aba").prop('checked') == true)
        {
            $('#input_flecha_aba').trigger('click');
        }

        $(".div_nombre_articulo:first-child").css('margin-top', '8px');
        $(".div_nombre_articulo:first-child").css('font-size', '16pt');
        $(".div_nombre_articulo:last-child").css('font-size', '20pt');
        $(".div_nombre_articulo:last-child").css('margin-bottom', '-1px');

        $('#panel_articulo_seleccionado').css('top', '242px');
        $('#panel_articulo_seleccionado').css('left', '327px');
        $('#panel_articulo_seleccionado').css('right', 'auto');

        $('#div_panel_articulo_seleccionado').css('padding', '8px');
        $('#div_panel_articulo_seleccionado').css('font-size', '11pt');
        $('#div_panel_articulo_seleccionado').css('height', '9px');
        $('#div_panel_articulo_seleccionado').css('border', 'none');
        $('#div_panel_articulo_seleccionado div').css('color', '#e2e2e2');

        $('#div_img_flecha_panel').css('margin-left', '3px');
        $('#div_img_flecha_panel').css('margin-right', '0px;');
        $('#div_img_flecha_panel').css('margin-top', '-8px;');

        $('#div_img_flecha_panel i').css('width', '8px');
        $('#div_img_flecha_panel i').css('margin-top', '4px');

        $('#txt_precio_articulo_seleccionado').css('text-align', 'left');
        $('#txt_precio_articulo_seleccionado span').css('font-size', '12pt');
        $('#txt_precio_articulo_seleccionado span').css('color', '#ffffff');

        $('#txt_precio2_articulo_seleccionado').css('text-align', 'left');
        $('#txt_precio2_articulo_seleccionado span').css('font-size', '10pt');
        $('#txt_precio2_articulo_seleccionado span').css('color', '#ffffff');

    }, 3000);

    $('#img_fondo_cartel_29').trigger('click');
}

function renderizarImagen()
{
    var node = document.getElementById('div_anuncio_generado');

    var scale = 1;
    domtoimage.toBlob(node, {
        width: node.clientWidth * scale,
        height: node.clientHeight * scale,
        style: {
        transform: 'scale('+scale+')',
        transformOrigin: 'top left'
         }
    })
    .then(function (blob) {

        blobToDataURL(blob, function(dataurl){
            window.saveAs(blob, 'Anuncio.png');
        });
    });
}

function blobToDataURL(blob, callback) {
    var a = new FileReader();
    a.onload = function(e) {callback(e.target.result);}
    a.readAsDataURL(blob);
}

function checkBrowser()
{
    let browser = "";
    let c = navigator.userAgent.search("Chrome");
    let f = navigator.userAgent.search("Firefox");
    let m8 = navigator.userAgent.search("MSIE 8.0");
    let m9 = navigator.userAgent.search("MSIE 9.0");
    if (c > -1) {
        browser = "Chrome";
    } else if (f > -1) {
        browser = "Firefox";
    } else if (m9 > -1) {
        browser ="MSIE 9.0";
    } else if (m8 > -1) {
        browser ="MSIE 8.0";
    }
    return browser;
}

function cambiosEnFirefox(tiempo)
{
    var colorA = $('#input_colora_fuente_anuncio').val();
    var colorD = $('#input_colord_fuente_anuncio').val();

    setTimeout(function()
    {
        var colorA = $('#input_colora_fuente_anuncio').val();

        const r1 = parseInt(colorA.substr(1,2), 16);
        const g1 = parseInt(colorA.substr(3,2), 16);
        const b1 = parseInt(colorA.substr(5,2), 16);

        var h1 = rgbToHsl(r1, g1, b1);
        var s1 = rgbToHsl2(r1, g1, b1);
        var l1 = rgbToHsl3(r1, g1, b1);

        if (l1 > 30)
        {
            var l2 = l1 - 30;
        }
        else
        {
            var l2 = l1;
        }



        var colorD = $('#input_colord_fuente_anuncio').val();

        const r3 = parseInt(colorD.substr(1,2), 16);
        const g3 = parseInt(colorD.substr(3,2), 16);
        const b3 = parseInt(colorD.substr(5,2), 16);

        var h3 = rgbToHsl(r3, g3, b3);
        var s3 = rgbToHsl2(r3, g3, b3);
        var l3 = rgbToHsl3(r3, g3, b3);

        if (l3 > 30)
        {
            var l4 = l3 - 30;
        }
        else
        {
            var l4 = l3;
        }




        $('.div_nombre_articulo').css('color', colorA);
        $('.div_nombre_articulo').css('background', 'linear-gradient(to bottom, hsl(' + h1 + ' ' + s1 + '% ' + l1 + '%) 50%, hsl(' + h1 + ' ' + s1 + '% ' + l2 + '%) 100%)');
        $('.div_nombre_articulo').css('background-clip', 'border-box');
        $('.div_nombre_articulo').css('-webkit-background-clip', 'text');
        $('.div_nombre_articulo').css('-webkit-text-fill-color', 'transparent');
        $('.div_nombre_articulo').css('text-shadow', 'none');
        $('.div_nombre_articulo').css('filter', 'drop-shadow(rgb(255, 255, 255) 1px 0px 0px) drop-shadow(rgb(0, 0, 0) 1px 0px 4px)');

        $('#grafica_articulo_seleccionado').css('color', colorA);
        $('#grafica_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h1 + ' ' + s1 + '% ' + l1 + '%) 50%, hsl(' + h1 + ' ' + s1 + '% ' + l2 + '%) 100%)');
        $('#grafica_articulo_seleccionado').css('background-clip', 'border-box');
        $('#grafica_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#grafica_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#grafica_articulo_seleccionado').css('text-shadow', 'none');
        $('#grafica_articulo_seleccionado').css('filter', 'drop-shadow(rgb(255, 255, 255) 1px 0px 0px) drop-shadow(rgb(0, 0, 0) 1px 0px 4px)');


        $('#tachado_articulo_seleccionado').css('color', colorD);
        $('#precio_articulo_seleccionado').css('color', colorD);
        $('#precio_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h3 + ' ' + s3 + '% ' + l3 + '%) 50%, hsl(' + h3 + ' ' + s3 + '% ' + l4 + '%) 100%)');
        $('#precio_articulo_seleccionado').css('background-clip', 'border-box');
        $('#precio_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#precio_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#precio_articulo_seleccionado').css('text-shadow', 'none');
        $('#precio_articulo_seleccionado').css('filter', 'drop-shadow(1px -2px 0px rgb(255 255 255)) drop-shadow(2px 2px 6px #000000)');
        $('#precio_articulo_seleccionado').css('padding-right', '5px');
        $('#precio_articulo_seleccionado').css('font-style', 'normal');

        $('#euro_articulo_seleccionado').css('color', colorD);
        $('#euro_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h3 + ' ' + s3 + '% ' + l3 + '%) 50%, hsl(' + h3 + ' ' + s3 + '% ' + l4 + '%) 100%)');
        $('#euro_articulo_seleccionado').css('background-clip', 'border-box');
        $('#euro_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#euro_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#euro_articulo_seleccionado').css('text-shadow', 'none');
        $('#euro_articulo_seleccionado').css('filter', 'drop-shadow(1px -2px 0px rgb(255 255 255)) drop-shadow(2px 2px 6px #000000)');
        $('#euro_articulo_seleccionado').css('padding-right', '5px');



        $('#tachado3_articulo_seleccionado').css('color', colorD);
        $('#precio2_articulo_seleccionado').css('color', colorD);
        $('#precio2_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h3 + ' ' + s3 + '% ' + l3 + '%) 50%, hsl(' + h3 + ' ' + s3 + '% ' + l4 + '%) 100%)');
        $('#precio2_articulo_seleccionado').css('background-clip', 'border-box');
        $('#precio2_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#precio2_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#precio2_articulo_seleccionado').css('text-shadow', 'none');
        $('#precio2_articulo_seleccionado').css('filter', 'drop-shadow(1px -2px 0px rgb(255 255 255)) drop-shadow(2px 2px 6px #000000)');
        $('#precio2_articulo_seleccionado').css('padding-right', '5px');
        $('#precio2_articulo_seleccionado').css('font-style', 'normal');

        $('#euro2_articulo_seleccionado').css('color', colorD);
        $('#euro2_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h3 + ' ' + s3 + '% ' + l3 + '%) 50%, hsl(' + h3 + ' ' + s3 + '% ' + l4 + '%) 100%)');
        $('#euro2_articulo_seleccionado').css('background-clip', 'border-box');
        $('#euro2_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#euro2_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#euro2_articulo_seleccionado').css('text-shadow', 'none');
        $('#euro2_articulo_seleccionado').css('filter', 'drop-shadow(1px -2px 0px rgb(255 255 255)) drop-shadow(2px 2px 6px #000000)');
        $('#euro2_articulo_seleccionado').css('padding-right', '5px');




        $('#tachado3_articulo_seleccionado').css('color', colorD);
        $('#precio3_articulo_seleccionado').css('color', colorD);
        $('#precio3_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h3 + ' ' + s3 + '% ' + l3 + '%) 50%, hsl(' + h3 + ' ' + s3 + '% ' + l4 + '%) 100%)');
        $('#precio3_articulo_seleccionado').css('background-clip', 'border-box');
        $('#precio3_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#precio3_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#precio3_articulo_seleccionado').css('text-shadow', 'none');
        $('#precio3_articulo_seleccionado').css('filter', 'drop-shadow(1px -2px 0px rgb(255 255 255)) drop-shadow(2px 2px 6px #000000)');
        $('#precio3_articulo_seleccionado').css('padding-right', '5px');
        $('#precio3_articulo_seleccionado').css('font-style', 'normal');

        $('#euro3_articulo_seleccionado').css('color', colorD);
        $('#euro3_articulo_seleccionado').css('background', 'linear-gradient(to bottom, hsl(' + h3 + ' ' + s3 + '% ' + l3 + '%) 50%, hsl(' + h3 + ' ' + s3 + '% ' + l4 + '%) 100%)');
        $('#euro3_articulo_seleccionado').css('background-clip', 'border-box');
        $('#euro3_articulo_seleccionado').css('-webkit-background-clip', 'text');
        $('#euro3_articulo_seleccionado').css('-webkit-text-fill-color', 'transparent');
        $('#euro3_articulo_seleccionado').css('text-shadow', 'none');
        $('#euro3_articulo_seleccionado').css('filter', 'drop-shadow(1px -2px 0px rgb(255 255 255)) drop-shadow(2px 2px 6px #000000)');
        $('#euro3_articulo_seleccionado').css('padding-right', '5px');




        $('#txt_precio_articulo_seleccionado').css('margin-bottom', '-20px');
        $('#txt_precio2_articulo_seleccionado').css('margin-bottom', '-20px');
        $('#txt_precio3_articulo_seleccionado').css('margin-bottom', '-20px');

        $('#input_colora_fuente_anuncio').css("cssText", "width: 40px !important");
        $('#input_colorb_fuente_anuncio').css("cssText", "width: 40px !important");
        $('#input_colorc_fuente_anuncio').css("cssText", "width: 40px !important");
        $('#input_colord_fuente_anuncio').css("cssText", "width: 40px !important");
        $('#input_colore_fuente_anuncio').css("cssText", "width: 40px !important");
        $('#input_colorf_fuente_anuncio').css("cssText", "width: 40px !important");

    }, tiempo);
}

function rgbToHsl(r, g, b) 
{
    var oldR = r;
    var oldG = g;
    var oldB = b;

    r = parseFloat(r) / 255;
    g = parseFloat(g) / 255;
    b = parseFloat(b) / 255;

    var max = Math.max(r, g, b);
    var min = Math.min(r, g, b);

    var h;
    var s;
    var l = (parseFloat(max) + parseFloat(min)) / 2;
    var d = parseFloat(max) - parseFloat(min);

    if (d == 0 )
    {
        h = s = 0; // achromatic
    } 
    else 
    {
        s = parseFloat(d) / (1 - Math.abs(2 * parseFloat(l) - 1 ));

        if (max == r)
        {
            var formData = new FormData();
            formData.append('g', g);
            formData.append('b', b);
            formData.append('d', d);

            $.ajax({
                url: '/xweb/accionFmod/' + g + '/' + b + '/' + d, 
                type: 'get',
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log('FMOD -> ' + '(' + g + ' - ' + b + ')' + '/' +  d  + ' = ' + response);
                    h = 60 * response;
                    if (b > g) 
                    {
                        h += 360;
                    }
                }
            });
        }
        else if (max == g)
        {
            h = 60 * ( ( parseFloat(b) - parseFloat(r) ) / parseFloat(d) + 2 ); 
        }
        else if (max == b)
        {
            h = 60 * ( ( parseFloat(r) - parseFloat(g) ) / parseFloat(d) + 4 ); 
        }                                
    }

    return Math.round(parseFloat(h), 2);
}

function rgbToHsl2(r, g, b) 
{
    var oldR = r;
    var oldG = g;
    var oldB = b;

    r = parseFloat(r) / 255;
    g = parseFloat(g) / 255;
    b = parseFloat(b) / 255;

    var max = Math.max(r, g, b);
    var min = Math.min(r, g, b);

    var h;
    var s;
    var l = (parseFloat(max) + parseFloat(min)) / 2;
    var d = parseFloat(max) - parseFloat(min);

    if (d == 0 )
    {
        h = s = 0; // achromatic
    } 
    else 
    {
        s = parseFloat(d) / (1 - Math.abs(2 * parseFloat(l) - 1 ));

        if (max == r)
        {
            var formData = new FormData();
            formData.append('g', g);
            formData.append('b', b);
            formData.append('d', d);

            $.ajax({
                url: '/xweb/accionFmod/' + g + '/' + b + '/' + d, 
                type: 'get',
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log('FMOD -> ' + '(' + g + ' - ' + b + ')' + '/' +  d  + ' = ' + response);
                    h = 60 * response;
                    if (b > g) 
                    {
                        h += 360;
                    }
                }
            });
        }
        else if (max == g)
        {
            h = 60 * ( ( parseFloat(b) - parseFloat(r) ) / parseFloat(d) + 2 ); 
        }
        else if (max == b)
        {
            h = 60 * ( ( parseFloat(r) - parseFloat(g) ) / parseFloat(d) + 4 ); 
        }                                
    }

    s = parseFloat(s) * 100;

    return Math.round(parseFloat(s), 2 );
}

function rgbToHsl3(r, g, b) 
{
    var oldR = r;
    var oldG = g;
    var oldB = b;

    r = parseFloat(r) / 255;
    g = parseFloat(g) / 255;
    b = parseFloat(b) / 255;

    var max = Math.max(r, g, b);
    var min = Math.min(r, g, b);

    var h;
    var s;
    var l = (parseFloat(max) + parseFloat(min)) / 2;
    var d = parseFloat(max) - parseFloat(min);

    if (d == 0 )
    {
        h = s = 0; // achromatic
    } 
    else 
    {
        s = parseFloat(d) / (1 - Math.abs(2 * parseFloat(l) - 1 ));

        if (max == r)
        {
            var formData = new FormData();
            formData.append('g', g);
            formData.append('b', b);
            formData.append('d', d);

            $.ajax({
                url: '/xweb/accionFmod/' + g + '/' + b + '/' + d, 
                type: 'get',
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log('FMOD -> ' + '(' + g + ' - ' + b + ')' + '/' +  d  + ' = ' + response);
                    h = 60 * response;
                    if (b > g) 
                    {
                        h += 360;
                    }
                }
            });
        }
        else if (max == g)
        {
            h = 60 * ( ( parseFloat(b) - parseFloat(r) ) / parseFloat(d) + 2 ); 
        }
        else if (max == b)
        {
            h = 60 * ( ( parseFloat(r) - parseFloat(g) ) / parseFloat(d) + 4 ); 
        }                                
    }

    l = parseFloat(l) * 100;

    return Math.round(parseFloat(l), 2 );
}

function mostrarElementoCartel(elemento)
{
    if ($(elemento).css('display') == 'none')
    {
        $(elemento).css('display', 'table-cell');
    }
    else
    {
        $(elemento).css('display', 'none');
    }
}

function editarTextoCartel(elemento, elemento2)
{
    var txtElemento = $(elemento).val();

    setTimeout(function()
    {
        if (txtElemento == $(elemento).val())
        {
            $(elemento2).empty();
            $(elemento2).html(txtElemento);
        }

    }, 2000);
}

function readURLLogoCartel(input) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function(e) 
        {
            $('#img_logo_cartel').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function cambiarColorTextoCartel()
{
    var color = $('#input_cartel_color1').val();

    setTimeout(function()
    {
        if (color == $('#input_cartel_color1').val())
        {
            $('#div_cartel_tienda').css('color', color);
            $('#div_cartel_web').css('color', color);
            $('#div_cartel_tlfno').css('color', color);
        }

    }, 2000);
}

function generarCartel()
{
    var node = document.getElementById('div_anuncio_generado');

    var scale = 1;
    domtoimage.toBlob(node, {
        width: node.clientWidth * scale,
        height: node.clientHeight * scale,
        style: {
        transform: 'scale('+scale+')',
        transformOrigin: 'top left'
         }
    })
    .then(function (blob) {
        window.saveAs(blob, 'Cartel-Technoocasion.png');
    });
}

function marcarFavorito(ccodcl, acodar, favorito, elemento)
{
    $.ajax({
        url: '/xweb/marcarfavorito/' + ccodcl + '/' + acodar + '/' + favorito,
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response) {

            if (favorito == 0)
            {
                $('#celdaFavIcon' + acodar).attr('src', '/xweb/public/images/fav1.png');
                $('#celdaFavIcon' + acodar).attr("onclick", "marcarFavorito(" + ccodcl + ", '" + acodar + "', 1)");
                $('#celdaFavGuardado' + acodar).text('Guardado en favoritos');
                $(elemento).attr('src', '/xweb/public/images/fav1.png');
            }
            else 
            {
                $('#celdaFavIcon' + acodar).attr('src', '/xweb/public/images/fav0.png');
                $('#celdaFavIcon' + acodar).attr("onclick", "marcarFavorito(" + ccodcl + ", '" + acodar + "', 0)");
                $('#celdaFavGuardado' + acodar).text('Quitado de favoritos');
                $(elemento).attr('src', '/xweb/public/images/fav0.png');
            }
        }
    });
}

function scrollArticulos(elemento)
{
    if (elemento.scrollHeight - elemento.scrollTop - elemento.clientHeight <= 0) 
    {
        let numArtMostrados = document.getElementById('num_art_mostrados').value;
        numArtMostrados = parseInt(numArtMostrados) + 10;
        mostrarArticulos(numArtMostrados);
    }
}

function seleccionar_todo_csv() 
{ 
    for (i=0;i<document.formliquidaciones.elements.length;i++)
    {
        if(document.formliquidaciones.elements[i].type == "checkbox")
        {
            document.formliquidaciones.elements[i].checked=1;
        }
    }
}

function deseleccionar_todo_csv() 
{ 
    for (i=0;i<document.formliquidaciones.elements.length;i++)
    {
        if(document.formliquidaciones.elements[i].type == "checkbox")
        {
            document.formliquidaciones.elements[i].checked=0;
        }
    }
}

function muestraDocumentos(numero)
{
    if(numero == 1)
    {
        document.getElementById("contenido_img1").style.display = "block";
    }
}

function pulsarSubirFotoTicket()
{
    $('#input_subir_foto').trigger('click');
}

function pulsarSubirFotoAdmin()
{
    $('#input_subir_foto_admin').trigger('click');
}

function cambiarSubirFotoAdmin()
{
    $("#icon_subir_foto").attr("src", "/xweb/public/images/check_ok.png");
}

function pulsarSubirFotoMens(elemento)
{
    $(elemento).parent().find('.input_subir_foto_mens').trigger('click');
}

function cambiarSubirFotoMens(elemento)
{
    $(elemento).parent().find('.img_subir_foto').attr("src", "/xweb/public/images/check_ok.png");
}

function clickarImgMensaje(elemento)
{
    $(elemento).css('display', 'block');
}

function cerrarImgMensaje(elemento)
{
    $(elemento).css('display', 'none');
}

function devolSel(valorSel, tipoDeRma, codigocli, dif)
{
    if (tipoDeRma != "RMA")
    {
        document.getElementById("rreparar1").checked = false;
        document.getElementById("rreparar2").checked = false;
    }
    console.log("t1");
    if ( ( tipoDeRma == "DOA" && dif >= 3 && (valorSel >= 55 && valorSel <= 63) ) && codigocli != 47  && codigocli != 5451 )
    {console.log("t2");
        document.getElementById("textoaviso").innerHTML = "<b>No se admitir\u00E1n reclamaciones relacionadas con roturas o da\u00F1os est\u00E9ticos exteriores despu\u00E9s de las 48 horas desde la recepci\u00F3n del pedido.</b>";
        document.getElementById("textoaviso").style.display = "block";
        document.getElementById("solicitudadd").style.display = "none";
        document.getElementById("rmarepararoabonar").style.display = "none";
        //document.getElementById("devolArticulosObs2").style.visibility = "hidden";
        document.getElementById("textocomentario").style.visibility = "hidden";
        document.getElementById("devolObs").style.display = "none";
    }    
    else if ( valorSel == 26 && dif > 182 )
    {console.log("t3");
        document.getElementById("textoaviso").innerHTML = "<b>No se admitir\u00E1n reclamaciones relacionadas con bater\u00CDas despu\u00E9s de 6 meses de la compra.</b>";
        document.getElementById("textoaviso").style.display = "block";
        document.getElementById("solicitudadd").style.display = "none";
        document.getElementById("rmarepararoabonar").style.display = "none";
        document.getElementById("devolArticulosObs2").style.visibility = "visible";
        document.getElementById("pregunta").style.display = "none";
    }
    else
    {console.log("t4");
        //document.getElementById("rmarepararoabonar").style.display = "block";    // 1234
        document.getElementById("solicitudadd").style.display = "block";
        if (valorSel == 13 || valorSel == 31 || valorSel == 38 || valorSel == 39)
        {console.log("t4.1");
            document.getElementById("textocomentario").innerHTML = "<b>Indique claramente el fallo:</b> <br /><span style='font-size: 9pt; color: #376696; font-weight: bold; display: inline-block; margin-top: 5px;'>Descripciones como \"No funciona\" o \"no va\" no se admitir\u00E1n como v\u00E1lidas</span>";
        }
        else { document.getElementById("textocomentario").innerHTML = "Comentario adicional:"; }

        if (valorSel == '0') { document.getElementById("devolArticulosObs2").style.visibility = "hidden"; }
        else { document.getElementById("devolArticulosObs2").style.visibility = "visible"; }

        // Solo pieza
        //if (valorSel == 3 || valorSel == 4 || valorSel == 12 || valorSel == 17 || valorSel == 18 || valorSel == 19 || valorSel == 20 || valorSel == 26 || valorSel == 29 || valorSel == 30 || valorSel == 35 || valorSel == 37 || valorSel == 64 || valorSel == 73 || valorSel == 74 || valorSel == 75 || valorSel == 76 )
        if (false)
        {console.log("t4.2");
            averiaTipoSoloPieza = true;
            document.getElementById("rmarepararoabonar").style.display = "block";

            /*document.getElementById("textoaviso").innerHTML = "<div style='font-size: 9pt;'><div style='font-weight: bold;'>\u00BFQu\u00E9 soluci\u00F3n prefiere?</div><br /><div ><input type='radio' name='pieza' id='pieza1' value='1' onclick='' onchange='preguntaDevolver();' /> Reposici\u00F3n de la pieza (recuerde que deber\u00E1 enviar la pieza defectuosa en un plazo no superior a 15 d\u00CDas)</div> <br /> <div><input type='radio' name='pieza' id='pieza0' value='0' checked onchange='preguntaDevolver();' /> Env\u00CDo de la m\u00E1quina completa </div> </div>";*/

            document.getElementById("textoaviso").innerHTML = "<div class='devolPreg' id='devolPreg1' ><div style='font-weight: bold;'>\u00BFQu\u00E9 soluci\u00F3n prefiere?</div><div ><input type='radio' name='pieza' id='pieza1' value='1' onclick='soloPiezaAviso()' onchange='preguntaDevolver();' /> Reposici\u00F3n de la pieza</div> <div><input type='radio' name='pieza' id='pieza0' value='0' onchange='preguntaDevolver();' /> Env\u00CDo de la m\u00E1quina completa </div> </div>";
            document.getElementById("textoaviso").style.display = "block";
            document.getElementById("textoaviso").style.color = "black";

        }
        else
        {console.log("t4.3");
            document.getElementById("textoaviso").style.display = "none";
            
            if (tipoDeRma != "RMA")
            {
                document.getElementById("rmarepararoabonar").style.display = "block";
            }
            
        }

        if ( tipoDeRma == "RMA" )
        {console.log("t5");
            document.getElementById("textoaviso").style.display = "none";
            //document.getElementById("rmarepararoabonar").style.visibility = "hidden";
            if (tipoDeRma != "RMA")
            {
                document.getElementById("rmarepararoabonar").style.display = "none";
                document.getElementById("rreparar1").checked = true;
                document.getElementById("rreparar2").checked = false;
            }
            

            // Solo pieza
            //if (valorSel == 3 || valorSel == 4 || valorSel == 12 || valorSel == 17 || valorSel == 18 || valorSel == 19 || valorSel == 20 || valorSel == 26 || valorSel == 29 || valorSel == 30 || valorSel == 35 || valorSel == 37 || valorSel == 64 || valorSel == 73 || valorSel == 74 || valorSel == 75 || valorSel == 76 )
            if (false)
            {console.log("t5.1");
                averiaTipoSoloPieza = true;
                
                if (tipoDeRma != "RMA")
                {
                    document.getElementById("rmarepararoabonar").style.display = "block";
                }

                /*document.getElementById("textoaviso").innerHTML = "<div style='font-size: 9pt;'><div style='font-weight: bold;'>\u00BFQu\u00E9 soluci\u00F3n prefiere?</div><br /><div ><input type='radio' name='pieza' id='pieza1' value='1' onclick='' onchange='preguntaDevolver();' /> Reposici\u00F3n de la pieza (recuerde que deber\u00E1 enviar la pieza defectuosa en un plazo no superior a 15 d\u00CDas)</div> <br /> <div><input type='radio' name='pieza' id='pieza0' value='0' checked onchange='preguntaDevolver();' /> Env\u00CDo de la m\u00E1quina completa </div> </div>";*/

                document.getElementById("textoaviso").innerHTML = "<div class='devolPreg' id='devolPreg1' ><div style='font-weight: bold;'>\u00BFQu\u00E9 soluci\u00F3n prefiere?</div><div ><input type='radio' name='pieza' id='pieza1' value='1' onclick='soloPiezaAviso()' onchange='preguntaDevolver();' /> Reposici\u00F3n de la pieza </div> <div><input type='radio' name='pieza' id='pieza0' value='0' onchange='preguntaDevolver();' /> Env\u00CDo de la m\u00E1quina completa </div> </div>";
                document.getElementById("textoaviso").style.display = "block";
                document.getElementById("textoaviso").style.color = "black";

            }
            preguntaDevolver(tipoDeRma);
        }
    }


}

function preguntaDevolver(tipoDeRma)
{
    var repararAux = 1;

    if (tipoDeRma != "RMA") 
    {  
        if (document.getElementById("rreparar1").checked) { repararAux = 1; }
    }

    if (repararAux == 1)  
    //if ( document.getElementById("rreparar1").checked )
    {
        document.getElementById("pregunta").innerHTML = "";
        if ( tipoDeRma == "RMA" )
        {
            document.getElementById("pregunta").innerHTML += "<div class='devolPreg' id=''><div style='font-weight: bold;'>Reparaci\u00F3n del producto</div><br /><div>Trataremos de realizar la reparaci\u00F3n del producto siempre que sea posible<br /></div></div>";
        }
        document.getElementById("pregunta").innerHTML += "<div class='devolPreg' id='devolPreg3'><div style='font-weight: bold;'>\u00BFC\u00F3mo desea que se le devuelva el producto?</div><div ><input type='radio' name='devol' id='devol1' value='1' /> Enviar con mi pr\u00F3ximo pedido</div><div><input type='radio' name='devol' id='devol2' value='2' /> Enviar directamente </div> </div>";
        document.getElementById("pregunta").style.display = "block";

        /*if ( document.getElementById("pieza0").checked == true )
        {
            document.getElementById("rmarepararoabonar").style.display = "block";
        }*/

        if ( tipoDeRma != "RMA" )
        {
            document.getElementById("rmarepararoabonar").style.display = "block";
        }
        
    }
    else
    {
        if ( document.getElementById("pieza0").checked == true )
        {
            document.getElementById("pregunta").innerHTML = "";
            document.getElementById("pregunta").style.display = "none";
            document.getElementById("rmarepararoabonar").style.display = "block";
        }

        if ( document.getElementById("pieza1").checked == true )
        { // 1234
            /*document.getElementById("pregunta").innerHTML = "<div class='devolPreg' id='devolPreg3' ><div style='font-weight: bold;'>\u00BFC\u00F3mo desea que se le devuelva el producto?</div><br /><div ><input type='radio' name='devol' id='devol1' value='1' /> Enviar con mi pr\u00F3ximo pedido</div> <br /> <div><input type='radio' name='devol' id='devol2' value='2' /> Enviar directamente </div> <div class='devolPreg' id='devolPreg4'><br />Por favor, incluya una imagen que muestre el fallo obtenido:<br /><br /><input type='file' name='foto' id='foto' /></div> </div> ";*/

            document.getElementById("pregunta").innerHTML = "<div class='devolPreg' id='devolPreg3' ><div style='font-weight: bold;'>\u00BFC\u00F3mo desea que se le devuelva el producto?</div><div ><input type='radio' name='devol' id='devol1' value='1' /> Enviar con mi pr\u00F3ximo pedido</div><div><input type='radio' name='devol' id='devol2' value='2' /> Enviar directamente </div>  </div> ";

            if (tipoDeRma == "DOA")
            {
                document.getElementById("pregunta2").innerHTML = "<div class='devolPreg' id='devolPreg4'><br />Por favor, incluya una imagen que muestre el fallo obtenido:<br /><br /><input type='file' name='foto' id='foto' /></div>";
                document.getElementById("pregunta2").style.display = "block";                    
            }

            /*if (tipoDeRma == "DOA")
            {                    
                var newElement = document.createElement('div');
                newElement.innerHTML = "<div class='devolPreg' id='devolPreg4'><br />Por favor, incluya una imagen que muestre el fallo obtenido:<br /><br /><input type='file' name='foto' id='foto' /></div>";
                document.getElementById("pregunta").appendChild(newElement);​​​​​​​​​​​​​​​​
            }*/


            document.getElementById("pregunta").style.display = "block";
            document.getElementById("rmarepararoabonar").style.display = "none";
            document.getElementById("rreparar1").checked = true;
        }
    }
}

function soloPiezaAviso()
{
    alert("Reposici\u00F3nn de pieza: \r\nRecuerde que no se le recoger\u00E1 producto ni pieza y no debe enviarla.\r\nEl departamento de RMA se pondr\u00E1 en contacto con usted");
}


function colorearError(idElemento, error = 0)
{
    var campoCol = document.getElementById(idElemento);

    if (error == 0) { campoCol.style.border = "thin solid transparent"; }
    else { campoCol.style.border = "thin solid red"; }
}

function devolAdd(ccodcl, acodar, nnumser, fdoc, valorSel, valorObs)
{
    //console.log(" ccodcl=" + ccodcl + " acodar=" + acodar + " nnumser=" + nnumser + " fdoc=" + fdoc + " valorSel=" + valorSel + " valorObs=" + valorObs );
    var respuesta = true;
    var rreparar = 0; 
    var pieza = 0; 
    var valorSel = document.getElementById("devolSelAveria").value;
    var valorObs = document.getElementById("devolObs").value;

    if (document.getElementById("rreparar1").checked == true) { rreparar = 1; }
    if (document.getElementById("rreparar2").checked == true) { rreparar = 2; }

    if (averiaTipoSoloPieza)  
    {
        if (document.getElementById("pieza0").checked == false && document.getElementById("pieza1").checked == false)
        {
            colorearError("devolPreg1", 1);
            alert("Por favor, indique si prefiere reposici\u00F3n de la pieza o env\u00CDo de m\u00E1quina completa");
            respuesta = false;
        } 
        else 
        { 
            colorearError("devolPreg1", 0); 
        }

    } 

    if (respuesta)
    {
        //alert("rreparar: " + rreparar);
        if (rreparar == 0)
        {
            colorearError("rmarepararoabonar", 1);
            alert("Por favor, seleccione entre Reparar o Abonar");
            respuesta = false;
        } 
        else 
        { 
            colorearError("rmarepararoabonar", 0) 
        }

        if (rreparar == 1 || rreparar == 2)
        {
            if (valorSel == '0') { alert("Selecciona un motivo correcto"); respuesta = false; }
            
            if (respuesta && rreparar == 1)
            { 
                if (document.getElementById("devol1").checked == false && document.getElementById("devol2").checked == false) 
                { 
                    colorearError("devolPreg3", 1);
                    alert("Por favor, seleccione c\u00F3mo desea que se le devuelva el producto");
                    respuesta = false; 
                } 
                else 
                { 
                    colorearError("devolPreg3", 0); 
                }

            }


            if (respuesta && rreparar == 1)
            { 
                if (tipoDeRma == "DOA")
                {
                    if (document.getElementById("foto").value.length  == 0 ) 
                    { 
                        colorearError("devolPreg4", 1);
                        alert("Por favor, incluya una imagen que muestre el fallo obtenido");
                        respuesta = false; 
                    } 
                    else 
                    { 
                        colorearError("devolPreg4", 0); 
                    }
                }
            }
        }

        if (respuesta)
        {
            if ( valorObs == "" ) 
            { 
                colorearError("devolObs", 1);
                alert("Por favor, indique claramente el fallo. Descripciones como \"No funciona\" o \"no va\" no se admitir\u00E1n como v\u00E1lidas"); 
                respuesta = false; 
            } 
            else 
            { 
                colorearError("devolObs", 0); 
            }
        }
    }
    
    return respuesta;
}

function devolAddNoVendido(ccodcl, acodar, nnumser, fdoc)
{
    var respuesta = true;
    var rreparar = 0; 

    if (document.getElementById("rreparar1").checked == true) { rreparar = 1; }
    if (document.getElementById("rreparar2").checked == true) { rreparar = 2; }

    if (rreparar == 0)
    {
        colorearError("rmarepararoabonar", 1);
        alert("Por favor, seleccione entre Reparar o Abonar");
        respuesta = false;
    } 
    else 
    { 
        colorearError("rmarepararoabonar", 0) 
    }


    if (respuesta)
    {
        if (rreparar == 1)
        {
            var devol = 0;
            if (document.getElementById("devol1").checked == true) 
            { 
                devol = 1; 
            }

            if (document.getElementById("devol2").checked == true) 
            { 
                devol = 2; 
            }

            if (devol == 0) 
            { 
                colorearError("devolPreg2", 1);
                alert("Por favor, seleccione c\u00F3mo desea que se le devuelva el producto");
                respuesta = false; 
            } 
            else 
            { 
                colorearError("devolPreg2", 0); 
            }
        }
    }

    return respuesta;
}



function devolTabAbrir(evt, tabId)
{
    var i, x, tablinks;
    x = document.getElementsByClassName("devolArtTabTD");
    for (i = 0; i < x.length; i++) 
    {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");

    for (i = 0; i < x.length; i++) 
    {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
    }
    
    document.getElementById(tabId).style.display = "block";
    if (tabId == "devolTab3") { document.getElementById("devolTabBtn3").className += " w3-red"; }
    evt.currentTarget.className += " w3-red";
}

function escribirInicioSesion(elemento, usuario)
{
    if (usuario)
    {
        $('#usuario').val($(elemento).val());
        $('#usuario').focus();
    }
    else
    {
        $('#password').val($(elemento).val());
        $('#usuario').focus();
    }
}

function finalizarPago()
{
    if (document.getElementById("acepto").checked == false) 
    {
        alertify.alert("","Acepte las Condiciones de compra");
        return false;
    }
    else
    {
        //alertify.success('¡Su pedido se ha realizado con éxito! Recibirá un email con los detalles del pedido.');
        return true;
    }
}

function mostrarPopupTransferencia() 
{
    $(".popupTransferencia").removeClass("hidepopup");
    $(".popupTransferencia").addClass("showpopup");

    if (popupOcultado)
    {
        popupOcultado = false;
    }
}

function ocultarPopupTransferencia() 
{
    popupOcultado = true;

    $(".popupTransferencia").removeClass("showpopup");
    $(".popupTransferencia").addClass("hidepopup");
}

function pulsarAgregarDireccion()
{
    $('.anadirDireccionUsuario').css('display', 'block');
    $('#div_nueva_direccion').css('display', 'block');
}

function ocultarAgregarDireccion()
{
    $('.anadirDireccionUsuario').css('display', 'none');
}

function pulsarBtnMenuMovil(idUsuario, elemento)
{
    if ($('#div_cabecera_menu').css('display') == 'none')
    {
        $('#div_cabecera_menu').slideDown(200);
        $('#img_menu_movil').attr('src', '/xweb/public/images/menu_abierto.png');

        $('#div_cabecera_login').slideUp(200);
        srcIconLoginMovil(idUsuario, false);

        $('.imgNextMenu').css('transform', 'rotate(270deg)');
    }
    else
    {
        $('#div_cabecera_menu').slideUp(200);
        $('#img_menu_movil').attr('src', '/xweb/public/images/menu.png');

        $('.imgNextMenu').css('transform', 'rotate(90deg)');
    }
}

function pulsarBtnLoginMovil(idUsuario)
{
    if ($('#div_cabecera_login').css('display') == 'none')
    {
        $('#div_cabecera_login').slideDown(200);
        srcIconLoginMovil(idUsuario, true);

        $('#div_cabecera_menu').slideUp(200);
        $('#img_menu_movil').attr('src', '/xweb/public/images/menu.png');
    }
    else
    {
        $('#div_cabecera_login').slideUp(200);
        srcIconLoginMovil(idUsuario, false);
    }
}

function srcIconLoginMovil(idUsuario, abierto)
{
    if (idUsuario > 0)
    {
        if (abierto)
        {
            $('#login_menu_movil').attr('src', '/xweb/public/images/circle_abierto.png');
            $('.user_menu_movil').css('background-image', 'url(/xweb/public/images/circle_abierto.png)');
            $('.user_menu_movil div').css('color', '#333');
        }
        else
        {
            $('#login_menu_movil').attr('src', '/xweb/public/images/circle.png');
            $('.user_menu_movil').css('background-image', 'url(/xweb/public/images/circle.png)');
            $('.user_menu_movil div').css('color', '#fff');
        }
    }
    else 
    {
        if (abierto)
        {
            $('#login_menu_movil').attr('src', '/xweb/public/images/login_abierto.png');
        }
        else
        {
            $('#login_menu_movil').attr('src', '/xweb/public/images/login.png');
        }
    }
}

function desplegarSubCategorias(id, elemento)
{
    if ($('#ul_menu_' + id).is(':visible'))
    {
        $('#ul_menu_' + id).slideUp(200);
        $(elemento).find('.imgNextSubMenu').css('transform', 'rotate(90deg)');
    }
    else 
    {
        $('#ul_menu_' + id).slideDown(200);
        $(elemento).find('.imgNextSubMenu').css('transform', 'rotate(270deg)');
    }
}

function mostrarFiltrosMv(elemento)
{
    //$('.catFiltGrupo').addClass('open');

    if ($('.categoria .catCol1').is(':visible'))
    {
        $('.categoria .catCol1').slideUp(200);
        $(elemento).css('background-color', '#dfdfdf');
        $('#divCerrarCol0Mv').css('visibility', 'hidden');
        $('.flechaOfertasCategoria').css('visibility', 'visible');
    }
    else 
    {
        $('.categoria .catCol1').slideDown(200);
        $(elemento).css('background-color', '#ededed');
        $('#divCerrarCol0Mv').css('visibility', 'visible');
        $('.flechaOfertasCategoria').css('visibility', 'hidden');
    }
}

function cerrarFiltrosMv(elemento)
{
    $('.categoria .catCol1').slideUp(200);
    $(elemento).css('background-color', '#dfdfdf');
    $(elemento).css('visibility', 'hidden');
}

function clickFlechaIzqOfertasCategoria(valor)
{
    event.preventDefault();
    $('#divOfertasCategoria').animate({scrollLeft: '-=' + valor + 'px'}, 200);
}

function clickFlechaDerOfertasCategoria(valor)
{
    event.preventDefault();
    $('#divOfertasCategoria').animate({scrollLeft: '+=' + valor + 'px'}, 200);
}

function clickFlechaIzqTabFacturas(valor)
{
    event.preventDefault();
    $('#tableFacturas').animate({scrollLeft: '-=' + valor + 'px'}, 200);
    $('#flechaIzqTabFacturas').css('display', 'none');
    $('#flechaDerTabFacturas').css('display', 'block');
}

function clickFlechaDerTabFacturas(valor)
{
    event.preventDefault();
    $('#tableFacturas').animate({scrollLeft: '+=' + valor + 'px'}, 200);
    $('#flechaIzqTabFacturas').css('display', 'block');
    $('#flechaDerTabFacturas').css('display', 'none');
}

function clickFlechaIzqTabRecibos(valor)
{
    event.preventDefault();
    $('#tableRecibos').animate({scrollLeft: '-=' + valor + 'px'}, 200);
    $('#flechaIzqTabRecibos').css('display', 'none');
    $('#flechaDerTabRecibos').css('display', 'block');
}

function clickFlechaDerTabRecibos(valor)
{
    event.preventDefault();
    $('#tableRecibos').animate({scrollLeft: '+=' + valor + 'px'}, 200);
    $('#flechaIzqTabRecibos').css('display', 'block');
    $('#flechaDerTabRecibos').css('display', 'none');
}

function clickFlechaIzqTabContables(valor)
{
    event.preventDefault();
    $('#tableContables').animate({scrollLeft: '-=' + valor + 'px'}, 200);
    $('#flechaIzqTabContables').css('display', 'none');
    $('#flechaDerTabContables').css('display', 'block');
}

function clickFlechaDerTabContables(valor)
{
    event.preventDefault();
    $('#tableContables').animate({scrollLeft: '+=' + valor + 'px'}, 200);
    $('#flechaIzqTabContables').css('display', 'block');
    $('#flechaDerTabContables').css('display', 'none');
}

function desplegarNavPient(elemento)
{
    var table = $(elemento).find('.pietable');

    if ($(table).css('display') == 'none')
    {
        $(table).show(500);
        $(elemento).removeClass('pient_nav_default');
        $(elemento).addClass('pient_nav_change');
    }
    else
    {
        $(table).hide(500);
        $(elemento).removeClass('pient_nav_change');
        $(elemento).addClass('pient_nav_default');
    }
}

function mostrarBanderaNavegador()
{
    const idiomaNavegador = navigator.language;

    /*switch(idiomaNavegador) {
      case 'es':
        $('#celdaBandera img').attr('src','/xweb/public/images/banderaespana.png');
        break;
      case 'es-ES':
        $('#celdaBandera img').attr('src','/xweb/public/images/banderaespana.png');
        break;
      case 'pt':
        $('#celdaBandera img').attr('src','/xweb/public/images/banderaportugal.png');
        break;
      case 'pt-PT':
        $('#celdaBandera img').attr('src','/xweb/public/images/banderaportugal.png');
        break;
      case 'fr':
        $('#celdaBandera img').attr('src','/xweb/public/images/banderafrancia.png');
        break;
      case 'fr-FR':
        $('#celdaBandera img').attr('src','/xweb/public/images/banderafrancia.png');
        break;
      default:
        $('#celdaBandera img').attr('src','/xweb/public/images/banderaespana.png');
    }*/
}

function calcularAlturaContenedorArticulos() 
{
    setTimeout(function()
    {
        var numArtsVisibles = 0;
        var numFilas = 0;

        $('#filtradosCat').find('.celdaArt').each(function(){

            if ($(this).is(':visible'))
            {
                if (numArtsVisibles == 0)
                {
                    numFilas = parseInt(numFilas) + parseInt(1);
                }

                numArtsVisibles = parseInt(numArtsVisibles) + parseInt(1);

                if (numArtsVisibles == 4)
                {
                    numArtsVisibles = 0;
                }
            }
        });

        var alturaFila = numFilas * 440;
        $('#filtradosCat').css('height', alturaFila + 'px');
        $('#filtradosCat').find('.filtradosCat').css('height', alturaFila + 'px');
        $('.content-wrapper').css('min-height', alturaFila + 'px');
        $('.categoriaO').css('min-height', alturaFila + 'px');
        $('.categoriaO').css('height', alturaFila + 'px');
        $('.contArtsOcasion').css('min-height', alturaFila + 'px');

    }, 2000);
}

function ocultarGrupoFiltros() 
{
    setTimeout(function()
    {
        $('#mytabsFilts').find('.catFiltGrupo ').each(function()
        {
            $(this).css('display', 'block');

            var numFiltrosVisibles = 0;

            $(this).find('.catFilt').each(function()
            {
                if ($(this).is(':visible'))
                {
                    numFiltrosVisibles = parseInt(numFiltrosVisibles) + parseInt(1);
                }
            });

            if (numFiltrosVisibles == 0)
            {
                $(this).css('display', 'none');
            }
            else if (numFiltrosVisibles == 1)
            {
                var filtroActivado = false;

                $(this).find('.catFilt').each(function()
                {
                    if ($(this).is(':visible'))
                    {
                        if ($(this).hasClass('catFilt_2'))
                        {
                            filtroActivado = true;
                        }
                    }
                });

                if (!filtroActivado)
                {
                    $(this).css('display', 'none');
                }
            }
        });


        var hayFiltrosActivos = false;

        $('#mytabsFilts').find('.catFiltGrupo ').each(function()
        {
            $(this).find('.catFilt_2').each(function()
            {
                hayFiltrosActivos = true;
            });
        });

        if (!hayFiltrosActivos)
        {
            $('#mytabsFilts').find('.catFiltGrupo ').each(function()
            {
                $(this).css('display', 'block');
            });
        }


    }, 1000);
}

function cambiarMemoriaRAMAnuncio()
{
    var enlace = '/xweb/public/fotobanners/iconos/ram-' + $('#radio_caract_gb_ram').val() + '-ddr' + $('#radio_caract_ddr_ram').val() + '.png';
    enlace.replace("-EMMC", "");
    $("#img_caract_ram").attr("src", enlace);
}

function cambiarDiscoDuroAnuncio()
{
    var enlace = '/xweb/public/fotobanners/iconos/discoduro-' + $('#radio_caract_gb_dd').val() + '-' + $('#radio_caract_tipo_dd').val() + '.png';
    $("#img_caract_discoduro").attr("src", enlace);
}

function cambiarSistemaOperativoAnuncio()
{
    var enlace = '/xweb/public/fotobanners/iconos/windows-' + $('#radio_caract_version_so').val() + '-' + $('#radio_caract_tipo_so').val() + '.png';

    if ($('#radio_caract_version_so').val() == 'Chrome')
    {
        enlace = '/xweb/public/fotobanners/iconos/chrome-os.png';
    }

    $("#img_caract_so").attr("src", enlace);
}

function cambiarDVDAnuncio()
{
    var enlace = '/xweb/public/fotobanners/iconos/windows-' + $('#radio_caract_version_so').val() + '-' + $('#radio_caract_tipo_so').val() + '.png';

    if ($('#radio_caract_version_so').val() == 'Chrome')
    {
        enlace = '/xweb/public/fotobanners/iconos/chrome-os.png';
    }

    $("#img_caract_so").attr("src", enlace);
}


function mostrarAccesoPVP()
{
    $('.divAccesoPVP').css('display', 'block');

    setTimeout(function()
    {
        $('.divAccesoPVP').css('display', 'none');         
    }, 5000);
}

function cambioMargen(elemento, ccodcl, categoria)
{
    var margen = $(elemento).val().replace('%', '');

    $.ajax({
        url: '/xweb/actualizarmargen/' + ccodcl + '/' + categoria + '/' + margen,
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response) {

            $('#activarModoPVP').prop('checked', true);
            $('#msj_' + categoria).css('visibility', 'visible');

            setTimeout(function()
            {
                $('#msj_' + categoria).css('visibility', 'hidden');            
            }, 5000);
        }
    });
}

function activarModoPVP(ccodcl)
{
    var activo = 0; 

    if ($('#activarModoPVP').prop('checked'))
    {
        activo = 1;
        $('#msj_modopvp_activado').text('El modo PVP ha sido activado');
        $('#msj_modopvp_activado').css('visibility', 'visible');
    }
    else
    {
        $('#msj_modopvp_activado').text('El modo PVP ha sido desactivado');
        $('#msj_modopvp_activado').css('visibility', 'visible');
    }

    setTimeout(function()
    {
        $('#msj_modopvp_activado').css('visibility', 'hidden');            
    }, 5000); 

    ajaxActivarModoPVP(ccodcl, activo, false)
}

function ajaxActivarModoPVP(ccodcl, activo, refresh = false)
{
    /*$.ajax({
        url: '/xweb/emptyBasket',
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response) {
        }
    });*/

    $.ajax({
        url: '/xweb/activarmodopvp/' + ccodcl + '/' + activo,
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response) {

            if (refresh) {
                location.reload();
            }
        }
    });
}

function cambioLogoTienda(elemento)
{
    var valSrc = $(elemento).val();

    $('#logoTienda').attr('src', valSrc);
}

function noMostrarTutorialModoPVP(elemento, ccodcl)
{
    var noMostrar = 0;

    if ($(elemento).prop('checked'))
    {
        noMostrar = 1;
    }

     $.ajax({
        url: '/xweb/nomostrartutorialmodopvp/' + ccodcl + '/' + noMostrar,
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response) {
        }
    });
}

function cargarVentanaPVP()
{
    setTimeout(function(){
        $('#ventana_pvp').css('display', 'block');
    }, 2000);

    setTimeout(function(){
        $('#ventana_pvp').css('display', 'none');
    }, 10000);
}

function editarPrecioPresupuesto(acodar, elemento, ccodcl)
{
    var precio = $(elemento).val();

    setTimeout(function()
    {
        if (precio == $(elemento).val())
        {
            var formData = new FormData();
            formData.append('precio', precio);
            formData.append('acodar', acodar);
            formData.append('ccodcl', ccodcl);

            $.ajax({
                url: '/xweb/editarpreciopresupuesto/' + precio + '/' + acodar + '/' + ccodcl,
                type: 'get',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log(response);
                    
                    $('#cestaart5').text(response[1] + '€');
                    $('#sumaPrecioArticulos').text(response[2] + '€');
                    $('#cesta_edit_iva').text(response[3] + '€');
                    $('#cesta_edit_total').text(response[4] + '€');
                }
            });
        }

    }, 2000);
}


$(document).ready(function() 
{
    mostrarBanderaNavegador();

    var num_grados = $("#num_grados").val();

    for (var i = 0; i < num_grados; i++)
    {
        (function(i) 
        {
            var ref_articulo = $('#refArticulo_' + i).val();
            var cant_articulo = $("input[name = 'cant_"+i+"']").val();
            var stock_articulo = parseInt($('#stockArticulo_' + i).val());
            var stock_anadido = parseInt($('#stockAnadido_' + i).val());

            $("a[name ='cestaAdd_"+i+"']").click(function() {

                var ref_articulo = $('#refArticulo_' + i).val();
                var cant_articulo = $("input[name = 'cant_"+i+"']").val();
                var stock_articulo = parseInt($('#stockArticulo_' + i).val());
                var stock_anadido = parseInt($('#stockAnadido_' + i).val());

                stock_anadido = parseFloat(stock_anadido) + parseFloat(cant_articulo);
                $('#stockAnadido_' + i).val(stock_anadido);

                var limite_cantidad = parseFloat($('#limiteCantidad_' + i).val()) - parseFloat(cant_articulo);
                $('#limiteCantidad_' + i).val(limite_cantidad);

                if (cant_articulo > limite_cantidad)
                {
                    $("input[name = 'cant_"+i+"']").val(limite_cantidad);
                    $("input[name = 'masCantidad_"+i+"']").attr('src', '/xweb/public/images/artmasoff.png');
                }

                var cod_cliente = $('#codCliente').val();

                var formData = new FormData();
                formData.append('cod_cliente', cod_cliente);
                formData.append('ref_articulo', ref_articulo);
                formData.append('cant_articulo', cant_articulo);

                $.ajax({
                    url: 'view/updCarritoCompra.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                    }
                });
            });

            
        }(i));
    }

    setTimeout(function()
    {
        $('.table_seleccion_articulo tr').eq(2).trigger('click');
    }, 2000);

    $('#td_boton_productos').click(function()
    {
        $('#td_boton_productos img').css("border","4px #0c2e49 solid");
        $('#td_boton_envios img').css("border","none");
        $('#td_boton_abonos img').css("border","none");
        $('#td_boton_otros img').css("border","none");

        $('#div_preg_productos').show(500);
        $('#div_preg_envios').hide(500);
        $('#div_preg_abonos').hide(500);
        $('#div_preg_otros').hide(500);
    });

    $('#td_boton_envios').click(function()
    {
        $('#td_boton_productos img').css("border","none");
        $('#td_boton_envios img').css("border","4px #0c2e49 solid");
        $('#td_boton_abonos img').css("border","none");
        $('#td_boton_otros img').css("border","none");

        $('#div_preg_productos').hide(500);
        $('#div_preg_envios').show(500);
        $('#div_preg_abonos').hide(500);
        $('#div_preg_otros').hide(500);
    });

    $('#td_boton_abonos').click(function()
    {
        $('#td_boton_productos img').css("border","none");
        $('#td_boton_envios img').css("border","none");
        $('#td_boton_abonos img').css("border","4px #0c2e49 solid");
        $('#td_boton_otros img').css("border","none");

        $('#div_preg_productos').hide(500);
        $('#div_preg_envios').hide(500);
        $('#div_preg_abonos').show(500);
        $('#div_preg_otros').hide(500);
    });

    $('#td_boton_otros').click(function()
    {
        $('#td_boton_productos img').css("border","none");
        $('#td_boton_envios img').css("border","none");
        $('#td_boton_abonos img').css("border","none");
        $('#td_boton_otros img').css("border","4px #0c2e49 solid");

        $('#div_preg_productos').hide(500);
        $('#div_preg_envios').hide(500);
        $('#div_preg_abonos').hide(500);
        $('#div_preg_otros').show(500);
    });

    var lineHeightIconBtn = $('#div_img_flecha_panel').outerHeight();
    $('#div_txt_panel_articulo_seleccionado').css('line-height', lineHeightIconBtn + 'px');


    var href = document.location.href;

    if (href.indexOf("categoria") >= 0)
    {
        if ($('#divOfertasCategoria').scrollLeft() == 0)
        {
            $('#flechaIzqOfertasCategoria').css('display', 'none');
        }
        else
        {
            $('#flechaIzqOfertasCategoria').css('display', 'block');
        }


        var maxscrollDivOfertas = $('#divOfertasCategoria')[0].scrollWidth;
        var widthDivOfertas = $('#divOfertasCategoria').css('width');

        $('#divOfertasCategoria').scroll(function()
        { 
            var leftDivOfertas = $('#divOfertasCategoria').scrollLeft();

            console.log('Adioooossss - ' + maxscrollDivOfertas + ' - ' + leftDivOfertas + ' - ' + widthDivOfertas);

            if ($('#divOfertasCategoria').scrollLeft() == 0)
            {
                $('#flechaIzqOfertasCategoria').css('display', 'none');
            }
            else
            {
                $('#flechaIzqOfertasCategoria').css('display', 'block');
            }

            if (parseFloat(widthDivOfertas) + parseFloat(leftDivOfertas) >= parseFloat(maxscrollDivOfertas) - parseFloat(5))
            {
                $('#flechaDerOfertasCategoria').css('display', 'none');
            }
            else
            {
                $('#flechaDerOfertasCategoria').css('display', 'block');
            }
        });

        $(window).scroll(function()
        {
            if ($(window).scrollTop() == 0)
            {
                $('.flechaOfertasCategoria').css('position', 'fixed');
            }
            else
            {
                $('.flechaOfertasCategoria').css('position', 'absolute');
            }
        });
    }



    // Datetime para recogidas RMA
        /*$(document).ready(function() {
            $.datetimepicker.setLocale('es');
        });*/

        var hoy = new Date();
        var hoyStr = hoy.getDate() + "." + ("0"+(hoy.getMonth()+1)).slice(-2) + "." + hoy.getFullYear();
        hoy.setHours(9);
        hoy.setMinutes(0);

        $(document).ready(function() {
            $('#datetimeFecha').datetimepicker({
                timepicker:false, 
                dayOfWeekStart : 1,
                format:'d/n/Y',
                minDate:'+1970/01/02',
                //defaultDate: new Date(),
                defaultDate:'<?php echo $fechaSeleccionada; ?>',formatDate:'d/m/Y',
                disabledWeekDays: [6, 0]
            });
        });



    // Hora desde
        //var b = jQuery.noConflict();

        /*$(document).ready(function() {
            $.datetimepicker.setLocale('es');
        });*/

        $(document).ready(function() {
            $('#time1').datetimepicker({
                datepicker: false,
                format:'H:i',
                defaultTime:'09:00',
                minTime:'09:00',
                allowTimes:[
                  '09:00',
                  '09:30',
                  '10:00',
                  '10:30',
                  '11:00',
                  '11:30',
                  '12:00',
                  '12:30',
                  '13:00',
                  '13:30',
                  '14:00',
                  '14:30',
                  '15:00',
                  '15:30',
                  '16:00',
                  '16:30',
                  '17:00',
                  '17:30',
                  '18:00',
                  '18:30',
                  '19:00'
                ]
            });
        });


        // Hora hasta
        //var c = jQuery.noConflict();

        /*$(document).ready(function() {
            $.datetimepicker.setLocale('es');
        });*/

        $(document).ready(function() {
            $('#time2').datetimepicker({
                datepicker: false,
                format:'H:i',
                defaultTime:'18:00',
                minTime:'09:00',
                allowTimes:[
                  '09:00',
                  '09:30',
                  '10:00',
                  '10:30',
                  '11:00',
                  '11:30',
                  '12:00',
                  '12:30',
                  '13:00',
                  '13:30',
                  '14:00',
                  '14:30',
                  '15:00',
                  '15:30',
                  '16:00',
                  '16:30',
                  '17:00',
                  '17:30',
                  '18:00',
                  '18:30',
                  '19:00'
                ]
            });
        });

    var fechaHoy = new Date().toISOString().split('T')[0];
    $('#input_fecha_oferta').val(fechaHoy);
});


