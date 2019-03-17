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

Route::get('/', function () {
    return view('layouts.app');
})->middleware('auth');

Route::get('seleccion-movimiento', 'Config\SidenavRouterController@getView')->name('generics.router');

Route::get('movimientos', 'Config\SidenavRouterController@getMov')->name('movimientos.index');

Route::get('get-opts/{opt}', 'Config\SidenavRouterController@getOpts');

Route::get('roles', 'Users\RoleController@index')->name('role.index')->middleware('auth');
Route::get('role-create', 'Users\RoleController@createView')->name('role.create')->middleware('auth');
Route::post('role/create', 'Users\RoleController@create')->middleware('auth');
Route::get('role/{id}', 'Users\RoleController@delete')->middleware('auth');

Route::get('users-password-edit', 'Users\UserController@updatepasswd')->name('users.password');
Route::post('users/updatepassw', 'Users\UserController@updatepass');

Route::get('personal', 'Personal\PersonalController@index')->name('personal.index')->middleware('auth');
Route::get('personal-search', 'Personal\PersonalController@search')->name('personal.search')->middleware('auth');
Route::get('personal-create', 'Personal\PersonalController@createView')->name('personal.create')->middleware('auth');
Route::post('personal/create', 'Personal\PersonalController@create')->middleware('auth');
Route::get('personal/{id}', 'Personal\PersonalController@delete')->middleware('auth');
Route::get('personal-edit-{id}', 'Personal\PersonalController@editView')->name('personal.edit');
Route::post('personal/edit', 'Personal\PersonalController@edit');
Route::get('personal-delete-{id}','Personal\PersonalController@delete');

Route::get('centros', 'Archivos\CentrosController@index')->name('centros.index')->middleware('auth');
Route::get('centros-search', 'Archivos\CentrosController@show')->name('centros.show')->middleware('auth');
Route::get('centros-create', 'Archivos\CentrosController@createView')->name('centros.create')->middleware('auth');
Route::post('centros/create', 'Archivos\CentrosController@create')->middleware('auth');
Route::get('centros/{id}', 'Archivos\CentrosController@delete')->middleware('auth');
Route::get('centros-edit-{id}', 'Archivos\CentrosController@editView')->name('centros.edit');
Route::post('centros/edit', 'Archivos\CentrosController@edit');
Route::get('centros-delete-{id}','Archivos\CentrosController@delete');


Route::get('profesionales', 'Archivos\ProfesionalesController@index')->name('profesionales.index')->middleware('auth');
Route::get('profesionales-search', 'Archivos\ProfesionalesController@search')->name('profesionales.search')->middleware('auth');
Route::get('profesionales-create', 'Archivos\ProfesionalesController@createView')->name('profesionales.create')->middleware('auth');
Route::post('profesionales/create', 'Archivos\ProfesionalesController@create')->middleware('auth');
Route::get('profesionales/{id}', 'Archivos\ProfesionalesController@delete')->middleware('auth');
Route::get('profesionales-edit-{id}', 'Archivos\ProfesionalesController@editView')->name('profesionales.edit');
Route::post('profesionales/edit', 'Archivos\ProfesionalesController@edit');
Route::get('profesionales-delete-{id}','Archivos\ProfesionalesController@delete');


Route::get('laboratorios', 'Archivos\LaboratoriosController@index')->name('laboratorios.index')->middleware('auth');
Route::get('laboratorios-search', 'Archivos\LaboratoriosController@search')->name('laboratorios.search')->middleware('auth');
Route::get('laboratorios-create', 'Archivos\LaboratoriosController@createView')->name('laboratorios.create')->middleware('auth');
Route::post('laboratorios/create', 'Archivos\LaboratoriosController@create')->middleware('auth');
Route::get('laboratorios/{id}', 'Archivos\LaboratoriosController@delete')->middleware('auth');
Route::get('laboratorios-edit-{id}', 'Archivos\LaboratoriosController@editView')->name('laboratorios.edit');
Route::post('laboratorios/edit', 'Archivos\LaboratoriosController@edit');
Route::get('laboratorios-delete-{id}','Archivos\LaboratoriosController@delete');


