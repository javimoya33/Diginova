<?php

namespace App\Http\Controllers;

// 
//use App\Http\Controllers\Controller;
use App\Xgest\Api;
use App\Xgest\Articulo;
use App\Xgest\Entorno;
use App\Xgest\Mailerx;
use App\Xgest\Menu;
use App\Xgest\Usuario;
use App\Xgest\Utils;
use Config;
use Cookie;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Log;
use Request;
use Response;
use Schema;
use Session;
use URL;
use DateTime;
use PDF_Code128Parte; 
use PDF_Code128; 
use SoapClient;
use SoapHeader;
use PHPMailer;  

class Controller extends BaseController
{
    public $refArticuloAnterior = '';
    public $acodarAnterior = '';
    public $arrRefRepetidas = array();
    public $arrRefOcultas = array();

    public $precioArtAnterior = 100000;

    public $arrAmpliaciones = array('695006AMP101', '695006AMP102', '695006AMP103', '695006AMP104', '695006AMP105', '695006AMP106', '695006AMP201', '695006AMP202', '695006AMP203', '695006AMP204', '695006AMP205', '695006AMP206', '69509901', '69509902', '69509903', 'POG', 'POA', 'POV', 'POGS', 'POAS', 'PO');

    public $arrPortes = array('POG', 'POA', 'POV', 'POGS', 'POAS', 'PO');

    // *** CAMBIAR *** //
    public $urlDiginova = 'http://diginova.es/xweb';
    //public $urlDiginova = 'http://xweb4.diginova.es/';

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        // bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's
        // bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's
        $ipcliente = Request::getClientIp();
        $deny_ips = array(
            //'84.254.12', // ejemplo de un rango de direcciones
            //'84.254.12.45', // ejemplo de una ip concreta
        );
        foreach ($deny_ips as $buss) {
            if (strpos($ipcliente, $buss) === 0) {
                echo 'Su dirección IP ha sido bloqueada (' . $ipcliente . ')<br/>Si cree que es un error por favor póngase en contacto con nosotros.';
                exit;
            }
        }
        // bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's
        // bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's bloqueo de ip's
    }
    public function init()
    {
        //$ipcliente=Request::getClientIp();
        //$thisfilename=basename($_SERVER['PHP_SELF']);
        //$php56=version_compare(PHP_VERSION, '5.6.0') >= 0?true:false;
        //$php73=version_compare(PHP_VERSION, '7.3.0') >= 0?true:false;
        //caducidad de la sesion

        if (Session::has("entorno")) {
            if (session('entorno')->config->x_caducidad > 0) {
                if (!Session::has('ultdate')) {
                    //session(["ultdate"=>date("Y-m-d H:i:s")]);
                    session(["ultdate" => time()]);
                }
                //echo session('ultdate');
                $mpasados = (time() - session('ultdate')) / 60;
                if ($mpasados > session('entorno')->config->x_caducidad) {
                    // se ha superado la caducidad de la sesion
                    Session::forget("entorno");
                    Session::forget("usuario");
                    Session::forget("menu");
                    Session::forget("articulo");
                    Cookie::forget('flash');
                    Session::regenerate();
                    Session::flush();
                    echo "<br/><br/><center><b>LA SESIÓN SE HA CERRADO POR INACTIVIDAD</b></center><br/><br/><br/>";
                } else {
                    session(["ultdate" => time()]);
                    //echo session('ultdate');
                }
            }
        }
        //caducidad de la sesion
        //Log::info("init");
        //Config::set('app.debug',true); // DEJAR EN FALSE!!!, SI CONFIG ES true MOSTRARA INFORMACION ACERCA DE LOS ERRORES QUE PUEDE CONTENER INFORMACION SENSIBLE
        //\Debugbar::enable();
        if (!Session::has("entorno")) {
            $dir = base_path() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Xgest";
            if (!is_writable($dir)) {
                echo "el directorio $dir no escribible, corregir<br/>";
            }
            $dir = base_path() . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "logs";
            if (!is_writable($dir)) {
                echo "el directorio $dir no escribible, corregir<br/>";
            }
            $dir = base_path() . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "framework" . DIRECTORY_SEPARATOR . "sessions";
            if (!is_writable($dir)) {
                echo "el directorio $dir no escribible, corregir<br/>";
            }
            if (!ini_get('allow_url_fopen')) {
                echo "es necesario activar la directiva allow_url_fopen en el servidor web";
            }
            if (function_exists('apache_get_modules')) {
                if (!in_array('mod_rewrite', apache_get_modules())) {
                    echo 'es necesario activar mod_rewrite en PHP';
                }

            }
        }
        //Log::info("init");
        // 1234 
        Config::set('app.debug', true); // DEJAR EN FALSE!!!, SI CONFIG ES true MOSTRARA INFORMACION ACERCA DE LOS ERRORES QUE PUEDE CONTENER INFORMACION SENSIBLE
        //Config::set('app.debug',true); // DEJAR EN FALSE!!!, SI CONFIG ES true MOSTRARA INFORMACION ACERCA DE LOS ERRORES QUE PUEDE CONTENER INFORMACION SENSIBLE
        //if (gethostname() == "josejavier-10") {
        //    Config::set('app.debug', true); // DEJAR EN FALSE!!!, SI CONFIG ES true MOSTRARÁ INFORMACIÓN ACERCA DE LOS ERRORES QUE PUEDE CONTENER INFORMACIÓN SENSIBLE
        //}
        if (!Session::has("entorno")) {
            //Log::info("carga datos");
            session(["entorno" => new Entorno()]); // carga la clase Entorno con funciones de carga de datos generales de la app
            $ok = session('entorno')->inicializar(); // inicializa configuraciones base de la app
            if (!$ok) {
                // no se ha podido conectar a la base de datos, elimina entorno para intentar cargar de nuevo
                Session::forget("entorno");
                die("Se ha producido un error técnico al conectar al sistema.");
            }
            if (session('entorno')->config->x_mant) {
                Session::forget("entorno");
                die("Lo sentimos, esta web está en mantenimiento. Reintente en unos minutos.");
                //return;
            }
            if (session('entorno')->config->x_desarrollo) {
                Config::set('app.debug', true); // DEJAR EN FALSE!!!, SI CONFIG ES true MOSTRARA INFORMACION ACERCA DE LOS ERRORES QUE PUEDE CONTENER INFORMACION SENSIBLE
                error_reporting(E_ALL);
                ini_set('display_errors', true);
            }
            Cookie::queue(Cookie::forever('ordenacion', 'da')); // por defecto descripcion descendente
            if (session('entorno')->config->x_splash) {
                if (Cookie::get('flash', null) === "splash") {
                    // "existe, no hace nada";
                } else {
                    // "no existe la crea y muestra splash";
                    Cookie::queue(Cookie::make('flash', "splash", 60 * 23)); // 23 horas
                    session(["splash" => true]);
                    session(["splashhtml" => true]);
                }
            }
            if (!Session::has("usuario")) {
                session(['usuario' => new Usuario()]);
                session('usuario')->inicializar();

                if (session('usuario')->uData->codigo > 0)
                {
                    session("usuario")->cargarCesta(0, 2); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva
                }
                else
                {
                    session("usuario")->cargarCesta(0, 0); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva
                }
            }
            if (!Session::has("menu")) {
                session(['menu' => new Menu()]);
                session("menu")->generarMenu(); // carga los menus de bloques/grupos/familias
                //echo "menues";
            }
            if (!Session::has("articulo")) {
                session(['articulo' => new Articulo()]);
                session("articulo")->usarpropiedades = true; // usamos las propiedades de articulos configuradas desde xgest
                session("articulo")->cargarMarcasFamilias(); // carga matrices con las marcas y las familias para las búsquedas
                session("articulo")->sobreescribirfotos = true; // si se declara a false, las fotos de articulos que ya existen en disco no se sobreescriben aunque cambien en Xgest
            }

            //session('entorno')->cargaridiomas(Cookie::get('idioma', '1') + 0); // inicializa configuraciones base de la app

            //$this->enviarMailsDeStockDisponible();
            //$this->enviarMailsDeSeguimiento();
        }
        if (session('entorno')->config->x_desarrollo) {
            Config::set('app.debug', true); // DEJAR EN FALSE!!!, SI CONFIG ES true MOSTRARA INFORMACION ACERCA DE LOS ERRORES QUE PUEDE CONTENER INFORMACION SENSIBLE
        }

        session("entorno")->asignarDatosConexion(); // carga los datos de conexión desde /app/Xgest/datosConexion.php

        session('usuario')->webOfflineComprobarCambioCodigoCliente(); // procesos que hace al cargar cada página sólo cuando la web es offline (relacionados con la sincronizacion de nuevos clientes)

        if (Cookie::get('idioma', 'no definido') == "no definido") {
            Cookie::queue(Cookie::forever('idioma', '1')); // por defecto castellano
        }
        if (Cookie::get('visual', 'no definido') == "no definido") {
            Cookie::queue(Cookie::forever('visual', '1')); // modo de vista cuadricula
        }

        //$this->idioma = Cookie::get('idioma', '1') + 0;
        //session('entorno')->idioma = $this->idioma;
        //session('entorno')->cargarIdiomas(); // carga idiomas si lo necesita, crea directorios y copias en otros idiomas session('entorno')->idiomas
        //echo Cookie::get('idioma','no definido');

        /*
        session("entorno")->config->x_stkident=0; // stock a usuarios identificados - no lo muestra
        $cocli=session("usuario")->uData->codigo; // codigo de cliente
        $ticli=session("usuario")->uData->ctipocli; // tipo de cliente
        if($cocli==1||$cocli==2||$cocli==3||$cocli==4){
        session("entorno")->config->x_stkident=2;
        }
         */
        //echo session("usuario")->uData->codigocen;
        //echo session("usuario")->uData->centros;

        //**************** NUEVO CÓDIGO ********************************************************************************//

        // Pasar datos del comercial del usuario a la cabecera
        $codCliente = session('usuario')->uData->codigo;

        if ($codCliente > 0)
        {
            $arrDatosCliente = DB::select("SELECT * FROM fccli AS cli, zonas AS zon, fcrep AS rep
                                WHERE cli.CZONA = zon.zona
                                AND zon.repre = rep.RCOD
                                AND cli.CCODCL = $codCliente");

            $emailRep = "";
            $telefRep = "";
            $extRep = "";
            $ctari = 1;

            foreach ($arrDatosCliente as $arrDatoCliente) 
            {
                $emailRep = $arrDatoCliente->RMAIL;
                $telefRep = $arrDatoCliente->RTEL;
                $extRep = $arrDatoCliente->REXT;
                $ctari = $arrDatoCliente->CTARI;
            }
        }
        else
        {
            $emailRep = "";
            $telefRep = "";
            $extRep = "";
            $ctari = 1;
        }

        Session::get("usuario")->uData->emailRep = $emailRep;
        Session::get("usuario")->uData->telefRep = $telefRep;
        Session::get("usuario")->uData->extRep = $extRep;
        

        if (session('usuario')->uData->codigo <= 0) { Session::get("usuario")->uData->ctari = 2; }

        // Pasar categorías de la web al menú principal
        $arrCategoriasMenu = DB::select("SELECT * FROM menus 
                                        WHERE parent is null AND gcod is null AND mostrar = 1 
                                        ORDER BY orden ASC");
        Session::get("entorno")->arrCategoriasMenu = $arrCategoriasMenu;

        // Obtener todas las subcategorías
        $arrSubCategorias = DB::select("SELECT * FROM menus AS men, fcgrf AS fcg
                                        WHERE men.gcod = fcg.GCOD
                                        AND men.mostrar = 1
                                        AND fcg.GCOD NOT IN (205, 206)
                                        ORDER BY fcg.GCOD ASC");
        Session::get("entorno")->arrSubCategorias = $arrSubCategorias;

        // Obtener todas las subsubcategorías
        $arrSubSubCategorias = DB::select("SELECT * FROM fcgrf AS fcg, fcfcp AS fcf
                                           WHERE fcg.GCOD = fcf.FGRUPO
                                           AND fcf.FRESSN2 = 'N'
                                           AND exists(SELECT * FROM menus_fam WHERE cod_fam = fcf.FCOD)
                                           ORDER BY fcf.FDES ASC");
        Session::get("entorno")->arrSubSubCategorias = $arrSubSubCategorias;

        $anchoCategorias = array(181, 188, 170, 138, 93, 188);
        Session::get("entorno")->arrAnchoCategorias = $anchoCategorias;

        $arrFamiliasCategorias = DB::select("SELECT fc.FCOD, fc.FDES, fc.FGRUPO 
                                                FROM fcfcp AS fc 
                                                WHERE fc.FRESSN2 ='N' 
                                                AND (exists(SELECT * FROM menus_fam WHERE cod_fam = fc.FCOD)
                                                OR fc.FCOD = 711)
                                                ORDER BY fc.FCOD ASC");
        Session::get("entorno")->arrFamiliasCategorias = $arrFamiliasCategorias;

        $arrOrdenadorMenu = DB::select("SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6
                                        FROM menus AS m, fcfcp AS f, fcart AS a
                                        WHERE m.PARENT = 1125 
                                        AND f.FGRUPO = m.GCOD 
                                        AND a.ARESNUM4 = f.FCOD 
                                        AND a.ASTOCK > 0 
                                        AND a.ABLOQUEADO = 'N' 
                                        AND a.APVP1 > 0  
                                        AND a.ARESSN2 = 'N' 
                                        ORDER BY rand()
                                        LIMIT 1");
        
        foreach ($arrOrdenadorMenu as $equipo) { $equipo->imag1 = $this -> obtImagenArt($equipo->ADESCR); }        
        Session::get("entorno")->arrOrdenadorMenu = $arrOrdenadorMenu;


        $arrPortatilMenu = DB::select("SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6
                                        FROM menus AS m, fcfcp AS f, fcart AS a
                                        WHERE m.PARENT = 1126 
                                        AND f.FGRUPO = m.GCOD 
                                        AND a.ARESNUM4 = f.FCOD 
                                        AND a.ASTOCK > 0 
                                        AND a.ABLOQUEADO = 'N' 
                                        AND a.APVP1 > 0  
                                        AND a.ARESSN2 = 'N' 
                                        ORDER BY rand()
                                        LIMIT 1");

        foreach ($arrPortatilMenu as $equipo) { $equipo->imag1 = $this -> obtImagenArt($equipo->ADESCR); }
        Session::get("entorno")->arrPortatilMenu = $arrPortatilMenu;

        $arrMonitorMenu = DB::select("SELECT * FROM menus AS m, fcfcp AS f, fcart AS a
                WHERE m.PARENT = 1118
                AND f.FGRUPO = m.GCOD 
                AND a.ARESNUM4 = f.FCOD 
                AND a.ASTOCK > 0 
                AND a.ABLOQUEADO = 'N' 
                AND a.APVP1 > 0  
                AND a.ARESSN2 = 'N' 
                ORDER BY rand()
                LIMIT 1");

        foreach ($arrMonitorMenu as $equipo) { $equipo->imag1 = $this -> obtImagenArt($equipo->ADESCR); }
        Session::get("entorno")->arrMonitorMenu = $arrMonitorMenu;

        $arrOtrosMenu = DB::select("SELECT * FROM menus AS m, fcfcp AS f, fcart AS a
                WHERE m.PARENT = 1127 
                AND f.FGRUPO = m.GCOD 
                AND a.ARESNUM4 = f.FCOD 
                AND a.ASTOCK > 0 
                AND a.ABLOQUEADO = 'N' 
                AND a.APVP1 > 0  
                AND a.ARESSN2 = 'N' 
                ORDER BY rand()
                LIMIT 1");

        foreach ($arrOtrosMenu as $equipo) { $equipo->imag1 = $this -> obtImagenArt($equipo->ADESCR); }
        Session::get("entorno")->arrOtrosMenu = $arrOtrosMenu;

        $arrAccesorioMenu = DB::select("SELECT * FROM menus AS m, fcfcp AS f, fcart AS a
                WHERE m.PARENT = 4 
                AND f.FGRUPO = m.GCOD 
                AND a.ARESNUM4 = f.FCOD 
                AND a.ASTOCK > 0 
                AND a.ABLOQUEADO = 'N' 
                AND a.APVP1 > 0  
                AND a.ARESSN2 = 'N' 
                ORDER BY rand()
                LIMIT 1");
        foreach ($arrAccesorioMenu as $accesorioMenu) 
        {
            $accesorioMenu->imag1 = $this -> obtImagenArt($accesorioMenu->ADESCR); 
            Session::get("entorno")->accesorioMenu = $accesorioMenu->ACODAR;
            Session::get("entorno")->accesorioMenuNombre = $accesorioMenu->ADESCR;
            Session::get("entorno")->accesorioMenuPrecio = $accesorioMenu->APVP1;
        }

        $arrOfertas = DB::select("SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
            FROM fcofe o, fcart a
            WHERE o.OCODAR = a.ACODAR 
            AND CURDATE() between o.OFECINI AND o.OFECFIN 
            AND a.ASTOCK > 0 
            AND a.ABLOQUEADO = 'N' 
            AND a.APVP1 > 0  
            AND a.ARESSN2 = 'N'
            ORDER BY rand()
            LIMIT 4");
        Session::get("entorno")->arrOfertas = $arrOfertas;

        foreach ($arrOfertas as $arrOferta)
        {
            if (session('usuario')->uData->codigo > 0)
            {
                $tarifaU = session('usuario')->uData->ctari;

                switch($tarifaU) {
                    case 1:
                        $precio = $arrOferta->APVP1;
                        $precioOferta = $arrOferta->OPRE1;
                        break;
                    case 2:
                        $precio = $arrOferta->APVP2;
                        $precioOferta = $arrOferta->OPRE2;
                        break;
                    case 3:
                        $precio = $arrOferta->APVP3;
                        $precioOferta = $arrOferta->OPRE3;
                        break;
                    case 4:
                        $precio = $arrOferta->APVP4;
                        $precioOferta = $arrOferta->OPRE4;
                        break;
                    case 5:
                        $precio = $arrOferta->ARESNUM5;
                        $precioOferta = $arrOferta->OPRE5;
                        break;
                    case 6:
                        $precio = $arrOferta->ARESNUM6;
                        $precioOferta = $arrOferta->OPRE6;
                        break;
                    default:
                        $precio = $arrOferta->APVP1;
                        $precioOferta = $arrOferta->OPRE1;
                        break;
                }
            }
            else
            {
                $precio = $arrOferta->APVP1;
                $precioOferta = $arrOferta->OPRE1;
            }

            $precioF = number_format($precio, 2, ",", ".");

            $arrOferta->precioAntiguo = $precioF;
            $arrOferta->precioOferta = $precioOferta;


            $arrOferta->imag1 = $this -> obtImagenArt($arrOferta->ADESCR); 
        }

        Session::get("entorno")->arrOfertas = $arrOfertas;

        $arrPedidos = DB::select("SELECT LPED, LCODAR, SUM(LCANTI) AS 'stockped'
                                    FROM fcloc
                                    WHERE LLIQUID = 'N' and LFECPED >= '2019-1-1' and LPED <> 0
                                    GROUP BY LCODAR");

        $arrTodos = DB::select("SELECT * FROM fcart AS a, fcstk AS s
                                WHERE a.ACODAR = s.ACODAR 
                                AND s.AALM = 1 
                                AND s.ASTOCK > 0
                                AND a.ABLOQUEADO = 'N' 
                                AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                                AND a.ARESSN2 = 'N'  
                                AND a.AFAMILIA BETWEEN 100 AND 569 
                                AND a.ARESNUM4 BETWEEN 1 AND 9999 
                                AND a.ARESNUM4 <> 1450
                                ORDER BY a.AFAMILIA DESC");

        $arrTotal = array();

        foreach ($arrTodos as $arrTodo)
        {
            $stock = $arrTodo->ASTOCK;

            foreach ($arrPedidos as $pedido) 
            {
                if ($pedido->LCODAR == $arrTodo->ACODAR)
                {
                    $stock -= $pedido->stockped;
                }
            }

            $aux = array(
                "ACODAR" => $arrTodo->ACODAR, 
                "ADESCR" => $arrTodo->ADESCR, 
                "APVP1" => $arrTodo->APVP1, 
                "APVP2" => $arrTodo->APVP2, 
                "APVP3" => $arrTodo->APVP3, 
                "APVP4" => $arrTodo->APVP4, 
                "ARESNUM5" => $arrTodo->ARESNUM5, 
                "ARESNUM6" => $arrTodo->ARESNUM6, 
                "ASTOCK" => $stock,
                "ATIPO2" => $arrTodo->ATIPO2,
                "AFAMILIA" => $arrTodo->AFAMILIA
            );

            if ($stock > 0) 
            { 
                array_push($arrTotal, $aux); 
            }   
        }

        Session::get("entorno")->arrArticulosBusqueda = $arrTotal;
        Session::get("entorno")->nombrePagina = Request::segment(1);

        $arrBanUrls = array(
            75 => "index.php?page=articulo&cod=6920HP8470P1GB",
            76 => "index.php?page=articulo&cod=6940BEG225I1A",
            77 => "index.php?page=articulo&cod=6920HP850G31GAP",
            78 => "index.php?page=articulo&cod=6920HP840G32GAP",
            79 => "index.php?page=articulo&cod=6910HP400G31GB",
            80 => "index.php?page=articulo&cod=6910HP800G1U1GA",
            81 => "index.php?page=articulo&cod=6920DEE74501GA",
            82 => "index.php?page=articulo&cod=6920DE65402A",
            83 => "index.php?page=articulo&cod=6910HP800G1U1GA",
            84 => "index.php?page=articulo&cod=6910HP63005GA",
            85 => "index.php?page=articulo&cod=6920HP840G14GA",
            86 => "index.php?page=articulo&cod=6920FSCE7461GA",
            87 => "index.php?page=articulo&cod=6940T28D31ES1GB",
            88 => "index.php?page=articulo&cod=6910LENM731GA",
            89 => "index.php?page=articulo&cod=6950HPCH11AG61GA",
            90 => "index.php?page=articulo&cod=9960HPRP78001GB",
            91 => "index.php?page=articulo&cod=6920TOSATB5541GB",
            20 => "index.php",
            21 => "index.php",
            22 => "index.php",
            23 => "files/POLITICA%20DE%20CALIDAD%20Y%20MEDIO%20AMBIENTE%20rev%204.pdf",
            24 => "index.php",
            25 => "index.php");

        $arrBannersIndex = array(25, 24, 23);
        $arrTechnoocasion = array();
        $arrLogueados = array();
        $numBanners = count($arrBannersIndex);
        $arrNumBannerAMostrar = array();
        $arrLinkBannerAMostrar = array();

        for ($i=0; $i < $numBanners; $i++) 
        {
            $numBan = $arrBannersIndex[$i];
            $mostrar = true;

            if ( in_array($numBan, $arrTechnoocasion) )
            {
                $mostrar = false;
                if ( $tipoCli == 22 || $tipoCli == 23 || $tipoCli == 24 )
                {
                    $mostrar = true;
                }
            }

            if ( in_array($numBan, $arrLogueados) )
            {
                $mostrar = false;
                if ( $_SESSION['x_usuario']->_conectado==true )
                {
                    $mostrar = true;
                }
            }

            if ($mostrar)
            {
                array_push($arrNumBannerAMostrar, $numBan);
                array_push($arrLinkBannerAMostrar, $arrBanUrls[$numBan]);
            }
        }

        Session::get("entorno")->arrNumBannerAMostrar = $arrNumBannerAMostrar;
        Session::get("entorno")->arrLinkBannerAMostrar = $arrLinkBannerAMostrar;

        $arrRepresentantes = $this-> obtRepNielsenXweb($codCliente);

        $rcod = 0;
        $rnom = '';
        $rmail = '';
        $rtel = '';
        $rext = '';

        foreach ($arrRepresentantes as $arrRepresentante)
        {
            $rcod = $arrRepresentante->rcod;
            $rnom = $arrRepresentante->rnom;
            $rmail = $arrRepresentante->rmail;
            $rtel = $arrRepresentante->rtel;
            $rext = $arrRepresentante->rext;
        }

        Session::get("usuario")->uData->rcod = $rcod;
        Session::get("usuario")->uData->rnom = $rnom;
        Session::get("usuario")->uData->rmail = $rmail;
        Session::get("usuario")->uData->rtel = $rtel;
        Session::get("usuario")->uData->rext = $rext;

        if (session('usuario')->uData->codigo > 0)
        {
            session('usuario')->uData->importeCesta = $this->editarImporteCesta();
            session('usuario')->uData->numArticulosCesta = $this->editarNumArticulosCesta();

            $this->calculoportes();
        }

        //session("usuario")->uData->ctari = 2;
    }

    public function editarImporteCesta()
    {
        $amplMemoria = '';
        $amplDiscoDuro = '';
        $amplTeclado = '';
        $anioActual = date("Y");
        
        $ccodcl = session('usuario')->uData->codigo;
        $tarifa = 2;

        if ($ccodcl > 0)
        {
            $tarifa = session('usuario')->uData->ctari;
        }
        
        session('usuario')->crecargo = "S";
        $paso = 1;
        
        session("articulo")->pagina = "cesta";
        session("articulo")->cargarimagenesencesta = false;
        $articulos = session("articulo")->listar6();

        $this->calculoportes(); 

        session("entorno")->cargaPagoEnvio();
        session("usuario")->datosSubclientes(); 
        session("usuario")->datosCentrosCliente(); 

        session("articulo")->pagina = "cesta";
        session("articulo")->cargarimagenesencesta = false;
        $articulos = session("articulo")->listar6();

        $articulos = session("articulo")->visualizarCesta($articulos, 0, -1, false, 0, $paso);

        $precioCesta = 0;

        foreach ($articulos as $articulo)
        {
            if (array_key_exists('desgloseCesta', session("entorno")))
            {
                $precioCesta = session("entorno")->desgloseCesta->granTotal;
            }
        }

        return $precioCesta;
    }

    public function editarNumArticulosCesta()
    {
        $numArticulosCesta = 0;

        $articulos = session("articulo")->listar6();

        foreach ($articulos as $articulo)
        {
            if (!in_array($articulo->acodar, $this->arrAmpliaciones))
            {
                $numArticulosCesta += $articulo->cantidad;
            }
        }

        return $numArticulosCesta;
    }

    public function log($usuario, $st)
    {
        if ($st == 1) {
            return Utils::vacialogcondicional($usuario);
        }
        if ($st == 2) {
            return Utils::leelogcondicional($usuario);
        }
    }
    public function listener()
    {
        //echo date('H:i:s.').preg_replace("/^.*\./i","", microtime(true))."<br/>";
        DB::listen(function ($query) {
            File::append(
                storage_path('/logs/query.log'),
                microtime(true) . " " . $query->sql . PHP_EOL . PHP_EOL
            );
        });
    }
    public function procesosSecundarios()
    {
        $this->init();
        //Log::info("procesos secundarios");
        //session('usuario')->webOfflineComprobarCambioCodigoCliente(); // procesos que hace al cargar cada página sólo cuando la web es offline (relacionados con la sincronizacion de nuevos clientes)
        $this->enviarMailsDeStockDisponible();
        $this->enviarMailsDeSeguimiento();
        return "ok";
    }
    public function cambiarPropiedades($prop, $val)
    {
        //Log::info($prop."  ".$val);
        $this->init();
        foreach (session('articulo')->matPropiedades as $bloque) {
            if ($bloque->p0->codprop == $prop) {
                foreach ($bloque as $propi) {
                    if ($propi->codval == $val) {
                        $propi->select = true;
                    } else {
                        $propi->select = false;
                    }
                }
            }
        }
    }
    public function cambiarPropiedadesMulti($prop, $val)
    {
        //Log::info($prop."  ".$val);
        $this->init();
        foreach (session('articulo')->matPropiedades as $bloque) {
            if ($bloque->p0->codprop == $prop) {
                foreach ($bloque as $propi) {
                    if ($propi->codval == $val) {
                        $propi->select = !$propi->select;
                    }
                    if ($val == 0) {
                        $propi->select = false;
                    }
                }
            }
        }
    }

    public function pInfo()
    {
        // $laravel = app();
        if (session('usuario')->uData->codigo == 0) {
            return Redirect::to('/');
        }
        //$xweb=session('entorno')->version();
        $laravel = app();
        echo phpinfo() . "Xweb - Laravel " . $laravel::VERSION;
        return "";
    }

    public function idioma($ididioma)
    {
        Cookie::queue(Cookie::forever('idioma', "$ididioma")); // por defecto castellano
        session('entorno')->idioma = null; // reset al idioma cargado
        //session('entorno')->idiomacargado = false;
        return Redirect::to('/');
    }

    public function enviarMailsDeSeguimiento()
    {
        $datosall = session("usuario")->comprobarSeguimiento(); // retorna array con los datos para hacer los envios
        if (count($datosall) == 0) {
            return;
        }
        //var_dump($datosall);
        //echo count($datosall);
        $confm = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
        $confm->dir = "";
        $confm->dirc = ""; // solo lo va a mandar al cliente
        foreach ($datosall as $obe) {
            $datos = array();
            $datos['vista'] = "emails.seguimiento";
            $datos['asunto'] = "Seguimiento de su envío " . $obe->bped;
            $datos['forzarprevio'] = false;
            $datos['nombreUsuario'] = $obe->cnom;
            $datos['nombre'] = $obe->cnom;
            $datos['usuario'] = "";
            $datos['mail'] = $obe->cmail;

            $rutaseg = trim($obe->vlinprod);
            $rutaseg = str_replace('$$codigo', trim($obe->wnum), $rutaseg);
            $rutaseg = str_replace('$$cpostal', trim($obe->ccodpo), $rutaseg);

            $datos['rutaseguimiento'] = $rutaseg;
            $enviado = $this->enviarMail($datos, $confm);
        }
    }

    public function enviarMailsDeStockDisponible()
    {
        $datosall = session("usuario")->comprobarStockDisponibleAvisos(); // retorna array con los datos para hacer los envios
        if (count($datosall) == 0) {
            return;
        }
        //echo count($datosall);
        $confm = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
        $confm->dir = "";
        $confm->dirc = ""; // solo lo va a mandar al cliente
        foreach ($datosall as $obe) {
            //echo $obe->cnom."<br/>";
            //echo $obe->cmail."<br/>";
            //echo $obe->acodar."<br/>";
            //echo $obe->adescr."<br/>";
            //echo $obe->abloqueado."<br/>";
            $datos = array();
            $datos['vista'] = "emails.avisos";
            $datos['asunto'] = "Aviso de disponibilidad";
            $datos['forzarprevio'] = false;

            $datos['nombreUsuario'] = $obe->cnom;
            $datos['nombre'] = $obe->cnom;
            $datos['usuario'] = "";
            $datos['mail'] = $obe->cmail;
            $datos['codigoArticulo'] = $obe->acodar;
            $datos['descripcionArticulo'] = $obe->adescr;
            $datos['articuloBloqueado'] = $obe->abloqueado;
            $enviado = $this->enviarMail($datos, $confm);
        }
    }
    public function enviarMail($datos, $datoscuenta, $pruebas = "nulo", $diradicional = "")
    {
        // todos los envios de mail estan centralizados en esta funcion
        //Config::set('mail.from',array('address'=>'midireccion@xxx.com','name'=>'nombre envia'));
        $forzarprevio = false;
        if (isset($datos['forzarprevio'])) {
            $forzarprevio = $datos['forzarprevio'];
        }

        Config::set('mail.driver', session('entorno')->config->x_maildriver); // "smtp" o "mail", 'smtp' por defecto pero algunos proveedores no lo aceptan y se tiene que configurar a 'mail'
        //Log::info(session('entorno')->config->x_maildriver);
        if ($forzarprevio) {
            //Config::set('mail.driver',"preview"); // si es gmail solo funciona con driver mail
        } else {
            //Config::set('mail.driver',"smtp"); // si es gmail solo funciona con driver mail
        }
        $nombre = $datos['nombre'];
        $usuario = $datos['usuario'];
        $mail = $datos['mail'];
        $mail = str_replace(",", ";", $mail);
        $countx = 1;
        if (strpos($mail, ";") !== false) {
            // si tiene varias direcciones en el campo solo pone la primera
            $x = explode(";", $mail);
            $mail = $x[0];
            $countx = count($x);
        }
        $clave = "";
        if (isset($datos['clave'])) {
            $clave = $datos['clave'];
        }
        // para recuperar contraseña
        $vista = $datos['vista'];
        $asunto = $datos['asunto'];

        $direcciones = null;
        $direcciones = array();
        $dircc = null;
        $dircc = array();
        $a = 0;
        $direcciones[$a] = $mail;
        if (strlen($datoscuenta->dir) > 0) {
            $a++;
            $direcciones[$a] = $datoscuenta->dir; // direccion configurada desde xgest
        }
        if ($countx > 1) {
            // hay dos direcciones separadas por ;
            $a++;
            $direcciones[$a] = $x[1];
        }
        if (strlen($datoscuenta->dirc) > 0) {
            //$a++;
            //$direcciones[$a] = $datoscuenta->dirc; // 2ª direccion configurada desde xgest
            $dircc[0] = $datoscuenta->dirc; // 2ª direccion configurada desde xgest
        }
        if (strlen($diradicional) > 0) {
            $a++;
            $direcciones[$a] = $diradicional; // direccion configurada desde xgest
        }

        // envio normal de correo
        $ok = true;
        switch ($vista) {
            case "emails.devoluciones":
                try {
                    Mail::send("emails.devoluciones", array(
                        'ccodcl' => $datos['ccodcl'],
                        'nomPDF' => $datos['nomPDF'],
                        'numRMA' => $datos['numRMA'],
                    ), function ($message) use ($dircc, $asunto) {
                        $message->to($dircc)->subject($asunto);
                    });
                } catch (\Exception $ex) {
                    Log::info($ex); // envía el error al registro de logs
                    $ok = false;
                }
                break;
            case "emails.rma":
                $directorio = $datos['directorioadjuntos'];
                try {
                    Mail::send($vista, array(
                        'notas' => $datos['notas'],
                    ), function ($message) use ($direcciones, $asunto, $directorio) {
                        $message->to($direcciones)->subject($asunto);
                        $ficheros = scandir($directorio);
                        foreach ($ficheros as $value) {
                            if ($value === '.' || $value === '..') {
                                continue;
                            }
                            $message->attach($directorio . DIRECTORY_SEPARATOR . $value, array('as' => $value));
                            //unlink($datos['directorioadjuntos'].DIRECTORY_SEPARATOR.$value);
                        }
                    });
                } catch (\Exception $ex) {
                    Log::info($ex); // envía el error al registro de logs
                    $ok = false;
                }
                break;
            case "emails.pedido":
                $ccodcl = session('usuario')->uData->codigo;
                $tarifa = 2;
        
                if ($ccodcl > 0)
                {
                    $tarifa = session('usuario')->uData->ctari;
                }
                $formapago = session("usuario")->uData->cforpa;

                $nomFormaPago = $this->getFormaPago($formapago);

                $desgloseCesta = $datos['desgloseCesta'];
                $numPedido = $desgloseCesta->numPedido;
                $numPedido = str_replace("/", "", $numPedido);
                $numPedido = str_replace(" ", "", $numPedido);

                $this->modifyAmpliacionNumPedido($ccodcl, $numPedido);

                $artsCesta = DB::select("
                    SELECT fcl.LCODAR, fcl.LCANTI, fcl.LCODCL, fca.ADESCR, fcl.LPRECI, fcl.LIMPOR
                    FROM fcloc as fcl, fcart as fca
                    WHERE fcl.LCODAR = fca.ACODAR
                    AND fcl.LCODCL = $ccodcl
                    AND LPED = $numPedido");

                foreach ($datos['matrizCesta'] as $articulo)
                {
                    $articulo->ampliacion = array();
                    $articulo->cantAmpliacion = array();
                    $articulo->descrAmpliacion = array();
                    $articulo->precioAmpliacion = array();
                    $articulo->importeAmpliacion = array();

                    if (in_array($articulo->acodar, $this->arrAmpliaciones))
                    {
                        $articulo->esAmpliacion = true;
                        $articulo->tieneAmpliacion = false;
                    }
                    else
                    {
                        $articulo->esAmpliacion = false;
                        $articulo->tieneAmpliacion = false;

                        for ($i = 1; $i <= 3; $i++) 
                        {
                            $arrAmpliaciones = $this->obtAmpliacionesMiCestaByAmpl($ccodcl, 'ampliacion'.$i, $numPedido);

                            foreach ($arrAmpliaciones as $arrAmpliacion)
                            {
                                if ($articulo->acodar == $arrAmpliacion->articulo)
                                {
                                    $articulo->tieneAmpliacion = true;

                                    if ($i == 1)
                                    {
                                        $ampliacion = $arrAmpliacion->ampliacion1;
                                    }
                                    else if ($i == 2)
                                    {
                                        $ampliacion = $arrAmpliacion->ampliacion2;   
                                    }
                                    else if ($i == 3)
                                    {
                                        $ampliacion = $arrAmpliacion->ampliacion3; 
                                    }

                                    $arrDatosArticulos = $this->obtDatosArticulo($ampliacion);

                                    foreach ($arrDatosArticulos as $arrDatoArticulo)
                                    {
                                        array_push($articulo->ampliacion, $ampliacion);
                                        array_push($articulo->cantAmpliacion, $arrAmpliacion->unidades);
                                        array_push($articulo->descrAmpliacion, $arrDatoArticulo->ADESCR);

                                        $precio = 0;

                                        switch ($tarifa) {
                                            case 1:
                                                $precio = $arrDatoArticulo->APVP1;
                                                break;
                                            case 2:
                                                $precio = $arrDatoArticulo->APVP2;
                                                break;
                                            case 3:
                                                $precio = $arrDatoArticulo->APVP3;
                                                break;
                                            case 4:
                                                $precio = $arrDatoArticulo->APVP4;
                                                break;
                                            case 5:
                                                $precio = $arrDatoArticulo->ARESNUM5;
                                                break;
                                            case 6:
                                                $precio = $arrDatoArticulo->ARESNUM6;
                                                break;
                                            default:
                                                $precio = $arrDatoArticulo->APVP1;
                                        }

                                        array_push($articulo->precioAmpliacion, $precio);
                                        array_push($articulo->importeAmpliacion, $precio * $arrAmpliacion->unidades);
                                    }
                                }
                            }
                        }
                    }
                }

                $numArticulosSinAmpliacion = 0;
                $cantArticulosSinAmpliacion = 0;

                foreach ($artsCesta as $articulo)
                {
                    if (!in_array($articulo->LCODAR, $this->arrAmpliaciones)) 
                    {
                        $numArticulosSinAmpliacion += 1;
                        $cantArticulosSinAmpliacion += $articulo->LCANTI;
                    }
                }

                try {
                    if (strlen($datos['adjuntoname']) == 0) {
                        //Log::info("sin adjuntos");
                        Mail::send($vista, array(
                            'desgloseCesta' => $datos['desgloseCesta'],
                            'matrizCesta' => $datos['matrizCesta'],
                            'arrAmpliaciones' => $this->arrAmpliaciones,
                            'direccionesEnvio' => $datos['direccionesEnvio'],
                            'formasPago' => $datos['formasPago'],
                            'formasEnvio' => $datos['formasEnvio'],
                            'nomFormaPago' => $nomFormaPago,
                            'numArticulosSinAmpliacion' => $numArticulosSinAmpliacion,
                            'cantArticulosSinAmpliacion' => $cantArticulosSinAmpliacion,
                        ), function ($message) use ($direcciones, $asunto) {
                            $message->to($direcciones)->subject($asunto);
                        });

                        if (count($dircc) == 1) {
                            Mail::send("emails.pedido", array(
                                'desgloseCesta' => $datos['desgloseCesta'],
                                'matrizCesta' => $datos['matrizCesta'],
                                'direccionesEnvio' => $datos['direccionesEnvio'],
                                'formasPago' => $datos['formasPago'],
                                'formasEnvio' => $datos['formasEnvio'],
                                'nomFormaPago' => $nomFormaPago,
                                'numArticulosSinAmpliacion' => $numArticulosSinAmpliacion,
                                'cantArticulosSinAmpliacion' => $cantArticulosSinAmpliacion,
                            ), function ($message) use ($dircc, $asunto) {
                                $message->to($dircc)->subject($asunto);
                            });
                        }

                    } else {
                        //Log::info("con adjuntos $adjuntoname $adjuntotemp");
                        //$adjuntoname=$datos['adjuntoname'];
                        //$adjuntotemp=$datos['adjuntotemp'];
                        Mail::send($vista, array(
                            'desgloseCesta' => $datos['desgloseCesta'],
                            'matrizCesta' => $datos['matrizCesta'],
                            'direccionesEnvio' => $datos['direccionesEnvio'],
                            'formasPago' => $datos['formasPago'],
                            'formasEnvio' => $datos['formasEnvio'],
                            'nomFormaPago' => $nomFormaPago,
                            'numArticulosSinAmpliacion' => $numArticulosSinAmpliacion,
                            'cantArticulosSinAmpliacion' => $cantArticulosSinAmpliacion,
                        ), function ($message) use ($direcciones, $datos, $asunto) {
                            $message->to($direcciones)->subject($asunto);
                            $message->attach($datos['adjuntotemp'], array('as' => $datos['adjuntoname']));
                        });
                        if (count($dircc) == 1) {
                            Mail::send("emails.pedido", array(
                                'desgloseCesta' => $datos['desgloseCesta'],
                                'matrizCesta' => $datos['matrizCesta'],
                                'direccionesEnvio' => $datos['direccionesEnvio'],
                                'formasPago' => $datos['formasPago'],
                                'formasEnvio' => $datos['formasEnvio'],
                                'nomFormaPago' => $nomFormaPago,
                                'numArticulosSinAmpliacion' => $numArticulosSinAmpliacion,
                                'cantArticulosSinAmpliacion' => $cantArticulosSinAmpliacion,
                            ), function ($message) use ($dircc, $datos, $asunto) {
                                $message->to($dircc)->subject($asunto);
                                $message->attach($datos['adjuntotemp'], array('as' => $datos['adjuntoname']));
                            });
                        }
                        unlink($adjuntotemp);
                    }
                } catch (\Exception $ex) {
                    Log::info($ex); // envía el error al registro de logs
                    $ok = false;
                }
                break;
            case "emails.seguimiento":
                try {
                    Mail::send($vista, array(
                        'datos' => $datos,
                    ), function ($message) use ($direcciones, $asunto) {
                        $message->to($direcciones)->subject($asunto);
                    });
                } catch (\Exception $ex) {
                    Log::info($ex); // envía el error al registro de logs
                    $ok = false;
                }
                break;
            default:
                try {
                    Mail::send($vista, array(
                        'datos' => $datos,
                    ), function ($message) use ($direcciones, $asunto) {
                        $message->to($direcciones)->subject($asunto);
                    });
                } catch (\Exception $ex) {
                    Log::info($ex); // envía el error al registro de logs
                    $ok = false;
                }
                break;
        }
        return $ok;
    }
    public function cambiarclave($codigo)
    {
        $this->init();
        //echo Request::isMethod('post')?"post":"get";
        if (Request::isMethod('post')) {
            //var_dump(print_r(Input::all(),true));
            $data = session('usuario')->cambiarClave(Input::all());
            $exito = $data['exito'];
            $errtext = "Datos erróneos, reintente. " . $data['errors'];
            if ($exito) {
                $exito = false;
                $errtext = "Correcto, datos actualizados.";
            }
        }
        if (Request::isMethod('get')) {
            $exito = true;
            $errtext = "";
        }
        return View('cambiarclave')->with(['codigo' => $codigo, 'exito' => $exito, 'descripcion' => $errtext]);
    }
    public function recordarclave()
    {
        $this->init();
        $codigo = Input::get("usuario");
        // $datos = Input::all(); // cName cMail cTel cConsulta
        $cdlen = strlen($codigo);
        $forzarprevio = $codigo == "josejavier@xgestevo.net" && Request::ajax() == false ? true : false; // para pruebas, poder verlo en pantalla
        $forzarprevio = false;
        if (Request::ajax() == true && $cdlen > 0 || $forzarprevio) {
            // $codigo es el usuario/mail
            // llama a funcion que genera una solicitud de restablecer clave, devuelve los datos necesarios para mandar un mail
            $datos = session('usuario')->recordarclave($codigo); // clave puede ser 'error' ó una cadena de 20 caracteres
            switch ($datos['exito']) {
                case false:
                    return array(
                        'exito' => false,
                        'respuesta' => "Usuario/Correo no encontrado",
                    );
                    break;
                default:
                    // envío de correo electrónico con ruta para restaurar contraseña
                    $confm = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
                    //Log::info(print_r($confm, true));
                    $datos['vista'] = "emails.recordarclave";
                    $datos['asunto'] = "Recuperar contraseña";
                    $datos['forzarprevio'] = $forzarprevio;
                    $nombre = $datos['nombre'];
                    $usuario = $datos['usuario'];
                    $direccion = $datos['mail'];
                    $clave = $datos['clave'];
                    $rutarecuperar = url('/cambiarclave/' . $clave);
                    $datos['clave'] = $rutarecuperar;
                    if ($forzarprevio) {
                        return view("emails.recordarclave")->with('datos', $datos);
                    }
                    $enviado = $this->enviarMail($datos, $confm);
                    //Log::info($datos);
                    switch ($enviado) {
                        case false:
                            return array(
                                'exito' => false,
                                'respuesta' => "Error en el envío de correo, por favor contacte con nosostros.",
                            );
                            break;
                        case true:
                            return array(
                                'exito' => true,
                                'respuesta' => "Se ha enviado un correo a su dirección, compruebe la bandeja de entrada.",
                            );
                            break;
                    }
                    break;
            }
        }
        if (Request::ajax() == false && $cdlen > 0) {
            // llamamos a la vista de nueva contraseña
        }
        if (Request::ajax() == true && $cdlen == 0) {
            // este caso no deberia ocurrir
            return View('index');
            return array(
                'exito' => false,
                'respuesta' => "no permitido",
            );
        }
        if (Request::ajax() == false && $cdlen == 0) {
            // este caso no deberia ocurrir
            return View('index');
            return array(
                'exito' => false,
                'respuesta' => "no permitido",
            );
        }
    }
    public function registro()
    {
        $this->init();
        if (session('entorno')->config->x_bloqregistro == true) {
            //echo "errMail";
            return View('error');
        }
        return View('registrousuario')->with(["exito" => true]);
        return View('registrousuario');
        return View('registrousuario')->with("matrizMail", $confm);
        return View('registroBasico')->with("matrizMail", $confm);
        return View('registroSinNombreUsuario')->with("matrizMail", $confm); // mismo form de registro pero no pide nombre usuario, usa el correo
    }
    public function modificarRegistro()
    {
        $this->init();
        if (session('usuario')->uData->codigo == 0) {
            return Redirect::to('/');
        }
        if (Request::ajax() == false) {
            return array(
                'exito' => false,
                'errors' => 'invalidRequest',
            );
        }
        $datos = Input::all();
        $omitir_dni_claveactual = false;
        $datos = session('usuario')->modificacionCliente($datos, $omitir_dni_claveactual);
        if ($datos['exito'] == false) {
            return $datos;
        }
        $enviarmail = false; // si marcamos a false no se envia correo de confirmación al cliente
        switch ($enviarmail) {
            case true:
                // envío de correo electrónico
                $confm = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
                $datos['vista'] = "emails.modificacioncliente";
                $datos['asunto'] = "Modificación de datos de cliente";

                $datos['nombre'] = $datos['nombreCliente'];
                $datos['usuario'] = $datos['nombreUsuario'];
                $datos['mail'] = $datos['eMail'];
                $enviado = $this->enviarMail($datos, $confm);
                switch ($enviado) {
                    case false:
                        // intenta enviar el correo pero no consigue
                        return array(
                            'exito' => true,
                            'destino' => URL::to(''),
                            'errors' => "Datos de cliente actualizados.",
                        );
                        break;
                    case true:
                        return array(
                            'exito' => true,
                            'destino' => URL::to('micuenta/datos'),
                            'errors' => "Se ha enviado un correo a su dirección con los datos actualizados, compruebe la bandeja de entrada.",
                        );
                        break;
                }
                break;
            case false:
                $datos['errors'] = "Datos de cliente actualizados.";
                return $datos;
                break;
        }
        return $datos;
    }

    public function completarRegistro()
    {
        $this->init();
        $datos = Input::all();
        if (Request::ajax() == false) {
            return array(
                'exito' => false,
                'errors' => 'invalidRequest',
            );
        }
        $datos = session('usuario')->registroCliente($datos);
        if ($datos['exito'] == false) {
            return $datos;
        }


        $portugal = strrpos($datos['codigoPostal'], "-");
        $portugal2 = strrpos($datos['dni'], "PT");

        $strCP = substr($datos['codigoPostal'], 0, 2);
        $cn_nombre = $datos['nombreCliente'];
        $cn_sector = $datos['actividadCliente'];


        $arrArea1 = array('39', '48', '20', '01', '31', '26', '09', '34');
        $arrArea2 = array('17', '43', '25', '22', '50', '07');
        $arrArea21 = array('08');
        $arrArea3 = array('12', '46', '03', '30', '02');
        $arrArea4 = array('04', '23', '18', '29');
        $arrArea5 = array('11', '14', '06', '21');
        $arrArea51 = array('41');
        $arrArea6 = array('10', '45', '13', '16', '19', '44', '42', '40', '05', '37', '47', '49');
        $arrArea61 = array('28');
        $arrArea7 = array('15', '36', '32', '27', '33', '24');
        $arrArea8 = array('35', '38');

        $areaCliente = 0;
        if ( in_array($strCP, $arrArea1) ) { $areaCliente = 10; }
        if ( in_array($strCP, $arrArea2) ) { $areaCliente = 20; }
        if ( in_array($strCP, $arrArea21) ) { $areaCliente = 21; }
        if ( in_array($strCP, $arrArea3) ) { $areaCliente = 30; }
        if ( in_array($strCP, $arrArea4) ) { $areaCliente = 40; }
        if ( in_array($strCP, $arrArea5) ) { $areaCliente = 50; }
        if ( in_array($strCP, $arrArea51) ) { $areaCliente = 51; }
        if ( in_array($strCP, $arrArea6) ) { $areaCliente = 60; }
        if ( in_array($strCP, $arrArea61) ) { $areaCliente = 61; }
        if ( in_array($strCP, $arrArea7) ) { $areaCliente = 70; }
        if ( in_array($strCP, $arrArea8) ) { $areaCliente = 80; }

        // Autoescuelas y colegios van a zona 90
        $pos = strpos(strtolower($cn_nombre), strtolower("Autoescuela"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_nombre), strtolower("Colegio"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_nombre), strtolower("Formacion"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_nombre), strtolower("Formación"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_nombre), strtolower("Instituto"));
        if ($pos !== false) { $areaCliente = 90; }

        // Buscar por Actividad
        $pos = strpos(strtolower($cn_sector), strtolower("Autoescuela"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_sector), strtolower("Colegio"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_sector), strtolower("Formacion"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_sector), strtolower("Formación"));
        if ($pos !== false) { $areaCliente = 90; }
        $pos = strpos(strtolower($cn_sector), strtolower("Instituto"));
        if ($pos !== false) { $areaCliente = 90; }


        if ($portugal != false)
        {
            $areaCliente = 80;
        }

        if ($portugal2 != false)
        {
            $areaCliente = 80;
        }

        $emailComercial = "";

        if ($areaCliente == 10) { $emailComercial = ", ventas4@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 20) { $emailComercial = ", ventas9@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 21) { $emailComercial = ", ventas1@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 30) { $emailComercial = ", ventas1@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 40) { $emailComercial = ", ventas7@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 50) { $emailComercial = ", ventas5@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 51) { $emailComercial = ", ventas5@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 60) { $emailComercial = ", ventas2@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 61) { $emailComercial = ", ventas2@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 70) { $emailComercial = ", ventas7@diginova.es, pedidos@diginova.es"; }
        else if ($areaCliente == 80) { $emailComercial = ", portugal@diginova.es"; }
        else if ($areaCliente == 90) { $emailComercial = ", pedidos@diginova.es"; }
        else { $emailComercial = "pedidos@diginova.es"; }

        $codigonuevocliente = $datos['codigoCliente'];

        if($codigonuevocliente > 0)
        {
            DB::update("UPDATE fccli set CZONA = $areaCliente, CBLOQUEADO = 'N' WHERE CCODCL = $codigonuevocliente");
        }


        $datos['errors'] = "Cliente registrado, revise su cuenta de mail para activar su cuenta. Si no recibe el mail revise su carpeta de correo no deseado.";
        $datos['destino'] = URL::to('');
        $enviarmail = true; // si marcamos a false no se envia correo de confirmación al cliente
        switch ($enviarmail) {
            case true:
                // envío de correo electrónico
                $confm = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
                $datos['vista'] = "emails.registrocliente";
                $datos['asunto'] = "Registro de nuevo cliente";
                $datos['nombre'] = $datos['nombreCliente'];
                $datos['usuario'] = $datos['nombreUsuario'];
                $datos['mail'] = $datos['eMail'];
                $enviado = $this->enviarMail($datos, $confm);
                switch ($enviado) {
                    case false:
                        // intenta enviar el correo pero no consigue
                        $codigonuevocliente = $datos['codigoCliente'];
                        $inst = "update " . session('entorno')->tablas->cli . " set cbloqueado='N', ctipocli = 90, cforpa = 14, czona = '$areaCliente', CMAIL4 = '$emailComercial', CREPRE = 104 where ccodcl=$codigonuevocliente";
                        DB::update($inst);
                        return array(
                            'exito' => true,
                            'destino' => URL::to(''),
                            'errors' => "Cliente registrado, puede iniciar sesión.",
                        );
                        break;
                    case true:
                        return array(
                            'exito' => true,
                            'destino' => URL::to('mensajes/registro'),
                            'errors' => "Se ha enviado un correo a su dirección, compruebe la bandeja de entrada.",
                        );
                        break;
                }
                break;
            case false:
                $codigonuevocliente = $datos['codigoCliente'];
                $inst = "update " . session('entorno')->tablas->cli . " set cbloqueado='N', ctipocli = 90, cforpa = 14, czona = '$areaCliente', CMAIL4 = '$emailComercial', CREPRE = 104 where ccodcl=$codigonuevocliente";
                DB::update($inst);
                $datos['errors'] = "Cliente registrado, puede iniciar sesión.";
                return $datos;
                break;
        }
    }

    public function activarCuenta($clave, $codigo)
    {
        $this->init();
        $clave = Utils::mysqlRealEscape($clave, false);
        $codigo = Utils::mysqlRealEscape($codigo, false);
        $result = DB::select("select codigo,codigoxgest from aaaa_web_nuevosclientes where clave='$clave' and codigo=$codigo");
        if (count((array) $result) == 0) {
            return View('activarcuenta')->with("texto", "Datos incorrectos");
        }
        $codigo2 = $result[0]->codigoxgest;
        $codigofinal = $codigo2 > 0 ? $codigo2 : $codigo;
        DB::update("update aaaa_web_nuevosclientes set clave='' where codigo=$codigo and codigoxgest=$codigo2");
        DB::update("update " . session('entorno')->tablas->cli . " set cbloqueado='N' where ccodcl=$codigofinal");
        return View('activarcuenta')->with("texto", "Datos correctos, puede iniciar sesión");
    }
    public function iniciosesion()
    {
        $this->init();
        if (Request::ajax() == false) {
            return (array(
                'msg' => 'no ajax',
                'exito' => false,
            ));
        }
        $alp = Utils::md5Password(trim(Input::get("password")));

        //Log::info( trim ( Input::get ( "password" ) ) );
        //Log::info($alp);

        $correcto = session("usuario")->inicioSesion(Input::get("usuario"), $alp);
        //$logged = (!$correcto) ? false : true;
        if ($correcto) {
            //Log::info("login");
            //session("menu")->generarMenu(Input::get("user"));
            //session("usuario")->cargarCesta(0, 2);
        }

        return (array(
            'msg' => $alp . "",
            'exito' => $correcto,
        ));
    }
    public function cerrarsesion()
    {
        //session("entorno")->desgloseCesta->direccionEnvio = -1;

        $dir = storage_path('framework/sessions/*'); // "cache/"; /** define the directory **/
        foreach (glob($dir) as $file) {
            if (filemtime($file) < time() - (3600 * 24 * 15)) { // 1 hour
                unlink($file);
            }
        }
        Session::forget("entorno");
        Session::forget("usuario");
        Session::forget("articulo");
        //Session::forget("menu");
        return Redirect::to('/');
    }
    public function reset()
    {
        //$this->init();
        Cookie::queue(Cookie::forever('idioma', '1')); // por defecto castellano
        Session::forget("entorno");
        Session::forget("usuario");
        Session::forget("menu");
        Session::forget("articulo");
        Cookie::forget('flash');
        Session::regenerate();
        Session::flush();
        return Redirect::to('/')->withCookie('flash');
    }
    public function encode($clave){
        echo Utils::codificarPassword($clave,"e");
        return;
    }
    public function test()
    {
        $this->init();
        // testea la conexion a mysql FUERA DEL 
        $host = Config::get('database.connections.mysql.host');
        $port = Config::get('database.connections.mysql.port');
        $database = Config::get('database.connections.mysql.database');
        $usu = Config::get('database.connections.mysql.username')."";
        $pas = Config::get('database.connections.mysql.password');
        echo "test de conexión<!--$host--><br/>";
        try {
            $conn = new \PDO("mysql:host=$host;port=$port;dbname=$database", $usu, $pas);
            // set the PDO error mode to exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            echo "Conexión correcta";
          } catch(\PDOException $e) {
            echo "Fallo conexión: " . $e->getMessage();
          }
          
        return;

        if (Schema::hasTable("atest") == false) {
            Schema::create('atest', function ($table) {
                $table->increments('id');
                $table->timestamps();
                $table->engine = "InnoDB";
            });
        }
        return View('test');
    }

    function esEquipoGrande($famCompra)
    {
        $esGrande = false;

        $arrFamGrandes = array(501, 502, 505, 551, 552, 553, 545, 555, 556, 563);

        if (in_array($famCompra, $arrFamGrandes))
        {
            $esGrande = true;
        }

        return $esGrande;
    }

    public function calculoportes()
    {
        $ccodcl = session('usuario')->uData->codigo;
        $arrSujetos = DB::select("SELECT cinvsujpas FROM fccli WHERE ccodcl = $ccodcl");

        $descuentoPortes = 0;
        $codigodeportes = "PO"; // codigo de portes si no hay articulos de ocasion
        $importeportes = 0;
        //echo 'Importe1 '.$importeportes.' *** ';
        $codigodeportesadicionales = "POA"; // codigo de articulo para portes adicionales
        $importeportesadicionales = 0; // importe para portes adicionales (2e por unidad de articulo de ocasion)

        $es_sujetopasivo = false;

        foreach ($arrSujetos as $sujpas)
        {
            if ($sujpas->cinvsujpas == 'S') 
            { 
                $es_sujetopasivo = true; 
            }
        }

        $todosSonSP = true;
        $hayGrandesOMoviles = false;  // Si hay al menos un artículo (FamCompra 500-559 + 562-566 + 580 - 599)
        $hayImpresoras = false;  // Si hay al menos un artículo (FamCompra 567)
        $esUnPack = false;

        // Variables auxiliares para POA(S)
        $poaImpGrandes = 0;
        $poaImpPortatiles = 0;

        // Artículos para Portu: comprendidos entre fam 501 - 556.  Si llevan al menos 2: portes gratis
        $articsPortu = 0;

        $articulos = session("articulo")->listar6();
        session("entorno")->cargaPagoEnvio();
        session("usuario")->datosSubclientes();
        $articulos = session("articulo")->visualizarCesta($articulos, 0, -1, false, 0, 1);

        $codigoarticulo = "";
        $cantidad = -1;
        $famCompra = 0;
        $famVenta = 0;

        foreach ($articulos as $ces)
        {
            $codigoarticulo = $ces->acodar;
            $famCompra = $this->obtFamiliaCompra($ces->acodar);
            $famVenta = $this->obtFamiliaVenta($ces->acodar);

            if (!in_array($ces->acodar, $this->arrAmpliaciones)) 
            {
                if ($ces->acodar != '91019901P')
                {
                    if (($famCompra >= 501 && $famCompra <= 556) || $famCompra == 560 || $famCompra == 563)
                    {
                        $cantidad = $cantidad + $ces->cantiCesta;
                    }
                }
            }

            if (strpos( $codigoarticulo, "695099") === false) 
            {  
                // Compruebo si la familia de ventas es finvsujpas == 'S'
                $arrFsujs = DB::select("SELECT finvsujpas FROM fcfcp WHERE fcod = $famVenta");
                
                foreach ($arrFsujs as $arrFsuj)
                {
                    if ($arrFsuj->finvsujpas == 'N') 
                    { 
                        $todosSonSP = false;
                    }
                }
            }

            // Si el artículo es un pack
            if ($codigoarticulo == 'PACK1' || $codigoarticulo == 'PACK2')
            {
                $esUnPack = true;
            }


            // Impresoras
            if ($famCompra == 567)
            {
                $hayImpresoras = true;
            }

            // Compruebo si pertenece a "Grandes" o "Móviles/Tablets"
            if ( ($famCompra >= 500 && $famCompra <= 560) || ($famCompra >= 562 && $famCompra <= 566) || ($famCompra >= 580 && $famCompra <= 599)
                    || ($famVenta == 1010) || ($famVenta == 1011) || ($famVenta == 1000) || ($famVenta == 1001) || ($famCompra == 115)  )
            {
                $hayGrandesOMoviles = true;
            }

            // Si el artículo es "Grande" aumento el importe POA auxiliar
            if ( ($famCompra >= 500 && $famCompra <= 560) || ($famCompra >= 562 && $famCompra <= 566) || ($famCompra == 115) || ($famCompra == 567) )
            {
                $poaImpGrandes += 2 * $cantidad;
            }

            // Si el artículo es "Portátil" aumento el importe POA auxiliar para SP
            if ( $famCompra >= 520 && $famCompra <= 529 || $famVenta == 701 )
            {
                $poaImpPortatiles += 2 * $cantidad;
            }

            // Si el artículo es un Pack
            if ( $famCompra == 561 && $famVenta == 2 )
            {
                $poaImpPortatiles += 2 * $cantidad;
            }


            if ( ($famCompra >= 501 && $famCompra <= 556 ) || $famCompra == 563 || $famCompra == 560 )
            {
                $articsPortu += $cantidad;
            }

            // ========== Si el cliente es SP ==========
            if ($es_sujetopasivo)
            {
                if ($todosSonSP)
                {
                    $codigodeportes = "POGS";
                    $importeportes = 7.90;
                    //echo 'Importe2 '.$importeportes.' *** ';
                    $codigodeportesadicionales = "POAS";
                    $importeportesadicionales = $poaImpPortatiles;
                }
                else
                {
                    // Si hay al menos un artículo (FamCompra 500-559 + 562-566 + 580 - 599)
                    if ($hayGrandesOMoviles || $hayImpresoras)
                    {
                        $codigodeportes = "POG";
                        $importeportes = 7.90;
                        //echo 'Importe3 '.$importeportes.' *** ';

                        if ($hayImpresoras)
                        {
                            $codigodeportes = "POV";
                            $importeportes = 9.90;
                            //echo 'Importe4 '.$importeportes.' *** ';
                        }

                        $codigodeportesadicionales = "POA";
                        $importeportesadicionales = 2 * $cantidad;
                    }
                    // Si NO hay ningún artículo (FamCompra 500-559 + 562-566 + 580 - 599)
                    else
                    {

                        /*if ($importeventa >= 300)
                        {
                            $importeportes = 0;
                            $importeportesadicionales = 0;
                        }
                        else
                        {
                            $codigodeportes = "PO";
                            $importeportes = 5.90;
                        }*/

                        $codigodeportes = "PO";
                        $importeportes = 5.90;
                        //echo 'Importe5 '.$importeportes.' *** ';

                        if ($esUnPack)
                        {
                            $codigodeportes = "PO";
                            $importeportes = 5.90;
                            $codigodeportesadicionales = "POA";
                            $importeportesadicionales = $poaImpPortatiles + 2;
                        }
                    }
                }
            }
            // ========== Si el cliente no es SP ==========
            else
            {
                // Si hay al menos un artículo (FamCompra 500-559 + 562-566 + 580 - 599)
                if ($hayGrandesOMoviles || $hayImpresoras)
                {
                    $codigodeportes = "POG";
                    $importeportes = 7.90;
                    //echo 'Importe7 '.$importeportes.' *** ';

                    if ($hayImpresoras)
                    {
                        $codigodeportes = "POV";
                        $importeportes = 9.90;
                        //echo 'Importe8 '.$importeportes.' *** ';
                    }

                    $codigodeportesadicionales = "POA";
                    $importeportesadicionales = $poaImpGrandes;
                }
                // Si no hay artículos "Grandes o móviles"
                else
                {
                    /*if ($importeventa >= 300)
                    {
                        $importeportes = 0;
                        $importeportesadicionales = 0;
                    }
                    else
                    {
                        $codigodeportes = "PO";
                        $importeportes = 5.90;
                    }*/

                    $codigodeportes = "PO";
                    $importeportes = 5.90;
                    //echo 'Importe9 '.$importeportes.' *** ';

                    if ($esUnPack)
                    {
                        $codigodeportes = "PO";
                        $importeportes = 7.90;
                        $codigodeportesadicionales = "POA";
                        $importeportesadicionales = $poaImpPortatiles + 2;
                    }
                }
            }

            // ========== Portes para BALEARES ==========
            $esBaleares = false;
            $codPostal = session('usuario')->datosCliente()->cpostal;
            $codPostalStr = substr($codPostal, 0, 2);
            if ($codPostalStr == "07") { $esBaleares = true; }


            if ($esBaleares)
            { 
                $equiposGr = 0;
                $equiposPeq = 0;

                foreach ($articulos as $ces)
                {
                    $codigoarticulo = $ces->acodar;
                    $cantidad = $ces->cantiCesta;
                    $famCompra = $this->obtFamiliaCompra($ces->acodar);
                    $famVenta = $this->obtFamiliaVenta($ces->acodar);

                    // Si es de tipo conversión de teclado, compruebo si el artículo es SP
                    if ( strpos($codigoarticulo, "695099") === false) 
                    { 
                        $arrFsujs = DB::select("SELECT finvsujpas FROM fcfcp WHERE fcod = $famVenta");
                
                        foreach ($arrFsujs as $arrFsuj)
                        {
                            if ($fSujPas->finvsujpas == 'N') { $todosSonSP = false; }
                        }
                    }


                    // === Variables para contar los equipos grandes y pequeños
                    $esGrande = $this->esEquipoGrande($famCompra);

                    if ($esGrande) { $equiposGr += $cantidad; }
                    else { $equiposPeq += $cantidad; }
                }

                foreach ($articulos as $ces)
                {
                    $codigoarticulo = $ces->acodar;
                    $cantidad = $ces->cantiCesta;
                    $famCompra = $this->obtFamiliaCompra($ces->acodar);
                    $famVenta = $this->obtFamiliaVenta($ces->acodar);

                    // Si es de tipo conversión de teclado, compruebo si el artículo es SP
                    if (strpos($codigoarticulo, "695099" ) === false) 
                    {  
                        // Compruebo si la familia de ventas es finvsujpas == 'S'
                        $arrFsujs = DB::select("SELECT finvsujpas FROM fcfcp WHERE fcod = $famVenta");
                
                        foreach ($arrFsujs as $arrFsuj)
                        {
                            if ($fSujPas->finvsujpas == 'N') { $todosSonSP = false; }
                        }
                    }


                    // === Variables para contar los equipos grandes y pequeños
                    $esGrande = $this->esEquipoGrande($famCompra);

                    if ($esGrande) { $equiposGr += $cantidad; }
                    else { $equiposPeq += $cantidad; }

                }

                /*
                    Equipos pequeños: Portátiles y Tiny`s: 8€ primera unidad + 4€ x unidad extra
                    Equipos grandes: SFF´s, USDT´s y monitores: 12€ primera unidad + 9€ x unidad extra               

                    - Cuando se pida un Equipo grande, se entiende que la primera unidad es suya                 

                    Ej. 1 portátil y 2 sff: 12€ del primer sff, 9€ del segundo y 4€ del portátil: 25€ + IVA
                    Ej. 2 portátiles y 1 sff: 12€ del sff + 4€ + 4€: 20€ + IVA
                */  

                $importeportes = 0;
                //echo 'Importe11 '.$importeportes.' *** ';
                $importeportesadicionales = 0;
                $eqGrPorte = 12; $equiposGrPorteAdicional = 9;
                $eqPeqPorte = 8; $equiposPeqPorteAdicional = 4;

                // Si hay algún equipo grande, el porte base es el de 1 unidad de equipo grande
                if ($equiposGr > 0) 
                {
                    $importeportes = $eqGrPorte;
                    //echo 'Importe12 '.$importeportes.' *** ';

                    $eqGrandesRestantes = $equiposGr - 1;
                    $importeportesadicionales += ($eqGrandesRestantes * $equiposGrPorteAdicional);
                    $importeportesadicionales += ($equiposPeq * $equiposPeqPorteAdicional);
                }
                else
                {
                    $importeportes = $eqPeqPorte;
                    //echo 'Importe13 '.$importeportes.' *** ';
                    $eqPeqRestantes = $equiposPeq - 1;
                    $importeportesadicionales = ($eqPeqRestantes * $equiposPeqPorteAdicional);
                }
            }

            $ctipocli = session("usuario")->uData->ctipocli;
            // Si el cliente es de Sevilla y el importe venta es > 100, portes gratis
            if($ctipocli == 30)
            {
                $importeportes = 0;
                //echo 'Importe14 '.$importeportes.' *** ';
                $importeportesadicionales = 0;
            }

            $arrReps = $this->obtZonaCliente($ccodcl);
            $repZona = 0;

            foreach ($arrReps as $arrRep)
            {
                $repZona = $arrRep->czona;
            }

            $czona = 0;
            if ($repZona != 0)
            {
                $czona = $repZona;
            }

            $porteConDescuento = false;


        }

        //echo 'Importe16 '.$importeportes.' *** '.$codigodeportes.' *** '.$importeportesadicionales.' *** '.$codigodeportesadicionales.' *** ';
        if($importeportes > 0) 
        {
            //echo 'Importe17 '.$codigodeportes.' *** ';
            session("articulo")->deleteArticulo('PO');
            session("articulo")->deleteArticulo('POG');
            session("articulo")->deleteArticulo('POV');
            session("articulo")->deleteArticulo('POGS');
            session("articulo")->addArticulo($codigodeportes, 1, 0, true);
        }

        if ($importeportesadicionales > 0 && $cantidad > 0)
        {
            session("articulo")->deleteArticulo('POA');
            session("articulo")->deleteArticulo('POAS');
            session("articulo")->addArticulo($codigodeportesadicionales, $cantidad, 0, true);
        }
    }

    public function obtFamiliaCompra($acodar)
    {
        $famCompra = 0;
        $arrFamilias = DB::select("SELECT AFAMILIA FROM fcart WHERE ACODAR = '$acodar'");

        foreach ($arrFamilias as $arrFamilia)
        {
            $famCompra = $arrFamilia->AFAMILIA;
        }

        return $famCompra;
    }

    public function obtFamiliaVenta($acodar)
    {
        $famVenta = 0;
        $arrFamilias = DB::select("SELECT ARESNUM4 FROM fcart WHERE ACODAR = '$acodar'");

        foreach ($arrFamilias as $arrFamilia)
        {
            $famVenta = $arrFamilia->ARESNUM4;
        }

        return $famVenta;
    }

    public function index()
    {
        $this->init();
        //$this->idioma;
        //session("menu")->generarMenu(); // carga los datos de menu cada vez que pasa por la portada
        session("articulo")->pagina = "portada";
        session("articulo")->cargarimagenesdearticulos = true;
        $articulos = session("articulo")->listar6();

        $ccodcl = session('usuario')->uData->codigo;

        $arrFavoritos = DB::select("SELECT fcodar FROM favoritos WHERE fcodcl = '$ccodcl'");

        $arrOrdenadores = DB::select("
                            SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ATIPO2, a.AFAMILIA, s.ASTOCK, fil.fil1, fil.fil2, fil.fil3, fil.fil4, fil.fil5, fil.fil6, fil.fil7, fil.fil8, fil.fil9, fil.fil10, fil.fil11, fil.fil12
                            FROM fcart AS a, fcstk AS s, filtroart AS fil
                            WHERE a.ACODAR = s.ACODAR
                            AND a.ACODAR = fil.ACODAR
                            AND s.AALM = 1
                            AND s.ASTOCK > 0
                            AND a.ABLOQUEADO = 'N' 
                            AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                            AND a.ARESSN2 = 'N'  
                            AND a.AFAMILIA BETWEEN 100 AND 569 
                            AND a.ARESNUM4 BETWEEN 1 AND 9999 
                            AND a.ARESNUM4 <> 1450
                            AND ((a.AFAMILIA >= 501 AND a.AFAMILIA <= 505) OR a.AFAMILIA = 563)
                            ORDER BY a.ACODAR DESC");

        $arrPortatiles = DB::select("
                            SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ATIPO2, a.AFAMILIA, s.ASTOCK, fil.fil1, fil.fil2, fil.fil3, fil.fil4, fil.fil5, fil.fil6, fil.fil7, fil.fil8, fil.fil9, fil.fil10, fil.fil11, fil.fil12 
                            FROM fcart AS a, fcstk AS s, filtroart AS fil
                            WHERE a.ACODAR = s.ACODAR
                            AND a.ACODAR = fil.ACODAR
                            AND s.AALM = 1
                            AND s.ASTOCK > 0 
                            AND a.ABLOQUEADO = 'N' 
                            AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                            AND a.ARESSN2 = 'N'  
                            AND a.AFAMILIA BETWEEN 100 AND 569 
                            AND a.ARESNUM4 BETWEEN 1 AND 9999 
                            AND a.ARESNUM4 <> 1450
                            AND ((a.AFAMILIA >= 521 AND a.AFAMILIA <= 529) OR a.AFAMILIA = 560)
                            ORDER BY a.ACODAR DESC");

        $arrMonitores = DB::select("
                            SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ATIPO2, a.AFAMILIA, s.ASTOCK, fil.fil1, fil.fil2, fil.fil3, fil.fil4, fil.fil5, fil.fil6, fil.fil7, fil.fil8, fil.fil9, fil.fil10, fil.fil11, fil.fil12 
                            FROM fcart AS a, fcstk AS s, filtroart AS fil
                            WHERE a.ACODAR = s.ACODAR
                            AND a.ACODAR = fil.ACODAR 
                            AND s.AALM = 1 
                            AND s.ASTOCK > 0
                            AND a.ABLOQUEADO = 'N' 
                            AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                            AND a.ARESSN2 = 'N'  
                            AND a.AFAMILIA BETWEEN 100 AND 569 
                            AND a.ARESNUM4 BETWEEN 1 AND 9999 
                            AND a.ARESNUM4 <> 1450
                            AND (a.AFAMILIA >= 551 AND a.AFAMILIA <= 556)
                            ORDER BY a.ACODAR DESC");

        $arrOfertas = DB::select("SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
            FROM fcofe o, fcart a
            WHERE o.OCODAR = a.ACODAR 
            AND CURDATE() between o.OFECINI AND o.OFECFIN 
            AND a.ASTOCK > 0 
            AND a.ABLOQUEADO = 'N' 
            AND a.APVP1 > 0  
            AND a.ARESSN2 = 'N'
            ORDER BY rand()");

        $this->refArticuloAnterior = '';
        $this->acodarAnterior = '';

        $this->precioArtAnterior = 100000;

        foreach ($arrOrdenadores as $arrDatoArticulo)
        {
            $arrDatoArticulo->esOferta = $this->esOferta($arrDatoArticulo->ACODAR, $arrOfertas);

            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);

            $tieneTeclado = false;

            if ($arrDatoArticulo->ATIPO2 != 0)
            {
                if (($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529) || ($arrDatoArticulo->AFAMILIA == 560))
                {
                    $tieneTeclado = true;
                }
            }

            $arrDatoArticulo->tieneTeclado = $tieneTeclado;
            $arrDatoArticulo->imag1 = $this -> obtImagenArt($arrDatoArticulo->ADESCR);

            $this->mostrarFavorito($arrDatoArticulo, $arrFavoritos);
        }

        foreach ($arrPortatiles as $arrDatoArticulo)
        {
            $arrDatoArticulo->esOferta = $this->esOferta($arrDatoArticulo->ACODAR, $arrOfertas);

            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);

            $tieneTeclado = false;

            if ($arrDatoArticulo->ATIPO2 != 0)
            {
                if (($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529) || ($arrDatoArticulo->AFAMILIA == 560))
                {
                    $tieneTeclado = true;
                }
            }

            $arrDatoArticulo->tieneTeclado = $tieneTeclado;
            $arrDatoArticulo->imag1 = $this -> obtImagenArt($arrDatoArticulo->ADESCR);

            $this->mostrarFavorito($arrDatoArticulo, $arrFavoritos);
        }

        foreach ($arrMonitores as $arrDatoArticulo)
        {
            $arrDatoArticulo->esOferta = $this->esOferta($arrDatoArticulo->ACODAR, $arrOfertas);

            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);

            $tieneTeclado = false;

            if ($arrDatoArticulo->ATIPO2 != 0)
            {
                if (($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529) || ($arrDatoArticulo->AFAMILIA == 560))
                {
                    $tieneTeclado = true;
                }
            }

            $arrDatoArticulo->tieneTeclado = $tieneTeclado;
            $arrDatoArticulo->imag1 = $this -> obtImagenArt($arrDatoArticulo->ADESCR);

            $this->mostrarFavorito($arrDatoArticulo, $arrFavoritos);
        }

        shuffle($arrOrdenadores);
        shuffle($arrPortatiles);
        shuffle($arrMonitores);

        $arrOrdenadores = array_slice($arrOrdenadores, 0, 4);
        $arrPortatiles = array_slice($arrPortatiles, 0, 4);
        $arrMonitores = array_slice($arrMonitores, 0, 4);
        $categoria = 0;

        return View('index')->with(array("seccion" => "inicio"))
                            ->with("arrOrdenadores", $arrOrdenadores)
                            ->with("arrPortatiles", $arrPortatiles)
                            ->with("arrMonitores", $arrMonitores)
                            ->with("arrOfertas", $arrOfertas)
                            ->with("arrRefRepetidas", $this->arrRefRepetidas)
                            ->with("arrRefOcultas", $this->arrRefOcultas)
                            ->with("categoria", $categoria)
                            ->with("esPortada", true)
                            ->with("ccodcl", $ccodcl);
    }

 

    function generadoranuncios()
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $arrArticulos = DB::select("
                            SELECT fca.ACODAR, fca.ADESCR, fca.APVP1, fca.APVP2, fca.APVP3, fca.APVP4, fca.ARESNUM5, fca.ARESNUM6
                            FROM fcart AS fca, fcstk AS stk
                            WHERE stk.AALM = 1 
                            AND fca.ACODAR = stk.ACODAR 
                            AND fca.ABLOQUEADO = 'N' 
                            AND fca.APVP1 > 0  
                            AND fca.ARESSN2 = 'N' 
                            AND stk.ASTOCK > 0
                            AND (fca.ACODAR LIKE '6910%' OR fca.ACODAR LIKE '6920%' OR fca.ACODAR LIKE '6940%' OR fca.ACODAR LIKE '6950%' OR fca.ACODAR LIKE '9960%')
                            ORDER BY fca.ACODAR");

        $directorioFondos = '../htdocs/public/fotobanners/fondos/';
        $arrFondos = scandir($directorioFondos);

        $arrFondosDia = Array(0, 11, 15, 16, 17, 19, 2, 20, 21, 22, 23, 24, 28, 30, 31, 33, 34, 35, 4, 41, 42, 43, 50, 51, 52, 53, 55, 94, 96, 99, 990, 25);

        $arrFondosNoDia = Array();

        $int00 = 0;

        for ($i = 2; $i < count($arrFondos); $i++) 
        {
            $fondoEncontrado = false;

            for ($a = 0; $a < count($arrFondosDia); $a++) 
            {
                if ($arrFondos[$i] == 'bannerf'.$arrFondosDia[$a].'.png')
                {
                    $fondoEncontrado = true;
                    break;
                }
            }

            if (!$fondoEncontrado)
            {
                array_push($arrFondosNoDia, $arrFondos[$i]);
            }
        }

        $precioArticulo = 0;

        foreach ($arrArticulos as $arrDatoArticulo)
        {
            if (session('usuario')->uData->ctari == 1)
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }
            elseif (session('usuario')->uData->ctari == 2)
            {
                $precioArticulo = $arrDatoArticulo->APVP2;
            }
            elseif (session('usuario')->uData->ctari == 3)
            {
                $precioArticulo = $arrDatoArticulo->APVP3;
            }
            elseif (session('usuario')->uData->ctari == 4)
            {
                $precioArticulo = $arrDatoArticulo->APVP4;
            }
            elseif (session('usuario')->uData->ctari == 5)
            {
                $precioArticulo = $arrDatoArticulo->ARESNUM5;
            }
            elseif (session('usuario')->uData->ctari == 6)
            {
                $precioArticulo = $arrDatoArticulo->ARESNUM6;
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $arrDatoArticulo->PRECIO = $precioArticulo;
        }

        return View('generadoranuncios')->with("arrArticulos", $arrArticulos)
                                        ->with("arrFondos", $arrFondos)
                                        ->with("arrFondosDia", $arrFondosDia)
                                        ->with("arrFondosNoDia", $arrFondosNoDia)
                                        ->with("int00", $int00)
                                        ->with("ccodcl", $ccodcl);
    }

    function buscarArticulosAnuncio($criterioBusq)
    {
        $this->init();

        $arrArticulos = DB::select("SELECT fca.ACODAR FROM fcart AS fca, fcstk AS stk
                                WHERE stk.AALM = 1 
                                AND fca.ACODAR = stk.ACODAR 
                                AND fca.ABLOQUEADO = 'N' 
                                AND fca.APVP1 > 0  
                                AND fca.ARESSN2 = 'N' 
                                AND stk.ASTOCK > 0
                                AND (fca.ACODAR LIKE '%".$criterioBusq."%' OR fca.ADESCR LIKE '%".$criterioBusq."%')
                                AND (fca.ACODAR LIKE '%6910%' OR fca.ACODAR LIKE '%6920%' OR fca.ACODAR LIKE '%6940%' OR fca.ACODAR LIKE '%6950%' OR fca.ACODAR LIKE '%9960%')
                                ORDER BY fca.ACODAR");

        return $arrArticulos;
    }

    function ofertas()
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $arrOfertas = DB::select("
            SELECT fca.ACODAR, fca.ADESCR, fca.ASTOCK, fca.APVP1, fca.APVP2, fca.APVP3, fca.APVP4, fca.ARESNUM5, fca.ARESNUM6, fca.AFAMILIA, fca.ATIPO2, fca.AAMPDES, fco.OPRE1, fco.OPRE2, fco.OPRE3, fco.OPRE4, fco.OPRE5, fco.OPRE6, fil.fil1, fil.fil2, fil.fil3, fil.fil4, fil.fil5, fil.fil6, fil.fil7, fil.fil8, fil.fil9, fil.fil10, fil.fil11, fil.fil12
            FROM fcofe AS fco, fcart AS fca, filtroart AS fil
            WHERE fco.OCODAR = fca.ACODAR
            AND fca.ACODAR = fil.ACODAR
            AND curdate() BETWEEN fco.OFECINI AND fco.OFECFIN
            AND fca.ASTOCK > 0 
            AND fca.ABLOQUEADO = 'N' 
            AND fca.APVP1 > 0  
            AND fca.ARESSN2 = 'N'
            ORDER BY rand()");

        $codG1 = 36; 
        $textoFila1 = "Accesorios de teléfonos y tablets destacados";
        $codG2 = 406; 
        $textoFila2 = "Componentes destacados";
        $categoria = 1166;
        $numArticulos = 4;

        if ($numArticulos != "") 
        { 
            $strLimit = " LIMIT $numArticulos"; 
        }

        $arrAccesorios = DB::select("SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, 
                                    a.ARESNUM6, a.ARESNUM3, a.APVPIVA2, a.ATIPO2, a.AFAMILIA
                                    FROM fcart a, fclia, fcfcp, fcstk s 
                                    WHERE lcodar = a.acodar 
                                    AND a.acodar = s.acodar 
                                    AND s.aalm = 1 
                                    AND aresnum4 = fcod 
                                    AND fgrupo = $codG1 
                                    AND s.astock > 0 
                                    AND a.abloqueado = 'N' 
                                    AND a.apvp1 > 0  
                                    AND a.aressn2 = 'N' 
                                    GROUP BY acodar
                                    ORDER BY sum(lcanti) DESC 
                                    $strLimit");

        $arrComponentes = DB::select("SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, 
                                    a.ARESNUM6, a.ARESNUM3, a.APVPIVA2, a.ATIPO2, a.AFAMILIA
                                    FROM fcart a, fclia, fcfcp, fcstk s 
                                    WHERE lcodar = a.acodar 
                                    AND a.acodar = s.acodar 
                                    AND s.aalm = 1 
                                    AND aresnum4 = fcod 
                                    AND fgrupo = $codG2 
                                    AND s.astock > 0 
                                    AND a.abloqueado = 'N' 
                                    AND a.apvp1 > 0  
                                    AND a.aressn2 = 'N' 
                                    GROUP BY acodar
                                    ORDER BY sum(lcanti) DESC 
                                    $strLimit");

        $arrCatFiltros = DB::select("SELECT f1.id AS idfiltro1, f1.descripcion AS descrfiltro1, 
                f2.id AS idfiltro2, f2.descripcion AS descrfiltro2, f1.id_categoria
                FROM filtro1 AS f1, filtro2 AS f2
                WHERE f1.id = f2.id_filtro1
                AND f1.id_categoria = 5
                 GROUP BY f1.descripcion
                 ORDER BY f1.id");

        $arrFiltros = DB::select("SELECT f1.id AS idfiltro1, f1.descripcion AS descrfiltro1, 
                f2.id AS idfiltro2, f2.descripcion AS descrfiltro2, f1.id_categoria
                FROM filtro1 AS f1, filtro2 AS f2
                WHERE f1.id = f2.id_filtro1
                AND f1.id_categoria = 5");


        $this->precioArtAnterior = 100000;

        foreach ($arrOfertas as $arrDatoArticulo)
        {
            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $tieneTeclado = false;

            if ($arrDatoArticulo->ATIPO2 != 0)
            {
                if (($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529) || ($arrDatoArticulo->AFAMILIA == 560))
                {
                    $tieneTeclado = true;
                }
            }

            $arrDatoArticulo->tieneTeclado = $tieneTeclado;




            $arrFavoritos = DB::select("SELECT fcodar FROM favoritos WHERE fcodcl = '$ccodcl'");

            $this->mostrarFavorito($arrDatoArticulo, $arrFavoritos);

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);

            $arrDatoArticulo->imag1 = $this -> obtImagenArt($arrDatoArticulo->ADESCR);
        }

        return View('categoria')->with("arrDatosArticulos", $arrOfertas)
                                ->with("arrRefRepetidas", $this->arrRefRepetidas)
                                ->with("arrRefOcultas", $this->arrRefOcultas)
                                ->with("arrAccesorios", $arrAccesorios)
                                ->with("arrComponentes", $arrComponentes)
                                ->with("categoria", $categoria)
                                ->with("arrCatFiltros", $arrCatFiltros)
                                ->with("arrFiltros", $arrFiltros)
                                ->with("ccodcl", $ccodcl);
    }

    function filtrosActivos($codCat, $strFiltros)
    {
        $this->init();

        $arrFiltros = DB::select("SELECT f2.id as 'f2id', f2.id_filtro1, f2.id_categoria, f2.descripcion as 'f2desc', f1.descripcion as 'f1desc'
                                  FROM filtro2 f2, filtro1 f1
                                  WHERE f2.id_filtro1 = f1.id and f2.id in ($strFiltros)");

        $arrF1s = array();
        $matrizActivados = array();

        foreach ($arrFiltros as $filaAct)
        {
            $arrAux = array($filaAct->f2id, $filaAct->id_filtro1, $filaAct->f2desc, $filaAct->f1desc);
            array_push($matrizActivados, $arrAux);

            $i = 0;
            $encontrado = false;

            foreach ($arrF1s as $arrF1)
            {
                if (!$encontrado)
                {
                    if ($arrF1 == $filaAct->f1desc)
                    {
                        $encontrado = true;
                    }
                }
            }

            if (!$encontrado)
            {
                array_push($arrF1s, $filaAct->f1desc);
            }
        }

        if (count($arrFiltros) > 0)
        {
            ?>
            <span class="factivos1">Buscando: &nbsp;</span>
            <?php
        
            $cadenaBuscando = "";

            for ($i = 0; $i < count($arrF1s); $i++) 
            { 
                if ($i > 0) 
                { 
                    $cadenaBuscando .= "<span class='factivos3'> / </span> "; 
                }

                $cadenaBuscando .= "<span class='factivos3'>".$arrF1s[$i]."</span> ";

                $cadF2 = "";

                foreach ($matrizActivados as $activado) 
                {
                    $filF1Desc = $activado[3];
                    $filF2Desc = $activado[2];

                    if ($arrF1s[$i] == $filF1Desc)
                    {
                        $cadF2 .= $filF2Desc.",";
                    }
                    
                }

                $cadF2 = substr($cadF2, 0, -1);
                //$cadF2 = utf8_encode($cadF2);

                $cadenaBuscando .= "<span class='factivos2'> $cadF2 </span> ";
            }

            echo $cadenaBuscando;
        }
    }

    public function categoria($categoria, $subcategoria = "", $subcategoria2 = "")
    {
        $this->init();
        //session("entorno")->uData->categoria = $categoria;
        $ccodcl = session('usuario')->uData->codigo;
        $ctari = 2;
        
        if ($ccodcl > 0)
        {
            $ctari = session('usuario')->uData->ctari;
        }

        $arrFavoritos = DB::select("SELECT fcodar FROM favoritos WHERE fcodcl = '$ccodcl'");

        $condicionCategoria = '';

        $indiceCategoria = 0;

        if ($categoria == 1125)
        {
            $condicionCategoria = ' AND ((a.AFAMILIA >= 501 AND a.AFAMILIA <= 505) OR a.AFAMILIA = 563) ';
            $indiceCategoria = 1;
        }
        else if ($categoria == 1126)
        {
            $condicionCategoria = ' AND ((a.AFAMILIA >= 521 AND a.AFAMILIA <= 529) OR a.AFAMILIA = 560) ';
            $indiceCategoria = 2;
        }
        else if ($categoria == 1118)
        {
            $condicionCategoria = ' AND ((a.AFAMILIA >= 551 AND a.AFAMILIA <= 556)) ';
            $indiceCategoria = 3;
        }
        else if ($categoria == 1127)
        {
            $condicionCategoria = ' AND ((a.AFAMILIA >= 506 AND a.AFAMILIA <= 520) || (a.AFAMILIA >= 526 AND a.AFAMILIA <= 540) || (a.AFAMILIA >= 544 AND a.AFAMILIA <= 550) || (a.AFAMILIA >= 557 AND a.AFAMILIA <= 567)) ';
            $indiceCategoria = 4;
        }
        else if ($categoria == 1160)
        {
            $condicionCategoria = ' AND (a.AFAMILIA = 541 OR a.AFAMILIA = 542 OR a.AFAMILIA = 543) ';
            $indiceCategoria = 4;
        }
        else if ($categoria == 1166)
        {
            $indiceCategoria = 5;
        }

        switch ($subcategoria) 
        {
            case 100: $subcategoria = 104; break;
            case 101: $subcategoria = 105; break;
            case 102: $subcategoria = 132; break;
            case 103: $subcategoria = 137; break;

            case 204: $subcategoria = 28; break;
            case 200: $subcategoria = 30; break;
            case 201: $subcategoria = 31; break;
            case 202: $subcategoria = 32; break;
            case 203: $subcategoria = 33; break;

            case 300: $subcategoria = 91; break;
            case 301: $subcategoria = 91; break;
            case 302: $subcategoria = 61; break;
            case 303: $subcategoria = 62; break;
            case 304: $subcategoria = 63; break;
            case 306: $subcategoria = 59; break;
        }

        $arrFiltros = DB::select("SELECT descripcion FROM filtro2 WHERE id = '$subcategoria'");
        $condicionSubCategoria = " ";

        foreach ($arrFiltros as $arrFiltro)
        {
            switch ($arrFiltro->descripcion)
            {
                case 'Intel DualCore Core2': $arrFiltro->descripcion = 'Core2'; break;
                case 'Intel i3': $arrFiltro->descripcion = 'i3'; break;
                case 'Intel i5': $arrFiltro->descripcion = 'i5'; break;
                case 'Intel i7': $arrFiltro->descripcion = 'i7'; break;
            }

            $condicionSubCategoria = " AND (ADESCR LIKE '%".$arrFiltro->descripcion."%') ";
        }

        switch ($subcategoria2) 
        {
            case 601: $subcategoria2 = 4; break; 
            case 602: $subcategoria2 = 5; break; 
            case 603: $subcategoria2 = 6; break; 
            case 614: $subcategoria2 = 1; break; 
            case 610: $subcategoria2 = 3; break; 
            case 611: $subcategoria2 = 4; break; 
            case 612: $subcategoria2 = 5; break; 
            case 624: $subcategoria2 = 1; break; 
            case 621: $subcategoria2 = 4; break; 
            case 622: $subcategoria2 = 5; break; 

            case 442: $subcategoria2 = 54; break; 
            case 401: $subcategoria2 = 53; break; 
            case 403: $subcategoria2 = 55; break; 
            case 411: $subcategoria2 = 53; break; 
            case 412: $subcategoria2 = 54; break; 
            case 413: $subcategoria2 = 55; break; 
            case 424: $subcategoria2 = 32; break; 
            case 421: $subcategoria2 = 53; break; 
            case 422: $subcategoria2 = 54; break; 
            case 423: $subcategoria2 = 55; break; 
            case 432: $subcategoria2 = 54; break; 
            case 433: $subcategoria2 = 55; break;
        }

        $condicionSubCategoria2 = " ";

        if ($subcategoria2 != "")
        {
            $condicionSubCategoria2 = ' AND (';

            for ($i = 1; $i <= 12; $i++) 
            { 
                if ($i == 1)
                {
                    $condicionSubCategoria2 .= ' fil'.$i.' = '.$subcategoria2.' ';
                }
                else
                {
                    $condicionSubCategoria2 .= 'OR  fil'.$i.' = '.$subcategoria2.' ';
                }
            }

            $condicionSubCategoria2 .= ') ';
        }

        $arrDatosArticulos = 
            DB::select("
                SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ATIPO2, a.AFAMILIA, s.ASTOCK, fil.fil1, fil.fil2, fil.fil3, fil.fil4, fil.fil5, fil.fil6, fil.fil7, fil.fil8, fil.fil9, fil.fil10, fil.fil11, fil.fil12
                FROM fcart AS a, fcstk AS s, filtroart AS fil
                WHERE a.ACODAR = s.ACODAR
                AND a.ACODAR = fil.ACODAR
                AND s.AALM = 1 
                AND s.ASTOCK > 0
                AND a.ABLOQUEADO = 'N' 
                AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                AND a.ARESSN2 = 'N'  
                AND a.AFAMILIA BETWEEN 100 AND 569 
                AND a.ARESNUM4 BETWEEN 1 AND 9999 
                AND a.ARESNUM4 <> 1450 
                AND fil.id_categoria = $indiceCategoria "
                .$condicionCategoria.
                $condicionSubCategoria.
                $condicionSubCategoria2.
                "ORDER BY a.ACODAR ASC");

        if ($categoria == 1160)
        {
            $arrDatosArticulos = DB::select("
                SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ATIPO2, a.AFAMILIA, s.ASTOCK
                FROM fcart AS a, fcstk AS s
                WHERE a.ACODAR = s.ACODAR
                AND s.AALM = 1 
                AND s.ASTOCK > 0
                AND a.ABLOQUEADO = 'N' 
                AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                AND a.ARESSN2 = 'N'  
                AND a.AFAMILIA BETWEEN 100 AND 569 
                AND a.ARESNUM4 BETWEEN 1 AND 9999 
                AND a.ARESNUM4 <> 1450 
                AND (a.AFAMILIA = 541 OR a.AFAMILIA = 542 OR a.AFAMILIA = 543) 
                ORDER BY a.ACODAR ASC");

            foreach ($arrDatosArticulos as $arrDatoArticulo)
            {
                $arrDatoArticulo->fil1 = 0;
                $arrDatoArticulo->fil2 = 0;
                $arrDatoArticulo->fil3 = 0;
                $arrDatoArticulo->fil4 = 0;
                $arrDatoArticulo->fil5 = 0;
                $arrDatoArticulo->fil6 = 0;
                $arrDatoArticulo->fil7 = 0;
                $arrDatoArticulo->fil8 = 0;
                $arrDatoArticulo->fil9 = 0;
                $arrDatoArticulo->fil10 = 0;
                $arrDatoArticulo->fil11 = 0;
                $arrDatoArticulo->fil12 = 0;
            }
        }


        $arrCatFiltros = DB::select("SELECT f1.id AS idfiltro1, f1.descripcion AS descrfiltro1, 
                f2.id AS idfiltro2, f2.descripcion AS descrfiltro2, f1.id_categoria
                FROM filtro1 AS f1, filtro2 AS f2
                WHERE f1.id = f2.id_filtro1
                AND f1.id_categoria = ".$indiceCategoria."
                 GROUP BY f1.descripcion
                 ORDER BY f1.id");

        $arrFiltros = DB::select("SELECT f1.id AS idfiltro1, f1.descripcion AS descrfiltro1, 
                f2.id AS idfiltro2, f2.descripcion AS descrfiltro2, f1.id_categoria
                FROM filtro1 AS f1, filtro2 AS f2
                WHERE f1.id = f2.id_filtro1
                AND f1.id_categoria = ".$indiceCategoria." ");

        $arrSubCategorias = DB::select("SELECT fcg.GDES, men.GCOD, men.PARENT
                                        FROM menus AS men, fcgrf AS fcg 
                                        WHERE men.GCOD = fcg.GCOD and men.PARENT = ".$categoria." and men.MOSTRAR = 1 
                                        ORDER BY fcg.GDES ASC");

        $arrFamilias = DB::select("SELECT fc.FCOD, fc.FDES, fc.FGRUPO 
                                    FROM fcfcp AS fc 
                                    WHERE fc.FRESSN2 = 'N'");

        $numArticulos = 4;

        switch ($categoria) 
        {
            // Otros ocasión
            case 1127: 
                $codG1 = 36; 
                $textoFila1 = "Accesorios de teléfonos y tablets destacados";
                $codG2 = 406; 
                $textoFila2 = "Componentes destacados";
                break;

            default:
                $codG1 = 36; 
                $textoFila1 = "Accesorios de teléfonos y tablets destacados";
                $codG2 = 406; 
                $textoFila2 = "Componentes destacados";
                break;
        }

        if ($numArticulos != "") 
        { 
            $strLimit = " LIMIT $numArticulos"; 
        }

        $arrAccesorios = 
            DB::select("SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, 
                a.ARESNUM6, a.ARESNUM3, a.APVPIVA2, a.ATIPO2, a.AFAMILIA
                FROM fcart a, fclia, fcfcp, fcstk s 
                WHERE lcodar = a.acodar 
                AND a.acodar = s.acodar 
                AND s.aalm = 1 
                AND aresnum4 = fcod 
                AND fgrupo = $codG1 
                AND s.astock > 0 
                AND a.abloqueado = 'N' 
                AND a.apvp1 > 0  
                AND a.aressn2 = 'N' 
                GROUP BY acodar
                ORDER BY sum(lcanti) DESC 
                $strLimit");

        $arrComponentes = 
            DB::select("SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, 
                        a.ARESNUM6, a.ARESNUM3, a.APVPIVA2, a.ATIPO2, a.AFAMILIA
                        FROM fcart a, fclia, fcfcp, fcstk s 
                        WHERE lcodar = a.acodar 
                        AND a.acodar = s.acodar 
                        AND s.aalm = 1 
                        AND aresnum4 = fcod 
                        AND fgrupo = $codG2 
                        AND s.astock > 0 
                        AND a.abloqueado = 'N' 
                        AND a.apvp1 > 0  
                        AND a.aressn2 = 'N' 
                        GROUP BY acodar
                        ORDER BY sum(lcanti) DESC 
                        $strLimit");

        $arrOfertas = DB::select("SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
            FROM fcofe o, fcart a
            WHERE o.OCODAR = a.ACODAR 
            AND CURDATE() between o.OFECINI AND o.OFECFIN 
            AND a.ASTOCK > 0 
            AND a.ABLOQUEADO = 'N' 
            AND a.APVP1 > 0  
            AND a.ARESSN2 = 'N'
            ORDER BY rand()");

        $this->refArticuloAnterior = '';
        $this->acodarAnterior = '';

        $this->precioArtAnterior = 100000;

        foreach ($arrAccesorios as $arrAccesorio)
        {
            $arrAccesorio->esOferta = $this->esOferta($arrAccesorio->ACODAR, $arrOfertas);
            $arrAccesorio->tieneTeclado = false;
            $arrAccesorio->imag1 = $this -> obtImagenArt($arrAccesorio->ADESCR);

            $this->mostrarFavorito($arrAccesorio, $arrFavoritos);
        }

        foreach ($arrComponentes as $arrComponente)
        {
            $arrComponente->esOferta = $this->esOferta($arrComponente->ACODAR, $arrOfertas);
            $arrComponente->tieneTeclado = false;
            $arrComponente->imag1 = $this -> obtImagenArt($arrComponente->ADESCR);
            
            $this->mostrarFavorito($arrComponente, $arrFavoritos);
        }

        foreach ($arrDatosArticulos as $arrDatoArticulo)
        {
            $arrDatoArticulo->esOferta = $this->esOferta($arrDatoArticulo->ACODAR, $arrOfertas);

            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);

            $tieneTeclado = false;

            if ($arrDatoArticulo->ATIPO2 != 0)
            {
                if (($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529) || ($arrDatoArticulo->AFAMILIA == 560))
                {
                    $tieneTeclado = true;
                }
            }

            $arrDatoArticulo->tieneTeclado = $tieneTeclado;

            $this->mostrarFavorito($arrDatoArticulo, $arrFavoritos);

            // Imagen del artículo
                $arrDatoArticulo->imag1 = $this -> obtImagenArt($arrDatoArticulo->ADESCR);

                /*$adescr = $arrDatoArticulo->ADESCR;
                $imag1 = $this -> clean($adescr);
                $imag1 .= ".jpg";
                $arrDatoArticulo->imag1 = $imag1;*/

                
                //$arrDatoArticulo->imag1 = "";
        }

        return View('categoria')->with("categoria", $categoria)
                                ->with("arrDatosArticulos", $arrDatosArticulos)
                                ->with("arrOfertas", $arrOfertas)
                                ->with("arrCatFiltros", $arrCatFiltros)
                                ->with("arrFiltros", $arrFiltros)
                                ->with("arrSubCategorias", $arrSubCategorias)
                                ->with("arrFamilias", $arrFamilias)
                                ->with("arrAccesorios", $arrAccesorios)
                                ->with("arrComponentes", $arrComponentes)
                                ->with("arrRefRepetidas", $this->arrRefRepetidas)
                                ->with("arrRefOcultas", $this->arrRefOcultas)
                                ->with("esPortada", false)
                                ->with("ccodcl", $ccodcl);
    }

    function obtImagenArt($adescr)
    {
        $imag1 = $this -> clean($adescr);
        $imag1 .= ".jpg";

        return $imag1;
    }

    function clean($string) 
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function marca($vmarca="lllaaa")
    {
        $this->init();
        //$this->idioma;
        session("menu")->generarMenu(); // carga los datos de menu cada vez que pasa por la portada
        session("articulo")->articulo = $vmarca;
        session("articulo")->pagina = "marca";
        session("articulo")->cargarimagenesdearticulos = true;
        $articulos = session("articulo")->listar6();
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "marca", "marca" => $vmarca));
    }
    public function seccion($familia, $nombrefamilia, $pagina = 1)
    {
        $this->init();
        //$this->listener();
        session("articulo")->familia = $nombrefamilia;
        session("articulo")->pagina = "familia";
        session("articulo")->sespecial = $familia;
        session("articulo")->tipoArticuloComoSegundaFamilia = false;
        session("articulo")->numPagina = $pagina;
        $articulos = session("articulo")->listar6();
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "seccion"));
    }
    public function secciones()
    {
        $this->init();
        return View('secciones')->with(array("articulos" => "x", "registros" => 0, "seccion" => "secciones"));
    }
    public function productodocumentos($ide)
    {
        $this->init();
        if (session('usuario')->uData->codigo == 0) {
            return "no permitido";
            return Redirect::to('/');
        }
        session("articulo")->documento = $ide;
        $registros = session("articulo")->recuperardocumento(); // 1 o 0
        if($registros==0){
            return "no encontrado";
        }
        // session("articulo")->documentonombre contiene nombre archivo
        // session("articulo")->documento contiene binario archivo
        $midocu=session("articulo")->documentonombre;
        //return session("articulo")->documentonombre;
        $midocuext=pathinfo($midocu,PATHINFO_EXTENSION);
        return Response::make(session("articulo")->documento, 200, [
            'Content-Type' => 'application/'.$midocuext,
            'Content-Disposition' => 'inline; filename="'.$midocu.'"'
        ]);
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=\"" . $midocu . "\"");
        echo session("articulo")->documento;
        return;

    }

    function obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo)
    {
        $ccodcl = session('usuario')->uData->codigo;
        $acodar = $arrDatoArticulo->ACODAR;

        if (substr($acodar, -2) == 'GA' || substr($acodar, -2) == 'GB' || substr($acodar, -2) == 'GC' || substr($acodar, -2) == 'GD' || substr($acodar, -3) == 'GAP')
        {
            if (substr($acodar, -3) == 'GAP')
            {
                $longitudRefArt = strlen($acodar) - 3;
            }
            else
            {
                $longitudRefArt = strlen($acodar) - 2;
            }

            $refArticulo = substr($acodar, 0, $longitudRefArt);

            if ($refArticulo == $this->refArticuloAnterior)
            {
                array_push($this->arrRefRepetidas, $acodar);
                array_push($this->arrRefRepetidas, $this->acodarAnterior);
                array_push($this->arrRefOcultas, $this->acodarAnterior);

                if ($this->precioArtAnterior < $precioArticulo)
                {
                    $precioArticulo = $this->precioArtAnterior;
                }
            }

            $this->refArticuloAnterior = $refArticulo;
            $this->acodarAnterior = $acodar;

            $this->precioArtAnterior = $precioArticulo;


            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $arrDatoArticulo->APVP1 = $precioArticulo;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $arrDatoArticulo->APVP2 = $precioArticulo;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $arrDatoArticulo->APVP3 = $precioArticulo;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $arrDatoArticulo->APVP4 = $precioArticulo;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $arrDatoArticulo->ARESNUM5 = $precioArticulo;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $arrDatoArticulo->ARESNUM6 = $precioArticulo;
                }
                else
                {
                    $arrDatoArticulo->APVP1 = $precioArticulo;
                }
            }
            else
            {
                $arrDatoArticulo->APVP1 = $precioArticulo;
            }
        }

        return $arrDatoArticulo;
    }

    public function articulo($referencia)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;
        $tarifa = 2;
        
        if ($ccodcl > 0)
        {
            $tarifa = session('usuario')->uData->ctari;
        }

        $numRefRepetidas = 0;
        $arrGradosArticulo = array();
        $arrRefArticulos = array();
        $arrNombreArticulos = array();
        $arrStockArticulos = array();
        $arrPrecioArticulos = array();
        $arrPrecioArticulosConIVA = array();
        $arrDescrArticulos = array();
        $arrTipoTeclados = array();
        $arrFamiliaArticulos = array();
        $mostrarConversionTeclado = false;
        $arrMemoriasRAM = array();
        $arrRefMemoriasRAM = array();
        $arrPreciosMemoriasRAM = array();
        $mostrarAmplMemoriaRAM = false;
        $mostrarAmplDiscoDuro = false;
        $arrDiscosDuros = array();
        $arrRefDiscosDuros = array();
        $arrPreciosDiscosDuros = array();
        $precioTachado = 0;
        $ddr = "";

        if ($ccodcl > 0)
        {
            $this->calculoportes(); 
        }

        session("articulo")->pagina = "articulo";
        session("articulo")->articulo = urldecode($referencia);
        $articulos = session("articulo")->listar6();

        if (count((array) $articulos) == 0) {
            session("articulo")->articulo = $referencia;
            $articulos = session("articulo")->listar6();
        }

        if (count((array) $articulos) == 0) {
            return Redirect::to('/');
            return View('error');
        }

        session("articulo")->pagina = "alternativos";
        $matrizAlt = session("articulo")->listar6();
        $articulos[0]->alternativos = $matrizAlt;
        session("articulo")->pagina = "relacionados";
        $matrizRel=session("articulo")->listar6();
        $articulos[0]->relacionados = $matrizRel;

        $arrDatosArticulos = DB::select("SELECT fca.ACODAR, fca.ADESCR, fca.ATIPO2, fca.AFAMILIA, fca.AAMPDES
                                        FROM fcart AS fca, fcstk AS stk
                                        WHERE fca.ACODAR = '$referencia'
                                        AND fca.ACODAR = stk.ACODAR");

        $arrTodos = DB::select("
            SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.AAMPDES, a.ATIPO2, a.AFAMILIA, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6 
            FROM fcart AS a, fcstk AS s
            WHERE a.ACODAR = s.ACODAR 
            AND s.AALM = 1 
            AND s.ASTOCK > 0
            AND a.ABLOQUEADO = 'N' 
            AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
            AND a.ARESSN2 = 'N'  
            AND a.AFAMILIA BETWEEN 100 AND 569 
            AND a.ARESNUM4 BETWEEN 1 AND 9999 
            AND a.ARESNUM4 <> 1450
            ORDER BY a.ACODAR ASC");

        $arrAmplMemorias = DB::select("
            SELECT fca.ACODAR, fca.APVP1, fca.APVP2, fca.APVP3, fca.APVP4, fca.ARESNUM5, fca.ARESNUM6 
            FROM fcart AS fca
            WHERE fca.ACODAR = '695006AMP101' OR fca.ACODAR = '695006AMP102' OR fca.ACODAR = '695006AMP103' OR fca.ACODAR = '695006AMP104' OR fca.ACODAR = '695006AMP105' OR fca.ACODAR = '695006AMP106' OR fca.ACODAR = '695006AMP201' OR fca.ACODAR = '695006AMP202' OR fca.ACODAR = '695006AMP203' OR fca.ACODAR = '695006AMP204' OR fca.ACODAR = '695006AMP205' OR fca.ACODAR = '695006AMP206'");

        $arrAmplTeclados = DB::select("
            SELECT fca.ACODAR, fca.APVP1, fca.APVP2, fca.APVP3, fca.APVP4, fca.ARESNUM5, fca.ARESNUM6 
            FROM fcart AS fca
            WHERE fca.ACODAR = '69509901' OR fca.ACODAR = '69509902' OR fca.ACODAR = '69509903'");

        $arrOfertas = DB::select("SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
            FROM fcofe o, fcart a
            WHERE o.OCODAR = a.ACODAR 
            AND CURDATE() between o.OFECINI AND o.OFECFIN 
            AND a.ASTOCK > 0 
            AND a.ABLOQUEADO = 'N' 
            AND a.APVP1 > 0  
            AND a.ARESSN2 = 'N'
            ORDER BY rand()");

        $titulo1Articulo = '';
        $titulo2Articulo = '';

        $topArticulos = array_reverse($articulos[0]->relacionados);

        foreach ($articulos[0]->relacionados as $relacionado)
        {
            session("articulo")->pagina = "articulo";
            session("articulo")->articulo = urldecode($relacionado->acodar);
            $topArtis = session("articulo")->listar6();

            foreach ($topArtis as $topArti)
            {
                $relacionado->precioArtRelacionado = $topArti->precioTarifa;
            }
        }

        foreach ($topArticulos as $topArticulo)
        {
            session("articulo")->pagina = "articulo";
            session("articulo")->articulo = urldecode($topArticulo->acodar);
            $topArtis = session("articulo")->listar6();

            foreach ($topArtis as $topArti)
            {
                $topArticulo->precioArtRelacionado = $topArti->precioTarifa;
            }
        }

        foreach ($arrDatosArticulos as $arrDatoArticulo) 
        {
            $arrDatoArticulo->esOferta = $this->esOferta($arrDatoArticulo->ACODAR, $arrOfertas);

            $famsConAmpliaciones = array(560, 563);
            if (($arrDatoArticulo->AFAMILIA >= 501 && $arrDatoArticulo->AFAMILIA <= 505) || $arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529 || in_array($arrDatoArticulo->AFAMILIA, $famsConAmpliaciones))
            {
                $mostrarAmplDiscoDuro = true;

                $arrDiscosDuros = array('SSD SATA 120GB', 'SSD SATA 240GB', 'SSD SATA 480GB');
                $arrRefDiscosDuros = array('695006AMP201', '695006AMP202', '695006AMP203');

                if ($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529 || $arrDatoArticulo->AFAMILIA == 560)
                {
                    array_push($arrDiscosDuros, 'SSD M.2 120GB', 'SSD M.2 240GB', 'SSD M.2 480GB');
                    array_push($arrRefDiscosDuros, '695006AMP204', '695006AMP205', '695006AMP206');
                }

                array_push($arrDiscosDuros, 'SIN AMPLIACIÓN');
                array_push($arrRefDiscosDuros, 'sinAmplDiscoDuro');

                for ($i = 0; $i < count($arrRefDiscosDuros); $i++) 
                {
                    $discoEncontrado = false;

                    foreach ($arrAmplMemorias as $arrAmplMemoria)
                    {
                        if ($arrAmplMemoria->ACODAR == $arrRefDiscosDuros[$i])
                        {
                            $discoEncontrado = true;

                            if ($tarifa == '1')
                            {
                                array_push($arrPreciosDiscosDuros, $arrAmplMemoria->APVP1);
                            }
                            else if ($tarifa == '2')
                            {
                                array_push($arrPreciosDiscosDuros, $arrAmplMemoria->APVP2);
                            }
                            else if ($tarifa == '3')
                            {
                                array_push($arrPreciosDiscosDuros, $arrAmplMemoria->APVP3);
                            }
                            else if ($tarifa == '4')
                            {
                                array_push($arrPreciosDiscosDuros, $arrAmplMemoria->APVP4);
                            }
                            else if ($tarifa == '5')
                            {
                                array_push($arrPreciosDiscosDuros, $arrAmplMemoria->ARESNUM5);
                            }
                            else
                            {
                                array_push($arrPreciosDiscosDuros, $arrAmplMemoria->ARESNUM6);
                            }
                        }
                    }

                    if (!$discoEncontrado)
                    {
                        array_push($arrPreciosDiscosDuros, 0);
                    }
                }
            }


            $DIMMoSODIMM = "DIMM";

            if ($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529 || $arrDatoArticulo->AFAMILIA == 560 || $arrDatoArticulo->AFAMILIA == 505 || $arrDatoArticulo->AFAMILIA == 503)
            {
                $DIMMoSODIMM = "SODIMM";
            }

            $pos = strpos(strtolower($arrDatoArticulo->AAMPDES), "ddr3"); if ($pos !== false)  { $ddr = "ddr3"; }
            $pos = strpos(strtolower($arrDatoArticulo->AAMPDES), "ddr3l"); if ($pos !== false)  { $ddr = "ddr3l"; }
            $pos = strpos(strtolower($arrDatoArticulo->AAMPDES), "ddr4"); if ($pos !== false)  { $ddr = "ddr4"; }

            if ($DIMMoSODIMM == "DIMM")
            {
                if ($ddr == "ddr3")
                {
                    $arrMemoriasRAM = array('4GB DIMM DDR3', '8GB DIMM DDR3', 'SIN AMPLIACIÓN');
                    $arrRefMemoriasRAM = array('695006AMP101', '695006AMP102', 'sinAmplMemoriaRAM');
                    $mostrarAmplMemoriaRAM = true;
                }

                if ($ddr == "ddr3l")
                {
                    $arrMemoriasRAM = array('4GB DIMM DDR3L', '8GB DIMM DDR3L', 'SIN AMPLIACIÓN');
                    $arrRefMemoriasRAM = array('695006AMP101', '695006AMP102', 'sinAmplMemoriaRAM');
                    $mostrarAmplMemoriaRAM = true;
                }

                if ($ddr == "ddr4")
                {
                    $arrMemoriasRAM = array('8GB DIMM DDR4', 'SIN AMPLIACIÓN');
                    $arrRefMemoriasRAM = array('695006AMP105', 'sinAmplMemoriaRAM');
                    $mostrarAmplMemoriaRAM = true;
                }
            }

            if ($DIMMoSODIMM == "SODIMM")
            {
                if ($ddr == "ddr3")
                {
                    $arrMemoriasRAM = array('4GB SODIMM DDR3', '8GB SODIMM DDR3', 'SIN AMPLIACIÓN');
                    $arrRefMemoriasRAM = array('695006AMP103', '695006AMP104', 'sinAmplMemoriaRAM');
                    $mostrarAmplMemoriaRAM = true;
                }

                if ($ddr == "ddr3l")
                {
                    $arrMemoriasRAM = array('4GB SODIMM DDR3L', '8GB SODIMM DDR3L', 'SIN AMPLIACIÓN');
                    $arrRefMemoriasRAM = array('695006AMP103', '695006AMP104', 'sinAmplMemoriaRAM');
                    $mostrarAmplMemoriaRAM = true;
                }

                if ($ddr == "ddr4")
                {
                    $arrMemoriasRAM = array('8GB SODIMM DDR4', 'SIN AMPLIACIÓN');
                    $arrRefMemoriasRAM = array('695006AMP106', 'sinAmplMemoriaRAM');
                    $mostrarAmplMemoriaRAM = true;
                }
            }


            for ($i = 0; $i < count($arrRefMemoriasRAM); $i++) 
            {
                $memoriaRAMEncontrado = false;

                foreach ($arrAmplMemorias as $arrAmplMemoria)
                {
                    if ($arrAmplMemoria->ACODAR == $arrRefMemoriasRAM[$i])
                    {
                        $memoriaRAMEncontrado = true;

                        if ($tarifa == '1')
                        {
                            array_push($arrPreciosMemoriasRAM, $arrAmplMemoria->APVP1);
                        }
                        else if ($tarifa == '2')
                        {
                            array_push($arrPreciosMemoriasRAM, $arrAmplMemoria->APVP2);
                        }
                        else if ($tarifa == '3')
                        {
                            array_push($arrPreciosMemoriasRAM, $arrAmplMemoria->APVP3);
                        }
                        else if ($tarifa == '4')
                        {
                            array_push($arrPreciosMemoriasRAM, $arrAmplMemoria->APVP4);
                        }
                        else if ($tarifa == '5')
                        {
                            array_push($arrPreciosMemoriasRAM, $arrAmplMemoria->ARESNUM5);
                        }
                        else
                        {
                            array_push($arrPreciosMemoriasRAM, $arrAmplMemoria->ARESNUM6);
                        }
                    }
                }

                if (!$memoriaRAMEncontrado)
                {
                    array_push($arrPreciosMemoriasRAM, 0);
                }
            }



            $tieneTeclado = false;

            if ($arrDatoArticulo->ATIPO2 != 0)
            {
                if (($arrDatoArticulo->AFAMILIA >= 521 && $arrDatoArticulo->AFAMILIA <= 529) || ($arrDatoArticulo->AFAMILIA == 560))
                {
                    $tieneTeclado = true;
                }
            }

            $arrDatoArticulo->tieneTeclado = $tieneTeclado;

            $vcodar = $arrDatoArticulo->ACODAR;

            if ($referencia == $vcodar)
            {
                $posSeparacion = strpos($arrDatoArticulo->ADESCR, "(");
                $posSeparacionAnadido = 0;

                if ($posSeparacion == "")
                {
                    $posSeparacion = strpos($arrDatoArticulo->ADESCR, " - ");
                    $posSeparacionAnadido = 2;
                }

                $titulo1Articulo = substr($arrDatoArticulo->ADESCR, 0, $posSeparacion);
                $titulo2Articulo = substr($arrDatoArticulo->ADESCR, $posSeparacion + $posSeparacionAnadido);
                $descrArticulo = nl2br(e($arrDatoArticulo->AAMPDES), false);

                if (substr($vcodar, -2) == 'GA' || substr($vcodar, -2) == 'GB' || substr($vcodar, -2) == 'GC' || substr($vcodar, -2) == 'GD' || substr($vcodar, -3) == 'GAP')
                {
                    if (substr($vcodar, -3) == 'GAP')
                    {
                        $longitudRefArt = strlen($vcodar) - 3;
                    }
                    else
                    {
                        $longitudRefArt = strlen($vcodar) - 2;
                    }
                    
                    $refArticulo = substr($vcodar, 0, $longitudRefArt);

                    $arrArticulos = $arrTodos;

                    foreach ($arrArticulos as $arrArticulo) 
                    {
                        $refListaArticulo = "";

                        if (substr($arrArticulo->ACODAR, -2) == 'GA' || substr($arrArticulo->ACODAR, -2) == 'GB' || substr($arrArticulo->ACODAR, -2) == 'GC' || substr($arrArticulo->ACODAR, -2) == 'GD' || substr($arrArticulo->ACODAR, -3) == 'GAP')
                        {
                            if (substr($arrArticulo->ACODAR, -3) == 'GAP')
                            {
                                $longitudRefListaArt = strlen($arrArticulo->ACODAR) - 3;
                            }
                            else
                            {
                                $longitudRefListaArt = strlen($arrArticulo->ACODAR) - 2;
                            }

                            $refListaArticulo = substr($arrArticulo->ACODAR, 0, $longitudRefArt);

                            if ($refArticulo == $refListaArticulo)
                            {
                                $numRefRepetidas += 1;

                                array_push($arrGradosArticulo, substr($arrArticulo->ACODAR, $longitudRefListaArt));
                                array_push($arrRefArticulos, $arrArticulo->ACODAR);
                                array_push($arrNombreArticulos, $arrArticulo->ADESCR);
                                array_push($arrStockArticulos, $arrArticulo->ASTOCK);
                                array_push($arrDescrArticulos, $arrArticulo->AAMPDES);
                                array_push($arrTipoTeclados, $arrArticulo->ATIPO2);
                                array_push($arrFamiliaArticulos, $arrArticulo->AFAMILIA);

                                $precioArticulo = 0;

                                if ($arrDatoArticulo->esOferta == 1)
                                {
                                    foreach ($arrOfertas as $arrOferta)
                                    {
                                        if ($arrOferta->ACODAR == $arrArticulo->ACODAR)
                                        {
                                            if ($tarifa == '1')
                                            {
                                                $precioArticulo = $arrOferta->OPRE1;
                                            }
                                            else if ($tarifa == '2')
                                            {
                                                $precioArticulo = $arrOferta->OPRE2;
                                            }
                                            else if ($tarifa == '3')
                                            {
                                                $precioArticulo = $arrOferta->OPRE3;
                                            }
                                            else if ($tarifa == '4')
                                            {
                                                $precioArticulo = $arrOferta->OPRE4;
                                            }
                                            else if ($tarifa == '5')
                                            {
                                                $precioArticulo = $arrOferta->OPRE5;
                                            }
                                            else
                                            {
                                                $precioArticulo = $arrOferta->OPRE6;
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    if ($tarifa == '1')
                                    {
                                        $precioArticulo = $arrArticulo->APVP1;
                                    }
                                    else if ($tarifa == '2')
                                    {
                                        $precioArticulo = $arrArticulo->APVP2;
                                    }
                                    else if ($tarifa == '3')
                                    {
                                        $precioArticulo = $arrArticulo->APVP3;
                                    }
                                    else if ($tarifa == '4')
                                    {
                                        $precioArticulo = $arrArticulo->APVP4;
                                    }
                                    else if ($tarifa == '5')
                                    {
                                        $precioArticulo = $arrArticulo->ARESNUM5;
                                    }
                                    else
                                    {
                                        $precioArticulo = $arrArticulo->ARESNUM6;
                                    }
                                }

                                array_push($arrPrecioArticulos, $precioArticulo);
                                $precioConIVA = $precioArticulo + ($precioArticulo * 21 / 100);
                                array_push($arrPrecioArticulosConIVA, $precioConIVA);
                            }
                        }
                    }
                }
                else
                {
                    $arrArticulos = $arrTodos;

                    foreach ($arrArticulos as $arrArticulo) 
                    {
                        if ($arrArticulo->ACODAR == $vcodar)
                        {
                            if ($arrArticulo->AFAMILIA == 571)
                            {
                                $precioTachado = $arrArticulo->ARESNUM3;
                            }

                            array_push($arrGradosArticulo, substr($arrArticulo->ACODAR, -3));
                            array_push($arrRefArticulos, $arrArticulo->ACODAR);
                            array_push($arrNombreArticulos, $arrArticulo->ADESCR);
                            array_push($arrStockArticulos, $arrArticulo->ASTOCK);
                            array_push($arrDescrArticulos, $arrArticulo->AAMPDES);
                            array_push($arrTipoTeclados, $arrArticulo->ATIPO2);
                            array_push($arrFamiliaArticulos, $arrArticulo->AFAMILIA);

                            $precioArticulo = 0;

                            if ($tarifa == '1')
                            {
                                $precioArticulo = $arrArticulo->APVP1;
                            }
                            else if ($tarifa == '2')
                            {
                                $precioArticulo = $arrArticulo->APVP2;
                            }
                            else if ($tarifa == '3')
                            {
                                $precioArticulo = $arrArticulo->APVP3;
                            }
                            else if ($tarifa == '4')
                            {
                                $precioArticulo = $arrArticulo->APVP4;
                            }
                            else if ($tarifa == '5')
                            {
                                $precioArticulo = $arrArticulo->ARESNUM5;
                            }
                            else
                            {
                                $precioArticulo = $arrArticulo->ARESNUM6;
                            }

                            array_push($arrPrecioArticulos, $precioArticulo);
                            $precioConIVA = $precioArticulo + ($precioArticulo * 21 / 100);
                            array_push($arrPrecioArticulosConIVA, $precioConIVA);
                            break;
                        }
                    }
                }

                break;
            }
        }

        for ($i = 0; $i < count($arrGradosArticulo); $i++)
        {
            $codStr = $arrRefArticulos[$i];

            if ($arrTipoTeclados[$i] != 0)
            {
                if (($arrFamiliaArticulos[$i] >= 521 && $arrFamiliaArticulos[$i] <= 529) || ($arrFamiliaArticulos[$i] == 560))
                {
                    $codStr = $arrRefArticulos[$i];

                    if ($codStr == $referencia)
                    {
                        $mostrarConversionTeclado = true;
                    }
                    else
                    {
                        $mostrarConversionTeclado = false;
                    }
                }
            }
        }

        //$widthDivGrados = 100 / count($arrGradosArticulo);
        $widthDivGrados = 25;

        return View('articulo2')->with(array("barti" => $articulos[0], "registros" => count($articulos), "seccion" => "producto"))
                               ->with("topArticulos", $topArticulos)   
                               ->with("arrDatosArticulos", $arrDatosArticulos)
                               ->with("titulo1Articulo", $titulo1Articulo)
                               ->with("titulo2Articulo", $titulo2Articulo)
                               ->with("descrArticulo", $descrArticulo)
                               ->with("codCliente", $ccodcl)
                               ->with("arrGradosArticulo", $arrGradosArticulo)
                               ->with("arrRefArticulos", $arrRefArticulos)
                               ->with("arrNombreArticulos", $arrNombreArticulos)
                               ->with("arrStockArticulos", $arrStockArticulos)
                               ->with("arrPrecioArticulos", $arrPrecioArticulos)
                               ->with("arrPrecioArticulosConIVA", $arrPrecioArticulosConIVA)
                               ->with("arrDescrArticulos", $arrDescrArticulos)
                               ->with("arrTipoTeclados", $arrTipoTeclados)
                               ->with("arrFamiliaArticulos", $arrFamiliaArticulos)
                               ->with("numRefRepetidas", $numRefRepetidas)
                               ->with("widthDivGrados", $widthDivGrados)
                               ->with("mostrarConversionTeclado", $mostrarConversionTeclado)
                               ->with("arrMemoriasRAM", $arrMemoriasRAM)
                               ->with("arrRefMemoriasRAM", $arrRefMemoriasRAM)
                               ->with("arrAmplMemorias", $arrAmplMemorias)
                               ->with("arrAmplTeclados", $arrAmplTeclados)
                               ->with("mostrarAmplMemoriaRAM", $mostrarAmplMemoriaRAM)
                               ->with("arrPreciosMemoriasRAM", $arrPreciosMemoriasRAM)
                               ->with("arrDiscosDuros", $arrDiscosDuros)
                               ->with("arrRefDiscosDuros", $arrRefDiscosDuros)
                               ->with("mostrarAmplDiscoDuro", $mostrarAmplDiscoDuro)
                               ->with("arrPreciosDiscosDuros", $arrPreciosDiscosDuros);
    }

    public function esOferta($acodar, $arrOfertas)
    {
        foreach ($arrOfertas as $arrOferta)
        {
            if ($arrOferta->ACODAR == $acodar)
            {
                return 1;
            }
        }

        return 0;
    }

    public function buscadorArtAnuncios()
    {
        $this->init();
    }

    public function buscador($service)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $palabra = $service;

        $arrPedidos = DB::select("SELECT LPED, LCODAR, SUM(LCANTI) AS 'stockped'
                                FROM fcloc
                                WHERE LLIQUID = 'N' and LFECPED >= '2019-1-1' and LPED <> 0
                                GROUP BY LCODAR");

        $arrTodos = DB::select("SELECT * FROM fcart AS a, fcstk AS s
                                WHERE a.ACODAR = s.ACODAR 
                                AND s.AALM = 1 
                                AND s.ASTOCK > 0
                                AND a.ABLOQUEADO = 'N' 
                                AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                                AND a.ARESSN2 = 'N'  
                                AND a.AFAMILIA BETWEEN 100 AND 569 
                                AND a.ARESNUM4 BETWEEN 1 AND 9999 
                                AND a.ARESNUM4 <> 1450
                                ORDER BY a.AFAMILIA DESC");

        $arrTotal = array();

        foreach ($arrTodos as $arrTodo)
        {
            $stock = $arrTodo->ASTOCK;

            foreach ($arrPedidos as $pedido) 
            {
                if ($pedido->LCODAR == $arrTodo->ACODAR)
                {
                    $stock -= $pedido->stockped;
                }
            }

            $aux = array(
                "ACODAR" => $arrTodo->ACODAR, 
                "ADESCR" => $arrTodo->ADESCR, 
                "APVP1" => $arrTodo->APVP1, 
                "APVP2" => $arrTodo->APVP2, 
                "APVP3" => $arrTodo->APVP3, 
                "APVP4" => $arrTodo->APVP4, 
                "ARESNUM5" => $arrTodo->ARESNUM5, 
                "ARESNUM6" => $arrTodo->ARESNUM6, 
                "ASTOCK" => $stock,
                "ATIPO2" => $arrTodo->ATIPO2,
                "AFAMILIA" => $arrTodo->AFAMILIA
            );

            if ($stock > 0) 
            { 
                array_push($arrTotal, $aux); 
            }   
        }

        $arrResultado = array();
        $arrFrom = array("á", "é", "í", "ó", "ú"); 
        $arrTo = array("a", "e", "i", "o", "u");

        $palabra = trim($palabra);
        $cad2 = str_replace($arrFrom, $arrTo, $palabra);

        $arrPalabras = explode(" ", $cad2);

        $contArts = 0;
        foreach ($arrTotal as $arti) 
        {
            $cad1 = str_replace($arrFrom, $arrTo, $arti['ACODAR']);
            $resBusqueda = strrpos(strtolower($cad1), strtolower($cad2));

            if ($contArts < 40)
            {
                if (is_numeric($resBusqueda)) 
                { 
                    array_push($arrResultado, $arti);
                    $contArts++;
                }
            }
        }

        $enc = false;
        if ($contArts > 0) 
        { 
            $enc = true; 
        }

        if (!$enc)
        {
            foreach ($arrTotal as $arti)
            {
                $cad1 = str_replace($arrFrom, $arrTo, $arti["ADESCR"]);
                $resBusqueda = strrpos(strtolower($cad1), strtolower($cad2));

                if ($contArts < 40)
                {
                    if ( is_numeric($resBusqueda) ) 
                    { 
                        array_push($arrResultado, $arti);
                        $contArts++;
                    }
                }  
            }
        }

        $enc = false;
        if ($contArts > 0) 
        { 
            $enc = true; 
        }

        if (!$enc)
        {
            foreach ($arrTotal as $arti) 
            {        
                $cad1 = str_replace($arrFrom, $arrTo, $arti["ADESCR"]);

                foreach ($arrPalabras as $cad2) 
                {
                    $resBusqueda = strrpos(strtolower($cad1), strtolower($cad2));

                    if ($contArts < 40)
                    {
                        if ( is_numeric($resBusqueda) ) 
                        { 
                            array_push($arrResultado, $arti);

                            $contArts++;
                        }
                    }   
                }
            }
        }

        $arrDatosResultados = array();

        if (count($arrResultado) > 0) 
        {
            foreach ($arrResultado as $articulo) 
            {
                //$articulo['ATIPO2'] = "resto";

                // Descripción
                $descripLimit = 62;
                $descrip = utf8_encode($articulo['ADESCR']);
                $descrip = str_replace('/', ' / ', $descrip);
                if (strlen($descrip) > $descripLimit) 
                { 
                    $descrip = substr($descrip, 0, $descripLimit); $descrip .= "..."; 
                }

                $acodarAux = strtolower( str_replace("/", "barder", $articulo['ACODAR']) );

                /*$urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";
                if (!is_array(@getimagesize($urlfoto))) 
                {
                    $urlfoto = "fotoartic/nofoto2tmp.jpg";
                }
                */

                $urlfoto = $this -> obtImagenArt($articulo['ADESCR']);

                $ocultaBorde = "";

                if ($ccodcl == 0)
                {
                    $ocultaBorde = "celdaNoSesion";
                }

                // Stock
                if ($articulo["ASTOCK"] == 1) 
                { 
                    $stockStr = "1 unid."; 
                }
                else 
                { 
                    $stockStr = $articulo['ASTOCK']." unids."; 
                }

                $tieneTeclado = false;

                if ($articulo['ATIPO2'] != 0)
                {
                    if (($articulo['AFAMILIA'] >= 521 && $articulo['AFAMILIA'] <= 529) || ($articulo['AFAMILIA'] == 560))
                    {
                        $tieneTeclado = true;
                    }
                }

                $favRuta = "https://diginova.es/xweb/images/fav0.png";

                $tipo = "resto";

                if ($ccodcl > 0)
                {
                    if (session('usuario')->uData->ctari == 1)
                    {
                        $precio = number_format($articulo['APVP1'], 2, ",", ".");
                    }
                    elseif (session('usuario')->uData->ctari == 2)
                    {
                        $precio = number_format($articulo['APVP2'], 2, ",", ".");
                    }
                    elseif (session('usuario')->uData->ctari == 3)
                    {
                        $precio = number_format($articulo['APVP3'], 2, ",", ".");
                    }
                    elseif (session('usuario')->uData->ctari == 4)
                    {
                        $precio = number_format($articulo['APVP4'], 2, ",", ".");
                    }
                    elseif (session('usuario')->uData->ctari == 5)
                    {
                        $precio = number_format($articulo['ARESNUM5'], 2, ",", ".");
                    }
                    elseif (session('usuario')->uData->ctari == 6)
                    {
                        $precio = number_format($articulo['ARESNUM6'], 2, ",", ".");
                    }
                    else
                    {
                        $precio = number_format($articulo['APVP1'], 2, ",", ".");
                    }
                }
                else
                {
                    $precio = number_format($articulo['APVP1'], 2, ",", ".");
                }

                $aux = array(
                    "ACODAR" => $articulo['ACODAR'], 
                    "ADESCR" => $descrip, 
                    "ASTOCK" => $stockStr,
                    "numASTOCK" => $articulo['ASTOCK'],
                    "precio" => $precio,
                    "tieneTeclado" => $tieneTeclado,
                    "favRuta" => $favRuta,
                    "urlfoto" => $urlfoto,
                    "tipo" => $tipo,
                    "descrip" => $descrip,
                    "ATIPO2" => $articulo['ATIPO2']
                );

                array_push($arrDatosResultados, $aux);

                $tieneTeclado = false;

                if ($articulo['ATIPO2'] != 0)
                {
                    if (($articulo['AFAMILIA'] >= 521 && $articulo['AFAMILIA'] <= 529) || ($articulo['AFAMILIA'] == 560))
                    {
                        $tieneTeclado = true;
                    }
                }

                $articulo['tieneTeclado'] = $tieneTeclado;
            }
        }

        return View('buscador')->with("arrResultados", $arrDatosResultados)
                               ->with("ccodcl", $ccodcl);
    }

    public function producto($ide)
    {
        $this->init();
        //$this->listener();
        session("articulo")->pagina = "articulo";
        session("articulo")->articulo = urldecode($ide);
        $articulos = session("articulo")->listar6();

        if (count((array) $articulos) == 0) {
            session("articulo")->articulo = $ide;
            $articulos = session("articulo")->listar6();
        }

        if (count((array) $articulos) == 0) {
            return Redirect::to('/');
            return View('error');
        }
        session("articulo")->pagina = "alternativos";
        $matrizAlt = session("articulo")->listar6();
        $articulos[0]->alternativos = $matrizAlt;
        session("articulo")->pagina = "relacionados";
        //$matrizRel=session("articulo")->listar6();
        $articulos[0]->relacionados = []; // $matrizRel;
        return View('producto')->with("barti", $articulos[0]);
        return View('producto')->with(array("barti" => $articulos[0], "registros" => count($articulos), "seccion" => "producto"));
    }
    public function especial($seccion, $nombreseccion, $pag)
    {
        $this->init();
        //$this->listener();
        $vase = "x_seccweb0$seccion";
        $seci = trim(session("entorno")->config->$vase);
        session("articulo")->pagina = "especial";
        session("articulo")->sespecial = $seccion;
        session("articulo")->numPagina = $pag;
        $articulos = session("articulo")->listar6();
        // $matrizArt=$this->ponerArticulosBajoPedido($matrizArt); // si se quiere se pueden poner todos los articulos en bajo pedido (desactivado por defecto)
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "especial", "titulo" => $seci, "idmenu" => $seccion));
    }
    public function seguimiento()
    {
        $this->init();
        session("articulo")->pagina = "seguimiento";
        $articulos = session("articulo")->listar6();
        if (count((array) $articulos) > 0) {
            $articulos[0]->nomfamilia = "artículos en seguimiento";
        }
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "seguimiento"));
    }
    public function novedades($pag)
    {
        $this->init();
        $seci = "Novedades";
        session("articulo")->diasmaximo = 15; // mostrar los artículos creados en los últimos x días
        session("articulo")->pagina = "especial";
        session("articulo")->sespecial = 0;
        session("articulo")->numPagina = $pag;
        $articulos = session("articulo")->listar6();
        // $matrizArt=$this->ponerArticulosBajoPedido($matrizArt); // si se quiere se pueden poner todos los articulos en bajo pedido (desactivado por defecto)
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "novedades", "titulo" => $seci, "idmenu" => '0'));
    }
    public function sitemap($p1 = "", $p2 = "", $p3 = "")
    {
        $this->init();
        $rr = session('entorno')->sitemap($p1, $p2, $p3, Input::all());
        return $rr;
    }
    public function micuenta($seccion = "", $anno = "")
    {
        $this->init();

        $anioActual = date('Y');
        $idUsuario = session('usuario')->uData->codigo;

        if (session('usuario')->uData->codigo == 0) 
        {
            return Redirect::to('/');
        }

        if ($anno == "") 
        {
            Session::forget("manno"); // genera el listado de años para el filtrado de fecha
            //$anno = $anioActual;

            if (session("manno") == NULL)
            {
                $anno = $anioActual;
            }
            else
            {
                foreach(session("manno") as $ditt)
                {
                    if ($ditt != 'todos')
                    {
                        $anno = $ditt;
                        break;
                    }
                }
            }

            if ($seccion == 'modelo347' || $seccion == 'facturas')
            {
                $anno = "";
            }
        }

        $datosCC = $this->obtCentrosCliente();

        switch ($seccion) {
            case "":
                return View('micuenta')->with(array("seccion" => $seccion));
                break;

            case "nuevorma":
                return View('micuenta')->with(array("seccion" => $seccion));
                break;

            case "rma":
                $datos = session('usuario')->listadoDocumentos("rma");
                return View('micuenta')->with(array(
                    "seccion" => $seccion,
                    "datos" => $datos,
                ));
                break;

            case "presupuestos":
            case "pedidos":
            case "albaranes":
            case "facturas":
                $pedidosAux = array();
                $arrAniosModelo347 = $this->obtAniosModelo347(21);

                if ($anno == "")
                {
                    if (count($arrAniosModelo347) > 0)
                    {
                        $anio = $arrAniosModelo347[0];
                    }
                    else
                    {
                        $anio = date("Y");
                    }
                }
                else
                {
                    $anio = $anno;
                }

                $arrFacturas = DB::select("
                    SELECT fco.BPED, fcl.LALBA, fac.FDOC, fac.FFECHA, fac.FPEDID
                    FROM fccoc AS fco, fclia AS fcl, fccba AS fcc, fcfac AS fac
                    WHERE fco.BPED = fcl.LNUMPED
                    AND fcl.LALBA = fcc.BALBA
                    AND fcc.BFACTURA = fac.FDOC
                    AND fcl.LNUMPED > 0
                    AND fcc.BFACTURA > 0
                    AND fcc.BCODCL = $idUsuario
                    AND fac.FFECHA BETWEEN '".$anio."-01-01' AND '".$anio."-12-31'
                    ORDER BY fac.FFECHA ASC");

                $arrObservaciones = DB::select("
                    SELECT fac.FDOC, fac.FPEDID
                    FROM fcfac AS fac
                    WHERE fac.FCODCL = $idUsuario
                    AND fac.FFECHA BETWEEN '".$anio."-01-01' AND '".$anio."-12-31'
                    ORDER BY fac.FFECHA ASC");

                $datos = session('usuario')->listadoDocumentos($seccion, $anio);

                // Datos adicionales de los pedidos. Por ejemplo, para usar el campo BTOBRU y mostrar el total del pedido
                    if ($seccion == "pedidos")
                    {
                        $pedidosAux = DB::select("SELECT bped, btobru from fccoc WHERE YEAR(bfecped) = $anio AND bcodcl = $idUsuario");

                    }


                return View('micuenta')->with(array(
                    "seccion" => $seccion,
                    "anio" => $anio,
                    "annosele" => $anno,
                    "datos" => $datos,
                    "anioActual" => $anioActual,
                    "arrFacturas" => $arrFacturas,
                    "arrObservaciones" => $arrObservaciones,
                    "arrAniosModelo347" => $arrAniosModelo347,
                    "pedidosAux" => $pedidosAux
                ));
                break;

            case "pendiente":
                session("entorno")->cargaPagoEnvio(); // para ver si tenemos forma de pago por tarjeta para dar el cobro de recibos
                $datosAP = session('usuario')->listadoDocumentos("albaranesPendientes");
                $datosRP = session('usuario')->listadoDocumentos('recibosPendientes');
                $datosCP = session('usuario')->listadoDocumentos('cobrosPendientes');
                $totalPendiente = 0;

                foreach($datosRP as $dato)
                {
                    $totalPendiente += $dato->rpdte;
                }

                return View('micuenta')->with(array(
                    "seccion" => $seccion,
                    "datosAP" => $datosAP,
                    "datosRP" => $datosRP,
                    "datosCP" => $datosCP,
                    "totalPendiente" => $totalPendiente
                ));
                break;

            case "modelo347":

                $arrAniosModelo347 = $this->obtAniosModelo347(21);
                $anio = date("Y");

                if ($anno == null || $anno == "")
                {
                    for ($i = 0; $i < count($arrAniosModelo347); $i++) 
                    { 
                        $anio = $arrAniosModelo347[0];
                    }
                }
                else
                {
                    $anio = $anno;
                }

                $ccodcl = session('usuario')->uData->codigo;
                $datos = session('usuario')->listadoDocumentos("facturas", $anio);

                $filas = DB::select(
                    "SELECT ROUND(sum(FBASTOT), 2) as 'base', ROUND(sum(FIVATOT), 2) as 'iva', 
                    ROUND(sum(FRECTOT), 2) as 'rec', ROUND(sum(FTOTAL), 2) as 'total' 
                    FROM fcfac 
                    WHERE  year(FFECHA) = $anio and FCODCL = $ccodcl");

                $base = 0; 
                $iva = 0; 
                $rec = 0; 
                $total347 = 0;

                foreach ($filas as $fila)
                {
                    $base = $fila->base; 
                    $iva = $fila->iva; 
                    $rec = $fila->rec; 
                    $total347 = $fila->total;
                }

                $baseF = number_format($base, 2, ",", "."); $baseF .= "&euro;";
                $ivaF = number_format($iva, 2, ",", "."); $ivaF .= "&euro;";
                $recF = number_format($rec, 2, ",", "."); $recF .= "&euro;";
                $total347F = number_format($total347, 2, ",", "."); $total347F .= "&euro;";

                $filasT1IVA = $this -> obt347Trimestre($anio, $ccodcl, 1, 21);
                $filasT1SP = $this -> obt347Trimestre($anio, $ccodcl, 1, 0);
                $filasT2IVA = $this -> obt347Trimestre($anio, $ccodcl, 2, 21);
                $filasT2SP = $this -> obt347Trimestre($anio, $ccodcl, 2, 0);
                $filasT3IVA = $this -> obt347Trimestre($anio, $ccodcl, 3, 21);
                $filasT3SP = $this -> obt347Trimestre($anio, $ccodcl, 3, 0);
                $filasT4IVA = $this -> obt347Trimestre($anio, $ccodcl, 4, 21);
                $filasT4SP = $this -> obt347Trimestre($anio, $ccodcl, 4, 0);

                foreach ($filasT1IVA as $filaT1IVA)
                {
                    foreach ($filasT1SP as $filaT1SP)
                    {
                        $totalesT1 = ["base" => $filaT1IVA->base + $filaT1SP->base, "iva" => $filaT1IVA->iva + $filaT1SP->iva, "rec" => $filaT1IVA->rec + $filaT1SP->rec, "total" => $filaT1IVA->total + $filaT1SP->total];
                    }
                }

                foreach ($filasT2IVA as $filaT2IVA)
                {
                    foreach ($filasT2SP as $filaT2SP)
                    {
                        $totalesT2 = ["base" => $filaT2IVA->base + $filaT2SP->base, "iva" => $filaT2IVA->iva + $filaT2SP->iva, "rec" => $filaT2IVA->rec + $filaT2SP->rec, "total" => $filaT2IVA->total + $filaT2SP->total];
                    }
                }

                foreach ($filasT3IVA as $filaT3IVA)
                {
                    foreach ($filasT3SP as $filaT3SP)
                    {
                        $totalesT3 = ["base" => $filaT3IVA->base + $filaT3SP->base, "iva" => $filaT3IVA->iva + $filaT3SP->iva, "rec" => $filaT3IVA->rec + $filaT3SP->rec, "total" => $filaT3IVA->total + $filaT3SP->total];
                    }
                }

                foreach ($filasT4IVA as $filaT4IVA)
                {
                    foreach ($filasT4SP as $filaT4SP)
                    {
                        $totalesT4 = ["base" => $filaT4IVA->base + $filaT4SP->base, "iva" => $filaT4IVA->iva + $filaT4SP->iva, "rec" => $filaT4IVA->rec + $filaT4SP->rec, "total" => $filaT4IVA->total + $filaT4SP->total];
                    }
                }

                $totalesT1 = ["base" => $filaT1IVA->base + $filaT1SP->base, "iva" => $filaT1IVA->iva + $filaT1SP->iva, "rec" => $filaT1IVA->rec + $filaT1SP->rec, "total" => $filaT1IVA->total + $filaT1SP->total];
                $totalesT2 = ["base" => $filaT2IVA->base + $filaT2SP->base, "iva" => $filaT2IVA->iva + $filaT2SP->iva, "rec" => $filaT2IVA->rec + $filaT2SP->rec, "total" => $filaT2IVA->total + $filaT2SP->total];
                $totalesT3 = ["base" => $filaT3IVA->base + $filaT3SP->base, "iva" => $filaT3IVA->iva + $filaT3SP->iva, "rec" => $filaT3IVA->rec + $filaT3SP->rec, "total" => $filaT3IVA->total + $filaT3SP->total];
                $totalesT4 = ["base" => $filaT4IVA->base + $filaT4SP->base, "iva" => $filaT4IVA->iva + $filaT4SP->iva, "rec" => $filaT4IVA->rec + $filaT4SP->rec, "total" => $filaT4IVA->total + $filaT4SP->total];

                $matriz = array();
                $matriz[1] = ['iva' => $filasT1IVA, 'sp' => $filasT1SP, 'total' => $totalesT1];
                $matriz[2] = ['iva' => $filasT2IVA, 'sp' => $filasT2SP, 'total' => $totalesT2];
                $matriz[3] = ['iva' => $filasT3IVA, 'sp' => $filasT3SP, 'total' => $totalesT3];
                $matriz[4] = ['iva' => $filasT4IVA, 'sp' => $filasT4SP, 'total' => $totalesT4];

                $anioIVABase = $filaT1IVA->base + $filaT2IVA->base  + $filaT3IVA->base  + $filaT4IVA->base;
                $anioSPBase = $filaT1SP->base + $filaT2SP->base  + $filaT3SP->base  + $filaT4SP->base;

                $anioIVAIva = $filaT1IVA->iva + $filaT2IVA->iva  + $filaT3IVA->iva  + $filaT4IVA->iva;
                $anioSPIva = $filaT1SP->iva + $filaT2SP->iva  + $filaT3SP->iva  + $filaT4SP->iva;

                $anioIVARec = $filaT1IVA->rec + $filaT2IVA->rec  + $filaT3IVA->rec  + $filaT4IVA->rec;
                $anioSPRec = $filaT1SP->rec + $filaT2SP->rec  + $filaT3SP->rec  + $filaT4SP->rec;

                $anioIVATotal = $filaT1IVA->total + $filaT2IVA->total  + $filaT3IVA->total  + $filaT4IVA->total;
                $anioSPTotal = $filaT1SP->total + $filaT2SP->total  + $filaT3SP->total  + $filaT4SP->total;




                $arrFacturasAnio = DB::select(
                    "SELECT FDOC, FFECHA, ROUND(FBASTOT, 2) as 'BASE', ROUND(FIVATOT, 2) as 'IVA', ROUND(FRECTOT, 2) as 'REC', ROUND(FTOTAL, 2) as 'TOTAL' 
                    FROM fcfac 
                    WHERE  year(FFECHA) = $anio and FCODCL = $ccodcl
                    order by FFECHA asc");

                foreach ($arrFacturasAnio as $arrFacturaAnio)
                {
                    $ffecha = new DateTime($arrFacturaAnio->FFECHA);
                    $fechaF = $ffecha->format('d/m/Y');

                    $fdoc = $arrFacturaAnio->FDOC;
                    $ffecha = new DateTime($arrFacturaAnio->FFECHA);
                    $fechaF = $ffecha->format('d/m/Y');
                    $base = $arrFacturaAnio->BASE; 
                    $iva = $arrFacturaAnio->IVA; 
                    $rec = $arrFacturaAnio->REC; 
                    $total = $arrFacturaAnio->TOTAL; 
                    $baseF = number_format($base, 2, ",", "."); $baseF .= "&euro;";
                    $ivaF = number_format($iva, 2, ",", "."); $ivaF .= "&euro;";
                    $recF = number_format($rec, 2, ",", "."); $recF .= "&euro;";
                    $totalF = number_format($total, 2, ",", "."); $totalF .= "&euro;";

                    $pos = strpos($fdoc, $anio."");
                    
                    $numCeros = 4 - $pos;
                    $codpdf2 = "";

                    for ($i = 0; $i < $numCeros; $i++)
                    {
                        $codpdf2 .= "0"; 
                    }

                    $codPDF = "FAC".$codpdf2.$fdoc;

                    $arrFacturaAnio->BASEF = $baseF;
                    $arrFacturaAnio->FFECHA = $fechaF;
                    $arrFacturaAnio->IVAF = $ivaF;
                    $arrFacturaAnio->RECF = $recF;
                    $arrFacturaAnio->TOTALF = $totalF;
                    $arrFacturaAnio->CODPDF = $codPDF;
                }

                return View('micuenta')->with(array(
                    "seccion" => $seccion,
                    "datos" => $datos,
                    "matriz" => $matriz,
                    "anioIVABase" => $anioIVABase,
                    "anioSPBase" => $anioSPBase,
                    "anioIVAIva" => $anioIVAIva,
                    "anioSPIva" => $anioSPIva,
                    "anioIVARec" => $anioIVARec,
                    "anioSPRec" => $anioSPRec,
                    "anioIVATotal" => $anioIVATotal,
                    "anioSPTotal" => $anioSPTotal,
                    "anio" => $anio,
                    "annosele" => $anno,
                    "arrFacturasAnio" => $arrFacturasAnio,
                    "arrAniosModelo347" => $arrAniosModelo347
                ));
                break;

            case "tarifa_art":
            case "tarifa_blo":
            case "tarifa_fam":
            case "tarifa_fcp":
                ini_set('max_execution_time', 120);
                try {
                    set_time_limit(120);
                } catch (\Exception $e) {
                }
                return session('usuario')->exportacionTarifa($seccion); // 20052020 cambio a csv fallaba al redirigir a ruta
                return View('micuenta')->with(array("seccion" => $seccion));
                break;

            case "tarifas":
                return View('micuenta')->with(array("seccion" => $seccion));
                break;

            case "envios":
                $datosPR = session('usuario')->listadoDocumentos("enviosPreparados");
                $datosPE = session('usuario')->listadoDocumentos('enviosPendientes');
                return View('micuenta')->with(array(
                    "seccion" => $seccion,
                    "datosPR" => $datosPR,
                    "datosPE" => $datosPE,
                ));
                break;

            case "datos":
                $diaActual = date("d");
                $mesActual = date("m");
                $anioActual = date("Y");
                $horaActual = date("H");
                $minutosActual = date("i");
                $segundosActual = date("s");

                $txtCambioFiscal = '';
                $txtMsjMailSolicitud = '';
                $colorMsjMailSolicitud = '';

                if(Session::has('success'))
                {
                    $txtMsjMailSolicitud = 'Su solicitud ha sido enviada. En breve recibirá respuesta de nuestro departamento de contabilidad.';
                    $colorMsjMailSolicitud = '#239B56';
                }

                if (Request::isMethod('post'))
                {
                    $ccodcl = session('usuario')->uData->codigo;
                    $txtCambioFiscal = Request::input('tt_cambio_fiscal');

                    if (Request::has('tt_cambio_fiscal'))
                    {
                        $fileCambioFiscal = Request::file('btn_cambio_fiscal');

                        $validator = Validator::make(Request::all(), 
                            ['btn_cambio_fiscal' => 'required|mimes:pdf|max:2048']);

                        if($validator->fails()) 
                        {
                            $txtMsjMailSolicitud = 'Por favor, adjunte un documento de identificación fiscal o Modelo 036. Debe ser en formato PDF.';
                            $colorMsjMailSolicitud = '#CB4335';
                        }
                        else
                        {
                            $adjunto = 'solicitud_datos_fiscales_'.$anioActual.'_'.$mesActual.'_'.$diaActual.'_'.$horaActual.'_'.$minutosActual.'_'.$segundosActual.'.pdf';
                            $fileCambioFiscal->move('public/datosfiscales', $adjunto);
                            $this->solicitarCambioUsuario($ccodcl, $txtCambioFiscal, $adjunto);
                            $txtMsjMailSolicitud = 'Su solicitud ha sido enviada. En breve recibirá respuesta de nuestro departamento de contabilidad.';
                            $colorMsjMailSolicitud = '#239B56';
                        }
                    }
                    else
                    {
                        $txtMsjMailSolicitud = 'Para enviar la solicitud tiene que indicar el cambio que quiere realizar.';
                        $colorMsjMailSolicitud = '#CB4335';
                    }
                }


                $datosCL = session('usuario')->datosCliente();
                $datosSB = session('usuario')->datosSubclientes();
                //$datosCC = session('usuario')->datosCentrosCliente();
                //$datosCC = $this->obtCentrosCliente();
                return View('micuenta')->with(array(
                    "seccion" => $seccion,
                    "datosCL" => $datosCL,
                    "datosSB" => $datosSB,
                    "datosCC" => $datosCC,
                    "txtMsjMailSolicitud" => $txtMsjMailSolicitud,
                    "colorMsjMailSolicitud" => $colorMsjMailSolicitud,
                    "txtCambioFiscal" => $txtCambioFiscal,
                ));
                break;
            case "direccionesmodificar":
                $datos = Input::all();
                $datosSB = session('usuario')->subclienteModificar($datos);
                if (Session::has("redir")) {
                    return Redirect::to(session('redir'));
                }

                if (Input::has("pagina")) 
                {
                    return Redirect::to('/cesta');
                }
                else
                {
                    return Redirect::to('micuenta/datos');
                }
                
                break;
            case "centrosmodificar":
                $codi = session('usuario')->nuevocentro();
                $datos = Input::all();
                $datosSB = session('usuario')->centroModificar($datos);
                if (Session::has("redir")) {
                    //return Redirect::to(session('redir'));
                }
                
                if (Input::has("pagina")) 
                {
                    return Redirect::to('/cesta');
                }
                else
                {
                    return Redirect::to('micuenta/datos');
                }
                break;
            case "direcciones":
                switch ($anno) {
                    case "":
                        return Redirect::to('/');
                        break;
                    case "nueva":
                        $codi = session('usuario')->nuevocentro();
                        return Redirect::to('micuenta/direcciones/' . $codi);
                        break;
                    default:
                        $datosSB = session('usuario')->datosSubclientes($anno);
                        $datosCC = $this->obtCentrosCliente();
                        $ultCentro = $this->obtUltCentro();
                        return View('micuenta')->with(array(
                            "seccion" => $seccion,
                            //"datosCL"=>$datosCL,
                            "datosSB" => $datosSB,
                            "datosCC" => $datosCC,
                            "ultCentro" => $ultCentro
                        ));
                        break;
                }
            case "centros":
                switch ($anno) {
                    case "":
                        return Redirect::to('/');
                        break;
                    case "nuevo":
                        $codi = session('usuario')->nuevocentro();
                        return Redirect::to('micuenta/centros/' . $codi);
                        break;
                    default:
                        $datosCC = session('usuario')->datosCentrosCliente($anno);
                        return View('micuenta')->with(array(
                            "seccion" => $seccion,
                            //"datosCL"=>$datosCL,
                            "datosSB" => array(),
                            "datosCC" => $datosCC
                        ));
                        break;
                }

            default:
                return Redirect::to('/');
                break;
        }
    }



    public function envioMailSolicitudMayor()
    {
        if (Request::isMethod('post'))
        {
            $ccodcl = Request::input('ccodcl');
            $cliente = Request::input('cliente');

            $this->solicitarMayorMail($ccodcl, $cliente);
        }
    }

    function solicitarCambioUsuario($ccodcl, $txtCambioFiscal, $adjunto)
    {
        //$emailRepre = "programacion@diginova.es";

        // Cuando el cliente pulsa SOLICITAR AUTORIZACIÓN se envía este email
 
        require_once base_path().'/phpmailer/class.smtp.php';
        require_once base_path().'/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();
         
        //Le indicamos que el modo será SMTP    
        //$mail -> IsSMTP();     
         
         //Configuramos el Charset del mensaje               
        //$mail -> CharSet="ISO-8859-1"; 
        $mail -> CharSet="utf8"; 
         
        //Autenticacion Segura con ssl
        $mail -> SMTPSecure = 'ssl';

        //El servidor smtp, en nuestro caso usaremos el de gmail
        $mail -> Host = "mail.diginova.es";
         
        //El puerto, en gmail sería 465
        $mail -> Port = 25;
         
        //El email a través del cual enviaremos
        $mail -> Username = 'javimoya33@gmail.com';
         
        //Contraseña del email
        $mail -> Password = 'RGi20f8GyL3bi1qD';
         
        //Le indicamos que se requiere autenticacion
        $mail -> SMTPAuth = true;
         
        //Si responden el mensaje llegará a...
        $mail -> From = 'javimoya33@gmail.com';
         
        //Nombre que le indicará de donde viene el mensaje al destinatario
        $mail -> FromName = 'Diginova - RMA';
        
        //$receptor = $emailRepre;
        $receptor = 'programacion@diginova.es';
        //$receptor = 'contabilidad@diginova.es';


        //Email de destino 
        $mail -> AddAddress($receptor);
        $mail -> addAttachment('public/datosfiscales/'.$adjunto, 'modelo036.pdf');
        

        //Lo mandaremos en HTML?
        $mail -> IsHTML(true);
         
        $mail -> Subject = "Solicitud Cambio en Datos fiscales del Cliente ".$ccodcl;
         
        //$mail -> Body = "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/xweb/images/logoempresa.jpg' alt='Diginova' /></a></p>";
        $mail -> Body = "<p>Solicitud: ".$txtCambioFiscal."</p></br>";

        $enviado = false;

        if(!$mail -> Send())
        {
            //echo "<br /><br />";
            //echo 'No se pudo enviar el mensaje.'.$mail -> ErrorInfo;
            $enviado = false;
        }
        else
        {
            //echo "<br /><br />";
            //echo 'El mensaje se ha enviado correctamente.';
            $enviado = true;
        }

        return $enviado; 
    }

    public function getObsvPedido($pedido)
    {
        $arrObservs = DB::select("SELECT BOBSINT FROM fccoc WHERE BPED = $pedido");

        $observacion = "";

        foreach ($arrObservs as $arrObserv)
        {
            $observacion = $arrObserv->BOBSINT;
        }

        return $observacion;
    }

    public function misdocumentos($tipo, $numero, $mensaje = 0)
    {
        $this->init();
        if (session('usuario')->uData->codigo == 0) {
            return Redirect::to('/');
        }

        $datos = session('usuario')->verdocumento($tipo, $numero);

        if (empty($datos))
        {
            return Redirect::to('/');
        }

        $ccodcl = session('usuario')->uData->codigo;
        $tarifa = 2;
        
        if ($ccodcl > 0)
        {
            $tarifa = session('usuario')->uData->ctari;
        }

        $artsCesta = DB::select("
                SELECT fcl.LCODAR, fcl.LCANTI, fcl.LCODCL, fca.ADESCR, fcl.LPRECI, fcl.LIMPOR
                FROM fcloc as fcl, fcart as fca
                WHERE fcl.LCODAR = fca.ACODAR
                AND fcl.LCODCL = $ccodcl
                AND LPED = $numero");


        if ($tipo == "cobro") {
            $numero = session('usuario')->generarcobrorecibo($numero);
            //Log::info($numero);
            $tipo="pedido";
        }

        $datos->amplMemoria = "";
        $datos->amplDiscoDuro = "";
        $datos->amplTeclado = "";

        $numArticulosSinAmpliacion = 0;
        $cantArticulosSinAmpliacion = 0;

        if ($tipo == "pedido" || $tipo == "factura")
        {
            $arrAmpliaciones = $this->obtAmpliacionesMiCestaByNumPedido($ccodcl, $numero);

            $obsint = '';

            foreach ($arrAmpliaciones as $arrAmpliacion)
            {
                $obsint .= '*** Articulo: '.$arrAmpliacion->articulo;

                if ($arrAmpliacion->ampliacion1 != '')
                {
                    $obsint .= ' * Ampliacion: '.$arrAmpliacion->ampliacion1;
                }

                if ($arrAmpliacion->ampliacion2 != '')
                {
                    $obsint .= ' * Ampliacion: '.$arrAmpliacion->ampliacion2;
                }

                if ($arrAmpliacion->ampliacion3 != '')
                {
                    $obsint .= ' * Ampliacion: '.$arrAmpliacion->ampliacion3;
                }

                $obsint .= ' * Unidades: '.$arrAmpliacion->unidades.'\n';
            }

            DB::update("UPDATE fccoc SET BOBSINT = '$obsint' WHERE BPED = $numero");

            DB::update("UPDATE fcloc SET LRESSN1 = 'S' WHERE LPED = $numero");

            $idPedido = $datos->numdocumento;

            $this->setIdAgencia($idPedido, session("usuario")->uData->agencia);

            foreach ($datos->documento as $articulo)
            {
                $articulo->ampliacion = array();
                $articulo->cantAmpliacion = array();
                $articulo->descrAmpliacion = array();
                $articulo->precioAmpliacion = array();
                $articulo->importeAmpliacion = array();

                if (in_array($articulo->codigo, $this->arrAmpliaciones))
                {
                    $articulo->esAmpliacion = true;
                    $articulo->tieneAmpliacion = false;
                }
                else
                {
                    $articulo->esAmpliacion = false;
                    $articulo->tieneAmpliacion = false;

                    for ($i = 1; $i <= 3; $i++) 
                    {
                        $arrAmpliaciones = $this->obtAmpliacionesMiCestaByAmpl($ccodcl, 'ampliacion'.$i, $numero);

                        foreach ($arrAmpliaciones as $arrAmpliacion)
                        {
                            if ($articulo->codigo == $arrAmpliacion->articulo)
                            {
                                $articulo->tieneAmpliacion = true;

                                if ($i == 1)
                                {
                                    $ampliacion = $arrAmpliacion->ampliacion1;
                                }
                                else if ($i == 2)
                                {
                                    $ampliacion = $arrAmpliacion->ampliacion2;   
                                }
                                else if ($i == 3)
                                {
                                    $ampliacion = $arrAmpliacion->ampliacion3; 
                                }

                                $arrDatosArticulos = $this->obtDatosArticulo($ampliacion);

                                foreach ($arrDatosArticulos as $arrDatoArticulo)
                                {
                                    array_push($articulo->ampliacion, $ampliacion);
                                    array_push($articulo->cantAmpliacion, $arrAmpliacion->unidades);
                                    array_push($articulo->descrAmpliacion, $arrDatoArticulo->ADESCR);

                                    $precio = 0;

                                    switch ($tarifa) {
                                        case 1:
                                            $precio = $arrDatoArticulo->APVP1;
                                            break;
                                        case 2:
                                            $precio = $arrDatoArticulo->APVP2;
                                            break;
                                        case 3:
                                            $precio = $arrDatoArticulo->APVP3;
                                            break;
                                        case 4:
                                            $precio = $arrDatoArticulo->APVP4;
                                            break;
                                        case 5:
                                            $precio = $arrDatoArticulo->ARESNUM5;
                                            break;
                                        case 6:
                                            $precio = $arrDatoArticulo->ARESNUM6;
                                            break;
                                        default:
                                            $precio = $arrDatoArticulo->APVP1;
                                    }

                                    array_push($articulo->precioAmpliacion, $precio);
                                    array_push($articulo->importeAmpliacion, $precio * $arrAmpliacion->unidades);
                                }
                            }
                        }
                    }
                }
            }

            $numArticulosSinAmpliacion = 0;
            $cantArticulosSinAmpliacion = 0;

            foreach ($datos->documento as $articulo)
            {
                if (!in_array($articulo->codigo, $this->arrAmpliaciones)) 
                {
                    $numArticulosSinAmpliacion += 1;
                    $cantArticulosSinAmpliacion += $articulo->cantidad;
                }
            }
        }

        if (count((array) $datos) == 0) {
            return View('error');
        }

        $vista = "misdocumentos";
        if ($tipo == "rma_etiqueta") {
            $vista = "emails.rma_etiqueta";
        }

        $decprec = session('entorno')->config->x_decpreci;
        $deccan = session('entorno')->config->x_deccanti;
        return View($vista)->with(array(
            "tipo" => $tipo,
            "numero" => $numero,
            "datos" => $datos,
            "datoscliente" => session('usuario')->uData,
            "decprec" => $decprec,
            "deccan" => $deccan,
            "numArticulosSinAmpliacion" => $numArticulosSinAmpliacion,
            "cantArticulosSinAmpliacion" => $cantArticulosSinAmpliacion,
            "mensaje" => $mensaje,
        ));
    }
    public function enlace($ide)
    {
        $this->init();
        $iso = "x_adic" . $ide . "tit";
        switch (substr($ide, 0, 1)) {
            case "d":
                $mat = "menuEnlacesDer";
                $ide = substr($ide, 1);
                break;
            case "a":
                $mat = "menuEnlacesAba";
                $ide = substr($ide, 1);
                break;
            default:
                $mat = "menuEnlacesIzq";
                break;
        }
        if (!isset(session("menu")->$mat->$ide->titulo)) {
            return Redirect::to('/');
        }
        return View('enlaceadicional')->with('id', session("menu")->$mat->$ide);
    }

    public function contactar()
    {
        $this->init();
        $confm = Mailerx::cargarConfig("secundaria"); // principal / adicional, con esto queda el mail configurado
        if (Request::ajax()) {
            // recojo los datos del formulario
            $enviarmail = true; // si marcamos a false no se envia correo de confirmación al cliente
            switch ($enviarmail) {
                case true:
                    // envío de correo electrónico
                    $datos = Input::all(); // cName cMail cTel cConsulta
                    if(isset($datos['cCha'])){
                        //Log::info($datos['cCha']);
                        if($datos['cCha']!="x".session("captcha_txt")){
                            return array(
                                'exito' => false,
                                'destino' => "",
                                'errors' => "Rellene correctamente el código de la imagen.",
                            );
                        }
                    }
                    $datos['vista'] = "emails.formulariocontacto";
                    $datos['asunto'] = "Formulario de contacto";
                    $datos['nombre'] = "";
                    $datos['usuario'] = "";
                    $datos['mail'] = $datos['cMail'];
                    $enviado = $this->enviarMail($datos, $confm);
                    switch ($enviado) {
                        case false:
                            // intenta enviar el correo pero no consigue
                            return array(
                                'exito' => false,
                                'destino' => "",
                                'errors' => "Error en envío de correo, reintente.",
                            );
                            break;
                        case true:
                            return array(
                                'exito' => true,
                                'destino' => URL::to(''),
                                'errors' => "Se ha enviado un correo con la información solicitada.",
                            );
                            break;
                    }
                    break;
                case false:
                    return array(
                        'exito' => false,
                        'destino' => "",
                        'errors' => "No se ha enviado correo.",
                    );
                    break;
            }
        } else {
            $ranStr = md5(microtime());
            $ranStr = substr($ranStr, 0, 6);
            $_SESSION['cap_code'] = $ranStr;
            //$ruta = base_path() . "/public/articulos/" . $indi . trim($cod_ars) . "_" . $aasa . ".jpg";
            $newImage = imagecreatefromjpeg(base_path()."/public/images/captcha.jpg");
            $txtColor = imagecolorallocate($newImage, 0, 0, 0);
            imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
            //header("Content-type: image/jpeg");
            ob_start (); 
            imagejpeg ($newImage);
            $image_data = ob_get_contents (); 
            ob_end_clean (); 
            //imagejpeg($newImage);
            session(["captcha_img" => $image_data]);            
            session(["captcha_txt" => $ranStr]);            
            //Log::info(session("captcha_txt"));
            return View('contacto')->with("matrizMail", $confm);
        }
    }
    public function politicacookies()
    {
        $this->init();
        return View('politicacookies');
    }
    public function cambiarOrden($ide)
    {
        //$this->init();
        //Log::info($ide);

        if ($ide == "cuadros") {
            Cookie::queue(Cookie::forever('visual', '1')); // modo de vista cuadrícula
            return;
        }
        if ($ide == "lista") {
            Cookie::queue(Cookie::forever('visual', '2')); // modo de vista lista
            return;
        }

        Cookie::queue(Cookie::forever('ordenacion', $ide)); // por defecto descripción descendente
    }
    public function misCompras()
    {
        $this->init();
        session("articulo")->pagina = "compras";
        session("articulo")->incluirtpv = false; // cuando saco info de lo que he comprado que incluya las compras de tpv de los ultimos 90 dias
        $articulos = session("articulo")->listar6();
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "compras"));
    }
    public function avisos()
    {
        $this->init();
        session("articulo")->pagina = "aviso";
        $articulos = session("articulo")->listar6();
        return View('index')->with(array("articulos" => $articulos, "registros" => count($articulos), "seccion" => "avisos"));
    }
    public function mensajes($tipo)
    {
        $this->init();
        return View('mensajes')->with(array(
            "tipo" => $tipo,
        ));
    }
    public function tracking()
    {
        $this->init();
        if (Request::ajax() == false) {
            return (array(
                'msg' => 'error al añadir artículo a seguimiento (1)',
                'exito' => false,
            ));
        }
        if (strpos(Input::get('desde'), "/avisos") === false && Input::get("tipo") == "avi") {
            // mandamos correo a nosotros mismos indicando que un usuario ha puesto en aviso sin stock un articulo
            $datoscuenta = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
            $direcciones = array();
            $direcciones[0] = $datoscuenta->dir; // direccion configurada desde xgest
            $artio = Input::get("codigo");
            $cocli = session("usuario")->uData->codigo; // codigo de cliente
            $nomcli = session("usuario")->uData->cnom;
            try {
                Mail::send([], [], function ($message) use ($direcciones, $artio, $cocli, $nomcli) {
                    $message->to($direcciones)
                        ->subject("Artículo puesto en seguimiento en la web")
                        ->setBody("El cliente $cocli $nomcli ha puesto en aviso el artículo $artio");
                });
            } catch (\Exception $ex) {
                Log::info($ex); // envía el error al registro de logs
                $ok = false;
            }
        }
        if (session("articulo")->tracking(Input::get('codigo'), Input::get('tipo'), Input::get('desde')) == true) {
            return (array(
                'msg' => '1',
                'exito' => true,
            ));
        }
        return (array(
            'msg' => 'error al añadir artículo a seguimiento (2)',
            'exito' => false,
        ));
    }
    public function resetFotos()
    {
        $this->init();
        $files = glob("public/articulos/art*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/gra*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/prs*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/grf*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/usu*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/mar*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/fam*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        $files = glob("public/articulos/cli*.jpg");
        foreach ($files as $file) {
            unlink($file);
        }
        return Redirect::to('/');
    }
    public function accesoGlobal()
    {
        $this->init();
        $claveMaestra = trim(session("entorno")->config->x_clamaestra);
        if (strlen($claveMaestra) == 0) {
            Log::info("agno");
            return Redirect::to('/');
        }
        //
        $texto = "";
        if (Input::has("textoG")) {
            $texto = trim(Input::get("textoG"));
        }
        $clave = "";
        if (Input::has("claveG")) {
            $clave = trim(Input::get("claveG"));
        }
        $matCli = null;
        $matCli = session("usuario")->listadoClientes($texto, $clave, $claveMaestra);
        return View('accesoGlobal')->with(array(
            "texto" => $texto,
            "clave" => $clave,
            "clientes" => $matCli,
        ));
    }
    public function retornarStocks($usu, $pass)
    {
        $this->init();
        //echo $usu."  ".$pass;
        $retorno = session('usuario')->archivoStocks($usu, $pass);
        if ($retorno === false) {
            return "no correcto";
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="stocks.csv"',
        );
        return Response::make($retorno, 200, $headers);
        // echo $retorno;
    }
    public function retornarStocksCsv($usu, $pass)
    {
        $this->init();
        ini_set('max_execution_time', 120);
        try {
            set_time_limit(120);
        } catch (\Exception $e) {
        }
        $retorno = session('usuario')->archivoStocksCsv($usu, $pass);
        if ($retorno === false) {
            return "no correcto";
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="stocks.csv"',
        );
        return Response::make($retorno, 200, $headers);
    }
    public function retornarStocksDetalle($usu, $pass)
    {
        $this->init();
        $retorno = session('usuario')->archivoStocksDetalle($usu, $pass);
        if ($retorno === false) {
            return "no correcto";
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="stocks.csv"',
        );
        return Response::make($retorno, 200, $headers);
        // echo $retorno;
    }
    public function descargarPDF($midocu)
    {
        $this->init();
        if (session('usuario')->uData->codigo == 0) {
            return View('error');
        }
        $datos = session('usuario')->descargarPDF($midocu);
        if (strlen($datos) <= 0) {
            return View('error');
        }
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=\"" . $midocu . ".pdf\"");
        echo $datos;
        return;
    }
    public function descargarPDFFile($midocu)
    {
        $this->init();
        if (session('usuario')->uData->codigo == 0) {
            return View('error');
        }
        $datos = session('usuario')->descargarPDFFile($midocu);
        if (strlen($datos) <= 0) {
            return View('error');
        }
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=\"FAC" . substr("000000" . $midocu, -14) . ".pdf\""); // revisar funcion str_pad
        echo $datos;
        return;
    }
    public function buscar($pag = 1)
    {
        $this->init();
        $datos = Input::all();
        session("articulo")->pagina = "buscar";
        session("articulo")->busquedaexacta = false; // false busca que existan todas las palabras en cualquier orden true busca el texto exacto que escribamos
        session("articulo")->nobuscarencodigos = false; // true evita buscar el texto en códigos de artículo
        //session("articulo")->nobuscarencodigos = true; // true evita buscar el texto en códigos de artículo
        session("articulo")->numPagina = $pag;
        session('articulo')->matBusquedas->texto = Input::get('busqueda_texto');
        session('articulo')->matBusquedas->marca = "";
        session('articulo')->matBusquedas->familia = 0;
        session('articulo')->matBusquedas->tipo = 0;
        session('articulo')->matBusquedas->tipo2 = 0;
        if (is_null(Input::get('busqueda_texto'))) {
            session('articulo')->matBusquedas->texto = "";
        }

        if (strlen(session('articulo')->matBusquedas->texto) > 0 && strlen(session('articulo')->matBusquedas->texto) < 3) {
            session('articulo')->matBusquedas->texto = "";
        }

        if (Input::has("busqueda_marca") && Input::has("busqueda_familia")) {
            session('articulo')->matBusquedas->marca = Input::get('busqueda_marca');
            session('articulo')->matBusquedas->familia = Input::get('busqueda_familia');
            session("articulo")->bloque = 0;
        }

        if (Input::has("busqueda_tipo")) {
            session('articulo')->matBusquedas->tipo = Input::get('busqueda_tipo');
        }
        if (Input::has("busqueda_tipo2")) {
            session('articulo')->matBusquedas->tipo2 = Input::get('busqueda_tipo2');
        }
        //Log::info(session('articulo')->matBusquedas->tipo);
        //Log::info(session('articulo')->matBusquedas->tipo2);

        if (strlen(session('articulo')->matBusquedas->texto) == 0 && strlen(session('articulo')->matBusquedas->marca) == 0 && session('articulo')->matBusquedas->familia == 0) {
            // nada que buscar
            session('articulo')->matBusquedas->familia = 9999999;
        }

        $articulos = session("articulo")->listar6();
        return View('index')->with(array(
            "articulos" => $articulos,
            "registros" => count($articulos),
            "seccion" => "buscar",
        ));
    }
    public function buscarVue()
    {
        $this->init();
        $datos = Input::all();
        session("articulo")->pagina = "buscarVue";
        session("articulo")->busquedaexacta = false; // false busca que existan todas las palabras en cualquier orden true busca el texto exacto que escribamos
        session("articulo")->nobuscarencodigos = false; // true evita buscar el texto en códigos de artículo
        //session("articulo")->nobuscarencodigos = true; // true evita buscar el texto en códigos de artículo
        // modificar los campos donde se hace la busqueda // session("articulo")->filtrobusqueda="a.acodar,adescr,aampdes,a.arescar1,acodalt2,acodalt3,acodalt4,acodalt5,acodalt6,acodalt7,acodalt8,acodalt9,acodalt10,apartnumb,a.acarac,a.aobse,aobsweb";
        session("articulo")->numPagina = 1;
        session('articulo')->matBusquedas->texto = Input::get('texto');
        session('articulo')->matBusquedas->marca = "";
        session('articulo')->matBusquedas->familia = 0;
        $articulos = session("articulo")->listar6();
        return $articulos;
    }
    public function altarma()
    {
        $this->init();
        //Input::all()
        $datosxx = session('usuario')->altaRMA(Input::all());
        if ($datosxx['tipo'] == "archivo") {
            return;
        }

        //return array(
        //    'exito'=>true,
        //    'notas'=>texto para el mail,
        //    'codigorma'=>numero de rma,
        //    'directoriouploads'=>directorio con adjuntos rma,
        //);
        // envío de correo electrónico

        //archivo adjunto
        $confm = Mailerx::cargarConfig("rma"); // principal / adicional, con esto queda el mail configurado
        $datos['vista'] = "emails.rma";
        $datos['asunto'] = "Solicitud de RMA en tienda web";
        $datos['nombre'] = session('usuario')->uData->cnom;
        $datos['usuario'] = session('usuario')->uData->cnombreweb;
        $datos['mail'] = session('usuario')->uData->cmail;
        if (strlen(trim(session('usuario')->uData->rmail)) > 0) {
            $datos['mail'] = session('usuario')->uData->rmail; // mail al representante en vez de mail a la empresa
        }
        $datos['directorioadjuntos'] = $datosxx['directoriouploads'];
        $datos['ruta'] = URL::to('documentos/rma/' . $datosxx['codigorma']);
        $datos['notas'] = $datosxx['notas'];
        $enviado = $this->enviarMail($datos, $confm);
        switch ($enviado) {
            case false:
                // intenta enviar el correo pero no consigue, redirige al pedido
                return array(
                    'exito' => false,
                    'ruta' => $datos['ruta'],
                    'destino' => $datos['ruta'],
                );
                break;
            case true:
                $ficheros = scandir($datos['directorioadjuntos']);
                foreach ($ficheros as $value) {
                    if ($value === '.' || $value === '..') {
                        continue;
                    }
                    unlink($datos['directorioadjuntos'] . DIRECTORY_SEPARATOR . $value);
                }
                return array(
                    'exito' => true,
                    'ruta' => $datos['ruta'],
                    'destino' => $datos['ruta'],
                );
                break;
        }
    }
    public function buscarrma($texto)
    {
        $this->init();
        if (Request::ajax() == false) {
            return array(
                'exito' => false,
                'errors' => 'no es una petición ajax',
            );
        }
        $articulos = session("articulo")->buscarrma($texto);
        //return ($articulos);
        //return response()->json($articulos);
        return array(
            'exito' => true,
            'respuesta' => $articulos,
        );
    }
    public function listarCestas()
    {
        $this->init();
        $matriz = session("articulo")->listarCestas();
        var_dump($matriz);
        return "";
        //return Redirect::to('/cesta');
    }
    public function guardarCesta($titulo = "cesta guardada")
    {
        $this->init();
        $correcto = session("articulo")->guardarCesta($titulo);
        session("usuario")->cargarCesta(0, 2); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva
        return Redirect::to('/cesta');
    }
    public function recuperarCesta($numerocesta)
    {
        $this->init();
        $correcto = session("articulo")->recuperarCesta($numerocesta);
        session("usuario")->cargarCesta(0, 2); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva
        return Redirect::to('/cesta');
    }
    public function eliminarCesta($numerocesta)
    {
        $this->init();
        $correcto = session("articulo")->eliminarCesta($numerocesta);
        return Redirect::to('/cesta');
    }

    public function obtDatosArticulo($acodar)
    {
        $arrArticulos = DB::select("
                SELECT fca.ACODAR, fca.ADESCR, fca.APVP1, fca.APVP2, fca.APVP3, fca.APVP4, fca.ARESNUM5, fca.ARESNUM6
                FROM fcart as fca
                WHERE fca.ACODAR = '$acodar'");

        return $arrArticulos;
    }

    public function visualizarCesta($paso = 1, $proveedor = 0)
    {
        $this->init();

        $amplMemoria = '';
        $amplDiscoDuro = '';
        $amplTeclado = '';
        $anioActual = date("Y");

        $ccodcl = session('usuario')->uData->codigo;
        $tarifa = 2;
        
        if ($ccodcl > 0)
        {
            $tarifa = session('usuario')->uData->ctari;
        }
        
        session('usuario')->crecargo = "S";

        for ($i = 0; $i < count($this->arrPortes); $i++) 
        { 
            session("articulo")->deleteArticulo($this->arrPortes[$i]);
        }

        //$this->listener();
        // $paso=1->resumen
        // $paso=2->envio
        // $paso=3->pago
        // $paso=4->finalizar
        //$this->selecFormasCesta("envio",11); // asigna una forma de envio fija
        if ($paso != "1" && $paso != "2" && $paso != "3" && $paso != "4") {
            $paso = 1;
        }
        session("articulo")->pagina = "cesta";
        session("articulo")->cargarimagenesencesta = false;
        $articulos = session("articulo")->listar6();

        //$this->calculoPegatinaPortugal($articulos);

        if ($ccodcl > 0)
        {
            $existe=false;
            foreach ($articulos as $buss) 
            {
                if (in_array($buss->acodar, $this->arrAmpliaciones))
                {
                    $existe = true;
                    //session("articulo")->deleteArticulo($buss->acodar);
                }
            }

            $this->calculoportes(); 
            session("articulo")->pagina = "cesta";
            session("articulo")->cargarimagenesencesta = false;
            $articulos = session("articulo")->listar6();
        }

        $numArticulosSinAmpliacion = 0;
        $cantArticulosSinAmpliacion = 0;

        foreach ($articulos as $articulo)
        {
            if (!in_array($articulo->acodar, $this->arrAmpliaciones)) 
            {
                $numArticulosSinAmpliacion += 1;
                $cantArticulosSinAmpliacion += $articulo->cantidad;
            }
        }

        if ($cantArticulosSinAmpliacion == 0)
        {
            $this->emptyBasket();
        }
        else if ($cantArticulosSinAmpliacion < 2)
        {
            session("articulo")->deleteArticulo('POA');
            session("articulo")->deleteArticulo('POAS');
        }

        $articulos = session("articulo")->listar6();

        if ($ccodcl > 0)
        {
            session('usuario')->uData->importeCesta = $this->editarImporteCesta();
            session('usuario')->uData->numArticulosCesta = $this->editarNumArticulosCesta();
        }

        //session("usuario")->cargarCesta(0, 2);

        // $matrizCes=$this->ponerArticulosBajoPedido($matrizCes); // si se quiere se pueden poner todos los articulos en bajo pedido (desactivado por defecto)
        session("entorno")->cargaPagoEnvio();
        session("usuario")->datosSubclientes(); // direcciones de envio del cliente
        session("usuario")->datosCentrosCliente(); // direcciones de envio del cliente
        //$this->selecFormasCesta("envio",16); // asigna una forma de envio fija
        $articulos = session("articulo")->visualizarCesta($articulos, 0, -1, false, 0, $paso);

        $artsCesta = $this->obtMisArticulosCesta();

        foreach ($articulos as $articulo)
        {
            if ($articulo->acodar == '91019901P') 
            {
                $articulo->totalLinea = 0;
            }
        }

        foreach ($articulos as $articulo)
        {
            $articulo->ampliacion = array();
            $articulo->cantAmpliacion = array();
            $articulo->descrAmpliacion = array();
            $articulo->precioAmpliacion = array();
            $articulo->importeAmpliacion = array();
            $articulo->restoCantAmpliacion = array();

            if (in_array($articulo->acodar, $this->arrAmpliaciones))
            {
                $articulo->esAmpliacion = true;
                $articulo->tieneAmpliacion = false;
            }
            else
            {
                $articulo->esAmpliacion = false;
                $articulo->tieneAmpliacion = false;

                for ($i = 1; $i <= 3; $i++) 
                {
                    $arrAmpliaciones = $this->obtAmpliacionesMiCestaByAmpl($ccodcl, 'ampliacion'.$i, '0');

                    foreach ($arrAmpliaciones as $arrAmpliacion)
                    {
                        if ($articulo->acodar == $arrAmpliacion->articulo)
                        {
                            $articulo->tieneAmpliacion = true;

                            if ($i == 1)
                            {
                                $ampliacion = $arrAmpliacion->ampliacion1;
                            }
                            else if ($i == 2)
                            {
                                $ampliacion = $arrAmpliacion->ampliacion2;   
                            }
                            else if ($i == 3)
                            {
                                $ampliacion = $arrAmpliacion->ampliacion3; 
                            }

                            $arrDatosArticulos = $this->obtDatosArticulo($ampliacion);

                            foreach ($arrDatosArticulos as $arrDatoArticulo)
                            {
                                array_push($articulo->ampliacion, $ampliacion);
                                array_push($articulo->cantAmpliacion, $arrAmpliacion->unidades);
                                array_push($articulo->descrAmpliacion, $arrDatoArticulo->ADESCR);

                                $arrAmpliacionesTipo = $this->obtAmpliacionesMiCestaByTipoAmpl($ccodcl, 'ampliacion'.$i, '0');

                                $cantTotalAmpliacion = 0;

                                foreach ($arrAmpliacionesTipo as $arrAmpliacionTipo)
                                {
                                    if ($i == 1)
                                    {
                                        if ($arrAmpliacion->ampliacion1 == $arrAmpliacionTipo->ampliacion1)
                                        {
                                            $cantTotalAmpliacion += $arrAmpliacionTipo->unidades;
                                        }
                                    }
                                    else if ($i == 2)
                                    {
                                        if ($arrAmpliacion->ampliacion2 == $arrAmpliacionTipo->ampliacion2)
                                        {
                                            $cantTotalAmpliacion += $arrAmpliacionTipo->unidades;
                                        }  
                                    }
                                    else if ($i == 3)
                                    {
                                        if ($arrAmpliacion->ampliacion3 == $arrAmpliacionTipo->ampliacion3)
                                        {
                                            $cantTotalAmpliacion += $arrAmpliacionTipo->unidades;
                                        }
                                    }
                                }

                                $restoCantAmpliacion = $cantTotalAmpliacion - $arrAmpliacion->unidades;

                                array_push($articulo->restoCantAmpliacion, $restoCantAmpliacion);

                                $precio = 0;

                                switch ($tarifa) {
                                    case 1:
                                        $precio = $arrDatoArticulo->APVP1;
                                        break;
                                    case 2:
                                        $precio = $arrDatoArticulo->APVP2;
                                        break;
                                    case 3:
                                        $precio = $arrDatoArticulo->APVP3;
                                        break;
                                    case 4:
                                        $precio = $arrDatoArticulo->APVP4;
                                        break;
                                    case 5:
                                        $precio = $arrDatoArticulo->ARESNUM5;
                                        break;
                                    case 6:
                                        $precio = $arrDatoArticulo->ARESNUM6;
                                        break;
                                    default:
                                        $precio = $arrDatoArticulo->APVP1;
                                }

                                array_push($articulo->precioAmpliacion, $precio);
                                array_push($articulo->importeAmpliacion, $precio * $arrAmpliacion->unidades);
                            }
                        }
                    }
                }
            }
        }

        $articulos = collect($articulos)->sortBy('esAmpliacion')->toArray();
        $articulos = collect($articulos)->sortBy('acodar')->toArray();

        $formapago = session("usuario")->uData->cforpa;
        $nomFormaPago = $this->getFormaPago($formapago);

        foreach (session("entorno")->formasPago as $bfor)
        {
            if ($bfor->wcod == 7)
            {
                if ($formapago == 14 || $formapago == 21)
                {
                    session("entorno")->desgloseCesta->formaPago = 1;
                }
            }
        }

        foreach (session("usuario")->uDireccionesEnvio as $bfor)
        {
            if ($bfor->direccion != '')
            {
                session("entorno")->desgloseCesta->direccionEnvio = $bfor->id;
                break;
            }
        }

        /*$totalCesta = (float) session("entorno")->desgloseCesta->sumaTotalSinImpuestos + (float) session("entorno")->desgloseCesta->iva2;
        session("entorno")->desgloseCesta->granTotal = $totalCesta;*/

        $anno = "";
        Session::forget("manno");
        $datosCC = session('usuario')->datosCentrosCliente();

        if (count($this->obtCentrosCliente()) > 0)
        {
            $datosCC = array_reverse($datosCC);
            $contadorDatosCC = 0;

            foreach ($datosCC as $sb)
            {
                if ($contadorDatosCC == 0)
                {
                    if ($sb->nombre != "" || $sb->direccion != "")
                    {
                        session('usuario')->nuevocentro();
                    }
                }

                $contadorDatosCC += 1;
            }
        }
        else
        {
            session('usuario')->nuevocentro();
        }

        $datosCC = session('usuario')->datosCentrosCliente();
        $datosCC2 = $this->obtCentrosCliente();

        session("usuario")->uData->agencia = $this->getIdAgencia();

        if (session("entorno")->desgloseCesta->centroCliente == 0)
        {
            session("entorno")->desgloseCesta->centroCliente = session("entorno")->desgloseCesta->formaPago;
        }

        return View('cesta')->with(array(
            "articulos" => $articulos,
            "numArticulosSinAmpliacion" => $numArticulosSinAmpliacion,
            "cantArticulosSinAmpliacion" => $cantArticulosSinAmpliacion,
            "registros" => count($articulos),
            "seccion" => "cesta",
            "paso" => intval($paso),
            "formapago" => $formapago,
            "nomFormaPago" => $nomFormaPago,
            "formasPago" => array_reverse(session("entorno")->formasPago),
            "formasEnvio" => session("entorno")->formasEnvio,
            "direccionesEnvio" => session("usuario")->uDireccionesEnvio,
            "centrosCliente" => $this->obtCentrosCliente(),
            "desgloseCesta" => session("entorno")->desgloseCesta,
            "ccodcl" => $ccodcl,
            "datosCL" => session('usuario')->datosCliente(),
            "datosCC" => $datosCC,
            "datosCC2" => $datosCC2,
            "idAgencia" => $this->getIdAgencia()
        ));
    }

    public function obtMisArticulosCesta()
    {
        $ccodcl = session('usuario')->uData->codigo;
        $arrArticulos = DB::select("
                SELECT fcx.ARTICULO, fcx.CANTIDAD, fcx.CLIENTE, fca.ADESCR, fca.APVP1, fca.APVP2, fca.APVP3, fca.APVP4, fca.ARESNUM5, fca.ARESNUM6 
                FROM fcx5c as fcx, fcart as fca
                WHERE fcx.ARTICULO = fca.ACODAR
                AND fcx.CLIENTE = $ccodcl");

        return $arrArticulos;
    }

    public function obtUltCentro()
    {
        $ccodcl = session('usuario')->uData->codigo;
        $arrCentrosCliente = DB::select("
                SELECT MAX(ZCEN) as centro
                FROM fccen
                WHERE ZCLI = $ccodcl");

        $centro = 0;

        if (count($arrCentrosCliente) > 0)
        {
            foreach ($arrCentrosCliente as $arrCentroCliente)
            {
                $centro = $arrCentroCliente->centro + 1;
            }
        }
        else
        {
            $centro = 1;
        }

        return $centro;
    }

    public function obtCentrosCliente()
    {
        $ccodcl = session('usuario')->uData->codigo;
        $arrCentrosCliente = DB::select("
                SELECT ZCLI, ZCEN, ZNOM, ZDOM, ZCODPO, ZPOB, ZPAIS, ZTEL, ZDESACT, ZOBS, ZMAIL1
                FROM fccen
                WHERE ZCLI = $ccodcl");

        return $arrCentrosCliente;
    }

    public function setIdAgencia($idPedido, $idAgencia)
    {
        DB::update("UPDATE fccoc SET BAGENCIA = $idAgencia WHERE BPED = $idPedido");
    }

    public function getIdAgencia()
    {
        $arrAgencias = DB::select("
                SELECT VCOD, VDES
                FROM fcveh
                WHERE VDES = 'MRW'");

        $idAgencia = 0;

        foreach ($arrAgencias as $arrAgencia)
        {
            $idAgencia = $arrAgencia->VCOD;
        }

        return $idAgencia;
    }

    public function getFormaPago($formapago)
    {
        $arrFormasPago = DB::select("
                SELECT GDESFP
                FROM fcfpg
                WHERE GCODFP = $formapago");

        $nomFormaPago = '';

        foreach ($arrFormasPago as $arrFormaPago)
        {
            $nomFormaPago = $arrFormaPago->GDESFP;
        }

        return $nomFormaPago;
    }

    public function codigoPromocional($paso = 1)
    {
        $this->init();
        session("entorno")->codigopromocional = Utils::mysqlRealEscape(Input::get('promo'), false);
        //$promos=session("entorno")->cargaPromociones();
        //$cantipromos=Utils::numeroRegistrosObjeto($promos);
        session("articulo")->pagina = "cesta";
        session("articulo")->cargarimagenesencesta = false;
        $articulos = session("articulo")->listar6();
        // $matrizCes=$this->ponerArticulosBajoPedido($matrizCes); // si se quiere se pueden poner todos los articulos en bajo pedido (desactivado por defecto)
        session("entorno")->cargaPagoEnvio();
        session("usuario")->datosSubclientes(); // direcciones de envio del cliente
        session("usuario")->datosCentrosCliente(); // direcciones de envio del cliente
        $articulos = session("articulo")->visualizarCesta($articulos);
        return View('cesta')->with(array(
            "articulos" => $articulos,
            "registros" => count($articulos),
            "seccion" => "cesta",
            "paso" => intval($paso),
            "formasPago" => session("entorno")->formasPago,
            "formasEnvio" => session("entorno")->formasEnvio,
            "direccionesEnvio" => session("usuario")->uDireccionesEnvio,
            "centrosCliente" => session("usuario")->uCentrosCliente,
            "desgloseCesta" => session("entorno")->desgloseCesta,
        ));
    }
    public function detalleCesta($numerocesta)
    {
        $this->init();
        session("articulo")->pagina = "cestaGuardada";
        session("articulo")->sespecial = $numerocesta;
        $matrizCes = session("articulo")->listar6();
        session("entorno")->cargaPagoEnvio();
        session("usuario")->datosSubclientes(); // direcciones de envio del cliente
        session("usuario")->datosCentrosCliente(); // direcciones de envio del cliente
        $matrizCes = session("articulo")->visualizarCesta($matrizCes, $numerocesta);
        return View('cesta')->with(array(
            "matrizCes" => $matrizCes,
            "registros" => count($matrizCes),
            "seccion" => "cesta",
            "paso" => 1,
            "formasPago" => session("entorno")->formasPago,
            "formasEnvio" => session("entorno")->formasEnvio,
            "direccionesEnvio" => session("usuario")->uDireccionesEnvio,
            "centrosCliente" => session("usuario")->uCentrosCliente,
            "desgloseCesta" => session("entorno")->desgloseCesta,
        ));
    }
    public function modificarCesta($numerocesta)
    {
        $this->init();
        $correcto = session("articulo")->modificarCesta($numerocesta);
        session("usuario")->cargarCesta(0, 2); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva
        return Redirect::to('/cesta');
    }
    public function eliminarPedido($numeropedido)
    {
        $this->init();
        $coc = session("entorno")->tablas->coc;
        $loc = session("entorno")->tablas->loc;
        $rcli = session("usuario")->uData->codigo;
        DB::delete("delete from $coc where bped=$numeropedido and bcodcl=$rcli");
        DB::delete("delete from $loc where lped=$numeropedido and lcodcl=$rcli");
        return Redirect::to('/miCuenta/pedidos');
    }
    public function toBasket($ide)
    {
        $this->init();
        session("articulo")->toBasket($ide);
        session("usuario")->cargarCesta(0, 2); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva
        return Redirect::to('/cesta');
    }
    public function emptyBasket()
    {
        $this->init();
        session("articulo")->emptyBasket();
        session("usuario")->cargarCesta(0, 2); // segundo parametro devuelve: a 1 importe total sin iva, a 2 importe total con iva

        session("entorno")->desgloseCesta->direccionEnvio = -1;

        $ccodcl = session('usuario')->uData->codigo;

        $this->emptyAmpliacion($ccodcl);

        return Redirect::to('/cesta');
    }
    public function finalizarCompra()
    {
        $this->init();

        Session::forget("redir");
        if (Request::ajax() == false) {
            return array(
                'exito' => false,
                'errors' => 'no es una petición ajax',
            );
        }
        if (session('usuario')->uData->codigo == 0) {
            return array(
                'exito' => false,
                'errors' => 'no se ha iniciado sesión',
            );
        }
        $comprobarstock = false;
        /*if (!session("entorno")->config->x_ventamaxstk) {
            $comprobarstock = true;
        }*/
        $fijo=0;$deshabilitarreservapedidos=false;
        //$fijo=0;$deshabilitarreservapedidos=true;
        echo "test 1";
        $datos = session('usuario')->finalizarCompra($comprobarstock,$fijo,$deshabilitarreservapedidos);
        if ($datos['exito'] == false) {
            return $datos;
        }

        // datos del centro
        session('entorno')->desgloseCesta->centroDatos = null;
        if (session('entorno')->desgloseCesta->centroCliente > 0 && 1 == 2) {
            $r = session("usuario")->uData->codigo;
            $c = session('entorno')->desgloseCesta->centroCliente;
            $cen = session("entorno")->tablas->cen;
            $resuc = DB::select("select znom,zdom,zcodpo,zpob,zpais,ztel,zfax,zobs from $cen where zcli=$r and zcen=$c limit 1");
            session('entorno')->desgloseCesta->centroDatos = $resuc;
        }

        // envío de correo electrónico
        //archivo adjunto
        if (file_exists(session('usuario')->uData->adjuntos->f1b) == false) {
            session('usuario')->uData->adjuntos->f1 = "";
            session('usuario')->uData->adjuntos->f1b = "";
        }
        $adjuntoname = session('usuario')->uData->adjuntos->f1;
        $adjuntotemp = session('usuario')->uData->adjuntos->f1b;
        //
        //$axe=Mailerx::formularioPedidoCliente(session('usuario')->uData->cmail,session('usuario')->uData->rmail,session('entorno')->config->x_nomemp,$desgloseCesta,$matrizCesta,$direccionesEnvio,$formasPago,$formasEnvio,$adjuntoname,$adjuntotemp);



        $confm = Mailerx::cargarConfig("principal"); // principal / adicional, con esto queda el mail configurado
        $datos['vista'] = "emails.pedido";
        $datos['asunto'] = "Pedido número ".session('entorno')->desgloseCesta->numPedido." realizado en DIGINOVA";
        $datos['nombre'] = session('usuario')->uData->cnom;
        $datos['usuario'] = session('usuario')->uData->cnombreweb;
        // $datos['mail'] = session('usuario')->uData->cmail;
        /*if (strlen(trim(session('usuario')->uData->rmail)) > 0) {
            $datos['mail'] = session('usuario')->uData->rmail; // mail al representante en vez de mail a la empresa 1234
        }*/
        $datos['mail'] = 'programacion@diginova.es';
        //$datos['mail'] = 'javimoya33@gmail.com';
        $datos['adjuntoname'] = $adjuntoname;
        $datos['adjuntotemp'] = $adjuntotemp;
        // registro mails enviados
        DB::statement("create table if not exists aaaa_correosenviados (
        cliente int(11) not null default 0,
        dtime datetime,
        direccion char(200) not null default '',
        correcto char(1))");
        $cocli = session("usuario")->uData->codigo;
        $gmail = $datos['mail'];
        //
        $enviado = $this->enviarMail($datos, $confm);
        session('entorno')->desgloseCesta->anotaciones = "";
        session("entorno")->desgloseCesta->direccionEnvio = -1;

        switch ($enviado) {
            case false:
                // intenta enviar el correo pero no consigue, redirige al pedido
                DB::insert("insert into aaaa_correosenviados (cliente,dtime,direccion,correcto) values ($cocli,now(),'$gmail','N')"); // graba registro
                return array(
                    'exito' => true,
                    'ruta' => $datos['ruta'],
                    'destino' => $datos['ruta'],
                    'errors' => "Datos de cliente actualizados.",
                );
                break;
            case true:
                session('usuario')->uData->adjuntos->f1 = "";
                $dir = base_path() . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . ""; // date('YmdHisu')
                foreach (glob($dir . "*.tmp") as $file) {
                    // borro temporales de archivos subidos
                    //Log::info(substr($file,0,8)."  ".date('Ymd'));
                    if (strpos($file, date('Ymd')) === false && !strpos($file, ".tmp" === false)) {
                        unlink($file);
                    }
                }
                DB::insert("insert into aaaa_correosenviados (cliente,dtime,direccion,correcto) values ($cocli,now(),'$gmail','S')"); // graba registro
                return array(
                    'exito' => true,
                    'ruta' => $datos['ruta'],
                    'destino' => $datos['ruta'],
                    'errors' => "Se ha enviado un correo a su dirección con los datos del pedido, compruebe la bandeja de entrada.",
                );
                break;
        }
    }

    public function articuloNoInventariable($acodar)
    {
        $arrArticulos = DB::select("SELECT ANOINVENT FROM fcart WHERE ACODAR = $acodar");

        $noInventariable = false;

        foreach ($arrArticulos as $arrArticulo)
        {
            if ($arrArticulo->ANOINVENT == 'S')
            {
                $noInventariable = true;
            }
            else
            {
                $noInventariable = false;
            }
        }

        return $noInventariable;
    }

    public function obtAmpliacionesMiCesta($ccodcl)
    {
        $arrAmpliaciones = DB::select("
            SELECT * FROM ampliaciones 
            WHERE ccodcl = $ccodcl
            AND pedido = '0'");

        return $arrAmpliaciones;
    }

    public function obtAmpliacionesMiCestaByAmpl($ccodcl, $tipoAmpliacion, $pedido)
    {
        $arrAmpliaciones = DB::select("
            SELECT articulo, ampliacion1, ampliacion2, ampliacion3, SUM(unidades) as unidades, ccodcl
            FROM ampliaciones 
            WHERE ccodcl = $ccodcl
            AND pedido = '$pedido'
            GROUP BY articulo, ".$tipoAmpliacion);

        return $arrAmpliaciones;
    }

    public function obtAmpliacionesMiCestaByTipoAmpl($ccodcl, $tipoAmpliacion, $pedido)
    {
        $arrAmpliaciones = DB::select("
            SELECT articulo, ampliacion1, ampliacion2, ampliacion3, SUM(unidades) as unidades, ccodcl
            FROM ampliaciones 
            WHERE ccodcl = $ccodcl
            AND pedido = '$pedido'
            GROUP BY ".$tipoAmpliacion);

        return $arrAmpliaciones;
    }

    public function obtAmpliacionesMiCestaByNumPedido($ccodcl, $pedido)
    {
        $arrAmpliaciones = DB::select("
            SELECT articulo, ampliacion1, ampliacion2, ampliacion3, unidades, ccodcl
            FROM ampliaciones 
            WHERE ccodcl = $ccodcl
            AND pedido = '$pedido'");

        return $arrAmpliaciones;
    }

    public function addAmpliacion($articulo, $ampliacion1, $ampliacion2, $ampliacion3, $unidades, $ccodcl)
    {
        $arrAmpliaciones = $this->obtAmpliacionesMiCesta($ccodcl);
        $uds = (int)$unidades;

        foreach ($arrAmpliaciones as $arrAmpliacion)
        {
            if ($arrAmpliacion->articulo == $articulo && $arrAmpliacion->ampliacion1 == $ampliacion1 && $arrAmpliacion->ampliacion2 == $ampliacion2 && $arrAmpliacion->ampliacion3 == $ampliacion3)
            {
                $uds = (int)$uds + (int)$arrAmpliacion->unidades;
            }
        }

        DB::delete("DELETE FROM ampliaciones 
            WHERE articulo = '$articulo' 
            AND ampliacion1 = '$ampliacion1'
            AND ampliacion2 = '$ampliacion2'
            AND ampliacion3 = '$ampliacion3'
            AND ccodcl = $ccodcl
            AND pedido = '0'");

        DB::insert("INSERT INTO ampliaciones (articulo, ampliacion1, ampliacion2, ampliacion3, unidades, ccodcl, fecha_mod)
                    VALUES ('$articulo', '$ampliacion1', '$ampliacion2', '$ampliacion3', $uds, $ccodcl, SYSDATE())");
    }

    public function modifyAmpliacion($articulo, $ampliacion1, $ampliacion2, $ampliacion3, $unidades, $ccodcl)
    {
        DB::update("UPDATE ampliaciones SET unidades = $unidades 
            WHERE articulo = '$articulo' 
            AND ampliacion1 = '$ampliacion1'
            AND ampliacion2 = '$ampliacion2'
            AND ampliacion3 = '$ampliacion3'
            AND ccodcl = $ccodcl
            AND pedido = '0'");
    }

    public function deleteAmpliacion($articulo, $ccodcl)
    {
        DB::delete("DELETE FROM ampliaciones 
            WHERE articulo = '$articulo' 
            AND ccodcl = $ccodcl
            AND pedido = '0'");
    }

    public function emptyAmpliacion($ccodcl)
    {
        DB::delete("DELETE FROM ampliaciones 
            WHERE ccodcl = $ccodcl
            AND pedido = '0'");
    }

    public function modifyAmpliacionNumPedido($ccodcl, $pedido)
    {
        DB::update("UPDATE ampliaciones SET pedido = '$pedido' 
            WHERE ccodcl = $ccodcl
            AND pedido = '0'");
    }

    public function addArticulo()
    {
        $this->init();
        if (Request::ajax() == false) {
            return (array(
                'msg' => 'error al añadir artículo (1)',
                'cesta' => '0',
                'importe' => "0",
                'exito' => false,
            ));
        }

        if (Input::get('codigo') == 'POG' || Input::get('codigo') == 'POV' || Input::get('codigo') == 'POGS' || Input::get('codigo') == 'PO')
        {
            if (session("articulo")->addArticulo(Input::get('codigo'), 1, 0, true) == true) 
            {
                session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva
                $numArticulosCesta = $this->editarNumArticulosCesta();
                $importeCesta = $this->editarImporteCesta();
                return (array(
                    'msg' => Input::get('cantidad'),
                    'importe' => "Total1: " . number_format($importeCesta, 2, ",", ".") . "€",
                    'esAmpl' => true,
                    'exito' => true,
                ));
            }
        }
        else
        {
            session("articulo")->pagina = "cesta";
            session("articulo")->cargarimagenesencesta = false;
            $articulos = session("articulo")->listar6();

            $proveedor = 0;
            $paso = 1;
            session("entorno")->cargaPagoEnvio();
            session("usuario")->datosSubclientes(); // direcciones de envio del cliente
            //$this->selecFormasCesta("envio",16); // asigna una forma de envio fija
            //session("entorno")->desgloseCesta->formaEnvio=11;
            $articulos = session("articulo")->visualizarCesta($articulos, 0, -1, false, 0, $paso);
            $ccodcl = session('usuario')->uData->codigo;
            $adios = 'Adios';

            $cantArticulo = Input::get('cantidad');
            
            foreach ($articulos as $articulo)
            {
                if ($articulo->acodar == Input::get('codigo'))
                {
                    $cantArticulo = (int)$cantArticulo + (int)$articulo->cantiCesta;
                }
            }

            if (session("articulo")->deleteArticulo(Input::get('codigo')) == true)
            {
                session("articulo")->addArticulo(Input::get('codigo'), $cantArticulo);
            }

            if (Input::get('ampl1') != '' || Input::get('ampl2') != '' || Input::get('ampl3') != '') 
            {
                if (Input::get('ampl1') != '')
                {
                    $cantAmpl1 = Input::get('cantidad');
            
                    foreach ($articulos as $articulo)
                    {
                        if ($articulo->acodar == Input::get('ampl1'))
                        {
                            $cantAmpl1 = (int)$cantAmpl1 + (int)$articulo->cantiCesta;
                        }
                    }

                    if (session("articulo")->deleteArticulo(Input::get('ampl1')) == true)
                    {
                        session("articulo")->addArticulo(Input::get('ampl1'), $cantAmpl1, 0, true);
                    }
                }

                if (Input::get('ampl2') != '')
                {
                    $cantAmpl2 = Input::get('cantidad');
            
                    foreach ($articulos as $articulo)
                    {
                        if ($articulo->acodar == Input::get('ampl2'))
                        {
                            $cantAmpl2 = (int)$cantAmpl2 + (int)$articulo->cantiCesta;
                        }
                    }

                    if (session("articulo")->deleteArticulo(Input::get('ampl2')) == true)
                    {
                        session("articulo")->addArticulo(Input::get('ampl2'), $cantAmpl2, 0, true);
                    }
                }

                if (Input::get('ampl3') != '')
                {
                    $cantAmpl3 = Input::get('cantidad');
            
                    foreach ($articulos as $articulo)
                    {
                        if ($articulo->acodar == Input::get('ampl3'))
                        {
                            $cantAmpl3 = (int)$cantAmpl3 + (int)$articulo->cantiCesta;
                        }
                    }

                    if (session("articulo")->deleteArticulo(Input::get('ampl3')) == true)
                    {
                        session("articulo")->addArticulo(Input::get('ampl3'), $cantAmpl3, 0, true);
                    }
                }

                $this->addAmpliacion(Input::get('codigo'), Input::get('ampl1'), Input::get('ampl2'), Input::get('ampl3'), Input::get('cantidad'), $ccodcl);
            }

            session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva
            $numArticulosCesta = $this->editarNumArticulosCesta();
            $importeCesta = $this->editarImporteCesta();
            return (array(
                'msg' => $adios,
                'cesta' => $numArticulosCesta,
                'importe' => "Total: " . number_format($importeCesta, 2, ",", ".") . "€",
                'esAmpl' => true,
                'exito' => true,
                'codigo' => Input::get('codigo')
            ));
        }

        $numArticulosCesta = $this->editarNumArticulosCesta();
        $importeCesta = $this->editarImporteCesta();

        return (array(
            'msg' => 'error al añadir artículo (2) - '.Input::get('codigo'),
            'cesta' => $numArticulosCesta,
            'importe' => "Total: " . number_format($importeCesta, 2, ",", ".") . "€",
            'esAmpl' => false,
            'exito' => false,
        ));
    }
    public function modifyArticulo()
    {
        $this->init();
        if (Request::ajax() == false) {
            return (array(
                'msg' => 'error al modificar artículo (1)',
                'cesta' => '0',
                'importe' => "" . $impocesta,
                'exito' => false,
            ));
        }
        if (session("articulo")->deleteArticulo(Input::get('codigo')) == true) {
        }
        if (session("articulo")->addArticulo(Input::get('codigo'), Input::get('cantidad')) == true) {
            session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva

            $numArticulosCesta = $this->editarNumArticulosCesta();
            $importeCesta = $this->editarImporteCesta();

            return (array(
                'msg' => Input::get('cantidad'),
                'cesta' => "" . $numArticulosCesta,
                'importe' => "Total: " . number_format($importeCesta, 0, ",", ".") . "€",
                'exito' => true,
            ));
        }

        $numArticulosCesta = $this->editarNumArticulosCesta();
        $importeCesta = $this->editarImporteCesta();

        return (array(
            'msg' => 'error al modificar artículo (2)',
            'cesta' => '0',
            'importe' => "Total: " . number_format($importeCesta, 0, ",", ".") . "€",
            'exito' => false,
        ));
    }
    public function deleteArticulo()
    {
        $this->init();
        if (Request::ajax() == false) {
            return (array(
                'msg' => 'error al eliminar artículo (1)',
                'cesta' => '0',
                'importe' => "0",
                'exito' => false,
            ));
        }

        $ccodcl = session('usuario')->uData->codigo;

        if (session("articulo")->deleteArticulo(Input::get('codigo')) == true) 
        {
            if (Input::get('numArticulos') > 0)
            {
                $this->deleteAmpliacion(Input::get('codigo'), $ccodcl);
                session("articulo")->addArticulo(Input::get('codigo'), Input::get('numArticulos'), 0, true);
            }
            else
            {
                $this->deleteAmpliacion(Input::get('codigo'), $ccodcl);
            }

            session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva

            $this->calculoportes(); 
            $numArticulosCesta = $this->editarNumArticulosCesta();
            $importeCesta = $this->editarImporteCesta();

            session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva

            return (array(
                'msg' => Input::get('cantidad'),
                'cesta' => "" . $numArticulosCesta,
                'importe' => "Total: " . number_format($importeCesta, 2, ",", ".") . "€",
                'exito' => true,
            ));
        }

        session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva

        $this->calculoportes(); 
        $numArticulosCesta = $this->editarNumArticulosCesta();
        $importeCesta = $this->editarImporteCesta();
        return (array(
            'msg' => 'error al eliminar artículo (2)',
            'cesta' => '0',
            'importe' => "Totalooo: " . number_format($importeCesta, 2, ",", ".") . "€",
            'exito' => false,
        ));
    }

    public function calculoPegatinaPortugal($articulos)
    {
        $ccodcl = session('usuario')->uData->codigo;

        $arrZonas = $this->obtZonaCliente($ccodcl);
        $miZona = 0;

        foreach ($arrZonas as $arrZona)
        {
            $miZona = $arrZona->czona;
        }

        //$miZona = 80;

        if ($miZona == 80)
        {
            $numPortatilesEnCesta = 0;

            foreach ($articulos as $articulo)
            {
                if (!in_array($articulo->acodar, $this->arrAmpliaciones)) 
                {
                    if (strpos($articulo->acodar, "6920" ) === 0) 
                    {
                        $numPortatilesEnCesta += $articulo->cantidad;
                    }
                }
            }

            session("articulo")->deleteArticulo('91019901P');

            if ($numPortatilesEnCesta > 0)
            {
                session("articulo")->addArticulo('91019901P', $numPortatilesEnCesta, 0, true);
                session("usuario")->cargarCesta(0, 2); // segundo parametro: 1 importe cesta sin iva 2 importe cesta con iva
                $numArticulosCesta = $this->editarNumArticulosCesta();
                $importeCesta = $this->editarImporteCesta();
            }

            $articulos = session("articulo")->listar6();
        }
    }

    public function faq()
    {
        $this->init();
        $faq = session("entorno")->tablas->faq;
        $matrizFaq = DB::select("select fpreg as pregunta,fresp as respuesta,xfecalta as fecha,fultmodif as ultimamod from $faq order by fpreg,xfecalta desc");
        return View('faq')->with("matrizFaq", $matrizFaq);
    }
    public function pasarelasPago($tipo)
    {
        $this->init();
        session('usuario')->validarPago($tipo, Input::all());
    }
    public function cambiarPagoPedido()
    {
        $this->init();
        $numero = Input::get('numero');
        $valor = Input::get('valor');
        session('usuario')->cambiarPagoPedido($numero, $valor);
    }
    public function cambiarDesgloseCesta()
    {
        $this->init();
        $objeto = Input::get('objeto');
        $valor = Input::get('valor');
        switch ($objeto) {
            case "adom1":
                session('entorno')->desgloseCesta->adom1 = $valor;
                break;
            case "adom2":
                session('entorno')->desgloseCesta->adom2 = $valor;
                break;
            case "plazo":
                session('entorno')->desgloseCesta->plazoEntrega = $valor;
                break;
            case "horario":
                session('entorno')->desgloseCesta->enTiendaPorDefecto = $valor;
                break;
            case "notas":
                session('entorno')->desgloseCesta->anotaciones = $valor;
                break;
        }
    }
    public function selecFormasCesta($pagoenvio, $codigo)
    {
        Log::info("sfc ".$pagoenvio." ".$codigo);
        $this->init();
        session("entorno")->desgloseCesta->direccionEnvio = -1;
        switch ($pagoenvio) {
            case "pago":
                session("entorno")->desgloseCesta->formaPago = $codigo;
                break;
            case "centro":
                session("entorno")->desgloseCesta->centroCliente = $codigo;
                break;
            case "envio":
                session("entorno")->desgloseCesta->formaEnvio = $codigo;
                break;
            case "direccion":
                session("entorno")->desgloseCesta->direccionEnvio = $codigo;
                break;
        }
        return $pagoenvio . " " . $codigo;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API clientes///////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function apiListaClientes()
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ret = $ob->listaClientes();
        return response()->json($ret);
    }
    public function apiListaClientesZonas()
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ret = $ob->listaClientesZonas();
        return response()->json($ret);
    }
    public function apiListaDireccionesCliente($id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $id;
        $ret = $ob->listaDireccionesCliente();
        return response()->json($ret);
    }
    public function apiFichaCliente($id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $id;
        $ret = $ob->fichaCliente();
        return response()->json($ret);
    }
    public function apiNuevoCliente()
    {
        //$this->init();
        $received = Input::all();
        //Log::info(print_r($received, true));
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ret = $ob->nuevoCliente();
        return response()->json($ret);
    }
    public function apiNuevaDireccionEnvio($id)
    {
        //$this->init();
        $received = Input::all();
        //Log::info(print_r($received, true));
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ob->cliente = $id;
        $ret = $ob->nuevaDireccionEnvio();
        return response()->json($ret);
    }
    public function apiActualizarCliente($id)
    {
        //$this->init();
        $received = Input::all();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ob->cliente = $id;
        $ret = $ob->actualizarCliente();
        return response()->json($ret);
    }
    public function apiEliminarCliente($id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $id;
        $ret = $ob->eliminarCliente();
        return response()->json($ret);
    }
    public function apiEliminarDireccionEnvio($cliente, $id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->direccion = $id;
        $ob->cliente = $cliente;
        $ret = $ob->eliminarDireccionEnvio();
        return response()->json($ret);
    }
    public function apiActualizarDireccionEnvio($cliente, $id)
    {
        //$this->init();
        $received = Input::all();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ob->direccion = $id;
        $ob->cliente = $cliente;
        $ret = $ob->actualizarDireccionEnvio();
        return response()->json($ret);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API clientes///////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API pedidos////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function apiNuevoPedido()
    {
        //$this->init();
        $received = Input::all();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ret = $ob->nuevoPedido();
        return response()->json($ret);
    }
    public function apiRecuperarPedido($cliente, $documento)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $cliente;
        $ob->documento = $documento;
        $ret = $ob->recuperarPedido();
        return response()->json($ret);
    }
    public function apiRecuperarFactura($cliente, $documento)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $cliente;
        $ob->documento = $documento;
        $ret = $ob->recuperarFactura();
        return response()->json($ret);
    }
    public function apiListaPedidos($cliente)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $cliente;
        $ret = $ob->listaPedidos();
        return response()->json($ret);
    }
    public function apiListaFacturas($cliente)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->cliente = $cliente;
        $ret = $ob->listaFacturas();
        return response()->json($ret);
    }
    public function apiEliminarPedido($id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->documento = $id;
        $ret = $ob->eliminarPedido();
        return response()->json($ret);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API pedidos////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API pedidos proveedor//////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function apiNuevoPedidoProveedor()
    {
        //$this->init();
        $received = Input::all();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ret = $ob->nuevoPedidoProveedor();
        return response()->json($ret);
    }
    public function apiRecuperarPedidoProveedor($proveedor, $documento)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        //$ret=DB::select("select * from fcfam001");
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->proveedor = $proveedor;
        $ob->documento = $documento;
        $ret = $ob->recuperarPedidoProveedor();
        return response()->json($ret);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API pedidos proveedor//////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API artículos//////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function apiFamilias()
    {
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ret = $ob->familias();
        return response()->json($ret);
    }
    public function apiStockGeneral($almacen)
    {
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->almacen = $almacen;
        $ret = $ob->stockGeneral();
        return response()->json($ret);
    }
    public function apiStockArticulo($id, $almacen = 0)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->articulo = $id;
        $ob->almacen = $almacen;
        $ret = $ob->stockArticulo();
        return response()->json($ret);
    }
    public function apiFichaArticulo($id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }
        if (Input::has('password')) {
            $pass = Input::get('password');
        }
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->articulo = $id;
        $ret = $ob->fichaArticulo();
        return response()->json($ret);
    }
    public function apiArticulos()
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }
        if (Input::has('password')) {
            $pass = Input::get('password');
        }
        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ret = $ob->articulos();
        return response()->json($ret);
    }
    public function apiEliminarArticulo($id)
    {
        //$this->init();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->articulo = $id;
        $ret = $ob->eliminarArticulo();
        return response()->json($ret);
    }
    public function apiNuevoArticulo()
    {
        //$this->init();
        $received = Input::all();
        //Log::info(print_r($received, true));
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->datos = $received;
        $ret = $ob->nuevoArticulo();
        return response()->json($ret);
    }
    public function apiActualizarArticulo($id)
    {
        //$this->init();
        $received = Input::all();
        $emp = "001";
        $pass = "";
        if (Input::has('empresa')) {
            $emp = Input::get('empresa');
        }

        if (Input::has('password')) {
            $pass = Input::get('password');
        }

        $ob = new Api();
        $ob->empresa = $emp;
        $ob->password = $pass;
        $ob->articulo = $id;
        $ob->datos = $received;
        $ret = $ob->actualizarArticulo();
        return response()->json($ret);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////API artículos//////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function obtStockReservado()
    {
        $arrArtics = DB::select("SELECT lcodar, SUM(lcanti) AS 'stockped'
                            FROM fcloc 
                            WHERE lliquid = 'N' AND lfecped >= '2019-1-1' AND lped <> 0  
                            GROUP BY lcodar");

        return $arrArtics;
    }
    
    function obt_artsCat($categoria = 0, $numArts = 0, $order = "rand()")
    {
        $arrReservados = $this -> obtStockReservado();
        $arrFinal = array();
        $arrArticulos = array();

        $strOrder = " order by a.ACODAR ";
        if ($numArts != "") { $strLimit = " limit $numArts "; }
        //if ($numArts != "") { $strLimit = " limit 8 "; }

        $arrArticulos = DB::select("SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ARESNUM3, a.APVPIVA2, a.AFAMILIA, a.ATIPO2
                FROM menus m, fcfcp f, fcart a, fcstk s
                WHERE m.parent = $categoria AND a.acodar = s.acodar AND s.aalm = 1 AND f.FGRUPO = m.gcod AND a.ARESNUM4 = f.fcod AND s.astock > 5 AND a.abloqueado = 'N' AND a.apvp1 > 0  AND a.aressn2 = 'N' 
                $strOrder $strLimit");

        foreach ($arrArticulos as $arrArticulo) 
        {
            if (count($arrFinal) < $numArts)
            {
                $encont = false; $i = 0; $reservados = 0;

                while ($i < count($arrReservados) && !$encont)
                { 
                    if ($arrArticulo->ACODAR == $arrReservados{$i}->lcodar)
                    {
                        $encont = true;
                        $reservados = $arrReservados{$i}->stockped;
                        $stockReal = $arrArticulo->ASTOCK - $reservados;
                        if ($stockReal < 0) { $stockReal = 0; }
                        $arrArticulo->ASTOCK = $stockReal;
                    }

                    $i++;
                }

                $arrArticulo->tipo = "resto";

                if ($arrArticulo->ASTOCK > 0) 
                { 
                    array_push($arrFinal, $arrArticulo);
                }     
            }
        }

        return $arrFinal;
    }

    function obtRepre($rcod)
    { 
        $arrRepres = DB::select("SELECT rcod, rnom, rmail, rtel, rext 
                                    FROM fcrep 
                                    WHERE rcod = $rcod");

        return $arrRepres;
    }

    function obtZonaCliente($ccodcl)
    {
        $arrCodRepresentantes = DB::select("SELECT czona, crepre, cforpa 
                                            FROM fccli 
                                            WHERE ccodcl = $ccodcl");

        return $arrCodRepresentantes;
    }

    function obtRepNielsenXweb($ccodcl)
    {
        $arrCodRepresentantes = DB::select("SELECT czona, crepre, cforpa 
                                            FROM fccli 
                                            WHERE ccodcl = $ccodcl");

        $czona = 14;
        $crepre = 109;
        $cforpa = 14;

        foreach ($arrCodRepresentantes as $arrCodRepresentante)
        {
            $czona = $arrCodRepresentante->czona;
            $crepre = $arrCodRepresentante->crepre;
            $cforpa = $arrCodRepresentante->cforpa;
        }

        $codRep = 1; $nomRepre = "Alfredo Pérez"; $emailRepre = "alfredo@diginova.es";

        switch ($czona) 
        {
            case 10: $codRep = 14; break;
            case 20: $codRep = 14; break;
            case 21: $codRep = 2; break;
            case 30: $codRep = 2; break;
            case 40: $codRep = 21; break;
            case 50: $codRep = 7; break;
            case 51: $codRep = 7; break;
            case 60: $codRep = 3; break;
            case 61: $codRep = 3; break;
            case 70: $codRep = 21; break;
            case 80: $codRep = 1; break;
            case 81: $codRep = 2; break;
            case 90: $codRep = 1; break;
            case 100: $codRep = 1; break;
        }

        if ( in_array($ccodcl, array(133, 1993, 60024, 624, 6554, 2526, 557, 6382, 2463, 392) ) )
        {
            $codRep = 2;
        }

        if ( in_array($ccodcl, array(1935, 6550, 3994, 7117, 3948, 2227, 913, 3549, 3090, 3703) ) )
        {
            $codRep = 7;
        }

        if ( in_array($ccodcl, array(460, 244, 3765, 850, 3166, 447, 3317, 935, 5907, 4059) ) )
        {
            $codRep = 3;
        }

        $arrRepresentantes = $this->obtRepre($codRep);

        return $arrRepresentantes;
    }

    function preguntasfrecuentes()
    {
        $this->init();

        $codCliente = session('usuario')->uData->codigo;
        /*DB::insert("INSERT INTO registros_clientes (cod_cliente, fecha_registro, url, aux1, aux2, aux3)
                    VALUES ($codCliente, NOW(), '".utf8_encode('FAQ')."', '', '', '')");*/

        /*$arrMensajesByTicket = DB::select("SELECT * FROM rma_mensaje AS rm
                WHERE rm.id IN (SELECT MAX(rm2.id) AS id 
                                FROM rma_mensaje AS rm2
                                GROUP BY rm2.ref_ticket)
                ORDER BY rm.id DESC;");*/
        $arrRMAPreguntas = DB::select("SELECT * FROM rma_pregunta where ocultar = 0");
        $arrTicketsCliente = DB::select("
            SELECT rt.id, rt.ref_ticket, rt.ref_articulo, rt.num_serie, rt.estado, rt.tipo_ticket, fca.ADESCR, rp.pregunta, cli.CNOMBREWEB, rt.ref_factura, rt.cod_cliente, rt.tipo_pregunta
            FROM rma_ticket AS rt, fcart AS fca, fcfac AS fcf, rma_pregunta AS rp, fccli AS cli
            WHERE rt.cod_cliente = $codCliente
            AND rt.ref_articulo = fca.ACODAR
            AND fcf.FDOC = rt.ref_factura
            AND rt.tipo_pregunta = rp.id_pregunta
            AND cli.CCODCL = rt.cod_cliente
            ORDER BY rt.estado ASC, rt.id DESC;");

        $arrTodosTickets = DB::select("
                SELECT rt.ref_ticket 
                FROM rma_ticket AS rt
                ORDER BY ref_ticket DESC
                LIMIT 1");

        $fechaActual = date("Y").'-'.date("m").'-'.date("d");
        $contMensajes = 0;

        /*foreach ($arrMensajesByTicket as $arrMensajeByTicket) 
        {
            $fecha1 = new DateTime($fechaActual);
            $fecha2 = new DateTime(substr($arrMensajeByTicket->fecha_mensaje, 0, 10));
            $diff = $fecha1->diff($fecha2);

            if ($diff->days >= 5)
            {
                DB::update("UPDATE rma_ticket SET estado = 1 WHERE ref_ticket = '$arrMensajeByTicket->ref_ticket'");
            }
        }*/

        if (Request::isMethod('post')) 
        {
            if ($codCliente > 0)
            {
                $diaActual = date("d");
                $mesActual = date("m");
                $anioActual = date("Y");
                $horaActual = date("H");
                $minutosActual = date("i");
                $segundosActual = date("s");

                $imagenSubida = false;

                foreach ($arrTicketsCliente as $arrTicketCliente)
                {
                    if (Request::has('EnviarMensaje_'.$arrTicketCliente->id)) 
                    {
                        $tipoTicket = Request::input('tipoTicket_'.$arrTicketCliente->id);
                        $ccodcl = Request::input('codCliente_'.$arrTicketCliente->id);
                        $refArticulo = Request::input('refArticulo_'.$arrTicketCliente->id);
                        $numSerie = Request::input('numSerie_'.$arrTicketCliente->id);
                        $refFactura = Request::input('codFactura_'.$arrTicketCliente->id);
                        $tipoPregunta = Request::input('tipoPregunta_'.$arrTicketCliente->id);
                        $numRMA = Request::input('numRMA_'.$arrTicketCliente->id);
                        $refTicket = Request::input('refTicket_'.$arrTicketCliente->id);

                        $mensaje = Request::input('text_mensaje_pedido_'.$arrTicketCliente->id);
                        $imgMensaje = '';

                        if ($mensaje != '')
                        {
                            $arrUltMensajes = DB::select("
                                SELECT rm.mensaje 
                                FROM rma_mensaje AS rm
                                WHERE rm.ref_ticket = '$refTicket'
                                ORDER BY rm.id DESC
                                LIMIT 1");

                            $mensajeRepetido = false;

                            foreach ($arrUltMensajes as $arrUltMensaje)
                            {
                                if ($arrUltMensaje->mensaje == $mensaje)
                                {
                                    $mensajeRepetido = true;
                                }
                            }

                            if (!$mensajeRepetido)
                            {
                                $image = Request::file('input_subir_foto_'.$arrTicketCliente->id);
                                $imgMensaje = '';

                                if (!empty($image))
                                {
                                    $validator = Validator::make(Request::all(), 
                                    ['input_subir_foto_'.$arrTicketCliente->id => 'required|mimes:png,jpg,jpeg,gif|max:2048']);

                                    if($validator->fails()) 
                                    {
                                        //echo 'Falla la subida de imagen';
                                    }
                                    else
                                    {
                                        $imgMensaje = 'img_'.$refTicket.'_'.$anioActual.'_'.$mesActual.'_'.$diaActual.'_'.$horaActual.'_'.$minutosActual.'_'.$segundosActual.'.png';
                                        $image->move('public/imgclientes', $imgMensaje);
                                    }
                                }

                                DB::insert("
                                    INSERT INTO rma_mensaje (ref_ticket, mensaje, remitente, img_mensaje, fecha_mensaje) 
                                    VALUES ('$refTicket', '$mensaje', 0, '$imgMensaje', NOW())");
                            }
                        }
                    }
                }
            }
        }

        $arrTickets = array();

        foreach ($arrTicketsCliente as $arrTicketCliente)
        {
            $arrTickets[] = array('id' => $arrTicketCliente->id, 'tipo_ticket' => $arrTicketCliente->tipo_ticket, 'estado' => $arrTicketCliente->estado, 'ref_ticket' => $arrTicketCliente->ref_ticket, 'acodarMinuscula' => strtolower($arrTicketCliente->ref_articulo), 'ADESCR' => $arrTicketCliente->ADESCR, 'pregunta' => $arrTicketCliente->pregunta, 'num_serie' => $arrTicketCliente->num_serie, 'ref_articulo' => $arrTicketCliente->ref_articulo, 'CNOMBREWEB' => $arrTicketCliente->CNOMBREWEB, 'ref_factura' => $arrTicketCliente->ref_factura, 'cod_cliente' => $arrTicketCliente->cod_cliente, 'tipo_pregunta' => $arrTicketCliente->tipo_pregunta);
        }

        $arrMensajesClientes = DB::select("
            SELECT rm.id, rm.ref_ticket, rm.mensaje, rm.remitente, rm.leido, rm.img_mensaje, rm.fecha_mensaje 
            FROM rma_mensaje AS rm, rma_ticket as rt
            WHERE rm.ref_ticket = rt.ref_ticket
            AND rt.cod_cliente = $codCliente
            ORDER BY rm.ref_ticket ASC, rm.id ASC;");

        $arrMensajes = array();

        foreach ($arrMensajesClientes as $arrMensajeCliente)
        {
            $contMensajes += 1;

            if ($contMensajes % 2 == 0)
            {
                $colorFondo = '#e1e1e1';
            }
            else
            {
                $colorFondo = '#ebebeb';
            }

            $arrMensajes[] = array('contMensajes' => $contMensajes, 'colorFondo' => $colorFondo, 'id' => $arrMensajeCliente->id, 'ref_ticket' => $arrMensajeCliente->ref_ticket, 'fecha_mensaje' => $arrMensajeCliente->fecha_mensaje, 'remitente' => $arrMensajeCliente->remitente, 'img_mensaje' => $arrMensajeCliente->img_mensaje, 'mensaje' => $arrMensajeCliente->mensaje);
        }

        $refArticulo = $this->generateRandomString(10);
        $numSerie = $this->generateRandomString(10);
        $arrMensajesByTicket = array(); // 1234
        return View('preguntasfrecuentes')->with("arrMensajesByTicket", $arrMensajesByTicket)
                                          ->with("arrRMAPreguntas", $arrRMAPreguntas)
                                          ->with("arrTickets", $arrTickets)
                                          ->with("arrMensajes", $arrMensajes)
                                          ->with("codCliente", $codCliente)
                                          ->with("refArticulo", $refArticulo)
                                          ->with("numSerie", $numSerie);
    }

    function cerrarConsulta()
    {
        $this->init();

        if (Request::isMethod('post'))
        {
            $refTicket = Request::input('refTicket');

            DB::update("
                UPDATE rma_ticket
                SET estado = 1
                WHERE ref_ticket = '$refTicket';");
        }
    }

    function activarCentro()
    {
        $this->init();
        
        if (Request::isMethod('post'))
        {
            $cliente = Request::input('cliente');
            $centro = Request::input('centro');
            $desactivar = Request::input('desactivar');

            DB::update("UPDATE fccen SET ZDESACT = '$desactivar' WHERE ZCLI = $cliente AND ZCEN = $centro");
        }
    }

    function familia($seccion)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;
        $categoriaa = 1127;

        $arrFavoritos = DB::select("SELECT fcodar FROM favoritos WHERE fcodcl = '$ccodcl'");

        $arrDatosFamilia = DB::select("SELECT m.parent, g.gcod, f.fdes 
                                        FROM menus m, fcgrf g, fcfcp f 
                                        WHERE f.FGRUPO = m.gcod 
                                        AND m.gcod = g.gcod 
                                        AND f.fcod = $seccion;");

        $gCod = 0;
        $fDes = '';
        $codCat = 0;
        $catDes = '';
        $catNombre = '';
        $critOrden = 1;
        
        $tarifa = 2;
        
        if ($ccodcl > 0)
        {
            $tarifa = session('usuario')->uData->ctari;
        }

        foreach ($arrDatosFamilia as $filaFamilia)
        {
            $gCod = $filaFamilia->gcod;
            $fDes = $filaFamilia->fdes;
            $codCat = $filaFamilia->parent; 
        }             

        $resCat = DB::select("SELECT id, descr 
                            FROM menus 
                            WHERE id = $codCat");

        foreach ($resCat as $categoria)
        {
            $catDes = $categoria->descr;
        }

        $marginTop = "0px";
        /*if ($codCat == 1125 || $codCat == 1126 || $codCat == 1118) 
        { 
            $marginTop = "290px"; 
        }*/

        $esConsumibles = false; 
        if ($codCat == 6) 
        { 
            $esConsumibles = true; 
        }

        $strStylesTit = ""; 
        $strStylesTit0 = "";
        $strStylesTit1 = ""; 
        $strStylesTit3 = "";  
        $strStyleCont = "";

        $limArtics = ""; 
        $mostrandoTodo = false;

        $arrOfertas = DB::select("
            SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
            FROM fcofe o, fcart a
            WHERE o.OCODAR = a.ACODAR 
            AND CURDATE() between o.OFECINI AND o.OFECFIN 
            AND a.ASTOCK > 0 
            AND a.ABLOQUEADO = 'N' 
            AND a.APVP1 > 0  
            AND a.ARESSN2 = 'N'
            ORDER BY rand()");

        $arrArticulos = $this->obtArticulos($seccion, 0, $limArtics, $critOrden);
        $numArticulosTotal = count($arrArticulos);

        foreach ($arrArticulos as $arrDatoArticulo)
        {
            $arrDatoArticulo->fil1 = 0;
            $arrDatoArticulo->fil2 = 0;
            $arrDatoArticulo->fil3 = 0;
            $arrDatoArticulo->fil4 = 0;
            $arrDatoArticulo->fil5 = 0;
            $arrDatoArticulo->fil6 = 0;
            $arrDatoArticulo->fil7 = 0;
            $arrDatoArticulo->fil8 = 0;
            $arrDatoArticulo->fil9 = 0;
            $arrDatoArticulo->fil10 = 0;
            $arrDatoArticulo->fil11 = 0;
            $arrDatoArticulo->fil12 = 0;

            $arrDatoArticulo->tieneTeclado = false;

            $this->mostrarFavorito($arrDatoArticulo, $arrFavoritos);
        }

        $strStylesTit = "";
        $catTexto = "";

        $esConsumibles = false;
        $nomFamiliaF = "";
        $nomFoto = "";

        if ($codCat == 1125) 
        { 
            $catNombre = "Ordenadores"; 

            $catTexto = "Los ordenadores de segunda mano son una excelente opción para adquirir equipos con mejores prestaciones y a un precio inmejorable. <br /><br />Diginova te ofrece Ordenadores de segunda mano de las mejores marcas, como son Acer, Asus, Dell, Fujitsu, HP y Lenovo.";
        }
        if ($codCat == 1126) 
        { 
            $catNombre = "Portátiles"; 

            $catTexto = "Los portátiles de segunda mano son una excelente opción para adquirir equipos con mejores prestaciones y a un precio inmejorable. Cuando hacemos mención a las palabras \"portátiles segunda mano\" podemos encontrarnos equipos en perfectas condiciones a pesar de haber tenido un uso profesional anterior. <br /><br />Diginova te ofrece Ordenadores de segunda mano de las mejores marcas, como son Acer, Asus, Dell, Fujitsu, HP y Lenovo.";
        }
        if ($codCat == 1118) 
        { 
            $catNombre = "Monitores"; 

            $catTexto = "En Diginova disponemos de un amplio catálogo de monitores de segunda mano de todas las pulgadas: 17\" | 18.5\" | 19\" | 20\" | 21.5\" | 22\" |  23\" |  24\" |  26\" |  27\" y marcas Dell, Dicota, Fujitsu, HP, Lenovo, LG, NEC, Philips, Samsung y ViewSonic. ";
        }

        switch ($codCat) 
        {
            case 1125: $strStylesTit = "padding-top: 15px;"; break;
            case 1127: $strStylesTit = "padding-top: 39px;"; break;
            case 4: $strStylesTit = "padding-top: 0px;"; break;
            case 1150: $strStylesTit = "margin-top: -6px;"; $strStylesTit1 = "width: 33%;"; break;
        }

        $strStylesTit = ""; $strStylesTit1 = ""; $strStyleCont = ""; $imgH = "auto";

        switch ($codCat) 
        {
            case 1127: $strStylesTit0 = "margin-top: 49px;"; $strStylesTit = "padding-top: 39px;"; break;
            case 4: $strStylesTit = "padding-top: 5px;"; $strStylesTit0 = "top: -97px;"; break;
            case 6: $strStylesTit = "padding-top: 5px;"; $strStylesTit0 = "top: -102px;"; break;
            case 1150: 
                $strStylesTit = "margin-top: -6px;"; 
                $strStylesTit1 = "width: 33%;"; 
                $strStyleCont = "min-height: 170px;"; 
                $strStylesTit0 = "top: -94px !important;"; $strstyles = "padding-top: 15px;"; $imgH = "100";
                break; 

            case 1126: $strStylesTit0 = "top: -100px;"; $strstyles = "padding-top: 15px;"; $imgH = "100"; break;
            case 1118: $strStylesTit0 = "top: -110px;"; $strStylesTit3 = "line-height: 16px;"; $imgH = "110"; break;
        }

        $urlCat = "/categoria/".$codCat;

        if ($seccion == '652653658654650660657651659')
        {
            $fDes = 'Cargadores de Portátiles';
        }

        if ($codCat == 6) 
        { 
            $esConsumibles = true;

            $nomFamiliaF = "Cartuchos";
            
            if ( $fDes[0] == 'T' ) 
            { 
                $nomFamiliaF = "Tóners"; 
            }

            $nomFoto = "consumiblesg".$gCod.".png";
        }

        $numArticulosMostrar = $numArticulosTotal;

        if ($numArticulosTotal > 12 && !$mostrandoTodo)
        {
            $numArticulosMostrar = 12;
        }

        foreach ($arrArticulos as $arrDatoArticulo)
        {
            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);

            $arrDatoArticulo->imag1 = $this -> obtImagenArt($arrDatoArticulo->ADESCR);
        }

        return View('familia')->with("ccodcl", $ccodcl)
                              ->with("marginTop", $marginTop)
                              ->with("catNombre", $catNombre)
                              ->with("strStylesTit", $strStylesTit)
                              ->with("strStylesTit0", $strStylesTit0)
                              ->with("strStylesTit1", $strStylesTit1)
                              ->with("strStylesTit3", $strStylesTit3)
                              ->with("catTexto", $catTexto)
                              ->with("catDes", $catDes)
                              ->with("codCat", $codCat)
                              ->with("categoria", $categoriaa)
                              ->with("urlCat", $urlCat)
                              ->with("fDes", $fDes)
                              ->with("imgH", $imgH)
                              ->with("esConsumibles", $esConsumibles)
                              ->with("nomFamiliaF", $nomFamiliaF)
                              ->with("nomFoto", $nomFoto)
                              ->with("numArticulosTotal", $numArticulosTotal)
                              ->with("arrArticulos", $arrArticulos)
                              ->with("arrRefRepetidas", $this->arrRefRepetidas)
                              ->with("arrRefOcultas", $this->arrRefOcultas)
                              ->with("critOrden", $critOrden)
                              ->with("tarifa", $tarifa)
                              ->with("mostrandoTodo", $mostrandoTodo)
                              ->with("numArticulosMostrar", $numArticulosMostrar)
                              ->with("esPortada", false)
                              ->with("fCod", $seccion);
    }

    function obtArticulos($familia = 0, $famVenta = 0, $numArts = '', $critOrden = 1)
    {
        $arrFinal = array();

        switch ($critOrden) 
        {
            case 1: $strOrder = " ORDER BY s.ASTOCK desc "; break;
            case 2: $strOrder = " ORDER BY a.APVP2 asc "; break;
            case 3: $strOrder = " ORDER BY a.APVP2 desc "; break;
            default: $strOrder = " ORDER BY s.ASTOCK desc "; break; 
        }

        $condicionStock = "and ((s.ASTOCK > 0 or a.ANOINVENT = 'S' ) OR (a.ACODAR = '570319443'))";
        $condicionFam = 'IN ('.$familia;

        /*for ($i = 0; $i < count($familia); $i++) 
        { 
            if ($i == 0)
            {
                $condicionFam .= $familia[$i];
            }
            else
            {
                $condicionFam .= ', '.$familia[$i];
            }
        }*/

        $condicionFam .= ')';

        $condicionFamVenta = "";

        if ($famVenta > 0)
        {
            $condicionFamVenta = "and a.AFAMILIA = ".$famVenta;
        }
        
        if ($numArts != '') 
        { 
            $strLimit = " limit $numArts "; 
        }
        else
        {
            $strLimit = '';
        }

        $arrArticulos = DB::select("SELECT a.ACODAR, a.ADESCR, s.ASTOCK, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, 
                                    a.ARESNUM6, a.ARESNUM3, a.APVPIVA2, a.ACARAC
                                    FROM fcart a, fcstk s
                                    WHERE a.ACODAR = s.ACODAR $condicionStock 
                                    AND a.ARESNUM4 $condicionFam $condicionFamVenta 
                                    AND a.ABLOQUEADO = 'N' 
                                    AND a.APVP1 > 0  
                                    AND a.ARESSN2 = 'N' 
                                    AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                                    AND s.AALM = 1
                                    AND a.ACODAR != '99050190U'
                                    AND a.AFAMILIA BETWEEN 100 AND 569 
                                    AND a.ARESNUM4 BETWEEN 1 AND 9999 
                                    AND a.ARESNUM4 <> 1450 
                                    $strOrder $strLimit ");

        $arrOfertas = DB::select("
            SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
            FROM fcofe o, fcart a
            WHERE o.OCODAR = a.ACODAR 
            AND CURDATE() between o.OFECINI AND o.OFECFIN 
            AND a.ASTOCK > 0 
            AND a.ABLOQUEADO = 'N' 
            AND a.APVP1 > 0  
            AND a.ARESSN2 = 'N'
            ORDER BY rand()");

        $ccodcl = session('usuario')->uData->codigo;

        foreach ($arrArticulos as $arrDatoArticulo)
        {
            $arrDatoArticulo->esOferta = $this->esOferta($arrDatoArticulo->ACODAR, $arrOfertas);

            if ($ccodcl > 0)
            {
                if (session('usuario')->uData->ctari == 1)
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
                elseif (session('usuario')->uData->ctari == 2)
                {
                    $precioArticulo = $arrDatoArticulo->APVP2;
                }
                elseif (session('usuario')->uData->ctari == 3)
                {
                    $precioArticulo = $arrDatoArticulo->APVP3;
                }
                elseif (session('usuario')->uData->ctari == 4)
                {
                    $precioArticulo = $arrDatoArticulo->APVP4;
                }
                elseif (session('usuario')->uData->ctari == 5)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM5;
                }
                elseif (session('usuario')->uData->ctari == 6)
                {
                    $precioArticulo = $arrDatoArticulo->ARESNUM6;
                }
                else
                {
                    $precioArticulo = $arrDatoArticulo->APVP1;
                }
            }
            else
            {
                $precioArticulo = $arrDatoArticulo->APVP1;
            }

            $this->obtArticulosConVariosGrados($arrDatoArticulo, $precioArticulo);
        }

        $arrPedidos = $this->obtPedidosActuales();

        if (count($arrArticulos) > 0 ) 
        {
            foreach ($arrArticulos as $row)
            {
                $stock = $row->ASTOCK;            

                if (count($arrPedidos) > 0 ) 
                {
                    foreach ($arrPedidos as $pedido) 
                    {
                        if ($pedido->LCODAR == $row->ACODAR)
                        {
                            $stock = $row->ASTOCK - $pedido->STOCKPED;
                        }
                    }
                }
                
                $row->astock = $stock;
                $row->tipo = 'resto';
                array_push($arrFinal, $row);
            }
        }

        return $arrFinal;
    }

    function obtPedidosActuales()
    {
        $arrPedidos = DB::select("SELECT LPED, LCODAR, sum(LCANTI) as 'STOCKPED'
                                FROM fcloc, fccoc 
                                WHERE lped = bped 
                                AND besped = 'S' 
                                AND bliquid = 'N' 
                                AND lliquid = 'N' 
                                AND lfecped >= '2019-1-1' 
                                AND lped <> 0
                                group by lcodar");

        return $arrPedidos;
    }


    function consultasArticulo($tipoTicket, $id)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $arrPreguntas = DB::select("SELECT * FROM rma_pregunta 
                                WHERE ocultar = 0");

        $arrTickets = DB::select("SELECT * FROM rma_ticket
                                ORDER BY id DESC");

        $tipoConsulta = '';
        $preguntaConsulta = '';
        $ticketEncontrado = '';

        $categoriasArticulos = array();

        $arrFacturasByUsuario = array();
        $arrProductosByUsuario = array();

        foreach ($arrPreguntas as $arrPregunta) 
        {
            if ($arrPregunta->id_pregunta == $id)
            {
                if ($arrPregunta->tipo_pregunta == 1)
                {
                    $tipoConsulta = 'Consulta técnica';
                }
                else if ($arrPregunta->tipo_pregunta == 2)
                {
                    $tipoConsulta = 'Consulta sobre mi envío';
                }
                else if ($arrPregunta->tipo_pregunta == 3)
                {
                    $tipoConsulta = 'Consulta sobre RMA';
                }
                else if ($arrPregunta->tipo_pregunta == 5)
                {
                    $tipoConsulta = 'Consulta administrativa';
                }
                else if ($arrPregunta->tipo_pregunta == 6)
                {
                    $tipoConsulta = 'Consulta sobre producto';
                }

                $preguntaConsulta = $arrPregunta->pregunta;
                break;
            }
        }

        if ($tipoTicket == 1)
        {
            $tiposArticulos = array();
            $arrFacturas = DB::select("
                SELECT fcf.FDOC, fcf.FTOTAL, fca.ADESCR, fca.ACODAR, fca.AFAMILIA, fcn.NCODAR, fcn.NFECHA, fcn.NNUMSER
                FROM fcfac AS fcf, fccba AS fcc, fcart AS fca, fcnsr AS fcn
                WHERE fcf.FDOC = fcc.BFACTURA
                AND fcn.NCODAR = fca.ACODAR
                AND fcn.NDOC = fcc.BALBA
                AND fcf.FCODCL = $ccodcl
                AND fcn.NTIPMOV = 'S'  
                AND fcn.NTIPDOC = 'A'
                AND fcf.FFECHA >= '2018-01-01'
                ORDER BY fcf.FFECHA DESC;");
        }
        if ($tipoTicket == 3)
        {
            $arrFacturas = DB::select("SELECT * FROM rma AS rm, rma_linea AS rl 
                                        WHERE rm.rcodcl = $ccodcl
                                        AND rm.numero = rl.rma
                                        GROUP BY rm.numero
                                        ORDER BY rm.fecha DESC");

            $arrProductos = DB::select("SELECT * FROM rma AS rm, rma_linea AS rl 
                                        WHERE rm.rcodcl = $ccodcl
                                        AND rm.numero = rl.rma
                                        ORDER BY rm.fecha DESC");
        }
        else
        {
            $tiposArticulos = array();
            $arrFacturas = DB::select("
                SELECT fcf.FDOC, fcf.FTOTAL, fca.ADESCR, fca.ACODAR, fca.AFAMILIA, fcn.NCODAR, fcn.NFECHA, fcn.NNUMSER, fcf.FTOTAL
                FROM fcfac AS fcf, fccba AS fcc, fcart AS fca, fcnsr AS fcn
                WHERE fcf.FDOC = fcc.BFACTURA
                AND fcn.NCODAR = fca.ACODAR
                AND fcn.NDOC = fcc.BALBA
                AND fcf.FCODCL = $ccodcl
                AND fcn.NTIPMOV = 'S'  
                AND fcn.NTIPDOC = 'A'
                AND fcf.FFECHA >= '2018-01-01'
                GROUP BY fcf.FDOC
                ORDER BY fcf.FFECHA DESC;");

            $arrProductos = DB::select("
                SELECT fcf.FDOC, fcf.FTOTAL, fca.ADESCR, fca.ACODAR, fca.AFAMILIA, fcn.NCODAR, fcn.NFECHA, fcn.NNUMSER, fcf.FTOTAL
                FROM fcfac AS fcf, fccba AS fcc, fcart AS fca, fcnsr AS fcn
                WHERE fcf.FDOC = fcc.BFACTURA
                AND fcn.NCODAR = fca.ACODAR
                AND fcn.NDOC = fcc.BALBA
                AND fcf.FCODCL = $ccodcl
                AND fcn.NTIPMOV = 'S'  
                AND fcn.NTIPDOC = 'A'
                AND fcf.FFECHA >= '2018-01-01'
                ORDER BY fcf.FFECHA DESC;");
        }

        $arrTickets = DB::select("
            SELECT ref_ticket, estado, num_serie FROM rma_ticket
            WHERE cod_cliente = $ccodcl
            ORDER BY id DESC;");

        if (count($arrFacturas) > 0)
        {
            foreach ($arrPreguntas as $arrPregunta)
            {
                if ($arrPregunta->id_pregunta == $id)
                {
                    $tiposArticulos = explode(",", $arrPregunta->tipo_articulos);
                }
            }

            for ($i = 0; $i < count($tiposArticulos); $i++) 
            {
                if ($tiposArticulos[$i] == '1')
                {
                    array_push($categoriasArticulos, 501, 502, 503, 504, 505, 563);
                }
                else if ($tiposArticulos[$i] == '2')
                {
                    array_push($categoriasArticulos, 521, 522, 523, 524, 525, 526, 527, 528, 529, 560);
                }
                else if ($tiposArticulos[$i] == '3')
                {
                    array_push($categoriasArticulos, 551, 552, 553, 554, 555, 556);
                }
                else if ($tiposArticulos[$i] == '4')
                {
                    array_push($categoriasArticulos, 541, 542, 543);
                }
                else if ($tiposArticulos[$i] == '5')
                {
                    array_push($categoriasArticulos, 506, 507, 508, 509, 510, 511, 512, 513, 514, 515, 516, 517, 518, 519, 520, 526, 527, 528, 529, 530, 531, 532, 533, 534, 535, 536, 537, 538, 539, 540, 544, 545, 546, 547, 548, 549, 550, 557, 558, 559, 561, 562, 563, 564, 565, 566, 567);
                }
            }
        }

        if ($tipoTicket == 1)
        {
            foreach ($arrFacturas as $arrFactura) 
            {
                for ($i = 0; $i < count($categoriasArticulos); $i++) 
                {
                    if ($categoriasArticulos[$i] == $arrFactura->AFAMILIA)
                    {
                        $refArticulo = strtolower($arrFactura->NCODAR);
                        $fechaFormato = date("d/m/Y", strtotime($arrFactura->NFECHA));
                        $nombreProducto = $arrFactura->ADESCR;

                        if (strlen($arrFactura->ADESCR) > 50)
                        {
                            $nombreProducto = substr($nombreProducto, 0, 50).'...'; 
                        }

                        $ticketEncontrado = '';

                        foreach ($arrTickets as $arrTicket) 
                        {
                            if ($arrTicket->estado == 0)
                            {
                                if ($arrTicket->num_serie == $arrFactura->NNUMSER)
                                {
                                    $ticketEncontrado = $arrTicket->ref_ticket;
                                }
                            }
                        }

                        $arrFacturasByUsuario[] = array('refArticulo' => $refArticulo, 'fechaFormato' => $fechaFormato, 'nombreProducto' => $nombreProducto, 'ACODAR' => $arrFactura->ACODAR, 'NNUMSER' => $arrFactura->NNUMSER, 'FDOC' => $arrFactura->FDOC, 'ticketEncontrado' => $ticketEncontrado);
                    }
                }
            }
        }
        else if ($tipoTicket == 2)
        {
            foreach ($arrFacturas as $arrFactura) 
            {
                $refArticulo = strtolower($arrFactura->NCODAR);
                $fechaFormato = date("d/m/Y", strtotime($arrFactura->NFECHA));
                $nombreProducto = 'Factura: '.$arrFactura->FDOC;

                $ticketEncontrado = '';

                foreach ($arrTickets as $arrTicket) 
                {
                    if ($arrTicket->estado == 0)
                    {
                        if ($arrTicket->num_serie == $arrFactura->NNUMSER)
                        {
                            $ticketEncontrado = $arrTicket->ref_ticket;
                        }
                    }
                }

                $arrFacturasByUsuario[] = array('refArticulo' => $refArticulo, 'fechaFormato' => $fechaFormato, 'nombreProducto' => $nombreProducto, 'importe' => $arrFactura->FTOTAL, 'ACODAR' => $arrFactura->ACODAR, 'NNUMSER' => $arrFactura->NNUMSER, 'FDOC' => $arrFactura->FDOC, 'ticketEncontrado' => $ticketEncontrado);

                foreach ($arrProductos as $arrProducto) 
                {
                    if ($arrProducto->FDOC == $arrFactura->FDOC)
                    {
                        if (strlen($arrProducto->ADESCR) > 50)
                        {
                            $nombreProducto = substr($arrProducto->ADESCR, 0, 50).'...';
                        }
                        else
                        {
                            $nombreProducto = $arrProducto->ADESCR;
                        }

                        $arrProductosByUsuario[] = array('FDOC' => $arrProducto->FDOC, 'nombreProducto' => $nombreProducto);
                    }
                }
            }
        }
        else if ($tipoTicket == 3)
        {
            foreach ($arrFacturas as $arrRMA) 
            {
                $rma = $arrRMA->numero;
                $fechaRMA = date("d/m/Y", strtotime($arrRMA->fecha));
                
                switch ($arrRMA->estado)
                {
                    case 0: $estadoRMA = 'Su devolución está en camino.';
                    break;

                    case 1: $estadoRMA = 'Gestionado.';
                    break;

                    case 2: $estadoRMA = 'Pendiente de gestionar.';
                    break;

                    case 3: $estadoRMA = 'Cancelado.';
                    break;

                    default: $estadoRMA = 'Su devolución está en camino.'; 
                }

                $ticketEncontrado = '';

                foreach ($arrTickets as $arrTicket) 
                {
                    if ($arrTicket->estado == 0)
                    {
                        if ($arrTicket->num_serie == $arrRMA->rnumser)
                        {
                            $ticketEncontrado = $arrTicket->ref_ticket;
                        }
                    }
                }

                $arrFacturasByUsuario[] = array('rma' => $rma, 'fechaRMA' => $fechaRMA, 'estadoRMA' => $estadoRMA, 'ticketEncontrado' => $ticketEncontrado, 'ACODAR' => $arrRMA->rcodar, 'NNUMSER' => $arrRMA->rnumser, 'FDOC' => $arrRMA->rfac);

            }

            foreach ($arrProductos as $arrRMALinea) 
            {
                if (strlen($arrRMALinea->rdescr) > 50)
                {
                    $nombreProducto = substr($arrRMALinea->rdescr, 0, 50).'...';
                }
                else
                {
                    $nombreProducto = $arrRMALinea->rdescr;
                }

                $arrProductosByUsuario[] = array('nombreProducto' => $nombreProducto, 'rma' => $arrRMALinea->rma);
            }
        }

        return View('consultasarticulo')->with("preguntaConsulta", $preguntaConsulta)
                                       ->with("tipoTicket", $tipoTicket)
                                       ->with("id", $id)
                                       ->with("arrFacturasByUsuario", $arrFacturasByUsuario)
                                       ->with("arrProductosByUsuario", $arrProductosByUsuario)
                                       ->with("ccodcl", $ccodcl);
    }

    function consultaArticulo($ccodcl, $acodar, $numSerie, /*$factura = '', */$tipoTicket, $idpregunta)
    {
        $this->init();

        $nomArticulo = '';
        $refArticulo = '';
        $refFactura = '';
        //$refFactura = $factura;
        $fechaCompra = '';
        $codCliente = 0;
        $contMensajes = 0;
        $estado = 0;
        $pregunta = '';
        $idPregunta = 0;
        $ticket = 0;
        $ccodcl = session('usuario')->uData->codigo;

        if ($ccodcl == 0)
        {
            Redirect::to('/');
        }

        $ticketEncontrado = false;

        $diaActual = date("d");
        $mesActual = date("m");
        $anioActual = date("Y");
        $horaActual = date("H");
        $minutosActual = date("i");
        $segundosActual = date("s");

        $arrPreguntas = DB::select("
            SELECT id_pregunta, pregunta, tipo_pregunta 
            FROM rma_pregunta WHERE ocultar = 0 
            AND id_pregunta = $idpregunta;");

        $arrTodosTickets = DB::select("
                SELECT rt.ref_ticket 
                FROM rma_ticket AS rt
                ORDER BY ref_ticket DESC
                LIMIT 1");

        $arrTickets = DB::select("
                SELECT rt.ref_ticket 
                FROM rma_ticket AS rt
                WHERE rt.cod_cliente = $ccodcl
                AND rt.ref_articulo = '$acodar'
                AND rt.num_serie = '$numSerie'");

        foreach ($arrTickets as $arrTicket)
        {
            $ticket = $arrTicket->ref_ticket;
        }

        $arrMensajes = array();
        $arrRMAMensajes = null;

        $arrClientes = DB::select("SELECT CNOMBREWEB, CMAILENVIO, CMAIL1 FROM fccli WHERE CCODCL = $ccodcl;");

        if ($tipoTicket == 5)
        {
            $ticketEncontrado = true;
        }

        foreach ($arrPreguntas as $arrPregunta)
        {
            $pregunta = $arrPregunta->pregunta;
            $idPregunta = $arrPregunta->id_pregunta;
        }

        // 1234
        if (Request::isMethod('post')) 
        {
            if ($ccodcl > 0)
            {
                $diaActual = date("d");
                $mesActual = date("m");
                $anioActual = date("Y");
                $horaActual = date("H");
                $minutosActual = date("i");
                $segundosActual = date("s");

                $imagenSubida = false;

                if (Request::has('EnviarMensaje')) 
                {
                    $tipoTicket = Request::input('tipoTicket');
                    $ccodcl = Request::input('codCliente');
                    $refArticulo = Request::input('refArticulo');
                    $numSerie = Request::input('numSerie');
                    $refFactura = Request::input('codFactura');
                    $tipoPregunta = Request::input('tipoPregunta');
                    $numRMA = Request::input('numRMA');

                    $mensaje = Request::input('text_mensaje_pedido');
                    $imgMensaje = '';
                    $mensajeRepetido = false;

                    if ($mensaje != '')
                    {
                        $mensaje = str_replace("'", '"', $mensaje);

                        $arrUltMensajes = DB::select("
                            SELECT rm.mensaje 
                            FROM rma_mensaje AS rm, rma_ticket AS rt
                            WHERE rm.ref_ticket = rt.ref_ticket
                            AND rt.cod_cliente = $ccodcl
                            ORDER BY rm.id DESC
                            LIMIT 1");

                        $mensajeRepetido = false;

                        foreach ($arrUltMensajes as $arrUltMensaje)
                        {
                            if ($arrUltMensaje->mensaje == $mensaje)
                            {
                                $mensajeRepetido = true;
                            }
                        }
                    }

                    if (Request::input('refTicket') == '0')
                    {
                        if (!$mensajeRepetido)
                        {
                            $refTicket = $anioActual * 10000000;

                            foreach ($arrTodosTickets as $arrTodoTicket)
                            {
                                $refTicket = $arrTodoTicket->ref_ticket + 1;
                                break;
                            }

                            DB::insert("
                                INSERT INTO rma_ticket (ref_ticket, tipo_ticket, tipo_pregunta, estado, cod_cliente, ref_articulo, num_serie, ref_factura, fecha_alta, fecha_mod) 
                                VALUES ('$refTicket', $tipoTicket, $tipoPregunta, 0, $ccodcl, '$refArticulo', '$numSerie', '$refFactura', NOW(), NOW())");
                        }
                    }
                    else
                    {
                        $refTicket = Request::input('refTicket');

                        DB::update("
                            UPDATE rma_ticket SET estado = 0 WHERE ref_ticket = '$refTicket'");
                    }

                    if ($mensaje != '')
                    {

                        if (!$mensajeRepetido)
                        {
                            $image = Request::file('input_subir_foto_admin');

                            if (!empty($image))
                            {
                                $validator = Validator::make(Request::all(), 
                                ['input_subir_foto_admin' => 'required|mimes:png,jpg,jpeg,gif|max:2048']);

                                if($validator->fails()) 
                                {
                                    echo 'Falla la subida de imagen';
                                }
                                else
                                {
                                    $imgMensaje = 'img_'.$refTicket.'_'.$anioActual.'_'.$mesActual.'_'.$diaActual.'_'.$horaActual.'_'.$minutosActual.'_'.$segundosActual.'.png';
                                    $image->move('public/imgclientes', $imgMensaje);
                                }
                            }

                            DB::insert("
                                INSERT INTO rma_mensaje (ref_ticket, mensaje, remitente, img_mensaje, fecha_mensaje) 
                                VALUES ('$refTicket', '$mensaje', 0, '$imgMensaje', NOW())");

                            $arrRMAMensajes = DB::select("SELECT * FROM rma_mensaje
                                        WHERE ref_ticket = '$refTicket'
                                        ORDER BY id ASC;");

                            // 1234
                            if ($tipoTicket == '5')
                            {
                                $this->consultaMail('programacion@diginova.es', $this->cadenaMail2(), 'Has recibido una nueva consulta administrativa');
                            }

                            $this->consultaMail('programacion@diginova.es', $this->cadenaMail1(), 'Su consulta ha sido recibida');
                        }
                    }
                }
            }
        }

        if (is_null($arrRMAMensajes))
        {
            $arrRMAMensajes = DB::select("SELECT * FROM rma_mensaje
                                        WHERE ref_ticket = '$ticket'
                                        ORDER BY id ASC;");
        }

        foreach ($arrRMAMensajes as $arrRMAMensaje) 
        {
            if ($arrRMAMensaje->remitente == 0)
            {
                foreach ($arrClientes as $arrCliente) 
                {
                    $usuario = $arrCliente->CNOMBREWEB;
                }
            }
            else
            {
                $usuario = "Técnico RMA";
            }

            if ($contMensajes % 2 == 0)
            {
                $colorFondo = '#e1e1e1';
            }
            else
            {
                $colorFondo = '#ebebeb';
            }

            $contMensajes += 1;
            $nombreFichero = 'public/imgclientes/'.$arrRMAMensaje->img_mensaje;

            $arrMensajes[] = array('contMensajes' => $contMensajes, 'fechaMensaje' => date("d/m/Y H:i", strtotime($arrRMAMensaje->fecha_mensaje)), 'usuario' => $usuario, 'nombreFichero' => $nombreFichero, 'imgMensaje' => $arrRMAMensaje->img_mensaje, 'mensaje' => $arrRMAMensaje->mensaje, 'colorFondo' => $colorFondo);
        }

        $arrTickets = DB::select("
            SELECT rt.ref_ticket 
            FROM rma_ticket AS rt
            WHERE rt.cod_cliente = $ccodcl
            AND rt.ref_articulo = '$acodar'
            AND rt.num_serie = '$numSerie'");

        foreach ($arrTickets as $arrTicket)
        {
            $ticket = $arrTicket->ref_ticket;
        }

        $arrRMATickets = DB::select("
                SELECT rt.ref_ticket, fca.ADESCR, rt.ref_articulo, rt.num_serie, rt.ref_factura, fcf.FFECHA, rt.cod_cliente, rt.estado
                FROM rma_ticket AS rt, fcart AS fca, fcfac AS fcf
                WHERE rt.ref_articulo = fca.ACODAR
                AND fcf.FDOC = rt.ref_factura
                AND rt.ref_ticket = $ticket
                AND rt.cod_cliente = $ccodcl
                ORDER BY rt.estado ASC, rt.id DESC;");

        $arrFacturas = DB::select("
                SELECT fcf.FDOC, fcf.FTOTAL, fca.ADESCR, fca.ACODAR, fca.AFAMILIA, fcn.NCODAR, fcn.NFECHA, fcn.NNUMSER
                FROM fcfac AS fcf, fccba AS fcc, fcart AS fca, fcnsr AS fcn
                WHERE fcf.FDOC = fcc.BFACTURA
                AND fcn.NCODAR = fca.ACODAR
                AND fcn.NDOC = fcc.BALBA
                AND fcf.FCODCL = $ccodcl
                AND fcn.NTIPMOV = 'S' 
                AND fcn.NTIPDOC = 'A'
                AND fcf.FFECHA >= '2018-01-01'
                ORDER BY fcf.FFECHA DESC;");

        if ($ticket != '0')
        {
            foreach ($arrRMATickets as $arrRMATicket)
            {
                $ticketEncontrado = true;

                $nomArticulo = $arrRMATicket->ADESCR;
                $refArticulo = $arrRMATicket->ref_articulo;
                $refFactura = $arrRMATicket->ref_factura;
                $fechaCompra = $arrRMATicket->FFECHA;
                $codCliente = $arrRMATicket->cod_cliente;
                $estado = $arrRMATicket->estado;
            }
        }
        else
        {
            foreach ($arrFacturas as $arrFactura)
            {
                $nomArticulo = $arrFactura->ADESCR;
                $refArticulo = $acodar;
                $refFactura = $arrFactura->FDOC;
                $fechaCompra = $arrFactura->NFECHA;
            }
        }

        return View('consultaarticulo')->with("codCliente", $ccodcl)
                                       ->with("referencia", $acodar)
                                       ->with("numSerie", $numSerie)
                                       ->with("tipoTicket", $tipoTicket)
                                       ->with("estado", $estado)
                                       ->with("ticket", $ticket)
                                       ->with("nomArticulo", $nomArticulo)
                                       ->with("refArticulo", strtolower($acodar))
                                       ->with("fechaCompra", date("d/m/Y", strtotime($fechaCompra)))
                                       ->with("refFactura", $refFactura)
                                       ->with("ticketEncontrado", $ticketEncontrado)
                                       ->with("arrMensajes", $arrMensajes)
                                       ->with("pregunta", $pregunta)
                                       ->with("idPregunta", $idPregunta);
    }


    function cadenaMail1()
    {
        $cadena = '';
        $cadena .= '<TABLE  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TABLE  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TR>';
        $cadena .= '<TD  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " width=750>';
        $cadena .= '<TABLE cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750>';
        $cadena .= '<TABLE cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750>';
        $cadena .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" width=750 colSpan=3>';
        $cadena .= '<A href="https://diginova.es/" target=_blank>';
        $cadena .= '<IMG style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; DISPLAY: block; BORDER-RIGHT-COLOR: " border=0 alt=DIGINOVA src="https://diginova.es/testmail2/img/diginovaemail.png" width=750 height=86 style="display: flex;">';
        $cadena .= '</A>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= ' </TD>';
        $cadena .= '</TR>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '<TR BACKGROUND-COLOR: style="BACKGROUND-COLOR: #333333" bgColor=#333333>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: #333333" bgColor=#333333 width=750>';
        $cadena .= '<TABLE cellSpacing=0 cellPadding=0 border=0 style="margin-bottom: -10px">';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: #333333" bgColor=#333333>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= '<table style="width: 750px; margin-top: -10px;" cellSpacing="0" cellPadding="0" border="0">';
        $cadena .= '<tr>';
        $cadena .= '<td colspan="8" width="750" style=" width: 100%;">';
        $cadena .= '<p style="font-family: Arial; color: #000; font-size: small; margin-left: 30px; margin-top: 30px;">';
        $cadena .= '<b>Estimado cliente.</b>';
        $cadena .= '</p>';
        $cadena .= '<p style="font-family: Arial; color: #000; font-size: small; margin-left: 30px; margin-top: 10px;">';
        $cadena .= 'Hemos recibido tu comentario y nuestro equipo de atención al cliente lo atenderá y te dará una respuesta a la mayor brevedad posible.';
        $cadena .= '</p>';
        $cadena .= '<p style="font-family: Arial; color: #000; font-size: small; margin-left: 30px; margin-top: 10px; margin-bottom: 30px">';
        $cadena .= 'Te deseamos un feliz día y gracias por elegirnos.';
        $cadena .= '</p>';
        $cadena .= '</td>';
        $cadena .= '</tr>';
        $cadena .= '</table>';
        $cadena .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" width=700>';
        $cadena .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR style="BACKGROUND-COLOR: white">';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; COLOR: black; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750 colSpan=4>';
        $cadena .= '<A style="BORDER-TOP: 0px; BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; BORDER-LEFT: 0px" href="https://diginova.es/">';
        $cadena .= '<IMG style="DISPLAY: block" border=0 alt=pedidos@diginova.es src="http://diginova.es/testmail2/img/diginovafootermail.jpg" width=750 height=143>';
        $cadena .= '</A>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="FONT-SIZE: 10px; BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; COLOR: gray; BORDER-BOTTOM-COLOR: ; TEXT-ALIGN: justify; BORDER-RIGHT-COLOR: " width=700 colSpan=8 style="font-size: 7pt; color:#000; padding-top: 5px;">';
        $cadena .= 'Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener informaci&oacute;n confidencial sometida a secreto profesional. Si usted no es el destinatario final por favor elim&iacute;nelo e inf&oacute;rmenos por esta v&iacute;a. En cumplimiento de la Ley de Servicios de la Sociedad de la Informaci&oacute;n y de Comercio Electr&oacute;nico (LSSICE) y de la Ley Org&aacute;nica 15/1999 de Protecci&oacute;n de Datos de Car&aacute;cter Personal (LOPD), por los cuales se regulan las medidas de seguridad de los ficheros automatizados, le comunicamos que su direcci&oacute;n de correo electr&oacute;nico forma parte de la base de datos de Smarters Accesorios S.L. fichero que ha sido previamente registrado en la Agencia de Protecci&oacute;n de Datos y cuya finalidad es informarle de las novedades, noticias y promociones de Diginova. Es voluntad de Smarters Accesorios S.L evitar el env&iacute;o deliberado de correo no solicitado, por lo cual si no desea recibir m&aacute;s comunicaciones comerciales por nuestra parte, le rogamos nos lo indique a trav&eacute;s de este enlace: <A style="TEXT-DECORATION: none; COLOR: black" href="[unsubscribe_url_direct]">Cancelar Suscripci&oacute;n</A>. Tambi&eacute;n tiene vd. a su disposici&oacute;n los derechos de acceso, rectificaci&oacute;n y cancelaci&oacute;n que le otorga la legislaci&oacute;n correspondiente en esta materia. ';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';

        return $cadena;
    } 

    function cadenaMail2()
    {
        $cadena2 = '';
        $cadena2 .= '<TABLE  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TABLE  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " width=750>';
        $cadena2 .= '<TABLE cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TBODY>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750>';
        $cadena2 .= '<TABLE cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TBODY>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750>';
        $cadena2 .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TBODY>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" width=750 colSpan=3>';
        $cadena2 .= '<A href="https://diginova.es/" target=_blank>';
        $cadena2 .= '<IMG style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; DISPLAY: block; BORDER-RIGHT-COLOR: " border=0 alt=DIGINOVA src="https://diginova.es/testmail2/img/diginovaemail.png" width=750 height=86 style="display: flex;">';
        $cadena2 .= '</A>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TBODY>';
        $cadena2 .= '</TABLE>';
        $cadena2 .= ' </TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TABLE>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '<TR BACKGROUND-COLOR: style="BACKGROUND-COLOR: #333333" bgColor=#333333>';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: #333333" bgColor=#333333 width=750>';
        $cadena2 .= '<TABLE cellSpacing=0 cellPadding=0 border=0 style="margin-bottom: -10px">';
        $cadena2 .= '<TBODY>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: #333333" bgColor=#333333>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TBODY>';
        $cadena2 .= '</TABLE>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TBODY>';
        $cadena2 .= '</TABLE>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TBODY>';
        $cadena2 .= '</TABLE>';
        $cadena2 .= '<table style="width: 750px; margin-top: -10px;" cellSpacing="0" cellPadding="0" border="0">';
        $cadena2 .= '<tr>';
        $cadena2 .= '<td colspan="8" width="750" style=" width: 100%;">';
        $cadena2 .= '<p style="font-family: Arial; color: #000; font-size: small; margin-left: 30px; margin-top: 30px;">';
        $cadena2 .= '<b>Dpto. Contabilidad</b>';
        $cadena2 .= '</p>';
        $cadena2 .= '<p style="font-family: Arial; color: #000; font-size: small; margin-left: 30px; margin-top: 10px;">';
        $cadena2 .= 'Has recibido una nueva consulta administrativa. Puedes consultarla en el siguiente <a href="http://192.168.1.9//contabilidad/tickets.php">enlace</a>.';
        $cadena2 .= '</p>';
        $cadena2 .= '</td>';
        $cadena2 .= '</tr>';
        $cadena2 .= '</table>';
        $cadena2 .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TBODY>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" width=700>';
        $cadena2 .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena2 .= '<TBODY>';
        $cadena2 .= '<TR style="BACKGROUND-COLOR: white">';
        $cadena2 .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; COLOR: black; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750 colSpan=4>';
        $cadena2 .= '<A style="BORDER-TOP: 0px; BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; BORDER-LEFT: 0px" href="https://diginova.es/">';
        $cadena2 .= '<IMG style="DISPLAY: block" border=0 alt=pedidos@diginova.es src="http://diginova.es/testmail2/img/diginovafootermail.jpg" width=750 height=143>';
        $cadena2 .= '</A>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TBODY>';
        $cadena2 .= '</TABLE>';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '<TR>';
        $cadena2 .= '<TD style="FONT-SIZE: 10px; BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; COLOR: gray; BORDER-BOTTOM-COLOR: ; TEXT-ALIGN: justify; BORDER-RIGHT-COLOR: " width=700 colSpan=8 style="font-size: 7pt; color:#000; padding-top: 5px;">';
        $cadena2 .= 'Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener informaci&oacute;n confidencial sometida a secreto profesional. Si usted no es el destinatario final por favor elim&iacute;nelo e inf&oacute;rmenos por esta v&iacute;a. En cumplimiento de la Ley de Servicios de la Sociedad de la Informaci&oacute;n y de Comercio Electr&oacute;nico (LSSICE) y de la Ley Org&aacute;nica 15/1999 de Protecci&oacute;n de Datos de Car&aacute;cter Personal (LOPD), por los cuales se regulan las medidas de seguridad de los ficheros automatizados, le comunicamos que su direcci&oacute;n de correo electr&oacute;nico forma parte de la base de datos de Smarters Accesorios S.L. fichero que ha sido previamente registrado en la Agencia de Protecci&oacute;n de Datos y cuya finalidad es informarle de las novedades, noticias y promociones de Diginova. Es voluntad de Smarters Accesorios S.L evitar el env&iacute;o deliberado de correo no solicitado, por lo cual si no desea recibir m&aacute;s comunicaciones comerciales por nuestra parte, le rogamos nos lo indique a trav&eacute;s de este enlace: <A style="TEXT-DECORATION: none; COLOR: black" href="[unsubscribe_url_direct]">Cancelar Suscripci&oacute;n</A>. Tambi&eacute;n tiene vd. a su disposici&oacute;n los derechos de acceso, rectificaci&oacute;n y cancelaci&oacute;n que le otorga la legislaci&oacute;n correspondiente en esta materia. ';
        $cadena2 .= '</TD>';
        $cadena2 .= '</TR>';
        $cadena2 .= '</TBODY>';
        $cadena2 .= '</TABLE>';

        return $cadena2;
    }



    function devoluciones() 
    {
        $this->init();
 
        $ccodcl = session('usuario')->uData->codigo;
        $arrDevoluciones = array();
        $arrDevolucionesResueltas = array();
        $arrAlbaranesRMA = array();
        $arrAutorizaciones = array();
        $arrRecogidas = array();

        if ($ccodcl > 0)
        {
            $arrDevoluciones = DB::select("SELECT * FROM rma where rcodcl = $ccodcl and estado not in (1, 3) ORDER BY fecha desc");
            $arrDevolucionesResueltas = DB::select("SELECT * FROM rma_gestion_resultado WHERE gcodcl = $ccodcl ORDER BY gfecha DESC");
            $arrAlbaranesRMA = DB::select("SELECT balba, bpedid FROM fccba WHERE bcodcl = $ccodcl AND (balba LIKE '3%' OR balba LIKE '26%') AND bpedid <> ''");

            $arrAutorizaciones = DB::select("SELECT * FROM rma_autorizacion_solicitud");
            $arrRecogidas = DB::select("SELECT * FROM rma_recogida");

            // Formatear fechas y documentos
                foreach ($arrDevoluciones as $fila) 
                {
                    $fila -> numeroF = $this -> documentoFormatear($fila -> numero);
                    $fila -> fechaF = $this -> formatearDateTime2Fecha($fila -> fecha);
                    $fila -> horaF = "";
                    $fila -> horaF = $this -> formatearDateTime2Hora($fila -> fecha);
                }

                foreach ($arrDevolucionesResueltas as $fila) 
                {
                    $fila -> numeroF = $this -> documentoFormatear($fila -> grma);
                }
        }


        return View('devoluciones')->with("ccodcl", $ccodcl)
                                   ->with("arrDevoluciones", $arrDevoluciones)
                                   ->with("arrDevolucionesResueltas", $arrDevolucionesResueltas)
                                   ->with("arrAlbaranesRMA", $arrAlbaranesRMA)
                                   ->with("arrAutorizaciones", $arrAutorizaciones)
                                   ->with("arrRecogidas", $arrRecogidas);
    }

    function devolucionRMA() 
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $recogidaPrecio = 5.90;
        $recogidaPrecioF = "5,90";
        $adicional = -2;

        $soloAccesorios = true;

        $disabled = " ";

        $arrLineasTemporal = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl AND rautorizado = 1 ORDER BY rfecha asc");

        if (count($arrLineasTemporal) > 0)
        {
            // Ordenar: Primero los artículos de ocasión
            $arrTemp1 = array();
            $arrTemp2 = array();

            foreach ($arrLineasTemporal as $artLinea) 
            {
                if ($this->es_ocasion($artLinea->rcodar))
                {
                    array_push($arrTemp1, $artLinea);
                    $adicional += 2;
                }
                else
                {
                    array_push($arrTemp2, $artLinea);
                }
            }

            $recogidaPrecio += $adicional;
            $recogidaPrecio *= 1.21;

            if ($recogidaPrecio < 7.14) { $recogidaPrecio = 7.14; }

            $recogidaPrecioF = number_format($recogidaPrecio, 2, ",", ".");

            $arrLineasTemporal = array();
            $arrLineasTemporal = array_merge($arrTemp1, $arrTemp2);

            // Comprobar si solo hay accesorios. (No podrán seleccionar recogida por Diginova)
            $soloAccesorios = true;
            foreach ($arrLineasTemporal as $artLinea) 
            {
                if ($artLinea->rcategoria != 0) { $soloAccesorios = false; }
            }
        }

        if ($ccodcl == 3550) { $disabled = " "; }
        if ($ccodcl == 8874) { $disabled = " disabled "; }

        // Si solo hay accesorios, no debe poder seleccionar recogida
        if ($soloAccesorios) { $disabled = " disabled "; }


        $arrArtsDevolucion = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");

        if ( count($arrArtsDevolucion) > 0)
        {
            foreach ($arrArtsDevolucion as $artDev) 
            {
                $acodarAux = strtolower( str_replace("/", "barder", $artDev->rcodar) );
                $artDev->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

                if ($artDev->rautorizado == 1)
                {
                    $hayAutorizado = true;
                }

                if ($artDev->rautorizado == 0)
                {
                    $hayNoAutorizado = true;
                }
            }
        }


        return View('devolucion_rma')->with("ccodcl", $ccodcl)
                               ->with("recogidaPrecio", $recogidaPrecio)
                               ->with("recogidaPrecioF", $recogidaPrecioF)
                               ->with("soloAccesorios", $soloAccesorios)
                               ->with("arrArtsDevolucion", $arrArtsDevolucion)
                               ->with("disabled", $disabled);
    }

    function es_ocasion($acodar)
    {
        $arrArticulos = DB::select("SELECT 1 from fcart where acodar = '$acodar' and afamilia between 500 and 599 and afamilia not in (561)");

        if (count($arrArticulos) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function guardarRMA()
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;
        $recogida = 0;
        $nomPDF = "";
        $nomPDF2 = "";
        $solopieza = "";
        $numRMA = "";
        $soloRMA = false;
        $hayDOA = false;
        $soloHayPieza = true;
        $anio = Date("Y");

        if (Request::isMethod('post')) 
        {
            if (Request::has('enviarrma'))
            {
                $arrLineasTemporal = DB::select("SELECT * FROM rmatemp WHERE rcodcl = $ccodcl ORDER BY rfecha ASC");

                if (count($arrLineasTemporal) > 0)
                {
                    // Ordenar: Primero los artículos de ocasión
                    $arrTemp1 = array();
                    $arrTemp2 = array();

                    foreach ($arrLineasTemporal as $artLinea) 
                    {
                        if ($this->es_ocasion($artLinea->rcodar))
                        {
                            array_push($arrTemp1, $artLinea);
                        }
                        else
                        {
                            array_push($arrTemp2, $artLinea);
                        }
                    }

                    $arrLineasTemporal = array();
                    $arrLineasTemporal = array_merge($arrTemp1, $arrTemp2);

                    $soloRMA = true;

                    foreach ($arrLineasTemporal as $temporal) 
                    {
                        if ($temporal->rtipo != "RMA")
                        {
                            $soloRMA = false;
                        }
                    }

                    if (true)
                    {
                        $portes_cliente = 1; 
                        $recogida = 0; 
                        $portes_precio = 0; 

                        // RMA
                        if (Request::has('tipoenvio'))
                        {
                            if (Request::input('tipoenvio') == 'agencia')
                            {
                                $recogida = 0;  
                            }

                            if (Request::input('tipoenvio') == 'recogida')
                            {
                                $recogida = 1; 
                                $portes_precio = Request::input('portes_precio'); 
                            }

                            if (Request::input('tipoenvio') == 'almacen')
                            {
                                $recogida = 2; 
                            }
                        }
                        else  // DOA
                        {
                            $portes_cliente = 0;
                            $recogida = 1; 
                        }

                        if (Request::has('solopieza'))
                        {
                            $recogida = 0;
                            $solopieza = Request::input('solopieza');
                        }

                        $numRMA = $this->rmaCrear($ccodcl, $portes_cliente, $recogida, $portes_precio);

                        $arrAveriasNom = DB::select("SELECT * FROM rma_averia");

                        if ( count($arrLineasTemporal) > 0 )
                        {
                            $soloRMA = true;
                            $hayDOA = false;
                            $soloHayPieza = true;
                        }

                        // Guardamos las líneas temporales
                        foreach ($arrLineasTemporal as $temporal) 
                        {
                            if ($temporal->rtipo != "RMA" && $temporal->rtipo != "DOA")
                            {
                                $soloRMA = false;
                            }
                            if ($temporal->rtipo == "DOA")
                            {
                                $hayDOA = true;
                            }
                            if ($temporal->rsolopieza == 0)
                            {
                                $soloHayPieza = false;
                            }



                            DB::insert("INSERT INTO rma_linea (rma, rcodcl, restado, rcodar, rdescr, rnumser, rfac, raveria, robservaciones, rcategoria, rfecha, rtipo, runidades, rsolopieza, rreparar, renviopedido, rfoto, rfechamod, rstand) 
                                VALUES ($numRMA, $ccodcl, 0, '$temporal->rcodar', '$temporal->rdescr', '$temporal->rnumser', '$temporal->rfac','$temporal->raveria', '$temporal->robservaciones', $temporal->rcategoria, SYSDATE(), '$temporal->rtipo', $temporal->runidades, $temporal->rsolopieza, $temporal->rreparar, $temporal->renviopedido, '$temporal->rfoto', '0000-00-00 00:00:00', '') ");

                            // Si selecciona solo pieza, crear un nuevo ticket, ticket sobre ese producto en el texto que aparezca el nº de parte.
                            if ($temporal->rsolopieza == 1 )
                            {
                                $arrTickets = DB::select("SELECT ref_ticket FROM rma_ticket WHERE ref_ticket BETWEEN ".$anio."0000000 AND ".$anio."9999999 ORDER BY ref_ticket DESC LIMIT 1");
                                $refTicket = '';

                                if (count($arrTickets) > 0)
                                {
                                    foreach ($arrTickets as $arrTicket)
                                    {
                                        $refTicket = $arrTicket->ref_ticket;
                                    }
                                }
                                else
                                {
                                    $refTicket = $anio."0000000";
                                }

                                $tipoTicket = 1; // Ticket de tipo Consulta técnica
                                $tipoPregunta = 28; // "Otra consulta técnica" 
                                DB::insert("INSERT INTO rma_ticket (ref_ticket, tipo_ticket, tipo_pregunta, estado, cod_cliente, ref_articulo, num_serie, ref_factura, fecha_alta, fecha_mod) 
                                            VALUES ('$refTicket', $tipoTicket, $tipoPregunta, 0, $ccodcl, '$temporal->rcodar', '$temporal->rnumser', '$temporal->rfac', NOW(), NOW())");

                                $averiaNombre = "";
                                $averiaId = $temporal->raveria;

                                if ($averiaId != 0)
                                {
                                    $averiaEnc = false; $i = 0;
                                    foreach ($arrAveriasNom as $arrAveriaNom)
                                    {
                                        if ($averiaId == $arrAveriaNom->id)
                                        {
                                            $averiaEnc = true;
                                            $averiaNombre = $arrAveriaNom->nombre;
                                        }
                                    }
                                }

                                $ticketMensaje = "RMA: $numRMA (Solo pieza: $averiaNombre) ".$temporal->robservaciones;
                                $img_mensaje = "";
                                DB::insert("INSERT INTO rma_mensaje (ref_ticket, mensaje, remitente, img_mensaje, fecha_mensaje) VALUES ('$refTicket', '$ticketMensaje', 0, '$img_mensaje', NOW())");
                            }
                        }

                        // Eliminar líneas temporales   1234
                        DB::delete("DELETE FROM rmatemp WHERE rcodcl = $ccodcl AND rautorizado = 1");

                        $resLineas = DB::select("
                                SELECT r.*, a.nombre as 'averia_nombre' 
                                FROM rma_linea r, rma_averia a 
                                WHERE r.raveria = a.id AND rma = $numRMA");

                        $arrClientes = DB::select("SELECT CNOM, CDOM, CCODPO, CPOB, CPAIS, CDNI, CRESCAR3, CTEL1, CTEL2, CTEL3, CMAIL1, CMAIL2, CMAIL3, CNOMBREWEB FROM fccli WHERE ccodcl = $ccodcl");

                        foreach ($arrClientes as $arrCliente)
                        {
                            $nomcli = $arrCliente->CNOM;
                            $usuario = $arrCliente->CNOMBREWEB;
                            $domicilio = $arrCliente->CDOM;
                            $codpostal = $arrCliente->CCODPO;
                            $poblacion = $arrCliente->CPOB;
                            $provincia = $arrCliente->CPAIS;
                            $dnicli = $arrCliente->CDNI;

                            $fecha = date("Y-m-d");

                            // Crear los PDFs
                            require_once base_path().'/fpdf/fpdf.php';
                            require_once base_path().'/fpdf/fpdfParte.php';

                            // Creaci&oacute;n del objeto de la clase heredada
                            $pdf = new PDF_Code128Parte();
                            $pdf->AliasNbPages();
                            $pdf->AddPage();
                            $pdf->SetFont('Arial', '', 12);
                            $pdf->DatosCabecera($ccodcl, $nomcli, $domicilio, $codpostal, $poblacion, $dnicli, $fecha, $numRMA);
                            $pdf->EscribirSintomas($resLineas);

                            $pdf->Condiciones();
                            $nomPDF = "pdf_".$numRMA.".pdf";
                            $pdf->Output(base_path()."/resources/pdfrma/".$nomPDF);

                            /*if ($numArtOcasion > 0 && $numArtNormal > 0)
                            {
                                // Crear pdf del segundo parte si procede
                                $pdf_2 = new PDF_Code128Parte();
                                $pdf_2->AliasNbPages();
                                $pdf_2->AddPage();
                                $pdf_2->SetFont('Arial','',12);                     
                                $pdf_2->DatosCabecera($ccodcl, $nomcli, $domicilio, $codpostal, $poblacion, $dnicli, $fecha, $numRMA2);
                                $pdf_2->EscribirSintomas($resLineas2);

                                $pdf_2->Condiciones();
                                $nomPDF_2 = "pdf_".$numRMA2.".pdf";
                                $pdf_2->Output("pdfrma/".$nomPDF_2);
                            }*/

                            require_once base_path().'/fpdf/fpdfEnvio.php';

                            $pdf2 = new PDF_Code128();
                            $pdf2->AliasNbPages();
                            $pdf2->AddPage(); 
                            $pdf2->Etiqueta($ccodcl, $nomcli, $domicilio, $codpostal, $poblacion, $dnicli, $numRMA, "");
                            $nomPDF2 = "pdf_".$numRMA."_envio.pdf";
                            $pdf2->Output(base_path()."/resources/pdfrma/".$nomPDF2);

                            $emailCuerpo = "El cliente ".$ccodcl." ha realizado una solicitud de RMA:<br /><br />";
                            $emailCuerpo .= "<a href='".$this->urlDiginova."/resources/pdfrma/$nomPDF'>Solicitud $numRMA</a>";  


                            if ( $emailCuerpo != "" )
                            {
                                $emailRepre = 'javimoya33@gmail.com';
                                $this->devolucionMail($ccodcl, $emailRepre, $emailCuerpo);
                            }
                        }
                    }
                }
            }

            if ($recogida == 1)
            {
                // Crear registro de recogida MRW y reenviar al formulario // 1234
                $rclave = $this->generateRandomString(15);

                DB::insert("INSERT INTO rma_recogida (id, fecha_creacion, rcodcl, rma, rclave, restado, fecha_solicitud, rcodigoenv, rurl, bultos, nombre, contacto, telefono, calle, numero, resto, cp, localidad, fecha_mod) 
                    VALUES (null, SYSDATE(), $ccodcl, '$numRMA', '$rclave', 0, '0000-00-00 00:00:00', '', '', 0, '', '', '', '', '', '', '', '', '0000-00-00 00:00:00')");
                DB::update("UPDATE rma SET estado = 6 WHERE numero = $numRMA");

                if ($rclave != "")
                {
                    ?>

                    <script type="text/javascript">
                        // 1234 recogida2
                        window.location = "/recogida/<?php echo $rclave; ?>/1";
                    </script>

                    <?php
                }
            }
        }

        $arrArtsDevolucion = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");

        if ( count($arrArtsDevolucion) > 0)
        {
            foreach ($arrArtsDevolucion as $artDev) 
            {
                $acodarAux = strtolower( str_replace("/", "barder", $artDev->rcodar) );
                $artDev->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";
            }
        }

        return View('devolucion_guardar')->with("ccodcl", $ccodcl)
                                         ->with("recogida", $recogida)
                                         ->with("nomPDF", $nomPDF)
                                         ->with("nomPDF2", $nomPDF2)
                                         ->with("solopieza", $solopieza)
                                         ->with("numRMA", $numRMA)
                                         ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                         ->with("soloRMA", $soloRMA)
                                         ->with("soloHayPieza", $soloHayPieza)
                                         ->with("hayDOA", $hayDOA);
    }

    function anadirSolicitud()
    {
        if (Request::isMethod('post')) 
        {
            if (Request::has('solicitudadd'))
            {
                $enc = false;
                $i = 0;
                $ccodcl = session('usuario')->uData->codigo;

                $arrArtsDevolucion = DB::select("
                    SELECT temp.*, fca.AFAMILIA, fac.FFORPA
                    FROM rmatemp AS temp, fcart AS fca, fcfac AS fac
                    WHERE temp.rcodar = fca.ACODAR
                    AND temp.rfac = fac.FDOC
                    AND temp.rcodcl = $ccodcl
                    ORDER BY temp.rfecha asc");

                foreach ($arrArtsDevolucion as $arrArtDevolucion)
                {
                    if (!$enc)
                    {
                        if ($arrArtDevolucion->rnumser == Request::input('nnumser'))
                        {
                            $enc = true;
                        }
                    }
                }

                if (!$enc)
                {
                    $this->devolAdd();
                }
            }
        }
    }

    function eliminarDevolucion()
    {
        if (Request::isMethod('post')) 
        {
            if (Request::has('devolElim'))
            {
                $idDevolucion = Request::input('idartic');
                DB::delete("DELETE FROM rmatemp where id = $idDevolucion");
            }
        }
    }

    function finRMA()
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;
        $nomPDF = Request::input('nomPDF');
        $nomPDF2 = Request::input('nomPDF2');
        $soloRMA = Request::input('soloRMA');
        $rmacreado = Request::input('rmacreado');

        $arrRMAs = DB::select("SELECT * FROM rma AS rm, rma_linea AS rl WHERE rm.numero = rl.rma AND rm.rcodcl = $ccodcl ORDER BY rl.rfecha ASC");

        DB::insert("INSERT INTO rma_autorizacion_solicitud (id, rma, ccodcl, estado, solicitadaweb, fecha_solicitada, tipo, idusuario, fecha_autorizada, fecha_expiracion, fecha_rechazo)
                    VALUES (NULL, $rmacreado, $ccodcl, 0, 1, SYSDATE(), 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00')");

        $arrArtsDevolucion = DB::select("SELECT * FROM rmatemp WHERE rcodcl = $ccodcl ORDER BY rfecha ASC");

        if ( count($arrArtsDevolucion) > 0)
        {
            foreach ($arrArtsDevolucion as $artDev) 
            {
                $acodarAux = strtolower( str_replace("/", "barder", $artDev->rcodar) );
                $artDev->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";
            }
        }

        return View('devolucion_fin')->with("ccodcl", $ccodcl)
                                     ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                     ->with("arrRMAs", $arrRMAs)
                                     ->with("nomPDF", $nomPDF)
                                     ->with("nomPDF2", $nomPDF2)
                                     ->with("soloRMA", $soloRMA)
                                     ->with("rmacreado", $rmacreado);
    }

    function recogidaRMA($rclave = "", $rma = 1)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $arrRegistros = array();
        $filaRegistro = array();
        $registro = false;

        $hayError = false;
        $errorHay = false;
        $errorTXT = "";

        $cliEmpresa = "";
        $cliContacto = "";
        $cliTel1 = "";

        $cliCalle = "";
        $cliCodpo = "";
        $cliLocalidad = "";

        $recNumero = "";

        $hora1 = "";
        $hora2 = "";
        $min1 = "";
        $min2 = "";

        $numeroBultos = 0;

        $claseErrBultos = '';
        $claseErrNombre = '';
        $claseErrContacto = '';
        $claseErrTelef = '';
        $claseErrCalle = '';
        $claseErrNumero = '';
        $claseErrCP = '';
        $claseErrPoblacion = '';
        $claseErrResto = '';
        $claseErrTime = '';

        $codigoPostal = '';
        $poblacion = '';
        $resto = '';
        $nombre = '';
        $telefono = '';
        $contacto = '';
        $numero = '';
        $numeroBultos = '';
        $fechaF = '';
        $calle = '';

        $estado = null;
        $valorTelefono = null;
        $fechaSeleccionada = null;
        $time1F = null;
        $time2F = null;
        $rurl = '';

        $horarioreco = 0;

        if ($rclave != "" && $rma != "")
        {
            $rclave = $rclave;

            // Comprobar que existe registro con esa clave
            $arrRegistros = DB::select("SELECT * FROM rma_recogida WHERE rclave = '$rclave' ORDER BY fecha_creacion DESC LIMIT 1 ");

            if (count($arrRegistros) > 0)
            {
                $registro = true;
            }
            else
            {
                $registro = false;
            }
        }

        if ($rclave == "")
        {
            $errorHay = true;
            $errorTXT = "Se ha producido un error";
        }

        if ($rclave != "")
        {
            // Comprobar que existe registro con esa clave
            $arrRegistros = DB::select("SELECT * FROM rma_recogida WHERE rclave = '$rclave' ORDER BY fecha_creacion DESC LIMIT 1 ");

            foreach ($arrRegistros as $arrRegistro)
            {
                // Cliente
                $rcodcl = $arrRegistro->rcodcl;
                $arrClientes = DB::select("SELECT CNOM, CDOM, CCODPO, CPOB, CPAIS, CDNI, CRESCAR3, CTEL1, CTEL2, CTEL3, CMAIL1, CMAIL2, CMAIL3 FROM fccli where ccodcl = $rcodcl");
                foreach ($arrClientes as $cliente)
                {
                    //$cliEmpresa = $cliente->CNOM;
                    $cliContacto = $cliente->CRESCAR3;
                }

                // Detectar centro de envío de la compra
                    $centroFila = ""; $znom = ""; $ztel = ""; $zdom = ""; $zcodpo = ""; $zpob = ""; $znumero = ""; $zresto = "";
                    $centroArr = DB::select("
                                        SELECT z.* 
                                        FROM rma_recogida rec, rma_linea l, fccba a, fccen z
                                        WHERE rec.rma = l.rma AND a.BFACTURA = l.rfac and rclave = '$rclave' AND z.zcli = rec.rcodcl AND z.ZCEN = a.bcentro
                                        LIMIT 1");


                    if ( count($centroArr) > 0 )
                    {
                        foreach ($centroArr as $centro) 
                        {
                            $znom = $centro -> ZNOM;
                            $ztel = $centro -> ZTEL;
                            $ztel = preg_replace("/[^0-9]/", "", $ztel);
                            $zdom = $centro -> ZDOM;
                            $zcodpo = $centro -> ZCODPO;
                            $zpob = $centro -> ZPOB;


                            // Dividir domicilio en los 3 campos que requiere MRW
                                $centroDireccion = utf8_decode($zdom); 
                                $pos = 0; $finalizar = false; $i = 0; $longitud = 1;

                                while (!$finalizar && $i < strlen($centroDireccion))
                                {
                                    $char = $centroDireccion[$i];
                                    
                                    if ( is_numeric($char) )
                                    {
                                        $longitud = 1;
                                        $numero = $char.""; 
                                        $pos = $i; $j = 1;

                                        while (!$finalizar) 
                                        {
                                        
                                            if ( isset($centroDireccion[$i + $j]) )
                                            {
                                                $char = $centroDireccion[$i + $j];  
                                                if ( is_numeric($char) )
                                                {
                                                    $longitud++;
                                                    $numero .= $char.""; 
                                                }
                                                else { $finalizar = true; }
                                            }
                                            else { $finalizar = true; }

                                            $j++;
                                        }

                                        
                                    }

                                    $i++;
                                }

                                $znumero = $numero;

                                $direccion = substr($centroDireccion, 0, $pos);
                                $direccion = trim($direccion, ",");
                                $direccion = trim($direccion);
                                $direccion = trim($direccion, ",");
                                

                                // Resto
                                $posResto = $pos + $longitud;
                                $longitudResto = strlen($centroDireccion) - $posResto;

                                $resto = substr($centroDireccion, $posResto, $longitudResto);
                                $resto = trim($resto, ",");
                                $resto = trim($resto);
                                $resto = trim($resto, ",");
                                $resto = utf8_encode($resto);
                                $resto = $this -> quitarTildes($resto);
                                $zresto = $resto;

                                if ($direccion == "") { $direccion = $centroDireccion; $resto = ""; }
                                $direccion = utf8_encode($direccion);
                                $direccion = $this -> quitarTildes($direccion);
                                $zdom = $direccion;
                        }
                    }






                // RMA
                $rmaStr = $arrRegistro->rma;
                $rma = str_replace("RMA", "", $rmaStr);
                $rmaEtiqueta = base_path()."/resources/pdfrma/pdf_".$rma."_envio.pdf";

                $rmaReferencia = "R".$rma;

                if (!$registro) 
                { 
                    $errorHay = true; $errorTXT = "Solicitud de recogida no identificada"; 
                }
                else
                {
                    // Comprobar que el registro sigue pendiente
                    $estado = $arrRegistro->restado;
                    $rma = $arrRegistro->rma;
                    $rurl = $arrRegistro->rurl;

                    $arrLineasRMA = DB::select("SELECT r.*, a.nombre as 'averia_nombre' 
                                            FROM rma_linea r, rma_averia a 
                                            WHERE r.raveria = a.id and rma = $rma");

                    if ($estado == 1) 
                    { 
                        $errorHay = true; 
                        $errorTXT = "La recogida ya fue solicitada"; 
                    }

                    if ($estado == 0)
                    {
                        if (Request::has('recEnviar')) 
                        {
                            $hayError = false;
                        }

                        $hoy = new DateTime();
                        $hoyF = $hoy->format("d/m/Y");

                        $mañana = new DateTime();
                        $mañana -> modify('+1 day');

                        // Si son más de las 18:00, la fecha mínima de recogida es pasado mañana
                        $horaActual = $hoy->format("H");
                        //$horaActual = 18; // 1234
                        //echo "hora: $horaActual";
                        if ($horaActual >= 18)
                        {
                            $mañana -> modify('+1 day');
                        }

                        $diaSem = $mañana -> format('w');

                        if ($diaSem == 6)
                        {
                            $mañana -> modify('+2 day');
                        }

                        //echo "manana:: ".$mañana -> format('w')." ";
                        

                        $mañanaF = $mañana->format("d/m/Y");


                        $time1F = '09:00';
                        $time2F = '14:00';

                        $fechaSeleccionada = $mañanaF;
                        $prueba = 'Hola0';

                        if (Request::has('recEnviar'))
                        {
                            if (Request::has('horarioreco')) 
                            {
                                $horarioreco = Request::input('horarioreco');
                                if ($horarioreco == 0) { $time1F = "09:00"; $time2F = "14:00"; }
                                if ($horarioreco == 1) { $time1F = "14:00"; $time2F = "20:00"; }
                            }

                            if (Request::has('datetimeFecha')) 
                            {
                                $fechaSeleccionada = Request::input('datetimeFecha');
                            }

                            if (Request::has('recBultos'))
                            {
                                if ( !is_numeric(Request::input('recBultos')))
                                {
                                    $claseErrBultos = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola1';
                                }
                                else
                                {
                                    $numeroBultos = Request::input('recBultos');
                                }
                            }
                            else
                            {
                                $claseErrBultos = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola2';
                            }

                            if (Request::has('recNombre')) 
                            {
                                if ( empty(Request::input('recNombre')))
                                {
                                    $claseErrNombre = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola3';
                                }
                            }
                            else
                            {
                                $claseErrNombre = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola4';
                            }

                            if (Request::has('recContacto')) 
                            {
                                if ( empty(Request::input('recContacto')))
                                {
                                    $claseErrContacto = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola5';
                                }
                            }
                            else
                            {
                                $claseErrContacto = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola6';
                            }

                            if (Request::has('recTelef')) 
                            {
                                if ( empty(Request::input('recTelef')))
                                {
                                    $claseErrTelef = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola7';
                                }
                            }
                            else
                            {
                                $claseErrTelef = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola8';
                            }

                            if (Request::has('recTelef'))
                            {
                                $valorTelefono = preg_replace("/[^0-9]/", "", Request::input('recTelef'));
                            }
                            else
                            {
                                $valorTelefono = preg_replace("/[^0-9]/", "", $cliTel1);
                            }

                            if (Request::has('recCalle')) 
                            {
                                if ( empty(Request::input('recCalle')))
                                {
                                    $claseErrCalle = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola9';

                                    $cliCalle = Request::input('recCalle'); 
                                }
                            }
                            else
                            {
                                $claseErrCalle = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola10';
                            }

                            if (Request::has('recNumero')) 
                            {
                                if ( empty(Request::input('recNumero')))
                                {
                                    $claseErrNumero = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola11';
                                }
                                else
                                {
                                    $numero = Request::input('recNumero');
                                }
                            }
                            else
                            {
                                $claseErrNumero = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola12';
                            }

                            if (Request::has('recCP')) 
                            {
                                if ( empty(Request::input('recCP')))
                                {
                                    $claseErrCP = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola13';
                                }
                            }
                            else
                            {
                                $claseErrCP = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola14';
                            }

                            $resto = "";

                            if (Request::has('recResto')) 
                            { 
                                if ( empty(Request::input('recResto')))
                                {
                                    /*$claseErrResto = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola15';*/

                                    $recResto = Request::input('recResto');
                                }
                                else
                                {
                                    $resto = Request::input('recResto');
                                }
                            }
                            else
                            {
                                //$claseErrResto = "border: 1px solid red;";
                                //$hayError = true;
                                $prueba = 'Hola16';
                            }

                            if (Request::has('recPoblacion'))
                            {
                                if ( empty(Request::input('recPoblacion')))
                                {
                                    $claseErrPoblacion = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola17';
                                }
                            }
                            else
                            {
                                $claseErrPoblacion = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola18';
                            }




                            //$time1F = Request::input('time1');
                            //$time2F = Request::input('time2');

                            $aux1 = explode(":", $time1F); $hora1 = $aux1[0]; $hora1 = ltrim($hora1, '0'); $min1 = $aux1[1]; $min1 = ltrim($min1, '0');
                            $aux2 = explode(":", $time2F); $hora2 = $aux2[0]; $hora2 = ltrim($hora2, '0'); $min2 = $aux2[1]; $min2 = ltrim($min2, '0');

                            $claseErrTime = " ";
                                                        
                            if ($hora1 > $hora2)
                            {
                                $claseErrTime = "border: 1px solid red;";
                                $hayError = true;
                                $prueba = 'Hola19';
                            } 

                            if ($hora1 == $hora2)
                            {
                                if ($min1 > $min2)
                                {
                                    $claseErrTime = "border: 1px solid red;";
                                    $hayError = true;
                                    $prueba = 'Hola20';
                                } 
                            }
                        }

                        if ( !$hayError && Request::has('recEnviar'))
                        {
                            // URL del WSDL del WebService
                            $wsdl_url = "http://sagec-test.mrw.es/MRWEnvio.asmx?WSDL";  // 1234
                            //$wsdl_url = "http://sagec.mrw.es/MRWEnvio.asmx?WSDL";

                            // 1234
                            if ($rcodcl == 3) { $wsdl_url = "http://sagec-test.mrw.es/MRWEnvio.asmx?WSDL"; }

                            
                            // Creamos una instancia del cliente SOAP de PHP5
                            try 
                            {
                                $clientMRW = new SoapClient($wsdl_url, array ('trace' => TRUE));
                            } 
                            catch (SoapFault $e) 
                            {
                                printf("Error creando cliente SOAP: %s<br />\n",$e->__toString());
                                return false;
                            }

                            ## CABECERAS E IDENTIFICACION ##
                            // Configuramos los datos de autorizacion del cliente MRW
                            $FranquiciaMRW = '03824';
                            $AbonadoMRW = '007038';
                            $DepartamentoMRW = '';
                            $usuarioMRW = '03824SGDIGINOVA';
                            $PasswordMRW = '03824SGDIGINOVA';

                            // Y los cargamos en el array de los headers
                            $cabeceras = array (
                                'CodigoFranquicia' => $FranquiciaMRW, //Obligatorio
                                'CodigoAbonado' => $AbonadoMRW, //Obligatorio
                                'CodigoDepartamento' => $DepartamentoMRW, //Opcional - Se puede omitir si no se han creado departamentos en sistemas de MRW.
                                'UserName' => $usuarioMRW, //Obligatorio
                                'Password' => $PasswordMRW //Obligatorio
                            );


                            $codigoTipoVia = "CL";
                            $calle = Request::input('recCalle');

                            $resTipoVia = strcmp($calle, "Av");
                            if ( $resTipoVia !== false )
                            {
                                $codigoTipoVia = "AV";
                            }
                            
                            $codigoPostal = Request::input('recCP');
                            $poblacion = Request::input('recPoblacion');
                            $resto = Request::input('recResto');

                            $nombre = Request::input('recNombre');
                            $telefono = Request::input('recTelef');
                            $contacto = Request::input('recContacto');
                            $numero = Request::input('recNumero');
                            $numeroBultos = Request::input('recBultos');

                            $fechaF = Request::input('datetimeFecha');

                            date_default_timezone_set('CET');
                            $params = array (
                                'request' => array (
                                    // ======================== Datos recogida ============================== 
                                    'DatosRecogida' => array (
                                        ## DATOS REMITENTE ##
                                        'Direccion' => array (
                                               'CodigoDireccion' => '', //Opcional - Se puede omitir. Si se indica sustituira al resto de parametros
                                               'CodigoTipoVia' => $codigoTipoVia, //Opcional - Se puede omitir aunque es recomendable usarlo
                                               'Via' => $calle, //Obligatorio
                                               'Numero' => $numero, //Obligatorio - Recomendable que sea el dato real. Si no se puede extraer el dato real se pondra 0 (cero)
                                               'Resto' => $resto, //Opcional - Se puede omitir.
                                               'CodigoPostal' => $codigoPostal, //Obligatorio
                                               'Poblacion' => $poblacion, //Obligatorio
                                               //'Estado' => '', //Opcional - Se debe omitir para envios nacionales.
                                               'CodigoPais' => '' //Opcional - Se puede omitir para envios nacionales.
                                        ),
                                        //'Nif' => $nif, //Opcional - Se puede omitir.
                                        'Nombre' => $nombre, //Obligatorio
                                        'Telefono' => $telefono, //Opcional - Muy recomendable
                                        'Contacto' => $contacto, //Opcional - Muy recomendable
                                        'ALaAtencionDe' => '', //Opcional - Se puede omitir.
                                        'Horario' => array (  //Opcional - Se puede omitir este campo y los sub-arrays
                                            'Rangos' => array ( // Si se indica horario, habrá que informar al menos un rango (HorarioRangoRequest)
                                                 'HorarioRangoRequest' => array (
                                                    'Desde' => $time1F,
                                                    'Hasta' => $time2F
                                                )
                                            )
                                        ),
                                        'Observaciones' => '' //Opcional - Se puede omitir.   1234
                                    ),
                                    // ======================== Datos entrega ============================== 
                                    'DatosEntrega' => array (
                                        ## DATOS DESTINATARIO ##
                                        'Direccion' => array (
                                               'CodigoDireccion' => '', //Opcional - Se puede omitir. Si se indica sustituira al resto de parametros
                                               'CodigoTipoVia' => 'CL', //Opcional - Se puede omitir aunque es recomendable usarlo
                                               'Via' => 'Pino Pinonero', //Obligatorio
                                               'Numero' => '2', //Obligatorio - Recomendable que sea el dato real. Si no se puede extraer el dato real se pondra 0 (cero)
                                               'Resto' => 'Nave 4', //Opcional - Se puede omitir.
                                               'CodigoPostal' => '41016', //Obligatorio
                                               'Poblacion' => 'Sevilla', //Obligatorio
                                               //'Estado' => '', //Opcional - Se debe omitir para envios nacionales.
                                               'CodigoPais' => '' //Opcional - Se puede omitir para envios nacionales.
                                        ),
                                        'Nif' => 'B90020892', //Opcional - Se puede omitir.
                                        'Nombre' => 'Smarters Accesorios, S.L.', //Obligatorio
                                        'Telefono' => '954527299', //Opcional - Muy recomendable
                                        //'Contacto' => $contacto, //Opcional - Muy recomendable
                                        'ALaAtencionDe' => '', //Opcional - Se puede omitir.
                                        /*'Horario' => array (  //Opcional - Se puede omitir este campo y los sub-arrays
                                            'Rangos' => array ( // Si se indica horario, habrá que informar al menos un rango (HorarioRangoRequest)
                                                 'HorarioRangoRequest' => array (
                                                    'Desde' => '08:30',
                                                    'Hasta' => '19:30'
                                                )
                                            )
                                        ),*/
                                        'Observaciones' => '' //Opcional - Se puede omitir.   1234
                                    ),
                                    ## DATOS DEL SERVICIO ##
                                    'DatosServicio' => array (
                                        //'Fecha' => $mañanaF,  //Obligatorio. Fecha >= Hoy()
                                        'Fecha' => $fechaF,  //Obligatorio. Fecha >= Hoy()
                                        //'Referencia' => 'SAGEC.PHP|' . $hoyFull,  //Obligatorio. ¿numero de pedido/albaran/factura?
                                        'Referencia' => $rmaReferencia,  //Obligatorio. ¿numero de pedido/albaran/factura?
                                        'EnFranquicia' => 'N', //Opcional -
                                                               //   N = Entrega en domicilio (por defecto si se omite)
                                                               //   E = Entrega en franquicia. El destinatario recogera en delegacion mas proxima
                                        // 0200 = Urgente 19; 0205 = Urgente 19 Expedición
                                        'CodigoServicio' => '0205', //Obligatorio. Cada servicio deberá ser activado por la franquicia
                                        //'CodigoServicio' => '0205', //Obligatorio. Cada servicio deberá ser activado por la franquicia
                                                    
                                                ## Desglose de Bultos <--
                                        'NumeroBultos' => $numeroBultos, //Obligatorio. Solo puede haber un bulto por envio en eCommerce

                                        
                                        // Desglose de bultos. Creo un array por cada artículo del parte. Incluyo hasta el nº de bultos que haya indicado el cliente

                                        //'Bultos' => $arrBultos,

                                        /*'Bultos' =>   array (
                                                            'Alto' => '8.5',
                                                            'Largo' => '49.5',
                                                            'Ancho' => '31.9',
                                                            'Referencia' => '123456789',
                                                            'Peso' => '1'
                                                        ),
                                                    array (
                                                        'Alto' => '8.5',
                                                        'Largo' => '49.5',
                                                        'Ancho' => '31.9',
                                                        'Referencia' => '987654321',
                                                        'Peso' => '2'
                                                    )
                                                ,*/

                                        /*'Bultos' => 
                                                array (
                                                            'Alto' => '8.5',
                                                            'Largo' => '49.5',
                                                            'Ancho' => '31.9',
                                                            'Peso' => '1'
                                                        ),
                                                array (
                                                            'Alto' => '8.5',
                                                            'Largo' => '49.5',
                                                            'Ancho' => '31.9',
                                                            'Peso' => '1'
                                                        ),
                                                array (
                                                            'Alto' => '8.5',
                                                            'Largo' => '49.5',
                                                            'Ancho' => '31.9',
                                                            'Peso' => '1'
                                                        ),*/
                                            


                                        'Peso' => '1', //Obligatorio. Debe ser igual al valor Peso en BultoRequest si se ha usado
                                        //'NumeroPuentes' => '', //Opcional - Se debe omitir pues no se usa en eCommerce.
                                        'EntregaSabado' => 'N' //Opcional - Se puede omitir. (coste adicional)
                                        /*'Entrega830' => 'N', //Opcional - Se debe omitir pues no se usa en eCommerce. (coste adicional)
                                        //'EntregaPartirDe' => '09:15', //Opcional - Se puede omitir.
                                            ## Notificaciones --> //Opcional - Se puede omitir todo el nodo y subnodos
                                        /*'Notificaciones' => array (
                                            'NotificacionRequest' => array (
                                                0   =>  array (
                                                    'CanalNotificacion' => '2', //Canal por el que se enviará la notificación
                                                                                //1 = SMS
                                                                                //2 = MAIL
                                                    'TipoNotificacion' => '2',  //Tipo de la notificación
                                                                                //1 = Confirmación de entrega
                                                                                //2 = Seguimiento de envío (informa los diferentes estados de tránsito del envío)
                                                                                //3 = Aviso de entrega en franquicia (informa al destinatario del envío que la mercancía está disponible en la franquicia de destino. Solo tendrá sentido para entrega en franquicia, y será obligatorio)
                                                                                //4 = Preaviso de entrega (informa al destinatario del envío de la fecha de entrega de la mercancía. Solo tendrá sentido cuando NO sea entrega en franquicia)
                                                                                //5 = Confirmación de recogida (informa al destinatario que el envío ha sido recogido en origen. Solo tendrá sentido cuando NO sea entrega en franquicia)
                                                   'MailSMS' => 'cliente@mrw.com'   //Teléfono móvil o dirección email, según CanalNotificacion
                                                ),
                                                1    => array (
                                                    'CanalNotificacion' => '1', //Canal por el que se enviará la notificación
                                                                                //1 = SMS
                                                                                //2 = MAIL
                                                    'TipoNotificacion' => '4',  //Tipo de la notificación
                                                                                //1 = Confirmación de entrega
                                                                                //2 = Seguimiento de envío (informa los diferentes estados de tránsito del envío)
                                                                                //3 = Aviso de entrega en franquicia (informa al destinatario del envío que la mercancía está disponible en la franquicia de destino. Solo tendrá sentido para entrega en franquicia, y será obligatorio)
                                                                                //4 = Preaviso de entrega (informa al destinatario del envío de la fecha de entrega de la mercancía. Solo tendrá sentido cuando NO sea entrega en franquicia)
                                                                                //5 = Confirmación de recogida (informa al destinatario que el envío ha sido recogido en origen. Solo tendrá sentido cuando NO sea entrega en franquicia)
                                                   'MailSMS' => '666666666' //Teléfono móvil o dirección email, según CanalNotificacion
                                                )
                                            )
                                        ),
                                        ## Notificaciones <--
                                        //'SeguroOpcional' => array ( //Opcional - Se puede omitir todo el nodo y subnodos (coste adicional)
                                        //     'CodigoNaturaleza' => '',    //Código de la naturaleza del envío.
                                                                            //1 = Mercancías generales
                                                                            //2 = Joyas y valores
                                                                            //3 = Animales vivos
                                        //     'ValorAsegurado' => '000'    //Valor monetario en euros a asegurar
                                        //),
                                        'TramoHorario'  =>  '0', //Opcional - Horario de entrega (coste adicional) 
                                                                 // 0 = Sin tramo (8:30h a 19h). Por defecto si se omite.
                                                                 // 1 = Mañana (8:30h a 14h)
                                                                 // 2 = Tarde (14h a 19h)
                                        //'PortesDebidos'   =>  'N', //Opcional - Se debe omitir si el abonado no lo tiene habilitado en el sistema
                                        */
                                    )
                                )
                            );

                            // Cargamos los headers sobre el objeto cliente SOAP
                            $header = new SoapHeader('http://www.mrw.es/','AuthInfo', $cabeceras);
                            $clientMRW->__setSoapHeaders($header);
                            // Invocamos el metodo TransmEnvio pasandole los parametros del envio
                            try {
                                    $responseCode = $clientMRW->TransmEnvio($params);
                                    //echo "<br /><br />\$responseCode:<br /><pre>";
                                    //print_r($responseCode);
                                    //echo '</pre>';
                              //echo 'LAST REQUEST1:<br>' . $clientMRW->__getLastRequest();
                            } catch (SoapFault $exception) {
                                    printf("Error llamando al metodo TransmEnvio del WebService MRW: %s<br />\n",$exception->__toString());
                                    echo "<br /><br />Solicitud SOAP enviada (aparece como un XML plano):<br />" . $clientMRW->__getLastRequest();
                                    return false;
                            }

                            // Cargamos los headers sobre el objeto cliente SOAP
                            $header = new SoapHeader('http://www.mrw.es/','AuthInfo',$cabeceras);
                            $clientMRW->__setSoapHeaders($header);
                            // Invocamos el metodo TransmEnvio pasandole los parametros del envio
                            try 
                            {
                                $responseCode = $clientMRW->TransmEnvio($params);

                            } 
                            catch (SoapFault $exception) 
                            {
                                    printf("Error llamando al metodo TransmEnvio del WebService MRW: %s<br />\n",$exception->__toString());
                                    echo "<br /><br />Solicitud SOAP enviada (aparece como un XML plano):<br />" . $clientMRW->__getLastRequest();
                                    return false;
                            }

                            // tomar la respuesta y comprobar si ocurrio algun error
                            if ( 0 == $responseCode->TransmEnvioResult->Estado ) 
                            {
                                // No se ha generado la orden de envio y mostramos el error generado
                                echo 'ERROR:<br>'.$responseCode->TransmEnvioResult->Mensaje . "
                                    <br>
                                    Request enviada:<br>
                                    " . $clientMRW->__getLastRequest();
                            } 
                            else if ( 1 == $responseCode->TransmEnvioResult->Estado ) 
                            {
                                // La orden de envio se ha generado correctamente
                                //var_dump($clientMRW->__getLastRequest());
                                // Montamos la URL para recuperar la información del envío y la etiqueta
                                $urlParams = $responseCode->TransmEnvioResult->Url . "?Franq=" . $FranquiciaMRW . "&Ab=" . $AbonadoMRW ."&Dep=" . $DepartamentoMRW . "&Pwd=" . $PasswordMRW
                                            ."&NumSol=" . $responseCode->TransmEnvioResult->NumeroSolicitud . "&Us=" . $usuarioMRW . "&NumEnv=" . $responseCode->TransmEnvioResult->NumeroEnvio;

                                $numEnvioMRW = $responseCode->TransmEnvioResult->NumeroEnvio;

                                // 1234 se necesitan las 3 líneas:
                                $this->actualizarRecogida($rclave, 1, $numEnvioMRW, $urlParams);
                                $this->modificarEstadoRma($rma, 4);  // 1234
                                $this->enviarEmailRecogidaRealizada($rclave);  // 1234

                                ?>
                                <script type="text/javascript">
                                    window.location = "/recogida/<?php echo $rclave ?>";
                                </script>
                                <?php
                            } 
                            else 
                            { 
                                // No sabemos que ha pasado y mostramos un mensaje
                                echo "Se ha producido un error no identificado. Consulte al administrador de la web";
                            }
                            // Destruimos el objeto cliente
                            unset($clientMRW);
                        }
                        else
                        {
                            $errorHay = true;
                        }
                    }
                    else
                    {
                        $errorHay = true;
                    }
                }
            }
        }

        return View('recogida')->with("ccodcl", $ccodcl)
                               ->with("rclave", $rclave)
                               ->with("rma", $rma)
                               ->with("registro", $registro)
                               ->with("estado", $estado)
                               ->with("numeroBultos", $numeroBultos)
                               ->with("nombre", $nombre)
                               ->with("cliEmpresa", $cliEmpresa)
                               ->with("contacto", $contacto)
                               ->with("cliContacto", $cliContacto)
                               ->with("valorTelefono", $valorTelefono)
                               ->with("calle", $calle)
                               ->with("cliCalle", $cliCalle)
                               ->with("numero", $numero)
                               ->with("resto", $resto)
                               ->with("codigoPostal", $codigoPostal)
                               ->with("cliCodpo", $cliCodpo)
                               ->with("poblacion", $poblacion)
                               ->with("cliLocalidad", $cliLocalidad)
                               ->with("fechaSeleccionada", $fechaSeleccionada)
                               ->with("time1F", $time1F)
                               ->with("time2F", $time2F)
                               ->with("claseErrBultos", $claseErrBultos)
                               ->with("claseErrBultos", $claseErrBultos)
                               ->with("claseErrNombre", $claseErrNombre)
                               ->with("claseErrContacto", $claseErrContacto)
                               ->with("claseErrTelef", $claseErrTelef)
                               ->with("claseErrCalle", $claseErrCalle)
                               ->with("claseErrNumero", $claseErrNumero)
                               ->with("claseErrCP", $claseErrCP)
                               ->with("claseErrPoblacion", $claseErrPoblacion)
                               ->with("claseErrResto", $claseErrResto)
                               ->with("claseErrTime", $claseErrTime)
                               ->with("errorHay", $errorHay)
                               ->with("errorTXT", $errorTXT)
                               ->with("znom", $znom)
                               ->with("ztel", $ztel)
                               ->with("zdom", $zdom)
                               ->with("znumero", $znumero)
                               ->with("zresto", $zresto)
                               ->with("zcodpo", $zcodpo)
                               ->with("zpob", $zpob)
                               ->with("horarioreco", $horarioreco)
                               ->with("rurl", $rurl);
    }

    function actualizarRecogida($rclave, $estado, $numEnvio, $urlParams)
    {
        $bultos = Request::input('recBultos');
        $nombre = Request::input('recNombre');
        $contacto = Request::input('recContacto');
        $telefono = Request::input('recTelef');
        $calle = Request::input('recCalle');
        $numero = Request::input('recNumero');
        $resto = Request::input('recResto');
        $cp = Request::input('recCP');
        $localidad = Request::input('recPoblacion');


        DB::update("UPDATE rma_recogida SET restado = $estado, fecha_solicitud = SYSDATE(), rcodigoenv = '$numEnvio', rurl = '$urlParams', bultos = $bultos, 
                                        nombre = '$nombre', contacto = '$contacto', telefono = '$telefono', calle = '$calle', numero = $numero, resto = '$resto', cp = '$cp', localidad = '$localidad',
                                        fecha_mod = SYSDATE() 
                                        WHERE rclave = '$rclave'");
    }

    function modificarEstadoRma($rma, $estado)
    {
        DB::update("UPDATE rma SET estado = $estado WHERE numero = $rma");
    }

    function obtRecogidaInfoClave($rclave)
    {
        $arrRecogidas = DB::select("SELECT rcodcl, rma, contacto, crescar3, cnom, rcodigoenv, czona, cmailenvio, cmail1 
                                    FROM rma_recogida, fccli
                                    WHERE rcodcl = ccodcl AND rclave = '$rclave'
                                    LIMIT 1");

        $fila = false;

        if (count($arrRecogidas) > 0)
        {
            foreach ($arrRecogidas as $arrRecogida)
            {
                $fila = $arrRecogida;
            }
        }

        return $fila;
    }

    function enviarEmailRecogidaRealizada($k)
    {
        $enviado = false;
        $registro = $this -> obtRecogidaInfoClave($k);
        

        if ($registro != false)
        {
            $rma = $registro->rma;
            $rcodigoenv = $registro->rcodigoenv;
            $receptor = $registro->cmailenvio;
            if ($receptor == "")
            {
                $receptor = $registro->cmail1;
            }

            // Contacto en el RMA
            $contacto = $registro->contacto;

            if ($contacto == "")
            {
                // Contacto en ficha cliente
                $contacto = $registro->crescar3;

                if ($contacto == "")
                {
                    // Nombre de cliente
                    $contacto = $registro->cnom;
                }
            }

            require_once base_path().'/phpmailer/class.smtp.php';
            require_once base_path().'/phpmailer/class.phpmailer.php';

            $mail = new PHPMailer();
             
            //Le indicamos que el modo será SMTP    
            //$mail -> IsSMTP();     
             
             //Configuramos el Charset del mensaje               
            //$mail -> CharSet="ISO-8859-1"; 
            $mail -> CharSet="utf8"; 
             
            //Autenticacion Segura con ssl
            $mail -> SMTPSecure = 'ssl';

            //El servidor smtp, en nuestro caso usaremos el de gmail
            $mail -> Host = "mail.diginova.es";
             
            //El puerto, en gmail sería 465
            $mail -> Port = 25;
             
            //El email a través del cual enviaremos
            $mail -> Username = 'rma.devoluciones@diginova.es';
            //$mail -> Username = 'javimoya33@gmail.com';
             
            //Contraseña del email
            //$mail -> Password = 'RGi20f8GyL3bi1qD';
            $mail -> Password = 'E70Jqzr03HavLCd9';
             
            //Le indicamos que se requiere autenticacion
            $mail -> SMTPAuth = true;
             
            //Si responden el mensaje llegará a...
            //$mail -> From = 'rma.devoluciones@diginova.es';
            $mail -> From = 'javimoya33@gmail.com';
            
            //Nombre que le indicará de donde viene el mensaje al destinatario
            $mail -> FromName = 'Diginova - RMA';
            
            //Email de destino 
            //echo "<br />Recep: $receptor <br />";
            $receptor = "javimoya33@gmail.com"; // 1234


            // 1234
            if ($receptor == "comercial@diginova.es") 
            { 
                //$receptor = "programacion@diginova.es"; 
                $receptor = "javimoya33@gmail.com"; 
            }

            $mail -> AddAddress($receptor);
            

            //Lo mandaremos en HTML?
            $mail -> IsHTML(true);
             
            $mail -> Subject = "Diginova - Recogida tramitada con MRW";
            
            $mail -> Body = ""; //1234
            //$mail -> Body .= $this -> mailCabecera();

            //$mail -> Body .= "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/img/rmaautmail1.jpg' width='750' height='100' /></a></p>";
            $mail -> Body .= "<div style='padding: 20px; font-family: Verdana; font-size: 11pt;'>";
            $mail -> Body .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hola $contacto:<br /><br />";
            $mail -> Body .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se ha solicitado a MRW la recogida de tu RMA n&ordm; <span style='color: #5d7ea4; font-weight: bold; '>$rma</span>.<br />";
            $mail -> Body .= "<br />
                <table align='center' style='background-color: #f2f2f2; padding: 20px; width: 600px; margin: auto; text-align: left; font-family: Verdana; font-size: 11pt'>
                    <tr>
                    <td>
                    N&ordm; de seguimiento: <span style='color: #5d7ea4; font-weight: bold; '>".$rcodigoenv."</span><br /><br />
                    Consultar seguimiento del env&iacute;o: <a  style='color: #5d7ea4; font-weight: bold; ' href='https://www.mrw.es/seguimiento_envios/MRW_paqueteria_nacional_multiple.asp'>Seguimiento MRW</a><br /><br />
                    Tel&eacute;fono de contacto MRW: 91 892 66 89<br /><br /> 
                    </td>
                    </tr>
                </table>
                <br /><a href='".$this->urlDiginova."/recogida/".$k."'><img src='http://www.diginova.es/img/rmadevpasos1.jpg' alt='Diginova' /></a>

            ";
            $mail -> Body .= "</div>";

            //$mail -> Body .= $this -> mailPie();


            $enviado = false;

            if(!$mail -> Send())
            {
                //echo "<br /><br />";
                //echo 'No se pudo enviar el mensaje.'.$mail -> ErrorInfo;
            }
            else
            {
                //echo "<br /><br />";
                //echo 'El mensaje se ha enviado correctamente.';
                $enviado = true;
            }
        }


        return $enviado; 
    }

    function mailCabecera()
    {
        $cadena = '';
        $cadena .= '<TABLE  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TABLE  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TR>';
        $cadena .= '<TD  style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " width=750>';
        $cadena .= '<TABLE cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750>';
        $cadena .= '<TABLE cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750>';
        $cadena .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" width=750 colSpan=3>';
        $cadena .= '<A href="https://diginova.es/" target=_blank>';
        $cadena .= '<IMG style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; DISPLAY: block; BORDER-RIGHT-COLOR: " border=0 alt=DIGINOVA src="https://diginova.es/testmail2/img/diginovaemail.png" width=750 height=86 style="display: flex;">';
        $cadena .= '</A>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= ' </TD>';
        $cadena .= '</TR>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '<TR BACKGROUND-COLOR: style="BACKGROUND-COLOR: #333333" bgColor=#333333>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: #333333" bgColor=#333333 width=750>';
        $cadena .= '<TABLE cellSpacing=0 cellPadding=0 border=0 style="margin-bottom: -10px">';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: #333333" bgColor=#333333>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';

        $cadena .= '<TABLE style="width: 750px; margin-top: -10px;" cellSpacing="0" cellPadding="0" border="0">';
        $cadena .= '<tr>';
        $cadena .= '<td  width="750" style="padding-top: 40px;" >';

        return $cadena;
    }

    function mailPie()
    {
        $cadena = "";

        $cadena .= "<br /><br />
                <div style='font-family: Verdana; font-size: 10pt;'>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si necesita realizar alguna consulta no responda a este e-mail. Por favor, acceda a Centro de Soporte
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;en la web <a href='https://www.diginova.es'>www.diginova.es</a>.<br /><br />
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recibe un cordial saludo,<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dpto. RMA
                </div>

                <br /><br /><br />";

        $cadena .= "</td>";
        $cadena .= "</rt>";
        $cadena .= "</table>";

        $cadena .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
        $cadena .= '<TBODY>';
        $cadena .= '<TR>';
        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" width=700>';
            $cadena .= '<TABLE style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: " cellSpacing=0 cellPadding=0 border=0>';
                $cadena .= '<TBODY>';
                $cadena .= '<TR style="BACKGROUND-COLOR: white">';
                        $cadena .= '<TD style="BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; COLOR: black; BORDER-BOTTOM-COLOR: ; BORDER-RIGHT-COLOR: ; BACKGROUND-COLOR: white" bgColor=white width=750 colSpan=4>';
                            $cadena .= '<A style="BORDER-TOP: 0px; BORDER-RIGHT: 0px; BORDER-BOTTOM: 0px; BORDER-LEFT: 0px" href="https://diginova.es/">';
                            $cadena .= '<IMG style="DISPLAY: block" border=0 alt=pedidos@diginova.es src="http://diginova.es/testmail2/img/diginovafootermail.jpg" width=750 height=143>';
                            $cadena .= '</A>';
                        $cadena .= '</TD>';
                    $cadena .= '</TR>';
                    $cadena .= '</TBODY>';
                $cadena .= '</TABLE>';
                $cadena .= '</TD>';
                $cadena .= '</TR>';
                $cadena .= '<TR>';
                    $cadena .= '<TD style="FONT-SIZE: 10px; BORDER-TOP-COLOR: ; BORDER-LEFT-COLOR: ; COLOR: gray; BORDER-BOTTOM-COLOR: ; TEXT-ALIGN: justify; BORDER-RIGHT-COLOR: " width=700 colSpan=8 style="font-size: 7pt; color:#000; padding-top: 5px;">';
                    $cadena .= 'Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener informaci&oacute;n confidencial sometida a secreto profesional. Si usted no es el destinatario final por favor elim&iacute;nelo e inf&oacute;rmenos por esta v&iacute;a. En cumplimiento de la Ley de Servicios de la Sociedad de la Informaci&oacute;n y de Comercio Electr&oacute;nico (LSSICE) y de la Ley Org&aacute;nica 15/1999 de Protecci&oacute;n de Datos de Car&aacute;cter Personal (LOPD), por los cuales se regulan las medidas de seguridad de los ficheros automatizados, le comunicamos que su direcci&oacute;n de correo electr&oacute;nico forma parte de la base de datos de Smarters Accesorios S.L. fichero que ha sido previamente registrado en la Agencia de Protecci&oacute;n de Datos y cuya finalidad es informarle de las novedades, noticias y promociones de Diginova. Es voluntad de Smarters Accesorios S.L evitar el env&iacute;o deliberado de correo no solicitado, por lo cual si no desea recibir m&aacute;s comunicaciones comerciales por nuestra parte, le rogamos nos lo indique a trav&eacute;s de este enlace: <A style="TEXT-DECORATION: none; COLOR: black" href="[unsubscribe_url_direct]">Cancelar Suscripci&oacute;n</A>. Tambi&eacute;n tiene vd. a su disposici&oacute;n los derechos de acceso, rectificaci&oacute;n y cancelaci&oacute;n que le otorga la legislaci&oacute;n correspondiente en esta materia. ';
        $cadena .= '</TD>';
        $cadena .= '</TR>';
        $cadena .= '</TBODY>';
        $cadena .= '</TABLE>';

        return $cadena;
    }

    function generateRandomString($length = 15) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function devolucionMail($ccodcl, $emailRepre, $emailCuerpo)
    {
        //$emailRepre = "programacion@diginova.es";
        require_once base_path().'/phpmailer/class.smtp.php';
        require_once base_path().'/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();
         
        //Le indicamos que el modo será SMTP    
        //$mail -> IsSMTP();     
         
         //Configuramos el Charset del mensaje               
        //$mail -> CharSet="ISO-8859-1"; 
        $mail -> CharSet="utf8"; 
         
        //Autenticacion Segura con ssl
        $mail -> SMTPSecure = 'ssl';

        //El servidor smtp, en nuestro caso usaremos el de gmail
        $mail -> Host = "mail.diginova.es";
         
        //El puerto, en gmail sería 465
        $mail -> Port = 25;
         
        //El email a través del cual enviaremos
        $mail -> Username = 'javimoya33@gmail.com';
         
        //Contraseña del email
        $mail -> Password = 'RGi20f8GyL3bi1qD';
         
        //Le indicamos que se requiere autenticacion
        $mail -> SMTPAuth = true;
         
        //Si responden el mensaje llegará a...
        $mail -> From = 'javimoya33@gmail.com';
         
        //Nombre que le indicará de donde viene el mensaje al destinatario
        $mail -> FromName = 'Diginova - RMA';
        
        $receptor = 'javimoya33@gmail.com';

        //if ($ccodcl == 2534) { $receptor = "programacion@diginova.es"; } // 1234

        //Email de destino 
        $mail -> AddAddress($receptor);
        //$mail -> AddAddress("programacion@diginova.es");

        //Lo mandaremos en HTML?
        $mail -> IsHTML(true);
         
        $mail -> Subject = "Diginova - Solicitud de RMA del cliente ".$ccodcl;
         
        //$mail -> Body = "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/xweb/images/logoempresa.jpg' alt='Diginova' /></a></p>";
        $mail -> Body = "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/img/mailbc13.jpg' alt='Diginova' /></a></p>";
        $mail -> Body .= "<br /><br />";
        $mail -> Body .= $emailCuerpo;


        $enviado = false;

        if(!$mail -> Send())
        {
            //echo "<br /><br />";
            //echo 'No se pudo enviar el mensaje.'.$mail -> ErrorInfo;
        }
        else
        {
            //echo "<br /><br />";
            //echo 'El mensaje se ha enviado correctamente.';
            $enviado = true;
        }

        return $enviado; 
    }

    function rmaCrear($ccodcl, $portes_cliente = 0, $recogida = 0, $portes_precio = 0)
    {
        $numRMA = $this->obtSiguienteRMA();

        DB::insert("INSERT INTO rma (numero, rcodcl, fecha, estado, portes_cliente, recogida, portes_precio) values ($numRMA, $ccodcl, SYSDATE(), 0, $portes_cliente, $recogida, $portes_precio)");

        $resultado = $numRMA;

        return $resultado;
    }

    function obtSiguienteRMA()
    {
        $anio = Date("Y");

        $arrRMAs = DB::select("SELECT numero FROM rma WHERE numero BETWEEN ".$anio."000000 and ".$anio."999999 ORDER BY numero DESC LIMIT 1");

        $siguiente = $anio."000001";

        if (count($arrRMAs) == 0)
        {
            $siguiente = $anio."000001";
        }
        else
        {
            foreach ($arrRMAs as $arrRMA)
            {
                $ultimo = $arrRMA->numero;
                $siguiente = $ultimo + 1;
            }
        }

        return $siguiente;
    }

    function articulosRMA($articulo)
    {
        $ccodcl = session('usuario')->uData->codigo;
        $articulo->esOcasion = false;

        $afamilia = $articulo->afamilia;

        if ( ($afamilia >= 501 && $afamilia <= 572) && $afamilia != 561)
        {
            $articulo->esOcasion = true;
        }


        $acodar = $articulo->acodar;
        $adescr = $articulo->adescr;
        $ffecha = $articulo->ffecha;
        $fdoc = $articulo->fdoc;        
        $nnumser = $articulo->nnumser;
        $aresnum4 = $articulo->aresnum4;
        $fforpa = $articulo->fforpa;
        $afamilia = $articulo->afamilia;

        //$acodarAux = strtolower( str_replace("/", "barder", $articulo->acodar) );
        //$articulo->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

        /*if (!is_array(@getimagesize($articulo->urlfoto))) 
        {
            $articulo->urlfoto = "https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg";
        } */

        $articulo->urlfoto = "https://diginova.es/xweb/public/articulos/".$this -> obtImagenArt($articulo->adescr);  // 12345

        if (!is_array(@getimagesize($articulo->urlfoto))) 
        {
            $articulo->urlfoto = "https://diginova.es/xweb/public/articulos/nofoto.jpg";
        }

        $articulo->ffechatime = strtotime($ffecha);
        $articulo->fechaF = $this -> formatearFecha($ffecha);

        $articulo->fdocF = $this -> documentoFormatear($fdoc);

        // Días entre la fecha de compra y hoy
        $now = time(); // or your date as well
        $ffechaTime = strtotime($articulo->ffechatime);
        $datediff = $now - $ffechaTime;
        $articulo->diasDesdeCompra = round($datediff / (60 * 60 * 24));


        // DC solo aparece para los tramos de familias de pc, portátil y monitor. Más la familia 563
        // No mostrar DC al cliente 1959
        // No mostrar si la fecha de compra fue hace más de un mes  (2 meses para Technoocasión)
        $diasLimite = 32;
        $ctipocli = session("usuario")->uData->ctipocli;

        if ($ctipocli == 23 || $ctipocli == 24) 
        { 
            $diasLimite = 70; 
        }


        if (($articulo->diasDesdeCompra < $diasLimite || $fforpa == 92))
        {
            if ( (($afamilia >= 501 && $afamilia <= 505) || ($afamilia >= 521 && $afamilia <= 529) || ($afamilia >= 551 && $afamilia <= 556) || $afamilia == 563) )
            {
                $articulo->nolohevendido = true;
            }
            else
            {
                $articulo->nolohevendido = false;
            }
        }
        else
        {
            $articulo->nolohevendido = false;
        }
    }



    function devolucion()
    {
        $this->init();
        $this->eliminarDevolucion();
        $this->anadirSolicitud();

        $ccodcl = session('usuario')->uData->codigo;

        /*require_once base_path().'/fpdf/fpdf.php';
        require_once base_path().'/fpdf/fpdfParte.php';
 
        $resLineas = DB::select("
                                SELECT r.*, a.nombre as 'averia_nombre' 
                                FROM rma_linea r, rma_averia a 
                                WHERE r.raveria = a.id AND rma = 2021003034");

        // Creaci&oacute;n del objeto de la clase heredada
        $pdf = new PDF_Code128Parte();
        $pdf -> AliasNbPages();
        $pdf -> AddPage();
        $pdf -> SetFont('Arial', '', 12);                 
        $pdf -> DatosCabecera($ccodcl, 'Javi', 'Plza. Molinos', 21007, 'Huelva', '490898989A', '12-04-2022', '20200000022');
        $pdf -> EscribirSintomas($resLineas);
 
        $pdf -> Condiciones();
        $nomPDF = "pdf_"."2021003034".".pdf";
        $pdf -> Output(base_path()."/resources/pdfrma/".$nomPDF);*/

        $anio = date("Y") - 3;
        $mes = date("m");
        $dia = date("d");
        $fechaHace3Anios = $anio.'-'.$mes.'-'.$dia;

        $arrArticulosCompradosTotal = array();
        $arrArticulosCompradosSinAbonar = array();
        $arrArticulosCompradosAccesorios = array();

        $hayAutorizado = false;
        $hayNoAutorizado = false;

        $arrArtsDevolucion = array();

        if ($ccodcl > 0)
        { 

            $lim = 15;
            $devolbuscar = "";
           

            if (Request::isMethod('post')) 
            {
                // Si han seleccionado límite
                    if (Request::has('devlim'))
                    {
                        $lim = Request::input('devlim');
                    }

                // Si han buscado por artículo
                    if (Request::has('devolbuscar'))
                    {
                        $devolbuscar = Request::input('devolbuscar');                            
                    }      
            }



            $arrYaEnDevolucion = DB::select("
                SELECT l.rma, l.rnumser
                FROM rma r, rma_linea l
                WHERE r.numero = l.rma AND r.rcodcl = $ccodcl AND r.estado NOT IN (1, 3)");

            $busquedaSinResultados = false;




            if ($devolbuscar != "")
            {
                // Buscar por nº de serie
                    $arrArticulosCompradosTotal = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, afamilia, fforpa, aresnum4
                        FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                        WHERE fcodcl = ccodcl AND lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  AND lalba = balba 
                        AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar 
                        AND lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50, 561) AND ( 
                            acodar IN ('6920LENL4401GBTAR', '6910LENTIM72E3GTAR', '6910LENTIM72E3GBTA') 
                        OR ( afamilia BETWEEN 501 AND 567 AND  aresnum4 NOT IN (28, 29, 30) )  ) 
                        AND nnumser NOT IN ('013309001808252')
                       AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) 
                        AND ffecha > '$fechaHace3Anios'
                        AND nnumser = '$devolbuscar' 
                        ORDER BY lfecha DESC
                        ");

                if ( count($arrArticulosCompradosTotal) == 0 )
                {
                    // Buscar por referencia
                        $arrArticulosCompradosTotal = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, afamilia, fforpa, aresnum4
                            FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                            WHERE fcodcl = ccodcl AND lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  AND lalba = balba 
                            AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar 
                            AND lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50, 561) AND ( 
                                acodar IN ('6920LENL4401GBTAR', '6910LENTIM72E3GTAR', '6910LENTIM72E3GBTA') 
                            OR ( afamilia BETWEEN 501 AND 567 AND  aresnum4 NOT IN (28, 29, 30) )  ) 
                            AND nnumser NOT IN ('013309001808252')
                           AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) 
                            AND ffecha > '$fechaHace3Anios'
                            AND acodar = '$devolbuscar' 
                            ORDER BY lfecha DESC
                            ");
                }


                // Si la búsqueda no produjo resultados
                if ( count($arrArticulosCompradosTotal) == 0 )
                {
                    $busquedaSinResultados = true;
                }
            }


            if ( count($arrArticulosCompradosTotal) == 0 )
            {
                $arrArticulosCompradosTotal = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, afamilia, fforpa, aresnum4
                    FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                    WHERE fcodcl = ccodcl AND lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  AND lalba = balba 
                    AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar 
                    AND lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50, 561) AND ( 
                        acodar IN ('6920LENL4401GBTAR', '6910LENTIM72E3GTAR', '6910LENTIM72E3GBTA') 
                    OR ( afamilia BETWEEN 501 AND 567 AND  aresnum4 NOT IN (28, 29, 30) )  ) 
                    AND nnumser NOT IN ('013309001808252')
                   AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) 
                    AND ffecha > '$fechaHace3Anios'
                    ORDER BY lfecha DESC
                    LIMIT $lim");
            } 

            /*$arrArticulosAbonadosTotal = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, afamilia, fforpa, aresnum4
                FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                WHERE fcodcl = ccodcl AND lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  and lalba = balba AND bfactura = fdoc AND ntipmov = 'E' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar AND lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50) AND afamilia BETWEEN 501 AND 567
                    AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) AND nnumser <> '2CE3290BWL'
                ORDER BY lfecha desc");*/

            foreach ($arrArticulosCompradosTotal as $arrArticuloCompradoTotal)
            {
                $this->articulosRMA($arrArticuloCompradoTotal);
                $articuloEncontrado = false;

                /*foreach ($arrArticulosAbonadosTotal as $arrArticuloAbonadoTotal) 
                {
                    if ($arrArticuloCompradoTotal->acodar == $arrArticuloAbonadoTotal->acodar && $arrArticuloCompradoTotal->nnumser == $arrArticuloAbonadoTotal->nnumser)
                    {
                        $articuloEncontrado = true;
                        break;
                    }
                }*/

                // Comprobar si ya está en un parte RMA activo
                $repetido = false; $i = 0;

                while(!$repetido && $i < count($arrYaEnDevolucion))
                {
                    if ($arrArticuloCompradoTotal->nnumser == $arrYaEnDevolucion[$i]->rnumser)
                    {
                        $repetido = true;
                    }

                    $i++;
                }

                //if (!$articuloEncontrado)
                if (true)
                {
                    array_push($arrArticulosCompradosSinAbonar, $arrArticuloCompradoTotal);
                }

                // Accesorios:
                $arrArticulosCompradosAccesorios = DB::select("
                    SELECT acodar, adescr, fcodcl, ffecha, fdoc, '' AS 'nnumser', ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                    FROM fclia l, fccba b, fcfac f, fcart a, fccli c
                    WHERE fcodcl = ccodcl and acodar = lcodar  and lalba = balba AND bfactura = fdoc  AND lcodcl = ccodcl 
                          AND lcodcl = $ccodcl AND afamilia NOT IN (0, 5, 10, 11, 12, 50) AND 
                            ( (afamilia NOT BETWEEN 501 AND 567) OR (afamilia = 561 AND (adescr LIKE 'Teclado%' or adescr like 'Rat%' or adescr like '%DULO%' or adescr like '%FICA%') )  )
                          AND lfecha  >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                    ORDER BY lfecha desc
                    LIMIT $lim");

                foreach ($arrArticulosCompradosAccesorios as $arrArticuloCompradoAccesorio)
                {
                    $this->articulosRMA($arrArticuloCompradoAccesorio);
                }

                $arrArticulosBuscados = array();

                if (Request::isMethod('post')) 
                {
                    if (Request::has('devolbuscar'))
                    {
                        $cadena = Request::has('devolbuscar');

                        // Buscar por nº de serie
                        $arrArticulosBuscados = DB::select("
                            SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, '' as 'fnomcl', afamilia, fforpa, aresnum4  
                            FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                            WHERE nnumser = '$cadena' AND fcodcl = ccodcl and lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  and lalba = balba AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar and lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50) AND afamilia BETWEEN 501 AND 567
                                AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) AND NOT(lcodcl = 6550 AND nnumser = '3RB4BW1') and aresnum4 not in (28, 29, 30)");

                        if ( count($arrArticulosBuscados) > 0 )
                        {
                            $articuloAux = $arrArticulosBuscados[0];
                        }
                        else
                        {
                            // Si no lo encuentro por n serie, busco por referencia  (y que tengan nº de serie)
                            $arrArticulosBuscados = DB::select("
                                SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                                FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                                WHERE acodar = '$cadena' AND fcodcl = ccodcl and lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  and lalba = balba AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar and lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50) AND NOT(lcodcl = 6550 AND nnumser = '3RB4BW1') and ( acodar in ('6910HPM600G21TAR', '6910LENTIM72E3GBTA') or aresnum4 not in (28, 29, 30) )
                                    AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl)");

                            if ( count($arrArticulosBuscados) > 0 )
                            {
                                $articuloAux = $arrArticulosBuscados[0];
                            }
                            else
                            {
                                // Si no lo encuentro, busco por referencia (sin nº de serie)
                                $arrArticulosBuscados = DB::select("
                                    SELECT acodar, adescr, fcodcl, ffecha, fdoc, '' as nnumser, ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                                    FROM fclia l, fccba b, fcfac f, fcart a, fccli c
                                    WHERE acodar = '$cadena' AND fcodcl = ccodcl and lcodcl = ccodcl AND acodar = lcodar and lalba = balba AND bfactura = fdoc and lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50)  and ( acodar IN ('6910HPM600G21TAR', '6920LENL4401GBTAR', '6910LENTIM72E3GTAR') or aresnum4 not in (28, 29, 30))");

                                if ( count($arrArticulosBuscados) == 0 )
                                {
                                    //$articuloAux = $arrArticulosBuscados[0];
                                } 
                            }
                        }
                    }
                }
            }

            if (Request::has('solicitarautorizacion'))
            {
                $tipo = 'DC';
                $acodar = Request::input('solacodar');
                $nnumser = Request::input('solnumser');
                $fdoc = Request::input('fdoc');
                $idUsuario = 0;

                DB::insert("INSERT INTO rma_autorizacion (id, idusuario, ccodcl, tipo, acodar, nnumser, estado, fdoc, solicitadaweb, fecha_solicitada, fecha_autorizada, fecha_expiracion, fecha_rechazo)
                            VALUES (NULL, $idUsuario, $ccodcl, '$tipo', '$acodar', '$nnumser', 0, $fdoc, 1, SYSDATE(), '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00')");

                $this->devolAdd(0);

                $this->autorizacionMail($ccodcl, 'programacion@diginova.es', $acodar, $nnumser, $fdoc);

                $msjEnvioAutorizacion = "<br /><span style='font-weight: bold; font-size: 11pt; margin-bottom: 25px;'>SOLICITUD DE DEVOLUCIÓN <span style='text-decoration: underline;'>PENDIENTE DE AUTORIZACIÓN POR DIGINOVA</span></span> <br /><br/>";
            }

            $arrArtsDevolucion = DB::select("
                    SELECT temp.*, fca.AFAMILIA, fac.FFORPA, fca.ADESCR, fac.ffecha
                    FROM rmatemp AS temp, fcart AS fca, fcfac AS fac
                    WHERE temp.rcodar = fca.ACODAR
                    AND temp.rfac = fac.FDOC
                    AND temp.rcodcl = $ccodcl
                    ORDER BY temp.rfecha asc");

            foreach ($arrArtsDevolucion as $arrArtDevolucion)
            {
                //$acodarAux = strtolower(str_replace("/", "barder", $arrArtDevolucion->rcodar)); 
                //$arrArtDevolucion->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

                $arrArtDevolucion->urlfoto = "https://diginova.es/xweb/public/articulos/".$this -> obtImagenArt($arrArtDevolucion->ADESCR);  // 12345
            }

            // Comprobar si hay al menos un artículo autorizado
            $hayAutorizado = false;
            $hayNoAutorizado = false;

            if (count($arrArtsDevolucion) > 0)
            {
                foreach ($arrArtsDevolucion as $artDev) 
                {
                    if ($artDev->rautorizado == 1)
                    {
                        $hayAutorizado = true;
                    }

                    if ($artDev->rautorizado == 0)
                    {
                        $hayNoAutorizado = true;
                    }
                }
            }
        }

        return View('devolucion')->with("arrArticulosCompradosSinAbonar", $arrArticulosCompradosSinAbonar)
                                 ->with("arrArticulosCompradosAccesorios", $arrArticulosCompradosAccesorios)
                                 ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                 ->with("hayAutorizado", $hayAutorizado)
                                 ->with("lim", $lim)
                                 ->with("busquedaSinResultados", $busquedaSinResultados)
                                 ->with("hayNoAutorizado", $hayNoAutorizado);
    }



    function devolucion2()
    {
        $this->init();
        $this->eliminarDevolucion();
        $this->anadirSolicitud();

        $ccodcl = session('usuario')->uData->codigo;

        /*require_once base_path().'/fpdf/fpdf.php';
        require_once base_path().'/fpdf/fpdfParte.php';
 
        $resLineas = DB::select("
                                SELECT r.*, a.nombre as 'averia_nombre' 
                                FROM rma_linea r, rma_averia a 
                                WHERE r.raveria = a.id AND rma = 2021003034");

        // Creaci&oacute;n del objeto de la clase heredada
        $pdf = new PDF_Code128Parte();
        $pdf -> AliasNbPages();
        $pdf -> AddPage();
        $pdf -> SetFont('Arial', '', 12);                 
        $pdf -> DatosCabecera($ccodcl, 'Javi', 'Plza. Molinos', 21007, 'Huelva', '490898989A', '12-04-2022', '20200000022');
        $pdf -> EscribirSintomas($resLineas);
 
        $pdf -> Condiciones();
        $nomPDF = "pdf_"."2021003034".".pdf";
        $pdf -> Output(base_path()."/resources/pdfrma/".$nomPDF);*/

        $anio = date("Y") - 3;
        $mes = date("m");
        $dia = date("d");
        $fechaHace3Anios = $anio.'-'.$mes.'-'.$dia;

        $arrArticulosCompradosTotal = array();
        $arrArticulosCompradosSinAbonar = array();
        $arrArticulosCompradosAccesorios = array();

        $hayAutorizado = false;
        $hayNoAutorizado = false;

        $arrArtsDevolucion = array();

        if ($ccodcl > 0)
        { 
            $arrYaEnDevolucion = DB::select("
                SELECT l.rma, l.rnumser
                FROM rma r, rma_linea l
                WHERE r.numero = l.rma AND r.rcodcl = $ccodcl AND r.estado NOT IN (1, 3)");

            $arrArticulosCompradosTotal = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, afamilia, fforpa, aresnum4
                FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                WHERE fcodcl = ccodcl AND lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  AND lalba = balba 
                AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar 
                AND lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50, 561) AND ( 
                    acodar IN ('6920LENL4401GBTAR', '6910LENTIM72E3GTAR', '6910LENTIM72E3GBTA') 
                OR ( afamilia BETWEEN 501 AND 567 AND  aresnum4 NOT IN (28, 29, 30) )  ) 
                AND nnumser NOT IN ('013309001808252')
               AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) 
                AND ffecha > '$fechaHace3Anios'
                ORDER BY lfecha DESC");

            $arrArticulosAbonadosTotal = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, afamilia, fforpa, aresnum4
                FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                WHERE fcodcl = ccodcl AND lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  and lalba = balba AND bfactura = fdoc AND ntipmov = 'E' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar AND lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50) AND afamilia BETWEEN 501 AND 567
                    AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) AND nnumser <> '2CE3290BWL'
                ORDER BY lfecha desc");

            foreach ($arrArticulosCompradosTotal as $arrArticuloCompradoTotal)
            {
                $this->articulosRMA($arrArticuloCompradoTotal);
                $articuloEncontrado = false;

                foreach ($arrArticulosAbonadosTotal as $arrArticuloAbonadoTotal) 
                {
                    if ($arrArticuloCompradoTotal->acodar == $arrArticuloAbonadoTotal->acodar && $arrArticuloCompradoTotal->nnumser == $arrArticuloAbonadoTotal->nnumser)
                    {
                        $articuloEncontrado = true;
                        break;
                    }
                }

                // Comprobar si ya está en un parte RMA activo
                $repetido = false; $i = 0;

                while(!$repetido && $i < count($arrYaEnDevolucion))
                {
                    if ($arrArticuloCompradoTotal->nnumser == $arrYaEnDevolucion[$i]->rnumser)
                    {
                        $repetido = true;
                    }

                    $i++;
                }

                if (!$articuloEncontrado)
                {
                    array_push($arrArticulosCompradosSinAbonar, $arrArticuloCompradoTotal);
                }

                // Accesorios:
                $arrArticulosCompradosAccesorios = DB::select("
                    SELECT acodar, adescr, fcodcl, ffecha, fdoc, '' AS 'nnumser', ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                    FROM fclia l, fccba b, fcfac f, fcart a, fccli c
                    WHERE fcodcl = ccodcl and acodar = lcodar  and lalba = balba AND bfactura = fdoc  AND lcodcl = ccodcl 
                          AND lcodcl = $ccodcl AND afamilia NOT IN (0, 5, 10, 11, 12, 50) AND 
                            ( (afamilia NOT BETWEEN 501 AND 567) OR (afamilia = 561 AND (adescr LIKE 'Teclado%' or adescr like 'Rat%' or adescr like '%DULO%' or adescr like '%FICA%') )  )
                          AND lfecha  >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                    ORDER BY lfecha desc
                    LIMIT 30");

                foreach ($arrArticulosCompradosAccesorios as $arrArticuloCompradoAccesorio)
                {
                    $this->articulosRMA($arrArticuloCompradoAccesorio);
                }

                $arrArticulosBuscados = array();

                if (Request::isMethod('post')) 
                {
                    if (Request::has('devolbuscar'))
                    {
                        $cadena = Request::has('devolbuscar');

                        // Buscar por nº de serie
                        $arrArticulosBuscados = DB::select("
                            SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, '' as 'fnomcl', afamilia, fforpa, aresnum4  
                            FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                            WHERE nnumser = '$cadena' AND fcodcl = ccodcl and lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  and lalba = balba AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar and lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50) AND afamilia BETWEEN 501 AND 567
                                AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl) AND NOT(lcodcl = 6550 AND nnumser = '3RB4BW1') and aresnum4 not in (28, 29, 30)");

                        if ( count($arrArticulosBuscados) > 0 )
                        {
                            $articuloAux = $arrArticulosBuscados[0];
                        }
                        else
                        {
                            // Si no lo encuentro por n serie, busco por referencia  (y que tengan nº de serie)
                            $arrArticulosBuscados = DB::select("
                                SELECT acodar, adescr, fcodcl, ffecha, fdoc, nnumser, ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                                FROM fclia l, fccba b, fcfac f, fcart a, fcnsr n, fccli c
                                WHERE acodar = '$cadena' AND fcodcl = ccodcl and lcodcl = ccodcl AND acodar = lcodar AND acodar = ncodar  and lalba = balba AND bfactura = fdoc AND ntipmov = 'S' AND ntipdoc = 'A' AND ndoc = balba AND ncodar = acodar and lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50) AND NOT(lcodcl = 6550 AND nnumser = '3RB4BW1') and ( acodar in ('6910HPM600G21TAR', '6910LENTIM72E3GBTA') or aresnum4 not in (28, 29, 30) )
                                    AND nnumser NOT IN (SELECT rnumser FROM rmatemp WHERE rcodcl = $ccodcl)");

                            if ( count($arrArticulosBuscados) > 0 )
                            {
                                $articuloAux = $arrArticulosBuscados[0];
                            }
                            else
                            {
                                // Si no lo encuentro, busco por referencia (sin nº de serie)
                                $arrArticulosBuscados = DB::select("
                                    SELECT acodar, adescr, fcodcl, ffecha, fdoc, '' as nnumser, ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                                    FROM fclia l, fccba b, fcfac f, fcart a, fccli c
                                    WHERE acodar = '$cadena' AND fcodcl = ccodcl and lcodcl = ccodcl AND acodar = lcodar and lalba = balba AND bfactura = fdoc and lcodcl = $ccodcl AND afamilia NOT IN (5, 10, 11, 12, 50)  and ( acodar IN ('6910HPM600G21TAR', '6920LENL4401GBTAR', '6910LENTIM72E3GTAR') or aresnum4 not in (28, 29, 30))");

                                if ( count($arrArticulosBuscados) == 0 )
                                {
                                    //$articuloAux = $arrArticulosBuscados[0];
                                } 
                            }
                        }
                    }
                }
            }

            if (Request::has('solicitarautorizacion'))
            {
                $tipo = 'DC';
                $acodar = Request::input('solacodar');
                $nnumser = Request::input('solnumser');
                $fdoc = Request::input('fdoc');
                $idUsuario = 0;

                DB::insert("INSERT INTO rma_autorizacion (id, idusuario, ccodcl, tipo, acodar, nnumser, estado, fdoc, solicitadaweb, fecha_solicitada, fecha_autorizada, fecha_expiracion, fecha_rechazo)
                            VALUES (NULL, $idUsuario, $ccodcl, '$tipo', '$acodar', '$nnumser', 0, $fdoc, 1, SYSDATE(), '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00')");

                $this->devolAdd(0);

                $this->autorizacionMail($ccodcl, 'javimoya33@gmail.com', $acodar, $nnumser, $fdoc);

                $msjEnvioAutorizacion = "<br /><span style='font-weight: bold; font-size: 11pt; margin-bottom: 25px;'>SOLICITUD DE DEVOLUCIÓN <span style='text-decoration: underline;'>PENDIENTE DE AUTORIZACIÓN POR DIGINOVA</span></span> <br /><br/>";
            }

            $arrArtsDevolucion = DB::select("
                    SELECT temp.*, fca.AFAMILIA, fac.FFORPA
                    FROM rmatemp AS temp, fcart AS fca, fcfac AS fac
                    WHERE temp.rcodar = fca.ACODAR
                    AND temp.rfac = fac.FDOC
                    AND temp.rcodcl = $ccodcl
                    ORDER BY temp.rfecha asc");

            foreach ($arrArtsDevolucion as $arrArtDevolucion)
            {
                $acodarAux = strtolower(str_replace("/", "barder", $arrArtDevolucion->rcodar));
                $arrArtDevolucion->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";
            }

            // Comprobar si hay al menos un artículo autorizado
            $hayAutorizado = false;
            $hayNoAutorizado = false;

            if (count($arrArtsDevolucion) > 0)
            {
                foreach ($arrArtsDevolucion as $artDev) 
                {
                    if ($artDev->rautorizado == 1)
                    {
                        $hayAutorizado = true;
                    }

                    if ($artDev->rautorizado == 0)
                    {
                        $hayNoAutorizado = true;
                    }
                }
            }
        }

        return View('devolucion2')->with("arrArticulosCompradosSinAbonar", $arrArticulosCompradosSinAbonar)
                                 ->with("arrArticulosCompradosAccesorios", $arrArticulosCompradosAccesorios)
                                 ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                 ->with("hayAutorizado", $hayAutorizado)
                                 ->with("hayNoAutorizado", $hayNoAutorizado);
    }


    function devolAdd($rautorizado = 1)
    {
        if (Request::isMethod('post'))
        {
            $ccodcl = Request::input('ccodcl');
            $acodar = Request::input('acodar');
            $adescr = Request::input('adescr');
            $fdoc = Request::input('fdoc');
            $nnumser = Request::input('nnumser');  
            //$raveria = $_POST["devolSelAveria"]; 
            $robservaciones = Request::input('devolObs'); 
            $categoria = 2; if (Request::input('devolSelAveria')) { Request::input('categoria'); }
            $raveria = 0; if (Request::input('devolSelAveria')) { $raveria = Request::input('devolSelAveria'); }
            $rtipo = ""; if (Request::input('tiporma')) { $rtipo = Request::input('tiporma'); }
            $unidades = 1; if (Request::input('unidades')) { $unidades = Request::input('unidades'); }
            $pieza = 0; if (Request::input('pieza')) { $pieza = Request::input('pieza'); if ($pieza == 1) { $categoria = 6; } }
            $rreparar = 0; if (Request::input('rreparar')) { $rreparar = Request::input('rreparar'); }
            $devol = 0; if (Request::input('devol')) { $devol = Request::input('devol'); }
            $observacionesPrefijo = "";

            if ($pieza == 1) { $observacionesPrefijo .= "(Solo pieza) "; }

            if ($pieza != 1)
            {
                if ($rreparar == 1) { $observacionesPrefijo .= "(Reparar) "; }
                if ($rreparar == 2) { $observacionesPrefijo .= "(Abonar) "; }
            }
            
            if ($rreparar == 2) { $devol = 0; }

            if ($devol == 1) { $observacionesPrefijo .= "(Enviar en próximo pedido) "; }
            if ($devol == 2) { $observacionesPrefijo .= "(Enviar directamente) "; }

            //$observacionesPrefijo = utf8_decode($observacionesPrefijo);

            $robservaciones = $observacionesPrefijo.$robservaciones;

            // === Foto ===
            $diaActual = date("d");
            $mesActual = date("m");
            $anioActual = date("Y");
            $horaActual = date("H");
            $minutosActual = date("i");
            $segundosActual = date("s");

            /*if(($_FILES['foto']['type'] == 'image/gif') || ($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/GIF') || ($_FILES['foto']['type'] == 'image/PNG') || ($_FILES['foto']['type'] == 'image/JPEG'))
            {
                if (($_FILES["foto"]["size"] < 20000000))
                {
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], '/var/www/virtual/diginova.es/htdocs/xweb/imgclientes/img_'.$anioActual.'_'.$mesActual.'_'.$diaActual.'_'.$horaActual.'_'.$minutosActual.'_'.$segundosActual.'.png'))
                    {
                        $imagenSubida = true;
                    }
                }
            }*/

            $foto = "";

            /*if ($imagenSubida) 
            {
                $foto = 'img_'.$anioActual.'_'.$mesActual.'_'.$diaActual.'_'.$horaActual.'_'.$minutosActual.'_'.$segundosActual.'.png';
            }*/

            DB::insert("INSERT INTO rmatemp (id, rcodcl, rautorizado, rcodar, rdescr, rnumser, rfac, raveria, robservaciones, rfecha, rcategoria, rtipo, runidades, rsolopieza, rreparar, renviopedido, rfoto)
                        VALUES (NULL, $ccodcl, $rautorizado, '$acodar', '$adescr', '$nnumser', '$fdoc', $raveria, '$robservaciones', sysdate(), $categoria, '$rtipo', $unidades, $pieza, $rreparar, $devol, '$foto')");
        }
    }

    function autorizacionMail($ccodcl, $emailRepre, $acodar, $nnumser, $tipoRMA)
    {
        //$emailRepre = "programacion@diginova.es";

        // Cuando el cliente pulsa SOLICITAR AUTORIZACIÓN se envía este email
 
        require_once base_path().'/phpmailer/class.smtp.php';
        require_once base_path().'/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();
         
        //Le indicamos que el modo será SMTP    
        //$mail -> IsSMTP();     
         
         //Configuramos el Charset del mensaje               
        //$mail -> CharSet="ISO-8859-1"; 
        $mail -> CharSet="utf8"; 
         
        //Autenticacion Segura con ssl
        $mail -> SMTPSecure = 'ssl';

        //El servidor smtp, en nuestro caso usaremos el de gmail
        $mail -> Host = "mail.diginova.es";
         
        //El puerto, en gmail sería 465
        $mail -> Port = 25;
         
        //El email a través del cual enviaremos
        $mail -> Username = 'javimoya33@gmail.com';
         
        //Contraseña del email
        $mail -> Password = 'RGi20f8GyL3bi1qD';
         
        //Le indicamos que se requiere autenticacion
        $mail -> SMTPAuth = true;
         
        //Si responden el mensaje llegará a...
        $mail -> From = 'javimoya33@gmail.com';
         
        //Nombre que le indicará de donde viene el mensaje al destinatario
        $mail -> FromName = 'Diginova - RMA';
        
        //$receptor = $emailRepre;
        $receptor = 'javimoya33@gmail.com';

        //if ($ccodcl == 2534) { $receptor = "programacion@diginova.es"; } // 1234

        //Email de destino 
        $mail -> AddAddress($receptor);
        //$mail -> AddAddress("programacion@diginova.es"); // 1234

        //Lo mandaremos en HTML?
        $mail -> IsHTML(true);
         
        $mail -> Subject = "Solicitud de autorización RMA. Cliente ".$ccodcl;
         
        //$mail -> Body = "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/xweb/images/logoempresa.jpg' alt='Diginova' /></a></p>";
        $mail -> Body = "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/img/mailbc13.jpg' alt='Diginova' /></a></p>";
        $mail -> Body .= "<br /><div style='margin-left: 20px;'>";
        $mail -> Body .= "El cliente <span style='color: #5d7ea4; font-weight: bold;'>$ccodcl</span> solicita autorización para devolución tipo <span style='color: #5d7ea4; font-weight: bold;'>$tipoRMA</span>: <br /><br />";
        $mail -> Body .= "Referencia: <span style='color: #5d7ea4; font-weight: bold;'>$acodar</span> <br />";
        $mail -> Body .= "Nº de serie: <span style='color: #5d7ea4; font-weight: bold;'>$nnumser</span> <br />";
        $mail -> Body .= "</div>";


        $enviado = false;

        if(!$mail -> Send())
        {
            //echo "<br /><br />";
            //echo 'No se pudo enviar el mensaje.'.$mail -> ErrorInfo;
        }
        else
        {
            //echo "<br /><br />";
            //echo 'El mensaje se ha enviado correctamente.';
            $enviado = true;
        }

        return $enviado; 
    }

    function solicitarMayorMail($ccodcl, $cliente)
    {
        //$emailRepre = "programacion@diginova.es";

        // Cuando el cliente pulsa SOLICITAR AUTORIZACIÓN se envía este email
 
        require_once base_path().'/phpmailer/class.smtp.php';
        require_once base_path().'/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();
         
        //Le indicamos que el modo será SMTP    
        //$mail -> IsSMTP();     
         
         //Configuramos el Charset del mensaje               
        //$mail -> CharSet="ISO-8859-1"; 
        $mail -> CharSet="utf8"; 
         
        //Autenticacion Segura con ssl
        $mail -> SMTPSecure = 'ssl';

        //El servidor smtp, en nuestro caso usaremos el de gmail
        $mail -> Host = "mail.diginova.es";
         
        //El puerto, en gmail sería 465
        $mail -> Port = 25;
         
        //El email a través del cual enviaremos
        $mail -> Username = 'javimoya33@gmail.com';
         
        //Contraseña del email
        $mail -> Password = 'RGi20f8GyL3bi1qD';
         
        //Le indicamos que se requiere autenticacion
        $mail -> SMTPAuth = true;
         
        //Si responden el mensaje llegará a...
        $mail -> From = 'javimoya33@gmail.com';
         
        //Nombre que le indicará de donde viene el mensaje al destinatario
        $mail -> FromName = 'Diginova - RMA';
        
        //$receptor = $emailRepre;
        $receptor = 'javimoya33@gmail.com';
        //$receptor = 'contabilidad@diginova.es';

        //if ($ccodcl == 2534) { $receptor = "programacion@diginova.es"; } // 1234

        //Email de destino 
        $mail -> AddAddress($receptor);
        //$mail -> AddAddress("programacion@diginova.es"); // 1234

        //Lo mandaremos en HTML?
        $mail -> IsHTML(true);
         
        $mail -> Subject = "Solicitud Mayor de la cuenta del Cliente ".$ccodcl;
         
        //$mail -> Body = "<p><a href='http://www.diginova.es'><img src='http://www.diginova.es/xweb/images/logoempresa.jpg' alt='Diginova' /></a></p>";
        $mail -> Body = "<p>El cliente nº ".$ccodcl.", y de nombre ".$cliente." ha solicitado 'Mayor de mi cuenta' desde web</p>";

        $enviado = false;

        if(!$mail -> Send())
        {
            //echo "<br /><br />";
            //echo 'No se pudo enviar el mensaje.'.$mail -> ErrorInfo;
        }
        else
        {
            //echo "<br /><br />";
            //echo 'El mensaje se ha enviado correctamente.';
            $enviado = true;
        }

        return $enviado; 
    }

    function articulosDevolucionesAccesorios()
    {
        $ccodcl = session('usuario')->uData->codigo;

        $arrArticsDevAccesorios = array();

        if ($ccodcl > 0)
        {
            $arrArticsDevAccesorios = DB::select("SELECT acodar, adescr, fcodcl, ffecha, fdoc, '' AS 'nnumser', ctipocli, fnomcl, afamilia, fforpa, aresnum4  
                FROM fclia l, fccba b, fcfac f, fcart a, fccli c
                WHERE fcodcl = ccodcl and acodar = lcodar  and lalba = balba AND bfactura = fdoc  AND lcodcl = ccodcl 
                      AND lcodcl = $ccodcl AND afamilia NOT IN (0, 5, 10, 11, 12, 50) AND 
                        ( (afamilia NOT BETWEEN 501 AND 567) OR (afamilia = 561 AND (adescr LIKE 'Teclado%' or adescr like 'Rat%' or adescr like '%DULO%' or adescr like '%FICA%') )  )
                      AND lfecha  >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                ORDER BY lfecha desc
                LIMIT 30");

            foreach ($arrArticsDevAccesorios as $arrArt)
            {
                $arrArt->esOcasion = false;
                $afamilia = $arrArt->afamilia;

                if (($afamilia >= 501 && $afamilia <= 572) && $afamilia != 561)
                {
                    $arrArt->esOcasion = true;
                }

                $acodarAux = strtolower(str_replace("/", "barder", $arrArt->acodar));
                $arrArt->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

                if (!is_array(@getimagesize($arrArt->urlfoto))) 
                {
                    $arrArt->urlfoto = "https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg";
                }

                $ffecha = strtotime($arrArt->ffecha);
                $arrArt->fechaF = date('Y-m-d H:i:s', $ffecha);
            }
        }

        return $arrArticsDevAccesorios;
    }

    function obtCantidadesDisponibles($ccodcl, $acodar)
    {
        // Cantidades disponibles:  cantidades que tiene en plazo menos las cantidades que ya ha devuelto durante el plazo
        $disponibles = 0;

        // --- Cantidades en plazo ---
        $enplazo = 0;

        $arrCantidades = DB::select("SELECT sum(lcanti) AS 'enplazo' FROM  fclia WHERE lcodar = '$acodar' AND lcodcl = $ccodcl AND lfecha >= DATE_SUB(NOW(), INTERVAL 2 YEAR)");
        foreach ($arrCantidades as $arrCantidad)
        {
            $enplazo = $arrCantidad->enplazo;
        }

        //  --- Cantidades ya devueltas  ---
            $devueltas = 0;
/*
            if ($enplazo > 0)
            {
                // Cantidades devueltas
                $sql = "SELECT SUM(lcanti) as 'devueltas'
                        FROM fclia, fccba, fcfac
                        WHERE lalba = balba AND bfactura = fdoc AND fbastot < 0 AND lcodar = '$acodar' 
                            AND lfecha  >= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND lcodcl = $ccodcl"; 
                $res = mysqli_query($this -> conexion, $sql) or die("Se ha producido un error. Por favor, vuelva a intentarlo en unos minutos #9");
                
                $devueltas = 0;
                if (mysqli_num_rows($res) == 1)
                {
                    $fila = mysqli_fetch_array($res);
                    $devueltas = $fila[0];
                    $devueltas *= -1;
                }
            }*/

        $disponibles = $enplazo - $devueltas;

        return $disponibles;
    }

    function devolucionAccesorios($articulo_encry)
    {
        $this->init();

        $articulo = unserialize(base64_decode($articulo_encry));

        $ccodcl = $articulo->fcodcl;
        $acodar = $articulo->acodar;
        $adescr = $articulo->adescr;
        $ffecha = $articulo->ffecha;
        $fdoc = $articulo->fdoc;
        $nnumser = $articulo->nnumser;
        $ctipocli = $articulo->ctipocli;
        $afamilia = $articulo->afamilia;

        $acodarAux = strtolower( str_replace("/", "barder", $articulo->acodar) );
        $urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

        if (!is_array(@getimagesize($urlfoto))) 
        {
            $urlfoto = "https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg";
        } 

        $ffecha = strtotime($ffecha);
        $fechaF = date('d/m/Y', $ffecha);


        // -- Detectar si el cliente es tipo Technoocasión --
        $esTechnoocasion = false; $doaDias = 30; $rmaDias = 730; 
        if (in_array($ctipocli, array(22, 23, 24))) { $esTechnoocasion = true; $doaDias = 60; $rmaDias = 1095; }

        if (in_array($ccodcl, array(6426))  ) { $rmaDias = 1095; $doaDias = 61;  }

        $esTechnoocasionF = "No"; if ($esTechnoocasion) { $esTechnoocasionF = "Sí"; }

        $categoria = 0;

        $arrAverias = array();
        $arrAverias = DB::select("SELECT * FROM rma_averia WHERE idcategoria = $categoria and id <> 0");

        $tipoRMA = "RMA";  // RMA DOA DC DEP 



        // Calcular unidades que ya han sido devueltas dentro del plazo (en un año)

        if ($ccodcl != "" && $acodar != "")
        {
            $udsDisponibles = $this->obtCantidadesDisponibles($ccodcl, $acodar);   
        }
        else
        {
            $udsDisponibles = 20;   
            $ccodcl = 8874;
            $acodar = 5703194775;
        }


        $arrTemps = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");

        // Comprobar si hay algún DOA  (Si hay accesorio no puede añadirse DOA y viceversa)
        $hayDOA = false;

        foreach ($arrTemps as $temp)
        {
            if ($temp->rtipo == "DOA") { $hayDOA = true; }
        }



        $puedeAniadir = true;
        $puedeAniadirMsg = "";

        // Si en la cesta hay un accesorio no se puede añadir un DOA y viceversa

        if ($hayDOA)
        {
            $puedeAniadir = false; 
            $puedeAniadirMsg = "No se puede a&ntilde;adir DOA y accesorio en el mismo parte de devoluci&oacute;n. <br />Por favor, tram&iacute;telo en un parte diferente";
        }

        $arrArtsDevolucion = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");
        $hayAutorizado = true;
        $hayNoAutorizado = false;

        foreach ($arrArtsDevolucion as $artDev) 
        {
            $acodarAux = strtolower( str_replace("/", "barder", $artDev->rcodar) );
            $artDev->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

            if ($artDev->rautorizado == 1)
            {
                $hayAutorizado = true;
            }

            if ($artDev->rautorizado == 0)
            {
                $hayNoAutorizado = true;
            }
        }

        return View('devolucion_accesorio')->with("ccodcl", $ccodcl)
                                              ->with("acodar", $acodar)
                                              ->with("adescr", $adescr)
                                              ->with("fechaF", $fechaF)
                                              ->with("fdoc", $fdoc)
                                              ->with("nnumser", $nnumser)
                                              ->with("ctipocli", $ctipocli)
                                              ->with("afamilia", $afamilia)
                                              ->with("urlfoto", $urlfoto)
                                              ->with("udsDisponibles", $udsDisponibles)
                                              ->with("puedeAniadir", $puedeAniadir)
                                              ->with("puedeAniadirMsg", $puedeAniadirMsg)
                                              ->with("tipoRMA", $tipoRMA)
                                              ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                              ->with("hayAutorizado", $hayAutorizado)
                                              ->with("hayNoAutorizado", $hayNoAutorizado);
    }

    function devolucionNoVendido($articulo_encry)
    {
        $this->init();

        $articulo = unserialize(base64_decode($articulo_encry));

        $ccodcl = $articulo->fcodcl;
        $acodar = $articulo->acodar;
        $adescr = $articulo->adescr;
        $ffecha = $articulo->fechaF;
        $fdoc = $articulo->fdoc;
        $nnumser = $articulo->nnumser;
        $ctipocli = $articulo->ctipocli;
        $afamilia = $articulo->afamilia;
        $fforpa = $articulo->fforpa;

        $acodarAux = strtolower(str_replace("/", "barder", $articulo->acodar));
        $urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

        if (!is_array(@getimagesize($urlfoto))) 
        {
            $urlfoto = "https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg";
        }

        /*$ffecha = strtotime($ffecha);
        $fechaF = date('Y-m-d H:i:s', $ffecha);*/
        $fechaF = $ffecha;

        // -- Detectar si el cliente es tipo Technoocasión --
        $esTechnoocasion = false; $rmaDias = 730; $dcDias = 31; 
        if (in_array($ctipocli, array(22, 23, 24))) 
        { 
            $esTechnoocasion = true; $rmaDias = 1095; $dcDias = 62; 
        }

        // Si el cliente es 2526 le bajamos los días de DC
        if ( in_array($ccodcl, array(2526))  ) { $dcDias = 15; }

        $esTechnoocasionF = "No"; if ($esTechnoocasion) { $esTechnoocasionF = "Sí"; }

        // -- Calcular tiempo desde que el artículo fue comprado --
        $dateHoy = new DateTime();
        $dateCompra = date_create($ffecha);
        $dateDiferencia  = date_diff($dateCompra, $dateHoy);
        $diasDesdeCompra = $dateDiferencia -> format('%a');


        // -- Tipo de artículo --
        $esInformatica = false; $categoria = 0;
        if ($afamilia >= 500 && $afamilia <= 599) { $esInformatica = true; }

        if ( ($afamilia >= 501 && $afamilia <= 505) || $afamilia == 563 || $afamilia == 542 || $afamilia == 564 ) { $categoria = 1; }
        else if ( ($afamilia >= 521 && $afamilia <= 529) || $afamilia == 560 ) { $categoria = 2; }
        else if ($afamilia >= 551 && $afamilia <= 556) { $categoria = 3; }
        else if ($afamilia == 567) { $categoria = 4; }
        else { $categoria = 0; }

        $arrAverias = DB::select("SELECT * FROM rma_averia WHERE idcategoria = $categoria and id <> 0");

        $dateHoy = new DateTime();
        $dateCompra = date_create($ffecha);
        $dateDiferencia  = date_diff($dateCompra, $dateHoy);
        $diasDesdeCompra = $dateDiferencia -> format('%a');

        // ======== "NO LO HE VENDIDO" =======
        $tipoRMA = "";  // RMA DOA DC DEP 

        if ( $fforpa == 16 ) { $tipoRMA = "DEP"; } 
        else { $tipoRMA = "DC"; } 


        // Si está en plazo para ser devuelto sin autorización
        $enPlazo = false;

        if ($tipoRMA == "DC" || $tipoRMA == "DEP")
        {
            if ($diasDesdeCompra <= $dcDias)
            {
                $enPlazo = true;
            }           
        }

        $arrayCompt = array(9036,3071,8905,3123,7130,6101,5255,5097,5417,6609,9033,9037,7285,5797,4104,2628,5290,723,771,2477,4923,556,3935,1740,8539,6529,9035,2271,2307,379,6312,6425,60095,430,1873,1971,2428,2661,1425,2057,3962,2028,3664,2246,3286,3460,3792,6554,1835,508,3886,6053);

        if (in_array($ccodcl, $arrayCompt) && strtotime("2021-01-31") > strtotime('now'))
        {
            $enPlazo = true; 
        }

        // Si el cliente es el 3550 y el nº de serie es  CZC423448F ó CZC553460G: Ampliar DC hasta el 22/04/2021
        if (($nnumser == "CZC423448F" || $nnumser == "CZC553460G") && $ccodcl == 3550 && strtotime("2021-04-22") > strtotime('now'))
        {
            $enPlazo = true;
        }

        // Si es forma de pago 92 siempre debe permitir la DC

        if ($fforpa == 92) { /*$enPlazo = true;*/ }

        $autEstado = -1;
        $arrEstados = DB::select("SELECT estado FROM rma_autorizacion WHERE ccodcl = $ccodcl AND nnumser = '$nnumser' ORDER BY id DESC LIMIT 1");

        foreach ($arrEstados as $arrEstado)
        {
            $autEstado = $arrEstado->estado;
        }



        $arrArtsDevolucion = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");
        $hayAutorizado = true;
        $hayNoAutorizado = false;

        foreach ($arrArtsDevolucion as $artDev) 
        {
            $acodarAux = strtolower( str_replace("/", "barder", $artDev->rcodar) );
            $artDev->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

            if ($artDev->rautorizado == 1)
            {
                $hayAutorizado = true;
            }

            if ($artDev->rautorizado == 0)
            {
                $hayNoAutorizado = true;
            }
        }


        return View('devolucion_no_vendido')->with("ccodcl", $ccodcl)
                                            ->with("acodar", $acodar)
                                            ->with("nnumser", $nnumser)
                                            ->with("fdoc", $fdoc)
                                            ->with("adescr", $adescr)
                                            ->with("categoria", $categoria)
                                            ->with("fechaF", $fechaF)
                                            ->with("enPlazo", $enPlazo)
                                            ->with("tipoRMA", $tipoRMA)
                                            ->with("autEstado", $autEstado)
                                            ->with("urlfoto", $urlfoto)
                                            ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                            ->with("hayAutorizado", $hayAutorizado)
                                            ->with("hayNoAutorizado", $hayNoAutorizado);
    }




    function documentoFormatear($numDoc)
    {
        $aux = $numDoc;

        $num = substr($numDoc, -6, 6);

        $aux = str_replace($num, "", $numDoc);
        $lon = strlen($aux);

        $anioSerie = substr($numDoc, 0, $lon);
        

        return $anioSerie."/".$num;
    }

    function formatearFecha($fechaMysql)
    {
        $strFecha = "";
        
        if ($fechaMysql != "")
        {
            $arrFecha = explode("-", $fechaMysql);
            $strFecha = $arrFecha[2]."/".$arrFecha[1]."/".$arrFecha[0];
        }

        return $strFecha;
    }

    function formatearHora($horaMysql)
    {
        $aux = explode(":", $horaMysql);
        $hora = $aux[0].":".$aux[1];

        return $hora;
    }

    function formatearDateTime2Hora($dateTimeMysql)
    {
        $aux = explode(" ", $dateTimeMysql);

        $horaF = $this -> formatearHora($aux[1]);

        return $horaF;
    }

    function formatearDateTime2Fecha($dateTimeMysql)
    {
        $aux = explode(" ", $dateTimeMysql);

        $fechaF = $this -> formatearFecha($aux[0]);

        return $fechaF;
    }




    function quitarTildes($cadena)
    {
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                                'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                                'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                                'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                                'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' , "'"=>"", 'ª'=>'', 'º'=>'', 'Ã'=>'' );
        $cadena = strtr($cadena, $unwanted_array);    
        return $cadena;
    }


    function devolucionNoFunciona($articulo_encry)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;;
        $acodar = '';
        $adescr = '';
        $fechaF = '';
        $fdoc = '';
        $nnumser = '';
        $ctipocli = session("usuario")->uData->ctipocli;
        $afamilia = 0;
        $aresnum4 = 0;
        $urlfoto = '';

        $tipoRMA = "RMA"; 
        $puedeAniadir = true; $puedeAniadirMsg = "";

        $arrAverias = array();

        $categoria = 0;

        $articulo = unserialize(base64_decode($articulo_encry));

        $acodar = $articulo->acodar;
        $adescr = $articulo->adescr;
        $ffecha = $articulo->ffecha;
        //echo "<br />ffecha: ".$articulo->rfecha;
        $ffechaF = $this -> formatearFecha($ffecha);      // 12345
        $fdoc = $articulo->fdoc;
        $nnumser = $articulo->nnumser;
        $afamilia = $articulo->afamilia;
        $aresnum4 = $articulo->aresnum4;

        /*$ffecha = strtotime($ffecha);
        $fechaF = date('Y-m-d H:i:s', $ffecha);*/

        $hayAutorizado = false;
        $hayNoAutorizado = false;

        $acodarAux = strtolower( str_replace("/", "barder", $articulo->acodar) );
        $urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

        if (!is_array(@getimagesize($urlfoto))) 
        {
            $urlfoto = "https://diginova.es/xweb3/fotoartic/nofoto2tmp.jpg";
        }

        $hayAccesorio = false;
        $arrRMATemps = DB::select("SELECT rcategoria FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");

        foreach ($arrRMATemps as $temp)
        {
            if ($temp->rcategoria == 0) { $hayAccesorio = true; }
        }

        // -- Detectar si el cliente es tipo Technoocasión --
        $esTechnoocasion = false; $doaDias = 30; $rmaDias = 730; 

        /**************************** EXCEPCIONES *********************************/
        // 1234
        if ($nnumser == "JZ4YSD2") { $doaDias = 90; }

        // Si el cliente es 2526 le bajamos los días de DOA
        if ( in_array($ccodcl, array(4414))  ) { $doaDias = 15; }
        if ( in_array($ccodcl, array(2526))  ) { $doaDias = 15; }
        if ( in_array($ccodcl, array(1959))  ) { $doaDias = 30; }
        if ( in_array($ccodcl, array(64))  ) { $doaDias = 62; }

        if ( in_array($ctipocli, array(22, 23, 24)) ) { $esTechnoocasion = true; }
        if ( in_array($ctipocli, array(23, 24)) ) { $doaDias = 61; }
        if ( in_array($ccodcl, array(6426, 4401))  ) { $rmaDias = 1095; $doaDias = 61;  }
        if ( in_array($ccodcl, array(9451))  ) { $rmaDias = 365; }

        if ($esTechnoocasion) { $rmaDias = 1095; }

        if ( ($afamilia >= 501 && $afamilia <= 505) || $afamilia == 563 || $afamilia == 542 || $afamilia == 564 ) { $categoria = 1; }
        else if ( ($afamilia >= 521 && $afamilia <= 529) || $afamilia == 560 ) { $categoria = 2; }
        else if ($afamilia >= 551 && $afamilia <= 556) { $categoria = 3; }
        else if ($afamilia == 567) { $categoria = 4; }
        else { $categoria = 0; }

        // Familias de tara
        if ($aresnum4 == 28) { $categoria = 2; }
        if ($aresnum4 == 29) { $categoria = 3; }
        if ($aresnum4 == 30) { $categoria = 1; }



        $arrAverias = DB::select("SELECT * FROM rma_averia WHERE idcategoria = $categoria and id <> 0");

        $dateHoy = new DateTime();
        $dateCompra = date_create($ffecha);
        $dateDiferencia  = date_diff($dateCompra, $dateHoy);
        $diasDesdeCompra = $dateDiferencia -> format('%a');

        // Compruebo si es DOA
        if ($diasDesdeCompra <= $doaDias)
        {
            $tipoRMA = "DOA"; 
        }
        else
        {
            if ($diasDesdeCompra <= $rmaDias)
            {
                $tipoRMA = "RMA"; 
            }
            else
            {
                // Fuera del tiempo. Compruebo si tiene autorización habilitada
                $autEstado = -1;
                $arrEstados = DB::select("SELECT estado FROM rma_autorizacion WHERE ccodcl = $ccodcl AND nnumser = '$nnumser' ORDER BY id DESC LIMIT 1");

                foreach ($arrEstados as $arrEstado)
                {
                    $autEstado = $arrEstado->estado;
                }

                if ($autEstado == 1)
                {
                    $tipoRMA = "RMA"; 
                }
                else
                {
                    $puedeAniadir = false;
                    $puedeAniadirMsg = "Ha expirado el plazo de garantía";
                }
            }
        }

        if ($categoria == 0) { $tipoRMA = "RMA"; }


        $arrArtsDevolucion = DB::select("SELECT * FROM rmatemp where rcodcl = $ccodcl ORDER BY rfecha asc");

        if ( count($arrArtsDevolucion) > 0)
        {
            foreach ($arrArtsDevolucion as $artDev) 
            {
                $acodarAux = strtolower( str_replace("/", "barder", $artDev->rcodar) );
                $artDev->urlfoto = "https://diginova.es/xweb3/fotoartic/art_".$acodarAux."_1.jpg";

                if ($artDev->rautorizado == 1)
                {
                    $hayAutorizado = true;
                }

                if ($artDev->rautorizado == 0)
                {
                    $hayNoAutorizado = true;
                }
            }
        }
        

        return View('devolucion_no_funciona')->with("ccodcl", $ccodcl)
                                             ->with("acodar", $acodar)
                                             ->with("adescr", $adescr)
                                             ->with("ffecha", $ffecha)
                                             ->with("ffechaF", $ffechaF)
                                             ->with("fdoc", $fdoc)
                                             ->with("nnumser", $nnumser)
                                             ->with("ctipocli", $ctipocli)
                                             ->with("afamilia", $afamilia)
                                             ->with("aresnum4", $aresnum4)
                                             ->with("urlfoto", $urlfoto)
                                             ->with("tipoRMA", $tipoRMA)
                                             ->with("puedeAniadir", $puedeAniadir)
                                             ->with("puedeAniadirMsg", $puedeAniadirMsg)
                                             ->with("arrAverias", $arrAverias)
                                             ->with("categoria", $categoria)
                                             ->with("arrArtsDevolucion", $arrArtsDevolucion)
                                             ->with("hayAutorizado", $hayAutorizado)
                                             ->with("hayNoAutorizado", $hayNoAutorizado)
                                             ->with("diasDesdeCompra", $diasDesdeCompra);
    }

    function presupuestos()
    {
        $this->init();

        $arrPresupuestos = DB::select("
            SELECT fcc.BOFE, fcc.BFECPED
            FROM fccoc AS fcc
            WHERE fcc.BCODCL = 2534
            AND fcc.BPED = 0
            AND fcc.BOFE > 200000000000");



        return View('presupuestos')->with("arrPresupuestos", $arrPresupuestos);
    }

    function pedidos()
    {
        $this->init();

        $arrPedidos = DB::select("
            SELECT fcc.BPED, fcc.BFECPED
            FROM fccoc AS fcc
            WHERE fcc.BCODCL = 2534
            AND fcc.BPED > 0
            AND fcc.BOFE > 200000000000
            ORDER BY fcc.BFECPED DESC");

        return View('pedidos')->with("arrPedidos", $arrPedidos);
    }

    function albaranes()
    {
        $this->init();

        $arrAlbaranes = DB::select("
            SELECT fcc.BALBA, fcc.BFECHA
            FROM fccba AS fcc
            WHERE fcc.BCODCL = 2534
            ORDER BY fcc.BFECHA DESC");

        return View('albaranes')->with("arrAlbaranes", $arrAlbaranes);
    }

    function facturas()
    {
        $this->init();

        $arrFacturas = DB::select("
            SELECT fcf.FDOC, fcf.FFECHA, fcf.FOBSE
            FROM fcfac AS fcf
            WHERE fcf.FCODCL = 2534
            AND fcf.FFECHA > '2020-01-01'
            ORDER BY fcf.FFECHA DESC");

        $anio = date("Y");

        return View('facturas')->with("arrFacturas", $arrFacturas)
                               ->with("anio", $anio);
    }

    function pendientes()
    {
        $this->init();

        return View('pendientes');
    }

    function drivers()
    {
        $this->init();

        return View('driver');
    }

    function accionFmod($g, $b, $d)
    {
        $this->init();

        $fmod = fmod((($g - $b) / $d), 6 );

        echo json_encode($fmod);
    }

    function generadorcarteltecno()
    {
        $this->init();

        // Detectar fichero del cartel del mes actual
            $anio = Date("Y");
            $mes = Date("m");

            $resultado = DB::select("SELECT archivo FROM cartel_technoocasion WHERE anio = $anio AND mes = $mes ORDER BY fecha_mod DESC LIMIT 1");

            $archivo = "cartel.jpg";
            if ( count($resultado) == 1 )
            {
                $archivo = $resultado[0] -> archivo;
            }

            
        return View('generadorcarteltecno')->with("archivo", $archivo);
    }

    function esFavorito($referencia)
    {
        $this->init();

        $arrFavoritos = DB::select("SELECT fcodar FROM favoritos where fcodar = '$referencia'");
        $arrFavs = array();

        foreach ($arrFavoritos as $arrFavorito)
        {
            array_push($arrFavs, $arrFavorito->fcodar); 
        }

        $esFav = 0;

        if (in_array($referencia, $arrFavs)) 
        { 
            $esFav = 1; 
        }

        return $esFav;
    }

    function marcarFavorito($ccodcl, $acodar, $favorito)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        if ($favorito == 0)
        {
            DB::insert("INSERT INTO favoritos (fcodcl, fcodar, ffecha) VALUES ($ccodcl, '$acodar', sysdate())");     
        }
        else
        {
            DB::delete("DELETE FROM favoritos WHERE fcodcl = $ccodcl and fcodar = '$acodar'"); 
        }
    }

    function favoritos()
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;
        $arrFavoritos = array();

        if ($ccodcl > 0)
        {
            $arrFavs = DB::select(
                "SELECT a.ACODAR, a.ADESCR, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.ATIPO2, a.AFAMILIA, s.ASTOCK
                FROM fcart AS a, fcstk AS s, favoritos AS fav
                WHERE a.ACODAR = s.ACODAR
                AND a.ACODAR = fav.fcodar
                AND s.AALM = 1 
                AND s.ASTOCK > 0
                AND a.ABLOQUEADO = 'N' 
                AND (a.APVP1 > 0 AND a.APVP2 > 0 AND a.APVP3 > 0 AND a.APVP4 > 0 ) 
                AND a.ARESSN2 = 'N'  
                AND a.AFAMILIA BETWEEN 100 AND 569 
                AND a.ARESNUM4 BETWEEN 1 AND 9999 
                AND a.ARESNUM4 <> 1450
                AND fav.fcodcl = $ccodcl
                ORDER BY a.ACODAR ASC");

            $arrFavoritos = DB::select("SELECT fcodar FROM favoritos WHERE fcodcl = '$ccodcl'");

            $arrOfertas = DB::select("
                SELECT a.ACODAR, a.ADESCR, a.ASTOCK, o.OPRE1, o.OPRE2, o.OPRE3, o.OPRE4, o.OPRE5, o.OPRE6, a.APVP1, a.APVP2, a.APVP3, a.APVP4, a.ARESNUM5, a.ARESNUM6, a.AFAMILIA, a.ATIPO2, a.AAMPDES
                FROM fcofe o, fcart a
                WHERE o.OCODAR = a.ACODAR 
                AND CURDATE() between o.OFECINI AND o.OFECFIN 
                AND a.ASTOCK > 0 
                AND a.ABLOQUEADO = 'N' 
                AND a.APVP1 > 0  
                AND a.ARESSN2 = 'N'
                ORDER BY rand()");

            foreach ($arrFavs as $arrFav)
            {
                $arrFav->esOferta = $this->esOferta($arrFav->ACODAR, $arrOfertas);

                $tieneTeclado = false;

                if ($arrFav->ATIPO2 != 0)
                {
                    if (($arrFav->AFAMILIA >= 521 && $arrFav->AFAMILIA <= 529) || ($arrFav->AFAMILIA == 560))
                    {
                        $tieneTeclado = true;
                    }
                }

                $arrFav->tieneTeclado = $tieneTeclado;

                $this->mostrarFavorito($arrFav, $arrFavoritos);

                $arrFav->fil1 = 0;
                $arrFav->fil2 = 0;
                $arrFav->fil3 = 0;
                $arrFav->fil4 = 0;
                $arrFav->fil5 = 0;
                $arrFav->fil6 = 0;
                $arrFav->fil7 = 0;
                $arrFav->fil8 = 0;
                $arrFav->fil9 = 0;
                $arrFav->fil10 = 0;
                $arrFav->fil11 = 0;
                $arrFav->fil12 = 0;
            }
        }



        return View('favoritos')->with("arrFavoritos", $arrFavs)
                                ->with("arrOfertas", $arrOfertas)
                                ->with("arrRefRepetidas", $this->arrRefRepetidas)
                                ->with("arrRefOcultas", $this->arrRefOcultas)
                                ->with("ccodcl", $ccodcl)
                                ->with("categoria", 0);
    }

    function mostrarFavorito($arrFavorito, $arrFavoritos)
    {
        $arrFav = array();

        foreach ($arrFavoritos as $arrF)
        {
            array_push($arrFav, $arrF->fcodar);
        }

        if (in_array($arrFavorito->ACODAR, $arrFav)) 
        {
            $arrFavorito->FAVTITLE = 'Quitar de favoritos';
            $arrFavorito->FAVICONSTYLE = 'style="visibility: visible !important;"';
            $arrFavorito->FAVRUTA = '/public/images/fav1.png';

            $arrFavorito->FAVORITO = 1;
        }
        else
        {
            $arrFavorito->FAVTITLE = 'Marcar como favorito';
            $arrFavorito->FAVICONSTYLE = '';
            $arrFavorito->FAVRUTA = '/public/images/fav0.png';

            $arrFavorito->FAVORITO = 0;
        }
    }

    function obt347Trimestre($anio, $ccodcl, $trim, $porcIva)
    {
        $fecha1 = ""; $fecha2 = ""; $strIva = " fivatot <> 0 ";  if ($porcIva == 0) { $strIva = " fivatot = 0 "; }

        switch ($trim) 
        {
            case 1: $fecha1 = "$anio-1-1"; $fecha2 = "$anio-3-31"; break;
            case 2: $fecha1 = "$anio-4-1"; $fecha2 = "$anio-6-30"; break;
            case 3: $fecha1 = "$anio-7-1"; $fecha2 = "$anio-9-30"; break;
            case 4: $fecha1 = "$anio-10-1"; $fecha2 = "$anio-12-31"; break;
        }

        $filaT = DB::select(
                "SELECT ROUND(sum(fbastot), 2) as 'base', ROUND(sum(fivatot), 2) as 'iva', ROUND(sum(frectot), 2) as 'rec', ROUND(sum(ftotal), 2) as 'total' 
                FROM fcfac 
                WHERE  ffecha BETWEEN '$fecha1' and '$fecha2'  and fcodcl = $ccodcl AND $strIva");

        return $filaT;
    }

    function obtAniosModelo347($porcIva)
    {
        $fecha1 = ""; $fecha2 = ""; $strIva = " fivatot <> 0 ";  if ($porcIva == 0) { $strIva = " fivatot = 0 "; }
        $anioActual = date("Y");
        $aniosModelo347 = array();
        $ccodcl = session('usuario')->uData->codigo;

        for ($i = $anioActual; $i > $anioActual - 10; $i--) 
        {
            $fecha1 = $i.'-1-1';
            $fecha2 = $i.'-12-31';

            $filasT = DB::select(
                "SELECT ROUND(sum(fbastot), 2) as 'base', ROUND(sum(fivatot), 2) as 'iva', ROUND(sum(frectot), 2) as 'rec', ROUND(sum(ftotal), 2) as 'total' 
                FROM fcfac 
                WHERE  ffecha BETWEEN '$fecha1' and '$fecha2'  and fcodcl = $ccodcl AND $strIva");

            foreach ($filasT as $filaT)
            {
                if ($filaT->total != NULL)
                {
                    array_push($aniosModelo347, $i);
                }
            }
        }

        return $aniosModelo347;
    }

    function infoArticulos()
    {
        $this->init();

        $arrTiposArtCSV = DB::select("
            SELECT * FROM menus 
            WHERE id IN (1125, 1126, 1118, 1160, 1127) 
            ORDER BY FIELD(id, 1125, 1126, 1118, 1160, 1127)");

        $arrCategoriasCSV = DB::select("
            SELECT * FROM menus 
            WHERE PARENT IN (1125, 1126, 1118)
            OR GCOD = 40
            OR ID = 1161
            ORDER BY GCOD");

        $arrSubCategoriasCSV = DB::select("
            SELECT GCOD, GDES, META_KEYS, META_DESC 
            FROM fcgrf 
            WHERE GDES <> '' 
            AND GDES IS NOT NULL
            AND GCOD != 401");

        $arrFamiliasCSV = DB::select("
            SELECT fc.FCOD, fc.FDES, fc.FGRUPO 
            FROM fcfcp fc 
            WHERE FRESSN2 = 'N'
            ORDER BY FCOD");

        if (Request::isMethod('post'))
        {
            $ccodcl = session('usuario')->uData->codigo;
            $tarifa = session('usuario')->uData->ctari;
            //$checks = count($_POST['check']) ? $_POST['check'] : array();

            $checks = array();

            if (Input::has("check"))
            {
                $checks = Request::input('check');
                $this -> generarcsvFAMs($checks, $tarifa);
            }


            //$checks = count(Request::input('check')) ? Request::input('check') : array();
            //var_dump($checks);

            
        }

        return View('csv')->with("arrTiposArtCSV", $arrTiposArtCSV)
                          ->with("arrCategoriasCSV", $arrCategoriasCSV)
                          ->with("arrSubCategoriasCSV", $arrSubCategoriasCSV)
                          ->with("arrFamiliasCSV", $arrFamiliasCSV);
    }


    function generarcsvFAMs($arrCodsFam, $tarifauser)
    {
        $arrFiltros = DB::select("
            SELECT f1.id AS idfiltro1, f1.descripcion AS descrfiltro1, 
                f2.id AS idfiltro2, f2.descripcion AS descrfiltro2, f1.id_categoria 
                FROM filtro1 AS f1, filtro2 AS f2
                WHERE f1.id = f2.id_filtro1");

        // Crear nuevo fichero txt
        $nomfich = "";
        $nomfichPresta = "";

        $aleatorio = rand(10, 99);
        $fecha = getdate();

        $anio = $fecha['year'];
        if ($anio < 1000) { $anio = '0'.$anio; }

        $mes = $fecha['mon'];
        if ($mes < 10) { $mes = '0'.$mes; }

        $dia = $fecha['mday'];
        if ($dia < 10) { $dia = '0'.$dia; }

        $hora = $fecha['hours'];
        if ($hora < 10) { $hora = '0'.$hora; }

        $min = $fecha['minutes'];
        if ($min < 10) { $min = '0'.$min; }

        $sec = $fecha['seconds'];
        if ($sec < 10) { $sec = '0'.$sec; }

        $nomfich = "csv_".$anio.$mes.$dia.$hora.$min.$sec.$aleatorio;
        $nomfich = "csv_diginova_1";
        $nomfichReduc = "csv_diginova_catalogo_1";
        $nomfichPresta = "csv_productos_1";
        $nomfichCat = "csv_categorias_1";
        $nomfichWooCat = "csv_woo_categorias_1";
        $nomfichWoo = "csv_woo_productos_1";

        copy('https://diginova.es/xweb/archivoscsv/plantilla.csv', 'https://diginova.es/xweb/archivoscsv/'.$nomfich.'.csv');

        /*copy('../../../public/archivoscsv/plantilla.csv', '../../../public/archivoscsv/'.$nomfich.'.csv');
        copy('../../../public/archivoscsv/plantilla_presta.csv', '../../../public/archivoscsv/'.$nomfichPresta.'.csv');
        copy('../../../public/archivoscsv/plantilla_cat.csv', '../../../public/archivoscsv/'.$nomfichCat.'.csv');
        copy('../../../public/archivoscsv/plantilla_woo_cat.csv', '../../../public/archivoscsv/'.$nomfichWooCat.'.csv');
        copy('../../../public/archivoscsv/plantilla_woo.csv', '../../../public/archivoscsv/'.$nomfichWoo.'.csv');
        copy('../../../public/archivoscsv/plantilla_reduc.csv', '../../../public/archivoscsv/'.$nomfichReduc.'.csv');*/

        
        //$file = fopen("http://xweb4.diginova.es/public/archivoscsv/".$nomfich.".csv", "a");
        $file = fopen("../../../public/archivoscsv/".$nomfich.".csv", "a");
        $file2 = fopen("../../../public/archivoscsv/".$nomfichPresta.".csv", "a");
        $file3 = fopen("../../../public/archivoscsv/".$nomfichCat.".csv", "a");
        $file4 = fopen("../../../public/archivoscsv/".$nomfichWooCat.".csv", "a");
        $file5 = fopen("../../../public/archivoscsv/".$nomfichWoo.".csv", "a");
        $file6 = fopen("../../../public/archivoscsv/".$nomfichReduc.".csv", "a");

        $arrCategorias = array();
        $arrSubCategorias = array();

        //TARIFA DEL USUARIO
        switch ($tarifauser) {
            case 1: $campprecio = 'APVP1'; break;
            case 2: $campprecio = 'APVP2'; break;
            case 3: $campprecio = 'APVP3'; break;
            case 4: $campprecio = 'APVP4'; break;
            case 5: $campprecio = 'ARESNUM5'; break;
            case 6: $campprecio = 'ARESNUM6'; break;
            
            default: $campprecio = 'APVP3'; break;
        }

        foreach ($arrCodsFam as $codFam) 
        {
            $arrArticulos = DB::select("
                SELECT st.ASTOCK, art.ACODAR, art.ADESCR, art.ARESNUM4, art.APVP1,art.APVP2,art.APVP3,art.APVP4,art.ARESNUM5,art.ARESNUM6,art.AAMPDES,art.ACARAC, fcg.GCOD, fcg.GDES, art.AFAMILIA
                FROM fcart art, fcstk st, fcgrf fcg, fcfcp fcf
                WHERE st.ACODAR = art.ACODAR and st.AALM = 1 and st.ASTOCK > 0 and art.ARESNUM4 = $codFam AND art.ABLOQUEADO = 'N' AND art.ARESSN2 = 'N' AND art.APVP1 <> 0 AND art.APVP2 <> 0 AND art.APVP3 <> 0 AND art.APVP4 <> 0 AND art.ARESNUM5 <> 0 AND art.ARESNUM6 <> 0 AND fcf.fGRUPO = fcg.GCOD and fcf.FCOD = art.ARESNUM4
                ORDER BY art.acodar ASC");

            
            foreach ($arrArticulos AS $arrArticulo)
            {   
                $codArt = $arrArticulo->ACODAR;

                //URL FICHA
                $codArtFICHA = str_replace("/","%2F", $codArt);
                $urlficha = "http://www.diginova.es/articulo/".$codArt;

                //URL IMAGEN
                $codArtIMG = str_replace("/","barder", $codArt);
                $urlimagen = "http://www.diginova.es/xweb3/fotoartic/art_".strtolower($codArtIMG)."_1.jpg";
                
                $buscar = array(chr(13).chr(10), "\r\n", "\n", "\r", ";");
                $reemplazar = array("<br />", "<br />", "<br />", "-");
                $cadena = str_ireplace($buscar,$reemplazar,$res->AAMPDES);
                $cadena = substr($cadena, 0, 850);
                
                // -- BUENA --
                $precioArt = round($res[$campprecio],2);

                $nombreCategoria = "";

                //echo '<div style="display: none">Familia: '.$res["AFAMILIA"].'</div>';

                if (($arrArticulo->AFAMILIA >= 501 && $arrArticulo->AFAMILIA <= 505) || $arrArticulo->AFAMILIA == 563)
                {
                    $nombreCategoria = 'Ordenadores';
                }
                else if (($arrArticulo->AFAMILIA >= 521 && $arrArticulo->AFAMILIA <= 529) || $arrArticulo->AFAMILIA == 560)
                {
                    $nombreCategoria = utf8_decode('Portátiles');;
                }
                else if ($arrArticulo->AFAMILIA >= 551 && $arrArticulo->AFAMILIA <= 556)
                {
                    $nombreCategoria = 'Monitores';
                }
                else if ($arrArticulo->AFAMILIA >= 541 && $arrArticulo->AFAMILIA <= 543)
                {
                    $nombreCategoria = 'Apple';
                }
                else
                {
                    $nombreCategoria = 'Otros';
                }


                $cad_archivo = $arrArticulo->ACODAR.";".$arrArticulo->ADESCR.";".$cadena.";".$precioArt.";".$arrArticulo->ASTOCK.";".$urlimagen.";".$urlficha." ";

                // Cadena para el segundo tipo de CSV
                $cad_archivo_reducido = $arrArticulo->ACODAR.";".$arrArticulo->ADESCR.";".$precioArt.";".$arrArticulo->ASTOCK." ";

                $nombreArticulo = array();
                $nombreArticulo = explode("(", $arrArticulo->ADESCR);

                if ($nombreArticulo[1] == "")
                {
                    $descrCortaArt = "";
                }
                else
                {
                    $descrCortaArt = "(".substr($nombreArticulo[1], 0, 850);
                }

                $arrColumnFiltros = array('fil1', 'fil2', 'fil3', 'fil4', 'fil5', 'fil6', 'fil7', 'fil8', 'fil9', 'fil10', 'fil11', 'fil12');

                $refArticulo = $arrArticulo->ACODAR;
                $arrFiltrosArticulo = DB::select("
                    SELECT * FROM filtroart AS fil WHERE fil.acodar = '$refArticulo'");

                $caracArticulo = '';
                $posCaracArticulo = 0;

                foreach ($arrFiltrosArticulo as $arrFiltroArticulo) 
                {
                    for ($i = 0; $i < count($arrColumnFiltros); $i++) 
                    { 
                        if ($arrFiltroArticulo->FIL1 > 0)
                        {
                            foreach ($arrFiltros as $arrFiltro) 
                            {
                                if ($arrFiltro->idfiltro2 == $arrFiltroArticulo[$arrColumnFiltros[$i]])
                                {
                                    $posCaracArticulo += 1;

                                    if ($caracArticulo != '')
                                    {
                                        $caracArticulo .= ', ';
                                    }

                                    $caracArticulo .= $arrFiltro->descrfiltro1.':'.$arrFiltro->descrfiltro2.':'.$posCaracArticulo.':0';
                                }
                            }
                        }
                    }
                }

                $nombreArticulo[0] = substr($nombreArticulo[0], 0, 20);


                $cad_archivo_presta = "; ;".$nombreArticulo[0].";".$nombreCategoria.",".$res->GDES." ;".$precioArt."; ; ; ; ; ; ; ;".$refArticulo."; ; ; ; ; ; ; ; ; ; ; ; ; ;".$res->ASTOCK."; ; ; ; ; ; ; ; ".$descrCortaArt.";".$cadena."; ; ; ; ; ; ; ; ; ; ; ;".$urlimagen."; ; ;".$caracArticulo."; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ;";

                $cad_archivo_woo = "; ; ;".$nombreArticulo[0]."; 1; 0; visible;".$cadena.";".$cadena."; ; ; taxable; ; 1; ; ; 0; 0; ; ; ; ; 1; ; ; ".$precioArt.";".$nombreCategoria.",".$res->GDES."; ; ;".$urlimagen."; ; ; ; ; ; ; ; ; 0; ; ; ; ;";

                $categoriaEncontrada = false;

                for ($i = 0; $i < count($arrCategorias); $i++) 
                {
                    //echo $arrCategorias[$i].' == '.$res["AFAMILIA"].'</br>';

                    if ($arrCategorias[$i] == $nombreCategoria)
                    {
                        $categoriaEncontrada = true;
                        break;
                    }
                }

                if (!$categoriaEncontrada)
                {
                    array_push($arrCategorias, $nombreCategoria);

                    $cad_archivo_cat = "; 1; ".$nombreCategoria."; ; 0; ; ; ; ; ; ;";
                    $cad_archivo_cat_woo = "; 1; ".$nombreCategoria."; 0; ; ; ; ; ; ;";
                    fwrite($file3, $cad_archivo_cat."\r".PHP_EOL);
                    fwrite($file4, $cad_archivo_cat_woo."\r".PHP_EOL);
                }

                $subCategoriaEncontrada = false;
                for ($i = 0; $i < count($arrSubCategorias); $i++) 
                { 
                    if ($arrSubCategorias[$i] == $res->GDES)
                    {
                        $subCategoriaEncontrada = true;
                        break;
                    }
                }

                if (!$subCategoriaEncontrada)
                {
                    array_push($arrSubCategorias, $res->GDES);

                    if ($res->AFAMILIA >= 501 && $res->AFAMILIA <= 505 || $res->AFAMILIA == 563)
                    {
                        $nombreCategoriaPadre = 'Ordenadores';
                    }
                    else if ($res->AFAMILIA >= 521 && $res->AFAMILIA <= 529 || $res->AFAMILIA == 560)
                    {
                        $nombreCategoriaPadre = utf8_decode('Portátiles');
                    }
                    else if ($res->AFAMILIA >= 551 && $res->AFAMILIA <= 556)
                    {
                        $nombreCategoriaPadre = 'Monitores';
                    }
                    else if ($res->AFAMILIA >= 541 && $res->AFAMILIA <= 543)
                    {
                        $nombreCategoriaPadre = 'Apple';
                    }
                    else
                    {
                        $nombreCategoriaPadre = 'Otros';
                    }


                    $cad_archivo_cat = "; 1; ".$res->GDES."; ".$nombreCategoriaPadre."; 0; ; ; ; ; ; ;";
                    $cad_archivo_cat_woo = "; 1; ".$res->GDES."; ".$nombreCategoriaPadre."; 0; ; ; ; ; ; ;";
                    fwrite($file3, $cad_archivo_cat."\r".PHP_EOL);
                    fwrite($file4, $cad_archivo_cat_woo."\r".PHP_EOL);
                }
                
                fwrite($file, $cad_archivo."\r".PHP_EOL);
                fwrite($file2, $cad_archivo_presta."\r".PHP_EOL);
                fwrite($file5, $cad_archivo_woo."\r".PHP_EOL);
                fwrite($file6, $cad_archivo_reducido."\r".PHP_EOL);
            }

            fwrite($file, "\r".PHP_EOL);
        }

        fclose($file);
        fclose($file2);
        fclose($file3);
        fclose($file4);
        fclose($file5);
        fclose($file6);

        $this->desconectar();


        ?>

        <div class="csvDiv_fila">
            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='/public/archivoscsv/<?php echo $nomfich; ?>.csv'>Descargar CSV</a></div>
            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='/public/archivoscsv/<?php echo $nomfichReduc; ?>.csv'>Descargar CSV reducido</a></div>
            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='/public/archivoscsv/<?php echo $nomfichPresta; ?>.csv'>Descargar art&iacute;culos para Prestashop</a></div>
            <div class="csvDiv_celda"><a class="csv_link" target='_blank' href='/public/archivoscsv/<?php echo $nomfichCat; ?>.csv'>Descargar categor&iacute;as para Prestashop</a></div>
        </div>


        <?php


        //return $nomfich.".csv";
    }




    function consultaMail($emailRepre, $emailCuerpo, $subject)
    {
        //echo "enviar a $emailRepre";

        //$emailRepre = "programacion@diginova.es";
        $emailRepre = "javimoya33@gmail.com";
        require_once base_path().'/phpmailer/class.smtp.php';
        require_once base_path().'/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();
         
        //Le indicamos que el modo será SMTP    
        //$mail -> IsSMTP();     
         
         //Configuramos el Charset del mensaje               
        //$mail -> CharSet="ISO-8859-1"; 
        $mail -> CharSet = "utf8"; 
         
        //Autenticacion Segura con ssl
        $mail -> SMTPSecure = 'ssl';

        //El servidor smtp, en nuestro caso usaremos el de gmail
        $mail -> Host = "mail.diginova.es";
         
        //El puerto, en gmail sería 465
        $mail -> Port = 25;
         
        //El email a través del cual enviaremos
        $mail -> Username = 'pedidos@diginova.es';
         
        //Contraseña del email
        $mail -> Password = 'RGi20f8GyL3bi1qD';
         
        //Le indicamos que se requiere autenticacion
        $mail -> SMTPAuth = true;
         
        //Si responden el mensaje llegará a...
        $mail -> From = 'pedidos@diginova.es';
         
        //Nombre que le indicará de donde viene el mensaje al destinatario
        $mail -> FromName = 'Diginova - RMA';
        
        $receptor = $emailRepre;

        //Email de destino 
        $mail -> AddAddress($receptor);

        //Lo mandaremos en HTML?
        $mail -> IsHTML(true);
         
        $mail -> Subject = $subject;
        $mail -> Body .= $emailCuerpo;


        $enviado = false;

        if(!$mail -> Send())
        {
            /*echo "<br /><br />";
            echo 'No se pudo enviar el mensaje.'.$mail -> ErrorInfo;*/
        }
        else
        {
            //echo "<br /><br />";
            //echo 'El mensaje se ha enviado correctamente.';
            $enviado = true;
        }

        return $enviado; 
    }

    public function quienessomos()
    {
        $this->init();
        return View('quienessomos');
    }

    public function calidadymedioambiente()
    {
        $this->init();
        return View('calidadymedioambiente');
    }

    public function enviosyportes()
    {
        $this->init();
        return View('enviosyportes');
    }

    public function terminosycondiciones()
    {
        $this->init();
        return View('terminosycondiciones');
    }

    public function formasdepago()
    {
        $this->init();
        return View('formasdepago');
    }

    public function avisolegal()
    {
        $this->init();
        return View('avisolegal');
    }

    public function condiciones()
    {
        $this->init();
        return View('condiciones');
    }

    public function calendario()
    {
        $this->init();
        return View('calendario');
    }

    public function nosotroscontacto()
    {
        $this->init();
        return View('nosotroscontacto');
    }

    public function pedidoemail()
    {
        $this->init();
        return View('pedidoemail');
    }

    public function factgen($fact)
    {
        $this->init();

        if ($fact == '')
        {
            echo "Se ha producido un error #1";
        }
        else
        {
            $str = $this->limpiarString($fact);
            $str = strip_tags($str);
        }

        if ( strlen($str) != 20 || substr($str, 0, 3) != "FAC" )
        {
            echo "Se ha producido un error #2";
        }
        else
        {
            $cad1 = substr($str, 0, 3);
            $cad2 = substr($str, 3, 5);
            $cad3 = substr($str, 8, 12);

            $ccodcl = ltrim($cad2, "0");
            $fdoc = ltrim($cad3, "0");

            $nombrepdf = "Factura_$fdoc".".pdf";

            $arrFacturas = DB::select("
                SELECT PFILEPDF 
                FROM fcpdf 
                WHERE pcodcli = $ccodcl AND pnumdoc = $fdoc LIMIT 1");

            if (count($arrFacturas) == 1)
            {
                $archivo = '';
                $PFILEPDF = '';

                foreach ($arrFacturas as $arrFactura)
                {
                    $archivo = $arrFactura;
                    $PFILEPDF = $arrFactura->PFILEPDF;
                }

                header("Cache-Control: no-cache private");
                header("Content-Description: Factura PDF");
                header("Content-Disposition: attachment; filename=\"$nombrepdf\"");
                header("Content-Type: application/pdf");
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: '. strlen($PFILEPDF));

                Header( "Content-type: application/pdf");

                echo "asd:".$PFILEPDF;
            }
            else
            {
                echo "Se ha producido un error #1";
            }
        }

        return View('factgen');
    }

    public function limpiarString($texto)
    {
        $textoLimpio = preg_replace('([^A-Za-z0-9])', '', $texto);                          
        return $textoLimpio;
    }

    public function tpvVirtual($codigoAlbaran)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $arrAlbaranes = DB::select("
            SELECT codalb, bcodcl, cexeniva, crecargo, cnom, cinvsujpas, round(limpor, 2) as 'impor'
            FROM tpv_albaran
            WHERE codalb = $codigoAlbaran 
            ORDER BY id DESC LIMIT 1");

        $cnom = "";
        $balba = "";
        $totalF = 0;
        $urlForm = "";
        $version = "";
        $params = "";
        $signature = "";

        if (count($arrAlbaranes) == 1)
        {
            foreach ($arrAlbaranes as $arrAlbaran)
            {
                $cnom = $arrAlbaran->cnom;
                $balba = $arrAlbaran->codalb;
                $base = $arrAlbaran->impor;
                
                $crecargo = $arrAlbaran->crecargo;

                $cexeniva = $arrAlbaran->cexeniva;
                $cinvsujpas = $arrAlbaran->cinvsujpas;
                $porcIva = 21;

                if ($cinvsujpas == 'S') { $porcIva = 0; }

                $porcIva = 21;
                if ($cexeniva == 'S') { $porcIva = 0; }

                $cantidadRecargo = 0;
                if ($crecargo == 'S') { $cantidadRecargo = $base * 0.052; }

                if ( substr($balba, 0, 2) == "25" ) { $porcIva = 0; $cantidadRecargo = 0; }

                $iva = $base * $porcIva / 100;
                $iva = round($iva, 2);

                $total = $base + $iva + $cantidadRecargo;
                //echo "$total = $base + $iva + $cantidadRecargo";
                $total = round($total, 2);
                $totalF = number_format($total, 2, ",", ".");

                $preciofinal = str_replace(',', '', $totalF);
                $preciofinal = str_replace('.', '', $preciofinal);

                // Se incluye la librería
                require_once base_path().'/apiRedsys.php'; 
                // Se crea Objeto
                $miObj = new RedsysAPI; 

                // Valores de entrada

                $entornoReal = false;
                if ($entornoReal)
                {
                    // ===== VALORES DE ENTORNO REAL =====
                    //$fuc = "329465611"; // La Caixa
                    //$kc = "48MQ7xvANtBOms6RGLOQRoj3ekWPQQan"; // La Caixa

                    $fuc = "36406999"; // Santander
                    $kc = "ZTDEbNyNpPOZ2dMi1v2Gu5KVqL87pTvI"; // Santander
                    
                    $urlForm = "https://sis.redsys.es/sis/realizarPago";
                }
                else
                {
                    // ===== VALORES DE PRUEBAS =====
                    $fuc = "999008881";
                    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
                    $urlForm = "https://sis-t.redsys.es:25443/sis/realizarPago";
                }


                
                $terminal = "1";
                $moneda = "978";
                $trans = "0";
                $url = "http://xweb4.diginova.es/";
                //$urlOKKO = "https://localhost/ApiPhpRedsys/ApiRedireccion/redsysHMAC256_API_PHP_5.2.0/ejemploRecepcionaPet.php";
                //$urlOKKO = "https://diginova.es/xweb/index.php?page=tpvvirtual2";
                $urlOK = "http://xweb4.diginova.es/tpvvirtualcorrecto/".$codigoAlbaran;                  
                $urlKO = "http://xweb4.diginova.es/";

                // ====== Generar DS_MERCHANT_ORDER ======
                $randomNum = rand(10, 99);
                $hora = date('H');
                $min = date('m');
                $seg = date('s');
                //echo $hora;
                
                $id = $balba.$randomNum;
                $id = substr($balba,-8,8);
                $id .= $randomNum;
                //$id = $balba.date("H").date("m").date("s").$randomNum;
                //echo "<br />id: $id";
                $amount = $preciofinal;

                // Se Rellenan los campos
                $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
                //$miObj->setParameter("DS_MERCHANT_ORDER", strval($id));
                $miObj->setParameter("DS_MERCHANT_ORDER", $id);
                $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
                $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
                $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
                $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
                $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
                $miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);      
                $miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);

                //Datos de configuración
                $version="HMAC_SHA256_V1";

                // Se generan los parámetros de la petición
                $request = "";
                $params = $miObj->createMerchantParameters();
                $signature = $miObj->createMerchantSignature($kc);
            }
        }

        return View('tpvvirtual')->with("cnom", $cnom)
                                 ->with("balba", $balba)
                                 ->with("totalF", $totalF)
                                 ->with("urlForm", $urlForm)
                                 ->with("version", $version)
                                 ->with("params", $params)
                                 ->with("signature", $signature);
    }

    public function tpvVirtualCorrecto($codigoAlbaran)
    {
        $this->init();

        $ccodcl = session('usuario')->uData->codigo;

        $arrAlbaranes = DB::select("
            SELECT codalb, bcodcl, cexeniva, crecargo, cnom, cinvsujpas, round(limpor, 2) as 'impor'
            FROM tpv_albaran
            WHERE codalb = $codigoAlbaran 
            ORDER BY id DESC LIMIT 1");

        $balba = "";
        $mensaje = "";
        $version = "";
        $datos = "";
        $signatureRecibida = "";

        if (count($arrAlbaranes) == 1)
        {
            foreach ($arrAlbaranes as $arrAlbaran)
            {
                // Se incluye la librería
                require_once base_path().'/apiRedsys.php'; 
                // Se crea Objeto
                $miObj = new RedsysAPI; 

                $balba = $arrAlbaran->codalb;

                if (Request::isMethod('post'))
                {
                    $version = Input::get('Ds_SignatureVersion');
                    $datos = Input::get('Ds_MerchantParameters');
                    $signatureRecibida = Input::get('Ds_Signature');

                    $decodec = $miObj->decodeMerchantParameters($datos);

                    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; // <--- PARA PRUEBAS 
                    //$kc = "ZTDEbNyNpPOZ2dMi1v2Gu5KVqL87pTvI"; // <--- REAL 

                    $firma = $miObj->createMerchantSignatureNotif($kc,$datos);

                    if ($firma === $signatureRecibida)
                    {
                        $mensaje = "FIRMA OK";
                    } 
                    else 
                    {
                        $mensaje = "FIRMA KO";
                    }
                }
                else
                {
                    if (Request::isMethod('get'))
                    {
                        $version = Input::get('Ds_SignatureVersion');
                        $datos = Input::get('Ds_MerchantParameters');
                        $signatureRecibida = Input::get('Ds_Signature');

                        $decodec = $miObj -> decodeMerchantParameters($datos);
                        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; // <--- PARA PRUEBAS 
                        //$kc = 'ZTDEbNyNpPOZ2dMi1v2Gu5KVqL87pTvI'; // <--- REAL 

                        $firma = $miObj->createMerchantSignatureNotif($kc,$datos);

                        if ($firma === $signatureRecibida)
                        {
                            //echo "FIRMA OK";
                            $idPedido = $miObj -> getParameter("Ds_Order");
                            //echo "<br />ID PEDIDO: $idPedido";

                            DB::update("UPDATE tpv_albaran SET pagado = 'S', tpvcodigo = '$idPedido', fecha = sysdate() WHERE codalb = $codigoAlbaran");
                            //$respuesta = true;
                            $mensaje = "Operación realizada correctamente";
                        }
                        else 
                        {
                            //echo "FIRMA KO";
                            $mensaje = "Se ha producido un error. Por favor, vuelva a intentarlo.";
                        }
                    }
                    else
                    {
                        $mensaje = "Se ha producido un error. Por favor, vuelva a intentarlo.";
                    }
                }
            }
        }

        return View('tpvvirtualcorrecto')->with("mensaje", $mensaje)
                                         ->with("arrAlbaranes", $arrAlbaranes);
    }


    public function herramientascomerciales()
    {
        $this->init();

        $clientesQueCompran = $this -> obtClientesQueCompran();

        if (session('usuario')->uData->codigo == 0) {
            return Redirect::to('/');
        }

        return View('herramientascomerciales')->with(array("clientesQueCompran" => $clientesQueCompran)); 
    }




    function obtClientesQueCompran()
    {
        $anioActual = date("Y");
        $anioPasado = $anioActual - 1;
        $mesActual = date("m");
        $diaActual = date("d");

        $fechaPasada = $anioPasado.'-'.$mesActual.'-'.$diaActual;

        $arrClientes = DB::select("SELECT fac.FDOC, fac.FCODCL, fac.FFECHA, fcc.BFACTURA, fcc.BALBA, fcl.LALBA, fcl.LCODAR, fca.AFAMILIA 
            FROM fcfac AS fac, fccba AS fcc, fclia AS fcl, fcart AS fca
            WHERE fac.FFECHA >= '".$fechaPasada."'
            AND ((fac.FDOC >= ".$anioPasado."000000 AND fac.FDOC <= ".$anioActual."999999) 
            OR (fac.FDOC >= 25".$anioPasado."000000 AND fac.FDOC <= 25".$anioActual."999999))
            AND fac.FDOC = fcc.BFACTURA
            AND fcc.BALBA = fcl.LALBA
            AND fcl.LCODAR = fca.ACODAR
            AND ((fca.AFAMILIA >= 501 AND fca.AFAMILIA <= 505)
            OR (fca.AFAMILIA >= 563)
            OR (fca.AFAMILIA >= 521 AND fca.AFAMILIA <= 529)
            OR (fca.AFAMILIA >= 560)
            OR (fca.AFAMILIA >= 551 AND fca.AFAMILIA <= 556)) 
            GROUP BY fac.FCODCL");

        return $arrClientes;
    }

}
