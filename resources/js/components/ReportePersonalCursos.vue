<template>
    <main>
        <section class="content-header">
            <h1><i class="fas fa-user-graduate"></i> Reportes Personal Cursos</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" v-model="criterio">
                                            <option value="tc.idtipocurso" disabled>SELECCIONE</option>
                                            <option value="19">DIPLOMADO EN SUPERVISIÓN SOF. Y SGTOS.</option>
                                            <option value="20">DIPLOMADO EN PERFECCIONAMIENTO SOF. Y SGTOS.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-sm btn-secondary" type="button" @click.prevent="generarReportes(criterio)"><i class="far fa-file-pdf"></i> Generar Reporte</button>&nbsp; &nbsp; &nbsp;
                                    </div>
                                    <div class="col-md-3">
                                        <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/PersonalCursos/'">
                                            <i class="fas fa-reply"></i> Volver Atrás
                                        </router-link>
                                    </div>
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
            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
            offset  : 3,
            criterio: "tc.idtipocurso",
        }
    },
    methods: {
        generarReportes($criterio){
            if($criterio == 'tc.idtipocurso'){
                Swal.fire({
                    icon: 'error',
                    title: 'Debe seleccionar un Diplomado para Generar Reporte',
                    showConfirmButton: false,
                    timer: 2500
                })
            }else{
                window.open('reporte/dipsupsgtos/'+ $criterio,'_blank');
            }
        }
    }
}
</script>

<style>

</style>
