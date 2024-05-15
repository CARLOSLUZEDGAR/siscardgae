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
                <!-- <li class="nav-header" style="padding-left: 1px;">DATOS</li> -->
                  {{-- PERMISO SIDEBAR 2 --}}
                @can('side-carnetizacion', Model::class)
                  <li class="nav-header" style="padding-left: 1px;">PERSONAL</li>
                  <li class="nav-item">{{-- CARNETIZACION --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-id-card"></i>
                      <p>
                        CARNETIZACIÓN
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      @can('view-dat-carnet', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/DatosPersonal'>
                          <i class="fas fa-user nav-icon"></i>
                          <p>Datos</p>
                        </router-link>
                      </li>
                      @endcan
                      @can('view-doc-carnet', Model::class)
                      <li class="nav-item">
                        <router-link class="nav-link" to='/DocumentacionPersonal'>
                          <i class="fas fa-users nav-icon"></i>
                          <p>Documentación</p>
                        </router-link>
                      </li>
                      @endcan
                    </ul>
                  </li>  
                @endcan
                  {{-- PERMISO SIDEBAR 2 --}}
                @can('side-aeronave', Model::class)
                  <li class="nav-header" style="padding-left: 1px;">AERONAVE</li>
                  <li class="nav-item">{{-- AERONAVE --}}
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-plane"></i>
                      <p>
                        AERONAVES
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      @can('view-dat-aeronave', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/DatosAeronaves'>
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>Datos</p>
                          </router-link>
                      </li>
                      @endcan
                      @can('view-doc-aeronave', Model::class)
                      <li class="nav-item">
                          <router-link class="nav-link" to='/DocumentacionAeronave'>
                            <i class="fas fa-align-left nav-icon"></i>
                            <p>Documentación</p>
                          </router-link>
                      </li>
                      @endcan
                    </ul>
                  </li>  
                @endcan
                                                                                                                                                              
              {{-- PERMISO SIDEBAR 1 --}}
                @can('side-administracion', Model::class)
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