Route::get('analisis', 'Archivos\AnalisisController@index')->name('analisis.index')->middleware('auth');
Route::get('analisis-search', 'Archivos\AnalisisController@search')->name('analisis.search')->middleware('auth');
Route::get('analisis-create', 'Archivos\AnalisisController@createView')->name('analisis.create')->middleware('auth');
Route::post('analisis/create', 'Archivos\AnalisisController@create')->middleware('auth');
Route::get('analisis/{id}', 'Archivos\AnalisisController@delete')->middleware('auth');
Route::get('analisis-edit-{id}', 'Archivos\AnalisisController@editView')->name('analisis.edit');
Route::post('analisis/edit', 'Archivos\AnalisisController@edit');
Route::get('analisis-delete-{id}','Archivos\AnalisisController@delete');

Route::get('empresas', 'Archivos\EmpresasController@index')->name('empresas.index')->middleware('auth');
Route::get('empresas-search', 'Archivos\EmpresasController@search')->name('empresas.search')->middleware('auth');
Route::get('empresas-create', 'Archivos\EmpresasController@createView')->name('empresas.create')->middleware('auth');
Route::post('empresas/create', 'Archivos\EmpresasController@create')->middleware('auth');
Route::get('empresas/{id}', 'Archivos\EmpresasController@delete')->middleware('auth');
Route::get('empresas-edit-{id}', 'Archivos\EmpresasController@editView')->name('empresas.edit');
Route::post('empresas/edit', 'Archivos\EmpresasController@edit');
Route::get('empresas-delete-{id}','Archivos\EmpresasController@delete');


Route::get('analisis/getAnalisi/{id}', 'Archivos\AnalisisController@getAnalisi');

Route::get('servicios', 'Archivos\ServiciosController@index')->name('servicios.index')->middleware('auth');
Route::get('servicios-search', 'Archivos\ServiciosController@search')->name('servicios.search')->middleware('auth');
Route::get('servicios-create', 'Archivos\ServiciosController@createView')->name('servicios.create')->middleware('auth');
Route::post('servicios/create', 'Archivos\ServiciosController@create')->middleware('auth');
Route::get('servicios/{id}', 'Archivos\ServiciosController@delete')->middleware('auth');
Route::get('servicios-edit-{id}', 'Archivos\ServiciosController@editView')->name('servicios.edit');
Route::post('servicios/edit', 'Archivos\ServiciosController@edit');
Route::get('servicios-delete-{id}','Archivos\ServiciosController@delete');

Route::get('servicios/getServicio/{id}', 'Archivos\ServiciosController@getServicio');
Route::get('servicio/view/{id}', 'Archivos\ServiciosController@show');
Route::get('servicio/material_eliminar/{id}', 'Archivos\ServiciosController@deleteMaterial');
Route::get('servicios-addItems-{servicio}', 'Archivos\ServiciosController@addItems');
Route::post('servicios/storeItems/{servicio}', 'Archivos\ServiciosController@storeItems');

Route::get('pacientes', 'Archivos\PacientesController@index')->name('pacientes.index')->middleware('auth');
Route::get('clientesmes', 'Archivos\PacientesController@indexr')->name('pacientes.indexr')->middleware('auth');
Route::get('pacientes-search', 'Archivos\PacientesController@search')->name('pacientes.search')->middleware('auth');
Route::get('pacientes-create', 'Archivos\PacientesController@createView')->name('pacientes.create')->middleware('auth');
Route::get('pacientes-create2', 'Archivos\PacientesController@createView2')->name('pacientes.create2')->middleware('auth');
Route::get('pacientes-create3', 'Archivos\PacientesController@createView3')->name('pacientes.create3')->middleware('auth');
Route::post('pacientes/create', 'Archivos\PacientesController@create')->middleware('auth');
Route::post('pacientes/create2', 'Archivos\PacientesController@create2')->middleware('auth');
Route::post('pacientes/create3', 'Archivos\PacientesController@create3')->middleware('auth');
Route::get('pacientes/{id}', 'Archivos\PacientesController@delete')->middleware('auth');
Route::get('pacientes-edit-{id}', 'Archivos\PacientesController@editView')->name('pacientes.edit');
Route::post('pacientes/edit', 'Archivos\PacientesController@edit');
Route::get('pacientes-delete-{id}','Archivos\PacientesController@delete');
Route::get('pacientes-createpac','Archivos\PacientesController@createpac');
Route::get('pacientes/view/{id}', 'Archivos\PacientesController@show');
Route::get('pacientes/distbypro/{id}','Archivos\PacientesController@distbypro');


