<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::any('/', 'Controller@index');
Route::any('/index', 'Controller@index');
Route::any('/marca/{vmarca?}', 'Controller@marca');
Route::any('/public', 'Controller@index');
//Route::get('/recordarclave/{codigo?}', 'Controller@recordarclave');
Route::post('/recordarclave', 'Controller@recordarclave');
Route::any('/cambiarclave/{codigo}', 'Controller@cambiarclave');
Route::get('/registro', 'Controller@registro');
Route::post('/completarRegistro', 'Controller@completarRegistro');
Route::post('/modificarRegistro', 'Controller@modificarRegistro');
Route::get('/activarCuenta/{clave}/{codigo}', 'Controller@activarCuenta');
Route::post('/iniciosesion', 'Controller@iniciosesion');
Route::post('/procesosSecundarios', 'Controller@procesosSecundarios');
Route::get('/cerrarsesion', 'Controller@cerrarsesion');
Route::any('/micuenta/{ide?}/{anno?}', 'Controller@micuenta');
Route::post('/envioMailSolicitudMayor', 'Controller@envioMailSolicitudMayor');
Route::post('/envioMailCambioUsuario', 'Controller@envioMailCambioUsuario');
Route::post('/activarCentro', 'Controller@activarCentro');
Route::post('/nuevosubcliente', 'Controller@nuevosubcliente');
Route::get('/documentos/{tipo}/{numero}/{mensaje?}', 'Controller@misdocumentos');
Route::get('/documentos2/{tipo}/{numero}/{mensaje?}', 'Controller@misdocumentos2');
Route::any('/contactar', 'Controller@contactar');
Route::get('/enlace/{ide}', 'Controller@enlace');
Route::get('/seccion/{familia}/{nombrefamilia?}/{pagina?}', 'Controller@seccion');
Route::get('/secciones', 'Controller@secciones');
Route::get('/especial/{seccion}/{nombreseccion}/{pag}', 'Controller@especial');
Route::get('/cambiarOrden/{ide}', 'Controller@cambiarOrden');
Route::get('/seguimiento', 'Controller@seguimiento');
Route::get('/novedades/{pag}', 'Controller@novedades');
Route::get('/compras', 'Controller@misCompras');
Route::post('/tracking', 'Controller@tracking');
Route::get('/avisos', 'Controller@avisos');
Route::get('/producto/{ide}/{descripcion?}', 'Controller@producto');
Route::get('/documentos/{ide}', 'Controller@productodocumentos');
Route::get('/buscar/{pag?}', 'Controller@buscar');
Route::post('/buscarVue/{pag?}', 'Controller@buscarVue');
Route::get('/buscarrma/{texto?}', 'Controller@buscarrma');
Route::post('/altarma', 'Controller@altarma');
Route::any('/cesta/{paso?}/{proveedor?}', 'Controller@visualizarCesta');
Route::any('/cesta2/{paso?}/{proveedor?}', 'Controller@visualizarCesta2');
Route::post('/finalizarCompra', 'Controller@finalizarCompra');
//Route::post('/finalizarCompraComprobacionStock','Controller@finalizarCompraComprobacionStock');
Route::post('/promocion', 'Controller@codigoPromocional');
Route::post('/addArticulo', 'Controller@addArticulo');
Route::post('/deleteArticulo', 'Controller@deleteArticulo');
Route::post('/modifyArticulo', 'Controller@modifyArticulo');
Route::get('/faq', 'Controller@faq');
Route::get('/idioma/{ididioma}', 'Controller@idioma');
Route::post('/cambiarDesgloseCesta', 'Controller@cambiarDesgloseCesta');
Route::post('/cambiarPagoPedido', 'Controller@cambiarPagoPedido');
Route::post('/selecFormasCesta/{ide}/{ide2}', 'Controller@selecFormasCesta');
Route::post('/cambiarPropiedades/{prop}/{val}', 'Controller@cambiarPropiedades');
Route::post('/cambiarPropiedadesMulti/{prop}/{val}', 'Controller@cambiarPropiedadesMulti');
Route::post('/imagenajax', 'Controller@imagenajax');
Route::get('/mensajes/{tipo}', 'Controller@mensajes');

