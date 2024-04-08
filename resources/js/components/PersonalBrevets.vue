<template>
    <main>
        <section class="content-header">
            <h1><i class="far fa-id-card"></i> PERSONAL BREVETACIONES
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="col-md-12">
                                    <div v-if="$auth.can('report-rangfechperbrev')" class="form-group row">
                                        <label style="font: 15px bold; margin-top: 9px;"><strong>De</strong></label>&nbsp;
                                        <input type="date" format='DD-MM-YYYY' v-model="fecha_inicio" class="form-control col-sm-2">&nbsp;
                                        <label style="font: 15px bold; margin-top: 9px;"><strong>Hasta</strong></label>&nbsp;
                                        <input type="date" format='DD-MM-YYYY' v-model="fecha_fin" class="form-control col-sm-2">&nbsp;
                                        <button class="btn btn-sm btn-secondary" type="button" @click.prevent="generarPDF(fecha_inicio,fecha_fin)"><i class="far fa-file-pdf"></i> Reporte Rango Fechas</button>&nbsp; &nbsp; &nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="criterio">
                                            <option value="p.per_nombre">Nombre</option>
                                            <option value="p.per_paterno">Ap. Paterno</option>
                                            <option value="p.per_materno">Ap. Materno</option>
                                            <option value="p.per_cm">Carnet Militar</option>
                                            <option value="p.per_ci">C. de Identidad</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" @keyup="BuscarPersona()" v-model="buscar" style="text-transform:uppercase">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <button type="button" @click="listarPersonal(1,buscar,criterio)" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                    </div> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Grado</th>
                                                <th class="text-center">Ap. Paterno</th>
                                                <th class="text-center">Ap. Materno</th>
                                                <th class="text-center">Nombres</th>
                                                <th class="text-center">C. Identidad</th>
                                                <th class="text-center">C. Militar</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="p in listaPersonal">
                                                <td>{{p.grado}} {{p.complemento}}</td>
                                                <td> {{p.paterno}} </td>
                                                <td> {{p.materno}}</td>
                                                <td> {{p.nombre}} </td>
                                                <td class="text-center">{{p.ci}}</td>
                                                <td class="text-center">{{p.cm}}</td>
                                                <td style="width:100px" class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm" title="Ver Brevets"
                                                        @click="EnvioVerBrevets(p.per_codigo, p.subescalafon)">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button> &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="pagination.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.first_page + 1,buscar,criterio)">&laquo;</a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.last_page,buscar,criterio)">&raquo;</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
export default {
    data() {
        return {
            personal: [],
            valor: "",
            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
            offset  : 3,
            listaPersonal: [],
            criterio: "p.per_cm",
            buscar:"",
            setTiemoutBuscador: '',
            id: "",
            fecha_inicio: "",
            fecha_fin: "",
        }
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }
            var from = this.pagination.current_page - this.offset;
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
        }
    },
    mounted() {
        this.ListarPersonal(1);
    },
    methods: {
        since: function (d){
            return moment(d).format('DD-MM-YY');
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.ListarPersonal(page);
        },
        ListarPersonal(page){
            let me = this;
            axios.post("/listadorPersonal", {
                page: page,
                buscar: me.buscar.toUpperCase(),
                criterio: me.criterio,
            })
            .then(function (response) {
                me.listaPersonal = response.data.personal.data;
                me.pagination =response.data.pagination
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        BuscarPersona(){
            clearTimeout(this.setTiemoutBuscador);
            this.setTiemoutBuscador = setTimeout(() => {
                this.ListarPersonal(1)
            }, 360)
        },
        EnvioVerBrevets(per_codigo,subescalafon){
            this.$router.push({
                name: "PersonalBrevetsVer",
                params:{
                    id: per_codigo,
                    s: subescalafon
                }
            })
        },
        generarPDF(fecha_inicio,fecha_fin){
            window.open('http://sipefab.fab.bo/reporte/generarRangofechas?inicio='+ fecha_inicio + '&fin=' + fecha_fin, '_blank');
        }
    },
}
</script>
<style>
</style>
