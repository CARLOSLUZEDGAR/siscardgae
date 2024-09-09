<?php

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
/**
 * Rutas de funciones estandarizadas
 */

// RUTAS DGAE //

//**************************RUTAS DE ACCESO AL SISTEMA******************************* */


/**
 * Rutas para personal
 */
Route::get('/listPer','PersonalController@ListPersonal');
Route::post('/datPer','PersonalController@DatosPersonalesAcceso');

/**
 * RUTAS PARA CREACION DE USUARIOS
 */
Route::post('/crearUsuario','UsuarioController@CrearUsuario'); //BASE
Route::post('/listarUsuarios','UsuarioController@ListarUsuarios');
Route::post('/datosUsuarios','UsuarioController@DatosUsuarios'); 
Route::put('/editarUsuarios','UsuarioController@EditarUsuario'); //BASE
Route::put('/cambiarEstadoUsuario','UsuarioController@CambiarEstadoUsuario');
Route::get('/datosUsuario','UsuarioController@DatosUsuario');
Route::post('/editContrasena','UsuarioController@EditContrasena');

Route::post('/authenticate/ingreso','Auth\LoginController@login');
Route::get('/authenticate/salir','Auth\LoginController@logout')->name('logout');
Route::get('/listarPermisos','Auth\LoginController@ListarPermisos');
Route::get('/login','Auth\LoginController@VistaLogin')->name('login');

/**
 * rutas para la admnitraciond e datos
 */
Route::post('/listarol','RoleController@ListarRole');
Route::post('/listarol2','RoleController@ListarRole2'); //Roles qu no tiene aasignado el usuario
Route::post('/listarolus','RoleController@ListarRoleUsuario');
Route::post('/listarPermisos','RoleController@ListarPermisos');
Route::post('/listaRolPermiso','RoleController@ListaRolPermiso');
Route::post('/guardarRol','RoleController@GuardarRol');
Route::post('/editarRol','RoleController@EditarRol');
Route::get('/listarRoles','RoleController@ListarRoles'); //BASE
//rutas que permiten adicionar y quitar roles a los usuarios
Route::post('/agregarRol','RoleController@AgregarRol');
Route::post('/quitarRol','RoleController@QuitarRol');

/**
 * Rutas para listar permisos
 */
Route::post('/listapermisos','PermisoController@ListarPermisos');
Route::post('/guadarPermiso','PermisoController@GuardarPermisos');
Route::post('/editarPermiso','PermisoController@EditarPermisos');
Route::post('/datosPermiso','PermisoController@DatosPermiso');
Route::get('/listarModulos','PermisoController@ListarModulos');

//NOMBRE DEL USUARIO
Route::get('/datosP','DatosController@datosP');



Route::post('/listarEntidad','EntidadController@ListarEntidad');
Route::post('/crearPersonal','PersonalController@CrearPersonal');
Route::post('/listarGrado','GradoController@ListarGrado');
Route::post('/listarNacionalidad','NacionalidadController@ListarNacionalidad');
Route::post('/listarCategoria','CategoriaController@ListarCategoria');
Route::post('/listarLicencia','LicenciaController@ListarLicencia');
Route::post('/listarHabilitacion','HabilitacionController@ListarHabilitacion');
Route::post('/listarCompetenciaLinguistica','CompetenciaLinguisticaController@ListarCompetenciaLinguistica');
Route::post('/listarPersonal','PersonalController@ListarPersonal');
Route::post('/selectNacionalidad','NacionalidadController@selectNacionalidad');
Route::post('/renovarPersonal','PersonalController@RenovarPersonal');
Route::post('/listarGranUnidad','GranUnidadController@ListarGranUnidad');
Route::post('/listarUnidad','UnidadController@ListarUnidad');


Route::post('/listarAeronave','AeronaveController@ListarAeronave');
Route::post('/crearAeronave','AeronaveController@CrearAeronave');
Route::post('/datosAeronave','AeronaveController@DatosAeronave');
Route::post('/renovarAeronave','AeronaveController@RenovarAeronave');

Route::get('/carnet','ReporteController@GenerarCarnet');
Route::get('/personal','ReporteController@GenerarReportePersonal');
Route::get('/lista','ReporteController@GenerarReporteLicencias');
Route::get('/downloadPDF','ReporteController@DownloadPDF');



Route::post('/crearNacionalidad','NacionalidadController@CrearNacionalidad');
Route::post('/crearEntidad','EntidadController@CrearEntidad');
Route::post('/datosPersonal','PersonalController@DatosPersonal');

// FIN RUTAS DGAE //





/* Rutas Sof. Alberto */
Route::post('/listarPersonal2', 'PersonalController@listperdest');


Route::post('/listarPersonalDestinos', 'PersonalDestinosController@index');
Route::post('/registrarDestino', 'PersonalDestinosController@store');
Route::put('/editarDestino', 'PersonalDestinosController@update');
Route::put('/desactivarDestino', 'PersonalDestinosController@desactivarDestino');