Route::get('archivos/pacientes/empresas','Archivos\PacientesController@empresas');
Route::get('archivos/pacientes/nada','Archivos\PacientesController@nada');


Route::get('cierre-caja','CajaController@index')->name('cierre.index')->middleware('auth');
Route::get('cierre-caja-reporte-{fecha}','CajaController@reporte_pdf')->name('cierre.reporte')->middleware('auth');
Route::post('cierre-caja-create','CajaController@create')->name('cierre.create')->middleware('auth');
Route::get('caja-delete-{id}','CajaController@delete');


Route::get('recibo_caja_ver/{id}','ReportesController@recibo_caja_ver');
Route::get('recibo_caja_verd/{id}','ReportesController@recibo_caja_verd');
Route::get('recibo_caja_ver2/{id}/{fecha1?}/{fecha2?}','ReportesController@recibo_caja_ver2');
Route::get('recibo_caja_ver2d/{id}/{fecha1?}/{fecha2?}','ReportesController@recibo_caja_ver2d');


Route::get('events/si','Events\EventController@si');
Route::get('events/no','Events\EventController@no');



Route::get('paquetes', 'Archivos\PaquetesController@index')->name('paquetes.index')->middleware('auth');
Route::get('paquetes-search', 'Archivos\PaquetesController@search')->name('paquetes.search')->middleware('auth');
Route::get('paquetes-create', 'Archivos\PaquetesController@createView')->name('paquetes.create')->middleware('auth');
Route::post('paquetes/create', 'Archivos\PaquetesController@create')->middleware('auth');
Route::get('paquetes-edit-{id}', 'Archivos\PaquetesController@edit')->middleware('auth');
Route::post('paquetes/edit/{id}', 'Archivos\PaquetesController@update')->middleware('auth');
Route::get('paquetes/{id}', 'Archivos\PaquetesController@delete')->middleware('auth');
Route::get('paquete/view/{id}', 'Archivos\PaquetesController@show')->middleware('auth');
Route::get('paquete/getPaquete/{id}', 'Archivos\PaquetesController@getPaquete');
Route::get('paquete/laboratorio_eliminar/{id}', 'Archivos\PaquetesController@deleteLab');
Route::get('paquete/servicio_eliminar/{id}', 'Archivos\PaquetesController@deleteServ');
Route::get('paquetes-addItems-{paquete}', 'Archivos\PaquetesController@addItems');
Route::post('paquetes/storeItems/{paquete}', 'Archivos\PaquetesController@storeItems');
Route::get('paquetes-delete-{id}','Archivos\PaquetesController@delete');

//Prenatal
Route::get('prenatal-create', 'PrenatalController@createView')->name('prenatal.create')->middleware('auth');
Route::get('prenatal-ver-{id}', 'PrenatalController@show')->name('prenatal.show')->middleware('auth');
Route::get('prenatal-ficha-{id}', 'PrenatalController@FichaView')->name('prenatal.ficha')->middleware('auth');
Route::get('prenatal-control-{id}', 'PrenatalController@createControlView')->name('prenatal.control')->middleware('auth');
Route::get('prenatal-vercontrol-{id}', 'PrenatalController@verControl')->name('prenatal.vercontrol')->middleware('auth');
Route::get('prenatal-vercontrol2-{id}', 'PrenatalController@verControl2')->name('prenatal.vercontrol2')->middleware('auth');
Route::post('prenatal/create', 'PrenatalController@create')->middleware('auth');
Route::post('control/create', 'PrenatalController@createControl')->middleware('auth');
Route::get('prenatal', 'PrenatalController@index')->name('prenatal.index')->middleware('auth');
Route::get('prenatal-search', 'PrenatalController@search')->name('prenatal.search')->middleware('auth');


