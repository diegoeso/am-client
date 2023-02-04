<?php

use App\Http\Controllers\AlertaMxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EstanciaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\SorteoConvenioController;
use Illuminate\Support\Facades\Route;

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
// Logeo en pagina
Auth::routes();
Route::post('login-pt', [AuthController::class, 'login'])->name('login_pt');
// Route::get('login', 'AuthController@login_mb')->name('login_mb');
Route::post('login-custom', [AuthController::class, 'login_customer'])->name('login_custom');
Route::get('password/reset/{email}/{token}', [Auth\ResetPasswordController::class, 'showResetForm']);

Route::get('/', function () {
    // return view('pagina.mx.index');
    return redirect('productos');
});
Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('nosotros', [PaginaController::class, 'nosotros'])->name('nosotros');
Route::get('alerta-de-fraude', [PaginaController::class, 'fraude'])->name('fraude');
Route::get('mision-y-valores', [PaginaController::class, 'mision'])->name('mision');
Route::get('aviso-de-privacidad', [PaginaController::class, 'privacidad'])->name('privacidad');
Route::get('bolsa-de-trabajo', [PaginaController::class, 'bolsa_trabajo'])->name('bolsa_trabajo');
Route::get('empresas-afiliadas', [PaginaController::class, 'empresas_afiliadas'])->name('empresas_afiliadas');
Route::get('beneficios-empresa', [PaginaController::class, 'beneficios_empresa'])->name('beneficios_empresa');
Route::get('beneficios-trabajadores', [PaginaController::class, 'beneficios_trabajadores'])->name('beneficios_trabajadores');
Route::get('empresas-afiliadas', [PaginaController::class, 'empresas_afiliadas'])->name('empresas_afiliadas');
// Productos
Route::get('productos/{convenio?}/{destino?}/{destino2?}', [PaginaController::class, 'acapulco'])->name('productos');
//Route::get('empresa/{convenio?}/{destino?}/{destino2?}', [PaginaController::class,'productos'])->name('productos');
Route::get('destinos-nacionales/{convenio?}', [PaginaController::class, 'nacionales'])->name('nacionales');
Route::get('destinos-internacionales/{convenio?}', [PaginaController::class, 'internacionales'])->name('internacionales');
Route::get('cruceros', [PaginaController::class, 'cruceros'])->name('cruceros');
Route::get('cotizador', [PaginaController::class, 'cotizador'])->name('cotizador');
Route::get('detalle-estancia/{slug}', [PaginaController::class, 'detalle_estancia'])->name('detalle_estancia');
Route::get('detalle-estancias/destino/{id}', [PaginaController::class, 'detalle_estancia_int'])->name('detalle_estancia_int');
Route::get('cp/{cp}', [PaginaController::class, 'buscar_cp']);
Route::get('sorteo/{convenio}', [PaginaController::class, 'sorteo'])->name('sorteo');
Route::get('encuesta/{id}/{user_hash}', [PaginaController::class, 'encuesta'])->name('encuesta');
Route::get('hoteles-amigos', [PaginaController::class, 'hoteles_amigos'])->name('hoteles');
Route::get('preguntas-frecuentes', [PaginaController::class, 'preguntas'])->name('preguntas');

Route::get('detalles-grupo/{title}/{fecha}/{segmentos?}', [PaginaController::class, 'grupo_acapulco'])->name('grupo.acapulco');
/**
 * Infografia
 */
Route::get('conoce-nuestros-beneficios', [PaginaController::class, 'beneficios'])->name('beneficios');
Route::get('documentos-legales', [PaginaController::class, 'doc_legales'])->name('doc_legales');
Route::get('demo-flyer/{tipo}', [PaginaController::class, 'demo_flyer'])->name('demo_flyer');

Route::get('generar-pagos/{contrato_id}/{precio_de_compra}/{fecha_primer_cobro}', [CompraController::class, 'generar_pagos']);
Route::get('generar-comisiones/{contrato_id}/{convenio_id?}', [CompraController::class, 'comisiones_create']);

Route::post('user-alert-mx', [AlertaMxController::class, 'alerta_mx'])->name('user_alert');

// Route::resource('paquetes', 'PaqueteController');
// Route::get('listar-paquetes/{user_id}', 'PaqueteController@listar_paquetes')->name('paquetes.listar');

// Route::resource('estancias', 'EstanciaController');
Route::get('estancia-detalles/{id}', [EstanciaController::class, 'get_estancia']);

Route::resource('destinos', DestinoController::class);

//tienda en linea
Route::resource('tienda', CompraController::class);
Route::get('tienda-grupo', [CompraController::class, 'grupo'])->name('tienda.grupo');
// agregar usuario, tarjeta y crear contrato
Route::get('metodo-de-pago', [CompraController::class, 'metodo_de_pago'])->name('metodo_pago');

// Finalizar compra
Route::get('finalizar-compra/{id}', [CompraController::class, 'finalizar_compra'])->name('finalizar_compra');
Route::get('mostrar-contrato/{id}', [CompraController::class, 'mostrar_contrato'])->name('mostrar_contrato');
Route::get('descargar-contrato/{id}', [CompraController::class, 'descargar_contrato'])->name('descargar_contrato');
Route::get('generar-pagos', [CompraController::class, 'generar_pagos_p'])->name('calcular_pagos');

//Realizar el cargo
Route::post('openpay-create-checkout', [CompraController::class, 'create_order_checkout'])->name('tienda.create_order_checkout');

Route::resource('encuestas', EncuestaController::class);

Route::get('reservaciones-tutorial', [PaginaController::class, 'tuto_reservas'])->name('tuto_reserva');

Route::resource('sorteo-convenio', SorteoConvenioController::class);

Route::get('directorios', function () {
    dd(Storage::allDirectories('app'));
});

// Auth::routes();
/**
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 **/
