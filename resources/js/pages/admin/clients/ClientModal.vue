<template>
    <div>
        <v-dialog
                v-model="showmodaltop"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition"
                scrollable
        >
            <v-card class="repository_modal">
                <v-toolbar
                        color="secondary"
                        class="modal_header"
                >
                    <v-btn
                            icon
                            @click.stop="closeModal()"
                    >
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>{{title}}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form v-model="valid">
                        <v-container>
                            <v-row>
                                <v-col
                                        :xs="12"
                                        :sm="12"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            label="Nº Físcal"
                                            v-model="formData.tax_number"
                                            required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                        :xs="12"
                                        :sm="12"
                                        :md="8"
                                        :lg="8"
                                >
                                    <v-text-field
                                            class="text-capitalize"
                                            label="Nombre Empresa/Sociedad/Autónomo"
                                            v-model="formData.name"
                                            required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        :xs="12"
                                        :sm="12"
                                        :md="12"
                                        :lg="12"
                                >
                                    <v-text-field
                                            class="text-capitalize"
                                            label="Dirección"
                                            v-model="formData.address"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        :xs="4"
                                        :sm="4"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            label="CP"
                                            v-model="formData.cp"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        :xs="4"
                                        :sm="4"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-autocomplete
                                            class="text-capitalize"
                                            v-model="formData.state"
                                            :items="statesItems"
                                            item-text="name"
                                            item-value="id"
                                            label="Provincia"
                                            placeholder="Buscar una provincia"
                                            return-object
                                    ></v-autocomplete>
                                </v-col>
                                <v-col
                                        :xs="4"
                                        :sm="4"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-autocomplete
                                            class="text-capitalize"
                                            v-model="formData.city"
                                            :items="citiesItems"
                                            item-text="name"
                                            item-value="id"
                                            label="Localidad"
                                            placeholder="Busca primero una localidad"
                                            return-object
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        :xs="4"
                                        :sm="4"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            label="Fijo"
                                            v-model="formData.phone"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        :xs="4"
                                        :sm="4"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            label="Móvil"
                                            v-model="formData.mobil"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        :xs="4"
                                        :sm="4"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            label="Fax"
                                            v-model="formData.fax"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        :xs="6"
                                        :sm="6"
                                        :md="8"
                                        :lg="8"
                                >
                                    <v-text-field
                                            class="text-capitalize"
                                            label="Persona de contacto"
                                            v-model="formData.contact_name"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        :xs="6"
                                        :sm="6"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            label="Email"
                                            v-model="formData.email"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        :xs="12"
                                        :sm="12"
                                        :md="12"
                                        :lg="12"
                                >
                                    <v-text-field
                                            label="Notas Adiccionales"
                                            v-model="formData.description"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>

    import Axios from 'axios';
    import VFormBase from 'vuetify-form-base';

    export default {
        name: "ClientModal",
        props: {
            showmodal : false,
            modaldata : {},
        },
        components:{
            VFormBase
        },
        data() {
            return {
                showmodaltop : false,
                valid: false,
                isnew: true,
                title: this.$t("app.newclient"),
                citiesItems:[],
                statesItems:[],
                formData:{
                    id:0,
                    name:'',
                    tax_number:'',
                    contact_name:'',
                    address:'',
                    cp:null,
                    latitude:0,
                    longitude:0,
                    phone:null,
                    mobil:null,
                    fax:null,
                    email:null,
                    description:'',
                    city:0,
                    state:28,
                    projectscount:0
                }
            }
        },
        created(){
            this.getStates();
        },
        methods: {
            closeModal(){
                this.$emit('closeButtonModal',{});
            },
            getClities(id){
                Axios.get('/cities/states/'+id,
                ).then(response => {
                    this.$set(this, 'citiesItems', response.data.cities );
                }).catch(e => {
                    console.log(e);
                });
            },
            getStates(){
                Axios.get('/states/',
                ).then(response => {
                    this.$set(this, 'statesItems', response.data.states );
                }).catch(e => {
                    console.log(e);
                });
            }
        },
        watch:{
            showmodal(value){
                this.$set(this, 'showmodaltop', value)
            },
            modaldata(value){
                if(value.state !== 0){
                    this.getClities(value.state.id)
                }
                this.$set(this, 'formData', value)
            }
        }

    }
</script>