Route::post('/actualizarDestino','PersonalDestinosController@index');

Route::post('/cambiarGrado','PersonalDestinosController@cambiarGrado');

Route::post('/listarPersonalDestAct', 'PersonalDestinosController@destact');
Route::post('/mailDestinos', 'PersonalDestinosController@mailDestinos');



//SELECT DINAMICOS
Route::get('/destinos_nivel1/selectDestinos_nivel1', 'Nivel1_destinoController@SelectNivel1Destino');
Route::get('/destinos_nivel2/selectDestinos_nivel2', 'Nivel2_destinoController@selectDestinosNivel2');
Route::get('/destinos_nivel2/selectbuscarDestinos_nivel2', 'Nivel2_destinoController@selectbuscarDestinosNivel2');
Route::get('/destinos_nivel3/selectDestinos_nivel3', 'Nivel3_destinoController@selectDestinosNivel3');
Route::get('/destinos_nivel3/selectbuscarDestinos_nivel3', 'Nivel3_destinoController@selectbuscarDestinosNivel3');
Route::get('/destinos_nivel4/selectDestinos_nivel4', 'Nivel4_destinoController@selectDestinosNivel4');
Route::get('/destinos_nivel4/selectbuscarDestinos_nivel4', 'Nivel4_destinoController@selectbuscarDestinosNivel4');
//FIN SELECTS DINAMICOS
//BUSCADOR CON SELECT
Route::post('/listarCargos','CargoController@ListarCargos');
//FIN BUSCADOR CON SELECT
//REPORTE FPDF
Route::get('/ordenDestinos', 'ReporteDestinosController@createPDF');
Route::get('/cuadroEfectivos', 'PersonalDestinosController@cuadroEfectivos');

//REPORTE DOMPDF
Route::get('/reporteDesglose','ReportesDestinosController@ReporteDesglose');
Route::get('/certificadoDestAscenso','ReportesDestinosController@CertificadoDestAscenso');
Route::get('/certificadoDestFrontera','ReportesDestinosController@CertificadoDestFrontera');
Route::get('/certificadoDestDesglose','ReportesDestinosController@CertificadoDestDesglose');
Route::get('/certificadoDesglServicio','ReportesDestinosController@CertDesglServicio');
//Route::get('/reparticiones','ReportesDestinosController@Subreparticiones');

//ELIMINAR
Route::get('/cuadroPericia', 'PruebaReportesController@cuadroPericias');
Route::get('/cuadroEfectivoTotal', 'PruebaReportesController@cuadroEfectivoTotal');
Route::get('/cuadroEgresadoNoEgresado', 'PruebaReportesController@cuadroEgresadosNoEgresados');
Route::get('/cuadroFamiliaresPersonal', 'PruebaReportesController@cuadroFamiliaresPersonal');
Route::get('/cuadroPromocionCant', 'PruebaReportesController@cuadroPromocionCant');
Route::get('/cuadroSituacionPersonal', 'PruebaReportesController@cuadroSituacionPersonal');
Route::get('/cuadroFechaIncorporacion', 'PruebaReportesController@cuadroFechaIncorporacion');
Route::get('/cuadroDatosPersonal', 'ReporteDatosPersonalesController@createPDF');

//FIN ELIMINAR

//FIN REPORTE
// Route::post('/datosPersonal','PersonalDatosController@perdatdest');

/**PERSONAL ESPECIALIDADES */
Route::post('/listarEspecialidades','EspecialidadController@ListarEspecialidad');
Route::post('/listarSubespecialidades','SubespecialidadController@ListarSubespecialidad');
Route::post('/listarPersonalEspecialidad', 'PersonalEspecialidadController@index');
Route::post('/registrarEspecialidad', 'EspecialidadController@storeEspecialidad');
Route::put('/editarEspecialidad', 'EspecialidadController@updateEspecialidad');
Route::put('/desactivarEspecialidad', 'EspecialidadController@desactivarEspecialidad');
Route::put('/activarEspecialidad', 'EspecialidadController@activarEspecialidad');

Route::post('/registrarSubespecialidad', 'SubespecialidadController@storeSubespecialidad');
Route::put('/editarSubespecialidad', 'SubespecialidadController@updateSubespecialidad');
Route::put('/desactivarSubespecialidad', 'SubespecialidadController@desactivarSubespecialidad');
Route::put('/activarSubespecialidad', 'SubespecialidadController@activarSubespecialidad');

Route::get('/especialidad/selectEspecialidad', 'EspecialidadController@SelectEspecialidad');
Route::get('/subespecialidad/selectSubespecialidad', 'SubespecialidadController@SelectSubespecialidad');
Route::get('/subespecialidad/selectbuscarSubespecialidad', 'SubespecialidadController@selectbuscarSubespecialidad');