Route::get('/politicacookies', 'Controller@politicacookies');
//Route::any('/web Service', 'Web ServiceController@web Service');
Route::get('/pInfo', 'Controller@pInfo');
Route::get('/reset', 'Controller@reset');
Route::get('/RESET', 'Controller@reset');
Route::get('/test', 'Controller@test');
Route::get('/encode/{clave}', 'Controller@encode');
Route::any('/sitemap/{p1?}/{p2?}/{p3?}', 'Controller@sitemap');
Route::get('/resetFotos', 'Controller@resetFotos');
Route::any('/acceso', 'Controller@accesoGlobal');
Route::get('/stocks/{usuario}/{password}', 'Controller@retornarStocks');
Route::get('/stockscsv/{usuario}/{password}', 'Controller@retornarStocksCsv');
Route::get('/stocks2/{usuario}/{password}', 'Controller@retornarStocksDetalle');
Route::get('/descargarPDF/{doc}', 'Controller@descargarPDF');
Route::get('/descargarPDFFile/{doc}', 'Controller@descargarPDFFile');
Route::any('/{usuario}/log/{codigo}', 'Controller@log');

Route::any('/webService', 'WebServiceController@webService');

//Route::get('/', function () {
//      return view('index');
//});

// pasarelas de pago
Route::any('/pago/{tipo}', 'Controller@pasarelasPago');
Route::any('/public/pago/{tipo}', 'Controller@pasarelasPago');

// cestas
Route::get('/guardarCesta/{titulo?}', 'Controller@guardarCesta');
Route::get('/emptyBasket', 'Controller@emptyBasket');
Route::get('/listarCestas', 'Controller@listarCestas');
Route::get('/recuperarCesta/{numero}', 'Controller@recuperarCesta');
Route::get('/eliminarCesta/{numero}', 'Controller@eliminarCesta');
//Route::get('/detalleCesta/{numero}','Controller@detalleCesta');
//Route::get('/modificarCesta/{numero}','Controller@modificarCesta');
Route::get('/eliminarPedido/{numero}', 'Controller@eliminarPedido');
Route::get('/toBasket/{ide}', 'Controller@toBasket');

// api clientes
Route::get('api/clientes', 'Controller@apiListaClientes');
Route::get('api/clientes/{id}', 'Controller@apiFichaCliente');
Route::post('api/clientes', 'Controller@apiNuevoCliente');
Route::put('api/clientes/{id}', 'Controller@apiActualizarCliente');
Route::delete('api/clientes/{id}', 'Controller@apiEliminarCliente');
Route::get('api/direcciones/{id}', 'Controller@apiListaDireccionesCliente');
Route::post('api/direcciones/{id}', 'Controller@apiNuevaDireccionEnvio');
Route::delete('api/direcciones/{cliente}/{id}', 'Controller@apiEliminarDireccionEnvio');
Route::put('api/direcciones/{cliente}/{id}', 'Controller@apiActualizarDireccionEnvio');
Route::get('api/clienteszonas', 'Controller@apiListaClientesZonas');
// api pedidos/facturas
Route::delete('api/pedidos/{id}', 'Controller@apiEliminarPedido');
Route::get('api/pedidos/{cliente}', 'Controller@apiListaPedidos');
Route::get('api/facturas/{cliente}', 'Controller@apiListaFacturas');
Route::get('api/pedidos/{cliente}/{documento}', 'Controller@apiRecuperarPedido');
Route::get('api/facturas/{cliente}/{documento}', 'Controller@apiRecuperarFactura');
Route::post('api/pedidos', 'Controller@apiNuevoPedido');
// api artículos
Route::get('api/stocksgeneral/{almacen}', 'Controller@apiStockGeneral');
Route::get('api/stocks/{producto}/{almacen?}', 'Controller@apiStockArticulo');
Route::get('api/articulos/{id}', 'Controller@apiFichaArticulo');
Route::get('api/articulos', 'Controller@apiArticulos');
Route::delete('api/articulos/{id}', 'Controller@apiEliminarArticulo');
Route::post('api/articulos', 'Controller@apiNuevoArticulo');
Route::put('api/articulos/{id}', 'Controller@apiActualizarArticulo');
Route::get('api/familias', 'Controller@apiFamilias');