/**
 * Atenciones
 */
Route::get('atenciones', 'AtencionesController@index')->name('atenciones.index')->middleware('auth');
Route::get('atenciones-search', 'AtencionesController@search')->name('atenciones.search')->middleware('auth');
Route::get('atenciones-create', 'AtencionesController@createView')->name('atenciones.create')->middleware('auth');
Route::post('guardar-atencion', 'AtencionesController@create')->middleware('auth');
Route::get('atenciones/{id}', 'AtencionesController@delete')->middleware('auth');
Route::get('atenciones-edit-{id}', 'AtencionesController@editView')->name('atenciones.edit');
Route::post('atenciones/edit/{id}', 'AtencionesController@edit');
Route::get('atenciones-delete-{id}','AtencionesController@delete');
Route::get('atenciones-atender', 'AtencionesController@atender');

//index ingresos todos






Route::get('gastos', 'GastosController@index')->name('gastos.index')->middleware('auth');
Route::get('gastos-search', 'GastosController@search')->name('gastos.search')->middleware('auth');
Route::get('gastos-create', 'GastosController@createView')->name('gastos.create')->middleware('auth');
Route::post('gastos/create', 'GastosController@create')->middleware('auth');
Route::get('gastos/{id}', 'GastosController@delete')->middleware('auth');
Route::get('gastos-edit-{id}', 'GastosController@editView')->name('gastos.edit');
Route::post('gastos/edit', 'GastosController@edit');
Route::get('gastos-delete-{id}','GastosController@delete');


Route::get('labporpagar', 'LabporPagarController@index')->name('labporpagar.index')->middleware('auth');
Route::get('labporpagar-search', 'LabporPagarController@search')->name('labporpagar.search')->middleware('auth');
Route::get('labporpagar-create', 'LabporPagarController@createView')->name('labporpagar.create')->middleware('auth');
Route::post('labporpagar/create', 'LabporPagarController@create')->middleware('auth');
Route::get('labporpagar/{id}', 'LabporPagarController@delete')->middleware('auth');
Route::get('labporpagar-edit-{id}', 'LabporPagarController@editView')->name('labporpagar.edit');
Route::post('labporpagar/edit', 'LabporPagarController@edit');
Route::get('pagar/{id}', 'LabporPagarController@pagar')->middleware('auth');

Route::get('labpagados', 'LaboratoriosPagadosController@index')->name('labpagados.index')->middleware('auth');


Route::get('comporpagar', 'ComporPagarController@index')->name('comporpagar.index')->middleware('auth');
Route::get('comporpagar-search', 'ComporPagarController@search')->name('comporpagar.search')->middleware('auth');
Route::get('comporpagar-create', 'ComporPagarController@createView')->name('comporpagar.create')->middleware('auth');
Route::post('comporpagar/create', 'ComporPagarController@create')->middleware('auth');
Route::get('comporpagar/{id}', 'ComporPagarController@delete')->middleware('auth');
Route::get('comporpagar-edit-{id}', 'ComporPagarController@editView')->name('comporpagar.edit');
Route::post('comporpagar/edit', 'ComporPagarController@edit');
Route::post('pagarmultiple', 'ComporPagarController@pagarmultiple');
Route::get('pagarcom/{id}', 'ComporPagarController@pagarcom')->middleware('auth');

