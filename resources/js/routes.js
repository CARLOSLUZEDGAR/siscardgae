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
            path: '/notFound',
            name: 'Notfound',
            component: require('./components/Notfound.vue').default
        },
        
        {
            path: '/',
            name: 'Inicio',
            component: require('./components/Bienvenida.vue').default
        },

        {
            path: '/passwordChange',
            name: 'PasswordChange',
            component: require('./components/PasswordChange.vue').default
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