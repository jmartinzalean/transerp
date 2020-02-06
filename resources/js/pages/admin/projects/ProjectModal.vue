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
                    <v-toolbar-title v-show="formData.id === 0">{{title}}</v-toolbar-title>
                    <v-toolbar-title v-show="formData.id !== 0">{{formData.name}} - {{formData.client_name}}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form>
                        <alerts :type="typeAlert" :message="textAlert"></alerts>
                        <v-container>
                            <v-row>
                                <v-col
                                        cols="12"
                                        :sm="12"
                                        :md="2"
                                        :lg="2"
                                >
                                    <v-text-field
                                            label="Nombre Obra"
                                            v-model.trim="$v.formData.name.$model"
                                            required
                                            :error-messages="NameErrors"
                                            :counter="20"
                                            :autofocus="true"
                                            @input="$v.formData.name.$touch()"
                                            @blur="$v.formData.name.$touch()"
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                        cols="12"
                                        :sm="12"
                                        :md="5"
                                        :lg="5"
                                >
                                    <v-text-field
                                            label="Empresa/Sociedad/Autónomo"
                                            v-model.trim="$v.formData.client_name.$model"
                                            required
                                            :error-messages="ClientErrors"
                                            :counter="100"
                                            @input="$v.formData.client_name.$touch()"
                                            @blur="$v.formData.client_name.$touch()"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :sm="12"
                                        :md="5"
                                        :lg="5"
                                >
                                    <v-menu
                                            v-model="dateStartShow"
                                            :close-on-content-click="false"
                                            :nudge-right="40"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                    v-model="DateStartFormated"
                                                    label="Fecha Inicio"
                                                    prepend-icon="event"
                                                    readonly
                                                    v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                                v-model="formData.date_start"
                                                @input="dateStartShow = false"
                                                locale="es-es"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        cols="12"
                                        :sm="12"
                                        :md="5"
                                        :lg="5"
                                >
                                    <v-menu
                                            v-model="dateEndShow"
                                            :close-on-content-click="false"
                                            :nudge-right="40"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                    v-model="DateEndFormated"
                                                    :min="formData.date_start"
                                                    label="Fecha Fin"
                                                    prepend-icon="event"
                                                    readonly
                                                    :disabled="hasDateStart"
                                                    v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                                v-model="formData.date_end"
                                                @input="dateEndShow = false"
                                                :min="formData.date_start"
                                                :show-current="formData.date_start"
                                                locale="es-es"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="2"
                                        :lg="2"
                                >
                                    <v-text-field
                                            label="Estado"
                                            v-model.trim="formData.status"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="12"
                                        :lg="12"
                                >
                                    <v-textarea
                                            label="Notas Adiccionales"
                                            v-model="formData.description"
                                            :auto-grow="true"
                                            :outlined="true"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        cols="12"
                                        :xs="0"
                                        :sm="0"
                                        :md="6"
                                        :lg="6"
                                >
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="6"
                                        :lg="6"
                                        class="text-end"
                                >
                                    <v-btn class="primary" @click="submit" :disabled="$v.$invalid">Guardar</v-btn>
                                    <v-btn class="secondary" @click.stop="closeModal">Cancelar</v-btn>
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
    import { required, maxLength, requiredIf, numeric, email } from 'vuelidate/lib/validators';
    import Alerts from "../../../components/Alerts";
    import moment from 'moment';

    export default {
        name: "ProjectModal",
        props: {
            showmodal : false,
            modaldata : {
                type: Object,
                required: false
            },
        },
        components:{
            Alerts,
            VFormBase
        },
        data() {
            return {
                showmodaltop : false,
                isnew: true,
                title: this.$t("app.newproject"),
                formData:{
                    id:0,
                    name:'',
                    client_id:'',
                    client_name:'',
                    date_start:0,
                    date_end:0,
                    status:'Activo',
                    description:'',
                    servicescount:0
                },
                textAlert:false,
                typeAlert:false,
                dateStartShow: false,
                dateEndShow: false,
            }
        },
        validations: {
            formData : {
                name: {
                    required,
                    maxLength: maxLength(100)
                },
                client_name: {
                    required,
                    maxLength: maxLength(20)
                }
            }
        },
        created(){

        },
        methods: {
            closeModal(){
                this.$emit('closeButtonModal',{});
            },
            setMessage(message, type){
                this.$set(this, 'textAlert', message);
                this.$set(this, 'typeAlert', type);
            },
            getClient(nif){
                Axios.get('/client/nif/'+nif,
                ).then(response => {
                    if(response.data.count === 0 ) {
                        this.saveClient();
                    }else{
                        this.setMessage('Cliente duplicado. No se puede guardar como nuevo. Debe editarse.', 'error');
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            saveClient(){
                Axios.post(
                    'clients',
                    this.formData
                ).then(response => {
                    if(response.data.status === 'ok' && response.data.id !== undefined){
                        this.$set(this.formData, 'id', response.data.id);
                        this.setMessage('Registro guardado con éxito.', 'success');
                    }else{
                        this.setMessage('Error en el guardado de registro, save', 'error');
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            updateClient(){
                Axios.put(
                    'clients/' + this.formData.id,
                    this.formData
                ).then(response => {
                    console.log(response);
                    if(response.data.status === 'ok' && response.data.id !== undefined){
                        this.setMessage('Registro guardado con éxito.', 'success');
                    }else{
                        this.setMessage('Error en el guardado de registro, update', 'error');
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            submit () {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    if(this.formData.id === 0){
                        this.getClient(this.formData.tax_number);
                    }else{
                        this.updateClient();
                    }
                }
            },
            formatDate (date) {
                if (!date){
                    return null;
                }
                return moment(String(date)).format('DD/MM/YYYY');
            }
        },
        computed:{
            NameErrors () {
                const errors = [];
                if (!this.$v.formData.name.$dirty){
                    return errors;
                }
                if(!this.$v.formData.name.maxLength){
                    errors.push('El campo excede el tamaño máximo');
                }
                if(!this.$v.formData.name.required ){
                    errors.push('Campo requerido');
                }
                return errors;
            },
            ClientErrors () {
                const errors = [];
                if (!this.$v.formData.client_name.$dirty){
                    return errors;
                }
                if(!this.$v.formData.client_name.maxLength){
                    errors.push('El campo excede el tamaño máximo');
                }
                if(!this.$v.formData.client_name.required ){
                    errors.push('Campo requerido');
                }
                return errors;
            },
            DateStartFormated(){
                return this.formatDate(this.formData.date_start);
            },
            DateEndFormated(){
                return this.formatDate(this.formData.date_end);
            },
            hasDateStart(){
                return (this.formData.date_start === null);
            }
        },
        watch:{
            showmodal(value){
                this.$set(this, 'showmodaltop', value)
            },
            modaldata(value){
                this.$set(this, 'formData', value);
                this.setMessage(false, false, false);
            }
        }

    }
</script>
