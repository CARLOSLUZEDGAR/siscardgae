import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router ({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [

        // INICIO RUTAS DGAE

        { //DGAE
            path: '/usuarios',
            name: 'Usuarios',
            component:  require('./components/Usuarios/Index.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-rolper') && per.includes('view-user')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

         {//DGAE
            path: '/DatosPersonal',
            name: 'DatosPersonal',
            component: require('./components/DatosPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-dat-carnet')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        
        {//DGAE
            path: '/RegistroPersonal',
            name: 'RegistroPersonal',
            component: require('./components/RegistroPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-insert-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {//DGAE
            path: '/RenovarPersonal',
            name: 'RenovarPersonal',
            component: require('./components/RenovarPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-renew-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        { // DGAE
            path: '/DocumentacionPersonal',
            name: 'DocumentacionPersonal',
            component: require('./components/DocumentacionPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-doc-carnet')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {//DGAE
            path: '/MostrarDocumentacion',
            name: 'MostrarDocumentacion',
            component: require('./components/MostrarDocumentacion.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        { // DGAE
            path: '/DatosAeronaves',
            name: 'DatosAeronaves',
            component: require('./components/DatosAeronaves.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-dat-aeronave')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        { // DGAE
            path: '/DocumentacionAeronave',
            name: 'DocumentacionAeronave',
            component: require('./components/DocumentacionAeronave.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-doc-aeronave')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },




        // FIN RUTAS DGAE

        {
            path: '*',
            component: require('./components/Notfound.vue').default
        },
        {
            path: '/',
            name: 'Inicio',
            component: require('./components/Bienvenida.vue').default
        },
        {
            path: '/plantilla',
            component: require('./components/Plantilla.vue').default
        },
        {
            path: '/nivel1destino',
            name: 'Nivel1destino',
            component: require('./components/Nivel1Destino.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-destn1')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nivel2destino',
            name: 'Nivel2destino',
            component: require('./components/Nivel2Destino.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-destn2')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nivel3destino',
            name: 'Nivel3destino',
            component: require('./components/Nivel3Destino.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-destn3')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nivel4destino',
            name: 'Nivel4destino',
            component: require('./components/Nivel4Destino.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-destn4')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/cargo',
            name: 'Cargo',
            component: require('./components/Cargo.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-carg')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        ////// MODULOS DE ARMING QUISPE
        // INICIO MODULO ESCALAFON PERSONAL
       

        {
            path: '/EscalafonPersonal/:e',
            name: 'Escalafonpersonal',
            component: require('./components/EscalafonPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-peresc')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        

        {
            path: '/listarSubescalafon',
            name: 'Subescalafon',
            component: require('./components/Subescalafon.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-listsubesc')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/listarGrado',
            name: 'Grado',
            component: require('./components/Grado.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-listgra')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        // MODULO ASCENSO PERSONAL MODULO DE ARMING QUISPE
        {
            path: '/listarPersonalAscenso',
            component: require('./components/PersonalAscenso.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datfis')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/AscensoPersonal/:a',
            name: 'Ascensopersonal',
            component: require('./components/AscensoPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datfis')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/AscensoPersonalMasivo',
            component: require('./components/PersonalMasivo.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-masperasc')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/listarInstancia',
            name: 'Instancia',
            component: require('./components/Instancia.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-listinst')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/docAscenso',
            name: 'DocAscenso',
            component: require('./components/DocAscenso.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-docasc')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/ReporteAscenso',
            name: 'ReporteAscenso',
            component: require('./components/ReporteAscenso.vue').default,

        },
        // MODULO PERSONAL EMIE MODULO DE ARMING QUISPE
         {
            path: '/listarPersonalEME',
            component: require('./components/PersonalEME.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-percomp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/CIESEMEPersonal/:a',
            name: 'CiesEmepersonal',
            component: require('./components/CIESEMEPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-percomp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/listarComponente',
            component: require('./components/Componente.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-listcomp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        // Modulos Sof. Alberto

        {
            path: '/listarPersonal2',
            name: 'ListarPersonalDestinos',
            component: require('./components/Personal2.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-destper')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/destinosPersonal/:d',
            //name: "nombre_component"
            name: 'DestinosPersonal',
            component: require('./components/DestinosPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-destper')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/destinosPersonal/certDestAsc/:d',
            //name: "nombre_component"
            name: 'CertDestAsc',
            component: require('./components/CertDestAsc.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-certdestasc')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/destinosPersonal/certDestFront/:d',
            //name: "nombre_component"
            name: 'CertDestFront',
            component: require('./components/CertDestFront.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-certdestfront')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/destinosPersonal/certDestDesgl/:d',
            //name: "nombre_component"
            name: 'CertDestDesgl',
            component: require('./components/CertDestDesgl.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-certdestdesg')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/destinosPersonal/desglose/:d',
            //name: "nombre_component"
            name: 'Desglose',
            component: require('./components/Desglose.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-repdesglose')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
        path: '/destinosPersonal/certDesglServ/:div/:d',
            //name: "nombre_component"
            name: 'CertDesglServ',
            component: require('./components/CertDesglServ.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-certdestserv')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
        path: '/destinosPersonal/OGD/firmasOgd',
            //name: "nombre_component"
            name: 'FirmasOrdenDestinos',
            component: require('./components/FirmasOrdenGeneralDestinos.vue').default,
        },
        //especialidades
        {
        path: '/personalespecialidades/especialidades',
            //name: "nombre_component"
            name: 'Especialidades',
            component: require('./components/Especialidades.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-esp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
        path: '/personalespecialidades/subespecialidades',
            //name: "nombre_component"
            name: 'Subespecialidades',
            component: require('./components/Subespecialidades.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-subesp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
        path: '/personalespecialidades/listarPersonal',
            //name: "nombre_component"
            name: 'ListarPersonalEspecialidades',
            component: require('./components/listarPersonalEspecialidad.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-peresp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
        path: '/personalespecialidades/:d',
            //name: "nombre_component"
            name: 'PersonalEspecialidades',
            component: require('./components/PersonalEspecialidades.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-peresp')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
        path: '/personalespecialidades/especialidad/reporte',
            //name: "nombre_component"
            name: 'EspecialidadReporte',
            component: require('./components/PersonalEspecialidadesReportes.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-docasc')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        // INICIO REPORTE
        {
            path: '/listarPerCurr',    
            name: 'ListarPerCurriculum',
            component: require('./components/listarPersonalCurriculum.vue').default
        },
        {
            path: '/perCurriculum/:subescalafon/:per_codigo',
            name: 'PersonalCurriculum',
            component: require('./components/PersonalCurriculums.vue').default
        },

           // ELIMINAR RAMA
           {
            path: '/pruebasReportes',    
            name: 'PruebaReportes',
            component: require('./components/pruebaReport.vue').default
        },

        {
            path: '/seleccionEscalafon',    
            name: 'SeleccionEscalafon',
            component: require('./components/ElegirEscalafon.vue').default
        },
  
        // FIN ELIMINAR RAMA

        // INICIO MODULO BREVETS - PABLO
        {
            path: '/personalbrevets',
            name: 'PersonalBrevets',
            component: require('./components/PersonalBrevets.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perbrev')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/verbrevets/:id,:s',
            name: 'PersonalBrevetsVer',
            component: require('./components/PersonalBrevetsVer.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perbrev')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/brevets',
            name: 'Brevets',
            component: require('./components/Brevets.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-brev')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        // INICIO MODULO CURSOS - PABLO
        {
            path: '/personalcursos',
            name: 'PersonalCursos',
            component: require('./components/PersonalCursos.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-percur')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/vercursos/:id',
            name: 'PersonalCursosVer',
            component: require('./components/PersonalCursosVer.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-percur')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/cursos',
            name: 'Cursos',
            component: require('./components/Cursos.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-cur')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/tipocursos',
            name: 'Tipocursos',
            component: require('./components/TipoCursos.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-tipcur')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/desglocursos',
            name: 'DesgloseCursos',
            component: require('./components/DesgloseCursos.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-descur')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/reportcurso',
            name: 'Reportcurso',
            component: require('./components/ReportePersonalCursos.vue').default
        },
        /* complemento y personal complemento*/
        {
            path: '/estudio',
            name: 'Estudio',
            component: require('./components/Estudio.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-estu')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/listarPersonalEstudio',
            component: require('./components/PersonalEstudio.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perestu')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/EstudioPersonal/:e',
            name: 'EstudioPersonal',
            component: require('./components/EstudioPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perestu')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        // INICIO MODULO TRIBUNALES PERSONAL - PABLO
        {
            path: '/miemborstrib',
            name: 'Tribunales',
            component: require('./components/Tribunales.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('viwe-trib')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/tribunales',
            name: 'PersonalTribunales',
            component: require('./components/PersonalTribunales.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-pertrib')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/vertribunales/:id,:s',
            name: 'PersonalTribunalesVer',
            component: require('./components/PersonalTribunalesVer.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-pertrib')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        // Sof Ajata   v-0

        {
            path: '/premios',
            component: require('./components/Premios.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-premdist')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/PremiosDistinciones/:d',
            name: 'PremiosDistinciones',
            component: require('./components/PremiosDistinciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-premdist')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/Nivel1Distinciones',
            name: 'Nivel1Distinciones',
            component: require('./components/Nivel1Distinciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-distniv1')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/Nivel2Distinciones',
            name: 'Nivel2Distinciones',
            component: require('./components/Nivel2Distinciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-distniv2')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/Nivel3Distinciones',
            name: 'Nivel3Distinciones',
            component: require('./components/Nivel3Distinciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-distniv3')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/RepPremiosDistinciones',
            name: 'RepPremiosDistinciones',
            component: require('./components/ReportePremiosDistinciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-reppremdistgen')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        }, // fin sof Ajata
       /*
        * Rutas para Situacion Militar MATTOS
        */
        {
            path: '/SituacionMilitarIndex/:codigo',
            name: 'SituacionMilitarIndex',
            component:  require('./components/SituacionMilitar/Index.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-persitmil')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/personal',
            name: 'Personal',
            component:  require('./components/Personal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-persitmil')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        // {
        //     path: '/listarPersonalSituacion',
        //     component: require('./components/PersonalSituacion.vue').default
        // },
        // {
        //     path: '/SituacionPersonal/:a',
        //     name: 'SituacionPersonalMilitar',
        //     component: require('./components/SituacionMilitar/Index.vue').default
        // },
        // FIN MATTOS
        /* Rutas para Designaciones MATTOS

        */
         {
            path: '/personaldesignaciones',
            name: 'PersonalDesignaciones',
            component:  require('./components/Designaciones/PersonalDesignaciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datperdesig')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/Designaciones/:codigo',
            name: 'Designaciones',
            component:  require('./components/Designaciones/Designaciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datperdesig')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

       /* Rutas para Representaciones MATTOS

        */
       {
            path: '/personalrepresentaciones',
            name: 'PersonalRepresentaciones',
            component:  require('./components/Representaciones/PersonalRepresentaciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perrep')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/Representaciones/:codigo',
            name: 'Representaciones',
            component:  require('./components/Representaciones/Representaciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perrep')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

         /* Rutas para Publicaciones MATTOS

        */
         {
            path: '/personalpublicaciones',
            name: 'PersonalPublicaciones',
            component:  require('./components/Publicaciones/PersonalPublicaciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perpub')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
         {
            path: '/Publicaciones/:codigo',
            name: 'Publicaciones',
            component:  require('./components/Publicaciones/Publicaciones.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perpub')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        // FIN MATTOS
        //Sgto. Quisber DAtos Familiares, Datos fisicos
        {
            path: '/DatosFisicos',
            component: require('./components/DatosFisicos.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datfis')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/DatosFisicos/:e',
            name: 'DatosFisicos',
            component: require('./components/DatosFisicosPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datfis')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

       

        {
            path: '/DatosFamiliares/:e',
            name: 'DatosFamiliares',
            component: require('./components/DatosFamiliaresPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-datfam')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/Carreras',
            component: require('./components/Carrera.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-carr')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/NivelProfesionals',
            component: require('./components/NivelProfesionals.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-nivprof')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/DatosProfesion',
            component: require('./components/ProfesionPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perproflib')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/DatosProfesion/:e',
            name: 'DatosProfesion',
            component: require('./components/PersonalProfesion.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perproflib')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/ReportProfPers',
            component: require('./components/ReporteProfesion.vue').default,
            
        },
        //Fin sgto. quisbert


        // TTE CRUZ - REVISTAS
        {
            path: '/revistas',
            component: require('./components/Revistas.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-revmil')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/revistaIndividual/:id',
            name: 'RevistaIndividual',
            component: require('./components/RevistaIndividual.vue').default,
        },

        {
            path: '/datosRevistante/:id',
            name: 'DatoRevistantex',
            component: require('./components/RevistaDelegado.vue').default,
        },

        

        
       





        {
            path: '/DatosPersonal/:e',
            name: 'Personal_datos',
            component: require('./components/Personal_datos.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nuevoPersonal',
            name: 'NuevoPersonal',
            component:  require('./components/Personal/NewPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('insert-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nuevoPersonalEgresado',
            name: 'NuevoPersonalEgresado',
            component:  require('./components/Personal/NewPersonalEgresado.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('insert-per-egre')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/editarPersonal/:codigo',
            name: 'EditarPersonal',
            component:  require('./components/Personal/EditPersonal.vue').default
        },
        /**
         * RUTAS MODULO FALTAS O DEMERITOS
         */
        //DEP-I
        {
            path: '/listaPersonalFaltas',
            name: 'ListaPersonalFaltas',
            component:  require('./components/FALTAS/Personal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perfald1')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/listaFaltas/:codigo/:c/:u/:e/:fu',
            name: 'ListaFaltas',
            component:  require('./components/FALTAS/FaltasPersonal.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perfald1')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nuevaFalta/:codigo/:nivFalta/:division/:externo/:divGra',
            name: 'NuevaFalta',
            component:  require('./components/FALTAS/NuevaFalta.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('insert-fald1')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nuevaFalta2/:codigo/:nivFalta/:division/:divGra',
            name: 'NuevaFalta2',
            component:  require('./components/FALTAS/NuevaFalta2.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('insert-falextd1')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
            //VALIDACION DE FALTAS
        {
            path: '/validacionesFalta',
            name: 'ValidacionesFalta',
            component:  require('./components/FALTAS/ValidacionesFalta.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perfalval')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        //UNIDADES
        {
            path: '/personalUnidad',
            name: 'PersonalUnidad',
            component:  require('./components/FALTAS/PersonalUnidad.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perfaluni')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/listaPersonalFaltasExterno',
            name: 'ListaPersonalFaltasExterno',
            component:  require('./components/FALTAS/PersonalExtUni.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perfaluniext')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/faltaPerExt/:codigo/:c/:u',
            name: 'FaltaPerExt',
            component:  require('./components/FALTAS/FaltaPerExt.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perfaluniext')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        //SCRIPTS GENERAL DEL MODULO
        //EDITAR FALTA
        {
            path: '/editarFalta/:falta/:codigo/:nivFalta/:division/:externo/:divGra/:r',
            name: 'EditarFalta',
            component:  require('./components/FALTAS/EditarFalta.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('edit-falta')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        /**
         * Vistas de Proyectos de Ingenieria
         */
         {
            path: '/proyectIng',
            name: 'ProyectIng',
            component:  require('./components/ProyectosIngenieria/Index.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perproy')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/createproyectIng/:per',
            name: 'CreateProyectIng',
            component:  require('./components/ProyectosIngenieria/create.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perproy')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        /**
         * NIVEL DE PERICIA
         */
         {
            path: '/indexPericia',
            name: 'IndexPericia',
            component:  require('./components/Pericias/Index.vue').default,
            // beforeEnter: (to, from, next) => {
            //     let per = window.user.permissions.map(permission=>permission.name);
            //     if (per.includes('view-perproy')) {
            //         next();
            //     } else {
            //         next(from.path);
            //     }
            // }
        },
        {
            path: '/createPericia/:per',
            name: 'CreatePericia',
            component:  require('./components/Pericias/PersonalPericia.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-perproy')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        /**
         * ACCESO AL SISTEMA
         */

        /**
         * Ruta para creacion de usuarios
         */
        
        {
            path: '/datosUser',
            name: 'DatosUser',
            component:  require('./components/Usuarios/DatosUser.vue').default
        },
        /**
         * Rutas para cracion de roles
         */
        {
            path: '/roles',
            name: 'Roles',
            component:  require('./components/Roles/Index.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-rolper') && per.includes('view-rol')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/nuevoRol',
            name: 'NuevoRol',
            component:  require('./components/Roles/Create.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-rolper')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/editarRol/:id',
            name: 'EditarRol',
            component:  require('./components/Roles/Editar.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-rolper')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        /**
         * Rutas para los permisos
         */
         {
            path: '/permisos',
            name: 'Permisos',
            component:  require('./components/Permisos/Index.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('view-rolper') && per.includes('view-permi')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/acercade',
            name: 'Acercade',
            component:  require('./components/AcercaDe.vue').default
        },
        {
            path: '/ayuda',
            name: 'Ayuda',
            component:  require('./components/Ayuda.vue').default
        },
    ]


})