// api pedidos proveedor
Route::post('api/pedidosproveedor', 'Controller@apiNuevoPedidoProveedor');
Route::get('api/pedidosproveedor/{proveedor}/{documento}', 'Controller@apiRecuperarPedidoProveedor');


/*****************************  NUEVAS VISTAS *************************************************************/
Route::get('/prueba', 'Controller@prueba');
Route::get('/categoria/{categoria}/{subcategoria?}/{subcategoria2?}', 'Controller@categoria');
Route::get('/categoria2/{categoria}/{subcategoria?}/{subcategoria2?}', 'Controller@categoria2');
Route::get('/articulo/{articulo}', 'Controller@articulo');
Route::get('/articulo2/{articulo}', 'Controller@articulo2');

Route::get('/polenvio', 'Controller@polenvio');
Route::get('/formaspago', 'Controller@formaspago');
Route::get('/avisolegal', 'Controller@avisolegal');
Route::get('/calendario', 'Controller@calendario');
Route::get('/condiciones', 'Controller@condiciones');

Route::any('/preguntasfrecuentes', 'Controller@preguntasfrecuentes');
Route::get('/consultas/{tipoticket}/{id}', 'Controller@consultasArticulo');
Route::any('/consulta/{codcliente}/{referencia}/{numserie}/{tipoticket}/{idpregunta}', 'Controller@consultaArticulo');
Route::get('/consulta/cerrar/{referencia}', 'Controller@accionCerrarConsulta');
Route::post('/cerrarconsulta', 'Controller@cerrarConsulta');

Route::get('/ofertas', 'Controller@ofertas');

Route::get('/buscador/{textobusq}', 'Controller@buscador');
Route::get('/cesta_agencia/{idAgencia}', 'Controller@cestaAgencia');
Route::get('/cesta_agencia_paso2/{idAgencia}', 'Controller@cestaAgenciaPaso2');
Route::get('/cesta_agencia_paso3/{idAgencia}', 'Controller@cestaAgenciaPaso3');
Route::get('/cesta_agencia_paso4/{tramoHorario}', 'Controller@cestaAgenciaPaso4');


Route::get('/buscararticulosanuncio/{criterioBusq}', 'Controller@buscarArticulosAnuncio');

//Route::any('/generadorcarteltecno', 'Controller@generadorcarteltecno');

Route::get('/familia/{seccion}', 'Controller@familia');
Route::get('/devoluciones', 'Controller@devoluciones');
Route::get('/devolucionnofunciona/{articulo}', 'Controller@devolucionNoFunciona');
Route::get('/devolucionnofunciona2/{articulo}', 'Controller@devolucionNoFunciona2');
Route::get('/devolucionnovendido/{articulo}', 'Controller@devolucionNoVendido');
Route::any('/anadirparte/{articulo}', 'Controller@devolucionAccesorios');
Route::post('/devolucionrma', 'Controller@devolucionRMA');
Route::post('/devolucionguardar', 'Controller@guardarRMA');
Route::post('/devolucionfin', 'Controller@finRMA');
Route::post('/devolucioneliminar', 'Controller@eliminarDevolucion');
Route::any('/recogida/{rclave}/{rma?}', 'Controller@recogidaRMA');
Route::any('/devolucion', 'Controller@devolucion');
Route::post('/devolucion', 'Controller@devolucion'); 
Route::any('/devolucion2', 'Controller@devolucion2');
Route::post('/devolucion2', 'Controller@devolucion2'); 
Route::get('/devolucion_buscador/{textobusq}', 'Controller@devolucionBuscador');
Route::post('/devolucion_buscador/{textobusq}', 'Controller@devolucionBuscador');