Route::post('/registrarPerEspecialidad', 'PersonalEspecialidadController@storePerEspecialidad');
Route::put('/editarPerEspecialidad', 'PersonalEspecialidadController@updatePerEspecialidad');
Route::put('/desactivarPerEspecialidad', 'PersonalEspecialidadController@desactivarPerEspecialidad');


Route::get('/reporteEspecialidad','ReportesEspecialidadesController@ReporteEspecialidad');
Route::get('/reporteSubespecialidad','ReportesEspecialidadesController@ReporteSubespecialidad');
Route::get('/reporteEspecialidadPromocion','ReportesEspecialidadesController@ReporteEspecialidadPromocion');
Route::get('/reporteEspecialidadGrado','ReportesEspecialidadesController@ReporteEspecialidadGrado');
Route::get('/reporteEspecialidadEspecialidad','ReportesEspecialidadesController@ReporteEspecialidadEspecialidad');
Route::get('/reporteEspecialidadDestino','ReportesEspecialidadesController@ReporteEspecialidadDestino');
Route::get('/reporteEspecialidadGenero','ReportesEspecialidadesController@ReporteEspecialidadGenero');

Route::get('/cuadroEfectivoEspe','ReportesEspecialidadesController@CuadroEfectivoEspecialidades');


Route::post('/listarPerPromo', 'PersonalEspecialidadController@showPerPromo');
Route::post('/listarPerGrado', 'PersonalEspecialidadController@showPerGrado');
Route::post('/listarPerEspecialidad', 'PersonalEspecialidadController@showPerEspecialidad');
Route::post('/listarPerDestino', 'PersonalEspecialidadController@showPerDestino');
Route::post('/listarPerGenero', 'PersonalEspecialidadController@showPerGenero');

Route::get('/gradoEspecialidad', 'PersonalEspecialidadController@SelectEspeGrado');


/**FIN PERSONAL ESPECIALIDADES */

// INICIO REPORTES
Route::get('/curriculumComanjefe','ReportesPersonalController@CurriculumComanjefe');
Route::get('/curriculumExtendido','ReportesPersonalController@CurriculumExtendido');
Route::get('/curriculumResumen','ReportesPersonalController@CurriculumResumen');
Route::get('/certificadoTrabajo','ReportesPersonalController@CertificadoTrabajo');
Route::get('/curriculumVitae','ReportesPersonalController@CurriculumVitae');
Route::get('/hojaVida','ReportesPersonalController@HojaVida');
Route::get('/tiempoServicio','ReportesPersonalController@TiempoServicio');

// FIN REPORTES


/* ************************* PAISES, BREVETS, CURSOS, PERSONAL CURSOS Y BREVETS Y REPORTES - PABLO GUERRA ************************************* */

//PERSONAL

//PERSONAL TRIBUNAL
Route::post('/listarPersonalTribunal','PersonalController@listarPersonalTribunal');

//PERSONAL BREVETS
Route::post('/listadoPersona','PersonalController@listadoPersona');
//PERSONAL CURSOS
Route::post('/listaPersonalCursos','PersonalController@listaPersonalCursos');

//PAISES
Route::get('/listarPaises','PaisesController@ListarPaises');

//BREVETS
Route::post('/listadoBrevets','BrevetsController@listadoBrevets');
Route::get('/listarSubEsca','BrevetsController@listarSubEsca');
Route::post('/crearNueBrevet/RegNuevBrevet','BrevetsController@store');
Route::post('/modificarNuevoBrevet','BrevetsController@update');
Route::post('/brevets/cambiarEstado', 'BrevetsController@cambiarEstado');

//PERSONAL BREVETS
Route::post('/datosPersoBrevets', 'PersonalBrevetsController@DatosPersonales');
Route::post('/listarPersonalBrevets','PersonalBrevetsController@listarBrevets');
Route::post('/crearBrevets','PersonalBrevetsController@store');
Route::post('/modificarBrevet','PersonalBrevetsController@update');
Route::post('/listarBrevets','BrevetsController@listarBrevets');
Route::post('/personalBrevets/cambiarEstado', 'PersonalBrevetsController@cambiarEstado');

//MIEMBROS TRIBUNALES
Route::post('/datosPersoTrib', 'PersonalTribunalesController@DatosPersonales');
Route::post('/listaMiembrosTribunal','TribunalesController@listarMiembTrib');
Route::post('/listaSubEsca','TribunalesController@listaSubEsca');
Route::post('/listarMiembrosTribunales','TribunalesController@listarMiembroTribunal');
Route::post('/crearNueTribunal/RegNuevTribunal','TribunalesController@store');
Route::post('/modificarNuevoTribunal','TribunalesController@update');
Route::post('/tribunales/cambiarEstado', 'TribunalesController@cambiarEstado');

//TRIBUNALES
Route::post('/listarPersonalTribunales','PersonalTribunalesController@listarTribunales');
Route::post('/RegistrarNuevoTribunal','PersonalTribunalesController@store');
Route::post('/actualizarNuevoTribunal','PersonalTribunalesController@update');
Route::post('/personaltribunal/cambiarEstado', 'PersonalTribunalesController@cambiarEstado');

