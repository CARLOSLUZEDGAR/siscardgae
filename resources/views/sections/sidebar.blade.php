 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="/img/fabprueba.png" class="brand-image">
        <span class="brand-text font-weight-light">SISCAR - DGAE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="info">
              <router-link class="nav-link" to='/datosUser'>
                <a id="nombre" class="d-block"></a>
              </router-link>
               
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              {{-- PERMISO SIDEBAR 1 --}}
              @can('datos_personal', Model::class)
                <li class="nav-header" style="padding-left: 1px;">DATOS</li>
                  {{-- PERMISO SIDEBAR 2 --}}
                  @can('dato_personal', Model::class)
                  <li class="nav-item">{{-- DATOS PERSONALES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-id-card"></i>
                      <p>
                        CARNETIZACIÓN
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      @can('view-per', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/DatosPersonal'>
                          <i class="fas fa-user nav-icon"></i>
                          <p>Datos</p>
                        </router-link>
                      </li>
                      @endcan


                      @can('view-datfam', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/DocumentacionPersonal'>
                          <i class="fas fa-users nav-icon"></i>
                          <p>Documentación</p>
                        </router-link>
                      </li>
                      @endcan

                      <!-- @can('view-datfis', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/DatosFisicos'>
                          <i class="fas fa-hospital-user nav-icon"></i>
                          <p>Datos Fisicos</p>
                        </router-link>
                      </li>
                      @endcan -->

                      <!-- @can('view-persitmil', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personal'>
                          <i class="fas fa-user-check nav-icon"></i>
                          <p>Situacion Personal</p>
                        </router-link>
                      </li>
                      @endcan -->
                    </ul>
                  </li>  
                  @endcan
                  {{-- PERMISO SIDEBAR 2 --}}
                  @can('escalafon', Model::class)
                  <li class="nav-item">{{-- ESCALAFON --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fab fa-elementor"></i>
                      <p>
                        AERONAVES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('view-peresc', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/DatosAeronaves'>
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>Datos</p>
                          </router-link>
                      </li>
                      @endcan

                      @can('view-listesc', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/DocumentacionAeronave'>
                            <i class="fas fa-align-left nav-icon"></i>
                            <p>Documentación</p>
                          </router-link>
                      </li>
                      @endcan

                      <!-- @can('view-listsubesc', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/listarSubescalafon'>
                            <i class="fas fa-align-justify nav-icon"></i>
                            <p>Sub Escalafon</p>
                          </router-link>
                      </li>
                      @endcan -->

                      <!-- @can('view-listgra', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/listarGrado'>
                            <i class="fas fa-align-right nav-icon"></i>
                            <p>Grados</p>
                          </router-link>
                      </li>
                      @endcan -->

                    </ul>
                  </li>  
                  @endcan
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('estudio', Model::class)
                  <li class="nav-item">{{-- ESTUDIO --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book-reader"></i>
                      <p>
                        COMPLEMENTO
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('view-perestu', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/listarPersonalEstudio'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Personal Complemento</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-estu', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/estudio'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Complemento</p>
                        </router-link>
                      </li>
                      @endcan

                    </ul>
                  </li>  
                  @endcan -->
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('demeritos_dpt', Model::class)
                  <li class="nav-item"> {{-- DEMERITOS DPTO-I --}}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-times"></i>
                        <p>
                          FALTAS DISCIPLINARIAS
                          <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-perfald1', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/listaPersonalFaltas'>
                            <i class="nav-icon fas fa-user-minus"></i>
                            <p>Personal Faltas</p>
                          </router-link>
                      </li>
                      @endcan

                      @can('view-perfalval', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/validacionesFalta'>
                          <i class="nav-icon fas fa-user-check"></i>
                          <p>Validar Faltas</p>
                        </router-link>
                      </li>
                    @endcan

                    </ul>
                  </li>   
                  @endcan -->
              @endcan

              {{-- PERMISO SIDEBAR 1 --}}
              @can('formacion_personal', Model::class)
              <!-- <li class="nav-header" style="padding-left: 1px;">FORMACIÓN PROFESIONAL</li> -->
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('cursos', Model::class)
                  <li class="nav-item">{{-- CURSOS --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-id-card-alt"></i>
                      <p>
                        CURSOS
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-percur', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/personalcursos'>
                              <i class="nav-icon fas fa-user-graduate"></i>
                              <p>Personal Cursos</p>
                          </router-link>
                      </li>
                      @endcan
                      @can('view-cur', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/cursos'>
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>Cursos</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-tipcur', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/tipocursos'>
                              <i class="nav-icon fas fa-graduation-cap"></i>
                              <p>Tipo de Cursos</p>
                          </router-link>
                      </li>
                      @endcan
                      @can('view-descur', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/desglocursos'>
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>Desglose Cursos</p>
                        </router-link>
                      </li>
                      @endcan
                    </ul>
                  </li>  
                  @endcan -->
                  
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('prof_libre', Model::class)
                  <li class="nav-item">{{-- PROFESION LIBRE --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-address-book"></i>
                      <p>
                        PROFESIÓN LIBRE
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('view-perproflib', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/DatosProfesion'>
                          <i class="nav-icon fas fa-user-graduate"></i>
                          <p>Personal Profesion</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-carr', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/Carreras'>
                          <i class="nav-icon fas fa-align-left"></i>
                          <p>Grado Académico</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-nivprof', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/NivelProfesionals'>
                          <i class="nav-icon fas fa-align-left"></i>
                          <p>Careras Universitarias</p>
                        </router-link>
                      </li>
                      @endcan

                      <li class="nav-item">
                        <router-link class="nav-link" to='/ReportProfPers'>
                          <i class="nav-icon fas fa-align-left"></i>
                          <p>Reportes</p>
                        </router-link>
                      </li>

                    </ul>
                  </li>  
                  @endcan -->
                  
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('ascensos', Model::class)
                  <li class="nav-item">{{-- ASCENSOS --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-id-card-alt"></i>
                      <p>
                        ASCENSOS
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('view-perasc', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/listarPersonalAscenso'>
                          <i class="nav-icon fas fa-arrow-alt-circle-up"></i>
                          <p>Ascenso Personal</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-masperasc', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/AscensoPersonalMasivo'>
                            <i class="nav-icon fas fa-angle-double-up"></i>
                            <p>Ascenso Masivo</p>
                          </router-link>
                      </li>
                      @endcan

                      @can('view-listinst', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/listarInstancia'>
                            <i class="nav-icon fas fa-people-arrows"></i>
                            <p>Instancia</p>
                          </router-link>
                      </li>
                      @endcan

                      @can('view-docasc', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/docAscenso'>
                            <i class="nav-icon fas fa-file-word"></i>
                            <p>Documento de Ascenso</p>
                          </router-link>
                      </li>
                      @endcan
                    
                    @can('view-oga', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/ReporteAscenso'>
                          <i class="nav-icon fas fa-file-pdf"></i>
                          <p>Reporte OGA</p>
                        </router-link>
                      </li>
                    @endcan
                   
                    </ul>
                  </li>    
                  @endcan -->
                  
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('especialidades', Model::class)
                  <li class="nav-item">{{-- ESPECIALIDAD --}}
                    <a href="#" class="nav-link">
                    &nbsp;<i class="fab fa-etsy"></i>&nbsp;&nbsp;
                      <p>
                        ESPECIALIDADES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-peresp', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personalespecialidades/listarPersonal'>
                        <i class="fas fa-user-cog"></i>&nbsp;
                          <p>Personal Especialidad</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-esp', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personalespecialidades/especialidades'>
                        <i class="fas fa-cog"></i>&nbsp;&nbsp;
                          <p>Especialidad</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-subesp', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personalespecialidades/subespecialidades'>
                        <i class="fas fa-cogs"></i>&nbsp;
                          <p>Sub Especialidad</p>
                        </router-link>
                      </li>
                      @endcan
                    </ul>
                  </li>    
                  @endcan -->
                    
              @endcan

              {{-- PERMISO SIDEBAR 1 --}}
              @can('destinos_cargos', Model::class)
              <!-- <li class="nav-header" style="padding-left: 1px;">DESTINOS Y CARGOS</li> -->
                {{-- PERMISO SIDEBAR 2 --}}
                <!-- @can('destinos', Model::class)
                <li class="nav-item">{{-- DESTINOS --}}
                  <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-avianex"></i>
                    <p>
                      DESTINOS
                      <i class="fa fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                    @can('view-destper', Model::class)
                    <li class="nav-item">
                      <router-link class="nav-link" to='/listarPersonal2'>
                      &nbsp;&nbsp;<i class="fas fa-luggage-cart"></i>&nbsp;&nbsp;&nbsp;
                        <p>Destinos</p>
                      </router-link>
                    </li>
                    @endcan

                    @can('view-destn1', Model::class)
                    <li class="nav-item">
                      <router-link class="nav-link" to='/nivel1destino'>
                      &nbsp;&nbsp;<i class="fas fa-globe-americas"></i>&nbsp;&nbsp;&nbsp;
                        <p>Destinos nivel 1</p>
                      </router-link>
                    </li>
                    @endcan

                    @can('view-destn2', Model::class)
                      <li class="nav-item">
                      <router-link class="nav-link" to='/nivel2destino'>
                      &nbsp;&nbsp;<i class="fas fa-globe-europe"></i>&nbsp;&nbsp;&nbsp;
                        <p>Destinos nivel 2</p>
                      </router-link>
                    </li>
                    @endcan

                    @can('view-destn3', Model::class)
                    <li class="nav-item">
                      <router-link class="nav-link" to='/nivel3destino'>
                      &nbsp;&nbsp;<i class="fas fa-globe-asia"></i>&nbsp;&nbsp;&nbsp;
                        <p>Destinos nivel 3</p>
                      </router-link>
                    </li>
                    @endcan

                    @can('view-destn4', Model::class)
                    <li class="nav-item">
                      <router-link class="nav-link" to='/nivel4destino'>
                      &nbsp;&nbsp;<i class="fas fa-globe-africa"></i>&nbsp;&nbsp;&nbsp;
                        <p>Destinos nivel 4</p>
                      </router-link>
                    </li>
                    @endcan

                  </ul>
                </li>  
                @endcan -->
                
                {{-- PERMISO SIDEBAR 2 --}}
                <!-- @can('designaciones', Model::class)
                <li class="nav-item">{{-- DESIGNACIONES --}}
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-id-card-alt"></i>
                    <p>
                      DESIGNACIONES
                      <i class="fa fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                    @can('view-datperdesig', Model::class)
                    <li class="nav-item">
                      <router-link class="nav-link" to='/personaldesignaciones'>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Designaciones</p>
                      </router-link>
                    </li>
                    @endcan

                    @can('view-carg', Model::class)
                    <li class="nav-item">
                      <router-link class="nav-link" to='/cargo'>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cargos</p>
                      </router-link>
                    </li>
                    @endcan

                  </ul>
                </li>  
                @endcan                 -->
              @endcan


              {{-- PERMISO SIDEBAR 1 --}}
              @can('desempeno_profesional', Model::class)
              <li class="nav-header" style="padding-left: 1px;">REPORTES</li>
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('premios_distinciones', Model::class)
                  <li class="nav-item">{{-- PREMIOS Y DISTINCIONES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        PREMIOS Y DISTINCIONES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('view-premdist', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/premios'>
                          <i class="nav-icon fas fa-bahai"></i><p>Personal Distinciones</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-reppremdistgen', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/RepPremiosDistinciones'>
                          <i class="nav-icon fas fa-bahai"></i><p>Reportes</p>
                        </router-link>
                      </li>
                      @endcan


                      @can('view-distniv1', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/Nivel1Distinciones'>
                          <i class="nav-icon fas fa-bahai"></i><p>Distincion Nivel 1</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-distniv2', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/Nivel2Distinciones'>
                          <i class="nav-icon fas fa-bahai"></i><p>Distincion Nivel 2</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-distniv3', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/Nivel3Distinciones'>
                          <i class="nav-icon fas fa-bahai"></i><p>Distincion Nivel 3</p>
                        </router-link>
                      </li>
                      @endcan

                    </ul>
                  </li>  
                  @endcan -->
                  
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('brevetaciones', Model::class)
                  <li class="nav-item">{{-- BREVETACIONES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        BREVETACIONES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('view-perbrev', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/personalbrevets'>
                            <i class="fas fa-id-card-alt"></i>
                              <p>Personal Brevetaciones</p>
                          </router-link>
                      </li>
                      @endcan

                      @can('view-brev', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/brevets'>
                          <i class="far fa-id-card"></i>
                            <p>Brevets</p>
                        </router-link>
                      </li>
                      @endcan

                    </ul>
                  </li>  
                  @endcan -->

                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('revistas_militares', Model::class)
                  <li class="nav-item">{{-- REVISTAS MILITARES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        REVISTAS MILITARES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-revmil', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/revistas'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Revistas Militares</p>
                        </router-link>
                      </li>
                      @endcan
                    </ul>
                  </li>  
                  @endcan -->

                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('tribunales', Model::class)
                  <li class="nav-item">{{-- MIEMBROS TRIBUNALES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        MIEMBROS TRIBUNALES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      @can('viwe-trib', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/miemborstrib'>
                          <i class="fas fa-balance-scale-right"></i>
                            <p>Miembros del Tribunal</p>
                        </router-link>
                      </li>
                      @endcan

                      @can('view-pertrib', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/tribunales'>
                          <i class="fas fa-gavel"></i>
                            <p>Personal Tribunales</p>
                        </router-link>
                      </li>
                      @endcan

                    </ul>
                  </li>  
                  @endcan -->

                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('elab_publicas', Model::class)
                  <li class="nav-item">{{-- ELABORACIONES PUBLICAS --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        ELABORACIONES PUBLICAS
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-perpub', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personalpublicaciones'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Elab. Publicaciones</p>
                        </router-link>
                      </li>
                      @endcan
                    </ul>
                  </li>  
                  @endcan -->

                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('componentes', Model::class)
                  <li class="nav-item">{{-- COMP. CIES Y EME --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        COMP. CIES Y EME
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      
                      @can('view-percomp', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/listarPersonalEME'>
                          <i class="fas fa-award"></i> &nbsp;&nbsp;<p>Componente CIES EME</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-listcomp', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/listarComponente'>
                          <i class="fas fa-atlas"></i> &nbsp;&nbsp;<p>Componentes</p>
                        </router-link>
                      </li>
                      @endcan
                      
                    </ul>
                  </li>  
                  @endcan -->

                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('proy_ing', Model::class)
                  <li class="nav-item">{{-- PROYEC. DE INGENIERIA --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        PROYEC. DE INGENIERIA
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-perproy', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/proyectIng'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proyectos de Ingenieria</p>
                        </router-link>
                      </li>
                      @endcan
                      
                      
                    </ul>
                  </li>  
                  @endcan -->

                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('rep_delg', Model::class)
                  <li class="nav-item">{{-- REP. Y DELEGACIONES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-award"></i>
                      <p>
                        REP. Y DELEGACIONES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-perrep', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personalrepresentaciones'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Delegaciones</p>
                        </router-link>
                      </li>
                      @endcan
                      
                      
                    </ul>
                  </li>  
                  @endcan -->
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('report', Model::class)
                  <li class="nav-item">{{-- CURRICULUM --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-file-pdf"></i>
                      <p>
                      REPORTES
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      @can('view-curri', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/listarPerCurr'>
                          <i class="far fa-file-alt"></i>
                          <p>Personal Curriculum</p>
                        </router-link>
                      </li>   
                      @endcan
                      @can('view-reportvar', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/pruebasReportes'>
                          <i class="far fa-file-alt"></i>
                          <p>Reportes Varios</p>
                        </router-link>
                      </li>
                      @endcan              
                    </ul>
                  </li>    
                  @endcan -->
                  
              @endcan

              {{-- PERMISO SIDEBAR 1 --}}
              @can('otros', Model::class)
              <!-- <li class="nav-header" style="padding-left: 1px;">OTROS</li> -->
                  {{-- PERMISO SIDEBAR 2 --}}
                  <!-- @can('demeritos_uni', Model::class)
                  <li class="nav-item">{{-- DEMERITOS UNIDADES --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-file-pdf"></i>
                      <p>
                        FALTAS DISCIPLINARIAS
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      @can('view-perfaluni', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/personalUnidad'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lista personal</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-perfaluniext', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/listaPersonalFaltasExterno'>
                          <i class="far fa-circle nav-icon"></i>
                          <p>Personal de Unidades Externas</p>
                        </router-link>
                      </li>
                      @endcan

                    
                    </ul>
                  </li>  
                  @endcan -->
                    
              @endcan
                
                

              {{-- PERMISO SIDEBAR 1 --}}
                @can('view-rolper', Model::class)
                <li class="nav-header" style="padding-left: 1px;">ADMINISTRACIÓN</li>
                <li class="nav-item">{{-- ACCESO DEL SISTEMA --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        ACCESO DEL SISTEMA
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      @can('view-user', Model::class)
                       <li class="nav-item">
                        <router-link class="nav-link" to='/usuarios'>
                          <i class="nav-icon fas fa-users-cog"></i>
                          <p>Usuarios</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-rol', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/roles'>
                          <i class="nav-icon fas fa-user-clock"></i>
                          <p>Roles</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-permi', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/permisos'>
                          <i class="nav-icon fas fa-user-edit"></i>
                          <p>Permisos</p>
                        </router-link>
                      </li>
                      @endcan

                    </ul>
                </li>
                @endcan


                <li class="nav-item">{{-- AYUDAS --}}
                    <router-link class="nav-link" to='/ayuda'>
                      <i class="nav-icon fas fa-info-circle"></i>
                      <p>AYUDAS</p>
                    </router-link>
                </li>

                <li class="nav-item">{{-- ACERCA DE --}}
                    <router-link class="nav-link" to='/acercade'>
                      <i class="nav-icon fas fa-boxes"></i>
                      <p>ACERCA DE</p>
                    </router-link>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->

</aside>
