<?php

/* Software XgestEvo tienda web
 * NO MODIFIQUE ESTE ARCHIVO, SI DESEA AGREGAR NUEVAS FUNCIONES HAGALO DESDE IndexControllerEmpresa.php */
namespace App\Http\Controllers;

use App\Xgest\Entorno;
use App\Xgest\Usuario;
use App\Xgest\Articulo;
use App\Xgest\Utils;
use App\Xgest\Mailerx;
use App\Xgest\SecurityBF;
use App\Xgest\WebService;
use Request;
use Illuminate\Support\Facades\Input;
use Response;
use Route;
use Session;
use Config;
use Cookie;
use DB;
use Schema;
use App\Xgest\Menu;
use Illuminate\Support\Facades\Redirect;
use App\Xgest\App\Xgest;

class WebServiceController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {}
	public function webService() {
		$ws=new WebService();
		$result=$ws->procesar();
		echo $result;
	}
}
