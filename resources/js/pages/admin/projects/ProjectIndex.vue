<template>
    <v-card>
        <v-card-title>
            <v-btn
                    :icon="true"
                    @click="showNewModal"
                    class="secondary"
            >
                <v-icon color="white">group_add</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Búsqueda"
                    single-line
                    hide-details
            ></v-text-field>
        </v-card-title>
        <v-divider></v-divider>
        <v-data-table
                :headers="tablecolums"
                :items="tablerows"
                :search="search"
                class="pd-30 c-pointer"
                @click:row="showModal"
        >
            <template v-slot:item.servicescount="{ item }">
                <v-chip class="teal accent-1 c-pointer">
                    <router-link :to="/services/+item.id">
                        {{ item.servicescount }} Servicios
                    </router-link>
                </v-chip>
            </template>

        </v-data-table>
        <projectmodal
                :showmodal="ismodalactive"
                :modaldata="modaldata"
                @closeButtonModal="closeModal"
        ></projectmodal>
    </v-card>

</template>

<script>

    import ProjectModal from '../../../pages/admin/projects/ProjectModal';

    import Axios from 'axios';

    export default {
        name: "ProjectIndex",
        components : {
            projectmodal : ProjectModal,
        },
        data() {
            return {
                tablecolums : [
                    {
                        text: "Nº Obra",
                        value: "id",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Empresa",
                        value: "client_name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Nombre",
                        value: "name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Fecha Inicio",
                        value: "date_start",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Fecha Fin",
                        value: "date_end",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Estado",
                        value: "status",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Servicios",
                        value: "servicescount",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    }
                ],
                tablerows : [{}],
                search : '',
                modaldata : {},
                ismodalactive : false
            };
        },
        created() {
            this.$emit('loadevent',{'active' : false });
            this.getRows();

        },
        methods : {

            getRows() {

                Axios.get('/projects/',
                ).then(response => {
                    this.$set(this, 'tablerows', response.data.projects );
                    this.$emit('loadeventchild',{'active' : false });
                }).catch(e => {
                    console.log(e);
                });

            },
            showModal(e){
                this.$emit('loadevent',{'active' : true });
                this.$set(this, 'modaldata', e);
                this.$set(this, 'ismodalactive', true);

            },
            showNewModal(){
                this.$emit('loadevent',{'active' : true });
                this.$set(this, 'modaldata', {
                    id:0,
                    name:'',
                    client_id:'',
                    client_name:'',
                    date_start:0,
                    date_end:0,
                    status:'Activo',
                    servicescount:0
                });
                this.$set(this, 'ismodalactive', true);
            },
            closeModal(e){
                this.$set(this, 'ismodalactive', false );
            }

        }
    }
</script>