//REPORTES
Route::get('/reporte/gendocbrevetpersonal','ReporteBrevetsController@gendocbrevetpersonal');
Route::get('/reporte/generarRangofechas','ReporteBrevetsController@generarRangofechas');
Route::get('/reporte/gendoctribunalpersonal','ReporteTribunalesController@gendoctribunalpersonal');
Route::get('/reporte/generarRangofechasTribunales','ReporteTribunalesController@generarRangofechasTribunales');
Route::get('/reporte/generarRangofechasPersonalCursos','ReportePersonalCursosController@generarRangofechasPersonalCursos');
Route::get('/reporte/gendocpersonalcurso','ReportePersonalCursosController@gendocpersonalcurso');
Route::get('/reporte/dipsupsgtos/{id}','ReportePersonalCursosController@gendocdipsupsgtos');

//CURSOS
Route::post('/listCurso','CursosController@listCurso');
Route::post('/crearNueCurso/RegNuevCurso','CursosController@store');
Route::post('/modificarCurso','CursosController@update');
Route::post('/cursos/cambiarEstado', 'CursosController@cambiarEstado');

//TIPO CURSOS
Route::post('/listTipoCurso','TipoCursosController@listTipoCurso');
Route::get('/listarCursos','CursosController@ListarCursos');
Route::post('RegistroNuevoTipoCurso','TipoCursosController@store');
Route::post('/modificarTipoCurso','TipoCursosController@update');
Route::post('/tipo_cursos/cambiarEstado', 'TipoCursosController@cambiarEstado');

//DESGLOSE CURSOS
Route::post('/listDesgloseCurso','DesgloseCursosController@listDesgloseCurso');
Route::get('/listarTipoCursos','TipoCursosController@ListarTipoCursos');
Route::post('RegistroNuevoDesgloseCurso','DesgloseCursosController@store');
Route::post('/modificarDesgloseCurso','DesgloseCursosController@update');
Route::post('/desglose_cursos/cambiarEstado', 'DesgloseCursosController@cambiarEstado');

//PERSONAL CURSOS
Route::post('/datosPersoCursos', 'PersonalCursosController@DatosPersonales');
Route::post('/listadoCursos','PersonalCursosController@listadoCursos');
Route::post('/nuevPerCur','PersonalCursosController@store');
Route::post('/modificarPerCur','PersonalCursosController@update');
Route::post('/percursos/cambiarEstado', 'PersonalCursosController@cambiarEstado');

//EMISORES
Route::get('/listarEmisores','EmisoresController@listarEmisores');

//COMBOS ANIDADOS
Route::get('/tipo_cursos/selectbuscarTipoCursos','TipoCursosController@selectbuscarTipoCursos');
Route::post('/tip_curso/searchTipoCursos','TipoCursosController@searchTipoCursos');
Route::get('/desglo_cursos/selectbuscarDesgloCursos','DesgloseCursosController@selectbuscarDesgloCursos');
Route::post('/desg_curso/searchDesgloCursos','DesgloseCursosController@searchDesgloCursos');
Route::get('/tipo_emisor/selectbuscarTipoEmisor','TipoEmisoresController@selectbuscarTipoEmisor');
Route::post('/tip_emisores/searchTypeEmisor','TipoEmisoresController@searchTypeEmisor');

/* ************************************ FINAL PABLO ********************************* */

/* ********COMPLEMENTO************ */
Route::get('/listarEstudio','EstudioController@ListarEstudio');

Route::post('/registrarEstudio','EstudioController@RegistrarEstudio');
Route::put('/editarEstudio','EstudioController@EditarEstudio');
Route::put('/desactivarEstudio','EstudioController@DesactivarEstudio');
Route::put('/activarEstudio','EstudioController@ActivarEstudio');

Route::get('/selectEstudio', 'EstudioController@SelectEstudio');

/* ********COMPLEMENTO PERSONAL************ */
//Route::get('/listarPersonalEstudio', 'PersonalController@index');
Route::post('/listarEstudioPersonal', 'PersonalEstudioController@index');
Route::post('/estudioPersonal/registrar','PersonalEstudioController@store');
Route::post('/listarPerEstudioModificar','PersonalEstudioController@DatosPersonalEstudioModificar');
Route::put('/estudioPersonal/actualizar','PersonalEstudioController@update');
Route::put('/desactivarEstudioPersonal', 'PersonalEstudioController@desactivarEstudioPer');
Route::post('/estudioPersonal/eliminarEstudio', 'PersonalEstudioController@EliminarEstudio');
Route::get('/reporte/generareportcomplepersonal','ReporteEstudioController@generareportcomplepersonal');
/* ********COMPONENTE PERSONAL EME************ */
Route::post('/personaEME', 'PersonalComponenteController@index');
Route::post('/listarComponentePersona', 'PersonalComponenteController@listarComponente');   //usado npara listas compopnentes de persona
Route::post('/componentePersonal/registrar','PersonalComponenteController@store');
Route::put('/componentePersonal/actualizar','PersonalComponenteController@update');
Route::get('/ReportePersonalComponente','PersonalComponenteController@PersonalComponenteReporte');

