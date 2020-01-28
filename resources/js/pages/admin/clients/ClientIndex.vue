<template>
    <v-card>
        <!--filtertable @filterSearchEvent="searchList"></filtertable-->
        <v-data-table
                :headers="tablecolums"
                :items="tablerows"
                class="pd-30"

        >
            <!--template v-slot:item.elementcount="{ item }">
                <v-chip class="blue lighten-1 c-pointer" @click="showModal( item.id )">
                    {{ item.elementcount }} Elementos
                </v-chip>
            </template-->

        </v-data-table>
        <!--repositoriesmodal
                :showmodal="ismodalactive"
                v-model="ismodalactive"
                :modaldata="modaldata"
                @closeButtonModal="closeModal"
        ></repositoriesmodal-->
    </v-card>

</template>

<script>

    //import FilterTable from '../../../pages/admin/clients/ClientListFilters';
    //import RepositoriesModal from '../../../pages/admin/clients/ClientModal';

    import Axios from 'axios';

    export default {
        name: "ClientIndex",
        components : {
            //filtertable : FilterTable,
            //repositoriesmodal : RepositoriesModal,
        },
        data() {
            return {
                tablecolums : [
                    {
                        text: "Nº Fiscal",
                        value: "tax_number",
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
                        text: "Telefonos",
                        value: "phone_number",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Mail",
                        value: "email",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Localidad",
                        value: "city",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Provincia",
                        value: "state",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    }
                ],
                tablerows : [{}],
                modaldata : {},
                ismodalactive : false

            };
        },
        created() {
            this.$emit('loadevent',{'active' : false });
            //this.getRows();

        },
        methods : {

            getRows() {

                Axios.get('api/repositories/list',
                ).then(response => {
                    this.$set(this, 'tablerows', response.data.data );
                    this.$emit('loadevent',{'active' : false });
                }).catch(e => {
                    console.log(e);
                });

            },
            searchList(data) {
                Axios.get('api/repositories/list?project='+data.project+'&service='+data.service+'&application='+data.application+'&repositorytype='+data.repositorytype,
                ).then(response => {
                    this.$set(this, 'tablerows', response.data.data );
                    this.$emit('loadevent',{'active' : false });
                }).catch(e => {
                    console.log(e);
                });

            },
            // TODO, código duplicado con Repositories.vue, los dos hacen los mismo, refactorizar y unificar
            getRepositoryById(componentid) {
                Axios.get('api/repositories/item/'+componentid
                ).then(response => {
                    this.$set(this, 'modaldata', response.data.data);
                    this.$set(this, 'ismodalactive', true );
                    this.$emit('loadevent',{'active' : false });

                }).catch(e => {
                    console.log(e);
                });
            },
            showModal(componentid){
                this.$emit('loadevent',{'active' : true });
                this.getRepositoryById(componentid);

            },
            closeModal(e){
                this.$set(this, 'ismodalactive', false );
            }
            // TODO, FIN

        }
    }
</script>
