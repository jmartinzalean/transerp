<template>
    <v-card>
        <v-row class="pd-30">
            <v-col
                :lg="6"
                :md="6"
                :sm="12"
            >
                <v-select
                        v-model="project"
                        :items="projects"
                        item-text="name"
                        item-value="id"
                        label="Proyectos"
                ></v-select>
            </v-col>
            <v-col
                    :lg="6"
                    :md="6"
                    :sm="12"
            >
                <v-select
                        v-model="service"
                        :items="services"
                        item-text="name"
                        item-value="id"
                        label="Servicios"
                        :disabled="servicedisabled"
                ></v-select>
            </v-col>
            <v-col
                    :lg="6"
                    :md="6"
                    :sm="12"
            >
                <v-select
                        v-model="application"
                        :items="applications"
                        item-text="name"
                        item-value="id"
                        label="Aplicaciones"
                        :disabled="applicationdisabled"
                ></v-select>
            </v-col>
            <v-col
                    :lg="6"
                    :md="6"
                    :sm="12"
            >
                <v-select
                        v-model="repositorytype"
                        :items="repositorytypes"
                        item-text="name"
                        item-value="id"
                        label="Tipos de Repositorios"
                ></v-select>
            </v-col>
            <v-col
                    :lg="12"
                    :md="12"
                    :sm="12"
            >
                <v-btn small color="primary" v-on:click="searchEvent()">Filtrar</v-btn>
                <v-btn small color="secondary" v-on:click="cleanFilters()">Limpiar</v-btn>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>

    import Axios from 'axios';

    export default {
        name: "FilterRepositories",
        data() {
            return {
                projects: [{}],
                services: [{}],
                applications: [{}],
                repositorytypes: [{}],
                project : 0,
                service : 0,
                application : 0,
                repositorytype : 0,
                servicedisabled : true,
                applicationdisabled : true
            }
        },
        created() {
            this.getProjects();
            this.getRepositoryTypes();
        },
        methods: {

            getProjects() {
                Axios.get('api/project/options',
                ).then(response => {
                    this.$set(this, 'projects', response.data.data );
                }).catch(e => {
                    console.log(e);
                });
            },
            getServices(projectid) {
                Axios.get('api/service/options/'+projectid,
                ).then(response => {
                    this.$set(this, 'services', response.data.data );
                }).catch(e => {
                    console.log(e);
                });
            },
            getApplications(serviceid) {
                Axios.get('api/application/options/'+serviceid,
                ).then(response => {
                    this.$set(this, 'applications', response.data.data );
                }).catch(e => {
                    console.log(e);
                });
            },
            getRepositoryTypes() {
                Axios.get('api/repositorytypes',
                ).then(response => {
                    this.$set(this, 'repositorytypes', response.data.repositorytypes );
                }).catch(e => {
                    console.log(e);
                });
            },
            searchEvent() {
                this.$emit('filterSearchEvent',
                        {
                            project: this.project,
                            service: this.service,
                            application: this.application,
                            repositorytype: this.repositorytype
                        }
                    )
            },
            cleanFilters() {
                this.$set(this, 'project', 0 );
                this.$set(this, 'servicedisabled', false );
                this.$set(this, 'service', 0 );
                this.$set(this, 'applicationdisabled', false );
                this.$set(this, 'application', 0 );
                this.$set(this, 'repositorytype', 0 );
                this.searchEvent();
            }


        },
        watch: {
            project: function (newVal) {
                if(newVal !== 0){
                    this.getServices(newVal);
                    this.$set(this, 'service', 0 );
                    this.$set(this, 'servicedisabled', false );
                    this.$set(this, 'application', 0 );
                    this.$set(this, 'applicationdisabled', true );
                }
            },
            service: function (newVal) {
                if(newVal !== 0){
                    this.getApplications(newVal);
                    this.$set(this, 'applicationdisabled', false );
                }
            },
        },
    }
</script>