//********** COMPONENTE ********** */

Route::get ('/componente','ComponenteController@index');
Route::post('/componente/registrar','ComponenteController@store');
Route::put('/componente/actualizar','ComponenteController@update');
Route::post('/componente/cambiarEstado', 'ComponenteController@cambiarEstado');
Route::get('/componente/selectComponente', 'ComponenteController@selectComponente');


/* *************************   ****************************************************************************   ********************************* */
//********** PREMIOS Y DISTINCIONES SOF AJATA********** ********************************/
Route::post('/listarPersonalPremios', 'PremiosDistincionesController@index');
Route::get('/institucion', 'PremiosDistincionesController@SelectInstitucion');
Route::get('/distincion2', 'PremiosDistincionesController@SelectDistincion2');
Route::get('/distincion3', 'PremiosDistincionesController@SelectDistincion3');
Route::put('/desactivarDistincion','PremiosDistincionesController@DesactivarDistincion');
Route::put('/activarDistincion','PremiosDistincionesController@ActivarDistincion');
Route::post('/registrarDistincion','PremiosDistincionesController@RegistrarDistincion');
Route::put('/actualizarDistincion', 'PremiosDistincionesController@ActualizarDistincion');
Route::get('/DistincionesPdf', 'PremiosDistincionesController@DistincionesPdf');

Route::post('/listarDistincion1','DistincionesNivel1Controller@ListarDistincion1');
Route::put('/desactivarDistincion1','DistincionesNivel1Controller@DesactivarDistincion1');
Route::put('/activarDistincion1','DistincionesNivel1Controller@ActivarDistincion1');
Route::post('/registrarDistincion1','DistincionesNivel1Controller@RegistrarDistincion1');
Route::put('/editarDistincion1','DistincionesNivel1Controller@ActualizarDistincion1');
Route::get('/PdfDistincionesNivel1', 'DistincionesNivel1Controller@DistincionesNivel1PDF');

Route::post('/listarDistincion2','DistincionesNivel2Controller@ListarDistincion2');
Route::put('/desactivarDistincion2','DistincionesNivel2Controller@DesactivarDistincion2');
Route::put('/activarDistincion2','DistincionesNivel2Controller@ActivarDistincion2');
Route::get('/listarInstitucion','DistincionesNivel2Controller@ListarInstitucion');
Route::post('/registrarDistincion2','DistincionesNivel2Controller@RegistrarDistincion2');
Route::put('/editarDistincion2','DistincionesNivel2Controller@ActualizarDistincion2');
Route::get('/PdfDistincionesNivel2', 'DistincionesNivel2Controller@DistincionesNivel2PDF');

Route::post('/listarDistincion3','DistincionesNivel3Controller@ListarDistincion3');
Route::put('/desactivarDistincion3','DistincionesNivel3Controller@DesactivarDistincion3');
Route::put('/activarDistincion3','DistincionesNivel3Controller@ActivarDistincion3');
Route::get('/listarDist2','DistincionesNivel3Controller@listarDist2');
Route::post('/registrarDistincion3','DistincionesNivel3Controller@RegistrarDistincion3');
Route::put('/editarDistincion3','DistincionesNivel3Controller@ActualizarDistincion3');
Route::get('/PdfDistincionesNivel3', 'DistincionesNivel3Controller@DistincionesNivel3PDF');

Route::post('/listarTipoReportePremios', 'ReportePremiosDistincionesController@ListadoGeneral');
Route::get('/ReporteGralPremios', 'ReportePremiosDistincionesController@ReporteGralPremiosPDF');

//********** SITUACION MILITAR --> MATTOS ********** */

Route::post('/registrarSituacion','SituacionController@RegistrarSituacion');
Route::post('/listarSituacion','PersonalSituacionController@ListarSituacionMilitar');
Route::post('/listarDatosPersonalSituacion','PersonalSituacionController@DatosPersonalesSituacion');
Route::post('/EditarSituacionMilitar','SituacionController@EditarSituacionMilitar');
Route::post('/EliminarSituacionMilitar','SituacionController@EliminarSituacionMilitar');
Route::get('/SituacionesPdf', 'PersonalSituacionController@SituacionesPdf');
Route::get('/SituacionesFechaPdf', 'PersonalSituacionController@SituacionesPorFechaPdf');


/**Rutas para Personal MATTOS */
Route::put('/editarPersonal','PersonalController@EditarPersonal');
Route::post('/datosPersonales','PersonalController@DatosPersonales');
// Route::post('/listarPersonal','PersonalController@ListarPersonal');
Route::get('/listarPersonalSituacion','PersonalController@index');

