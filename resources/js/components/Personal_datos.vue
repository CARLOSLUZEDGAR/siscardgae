<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">            
                        <h1>
                            <i class="far fa-bookmark"></i>
                            Datos del Personal
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Datos del Personal</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section> 
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <!-- <h3 class="card-title">
                                {{arrayDatosPersonal.gra_abreviatura}} {{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}  {{arrayDatosPersonal.per_nombre}}
                                </h3> -->
                                <h4>{{datos.grado}} {{datos.complemento}} {{datos.paterno}} {{datos.materno}} {{datos.nombre}}</h4>
                                <router-link type="button" class="btn btn-danger btn-sm position-reverse float-sm-right" :to="'/DatosPersonal'" style="margin-top:-37px">
                                    <i class="fas fa-reply"></i>&nbsp; Volver Atrás
                                </router-link>
                                
                            </div>
                            <div class="card-body">
                                <!--DATOS PERSONALES--> 
                                <div class="form-group row border justify-content-center" style="border-color: #007bff !important;">

                                    <div class="col-md-12" v-if="proflibreg2==1" style="font-size: 14px;">
                                            <div class="card-body">
                                                
                                                <ul class="nav nav-tabs" id="tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="home" aria-selected="false">Datos Personales</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="destact-tab" data-toggle="pill" href="#destact" role="tab" aria-controls="destact" aria-selected="true">Destino Actual</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Datos Físicos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="messages-tab" data-toggle="pill" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Datos Familiares</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Situación Personal</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="esca-tab" data-toggle="pill" href="#esca" role="tab" aria-controls="esca" aria-selected="false">Escalafón</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="espe-tab" data-toggle="pill" href="#espe" role="tab" aria-controls="espe" aria-selected="false">Especialidad</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="proflib-tab" data-toggle="pill" href="#proflib" role="tab" aria-controls="proflib" aria-selected="false">Profesión Libre</a>
                                                </li>
                                                </ul>
                                                <div class="tab-content" id="tabContent">
                                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab"><!-- DATOS PERSONALES -->  

                                                    <div class="callout callout-success">  
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                        <figure>
                                                            <template v-if="v == 0 ">
                                                                <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                            </template>
                                                            <template v-else>
                                                                    
                                                                <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                            </template>
                                                        </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                        <div class="card-body">
                                                            <div class="row"><!-- 1ra fila -->
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Grado</label><br>
                                                                <p style="font-style: italic; margin-top:-10px;">{{datos.grado}} {{datos.complemento}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Apellido Paterno</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{datos.paterno}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Apellido Materno</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{datos.materno}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Nombre(s)</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{datos.nombre}}</p>
                                                            </div>
                                                            </div>
                                                            
                                                            <div class="row tab-custom-content"><!-- 2da fila -->
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Carnet Militar</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.cm }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Carnet Identidad</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.ci }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Expedido</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.expedido }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Matrícula de Seguro </label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.seguro }}</p>
                                                            </div>
                                                            </div>

                                                            <div class="row tab-custom-content"><!-- 3ra fila -->
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Fecha de Nacimiento</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.fechaNacimiento}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Número de Telefono</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.telefono}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Número de Celular</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.celular}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label style="font-weight: bold;">Correo Institucional</label>
                                                                <p style="font-style: italic; margin-top:-10px;">{{ datos.email}}</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="row tab-custom-content" style="margin-top:-10px"><!-- 4ta fila -->
                                                        <div class="col-md-2">
                                                        <label style="font-weight: bold;">N° de Libreta Militar</label>
                                                        <p style="font-style: italic; margin-top:-10px;">{{ datos.servMil }}</p>
                                                        </div>
                                                        <div class="col-md-10">
                                                        <div class="row card-body" style="padding-top:0px; padding-bottom:0px;">
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Sexo</label><br>
                                                            <p style="font-style: italic; margin-top:-10px;">{{ datos.genero }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Estado Civil</label>
                                                            <p style="font-style: italic; margin-top:-10px;">{{ datos.estadoCivil }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Código Boleta de Pago</label>
                                                            <p style="font-style: italic; margin-top:-10px;">{{ datos.per_boleta_pago}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Religión</label>
                                                            <p style="font-style: italic; margin-top:-10px;">{{ datos.religion}}</p>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="row tab-custom-content"><!-- 5ta fila -->
                                                        <div class="col-md-2">
                                                        <label style="font-weight: bold;">Departamento</label>
                                                        <p style="font-style: italic; margin-top:-10px;" v-text="nombredpto"></p>
                                                        </div>
                                                        <div class="col-md-10">
                                                        <div class="row card-body" style="padding-top:0px; padding-bottom:0px;">
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Provincia</label><br>
                                                            <p style="font-style: italic; margin-top:-10px;" v-text="nombreprov"></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Localidad</label>
                                                            <p style="font-style: italic; margin-top:-10px;" v-text="nombreloca"></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;"></label>
                                                            <p style="font-style: italic; margin-top:-10px;"></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;"></label>
                                                            <p style="font-style: italic; margin-top:-10px;"></p>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="row tab-custom-content border border-dark"><!-- 6ta fila -->
                                                        <div class="col-md-12">                                       
                                                            <label>DOMICILIO ACTUAL</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                        <label style="font-weight: bold;">Ciudad</label>
                                                        <p style="font-style: italic; margin-top:-10px;">{{ datos.per_ciudad}}</p>
                                                        </div>
                                                        <div class="col-md-10">
                                                        <div class="row card-body" style="padding-top:0px; padding-bottom:0px;">
                                                            <div class="col-md-3">
                                                            <label style="font-weight: bold;">Zona/Barrio</label><br>
                                                            <p style="font-style: italic; margin-top:-10px;">{{ datos.per_zona}}</p>
                                                            </div>
                                                            <div class="col-md-9">
                                                            <label style="font-weight: bold;">Avenida/Calle/Nro.</label>
                                                            <p style="font-style: italic; margin-top:-10px;">{{ datos.per_calle}}</p>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        
                                                        <!-- <p class="card-text"><small class="text-muted" >Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->

                                                    </div>
                                                    <div v-if="$auth.can('edit-per')" class="col-sm-12">
                                                       
                                                            <button type="button" class="btn btn-warning btn-sm position-reverse float-sm-right" @click="EnvioDatos(datos.codigo)">
                                                                <i class="fas fa-edit"></i> Editar Datos Personales
                                                            </button>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="destact" role="tabpanel" aria-labelledby="destact"><!-- DESTINO ACTUAL -->   
                                                    
                                                    <div class="callout callout-success"> 
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                            <figure>
                                                                <template v-if="v == 0 ">
                                                                    <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                                </template>
                                                                <template v-else>
                                                                        
                                                                    <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                                </template>
                                                            </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <!-- <template v-if="arrayPersonalDestinos.length > 0"> -->
                                                                <div class="card-body">
                                                                    <div class="row"><!-- 1ra fila -->
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Organismo</label><br>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos.desc_dn1}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Gran Unidad</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos.desc_dn2}}</p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row tab-custom-content"><!-- 2da fila -->
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Repartición</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos.desc_dn3}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Sub Repartición</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos.desc_dn4}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row tab-custom-content"><!-- 3ra fila -->
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Cargo 1</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos.cargo}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Cargo 2</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos2.cargo2}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row tab-custom-content"><!-- 4ta fila -->
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Tipo de Documento</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{arrayPersonalDestinos.tipo_doc}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Fecha de Documento</label>
                                                                            <p style="font-style: italic; margin-top:-10px;">{{since(arrayPersonalDestinos.fechadestino)}}</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            <!-- </template>
                                                            <template v-else>
                                                                <div class="callout callout-info">
                                                                    <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON DATOS EN DESTINO</center></h6>
                                                                </div>
                                                            </template> -->
                                                        </div>
                                                    </div>

                                                   
                                                        
                                                    <!-- <p class="card-text"><small class="text-muted">Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><!-- DATOS FISICOS -->   
                                                    
                                                    <div class="callout callout-success"> 
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                            <figure>
                                                                <template v-if="v == 0 ">
                                                                    <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                                </template>
                                                                <template v-else>
                                                                        
                                                                    <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                                </template>
                                                            </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <template v-if="arrayDatosFisicos.length > 0">
                                                                <div class="card-body">
                                                                    <div class="row"><!-- 1ra fila -->
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Color de la piel</label><br>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_piel"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Grupo Sanguíneo</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_gs"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Color de Ojos</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_ojos"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Color de Cabellos</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_cabello"></p>
                                                                    </div>
                                                                    </div>
                                                                    
                                                                    <div class="row tab-custom-content"><!-- 2da fila -->
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Boca</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_boca"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Labios</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_labios"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Nariz</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_nariz"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Estatura</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_estatura+' Mts.'"></p>
                                                                    </div>
                                                                    </div>

                                                                    <div class="row tab-custom-content"><!-- 3ra fila -->
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Peso</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_peso+' Kgs.'"> Kgs.</p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Contextura Física</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_contextura"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Enfermedad</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_enfermedad"></p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label style="font-weight: bold;">Alergias</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="datfis_alergias"></p>
                                                                    </div>
                                                                    </div>

                                                                    <div class="row tab-custom-content"><!-- 4ta fila -->
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Señas Particulares</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="datfis_senaspart"></p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label style="font-weight: bold;">Observaciones</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="datfis_observacion"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                            <template v-else>
                                                                <div class="callout callout-info">
                                                                    <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON DATOS FÍSICOS REGISTRADOS</center></h6>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>

                                                   
                                                        
                                                    <!-- <p class="card-text"><small class="text-muted">Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab"><!-- DATOS FAMILIARES -->
                                                    <div class="callout callout-success">
                                                        <div class="row">
                                                            <div class="col-md-2">

                                                            <figure>
                                                                <template v-if="v == 0 ">
                                                                    <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                                </template>
                                                                <template v-else>
                                                                        
                                                                    <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                                </template>

                                                            </figure>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <template v-if="arrayDatos_familiares.length > 0">
                                                                    <table class="table table-bordered table-striped table-sm tables">
                                                                        <thead >
                                                                            <tr>
                                                                                <th class="text-center">PARENTESCO</th>
                                                                                <th class="text-center">APELLIDO PATERNO</th>
                                                                                <th class="text-center">APELLIDO MATERNO</th>
                                                                                <th class="text-center">NOMBRE</th>
                                                                                <th class="text-center">C. IDENTIDAD</th>
                                                                                <th class="text-center">SEXO</th>
                                                                                <th class="text-center">FECHA NACIMIENTO</th>
                                                                                <th class="text-center">CELULAR</th>
                                                                                <th class="text-center">PROFESIÓN</th>
                                                                                <th class="text-center">OBSERVACIONES</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="datos_familiares in arrayDatos_familiares" :key="datos_familiares.id">
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
                                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab"><!-- SITUACION PERSONAL -->  

                                                    <div class="callout callout-success">  
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                        <figure>
                                                            <template v-if="v == 0 ">
                                                                <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                            </template>
                                                            <template v-else>
                                                                    
                                                                <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                            </template>

                                                        </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <template v-if="arraySituacion.length > 0">
                                                                <div class="card-body">
                                                                    <div class="row"><!-- 1ra fila -->
                                                                        <div class="col-md-4">
                                                                            <label style="font-weight: bold;">Situación</label><br>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="nombsit"></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label style="font-weight: bold;">Sub Situación</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="nombsub"></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label style="font-weight: bold;">Detalle Situación</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="nombdet"></p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row tab-custom-content"><!-- 2da fila -->
                                                                        <div class="col-md-4">
                                                                            <label style="font-weight: bold;">Documento</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="documento"></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label style="font-weight: bold;">Fecha</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="since(fechdoc)"></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label style="font-weight: bold;">Número de Documento</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="nrodoc2"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row tab-custom-content"><!-- 3ra fila -->
                                                                        <div class="col-md-10">
                                                                            <label style="font-weight: bold;">Observaciones</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="observacionsit"></p>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                </div>
                                                            </template>
                                                            <template v-else>
                                                                <div class="callout callout-info">
                                                                    <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON REGISTROS EN SITUACION PERSONAL</center></h6>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>

                                                    
                                                        
                                                        <!-- <p class="card-text"><small class="text-muted">Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="esca" role="tabpanel" aria-labelledby="esca-tab"><!-- ESCALAFON -->  

                                                    <div class="callout callout-success">  
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                        <figure>
                                                            <template v-if="v == 0 ">
                                                                <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                            </template>
                                                            <template v-else>
                                                                    
                                                                <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                            </template>

                                                        </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <template v-if="arrayListaEscalafon.length > 0">
                                                                <div class="card-body">
                                                                    <div class="row"><!-- 1ra fila -->
                                                                    <div class="col-md-4">
                                                                        <label style="font-weight: bold;">Grado</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="grados"></p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label style="font-weight: bold;">Escalafón</label><br>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="escalafon_nombre"></p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label style="font-weight: bold;">Sub Escalafón</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="subesc_nombre"></p>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                    
                                                                    <div class="row tab-custom-content"><!-- 2da fila -->
                                                                    <div class="col-md-4">
                                                                        <label style="font-weight: bold;">Documento</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="documento"></p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label style="font-weight: bold;">Número de Documento</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="nro_doc"></p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label style="font-weight: bold;">Fecha de documento</label>
                                                                        <p style="font-style: italic; margin-top:-10px;" v-text="since(fecha_doc)"></p>
                                                                    </div>
                                                                    </div>

                                                                    <div class="row tab-custom-content"><!-- 3ra fila -->
                                                                        <div class="col-md-10">
                                                                            <label style="font-weight: bold;">Observaciones</label>
                                                                            <p style="font-style: italic; margin-top:-10px;" v-text="observacionesc"></p>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                </div>
                                                            </template>
                                                            <template v-else>
                                                                <div class="callout callout-info">
                                                                    <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON REGISTROS EN ESCALAFÓN</center></h6>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>

                                                    
                                                        
                                                        <!-- <p class="card-text"><small class="text-muted">Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="espe" role="tabpanel" aria-labelledby="espe-tab"><!-- ESPECIALIDAD -->   
                                                    
                                                    <div class="callout callout-success"> 
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                        <figure>
                                                            <template v-if="v == 0 ">
                                                                <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                            </template>
                                                            <template v-else>
                                                                    
                                                                <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                            </template>

                                                        </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                        <div class="card-body">
                                                            <div class="row"><!-- 1ra fila -->
                                                                <div class="col-md-6">
                                                                    <label style="font-weight: bold;">Especialidad</label><br>
                                                                    <p style="font-style: italic; margin-top:-10px;" v-text="nombespe"></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="font-weight: bold;">Sub especialidad</label>
                                                                    <p style="font-style: italic; margin-top:-10px;" v-text="nomsubespe"></p>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row tab-custom-content"><!-- 2da fila -->
                                                                <div class="col-md-6">
                                                                    <label style="font-weight: bold;">Documento</label>
                                                                    <p style="font-style: italic; margin-top:-10px;" v-text="documento"></p> 
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="font-weight: bold;">Fecha de documento</label>
                                                                    <p style="font-style: italic; margin-top:-10px;" v-text="fecha_documento"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row tab-custom-content"><!-- 2da fila -->
                                                                <div class="col-md-6">
                                                                    <label style="font-weight: bold;">Número de Documento</label>
                                                                    <p style="font-style: italic; margin-top:-10px;" v-text="nrodoc3"></p>
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                        </div>
                                                    </div>

                                                    
                                                        
                                                        <!-- <p class="card-text"><small class="text-muted">Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="proflib" role="tabpanel" aria-labelledby="proflib-tab"><!-- PROFESION LIBRE -->   
                                                    
                                                    <div class="callout callout-success"> 
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                        <figure>
                                                            <template v-if="v == 0 ">
                                                                <img class="rounded float-left img-fluid" width="150" height="150" :src="'/img/personal/'+imagen" alt="Fotografia">
                                                            </template>
                                                            <template v-else>
                                                                    
                                                                <!-- <img class="rounded float-left img-fluid" width="200" height="200" src="../../../public/picture/avatar.jpg" alt="..."> -->
                                                            </template>

                                                        </figure>
                                                        </div>
                                                        <div class="col-md-10">
                                                        
                                                            <template v-if="arrayPersonalProfesiones.length > 0">
                                                                <table class="table table-bordered table-striped table-sm tables">
                                                                    <thead >
                                                                        <tr>
                                                                            <th class="text-center">Grado Académico</th>
                                                                            <th class="text-center">Carrera</th>
                                                                            <th class="text-center">Unidad Academica</th>
                                                                            <th class="text-center">Fecha de Egreso</th>
                                                                            <th style="width: 400px;" class="text-center">Descripción</th>
                                                                            <th style="width: 400px;" class="text-center">Observaciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="per_prof in arrayPersonalProfesiones" :key="per_prof.id">
                                                                            <td v-text="per_prof.descripcion_carrera" ></td>
                                                                            <td v-text="per_prof.niv_especialidad"></td>
                                                                            <td v-text="per_prof.lugar_estudio"></td>
                                                                            <td v-text="since(per_prof.fecha_egreso)"></td>
                                                                            <td v-text="per_prof.descripcion"></td>
                                                                            <td v-text="per_prof.observacion"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </template>
                                                            <template v-else>
                                                                <div class="callout callout-info">
                                                                    <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON REGISTROS EN PROFESIÓN LIBRE</center></h6>
                                                                </div>
                                                            </template>
                                                            
                                                        
                                                        </div>
                                                    </div>

                                                    
                                                        
                                                        <!-- <p class="card-text"><small class="text-muted">Ultima Actualizacion: 20/05/21</small></p> -->
                                                    <!-- /.card-body -->
                                                    </div>

                                                </div>
                                                </div>
                                                
                                                
                                                
                                            </div>
                                    </div>

  


                                </div>
                                <!--FIN DATOS PERSONALES-->
                                
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
            v : 0,

            datos: [], //Datos Personales
            arrayDatos_familiares : [],
            departamento : [],
            nombredpto: '',
            provincia : [],
            nombreprov: '',
            localidad : [],
            nombreloca: '',

            arrayPersonalDestinos : [],
            arrayPersonalDestinos2 : [],

            cargo1 : [],
            cargo2 : [],

            //epecialidadpersonal
            arrayDatosEspePer:[],
            nombespe: '',
            nomsubespe: '',
            fecha_documento: '',
            nrodoc: '',
            nrodoc3 : '',
            documento: '',

            arrayListaEscalafon : [],
            escalafon_nombre : '',
            subesc_nombre : '',
            grado : '',
            grados : '',
            documento : '',
            fecha_doc : '',
            nro_doc : '',
            arraySituacion : [],
            nombsit:'',
            nombsub:'',
            nombdet: '',
            observacionsit : '',
            documento:'',
            fechdoc:'',
            nrodoc:'',

            arrayPersonalProfesiones : [],
            arrayNivel_profesional : [],
            arrayCarrera : [],

            errorPersonal_profesion : 0,
            errorMostrarMsjPersonal_profesion : [],


            arrayfamLocalidad : [],
            arrayfamDepartamento : [],
            arrayfamProvincia : [],
            //* DATOS FISICOS */
            arrayDatosFisicos :[],
            datfis_percodigo: 0,
            datfis_piel:'',
            datfis_gs:'',
            datfis_ojos:'',
            datfis_cabello:'',
            datfis_boca:'',
            datfis_labios:'',
            datfis_nariz:'',
            datfis_senaspart:'',
            datfis_estatura:0,
            datfis_peso:0,
            datfis_enfermedad:'',
            datfis_alergias:'',
            datfis_contextura:'',
            datfis_observacion:'',
            

            depa_codigo:0,


            /* DATOS FAMILIARES */
            datfam_id : 0,
            per_cm : '', 
            
            datfamreg : 1,
            datfamreg2 : 1,
            ido : 0,
            percodo : 0,
            cod_proflibreo : 0,
            nivprof_codigo : 0,
            car_codigo : 0,
            descripcion : '',
            lugar_estudioo : '',
            fecha_egresoo : '',
            estadoo : '',
            observacion : '',
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
            observacion : '',
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
        
        this.listarPersonalProfesion(this.per_codigo);
        this.datosPersonal(this.per_codigo);
        this.verDatos(this.per_codigo);
        this.listarDatosFisicos(this.per_codigo);
        this.listarDatosFamiliares(this.per_codigo);
        this.listarEscalafonPersonal(this.per_codigo);
        this.listarSituacion(this.per_codigo);
        this.listarPersonalEspecialidad(this.per_codigo);
        this.listarPersonalDestinos(this.per_codigo);
        
    },
    methods: {
        since: function (d){
            return moment(d).format('DD-MM-YYYY');
        },

        onChangeSelect(e) {      
            this.inputDisabled = (e.target.value != 'MILITAR')
            this.datfam_profmil = 0
        },

        listarPersonalProfesion(per_codigo){
            let me = this;
            axios
            .post("/listarPersonalProfesion", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
                var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayPersonalProfesiones = respuesta.per_prof.data;
            //me.selectCarrera();
            //me.selectNivel_profesional();

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        verDatos(per_codigo){
          let me = this;
            axios
            .post("/verDatosPersonales", {
              per_codigo: per_codigo
            })
            .then(function (response) {
              
                me.datos = response.data.datos
                //me.depa_codigo = me.datos[0]['depa_codigo'];
                me.depa_codigo = response.data.datos.depa_codigo;
                me.prov_codigo = response.data.datos.prov_codigo;
                me.loca_codigo = response.data.datos.loca_codigo;
                
                //console.log(me.depa_codigo);
                me.BuscarDepartamento(me.depa_codigo);
                me.BuscarProvincia(me.prov_codigo);
                me.BuscarLocalidad(me.loca_codigo);
            })    
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        },

        listarPersonalDestinos(per_codigo,page){
            let me = this;
            axios
          .post("/listarPersonalDestAct", {
            per_codigo : per_codigo,
            page:page
            
          })
          .then(function (response) {
            
           me.arrayPersonalDestinos = response.data.cargo1
           me.arrayPersonalDestinos2 = response.data.cargo2
           me.pagination = response.data.pagination
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

        listarDatosFamiliares(per_codigo){
            let me = this;
            axios
            .post("/listarDatosFamiliares", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
            var respuesta = response.data;

            me.arrayDatos_familiares = respuesta.datos_familiares;
            //me.selectfamDepartamento();

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        listarEscalafonPersonal(per_codigo){
            let me = this;
            axios.post("/listarEscalafon", {
            per_codigo : per_codigo,
            }).then(function (response) {
            me.arrayListaEscalafon = response.data;
            me.escalafon_nombre = me.arrayListaEscalafon[0]['escalafon_nombre'];
            me.subesc_nombre = me.arrayListaEscalafon[0]['subesc_nombre'];
            me.grados = me.arrayListaEscalafon[0]['grados'];
            me.documento = me.arrayListaEscalafon[0]['documento'];
            me.fecha_doc = me.arrayListaEscalafon[0]['fecha_doc'];
            me.nro_doc = me.arrayListaEscalafon[0]['nro_doc'];
            me.observacionesc = me.arrayListaEscalafon[0]['observacion'];

            }).catch(function (error) {
            // handle error
                console.log(error);
            })
        }, 

        listarSituacion(percodigo){
            let me = this;
            //console.log(me.percod);
            axios.post("/listarSituacion", {
                percodigo: me.per_codigo,
            })
            .then(function (response) {
                //
                if (response.data.code == "200") {
                    //me.situacion = response.data.datos.data;
                    me.arraySituacion = response.data.datos.data;
                    me.nombsit = me.arraySituacion[0]['nombsit'];
                    me.nombsub = me.arraySituacion[0]['nombsub'];
                    me.documento = me.arraySituacion[0]['documento'];
                    me.fechdoc = me.arraySituacion[0]['fechdoc'];
                    me.nrodoc2 = me.arraySituacion[0]['nrodoc'];
                    me.nombdet = me.arraySituacion[0]['nombdet'];
                    me.observacionsit = me.arraySituacion[0]['observacion'];

                } else {
                    me.situacion = [];
                }

                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        BuscarDepartamento(depa_codigo){
          let me = this;
          //console.log(me.depa_codigo);
            axios
            .post("/departamento/selectbuscarDepartamento", {
              buscar: depa_codigo
            })
            .then(function (response) {
              
                me.departamento = response.data.departamento
                me.nombredpto = me.departamento[0]['nombre'];
            })    
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        },

        BuscarProvincia(prov_codigo){
          let me = this;
          //console.log(me.depa_codigo);
            axios
            .post("/provincia/selectbuscarProv", {
              buscar: prov_codigo
            })
            .then(function (response) {
              
                me.provincia = response.data.provincia
                me.nombreprov = me.provincia[0]['nombre'];
            })    
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        },

        BuscarLocalidad(loca_codigo){
          let me = this;
          //console.log(me.depa_codigo);
            axios
            .post("/localidad/selectbuscarLoca", {
              buscar: loca_codigo
            })
            .then(function (response) {
              
                me.localidad = response.data.localidad
                me.nombreloca = me.localidad[0]['nombre'];
            })    
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        },

        listarPersonalEspecialidad(per_codigo){
            let me = this;
            axios
            .post("/selectBuscaEspePer", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
            var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayDatosEspePer = respuesta.listarEspecialidadPersonal;
                // if (me.arrayDatosFisicos.length > 0) {
                //     me.datfisreg = 2;
                 me.nombespe = me.arrayDatosEspePer[0]['nombespe'];
                 me.nomsubespe = me.arrayDatosEspePer[0]['nomsubespe'];
                 me.documento = me.arrayDatosEspePer[0]['documento'];
                 me.fecha_documento = me.arrayDatosEspePer[0]['fecha_documento'];
                 me.nrodoc3 = me.arrayDatosEspePer[0]['nrodoc'];
                // me.datfis_piel = me.arrayDatosFisicos[0]['piel'];
                // me.datfis_gs = me.arrayDatosFisicos[0]['gs'];
                // me.datfis_ojos = me.arrayDatosFisicos[0]['ojos'];
                // me.datfis_cabello = me.arrayDatosFisicos[0]['cabello'];
                // me.datfis_boca = me.arrayDatosFisicos[0]['boca'];
                // me.datfis_labios = me.arrayDatosFisicos[0]['labios'];
                // me.datfis_nariz = me.arrayDatosFisicos[0]['nariz'];
                // me.datfis_senaspart = me.arrayDatosFisicos[0]['senaspart'];
                // me.datfis_estatura = me.arrayDatosFisicos[0]['estatura'];
                // me.datfis_peso = me.arrayDatosFisicos[0]['peso'];
                // me.datfis_enfermedad = me.arrayDatosFisicos[0]['enfermedad'];
                // me.datfis_alergias = me.arrayDatosFisicos[0]['alergias'];
                // me.datfis_contextura = me.arrayDatosFisicos[0]['contexturas'];
                // me.datfis_estado = me.arrayDatosFisicos[0]['estado'];
                // me.datfis_observacion = me.arrayDatosFisicos[0]['observacion'];
                // }else{me.datfisreg = 1;}

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        EnvioDatos(dato){
            this.$router.push({
            name: "EditarPersonal",
            //ENVIO DE DATOS POR URL
            params:{
            codigo: dato
            }
            });
        },



        changeItem5: function changeItem5(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarNivel_profesional(event.target.value);
        },

        listarDatosFisicos(per_codigo){
            let me = this;
            axios
            .post("/listarDatosFisicos", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
            var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayDatosFisicos = respuesta.datos_fisicos;
                if (me.arrayDatosFisicos.length > 0) {
                    me.datfisreg = 2;
                me.datfis_id = me.arrayDatosFisicos[0]['id'];
                me.datfis_percodigo = me.arrayDatosFisicos[0]['per_codigo'];
                me.datfis_piel = me.arrayDatosFisicos[0]['piel'];
                me.datfis_gs = me.arrayDatosFisicos[0]['gs'];
                me.datfis_ojos = me.arrayDatosFisicos[0]['ojos'];
                me.datfis_cabello = me.arrayDatosFisicos[0]['cabello'];
                me.datfis_boca = me.arrayDatosFisicos[0]['boca'];
                me.datfis_labios = me.arrayDatosFisicos[0]['labios'];
                me.datfis_nariz = me.arrayDatosFisicos[0]['nariz'];
                me.datfis_senaspart = me.arrayDatosFisicos[0]['senaspart'];
                me.datfis_estatura = me.arrayDatosFisicos[0]['estatura'];
                me.datfis_peso = me.arrayDatosFisicos[0]['peso'];
                me.datfis_enfermedad = me.arrayDatosFisicos[0]['enfermedad'];
                me.datfis_alergias = me.arrayDatosFisicos[0]['alergias'];
                me.datfis_contextura = me.arrayDatosFisicos[0]['contexturas'];
                me.datfis_estado = me.arrayDatosFisicos[0]['estado'];
                me.datfis_observacion = me.arrayDatosFisicos[0]['observacion'];
                }else{me.datfisreg = 1;}

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        listarDatosFisicos(per_codigo){
            let me = this;
            axios
            .post("/listarDatosFisicos", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
            var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayDatosFisicos = respuesta.datos_fisicos;
                if (me.arrayDatosFisicos.length > 0) {
                    me.datfisreg = 2;
                me.datfis_id = me.arrayDatosFisicos[0]['id'];
                me.datfis_percodigo = me.arrayDatosFisicos[0]['per_codigo'];
                me.datfis_piel = me.arrayDatosFisicos[0]['piel'];
                me.datfis_gs = me.arrayDatosFisicos[0]['gs'];
                me.datfis_ojos = me.arrayDatosFisicos[0]['ojos'];
                me.datfis_cabello = me.arrayDatosFisicos[0]['cabello'];
                me.datfis_boca = me.arrayDatosFisicos[0]['boca'];
                me.datfis_labios = me.arrayDatosFisicos[0]['labios'];
                me.datfis_nariz = me.arrayDatosFisicos[0]['nariz'];
                me.datfis_senaspart = me.arrayDatosFisicos[0]['senaspart'];
                me.datfis_estatura = me.arrayDatosFisicos[0]['estatura'];
                me.datfis_peso = me.arrayDatosFisicos[0]['peso'];
                me.datfis_enfermedad = me.arrayDatosFisicos[0]['enfermedad'];
                me.datfis_alergias = me.arrayDatosFisicos[0]['alergias'];
                me.datfis_contextura = me.arrayDatosFisicos[0]['contexturas'];
                me.datfis_estado = me.arrayDatosFisicos[0]['estado'];
                me.datfis_observacion = me.arrayDatosFisicos[0]['observacion'];
                }else{me.datfisreg = 1;}

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },


    },
    computed:{
      imagen(){
                // return "/picture/" + personal.foto;
                return this.datos.per_foto;
            },

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