Route::get('comporpagartec', 'ComisionesPorPagarTecController@index')->name('comporpagartec.index')->middleware('auth');
Route::get('comporpagartec-search', 'ComisionesPorPagarTecController@search')->name('comporpagartec.search')->middleware('auth');
Route::get('comporpagartec-create', 'ComisionesPorPagarTecController@createView')->name('comporpagartec.create')->middleware('auth');
Route::post('comporpagartec/create', 'ComisionesPorPagarTecController@create')->middleware('auth');
Route::get('comporpagartec/{id}', 'ComisionesPorPagarTecController@delete')->middleware('auth');
Route::get('comporpagartec-edit-{id}', 'ComisionesPorPagarTecController@editView')->name('comporpagartec.edit');
Route::post('comporpagartec/edit', 'ComisionesPorPagarTecController@edit');
Route::post('pagarmultipletec', 'ComisionesPorPagarTecController@pagarmultiple');
Route::get('pagarcomtec/{id}', 'ComisionesPorPagarTecController@pagarcom')->middleware('auth');

Route::get('compunziones', 'ComisionesPunzionesController@index')->name('compunziones.index')->middleware('auth');
Route::post('pagarmultiplep', 'ComisionesPunzionesController@pagarmultiple');
Route::get('pagarcomp/{id}', 'ComisionesPunzionesController@pagarcom')->middleware('auth');


Route::get('compagadas', 'ComisionesPagadasController@index')->name('compagadas.index')->middleware('auth');
Route::get('compagadas-search', 'ComisionesPagadasController@search')->name('compagadas.search')->middleware('auth');
Route::get('reversar/{id}', 'ComisionesPagadasController@reversar')->middleware('auth');

Route::get('comollego', 'ComollegoController@index')->name('comollego.index')->middleware('auth');
Route::get('comollego-search', 'ComollegoController@search')->name('comollego.search')->middleware('auth');


Route::get('comporentregar', 'ComisionesporEntregarController@index')->name('comporentregar.index')->middleware('auth');
Route::get('comporentregar-search', 'ComisionesporEntregarController@search')->name('comporentregar.search')->middleware('auth');
Route::get('entregar/{id}', 'ComisionesporEntregarController@entregar')->middleware('auth');

Route::get('comentregadas', 'ComisionesEntregadasController@index')->name('comentregadas.index')->middleware('auth');
Route::get('comentregadas-search', 'ComisionesEntregadasController@search')->name('comentregadas.search')->middleware('auth');

Route::get('visitas', 'VisitasController@index')->name('visitas.index')->middleware('auth');
Route::get('visitas-search', 'VisitasController@search')->name('visitas.search')->middleware('auth');
Route::get('visitar', 'VisitasController@visitar');
Route::get('visitar-create', 'VisitasController@createView')->name('visitar.create')->middleware('auth');
Route::post('visitar/create', 'VisitasController@create')->middleware('auth');

Route::get('ingresos', 'OtrosIngresosController@index')->name('ingresos.index')->middleware('auth');
Route::get('ingresos-search', 'OtrosIngresosController@search')->name('ingresos.search')->middleware('auth');
Route::get('ingresos-create', 'OtrosIngresosController@createView')->name('ingresos.create')->middleware('auth');
Route::post('ingresos/create', 'OtrosIngresosController@create')->middleware('auth');
Route::get('ingresos-delete-{id}', 'OtrosIngresosController@delete')->middleware('auth');
Route::get('ingresos-edit-{id}', 'OtrosIngresosController@editView')->name('ingresos.edit');
Route::post('ingresos/edit', 'OtrosIngresosController@edit');

Route::get('cuentasporcobrar', 'CuentasporCobrarController@index')->name('cuentasporcobrar.index')->middleware('auth');
Route::get('cuentasporcobrar-search', 'CuentasporCobrarController@search')->name('cuentasporcobrar.search')->middleware('auth');
Route::get('cuentasporcobrar-create', 'CuentasporCobrarController@createView')->name('cuentasporcobrar.create')->middleware('auth');
Route::post('cuentasporcobrar/create', 'CuentasporCobrarController@create')->middleware('auth');
Route::get('cuentasporcobrar/{id}', 'CuentasporCobrarController@delete')->middleware('auth');
Route::get('cuentasporcobrar-edit-{id}', 'CuentasporCobrarController@editView')->name('cuentasporcobrar.edit');
Route::post('cuentasporcobrar/edit', 'CuentasporCobrarController@edit');