Route::get('/listarDestinos','DestinosController@ListarDestinos');
Route::get('/listarSituacionesCombo','SituacionController@ListarSituacionesCombo');
Route::post('/listarSubsituacionesCombo','SituacionController@ListarDatosSubsituacionesCombo');
Route::post('/listarDetalleSituacionesCombo','SituacionController@ListarDatosDetalleSituacionesCombo');
Route::post('/listarSituacionModificar','PersonalSituacionController@DatosSituacionMilitarModificar');

/**Rutas para Designaciones MATTOS */
Route::post('/listarDesignacion','PersonalDesignacionesController@ListarDesignaciones');
Route::post('/registrarDesignacion','DesignacionesController@RegistrarDesignacion');
Route::post('/editarDesignacion','DesignacionesController@EditarDesignacion');
Route::post('/listarDesignacionModificar','DesignacionesController@DatosDesignacionModificar');
Route::post('/eliminarDesignacion','DesignacionesController@EliminarDesignacion');
Route::get('/DesignacionesPdf', 'DesignacionesController@DesignacionesPdf');

/**Rutas para Representaciones y Delegaciones MATTOS */
Route::post('/listarRepresentacion','PersonalRepresentacionController@ListarRepresentacion');
Route::get('/listarRepresentacionesCombo','PersonalRepresentacionController@ListarRepresentacionesCombo');
Route::post('/registrarRepresentacion','PersonalRepresentacionController@RegistrarRepresentacion');
Route::post('/listarRepresentacionModificar','PersonalRepresentacionController@DatosRepresentacionModificar');
Route::post('/editarRepresentacion','PersonalRepresentacionController@EditarRepresentacion');
Route::post('/eliminarRepresentacion','PersonalRepresentacionController@EliminarRepresentacion');
Route::get('/RepresentacionesPdf', 'PersonalRepresentacionController@RepresentacionesPdf');

/**Rutas para Publicaciones MATTOS */
Route::post('/listarPublicacion','PersonalPublicacionController@ListarPublicacion');
Route::get('/listarPublicacionesCombo','PersonalPublicacionController@ListarPublicacionesCombo');
Route::post('/registrarPublicacion','PersonalPublicacionController@RegistrarPublicacion');
Route::post('/listarPublicacionModificar','PersonalPublicacionController@DatosPublicacionModificar');
Route::post('/editarPublicacion','PersonalPublicacionController@EditarPublicacion');
Route::post('/eliminarPublicacion','PersonalPublicacionController@EliminarPublicacion');
Route::get('/PublicacionesPdf', 'PersonalPublicacionController@PublicacionesPdf');

/* *************************ULTIMO QUISBERT************************************* */
//DATOS FAMILIARES
Route::get('/personallistardatfam', 'PersonalController@listarfam');
Route::post('/listarDatosFamiliares', 'DatosFamiliaresController@index');
Route::post('/datos_familiares/registrar','DatosFamiliaresController@store');
Route::put('/datos_familiares/actualizar','DatosFamiliaresController@update');
Route::put('/datos_familiares/desactivar','DatosFamiliaresController@desactivar');
Route::put('/datos_familiares/excluir','DatosFamiliaresController@excluirDatosFamiliares');
Route::get('/reporte/generareportpersonal','ReporteDatfamController@generareportpersonal');
//DATOS FISICOS
Route::post('/listarDatosFisicos', 'DatosFisicosController@index');
Route::post('/datos_fisicos_personal/registrar','DatosFisicosController@store');
Route::put('/datos_fisicos_personal/actualizar','DatosFisicosController@update');
Route::get('/reporte/generareportdatfispersonal','ReporteDatfisController@generareportdatfispersonal');

//DEPARTAMENTO - PROVINCIA - LOCALIDAD
Route::get('/localidad/selectLocalidad','LocalidadController@selectLocalidad');
Route::get('/localidad/selectbuscarLocalidad','LocalidadController@selectbuscarLocalidad');
Route::get('/departamento/selectDepartamento','DepartamentoController@selectDepartamento');
Route::post('/departamento/selectbuscarDepartamento', 'DepartamentoController@selectbuscarDepartamento');
Route::get('/provincia/selectProvincia','ProvinciaController@selectProvincia');
Route::get('/provincia/selectbuscarProvincia','ProvinciaController@selectbuscarProvincia');
Route::post('/provincia/selectbuscarProv','ProvinciaController@selectbuscarProv');
Route::post('/localidad/selectbuscarLoca','LocalidadController@selectbuscarLoca');


Route::post('/selectBuscaEspePer','PersonalEspecialidadesController@selectBuscaEspePer');

//CARRERAS
Route::get('/listarCarreras','CarrerasController@ListarCarreras');
Route::post('/registrarCarreras','CarrerasController@RegistrarCarreras');
Route::put('/editarCarreras','CarrerasController@EditarCarreras');
Route::put('/desactivarCarreras','CarrerasController@DesactivarCarreras');
Route::put('/activarCarreras','CarrerasController@ActivarCarreras');
Route::get('/selectCarreras', 'CarrerasController@SelectCarreras'); //select

