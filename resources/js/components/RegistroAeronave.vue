<template>
    <div>
      <!-- Content Header Page header -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">            
              <h1>
                <i class="far fa-registered"></i>&nbsp;
                REGISTRAR AERONAVE
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
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
                  <div class="row">
                    <div class="col-sm-8">
                      <h3 class="card-title">
                        <!-- Buscar Personal -->
                      </h3>  
                    </div>                  
                    <div class="col-sm-4">
                      <button class="btn btn-danger btn-sm float-right" type="submit" @click="Atras()">
                        <i class="fas fa-arrow-left"></i>&nbsp; VOLVER
                      </button>
                    </div>
                  </div>  
                </div>
                <div class="card-body">
                    <form>
                        <!-- Paso 1 -->
                        <div class="step" v-if="currentStep === 1">
                            <h3><i class="fas fa-inbox"></i>&nbsp;PASO 1: INFORMACIÓN DE LA AERONAVE</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="form-control-label" for="text-input">Fabrica</label>
                                    <input type="text" v-model="fabrica" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.fabrica.$error, 'is-valid':!$v.fabrica.$invalid }" />
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fabrica.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label" for="text-input">Modelo</label>
                                    <input type="text" v-model="modelo" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.modelo.$error, 'is-valid':!$v.modelo.$invalid }" />
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.modelo.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label" for="text-input">Serie</label>
                                    <input type="text" v-model="serie" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.serie.$error, 'is-valid':!$v.serie.$invalid }" />
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.serie.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <label class="form-control-label" for="text-input">Tipo de Aeronave</label>
                                  <select class="form-control" v-model="categoria" :class="{ 'is-invalid' : $v.categoria.$error, 'is-valid':!$v.categoria.$invalid }">
                                      <option value="" disabled>SELECCIONE</option>
                                      <option v-for="categoria in arrayCategoriaAeronave" :key="categoria.id" :value="categoria.id"  v-text="categoria.categoria"></option>                        
                                  </select>                                   
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.categoria.required">Este campo es Requerido</span>
                                      <span v-else-if="!$v.categoria.letrasSpanish">Solo letras</span>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <label class="form-control-label" for="text-input">Categoria</label>
                                  <select class="form-control" v-model="tipo" :class="{ 'is-invalid' : $v.tipo.$error, 'is-valid':!$v.tipo.$invalid }">
                                      <option value="" disabled>SELECCIONE</option>
                                      <option v-for="tipo in arrayTipoAeronave" :key="tipo.id" :value="tipo.id"  v-text="tipo.tipo"></option>                        
                                  </select>                                   
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.tipo.required">Este campo es Requerido</span>
                                      <span v-else-if="!$v.tipo.letrasSpanish">Solo letras</span>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <label class="form-control-label" for="text-input">Condición</label>
                                  <select class="form-control" v-model="condicion" :class="{ 'is-invalid' : $v.condicion.$error, 'is-valid':!$v.condicion.$invalid }">
                                      <option value="" disabled>SELECCIONE</option>
                                      <option v-for="condicion in arrayCondicionAeronave" :key="condicion.id" :value="condicion.id"  v-text="condicion.condicion"></option>                        
                                  </select>                                
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.condicion.required">Este campo es Requerido</span>
                                      <span v-else-if="!$v.condicion.letrasSpanish">Solo letras</span>
                                  </div>
                                </div>
                            </div>
                            
                            <div class="form-group row justify-content-center">                                
                              <div class="col-md-3" style="text-align: center;">
                                    <template>
                                      <div style="text-align: center;">
                                        <img :src="v === 0 ? '/img/avatar_aeronave.png' : imagen" width="200" height="200" style="border: 1.5px solid black;">
                                      </div>
                                    </template>
                              </div>
                              <div class="col-md-3">
                                  <label class="form-control-label" for="text-input">Fotografía</label>
                                  <input type="file" class="form-control" @change="obtenerImagen" accept="image/*" v-bind:class="{ 'is-invalid': $v.fotografia.$error, 'is-valid':!$v.fotografia.$invalid }">
                                  <div class="invalid-feedback">
                                      <div v-if="!$v.fotografia.required">Por favor, carga tu fotografia.</div>
                                  </div>
                              </div>
                          </div>
                            <div class="form-group row justify-content-end">
                                <button type="button" class="btn btn-danger" @click="nextStep">
                                    <i class="fas fa-forward"></i>&nbsp; SIGUIENTE
                                </button>
                            </div>
                        </div>
                        
                        <!-- Paso 2 -->
                        <div class="step" v-if="currentStep === 2">
                          <h3><i class="far fa-folder"></i>&nbsp;PASO 2: ASIGNACIÓN DE UNIDAD</h3>
                          <br>
                          <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-control-label" for="text-input"><h4 style="text-transform:uppercase;">AERONAVE: {{ modelo }}</h4></label>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Entidad</label>
                                <select class="form-control" v-model="entidad" @click="listarGranUnidad(entidad), g_unidad = '', unidad = ''" :class="{ 'is-invalid' : $v.entidad.$error, 'is-valid':!$v.entidad.$invalid }">
                                    <option value="" disabled>SELECCIONE</option>
                                    <option v-for="entidad in arrayEntidad" :key="entidad.id" :value="entidad.id"  v-text="entidad.entidad"></option>                        
                                </select>                                        
                                <div class="invalid-feedback">
                                    <span v-if="!$v.entidad.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Matricula</label>
                                <input type="text" v-model="matricula" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.matricula.$error, 'is-valid':!$v.matricula.$invalid }" />
                                <div class="invalid-feedback">
                                    <span v-if="!$v.matricula.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Gran Unidad</label>
                                <select class="form-control" v-model="g_unidad" @click="listarUnidad(g_unidad), unidad = ''" :class="{ 'is-invalid' : $v.g_unidad.$error, 'is-valid':!$v.g_unidad.$invalid }">
                                    <option value="" disabled>SELECCIONE</option>
                                    <option v-for="gunidad in arrayGranUnidad" :key="gunidad.id" :value="gunidad.id"  v-text="gunidad.gran_unidad"></option>                        
                                </select>                                        
                                <div class="invalid-feedback">
                                    <span v-if="!$v.g_unidad.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Unidad</label>
                                <select class="form-control" v-model="unidad" :class="{ 'is-invalid' : $v.unidad.$error, 'is-valid':!$v.unidad.$invalid }">
                                    <option value="" disabled>SELECCIONE</option>
                                    <option v-for="unidad in arrayUnidad" :key="unidad.id" :value="unidad.id"  v-text="unidad.unidad"></option>                        
                                </select>                                        
                                <div class="invalid-feedback">
                                    <span v-if="!$v.unidad.required">Este campo es Requerido</span>
                                </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <!-- <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Fecha de Fabricación</label>
                                <input type="date" v-model="fech_fabricacion" class="form-control" :class="{ 'is-invalid' : $v.fech_fabricacion.$error, 'is-valid':!$v.fech_fabricacion.$invalid }">
                                <input type="date" v-model="fech_fabricacion" class="form-control" />
                                <div class="invalid-feedback">
                                    <span v-if="!$v.fech_fabricacion.required">Este campo es Requerido</span>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Fecha de Incorporación</label>
                                <input type="date" v-model="fech_ingreso" class="form-control" :class="{ 'is-invalid' : $v.fech_ingreso.$error, 'is-valid':!$v.fech_ingreso.$invalid }" />
                                <div class="invalid-feedback">
                                    <span v-if="!$v.fech_ingreso.required">Este campo es Requerido</span>
                                    <span v-else-if="!$v.fech_ingreso.letrasSpanish">Solo letras</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Documento de Incorporación</label>
                                <select class="form-control" v-model="doc_ingreso" :class="{ 'is-invalid' : $v.doc_ingreso.$error, 'is-valid':!$v.doc_ingreso.$invalid }">
                                    <option value="" disabled>SELECCIONE</option>
                                    <option value="RESOLUCION">RESOLUCION</option>
                                    <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                    <option value="MEMORANDUM">MEMORANDUM</option>
                                </select>                                  
                                <div class="invalid-feedback">
                                    <span v-if="!$v.doc_ingreso.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label" for="text-input">Nº Documento de Incorporación</label>
                                <input type="text" v-model.trim="nro_doc_ingreso" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.nro_doc_ingreso.$error, 'is-valid':!$v.nro_doc_ingreso.$invalid }">
                                <div class="invalid-feedback">
                                    <span v-if="!$v.nro_doc_ingreso.required">Este campo es Requerido</span>
                                    <span v-else-if="!$v.nro_doc_ingreso.letrasSpanish">Solo letras</span>
                                </div>
                            </div>   
                          </div>    
                          <div class="form-group row justify-content-end">
                            <button type="button" class="btn btn-primary" @click="previousStep"><i class="fas fa-backward"></i>&nbsp; ANTERIOR</button>
                            &nbsp;
                            <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button>
                          </div>

                        </div>
                        <!-- Paso 3 -->
                        <div class="step" v-if="currentStep === 3">
                          <h3>
                            <i class="fas fa-inbox"></i>&nbsp;PASO 3: INFORMACIÓN DEL (DE LOS) MOTOR (MOTORES)
                          </h3>
                          <br>
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label class="form-control-label" for="text-input"><h4 style="text-transform:uppercase;">MATRÍCULA Y MODELO: {{ matricula }} {{ modelo }}</h4></label>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-3" style="text-align: center;">
                              <label class="form-control-label" for="cant_motores">Numero de Motores</label>
                              <select
                                class="form-control"
                                v-model="cant_motores"
                                @change="crearInputs"
                                :class="{ 'is-invalid': $v.cant_motores.$error, 'is-valid': !$v.cant_motores.$invalid }"
                              >
                                <option value="" disabled>SELECCIONE</option>
                                <option value="1">MONOMOTOR</option>
                                <option value="2">BIMOTOR</option>
                                <option value="3">TRIMOTOR</option>
                                <option value="4">CUATRIMOTOR</option>
                              </select>
                              <div class="invalid-feedback">
                                <span v-if="!$v.cant_motores.required">Este campo es Requerido</span>
                              </div>
                            </div>
                          </div>

                         <div class="form-group row" v-for="(input, index) in inputs" :key="index">
                            <div class="col-md-3">
                              <label class="form-control-label" :for="'fabrica_motor' + index">
                                Fabrica Motor # {{ index + 1 }}:
                              </label>
                              <input
                                type="text"
                                v-model="input.fabrica_motor"
                                class="form-control"
                                style="text-transform: uppercase;"
                                :id="'fabrica_motor' + index"
                                :class="{
                                  'is-invalid': $v.inputs[index] && $v.inputs[index].fabrica_motor && $v.inputs[index].fabrica_motor.$error,
                                  'is-valid': $v.inputs[index] && $v.inputs[index].fabrica_motor && !$v.inputs[index].fabrica_motor.$invalid,
                                }"
                              />
                              <div class="invalid-feedback">
                                <span v-if="$v.inputs[index] && $v.inputs[index].fabrica_motor && !$v.inputs[index].fabrica_motor.required">
                                  Este campo es Requerido
                                </span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label class="form-control-label" :for="'modelo_motor' + index">
                                Modelo Motor # {{ index + 1 }}:
                              </label>
                              <input
                                type="text"
                                v-model="input.modelo_motor"
                                class="form-control"
                                style="text-transform: uppercase;"
                                :id="'modelo_motor' + index"
                                :class="{
                                  'is-invalid': $v.inputs[index] && $v.inputs[index].modelo_motor && $v.inputs[index].modelo_motor.$error,
                                  'is-valid': $v.inputs[index] && $v.inputs[index].modelo_motor && !$v.inputs[index].modelo_motor.$invalid,
                                }"
                              />
                              <div class="invalid-feedback">
                                <span v-if="$v.inputs[index] && $v.inputs[index].modelo_motor && !$v.inputs[index].modelo_motor.required">
                                  Este campo es Requerido
                                </span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label class="form-control-label" :for="'serie_motor' + index">
                                Serie Motor # {{ index + 1 }}:
                              </label>
                              <input
                                type="text"
                                v-model="input.serie_motor"
                                class="form-control"
                                style="text-transform: uppercase;"
                                :id="'serie_motor' + index"
                                :class="{
                                  'is-invalid': $v.inputs[index] && $v.inputs[index].serie_motor && $v.inputs[index].serie_motor.$error,
                                  'is-valid': $v.inputs[index] && $v.inputs[index].serie_motor && !$v.inputs[index].serie_motor.$invalid,
                                }"
                              />
                              <div class="invalid-feedback">
                                <span v-if="$v.inputs[index] && $v.inputs[index].serie_motor && !$v.inputs[index].serie_motor.required">
                                  Este campo es Requerido
                                </span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label class="form-control-label" :for="'estado_motor' + index">
                                Estado Motor # {{ index + 1 }}:
                              </label>
                              <select
                                class="form-control"
                                v-model="input.estado_motor"
                                :id="'estado_motor' + index"
                                :class="{
                                 'is-invalid': $v.inputs[index] && $v.inputs[index].estado_motor && $v.inputs[index].estado_motor.$error,
                                  'is-valid': $v.inputs[index] && $v.inputs[index].estado_motor && !$v.inputs[index].estado_motor.$invalid,
                                }"
                              >
                                <option value="" disabled>SELECCIONE</option>
                                <option value="W">OPERABLE</option>
                                <option value="P">NO OPERABLE</option>
                              </select>
                              <div class="invalid-feedback">
                                <span v-if="$v.inputs[index] && $v.inputs[index].estado_motor && !$v.inputs[index].estado_motor.required">
                                  Este campo es Requerido
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row justify-content-end">
                            <button type="button" class="btn btn-primary" @click="previousStep">
                              <i class="fas fa-backward"></i>&nbsp; ANTERIOR
                            </button>
                            &nbsp;
                            <button type="button" class="btn btn-danger" @click="nextStep">
                              <i class="fas fa-forward"></i>&nbsp; SIGUIENTE
                            </button>
                          </div>
                        </div>

                    <!-- Paso 4 -->
                    <div class="step" v-if="currentStep === 4">
                      <h3><i class="far fa-folder"></i>&nbsp;PASO 4: DOCUMENTACIÓN DE LA AERONAVE</h3>
                      <br>
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label class="form-control-label" for="text-input"><h4 style="text-transform:uppercase;">MATRÍCULA Y MODELO: {{ matricula }} {{ modelo }}</h4></label>
                              </div>
                          </div>
                            <div class="form-group row">
                                <div class="col-md-12" style="background-color:gold;">
                                    <label class="form-control-label" for="text-input">LOS DOCUMENTOS DEBEN ESTAR EN FORMATO PDF <i class="fa fa-file-pdf"></i>.</label>
                                </div>
                            </div>
                            
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 12pt;">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">DOCUMENTO</th>
                                            <th class="text-center">ARCHIVO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <label class="form-control-label" for="text-input">1</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE MATRÍCULA</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerCerMatricula" accept=".pdf" v-bind:class="{ 'is-invalid': $v.cert_matricula.$error, 'is-valid':!$v.cert_matricula.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.cert_matricula.required">Por favor, carga un archivo.</span>
                                                </div>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <label class="form-control-label" for="text-input">2</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE AERONAVEGABILIDAD</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerCerAeronavegabilidad" accept=".pdf" v-bind:class="{ 'is-invalid': $v.cert_aeronavegabilidad.$error, 'is-valid':!$v.cert_aeronavegabilidad.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.cert_aeronavegabilidad.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="text-center">
                                                <label class="form-control-label" for="text-input">3</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE EGRESO</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerEgreso" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_egreso.$error, 'is-valid':!$v.doc_egreso.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_egreso.required">Por favor, carga un archivo.</span>
                                                </div>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <label class="form-control-label" for="text-input">4</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE ESPECIALIZACIÓN</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerEspecializacion" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_especializacion.$error, 'is-valid':!$v.doc_especializacion.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_especializacion.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <label class="form-control-label" for="text-input">5</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO MEDICO</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerMedico" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_medico.$error, 'is-valid':!$v.doc_medico.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_medico.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            <label class="form-control-label" for="text-input">6</label>
                                          </td>
                                          <td>
                                            <label class="form-control-label" for="text-input">TITULO EDUCATIVO</label>
                                          </td>
                                          <td>
                                            <input type="file" class="form-control" @change="obtenerTitulo" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_titulo.$error, 'is-valid':!$v.doc_titulo.$invalid }">
                                            <div class="invalid-feedback">
                                              <span v-if="!$v.doc_titulo.required">Por favor, carga un archivo.</span>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            <label class="form-control-label" for="text-input">7</label>
                                          </td>
                                          <td>
                                            <label class="form-control-label" for="text-input">LIBRETA MILITAR</label>
                                          </td>
                                          <td>
                                            <input type="file" class="form-control" @change="obtenerLibreta" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_libreta.$error, 'is-valid':!$v.doc_libreta.$invalid }">
                                            <div class="invalid-feedback">
                                              <span v-if="!$v.doc_libreta.required">Por favor, carga un archivo.</span>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            <label class="form-control-label" for="text-input">8</label>
                                          </td>
                                          <td>
                                            <label class="form-control-label" for="text-input">CERTIFICADO DE APROBACIÓN DE EXAMEN</label>
                                          </td>
                                          <td>
                                            <input type="file" class="form-control" @change="obtenerAprobacion" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_aprobacion.$error, 'is-valid':!$v.doc_aprobacion.$invalid }">
                                            <div class="invalid-feedback">
                                              <span v-if="!$v.doc_aprobacion.required">Por favor, carga un archivo.</span>
                                            </div>
                                          </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row justify-content-end">
                              <button type="button" class="btn btn-primary" @click="previousStep"><i class="fas fa-backward"></i>&nbsp; ANTERIOR</button>
                                &nbsp;
                                <button type="button" class="btn btn-danger" @click="CrearAeronave()"><i class="fas fa-save"></i>&nbsp; GUARDAR</button>
                            </div>
                    </div>
                    </form>
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
  import { required, between, minLength, maxLength, alpha, numeric, email, helpers, date} from "vuelidate/lib/validators";
  export default {
    data() {
      return {
        // INICIO VARIABLES DGAE
        
        currentStep: 1,
        // PASO 1
        entidad : '',
        matricula : '',
        g_unidad : '',
        unidad : '',
        // PASO 2
        fabrica : '',
        modelo : '',
        serie : '',
        categoria : '',
        tipo : '',
        condicion : '',
        fech_fabricacion : '',
        fech_ingreso : '',
        doc_ingreso : '',
        nro_doc_ingreso : '',
        fotografia : '',
        // PASO 3
        cant_motores : '',
        // fabrica_motor : '',
        // modelo_motor : '',
        // serie_motor : '',
        // estado_motor : '',
        // cantidad : 0,
        // input : '',
        inputs : [], // Aquí se almacenarán los valores de los inputs dinámicos
        cert_matricula : '',
        cert_aeronavegabilidad : '',

        arrayEntidad : [],
        arrayGranUnidad : [],
        arrayUnidad : [],


        arrayCategoriaAeronave : [],
        arrayTipoAeronave : [],
        arrayCondicionAeronave : [],
        arrayGrado : [],
        arrayNacionalidad : [],
        arrayLicencia : [],
        arrayHabilitacion : [],
        arrayCompetenciaLinguistica : [],
        arraySexo : ['MASCULINO','FEMENINO'],
        arrayDatAeronave : [],
        arrayNacionalidadA : [],
        v : 0,
        // vA : 0,
        // vCI : 0,
  
        
  
        // FIN VARIABLES DGAE
        arrayPersonal : [],
        arrayDatosFisicos: [],
        datos_fisicos : [],
        listaPersonal: [],
        criterio: "p.modelo",
        buscar:"",
        setTiemoutBuscador: '',
        isHidden: true,
        datfis2 : 1,
  
          
        pagination: {
              'total'         :   0,
              'current_page'  :   0,
              'per_page'      :   0,
              'last_page'     :   0,
              'from'          :   0,
              'to'            :   0,
          },
      offset : 3,
      }
    },
  
    validations: {
            entidad : { required },
            matricula : { required },
            g_unidad : { required },
            unidad : { required },
            fabrica : { required },
            modelo : { required },
            serie : { required },
            categoria : { required },
            tipo : { required },
            condicion : { required },
            // fech_fabricacion : { required },
            fech_ingreso : { required },
            doc_ingreso : { required },
            nro_doc_ingreso : { required },
            fotografia : { required },
            cant_motores : { required },
            inputs: {
              $each: {
                posicion_motor : { required },
                fabrica_motor : { required },
                modelo_motor : { required },
                serie_motor : { required },
                estado_motor : { required },
              },
            },

            cert_matricula : { required },
            cert_aeronavegabilidad : { required },
            // fabrica_motor : { required },
            // modelo_motor : { required },
            // serie_motor : { required },
            // estado_motor : { required },
            // nombre : { required, letrasSpanish: value => /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]+$/.test(value) },      
            
            validationGroupPaso1: [
              'fabrica',
              'modelo',
              'serie',
              'categoria',
              'tipo',
              'condicion',
              // 'fech_fabricacion',
              'fotografia',
            ],

            validationGroupPaso2: [
              'entidad',
              'matricula',
              'g_unidad',
              'unidad',
              'fech_ingreso',
              'doc_ingreso',
              'nro_doc_ingreso',
            ],

            validationGroupPaso3: [
            'cant_motores',
            'inputs',
            // 'fabrica_motor',
            // 'modelo_motor',
            // 'serie_motor',
            // 'estado_motor',
            ],

            // validationGroupPaso4: [
            //   'cert_matricula',
            //   'cert_aeronavegabilidad'
            // ],
  
            validationGroupReg: [
            // 'entidad',
            // 'matricula',
            // 'g_unidad',
            // 'unidad',
            // 'fotografia',
            // 'modelo',
            // 'serie',
            // 'nombre'
            'cert_matricula',
            'cert_aeronavegabilidad'
            ],
            validationGroupDocument:[
            ]
          },
  
   computed: {
          isActived   : function(){
              return this.pagination.current_page;
          },
          //creando funcion para calcular los elementos de la paginacion
          pagesNumber : function(){
              //si la pagina llega hasta la ultima pagina esta me va retornar un arrary vacio
              if(!this.pagination.to){
                  return [];
              }
  
              var from =  this.pagination.current_page - this.offset;
              if(from < 1){
                  from = 1;
              }
  
              var to = from + (this.offset * 2);
              if(to >= this.pagination.last_page){
                  to = this.pagination.last_page;
              }
  
              var pagesArray = [];
              while(from <= to){
                  pagesArray.push(from);
                  from++;
              }
              return pagesArray;
          },
          imagen(){
              return this.fotografia;
          },
          imagenA(){
              return this.fotografiaA;
          }
      },
    mounted() {
        this.NuevoAeronave();
        // this.listarGranUnidad(this.entidad);
        // this.ListarPersonal(1);
    },
    methods: {
    //   crearInputs() {
    //   // Resetear los inputs cada vez que cambia la cantidad seleccionada
    //   this.inputs = Array.from({ length: this.cant_motores }, () => ({ value: '' }));
    // },

    crearInputs() {
      this.inputs = [];
      for (let i = 0; i < this.cant_motores; i++) {
        this.inputs.push({
          posicion_motor: (i + 1),
          fabrica_motor: '',
          modelo_motor: '',
          serie_motor: '',
          estado_motor: ''
        });
      }
      this.$v.validationGroupPaso3.$reset();
    },

      Atras(){ //DGAE
          this.$router.push({
              name: "DatosAeronaves",  
          });
      },

      nextStep() { //DGAE
          switch (this.currentStep) {
            case 1:
              if(!this.$v.validationGroupPaso1.$invalid){
                this.currentStep++;
              }else{
                this.$v.validationGroupPaso1.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })   
              }
            break;
            case 2:
              if(!this.$v.validationGroupPaso2.$invalid){
                this.currentStep++;
              }else{
                  this.$v.validationGroupPaso2.$touch();
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ingrese todos los datos requeridos',
                      showConfirmButton: false,
                      timer: 2000
                  })   
              }
            break;
            case 3:
              if(!this.$v.validationGroupPaso3.$invalid){
                this.currentStep++;
              }else{
                  this.$v.validationGroupPaso3.$touch();
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ingrese todos los datos requeridos',
                      showConfirmButton: false,
                      timer: 2000
                  })   
              }
            break;
            // case 4:
            //   if(!this.$v.validationGroupPaso4.$invalid){
            //     this.currentStep++;
            //   }else{
            //       this.$v.validationGroupPaso3.$touch();
            //       Swal.fire({
            //           icon: 'warning',
            //           title: 'Ingrese todos los datos requeridos',
            //           showConfirmButton: false,
            //           timer: 2000
            //       })   
            //   }
            // break;
          }
      },

      previousStep() { //DGAE
        if (this.currentStep > 1) {
          this.currentStep--;
        }
      },

      obtenerCerMatricula(e){
        try {
                var fileReader = new FileReader();
    
                fileReader.onload = (e) => {
                    this.cert_matricula = e.target.result;
                }
                fileReader.readAsDataURL(e.target.files[0])
                // this.vNAC = 1;
            } catch (error) {
                
            }
      },

      obtenerCerAeronavegabilidad(e){
        try {
                var fileReader = new FileReader();
    
                fileReader.onload = (e) => {
                    this.cert_aeronavegabilidad = e.target.result;
                }
                fileReader.readAsDataURL(e.target.files[0])
                // this.vNAC = 1;
            } catch (error) {
                
            }
      },

      obtenerImagen(e){
          try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.fotografia = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.v = 1;
          } catch (error) {
              
          }
      },

      listarEntidad(){ //DGAE
          let me = this;
          axios
        .post("/listarEntidad", {
          id_nacionalidad : 1,
        })
        .then(function (response) {
          me.arrayEntidad = response.data.entidades
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      listarGranUnidad(entidad){
        let me = this;
          axios
        .post("/listarGranUnidad", {
          id_entidad : entidad,
        })
        .then(function (response) {
          me.arrayGranUnidad = response.data.gran_unidades
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      listarUnidad(gran_unidad){
        let me = this;
          axios
        .post("/listarUnidad", {
          id_gran_unidad : gran_unidad,
        })
        .then(function (response) {
          me.arrayUnidad = response.data.unidades
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      listarCategoriaAeronave(){ //DGAE
          let me = this;
          axios
        .post("/listarCategoriaAeronave", {
          // id_nacionalidad : 1,
        })
        .then(function (response) {
          me.arrayCategoriaAeronave = response.data.categoria_aeronaves
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      listarTipoAeronave(){ //DGAE
          let me = this;
          axios
        .post("/listarTipoAeronave", {
          // id_nacionalidad : 1,
        })
        .then(function (response) {
          me.arrayTipoAeronave = response.data.tipo_aeronaves
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      listarCondicionAeronave(){ //DGAE
          let me = this;
          axios
        .post("/listarCondicionAeronave", {
          // id_nacionalidad : 1,
        })
        .then(function (response) {
          me.arrayCondicionAeronave = response.data.condicion_aeronaves
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      NuevoAeronave(){ //DGAE
        this.$v.validationGroupPaso1.$reset(),
        this.$v.validationGroupPaso2.$reset(),
        this.entidad = '',
        this.matricula = '',
        this.g_unidad = '',
        this.unidad = '',
        this.fabrica = '',
        this.modelo = '',
        this.serie = '',
        this.categoria = '',
        this.tipo = '',
        this.condicion = '',
        this.fech_fabricacion = '',
        this.fech_ingreso = '',
        this.doc_ingreso = '',
        this.nro_doc_ingreso = '',
        this.fotografia = '',
        this.cant_motores = '',
        this.inputs = [],
        // this.fabrica_motor = '',
        // this.modelo_motor = '',
        // this.serie_motor = '',
        // this.estado_motor = '',
        this.v = 0,
        this.listarEntidad();
        // this.listarGranUnidad(this.entidad);
        this.listarTipoAeronave();
        this.listarCategoriaAeronave();
        this.listarCondicionAeronave()
      },


  
      CrearAeronave(){ //DGAE
        if(!this.$v.validationGroupReg.$invalid){
          swal.fire({
              title: '¿Desea registrar la Aeronave?', // TITULO 
              icon: 'question', //ICONO (success, warnning, error, info, question)
              showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
              confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
              cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
              confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
              cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
              buttonsStyling: true,
              reverseButtons: true
              }).then((result) => {
              if (result.value) {
                  let me = this;
                  axios
                  .post("/crearAeronave", {
                    fabrica : me.fabrica,
                    modelo : me.modelo,
                    serie : me.serie,
                    tipo : me.tipo,
                    categoria : me.categoria,
                    condicion : me.condicion,
                    foto : me.fotografia,

                    entidad : me.entidad,
                    matricula : me.matricula,
                    g_unidad : me.g_unidad,
                    unidad : me.unidad,
                    // fech_fabricacion : me.fech_fabricacion,
                    fech_ingreso : me.fech_ingreso,
                    doc_ingreso : me.doc_ingreso,
                    nro_doc_ingreso : me.nro_doc_ingreso,
                    // modelo : me.modelo,
                    // nombre : me.nombre,

                    cant_motores : me.cant_motores,
                    motores : me.inputs,

                    cert_matricula : me.cert_matricula,
                    cert_aeronavegabilidad : me.cert_aeronavegabilidad
                  })
                  .then(function (response) {
                      
                      console.log(response);
                      swal.fire({
                          title: 'Se realizo el registro de la Aeronave correctamente', //TITULO
                      });
                      if (!response.data.code) {
                          // me.arrayDatAeronave = response.data.aeronave;
                          // me.GenerarCarnet(me.arrayDatAeronave.id_personal);
                          me.Atras();
                          this.$v.$reset();
                      } 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  })
              }else{
                    swal.fire(
                      "Informacion", //TITULO
                      "Solicitud cancelada.", //TEXTO DE MENSAJE
                      "info" // TIPO DE MODAL (success, warnning, error, info)
                  );
              }
          })
        }else{
            this.$v.validationGroupReg.$touch();
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese todos los datos requeridos',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
      },  
    },
  };
  
  </script>
  
  <style>
  </style>