Route::get('historialcobros', 'HistorialCobrosController@index')->name('historialcobros.index')->middleware('auth');
Route::get('historialcobros-search', 'HistorialCobrosController@search')->name('historialcobros.search')->middleware('auth');
Route::get('historialcobros-delete-{id}','HistorialCobrosController@delete');


Route::get('labpagados', 'LaboratoriosPagadosController@index')->name('labpagados.index')->middleware('auth');


//////////7

Route::get('movimientos/atencion/personal','AtencionesController@personal');
Route::get('movimientos/atencion/profesional','AtencionesController@profesional');
Route::get('movimientos/atencion/convenio','AtencionesController@convenio');
Route::get('movimientos/atencion/recomendacion','AtencionesController@recomendacion');
Route::get('movimientos/atencion/seleccione','AtencionesController@seleccione');



Route::get('resultados', 'ResultadosController@index')->name('resultados.index')->middleware('auth');
Route::get('resultados-search', 'ResultadosController@search')->name('resultados.search')->middleware('auth');
Route::get('resultados-informe', 'ResultadosController@informe')->name('resultados.informe')->middleware('auth');
Route::get('resultados-informe-index', 'ResultadosController@informeIndex')->name('resultados.informe-index')->middleware('auth');
Route::get('resultados-informe-search', 'ResultadosController@informeSearch')->name('resultados.informe-search')->middleware('auth');
Route::get('resultados-informe-editar-{id}', 'ResultadosController@informeEditar')->name('resultados.informe-editar')->middleware('auth');
Route::post('resultados-informe-edit-{id}', 'ResultadosController@informeEdit')->name('resultados.informe-edit')->middleware('auth');
Route::post('informe-create','ResultadosController@informeCreate')->name('informe.create')->middleware('auth');
Route::get('resultados-create', 'ResultadosController@createView')->name('resultados.create')->middleware('auth');
Route::post('resultados/create', 'ResultadosController@create')->middleware('auth');
Route::get('resultados/{id}', 'ResultadosController@delete')->middleware('auth');
Route::get('resultados-edit-{id}', 'ResultadosController@editView')->name('resultados.edit');
Route::post('resultados/edit/{id}', 'ResultadosController@edit');

Route::get('resultadosguardados-ver-{id}', 'ReportesController@resultados_ver')->name('resultados.ver');
Route::get('resultadosguardados-editar-{id}', 'ReportesController@editar')->name('resultadosguardados.editar')->middleware('auth');
Route::post('resultadosguardados-update-{id}', 'ReportesController@update')->name('resultadosguardados.update')->middleware('auth');
Route::get('resultadosguardados', 'ResultadosGuardadosController@index')->name('resultadosguardados.index')->middleware('auth');
Route::get('resultadosguardados-search', 'ResultadosGuardadosController@search')->name('resultadosguardados.search')->middleware('auth');

Route::get('ticket-ver-{id}', 'ReportesController@ticket_ver')->name('ticket.ver');


Route::get('generalatenciones', 'ReporteIngresosController@indexa')->name('generalatenciones.indexa')->middleware('auth');
Route::get('generalatenciones-search', 'ReporteIngresosController@searcha')->name('generalatenciones.searcha')->middleware('auth');

Route::get('generalegresos', 'ReporteIngresosController@indexe')->name('generalegresos.indexe')->middleware('auth');
Route::get('generalegresos-search', 'ReporteIngresosController@searche')->name('generalegresos.searche')->middleware('auth');

Route::get('user', 'Users\UserController@index')->name('users.index')->middleware('auth');

Route::post('user/create', 'Users\UserController@create')->middleware('auth');
Route::get('user/{id}', 'Users\UserController@delete')->middleware('auth');

Route::get('/ui', function () { return view('layouts.admin'); })->name('ui');
Route::get('login', 'Users\UserController@loginView')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('user-create', 'Users\UserController@createView')->name('user.create')->middleware('auth');

Route::get('sedes', 'Config\SedeController@index')->name('sedes.index')->middleware('auth');