//NIVEL PROFESIONAL
Route::get('/listarNivelProfesionals','Nivel_ProfesionalsController@ListarNivelProfesionals');
Route::post('/registrarNivelProfesionals','Nivel_ProfesionalsController@RegistrarNivelProfesionals'); //TRES
Route::put('/editarNivelProfesionals','Nivel_ProfesionalsController@EditarNivelProfesionals');//TRES_3
Route::put('/desactivarNivelProfesionals','Nivel_ProfesionalsController@DesactivarNivelProfesionals');
Route::put('/activarNivelProfesionals','Nivel_ProfesionalsController@ActivarNivelProfesionals');

Route::get('/selectNivelProfesionals','Nivel_ProfesionalsController@selectNivel_profesional');
Route::post('/selectbuscarNivelProfesionals','Nivel_ProfesionalsController@selectbuscarNivelProfesional');
// PERSONAL PROFESION
// Route::get('/listarPersonal', 'PersonalController@index');
Route::post('/listarPersonalProfesion', 'PersonalProfesionesController@index');
Route::post('/registrarPersonalProfesion','PersonalProfesionesController@store');
Route::post('/actualizarPersonalProfesion','PersonalProfesionesController@update');
Route::put('/desactivarPersonalProfesion','PersonalProfesionesController@desactivar');  /* ESTO DE ESTA AGREGANDO*/
Route::post('/listarPerProfesionModificar','PersonalProfesionesController@DatosPersonalProfesionesModificar');
Route::get('/reporteProfesion','ReporteProfesionesController@ReporteProfesion');
Route::post('/reporteProfesiones','ReporteProfesionesController@ListadoGeneral');
Route::get('/ReportePerProfPdf', 'ReporteProfesionesController@ReportePerProfPdf');
Route::get('/ReportePerProfEmiPdf', 'ReporteProfesionesController@ReportePerProfEmiPdf');
//****************** TTE CRUZ - REVISTAS ********************************************************************/

Route::post('/listarpersonalx', 'RevistasController@ListarPersonalx');
Route::post('/revistasx', 'RevistasController@listar');
Route::post('/datos', 'RevistasController@DatosPersonales');
Route::get('/revistante', 'RevistasController@Revistante');
Route::post('/NuevaRevista', 'RevistasController@NuevaRevista');
Route::post('/EditarRevista', 'RevistasController@EditarRevista');
Route::post('/EliminarRevista', 'RevistasController@EliminarRevista');

Route::get('/reporDest', 'RevistasController@mostrarReporteDestino');
Route::get('/pdf', 'RevistasController@listarPdf')->name('descargarPDF');

Route::get('/reporDest2', 'RevistasController@mostrarReporteDestino2');
Route::get('/pdf2', 'RevistasController@listarPdf2')->name('descargarPDF2');

Route::post('/personalRevistas/cambiarEstado', 'RevistasController@cambiarEstado');

Route::get('/reporteF/generarRangofechasF', 'RevistasController@generarRangofechasR');
Route::get('/pdfR', 'RevistasController@listarPdfR')->name('descargarPDF3');

Route::get('/certificadoRevista','RevistasController@CertRev');
Route::get('/pdfC', 'RevistasController@listarCert')->name('descargarPDF4');

/* DATOS PERSONALES  */

Route::post('/verDatosPersonales','PersonalController@VerDatosPersonales');




/**
 * Autor: Hidalgo Miranda Ariel Wilson
 * Fecha: 20/09/2020
 * Descripcion: Ruta de authenticacion
 */



/**
 * RUTAS PARA EL FORMULARIO DE NUEVO INGRESO
 */
// Rutas para tablas parametricas para el uso en combos anidados
//REGISTRAR NUEVO PERSONAL
Route::post('/registrarPersonal','PersonalController@RegistrarPersonal');
//REGISTARR NUEVO PERSONAL EGRESADO
Route::post('/registrarPersonalEgresado','PersonalController@RegistrarPersonalEgresado');
//ESCALAFON
Route::get('/escalafonesCombo','DatosController@Escalafon');
//SUBESCALAFONES
Route::post('/subescalafonesCombo','DatosController@SubEscalafon');
//GRADOS POR ESCALAFON
Route::post('/gradosCombo','DatosController@Grado');
//GRADOS POR DIVISION
Route::post('/gradosComboDiv','GradoController@ListaGradosDiv');
//GRADOS POR NIVELES
Route::post('/gradosClasificacionCombo','DatosController@GradoClasificacion');
//SITUACIONES
Route::get('/situacionesCombo','DatosController@Situacion');
//SUBSITUACIONES
Route::post('/subsituacionesCombo','DatosController@SubSituacion');
//DETALLESITUACIONES
Route::post('/detallesituacionesCombo','DatosController@DetalleSituacion');
//ESTUDIOS
Route::get('/estudiosCombo','DatosController@Estudios');
//ESTUDIOS DEMERITOS
Route::get('/estudiosComboDem','DatosController@EstudiosDem');
//DEPARTAMENTO
Route::get('/departamentosCombo','DatosController@Departamentos');
//PROVINCIA
Route::post('/provinciasCombo','DatosController@Provincias');
//LOCALIDAD
Route::post('/localidadesCombo','DatosController@Localidades');
//ESPECIALIDADES
Route::get('/especialidadesCombo','DatosController@Especialidades');
//SUBESPECIALIDADES
Route::post('/subespecialidadesCombo','DatosController@SubEspecialidades');


