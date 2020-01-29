<template>
    <v-card>
        <v-card-title>
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
            <template v-slot:item.phone="{ item }">
                {{ item.phone }}<span v-show="item.mobil"> {{ item.mobil }}</span>
            </template>
            <template v-slot:item.projectscount="{ item }">
                <v-chip class="teal accent-1 c-pointer">
                    <router-link :to="/projects/+item.id">
                        {{ item.projectscount }} Obras
                    </router-link>
                </v-chip>
            </template>

        </v-data-table>
        <clientmodal
                :showmodal="ismodalactive"
                :modaldata="modaldata"
                @closeButtonModal="closeModal"
        ></clientmodal>
    </v-card>

</template>

<script>

    import ClientModal from '../../../pages/admin/clients/ClientModal';

    import Axios from 'axios';

    export default {
        name: "ClientIndex",
        components : {
            clientmodal : ClientModal,
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
                        value: "phone",
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
                        value: "city.name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Provincia",
                        value: "state.name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Obras",
                        value: "projectscount",
                        align: 'center',
                        sortable: true,
                        filterable: false
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

                Axios.get('/clients/',
                ).then(response => {
                    this.$set(this, 'tablerows', response.data.clients );
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
            closeModal(e){
                this.$set(this, 'ismodalactive', false );
            }
            // TODO, FIN

        }
    }
</script>