Route::get('sedes-create', 'Config\SedeController@createView')->name('sedes.create');
Route::post('sede/create', 'Config\SedeController@create')->middleware('auth');

//Productos
Route::get('productos', 'Existencias\ProductoController@index')->name('productos.index');
Route::get('productos2', 'Existencias\ProductoController@index2')->name('productos.index2');
Route::post('producto/create', 'Existencias\ProductoController@create')->name('producto.create');
Route::get('productos-create', 'Existencias\ProductoController@createView')->name('existencias.create');
Route::get('existencias-edit-{id}', 'Existencias\ProductoController@editView')->name('existencias.edit');

Route::post('producto/edit', 'Existencias\ProductoController@edit');
Route::delete('existencias-delete-{id}', 'Existencias\ProductoController@delete');
Route::get('existencias-in', 'Existencias\ProductoController@productInView')->name('productos.in');
Route::get('existencias-out', 'Existencias\ProductoController@productOutView')->name('productos.out');
Route::get('existencias-trans', 'Existencias\ProductoController@productTransView')->name('productos.trans');
Route::get('existencias-delete-{id}','Existencias\ProductoController@delete');
Route::get('existencia/{prod}/{sede}', 'Existencias\ProductoController@getExist');
Route::get('producto/{id}', 'Existencias\ProductoController@getProduct');
Route::post('transfer', 'Existencias\ProductoController@transfer');
Route::post('entrada', 'Existencias\ProductoController@entrada');
Route::post('producto/add', 'Existencias\ProductoController@addCant');
Route::get('historico', 'Existencias\ProductoController@historicoView')->name('historico');
Route::get('transferencia-{code}', 'Existencias\ProductoController@transView')->name('transferencia');

Route::get('punziones', 'Existencias\PunzionesController@index')->name('punziones.index');
Route::get('punziones-create', 'Existencias\PunzionesController@createView')->name('punziones.create');
Route::post('punzion/create', 'Existencias\PunzionesController@create');



Route::get('ventas', 'Existencias\ProductoController@indexv')->name('ventas.index');
Route::get('ventas-search', 'Existencias\ProductoController@search')->name('ventas.search');
Route::get('requerimientos', 'Existencias\RequerimientosController@index')->name('requerimientos.index')->middleware('auth');
Route::get('requerimientos1', 'Existencias\RequerimientosController@index2')->name('requerimientos.index2')->middleware('auth');
Route::get('requerimientos2', 'Existencias\RequerimientosController@index3')->name('requerimientos.index3')->middleware('auth');
Route::get('requerimientos-search', 'Existencias\RequerimientosController@search')->name('requerimientos.search')->middleware('auth');
Route::get('requerimientos-create', 'Existencias\RequerimientosController@createView')->name('requerimientos.create')->middleware('auth');
Route::post('requerimientos/create', 'Existencias\RequerimientosController@create')->middleware('auth');
Route::get('requerimientos-edit-{id}', 'Existencias\RequerimientosController@editView')->name('requerimientos.edit');
Route::get('requerimientos-reversar-{id}', 'Existencias\RequerimientosController@reversar');
Route::get('procesar/{id}', 'Existencias\RequerimientosController@procesar')->middleware('auth');
//Route::get('requerimientos-edit-{id}', 'Existencias\RequerimientosController@editView')->name('requerimientos.edit');
Route::get('requerimientos-edit', 'Existencias\RequerimientosController@edit');
Route::get('requerimientos-delete-{id}', 'Existencias\RequerimientosController@delete');




//Medidas
Route::get('medidas', 'Config\MedidaController@index')->name('medidas.index');
Route::get('medidas-create', 'Config\MedidaController@createView')->name('medidas.create');
Route::get('medidas-edit-{id}', 'Config\MedidaController@editView')->name('medidas.edit');

