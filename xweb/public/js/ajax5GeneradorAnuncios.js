function pulsarArticuloParaAnuncio(nombreArticulo, precio, imagen)
{
    var nombreArtAbreviado = obtNombreArtParaAnuncio(nombreArticulo, 32)

    var precio1 = parseInt(precio).toFixed();
    var precio2 = parseInt(precio * 0.95).toFixed();
    var precio3 = parseInt(precio * 0.85).toFixed();

    cambiarImgAnuncio(imagen);
    cambiarNombreArtAnuncio(nombreArtAbreviado[0]);
    cambiarGraficaAnuncio(nombreArtAbreviado[0], true);
    cambiarPrecioAnuncio(1, precio1, true);
    cambiarPrecioAnuncio(2, precio2, true);
    cambiarPrecioAnuncio(3, precio3, true);

    if ($('.precio2_control').css('display') != 'none')
    {
        $('#input_text_precio_anuncio').val('Precio para 1 ud');
        $('#input_text_precio2_anuncio').val('Precio para 3 uds');
        $('#input_text_precio3_anuncio').val('Precio para 5 uds');
    }

    //$('#img_fondo_cartel_' + arrFondosDia[hoy - 1]).trigger('click');

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

function obtNombreArtParaAnuncio(nombreArticulo, limiteCaracteres)
{
    var posLimite = nombreArticulo.indexOf('(');

    if (posLimite < 0)
    {
        posLimite = nombreArticulo.length;
    }

    var nombreArtAbreviado = nombreArticulo.substr(0, posLimite - 2);
    var nombreygrafica = nombreArtAbreviado.split(' + ');

    if (posLimite > limiteCaracteres)
    {
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
    var palabras = nombreArtAbreviado[0].split(' ');
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

    $('#table_caract_generador_anuncios tr').remove();

    var yaTieneRAM = false;

    for (var i = 0; i < arrCaractArticulo3.length; i++) 
    {
        console.log('Hola2');
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
            console.log('Hola3');

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
    var caract = $(elemento).val();

    setTimeout(function()
    {
        if (caract == $(elemento).val())
        {
            $('#div_carac_text_articulo_seleccionado div').remove();

            var colorB = $('#input_colorb_fuente_anuncio').val();
            var colorC = $('#input_colorc_fuente_anuncio').val();

            var txtCaract = "<div>";

            if ($('#check_caract_pantalla').is(":checked"))
            {
                var txtPantalla = $('#input_text_pantalla').val();
                var txtCaractPantalla = $('#input_caract_pantalla').val();
                txtCaract += '<div class="nombre_caract" style="margin-right: 5px; color: ' + colorB + '; white-space: nowrap;">' + txtPantalla + ' </div><div class="valor_caract" style="color: ' + colorC + '; margin-right: 15px; white-space: nowrap;">' + txtCaractPantalla + '</div>';

                $("#input_text_pantalla").prop('disabled', false);
                $("#input_caract_pantalla").prop('disabled', false);
            }
            else
            {
                $("#input_text_pantalla").prop('disabled', true);
                $("#input_caract_pantalla").prop('disabled', true);
            }

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

            $('#div_carac3_text_articulo_seleccionado div').empty();
            $('#div_carac3_text_articulo_seleccionado div').text(txtCaractPantalla);
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
    console.log('cpa ' + itPrecio + ' - ' + precio + ' - ' + pulsado);

    if (itPrecio == 1)
    {
        itPrecio = '';
    }

    if (pulsado)
    {
        var precioArticulo = precio;
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
            $('#precio' + itPrecio + '_articulo_seleccionado').text('');
            $('#precio' + itPrecio + '_articulo_seleccionado span').remove();

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

    console.log('Entraaa1 -> ' + numPreciosMostrados);

    $('.div_precio_articulo_seleccionado').each(function()
    {
        console.log('Entraaa2 -> ' + numPreciosMostrados);
        if ($(this).css('display') == 'table')
        {
            numPreciosMostrados = parseInt(numPreciosMostrados) + parseInt(1);
            console.log('Entraaa3 -> ' + numPreciosMostrados);
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


/*function pulsarPlantillaAnuncio1()
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
}*/

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