Route::any('/herramientascomerciales', 'Controller@herramientascomerciales');


Route::get('/misdocumentos/presupuestos', 'Controller@presupuestos');
Route::get('/misdocumentos/pedidos', 'Controller@pedidos');
Route::get('/misdocumentos/albaranes', 'Controller@albaranes');
Route::get('/misdocumentos/facturas', 'Controller@facturas');
Route::get('/driver', 'Controller@drivers');

Route::get('/herramientascomerciales', 'Controller@herramientascomerciales');
//Route::any('/generarcsv', 'Controller@infoArticulos');
Route::any('/generarcsv', 'Controller@generarcsv');
Route::any('/generadoranuncios', 'Controller@generadoranuncios');
Route::any('/generadoranuncios2', 'Controller@generadoranuncios2');
Route::any('/generadorcarteltecno', 'Controller@generadorcarteltecno');

Route::get('/accionFmod/{r}/{g}/{a}', 'Controller@accionFmod');

Route::get('/marcarfavorito/{ccodcl}/{acodar}/{favorito}', 'Controller@marcarFavorito');
Route::get('/favoritos', 'Controller@favoritos');

Route::get('/nosotros/quienessomos', 'Controller@quienessomos');
Route::get('/nosotros/enviosyportes', 'Controller@enviosyportes');
Route::get('/nosotros/terminosycondiciones', 'Controller@terminosycondiciones');
Route::get('/nosotros/formasdepago', 'Controller@formasdepago');
Route::get('/nosotros/avisolegal', 'Controller@avisolegal');
Route::get('/nosotros/calendario', 'Controller@calendario');
Route::get('/nosotros/contacto', 'Controller@nosotroscontacto');
Route::get('/nosotros/calidadymedioambiente', 'Controller@calidadymedioambiente');

Route::get('/filtrosactivos/{codCat}/{strFiltros}', 'Controller@filtrosActivos');

Route::get('/pedidoemail', 'Controller@pedidoemail');

Route::get('/factgen/{fact}', 'Controller@factgen');

Route::get('/tpvvirtual/{codigoAlbaran}', 'Controller@tpvvirtual');
Route::get('/tpvvirtualcorrecto/{codigoAlbaran}', 'Controller@tpvvirtualcorrecto');
Route::get('/tpvpedidook/{numpedido}', 'Controller@tpvpedidook');
Route::get('/proformajustificante/{k}', 'Controller@proformajustificante');
Route::post('/proformajustificanteej', 'Controller@proformajustificanteej');

Route::get('/formularioemails', 'Controller@formularioemails');
Route::get('/prueba', 'Controller@prueba');
Route::get('/portada2', 'Controller@portada2');
Route::post('/solicitarAutWeb/', 'Controller@solicitarAutWeb');

Route::any('/modopvp', 'Controller@modopvp');
Route::any('/modopvp2', 'Controller@modopvp2');
Route::get('/actualizarmargen/{ccodcl}/{categoria}/{margen}', 'Controller@actualizarMargen');
Route::get('/activarmodopvp/{ccodcl}/{activo}', 'Controller@activarModoPVP');
Route::get('/nomostrartutorialmodopvp/{ccodcl}/{nomostrar}', 'Controller@noMostrarTutorialModoPVP');
Route::any('/presupuesto', 'Controller@visualizarCesta');
Route::any('/presupuesto2', 'Controller@visualizarCesta2');
Route::any('/presupuestomod', 'Controller@visualizarCestaMod');
Route::post('/generarpresupuesto', 'Controller@generarPresupuesto');
Route::post('/generarpresupuestomod', 'Controller@generarPresupuestoMod');
Route::any('/presupuestogenerado/{linkpresu}', 'Controller@modoPVPPresupuesto');
Route::get('/editarpreciopresupuesto/{precio}/{acodar}/{ccodcl}', 'Controller@editarPrecioPresupuesto');

