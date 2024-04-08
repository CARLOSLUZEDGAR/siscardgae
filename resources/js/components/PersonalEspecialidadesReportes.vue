<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              Reportes Personal Especialidades
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Personal Especialidades</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-globe-americas"></i>
                  <strong>REPORTES ESPECIALIDAD</strong>
                </h3>
              </div>
              <div class="card-body">
                  <!-- <div class="form-group row">
                        <img v-bind:src="'/destinosPersonal/../img/personal/'+arrayDatosPersonal.per_foto" class="img-responsive" height="100" width="90">
                    </div>
                    <div class="form-group row">
                        <div>
                            <label class="col-md-12 form-control-label">
                                <template v-if="arrayDatosPersonal.per_sexo=='MASCULINO'">
                                        DEL SEÑOR: {{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}
                                </template>
                                <template v-else>
                                        DE LA SEÑORA: {{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}
                                </template>
                            </label>
                        </div>   
                    </div> -->
                    <!-- @click="selectEspeGrado()" -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">REPORTES:</label>
                                <select class="form-control col-md-6" v-model="criterio" @click="selectEspeEspecialidad(),selectEspeGrado(),selectDestinos_nivel1(),reset(),resetEfectivos()">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option value="promocion">POR PROMOCION</option>
                                    <option value="grado" >POR GRADO</option>
                                    <option value="especialidad">POR ESPECIALIDAD</option>
                                    <option value="destino">POR DESTINO</option>
                                    <option value="genero">POR GENERO</option>
                                    <!-- <option value="per_paterno">APELLIDO PATERNO</option> -->
                                </select>
                                <template v-if="criterio == 'promocion'">
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">PROMOCIÓN:</label>
                                        <input type="text" v-model="promocion" class="form-control col-md-6" placeholder="INSERTAR 5 PRIMEROS DIGITOS DEL CM" style="text-transform:uppercase" >
                                    </div>
                                </template>
                                <template v-if="criterio == 'grado'">
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">GRADO:</label>
                                        <select class="form-control col-md-6" v-model="grado" >
                                            <option value="0" disabled>SELECCIONE</option>
                                            <option v-for="grados in arrayGrados" :key="grados.id" :value="grados.id"  v-text="grados.nombre"></option>
                                        </select>
                                    </div>
                                </template>
                                <template v-if="criterio == 'destino'">
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">ENTIDAD:</label>
                                        <select class="form-control col-md-6" v-model="entidad" v-on:change="changeItemEntidad(rowId, $event)">
                                            <option value="0" disabled>SELECCIONE</option>
                                            <option v-for="destinos_nivel1 in arrayDestinos_nivel1" :key="destinos_nivel1.id" :value="destinos_nivel1.id"  v-text="destinos_nivel1.descripcion"></option>
                                        </select>
                                    </div><br>
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">GRAN UNIDAD:</label>
                                        <select class="form-control col-md-6" v-model="gran_unidad" v-on:change="changeItemGranunidad(rowId, $event)">
                                            <option value="0">SELECCIONE</option>
                                            <option v-for="destinos_nivel2 in arrayDestinos_nivel2" :key="destinos_nivel2.id" :value="destinos_nivel2.id"  v-text="destinos_nivel2.descripcion"></option>                        
                                        </select>
                                    </div><br>
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">REPARTICIÓN:</label>
                                         <select class="form-control col-md-6" v-model="reparticion">
                                            <option value="0">SELECCIONE</option>
                                            <option v-for="destinos_nivel3 in arrayDestinos_nivel3" :key="destinos_nivel3.id" :value="destinos_nivel3.id"  v-text="destinos_nivel3.descripcion"></option>
                                        </select>
                                    </div>
                                </template>
                                <template v-if="criterio == 'genero'">
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">GENERO:</label>
                                        <select class="form-control col-md-6" v-model="genero">
                                            <option value="">SELECCIONE</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                </template>
                                 <template v-if="criterio == 'especialidad' || criterio == 'promocion' || criterio == 'grado' || criterio == 'destino' || criterio == 'genero'">
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">ESPECIALIDAD:</label>
                                        <select class="form-control col-md-6" v-model="especialidad" v-on:change="changeItemEspe(rowId, $event)">
                                            <option value="0">SELECCIONE</option>
                                            <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id"  v-text="especialidad.nombre"></option>
                                        </select>
                                    </div><br>
                                    <div class="input-group">
                                        <label class="form-control-label col-md-4" for="text-input">SUBESPECIALIDAD:</label>
                                        <select class="form-control col-md-6" v-model="subespecialidad">
                                            <option value="0">SELECCIONE</option>
                                            <option v-for="subespecialidad in arraySubespecialidad" :key="subespecialidad.id" :value="subespecialidad.id"  v-text="subespecialidad.nombre"></option>
                                        </select>
                                    </div>
                                </template>
                                <!-- <input type="text" v-model="buscar" @keyup.enter="listarPersonal(1,buscar,criterio)" class="form-control" placeholder="TEXTO A BUSCAR" style="text-transform:uppercase" > -->
                                <!-- <button type="submit" @click="listarPersonal(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button> -->
                            </div>
                        </div>
                            <!-- <div class="col-md-6">
                            <button type="button" class="btn btn-secondary btn-sm" @click="reportesEspe()">
                                <i class="far fa-file-alt" aria-hidden="true">  REPORTES ESPECIALIDAD</i>
                            </button> &nbsp;
                            </div> -->
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">EFECTIVO:</label>
                                <select class="form-control col-md-6" v-model="efectivo" @click="resetReportes()">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option value="O">OFICIALES</option>
                                    <option value="ST" >SOFS/SGTOS TECNICOS</option>
                                    <option value="SM">SOFS/SGTOS DE MUSICA</option>
                                    <option value="C">PERSONAL CIVIL</option>
                                    <option value="T">GENERAL</option>
                                    <!-- <option value="per_paterno">APELLIDO PATERNO</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2 bd-highlight justify-content-center">
                        <template v-if="criterio == 'promocion'">
                            <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" @click="listarPerPromo(1,promocion,especialidad,subespecialidad)">
                                <i class="fas fa-plus" aria-hidden="true">  MOSTRAR</i>
                            </button>
                            </div>
                        </template>
                        <template v-if="criterio == 'grado'">
                            <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" @click="listarPerGrado(1,grado,especialidad,subespecialidad)">
                                <i class="fas fa-plus" aria-hidden="true">  MOSTRAR</i>
                            </button>
                            </div>
                        </template>
                        <template v-if="criterio == 'especialidad'">
                            <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" @click="listarPerEspecialidad(1,especialidad,subespecialidad)">
                                <i class="fas fa-plus" aria-hidden="true">  MOSTRAR</i>
                            </button>
                            </div>
                        </template>
                        <template v-if="criterio == 'destino'">
                            <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" @click="listarPerDestino(1,entidad,gran_unidad,reparticion,especialidad,subespecialidad)">
                                <i class="fas fa-plus" aria-hidden="true">  MOSTRAR</i>
                            </button>
                            </div>
                        </template>
                        <template v-if="criterio == 'genero'">
                            <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" @click="listarPerGenero(1,genero,especialidad,subespecialidad)">
                                <i class="fas fa-plus" aria-hidden="true">  MOSTRAR</i>
                            </button>
                            </div>
                        </template>
                        
                        <div class="col-md-4">
                        <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                            <i class="fas fa-reply" aria-hidden="true">  ATRAS</i>
                        </button>
                        </div>
                    </div>

                    <!-- INICIO MOSTRAR DATOS POR PROMOCION -->
                    <template v-if="criterio == 'promocion'">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                            <template v-if="arrayPerPromo.length"> 
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <!-- <th><center>NRO.</center></th> -->
                                            <th><center>CARNET MILITAR</center></th>
                                            <th><center>GRADO</center></th>
                                            <th><center>NOMBRES</center></th>
                                            <th><center>AP. PATERNO</center></th>  
                                            <th><center>AP. MATERNO</center></th>  
                                            <th><center>ESPECIALIDAD</center></th>  
                                            <th><center>SUBESPECIALIDAD</center></th> 
                                            <!-- <th><center>OBSERVACION</center></th>    -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="promoEspecialidades in arrayPerPromo" :key="promoEspecialidades.id">
                                            <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                            <!-- <td ><center>{{sitPersonal.sitper_fecha_documento | moment("D/MM/YYYY")}}</center></td> -->
                                            <td v-text="promoEspecialidades.per_cm" ></td>
                                            <td>{{promoEspecialidades.grado}}{{promoEspecialidades.complemento}}</td>
                                            <td v-text="promoEspecialidades.per_nombre" ></td>
                                            <td v-text="promoEspecialidades.per_paterno" ></td>
                                            <td v-text="promoEspecialidades.per_materno" ></td>
                                            <td v-text="promoEspecialidades.nomespe" ></td>
                                            <td v-text="promoEspecialidades.nomsubespe" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                                </div>
                            </template>   
                        </div>
                        <div class="form-group row">
                            <nav>
                                <!-- inicio para paginacion -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,promocion,especialidad,subespecialidad)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,promocion,especialidad,subespecialidad)" v-text="page"></a>
                                    </li>
                                
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,promocion,especialidad,subespecialidad)">Sig</a>
                                    </li>
                                </ul>
                                <!-- fin paginacion -->
                            </nav>
                        </div>
                    </template>
                    <!-- FIN MOSTRAR DATOS POR PROMOCION -->

                    <!-- INICIO MOSTRAR DATOS POR GRADO -->
                    <template v-if="criterio == 'grado'">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                            <template v-if="arrayPerGrado.length"> 
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <!-- <th><center>NRO.</center></th> -->
                                            <th><center>CARNET MILITAR</center></th>
                                            <th><center>GRADO</center></th>
                                            <th><center>NOMBRES</center></th>
                                            <th><center>AP. PATERNO</center></th>  
                                            <th><center>AP. MATERNO</center></th>  
                                            <th><center>ESPECIALIDAD</center></th>  
                                            <th><center>SUBESPECIALIDAD</center></th> 
                                            <!-- <th><center>OBSERVACION</center></th>    -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="gradoEspecialidades in arrayPerGrado" :key="gradoEspecialidades.id">

                                            <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                            <!-- <td ><center>{{sitPersonal.sitper_fecha_documento | moment("D/MM/YYYY")}}</center></td> -->
                                            <td v-text="gradoEspecialidades.per_cm" ></td>
                                            <td>{{gradoEspecialidades.grado}}{{gradoEspecialidades.complemento}}</td>
                                            <td v-text="gradoEspecialidades.per_nombre" ></td>
                                            <td v-text="gradoEspecialidades.per_paterno" ></td>
                                            <td v-text="gradoEspecialidades.per_materno" ></td>
                                            <td v-text="gradoEspecialidades.nomespe" ></td>
                                            <td v-text="gradoEspecialidades.nomsubespe" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                                </div>
                            </template>
                        </div>
                        <div class="form-group row">
                            <nav>
                                <!-- inicio para paginacion -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaGrado(pagination.current_page - 1,grado,especialidad,subespecialidad)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaGrado(page,grado,especialidad,subespecialidad)" v-text="page"></a>
                                    </li>
                                
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaGrado(pagination.current_page + 1,grado,especialidad,subespecialidad)">Sig</a>
                                    </li>
                                </ul>
                                <!-- fin paginacion -->
                            </nav>
                        </div>
                    </template>
                    <!-- FIN MOSTRAR DATOS POR GRADO -->

                    <!-- INICIO MOSTRAR DATOS POR ESPECIALIDAD -->
                    <template v-if="criterio == 'especialidad'">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                            <template v-if="arrayPerEspecialidad.length"> 
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <!-- <th><center>NRO.</center></th> -->
                                            <th><center>CARNET MILITAR</center></th>
                                            <th><center>GRADO</center></th>
                                            <th><center>NOMBRES</center></th>
                                            <th><center>AP. PATERNO</center></th>  
                                            <th><center>AP. MATERNO</center></th>  
                                            <th><center>ESPECIALIDAD</center></th>  
                                            <th><center>SUBESPECIALIDAD</center></th> 
                                            <!-- <th><center>OBSERVACION</center></th>    -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="perEspecialidades in arrayPerEspecialidad" :key="perEspecialidades.id">
                                            <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                            <!-- <td ><center>{{sitPersonal.sitper_fecha_documento | moment("D/MM/YYYY")}}</center></td> -->
                                            <td v-text="perEspecialidades.per_cm" ></td>
                                            <td>{{perEspecialidades.grado}}{{perEspecialidades.complemento}}</td>
                                            <td v-text="perEspecialidades.per_nombre" ></td>
                                            <td v-text="perEspecialidades.per_paterno" ></td>
                                            <td v-text="perEspecialidades.per_materno" ></td>
                                            <td v-text="perEspecialidades.nomespe" ></td>
                                            <td v-text="perEspecialidades.nomsubespe" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                                </div>
                            </template>   
                        </div>
                        <div class="form-group row">
                            <nav>
                                <!-- inicio para paginacion -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaEspecialidad(pagination.current_page - 1,especialidad,subespecialidad)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaEspecialidad(page,especialidad,subespecialidad)" v-text="page"></a>
                                    </li>
                                
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaEspecialidad(pagination.current_page + 1,especialidad,subespecialidad)">Sig</a>
                                    </li>
                                </ul>
                                <!-- fin paginacion -->
                            </nav>
                        </div>
                    </template>
                    <!-- FIN MOSTRAR DATOS POR ESPECIALIDAD -->

                    <!-- INICIO MOSTRAR DATOS POR DESTINO -->
                    <template v-if="criterio == 'destino'">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                            <template v-if="arrayPerDestino.length"> 
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <!-- <th><center>NRO.</center></th> -->
                                            <th><center>CARNET MILITAR</center></th>
                                            <th><center>GRADO</center></th>
                                            <th><center>NOMBRES</center></th>
                                            <th><center>AP. PATERNO</center></th>  
                                            <th><center>AP. MATERNO</center></th>  
                                            <th><center>ESPECIALIDAD</center></th>  
                                            <th><center>SUBESPECIALIDAD</center></th> 
                                            <!-- <th><center>OBSERVACION</center></th>    -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="destEspecialidades in arrayPerDestino" :key="destEspecialidades.id">
                                            <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                            <!-- <td ><center>{{sitPersonal.sitper_fecha_documento | moment("D/MM/YYYY")}}</center></td> -->
                                            <td v-text="destEspecialidades.per_cm" ></td>
                                            <td>{{destEspecialidades.grado}}{{destEspecialidades.complemento}}</td>
                                            <td v-text="destEspecialidades.per_nombre" ></td>
                                            <td v-text="destEspecialidades.per_paterno" ></td>
                                            <td v-text="destEspecialidades.per_materno" ></td>
                                            <td v-text="destEspecialidades.nomespe" ></td>
                                            <td v-text="destEspecialidades.nomsubespe" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                                </div>
                            </template>   
                        </div>
                        <div class="form-group row">
                            <nav>
                                <!-- inicio para paginacion -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaDestino(pagination.current_page - 1,entidad,gran_unidad,reparticion,especialidad,subespecialidad)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad)" v-text="page"></a>
                                    </li>
                                
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaDestino(pagination.current_page + 1,entidad,gran_unidad,reparticion,especialidad,subespecialidad)">Sig</a>
                                    </li>
                                </ul>
                                <!-- fin paginacion -->
                            </nav>
                        </div>
                    </template>
                    <!-- FIN MOSTRAR DATOS POR DESTINO -->

                    <!-- INICIO MOSTRAR DATOS POR GENERO -->
                    <template v-if="criterio == 'genero'">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                            <template v-if="arrayPerGenero.length"> 
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <!-- <th><center>NRO.</center></th> -->
                                            <th style="text-align: center;">CARNET MILITAR</th>
                                            <th><center>GRADO</center></th>
                                            <th><center>NOMBRES</center></th>
                                            <th><center>AP. PATERNO</center></th>  
                                            <th><center>AP. MATERNO</center></th>  
                                            <th><center>ESPECIALIDAD</center></th>  
                                            <th><center>SUBESPECIALIDAD</center></th> 
                                            <!-- <th><center>OBSERVACION</center></th>    -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="generoEspecialidades in arrayPerGenero" :key="generoEspecialidades.id">

                                            <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                            <!-- <td ><center>{{sitPersonal.sitper_fecha_documento | moment("D/MM/YYYY")}}</center></td> -->
                                            <td v-text="generoEspecialidades.per_cm" ></td>
                                            <td>{{generoEspecialidades.grado}}{{generoEspecialidades.complemento}}</td>
                                            <td v-text="generoEspecialidades.per_nombre" ></td>
                                            <td v-text="generoEspecialidades.per_paterno" ></td>
                                            <td v-text="generoEspecialidades.per_materno" ></td>
                                            <td v-text="generoEspecialidades.nomespe" ></td>
                                            <td v-text="generoEspecialidades.nomsubespe" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                                </div>
                            </template>
                        </div>
                        <div class="form-group row">
                            <nav>
                                <!-- inicio para paginacion -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaGenero(pagination.current_page - 1,genero,especialidad,subespecialidad)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaGenero(page,genero,especialidad,subespecialidad)" v-text="page"></a>
                                    </li>
                                
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPaginaGenero(pagination.current_page + 1,genero,especialidad,subespecialidad)">Sig</a>
                                    </li>
                                </ul>
                                <!-- fin paginacion -->
                            </nav>
                        </div>
                    </template>
                    <!-- FIN MOSTRAR DATOS POR GENERO -->

                    

                <div class="row p-2 bd-highlight justify-content-center">
                    <template v-if="criterio == 'promocion'">
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="RepPromEspe(promocion,especialidad,subespecialidad)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button>
                        </div> 
                    </template>
                    <template v-if="criterio == 'grado'">
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="RepGraEspe(grado,especialidad,subespecialidad)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button>
                        </div> 
                    </template>
                    <template v-if="criterio == 'especialidad'">
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="RepEspeEspe(especialidad,subespecialidad)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button>
                        </div> 
                    </template>
                    <template v-if="criterio == 'destino'">
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="RepDestEspe(entidad,gran_unidad,reparticion,especialidad,subespecialidad)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button>
                        </div> 
                    </template>
                    <template v-if="criterio == 'genero'">
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="RepGenEspe(genero,especialidad,subespecialidad)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button>
                        </div> 
                    </template>
                    <template v-if="efectivo == 'O' || efectivo == 'ST' || efectivo == 'SM' || efectivo == 'C' || efectivo == 'T'">
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="EfectivoEspe(efectivo)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR CUADRO</i>
                        </button>
                        </div>
                    </template>
                    <!-- <div class="col-md-4">
                    <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                        <i class="fas fa-reply" aria-hidden="true">  ATRAS</i>
                    </button>
                    </div>  -->
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)

            efectivo : '',

            per_codigo: this.$route.params.d,
            arrayDatosPersonal : [],
            arrayPerPromo : [],
            arrayPerEspecialidad : [],
            arrayPerGrado : [],
            arrayPerDestino : [],
            arrayPerGenero : [],
            arrayGrados : [],
            arrayEspecialidad : [],
            arraySubespecialidad : [],
            arrayDestinos_nivel1 : [],
            arrayDestinos_nivel2 : [],
            arrayDestinos_nivel3 : [],
            criterio : '',
            promocion : '',
            grado :  0,
            especialidad : 0,
            subespecialidad : 0,
            entidad : 0,
            gran_unidad : 0,
            reparticion : 0,
            genero : '',
            
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            rowId : 0,

            //VARIABLES  PARA CERTIFICACION
            // notaAsc : '',
            // criterio : '',
        }
    },

    validations:{
        
    },

    mounted() {
        //this.ver();
        // this.listarPerPromo(this.page,this.promocion,this.especialidad,this.subespecialidad);
        // this.datosPersonal(this.per_codigo);
    },
    computed:{
            isActived: function(){
                return this.pagination.current_page;
            },

            //Calcuar los elementos de la paginacion
            pagesNumber: function() {
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset *2);
                if( to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while( from <= to){
                    pagesArray.push(from);
                    from ++;
                }
                return pagesArray;
            }
        },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },

        // INICIO BUSCAR POR PROMOCION
        listarPerPromo(page,promocion,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerPromo", {
            page : page,
            promocion : promocion,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerPromo = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPagina(page, promocion,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerPromo(page, promocion,especialidad,subespecialidad);
        },
        // FIN BUSCAR POR PROMOCION

        // INICIO BUSCAR POR GRADO
        selectEspeGrado(){
            let me =this;
            var url='/gradoEspecialidad';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayGrados = respuesta.grados; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        listarPerGrado(page,grado,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerGrado", {
            page : page,
            grado : grado,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerGrado = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPaginaGrado(page, grado,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerGrado(page, grado,especialidad,subespecialidad);
        },
        // FIN BUSCAR POR GRADO

        //INICIO BUSQUEDA POR ESPECIALIDAD Y SUBESPECIALIDAD
        listarPerEspecialidad(page,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerEspecialidad", {
            page : page,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerEspecialidad = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        selectEspeEspecialidad(){
            let me =this;
            var url='/especialidad/selectEspecialidad';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayEspecialidad = respuesta.especialidad; 
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectSubespecialidad(){
            let me =this;
            var url='/subespecialidad/selectSubespecialidad';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubespecialidad = respuesta.subespecialidad; 
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        changeItemEspe: function changeItemEspe(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarSubespecialidad(event.target.value);
        },

        selectbuscarSubespecialidad(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arraySubespecialidad=[];
          //  me.prov_codigo=0;
            var url='/subespecialidad/selectbuscarSubespecialidad?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubespecialidad = respuesta.subespecialidad; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        cambiarPaginaEspecialidad(page,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerEspecialidad(page,especialidad,subespecialidad);
        },
        //FIN BUSQUEDA POR ESPECIALIDAD Y SUBESPECIALIDAD

        // INICIO BUSQUEDA POR DESTINO
        listarPerDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerDestino", {
            page : page,
            entidad : entidad,
            gran_unidad : gran_unidad,
            reparticion : reparticion,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerDestino = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        changeItemEntidad: function changeItemEntidad(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel2(event.target.value);
        },
        changeItemGranunidad: function changeItemGranunidad(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel3(event.target.value);
        },
        
        selectDestinos_nivel1(){
            let me =this;
            var url='/destinos_nivel1/selectDestinos_nivel1';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel1 = respuesta.destino1; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel2(){
            let me =this;
            var url='/destinos_nivel2/selectDestinos_nivel2';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel2 = respuesta.destinos2; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel3(){
            let me =this;
            var url='/destinos_nivel3/selectDestinos_nivel3';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel3 = respuesta.destino3; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectbuscarDestinos_nivel2(depa)
        {
            let me =this;
           
            me.buscarD= depa;
            me.arrayDestinos_nivel2=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel2/selectbuscarDestinos_nivel2?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel2 = respuesta.destinos2; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        selectbuscarDestinos_nivel3(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel3=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel3/selectbuscarDestinos_nivel3?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel3 = respuesta.destino3; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        cambiarPaginaDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad);
        },
        // FIN BUSQUEDA POR DESTINO

        // INICIO BUSQUEDA POR GENERO
        listarPerGenero(page,genero,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerGenero", {
            page : page,
            genero : genero,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerGenero = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPaginaGenero(page,genero,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerGenero(page,genero,especialidad,subespecialidad);
        },
        // FIN BUSQUEDA POR GENERO 

        Atras(){
            this.$router.push({
                name: "ListarPersonalEspecialidades",
                //ENVIO DE DATOS
                // params:{
                //     d: datos
                // }   
            });
        },

        reset(){
            let me = this;
            me.promocion = '';
            me.grado = 0;
            me.especialidad = 0;
            me.subespecialidad = 0;
            me.entidad = 0;
            me.gran_unidad = 0;
            me.reparticion = 0;
            // me.criterio = 0;
        },
        resetReportes(){
            let me = this;
            me.criterio = 0;
        },
        resetEfectivos(){
            let me = this;
            me.efectivo = 0;
        },

        RepPromEspe(promocion,especialidad,subespecialidad){
            window.open('http://sipefab.fab.bo/reporteEspecialidadPromocion?promocion='+promocion+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
            // let me = this;
            // axios
            // .post("/registrarReporte", {
            // //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
            //     rep_reporte : 'CERTIFICADO DESTINOS ASCENSO',
            //     rep_per_codigo : me.per_codigo,
            //     rep_observacion : me.notaAsc,
            // })
            // .then(function (response) {
            //     //Respuesta de la peticion
                
            // })
            // .catch(function (error) {
            //     // handle error
            //     console.log(error);
            // });
        },

        RepGraEspe(grado,especialidad,subespecialidad){
            window.open('http://sipefab.fab.bo/reporteEspecialidadGrado?grado='+grado+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },

        RepEspeEspe(especialidad,subespecialidad){
            window.open('http://sipefab.fab.bo/reporteEspecialidadEspecialidad?especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },

        RepDestEspe(entidad,gran_unidad,reparticion,especialidad,subespecialidad){
            window.open('http://sipefab.fab.bo/reporteEspecialidadDestino?entidad='+entidad+'&gran_unidad='+gran_unidad+'&reparticion='+reparticion+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },

        RepGenEspe(genero,especialidad,subespecialidad){
            // window.open('http://127.0.0.1:8000/reporteEspecialidadGenero?genero='+genero+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
            window.open('http://sipefab.fab.bo/reporteEspecialidadGenero?genero='+genero+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },

        EfectivoEspe(efectivo){
            window.open('http://sipefab.fab.bo/cuadroEfectivoEspe?efectivo='+efectivo);
        },
    },
}
</script>
