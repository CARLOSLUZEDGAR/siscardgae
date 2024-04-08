<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">            
                <h1>
                <i class="far fa-bookmark"></i>
                Datos Familiares Personal dgae
                <!-- <small>Personal</small> -->
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Datos Familiares</li>
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
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <img v-bind:src="'../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                            <!-- FILA 1 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">GRADOS Y NOMBRES</dt>
                                                        <dd class="st">{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-4">
                                                    <dl>
                                                        <dt class="st">CARNET MILITAR</dt>
                                                        <dd class="st">{{arrayDatosPersonal.per_cm}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 2 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                                        <dd class="st">{{arrayDatosPersonal.per_ci}} {{arrayDatosPersonal.per_expedido}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">SITUACIÓN MILITAR ACTUAL</dt>
                                                        <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 3 -->
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                <div v-if="$auth.can('view-insertdatfam')" class="col-md-4">
                                                    <button type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;" title="Registrar Curso"  @click.stop="()=>{isHidden = false; datfamreg = 1; datfamreg2 = 0}">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Añadir Nuevo Familiar
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-sm btn-secondary btn-block" @click="generarReporte(per_codigo)">
                                                        <i class="far fa-file-alt" aria-hidden="true"></i> Generar PDF
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/DatosFamiliares/'">
                                                        <i class="fas fa-reply"></i> Volver Atrás
                                                    </router-link>
                                                </div>
                                            </div>



                                        </div>
                                        
                                    </div>
                                </div>

                                <!--DATOS FAMILIARES--> 
                                <div class="form-group row border justify-content-center">

                                    <div class="col-md-12" v-if="datfamreg2==1" style="font-size: 15px;">
                                        <div class="form-group">
                                            
                                            <div class="card-body">
                                                <div class=" col-md-12">
                                                    <template v-if="arrayDatos_familiares.length > 0">
                                                        <table class="table table-bordered table-striped table-sm tables">
                                                            <thead >
                                                                <tr>
                                                                    <th style="width: 30px;">Opciones</th>
                                                                    <th class="text-center">Parentesco</th>
                                                                    <th class="text-center">Apellido Paterno</th>
                                                                    <th class="text-center">Apellido Materno</th>
                                                                    <th class="text-center">Nombres</th>
                                                                    <th class="text-center">C. Identidad</th>
                                                                    <th class="text-center">Sexo</th>
                                                                    <th class="text-center">Fecha de Nacimiento</th>
                                                                    <th class="text-center">Celular</th>
                                                                    <th class="text-center">Profesión</th>
                                                                    <th style="width: 70px;" class="text-center">Observaciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="datos_familiares in arrayDatos_familiares" :key="datos_familiares.id">
                                                                    <td >
                                                                        <button v-if="$auth.can('view-editdatfam')" type="button" @click="bactualizarDatos_familiares('datos_familiares','actualizar',datos_familiares)" @click.stop="()=>{isHidden = false;datfamreg2=0}" class="btn btn-warning btn-sm">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                        </button> &nbsp;
                                                                        <template v-if="datos_familiares.estado=='1' && $auth.can('delete-destdatfam')">
                                                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarDatosFamiliares(datos_familiares.id)" >
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        </template>   
                                                                    </td>
                                                                    <td v-text="datos_familiares.parentesco" ></td>
                                                                    <td v-text="datos_familiares.paterno"></td>
                                                                    <td v-text="datos_familiares.materno" ></td>
                                                                    <td v-text="datos_familiares.nombre" ></td>
                                                                    <td v-text="datos_familiares.cidentidad+' '+datos_familiares.expedido" ></td>
                                                                    <td v-text="datos_familiares.sexo" ></td>
                                                                    <td v-text="since(datos_familiares.fecha_nac)"></td>
                                                                    <td v-text="datos_familiares.celular"></td>
                                                                    <td v-text="datos_familiares.profesion" ></td>
                                                                    <td v-text="datos_familiares.observacion"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </template>
                                                    <template v-else>
                                                        <div class="callout callout-info">
                                                            <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON DATOS FAMILIARES REGISTRADOS</center></h6>
                                                        </div>
                                                    </template>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12" v-if="!isHidden" style="font-size: 12.5px;" >
                                    <h6 v-if="datfamreg == 1" role="alert" class="alert alert-primary"><i class="fa fa-user-plus"></i>&nbsp;Registrar Nuevo Familiar</h6>
                                    <h6 v-if="datfamreg == 2" role="alert" class="alert alert-warning"><i class="icon-pencil"></i> &nbsp;Actualizar Familiar</h6>
                                    <div class="row">
                                        <div class="col-md-4"><!-- ap- paterno -->
                                            <div class="form-group">
                                                <label>Apellido Paterno</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_paterno" placeholder="Dato requerido" maxlength="30" 
                                                    onkeypress='return ((event.charCode >= 97 && event.charCode <= 122)||(event.charCode >= 65 && event.charCode <= 90) || event.charCode == 209 || event.charCode == 241 || event.charCode == 32)'
                                                    style="text-transform:uppercase">
                                            </div>
                                        </div> 
                                        <div class="col-md-4"><!-- ap. materno -->
                                            <div class="form-group">
                                                <label>Apellido Materno</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_materno" placeholder="Dato requerido" maxlength="30" 
                                                    onkeypress='return ((event.charCode >= 97 && event.charCode <= 122)||(event.charCode >= 65 && event.charCode <= 90) || event.charCode == 209 || event.charCode == 241 || event.charCode == 32)'
                                                    style="text-transform:uppercase">
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!-- nombre -->
                                            <div class="form-group">
                                                <label>Nombres(*)</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_nombre" placeholder="Dato requerido" maxlength="50" 
                                                    onkeypress='return ((event.charCode >= 97 && event.charCode <= 122)||(event.charCode >= 65 && event.charCode <= 90) || event.charCode == 209 || event.charCode == 241 || event.charCode == 32)'
                                                    style="text-transform:uppercase">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><!-- Carnet de identidad -->
                                            <div class="form-group">
                                                <label>Cedula de Identidad(*)</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_cidentidad" placeholder="Dato requerido" maxlength="12" style="text-transform:uppercase;" >
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!-- expedido -->
                                            <div class="form-group">
                                                <label>Expedido</label>
                                                <select class="form-control border border-primary" v-model="datfam_expedido">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="LP">LP</option>
                                                    <option value="SC">SC</option>
                                                    <option value="CH">CH</option>
                                                    <option value="BN">BN</option>
                                                    <option value="OR">OR</option>
                                                    <option value="CB">CB</option>
                                                    <option value="PN">PN</option>
                                                    <option value="PT">PT</option>
                                                    <option value="TJ">TJ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!-- carnet institucional -->
                                            <div class="form-group">
                                                <label>Carnet Institucional</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_cinstitucional" placeholder="INGRESE DATO" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!-- matricula de seguro-->
                                            <div class="form-group">
                                                <label>Matricula de Seguro (COSSMIL/CNS)</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_cossmil" placeholder="INGRESE DATO" style="text-transform:uppercase;" value="0"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><!-- grado parentesco -->
                                            <div class="form-group">
                                                <label>Grado de Parentesco(*)</label>
                                                <select class="form-control border border-primary" v-model="datfam_parentesco">
                                                <option value="0" disabled>SELECCIONE</option>
                                                <option value="ESPOSO(A)">ESPOSO(A)</option>
                                                <option value="PADRE">PADRE</option>
                                                <option value="MADRE">MADRE</option>
                                                <option value="HIJO(A)">HIJO(A)</option>
                                                <option value="CONCUBINO(A)">CONCUBINO(A)</option>
                                                <option value="HERMANO(A)">HERMANO(A)</option>
                                                <option value="ABUELO(A)">ABUELO(A)</option>
                                                <option value="NIETO(A)">NIETO(A)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!-- sexo -->
                                            <div class="form-group">
                                                <label>Sexo(*)</label>
                                                <select class="form-control border border-primary" v-model="datfam_sexo">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="FEMENINO">FEMENINO</option>
                                                    <option value="MASCULINO">MASCULINO</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!-- fech nacimiento -->
                                            <div class="form-group">
                                                <label>Fecha de Nacimiento(*)</label>   
                                                <input class="form-control border border-primary" v-model="datfam_fecnac" type="date" format="DD-MM-YYYY" min="1940-01-01" max="2025-01-01" placeholder="Dato requerido">
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!-- grupo sanguineo -->
                                                <div class="form-group">
                                                    <label>Grupo Sanguineo(*)</label>
                                                    <select class="form-control border border-primary" v-model="datfam_gs">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="ORH+">ORH (+)</option>
                                                    <option value="ORH-">ORH (-)</option>
                                                    <option value="A+">A (+)</option>
                                                    <option value="A-">A (-)</option>
                                                    <option value="B+">B (+)</option>
                                                    <option value="B-">B (-)</option>
                                                    <option value="AB+">AB (+)</option>
                                                    <option value="AB-">AB (-)</option>
                                                </select>
                                                </div>
                                                
                                        </div>
                                        <div class="col-md-2"><!-- celular -->
                                            <div class="form-group">
                                                <label>Número de Celular</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_celular" placeholder="" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!-- telefono -->
                                            <div class="form-group">
                                                <label>Número de Teléfono</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_telefono" placeholder="" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><!-- departamento -->
                                            <div class="form-group">
                                                <label>Departamento(*)</label>
                                                <select class="form-control border border-primary" v-model="famdepa_codigo" v-on:change="changeItem3(rowId, $event)">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option v-for="departamento in arrayfamDepartamento" :key="departamento.id" :value="departamento.id"  v-text="departamento.nombre"></option>
                                                
                                                </select>

                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!-- provincia -->
                                            <div class="form-group">
                                                <label>Provincia(*)</label>
                                                <select class="form-control border border-primary" v-model="famprov_codigo" v-on:change="changeItem4(rowId, $event)">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option v-for="provincia in arrayfamProvincia" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!-- localidad -->
                                            <div class="form-group">
                                                <label>Localidad(*)</label>
                                                <select class="form-control border border-primary" v-model="famloca_codigo">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option v-for="localidad in arrayfamLocalidad" :key="localidad.id" :value="localidad.id" v-text="localidad.nombre"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><!-- domicilio -->
                                            <div class="form-group">
                                                <label>Domicilio Actual(*)</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_domicilio" placeholder="ZONA / AVENIDA / CALLE / NRO." maxlength="150" style="text-transform:uppercase;" >
                                            </div>
                                        </div> 
                                        <div class="col-md-6"><!-- referencias familiares -->
                                            <div class="form-group">
                                                <label>Referencias del Familiar (Observaciones)</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfam_observacion" placeholder="EJ: enfermedad, anemia, invalido, etc." maxlength="300" style="text-transform:uppercase;" value="NINGUNO">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12"><!-- datos profesion -->
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="form-group row border" style="background: #DCDCDC;">
                                                        <div class="col-md-12">                                       
                                                            <label style="font-weight: bold;">DATOS DE LA PROFESIÓN DEL FAMILIAR</label>
                                                        </div>
                                                        <div class="col-md-2"><!-- profesion -->
                                                            <div class="form-group">
                                                                <label>Entidad</label>
                                                                <select class="form-control border border-primary" v-model="datfam_profesion" @change="onChangeSelect($event)">
                                                                    <option value="0">SELECCIONE</option>
                                                                    <option v-for="(option, index) in options" :key="index" :value="option.value">
                                                                        {{ option.content }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2"  ><!-- fuerza -->
                                                            <div class="form-group">
                                                                <label>Fuerza</label>
                                                                
                                                                <select class="form-control border border-primary" v-model="datfam_profmil" :disabled="inputDisabled" >
                                                                <option value="0" disabled>SELECCIONE</option>
                                                                <option value="EJERCITO">EJERCITO</option>
                                                                <option value="FUERZA AEREA">FUERZA AEREA</option>
                                                                <option value="ARMADA">ARMADA</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Descripción Profesión</label>
                                                                <input type="text" class="form-control border border-primary" v-model="datfam_profdesc" placeholder="Describir profesion" maxlength="255" style="text-transform:uppercase;" value="NINGUNO">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Lugar de trabajo</label>
                                                                <input type="text" class="form-control border border-primary" v-model="datfam_telfof" placeholder="Describir Lugar de trabajo, FAB, EJTO, ARMADA" maxlength="200" style="text-transform:uppercase;">
                                                            </div>
                                                        </div>

                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row  justify-content-center">
                                        <div class="col-md-4 offset-md-4 col-sm-12">
                                            <div v-show="errorDatos_familiares" class="alert alert-danger" role="alert" style="padding: 5px" >
                                                <ul style="margin: 2px;">
                                                    <li v-for="error in errorMostrarMsjDatos_familiares" :key="error" v-text="error" style="text-align: justify;"></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-12"><!-- btn registrar-->
                                            <div style="text-align: center;">
                                                
                                                <button type="button" v-if="datfamreg==1" class="btn btn-primary btn-sm" @click="registrarDatos_familiares()"><i class="fa fa-user-plus"></i>&nbsp; Añadir Familiar</button>
                                                <button type="button" v-if="datfamreg==1" class="btn btn-danger btn-sm" @click="cancelarDatos_familiares()" @click.stop="()=>{isHidden = true; datfamreg2=1}"><i class="far fa-window-close"></i>&nbsp; Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><!-- btn actualziar-->
                                            <div style="text-align: center;">
                                                <button type="button" v-if="datfamreg==2" class="btn btn-primary btn-sm" @click="actualizarDatos_familiares()"><i class="fa fa-save"></i>&nbsp; Actualizar Familiar</button>
                                                <button type="button" v-if="datfamreg==2" class="btn btn-danger btn-sm" @click="cancelarDatos_familiares()" @click.stop="()=>{isHidden = true;datfamreg2=1}"><i class="far fa-window-close"></i>&nbsp; Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    
                                    </div>    

                                </div>
                                <!--FIN DATOS FAMILIARES-->
                                
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
import moment from 'moment';
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.e,   /// PUES ACA LLAMAS ELMPARAMETRO d

            arrayDatos_familiares : [],
            arrayfamLocalidad : [],
            arrayfamDepartamento : [],
            arrayfamProvincia : [],
            datos: [],
            /* DATOS FAMILIARES */
            datfam_id : 0,
            per_cm : '', 
            datfam_percodigo : 0,
            datfam_cinstitucional : '',
            datfam_nombre : '',
            datfam_paterno : '',
            datfam_materno : '',
            datfam_fecnac : '',
            datfam_parentesco : 0,
            datfam_sexo : 0,
            datfam_domicilio : '',
            datfam_telefono : 0,
            datfam_celular : '',
            datfam_cossmil : '',
            datfam_cidentidad : '',
            datfam_expedido : 0,
            datfam_profesion : 0,
            datfam_profmil : 0,
            datfam_profdesc : '',
            datfam_telfof : '',
            datfam_gs : 0,
            datfam_observacion : '',
            famdepa_codigo : 0,
            famprov_codigo : 0,
            famloca_codigo : 0,
            datfamreg : 1,
            datfamreg2 : 1,
            ido : 0,
            percodo : 0,
            cod_proflibreo : 0,
            cod_nivprofo : 0,
            cod_carrerao : 0,
            descripciono : '',
            lugar_estudioo : '',
            fecha_egresoo : '',
            estadoo : '',
            observaciono : '',
            sys_usero : '',
            proflibreg : 1,
            proflibreg2 : 1,
            options: [
                { content: 'MILITAR', value: 'MILITAR' },
                { content: 'POLICIA', value: 'POLICIA' },
                { content: 'CIVIL', value: 'CIVIL' }
            ],
            inputDisabled: true,
            isHidden: true,
            isHidden2: true,
            /*FIN DATOS FAMILIARES */
            
            
            // DESDE ACA LA TABLE
        
            
            grado_id : 0,
            documento :'',
            fecha_doc :'',
            fecha : '',
            observaciones : '',
            cm : '',
            sy_suser : '',
            nro_doc : '',
            //edit
            escalafonPersonal_id_edit : 0,
            escalafon_id_edit : 0,
            subescalafon_id_edit : 0,
            grado_id_edit : 0,
            documento_edit :'',
            fecha_doc_edit :'',
            fecha_edit : '',
            observaciones_edit : '',
            cm_edit : '',
            sy_suser_edit : '',
            nro_doc_edit : '',
            // HASTA ACA LA TABLE
            rowId : 0,
            arrayDatosPersonal :[],    

            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            criterio : 'per_nombre',
            buscar : ''

        }
    },
    mounted() {
        
        this.listarDatosFamiliares(this.per_codigo);
        this.datosPersonal(this.per_codigo);
        this.listarDatosPersonalSituacion();
    },
    methods: {
        since: function (d){
            return moment(d).format('DD-MM-YYYY');
        },
        onChangeSelect(e) {      
            this.inputDisabled = (e.target.value != 'MILITAR' && e.target.value != 'CIVIL')
            this.datfam_profmil = 0
        },
        listarDatosFamiliares(per_codigo){
            let me = this;
            axios
            .post("/listarDatosFamiliares", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
                
            var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayDatos_familiares = respuesta.datos_familiares;
            me.selectfamDepartamento();
                // if (me.arrayDatosFisicos[0]['per_codigo'] > 0) {
                //     me.datfisreg = 2;
                // }else{me.datfisreg = 1;}

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        datosPersonal(per_codigo){
           // alert(per_codigo);
            let me = this;
            axios.post("/datosPersonal", {
            per_codigo : per_codigo,
          }).then(function (response) {
            
            me.arrayDatosPersonal = response.data.personal_datos;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        listarDatosPersonalSituacion(){
            let me = this;
            axios.post("/listarDatosPersonalSituacion", {
                percodigo: me.per_codigo
            })
            .then(function (response) {
                me.datos=response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        selectfamLocalidad(){
                let me =this;
                var url='/localidad/selectLocalidad';
                axios.get(url).then(function (response) {

                   var respuesta = response.data;
                   me.arrayfamLocalidad = respuesta.localidad; 
                  
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                })
                .then(function () {
                // always executed
                });
        },

        selectfamDepartamento(){
            let me =this;
            var url='/departamento/selectDepartamento';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayfamDepartamento = respuesta.departamento; 
                
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectfamProvincia(){
            let me =this;
            var url='/provincia/selectProvincia';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayfamProvincia = respuesta.provincia; 
                
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },
        changeItem3: function changeItem3(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectfambuscarProvincia(event.target.value);
        },

        changeItem4: function changeItem24(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectfambuscarLocalidad(event.target.value);
        },
        selectfambuscarProvincia(depa)
        {
            this.selected ="gggg";
            let me =this;
            me.buscarD= depa;
            me.arrayfamProvincia=[];
            // me.famprov_codigo=0;
            var url='/provincia/selectbuscarProvincia?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayfamProvincia = respuesta.provincia; 
                
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

        selectfambuscarLocalidad(depa)
        {
            this.selected ="gggg";
            let me =this;
            me.buscarD= depa;
            me.arrayfamLocalidad=[];
            // me.famloca_codigo=0;
            var url='/localidad/selectbuscarLocalidad?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayfamLocalidad = respuesta.localidad; 
                me.selected ="si";
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

        actualizarDatos_familiares (){


            const swalWithBootstrapButtons = Swal.mixin
            (
                {
                customClass:
                {
                    confirmButton: 'btn btn-success \n',
                    cancelButton: 'btn btn-danger \n'
                },
                    buttonsStyling: false
                }
            )

            swalWithBootstrapButtons.fire
            (
                {
                title: 'Se actualizarán estos valores',
                text: "¿Está seguro de actualizarlos?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar ',
                cancelButtonText: 'Cancelar ',
                reverseButtons: true
                }
            ).then((result) =>
            {
                if (result.value)
                {
                        let me =this;

                        if(me.datfam_nombre!==null){
                                me.datfam_nombre=me.datfam_nombre.toUpperCase();
                        
                        }

                        
                        if(me.datfam_paterno!==null){
                            me.datfam_paterno=me.datfam_paterno.toUpperCase();
                        }
                        if(me.datfam_materno!==null){
                            me.datfam_materno=me.datfam_materno.toUpperCase();
                        }
                        if(me.datfam_domicilio!==null){
                            me.datfam_domicilio=me.datfam_domicilio.toUpperCase();
                        }
                        if(me.datfam_cossmil!==null){
                            me.datfam_cossmil=me.datfam_cossmil.toUpperCase();
                        }
                        if(me.datfam_cossmil!==null){
                            me.datfam_cossmil=me.datfam_cossmil.toUpperCase();
                        }
                        
                        if(me.datfam_profdesc!==null){
                            me.datfam_profdesc=me.datfam_profdesc.toUpperCase();
                        } 
                        if(me.datfam_observacion!==null){
                            me.datfam_observacion=me.datfam_observacion.toUpperCase();
                        } 
                        
                        
                        //
                        
                        // 
                        
                        axios.put('/datos_familiares/actualizar',{
                            
                            
                                
                            'datfam_cm' : this.per_cm,
                            'datfam_percodigo' : this.per_codigo,
                            'datfam_cinstitucional' : this.datfam_cinstitucional,
                            'datfam_nombre' : this.datfam_nombre ,
                            'datfam_paterno' : this.datfam_paterno,
                            'datfam_materno' :this.datfam_materno,
                            'datfam_fecnac' : this.datfam_fecnac,
                            'datfam_parentesco' : this.datfam_parentesco,
                            'datfam_sexo' : this.datfam_sexo,
                            'datfam_domicilio' : this.datfam_domicilio,
                            'datfam_telefono' : this.datfam_telefono,
                            'datfam_celular' : this.datfam_celular, 
                            'datfam_cossmil' : this.datfam_cossmil,
                            'datfam_cidentidad' : this.datfam_cidentidad,
                            'datfam_expedido' : this.datfam_expedido,
                            'datfam_profesion' : this.datfam_profesion,
                            'datfam_profmil' : this.datfam_profmil,
                            'datfam_profdesc' : this.datfam_profdesc,
                            'datfam_telfof' :this.datfam_telfof,
                            'datfam_gs' : this.datfam_gs,
                            'famdepa_codigo' : this.famdepa_codigo,
                            'famprov_codigo' :this.famprov_codigo,
                            'famloca_codigo' : this.famloca_codigo,
                            'estado' : '1',
                            'observacion' : this.datfam_observacion,
                            'sys_user' : 'UPDATE21',

                            
                            'id' : this.datfam_id



                }).then(function (response)
            {
                //1= primera pagina
                //''=valor de busqueda vacio
                //nick = parametro del valor del criterio como valor predeterminado
                // me.listarUsuario(1,'','nick');
                //esta funcion swal nos permite mostrar la notificacion
                //me.excluirDatosFamiliares();

                me.listarDatosFamiliares(me.per_codigo);

                me.datfamreg=1;
                me.datfamreg2 = 1;
                me.isHidden = true;
            
                me.datfam_cinstitucional = '';
                me.datfam_nombre  = '';
                me.datfam_paterno = '';
                me.datfam_materno = '';
                me.datfam_fecnac = '';
                me.datfam_parentesco = 0;
                me.datfam_sexo = 0;
                me.datfam_domicilio = '';
                me.datfam_telefono = '';
                me.datfam_celular = ''; 
                me.datfam_cossmil = '';
                me.datfam_cidentidad = '';
                me.datfam_expedido = 0;
                me.datfam_profesion = 0;
                me.datfam_profmil = 0;
                me.datfam_profdesc = '';
                me.datfam_telfof = '';
                me.datfam_gs = 0;
                me.famdepa_codigo = 0;
                me.famprov_codigo = 0;
                me.famloca_codi = 0;
                me.datfam_observacion = '';
                swalWithBootstrapButtons.fire(
                        'Actualizado',
                        'El registro ha sido actualizado con éxito.',
                        'success'
                )
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
            }
            else if
            (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            )
                {
                }
            })
        },

        excluirDatosFamiliares(){
                let me =this;
            axios.put('/datos_familiares/excluir',{
                    
                    'datfam_percodigo' : this.per_codigo,


            }).then(function (response) {
            
                //me.cerrarModal();
                //me.abrirModal('postulante','estado', idPostulante);
                //me.listarPostulante(1,'','nombres');

                me.listarDatosFamiliares(me.per_codigo);

            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        registrarDatos_familiares (){

            const swalWithBootstrapButtons = Swal.mixin
            (
                {
                customClass:
                {
                    confirmButton: 'btn btn-success \n',
                    cancelButton: 'btn btn-danger \n'
                },
                    buttonsStyling: false
                }
            )

            swalWithBootstrapButtons.fire
            (
                {
                title: 'Se registrará el dato del familiar, .',
                text: "Verifique que sean los correctos",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar \n',
                cancelButtonText: 'Cancelar \n',
                reverseButtons: true
                }
            ).then((result) =>
            {
                if (result.value)
                {
                        let me =this;
                        me.per_cm= this.per_cm;

                        if(me.datfam_nombre!==null){
                                me.datfam_nombre=me.datfam_nombre.toUpperCase();
                        
                        }

                        
                        if(me.datfam_paterno!==null){
                            me.datfam_paterno=me.datfam_paterno.toUpperCase();
                        }
                        if(me.datfam_materno!==null){
                            me.datfam_materno=me.datfam_materno.toUpperCase();
                        }
                        if(me.datfam_domicilio!==null){
                            me.datfam_domicilio=me.datfam_domicilio.toUpperCase();
                        }
                        if(me.datfam_cossmil!==null){
                            me.datfam_cossmil=me.datfam_cossmil.toUpperCase();
                        }
                        if(me.datfam_cossmil!==null){
                            me.datfam_cossmil=me.datfam_cossmil.toUpperCase();
                        }
                        
                        if(me.datfam_profdesc!==null){
                            me.datfam_profdesc=me.datfam_profdesc.toUpperCase();
                        } 
                        if(me.datfam_observacion!==null){
                            me.datfam_observacion=me.datfam_observacion.toUpperCase();
                        }  
                        
                        
                        axios.post('/datos_familiares/registrar',{
                            
                            
                                
                            'datfam_cm' : this.per_cm,
                            'datfam_percodigo' : this.per_codigo,
                            'datfam_cinstitucional' : this.datfam_cinstitucional,
                            'datfam_nombre' : this.datfam_nombre,
                            'datfam_paterno' : this.datfam_paterno,
                            'datfam_materno' :this.datfam_materno,
                            'datfam_fecnac' : this.datfam_fecnac,
                            'datfam_parentesco' : this.datfam_parentesco,
                            'datfam_sexo' : this.datfam_sexo,
                            'datfam_domicilio' : this.datfam_domicilio,
                            'datfam_telefono' : this.datfam_telefono,
                            'datfam_celular' : this.datfam_celular, 
                            'datfam_cossmil' : this.datfam_cossmil,
                            'datfam_cidentidad' : this.datfam_cidentidad,
                            'datfam_expedido' : this.datfam_expedido,
                            'datfam_profesion' : this.datfam_profesion,
                            'datfam_profmil' : this.datfam_profmil,
                            'datfam_profdesc' : this.datfam_profdesc,
                            'datfam_telfof' :this.datfam_telfof,
                            'datfam_gs' : this.datfam_gs,
                            'famdepa_codigo' : this.famdepa_codigo,
                            'famprov_codigo' :this.famprov_codigo,
                            'famloca_codigo' : this.famloca_codigo,
                            'estado' : '1',
                            'observacion' : this.datfam_observacion,
                            'sys_user' : 'UPDATE21' 
                }).then(function (response)
            {
                
                if(me.datfam_parentesco == 'ESPOSO(A)'){
                me.excluirDatosFamiliares();

                me.datfamreg=1;
                me.datfamreg2 = 1;
                me.isHidden = true;

                me.listarDatosFamiliares(me.per_codigo);
                me.datfam_cinstitucional = '';
                me.datfam_nombre  = '';
                me.datfam_paterno = '';
                me.datfam_materno = '';
                me.datfam_fecnac = '';
                me.datfam_parentesco = 0;
                me.datfam_sexo = 0;
                me.datfam_domicilio = '';
                me.datfam_telefono = '';
                me.datfam_celular = ''; 
                me.datfam_cossmil = '';
                me.datfam_cidentidad = '';
                me.datfam_expedido = 0;
                me.datfam_profesion = 0;
                me.datfam_profmil = 0;
                me.datfam_profdesc = '';
                me.datfam_telfof = '';
                me.datfam_gs = 0;
                me.famdepa_codigo = 0;
                me.famprov_codigo = 0;
                me.famloca_codi = 0;
                me.datfam_observacion = '';
                swalWithBootstrapButtons.fire(
                        'Registrado',
                        'El dato familiar ha sido registrado',
                        'success'
                )
                }
                else{
                    me.listarDatosFamiliares(me.per_codigo);
                    me.datfamreg=1;
                me.datfamreg2 = 1;
                me.isHidden = true;
                me.datfam_cinstitucional = '';
                me.datfam_nombre  = '';
                me.datfam_paterno = '';
                me.datfam_materno = '';
                me.datfam_fecnac = '';
                me.datfam_parentesco = 0;
                me.datfam_sexo = 0;
                me.datfam_domicilio = '';
                me.datfam_telefono = '';
                me.datfam_celular = ''; 
                me.datfam_cossmil = '';
                me.datfam_cidentidad = '';
                me.datfam_expedido = 0;
                me.datfam_profesion = 0;
                me.datfam_profmil = 0;
                me.datfam_profdesc = '';
                me.datfam_telfof = '';
                me.datfam_gs = 0;
                me.famdepa_codigo = 0;
                me.famprov_codigo = 0;
                me.famloca_codi = 0;
                me.datfam_observacion = '';
                swalWithBootstrapButtons.fire(
                        'Registrado',
                        'El dato familiar ha sido registrado',
                        'success'
                )
                }
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
            }
            else if
            (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            )
                {
                }
            })
        },

        cancelarDatos_familiares(){
                this.datfamreg=1;
                this.datfam_cinstitucional = '';
                this.datfam_nombre  = '';
                this.datfam_paterno = '';
                this.datfam_materno = '';
                this.datfam_fecnac = '';
                this.datfam_parentesco = 0;
                this.datfam_sexo = 0;
                this.datfam_domicilio = '';
                this.datfam_telefono = '';
                this.datfam_celular = ''; 
                this.datfam_cossmil = '';
                this.datfam_cidentidad = '';
                this.datfam_expedido = 0;
                this.datfam_profesion = 0;
                this.datfam_profmil = 0;
                this.datfam_profdesc = '';
                this.datfam_telfof = '';
                this.datfam_gs = 0;
                this.famdepa_codigo = 0;
                this.famprov_codigo = 0;
                this.famloca_codi = 0;
                this.datfam_observacion = 'NINGUNO';  
                this.errorDatos_familiares=0;
                this.errorMostrarMsjDatos_familiares =[];

        },

        
        
        bactualizarDatos_familiares(modelo,accion, data = []){//este metodo nos permite abrir el formulario modal, el primer para metro especifica la tabla en el cual se va trabajar, el segundo especifica la accion que se va realizar y el tercer parametro que sera registrar o actualizar
            switch(modelo){
                case "datos_familiares" ://este swhitc identifica en la tabla en la cual se va trabajar
                    {
                        switch(accion){ //identifica la accion que se va realizar
                                
                            case 'actualizar':
                                {
                                    
                                        let me=this;
                                    me.datfam_l = data['fecha_nac'];
                                        me.datfam_l= me.datfam_l.substring(0,10);                         
                                        var info9 = me.datfam_l.split('-');
                                        me.datfam_l=info9[0] + '-' + info9[1] + '-' + info9[2];

                                    me.datfam_id = data['id'];//aqui se obtiene el valor unico y se permite identificar la fila que se selecciono en la fila
                                    



                                    this.datfam_cm = data['per_cm']; 
                                    this.datfam_percodigo = data['per_codigo'];
                                    this.datfam_cinstitucional = data['cinstitucional'];
                                    this.datfam_nombre = data['nombre'];
                                    this.datfam_paterno = data['paterno'];
                                    this.datfam_materno = data['materno'];
                                    this.datfam_fecnac =me.datfam_l;
                                    
                                    this.datfam_parentesco = data['parentesco'];
                                    this.datfam_sexo = data['sexo'];
                                    this.datfam_domicilio = data['domicilio'];
                                    this.datfam_telefono = data['telefono'];
                                    this.datfam_celular = data['celular'];
                                    this.datfam_cossmil = data['cossmil'];
                                    this.datfam_cidentidad = data['cidentidad'];
                                    this.datfam_expedido = data['expedido'].trim();
                                    
                                    this.datfam_profesion = data['profesion'];
                                    if(this.datfam_profesion == 'MILITAR'){this.inputDisabled= false} //desbloquea
                                    if(this.datfam_profesion !== 'MILITAR'){this.inputDisabled= true}
                                    this.datfam_profmil = data['profmil'];
                                    this.datfam_profdesc = data['profdesc'];
                                    this.datfam_telfof = data['proflugar'];
                                    this.datfam_gs = data['gs'];
                                    this.datfam_observacion = data['observacion'];
                                    this.famdepa_codigo = data['depa_cod'];
                                    this.famprov_codigo =  data['prov_cod'];
                                    this.famloca_codigo =  data['loca_cod'];
                                    this.datfam_percodigo= data['per_codigo'];

                                    this.selectfambuscarProvincia(this.famdepa_codigo);
                                    this.selectfambuscarLocalidad(this.famprov_codigo);
                                        this.famprov_codigo = data['prov_cod'];
                                        this.famloca_codigo = data['loca_cod'];
                                    this.datfamreg=2;
                                    break;
                                }
                        }
                    }
            }
        },

        desactivarDatosFamiliares(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: '¿Esta usted seguro de eliminar a este familiar?',
            text: "No podra revertir esta acción.",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true

            }).then((result) => {
            if (result.value) {
                
            let me =this;
            axios.put('/datos_familiares/desactivar',{
                    
                    'id' : id
            }).then(function (response) {
            
                
                me.listarDatosFamiliares(me.per_codigo);
                swalWithBootstrapButtons.fire(
                '¡Eliminado..!',
                'El registro ha sido eliminado.',
                'success'
                )

            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });



            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                
            }
            })
        },

        generarReporte($per_codigo){
            window.open('http://sipefab.fab.bo/reporte/generareportpersonal?J3jH6ks='+ $per_codigo, '_blank');
        }

        



    },
}
</script>

<style>    
    .tables {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }


</style>