//Proveedores
Route::get('proveedores', 'Config\ProveedorController@index')->name('proveedores.index');
Route::get('proveedores-create', 'Config\ProveedorController@createView')->name('proveedores.create');
Route::get('proveedores-edit-{id}', 'Config\ProveedorController@editView')->name('proveedores.edit');
Route::post('proveedor/create', 'Config\ProveedorController@create');
Route::get('proveedores-delete-{id}','Config\ProveedorController@delete');
Route::post('proveedores/edit', 'Config\ProveedorController@edit');



//Categorias
Route::get('categorias', 'Config\CategoriaController@index')->name('categorias.index');
Route::get('categorias-create', 'Config\CategoriaController@createView')->name('categorias.create');
Route::get('categorias-edit-{id}', 'Config\CategoriaController@editView')->name('categorias.edit');

//Consultas
Route::get('consulta','Events\EventController@all')->name('consultas.inicio')->middleware('auth');
Route::get('consulta-edit-{id}','Events\EventController@editView_consulta')->name('consultas.edit')->middleware('auth');
Route::get('consulta-delete-{id}','Events\EventController@delete_consulta')->name('consultas.delete')->middleware('auth');
Route::get('consulta-ticket-ver-{id}','Events\EventController@ticket_ver');
Route::post('consulta/edit', 'Events\EventController@edit_consulta');
Route::get('event-{id}','Events\EventController@show');
Route::match(['get', 'post'], 'events', 'Events\EventController@index')->name('consultas.index');
Route::get('available-time/{e}/{d}/{m}/{y}', 'Events\EventController@availableTime');
Route::get('consulta-create', 'Events\EventController@createView')->name('consultas.create');
Route::post('consulta/create', 'Events\EventController@create');
Route::post('historial/create','HistorialController@create')->name('historials.create');
Route::post('observacion-create','ConsultaController@create')->name('observacions.create');
Route::get('proximacita', 'ConsultaController@index')->name('proximacita.index')->middleware('auth');
Route::get('proximacita-search', 'ConsultaController@search')->name('proximacita.search')->middleware('auth');
Route::post('treatment/create','TreatmentController@create')->middleware('auth');
Route::get('ficha-{id}', 'TreatmentController@report');
Route::get('historias', 'ConsultaController@indexh')->name('historias.index')->middleware('auth');
Route::get('historias-{id}', 'ConsultaController@report');
Route::get('historiasp-ver-{id}', 'ConsultaController@ver');


Route::get('ficha-create', 'Events\EventControllerr@createficha')->name('ficha.create')->middleware('auth');



//Servicios
Route::match(['get', 'post'],'services','ServiceController@index')->name('service.index')->middleware('auth');
Route::get('services-create','ServiceController@createView')->name('service.create')->middleware('auth');
Route::get('services-delete-{id}','ServiceController@delete')->name('service.delete')->middleware('auth');
Route::get('services-edit-{id}','ServiceController@editView')->name('service.edit')->middleware('auth');
Route::post('services/edit','ServiceController@edit')->name('service.editar')->middleware('auth');
Route::get('services-inicio','ServiceController@inicio')->name('service.inicio')->middleware('auth');
Route::post('services/create', 'ServiceController@create')->middleware('auth');
Route::get('service-{id}','ServiceController@show')->middleware('auth');

Route::get('service/consultas','ServiceController@consultas');
Route::get('service/servicios','ServiceController@servicios');
Route::get('service/punziones','ServiceController@punziones');


//Route::get('service-available-time/{e}/{d}/{m}/{y}', 'ServiceController@availableTime');
/**
 * Reportes
 */
Route::get('reporte-solicitar_diario', 'ReportesController@formDiario')->name('solicitar.consolidado');
Route::get('reporte-solicitar_consolidado', 'ReportesController@formConsolidado')->name('solicitar.diario');
Route::post('reporte/diario', 'ReportesController@relacion_diario');
Route::post('reporte/detallado', 'ReportesController@relacion_detallado');
Route::get('recibo_profesionales_ver/{id}','ReportesController@recibo_profesionales_ver');


Route::get('historial', 'HistorialesController@index')->name('historial.index')->middleware('auth');
Route::get('historial-search', 'HistorialesController@search')->name('historial.search')->middleware('auth');
