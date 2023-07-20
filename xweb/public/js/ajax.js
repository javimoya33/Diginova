var isIE = false;
var req;

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
        //campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
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





// tarifa, conectado
/*function ordenarFamilia(codFam, criterioOrden = 1, lim = 0)
{
    url="view/celdasArticulos3.php?codart="+acodar+"&cant="+cantidad;

    if(url=='')
    {
        return;
    }

    if(window.XMLHttpRequest)
    {
        reqself=new XMLHttpRequest();
        reqself.onreadystatechange=processReqChangeOrd;
        reqself.open("GET",url,true);reqself.send(null);
    }
    else if(window.ActiveXObject)
    {
        isIE=true;
        reqself=new ActiveXObject("Microsoft.XMLHTTP");
        if(reqself)
        {
            reqself.onreadystatechange=processReqChangeOrd;
            reqself.open("GET",url,true);reqself.send();
        }
    }
}

function processReqChangeOrd()
{
    var campo=document.getElementById("homeContArts");

    if(reqself.readyState==4)
    {
        campo.innerHTML=reqself.responseText;
    }
    else
    {
        campo.innerHTML='<img width="30" height="30" src="img/cargando.gif" align="middle" /> Cargando...';
    }
}

*/


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


function actualizarCestaAjax()
{
    var url = "/xweb/view/cestaajax.php";

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
}

function processReqChangeCesta() { 
    var campo = document.getElementById("cestaAjax");

    if(reqDesc.readyState == 4) {
        campo.innerHTML = reqDesc.responseText;
    } else {
        campo.innerHTML = '<img width="30" height="30" src="https://www.diginova.es/xweb/images/loading.gif" align="middle" /> Cargando...';
    }
}