/**
 * RUTAS PARA MODULO DE DEMERITOS
 */
Route::post('/listarPersonalDeme','PersonalController@ListarPersonal');
Route::post('/datosPersonalesDem','PersonalController@DatosPersonalesDem');

Route::post('/guardarFalta','DemeritosController@GuardarFalta');
Route::post('/listaDemeritos','DemeritosController@ListaDemeritos');
//LISTA DE FALTAS A VALIDAR
Route::post('/listaDemeritosValidar','DemeritosController@LstaDemeritosValidar');
//LISTA DE FALTAS PERSONAL EXTERNO A LA UNIDAD ListaDemeritosExternos
Route::post('/listaDemeritosExternos','DemeritosController@ListaDemeritosExternos');
//FUNCION PARA VALIDAR FALTA
Route::post('/validarFalta','DemeritosController@ValidarFalta');
//FUNCION PARA VALIDAR FALTA
Route::post('/editarFalta','DemeritosController@EditarFalta');
//DATOS DE LA FALTA
Route::post('/datosFalta','DemeritosController@DatosFalta');
//Reporte PDF
Route::get('/reporteDemeritos/{id}','ReporteDemeritosController@Reporte');
Route::get('/reporteRecordDemeritos/{id}','ReporteDemeritosController@RecordIndividual');
//reporte de demeritos por promocion
Route::get('/reporteDemProm','ReporteDemeritosController@RecordPromocion');//////
//LISTA DE PERSONAL POR UNIDAD
Route::post('/listarPersonalUnidad','PersonalController@ListarPersonalUnidad');
//LISTAR PERSONAL EXTERNA A LA UNIDAD
Route::post('/ListarPersonalExterna','PersonalController@ListarPersonalExterna');
//DESTINO 1
Route::get('/destino1Combo','DestinosController@Destinos1');
//DESTINO 2
Route::post('/destino2Combo','DestinosController@Destinos2');
//DESTINO 3
Route::post('/destino3Combo','DestinosController@Destinos3');
//VALIDAR ABREVIATURA DESTINO 3
Route::get('/valDestino3Abrev','DatosController@ValidarAbrevDestino3');
Route::post('/guardarAbreviaturaDestino3','DatosController@GuardarAbreviaturaDestino3');
//DESTINO 4
Route::post('/destino4Combo','DestinosController@Destinos4');
//FALTA 1
Route::get('/faltas1Combo','FaltasController@Faltas1');
//FALTA 2
Route::post('/faltas2Combo','FaltasController@Faltas2');
//SANCIONES
Route::post('/sancionesCombo','FaltasController@Sancion');
//NOMBRE DE UNIDAD
Route::get('/nombreUnidad','DatosController@NombreUnidad');
//GRADOS POR NIVELES
Route::post('/gradosClasificacionCombo','DatosController@GradoClasificacion');

// LISTA DE SANCIONADORES
Route::post('/listarPersonalTotal','PersonalController@ListarPersonalTotal');
Route::post('/listarPersonalTotalUnidad','PersonalController@ListarPersonalTotalUnidad');

//DEJAR SIN EFECTO SANCION
Route::post('/levsan','DemeritosController@DejarSinEfectoSancion');
Route::post('/verlevsan','DemeritosController@VerSancionSinEfecto');

/**
 * MODULO PROYECTOS DE INGENIERIA
 */
Route::post('/listarPersonalProy','PersonalController@ListarPersonalProy');
Route::post('/listarProyectos','ProyectosController@ListarProyectos');
Route::post('/mostrarPersona','ProyectosController@MostrarPersona');
Route::get('/estadoProyecto','ProyectosController@EstadoProyecto');
Route::put('/editarProyecto','ProyectosController@EditarProyecto');
Route::post('/agregarProyecto','ProyectosController@AgregarProyecto');
Route::post('/eliminarProyecto','ProyectosController@EliminarProyecto');


Route::put('/editarDatosPersonales','PersonalController@EditarDatosPersonales');


/****************************** FUNCIONES DE EXPORTACION DE EXCEL *******************************************/

Route::get('/indGenDest','Excel\IndiceGenDestController@export');

Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath')
   ->where('optional','.*');

