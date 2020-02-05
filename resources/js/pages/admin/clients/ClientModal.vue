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
                    <v-toolbar-title v-show="formData.id !== 0">{{formData.tax_number}} - {{formData.name}}</v-toolbar-title>
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
                                            label="Nº Físcal"
                                            v-model.trim="$v.formData.tax_number.$model"
                                            required
                                            :error-messages="NifErrors"
                                            :counter="20"
                                            :autofocus="true"
                                            @input="$v.formData.tax_number.$touch()"
                                            @blur="$v.formData.tax_number.$touch()"
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                        cols="12"
                                        :sm="12"
                                        :md="5"
                                        :lg="5"
                                >
                                    <v-text-field
                                            class="text-capitalize"
                                            label="Nombre Empresa/Sociedad/Autónomo"
                                            v-model.trim="$v.formData.name.$model"
                                            required
                                            :error-messages="NameErrors"
                                            :counter="100"
                                            @input="$v.formData.name.$touch()"
                                            @blur="$v.formData.name.$touch()"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="5"
                                        :lg="5"
                                >
                                    <v-text-field
                                            label="Persona de contacto"
                                            v-model="formData.contact_name"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="4"
                                        :lg="4"
                                >
                                    <v-text-field
                                            class="text-capitalize"
                                            label="Dirección"
                                            v-model="formData.address"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="2"
                                        :lg="2"
                                >
                                    <v-text-field
                                            label="CP"
                                            v-model.trim="$v.formData.cp.$model"
                                            :error-messages="CpErrors"
                                            :counter="5"
                                            @input="$v.formData.cp.$touch()"
                                            @blur="$v.formData.cp.$touch()"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="3"
                                        :lg="3"
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
                                            @input="setStateEvent"
                                    ></v-autocomplete>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="12"
                                        :sm="12"
                                        :md="3"
                                        :lg="3"
                                >
                                    <v-autocomplete
                                            class="text-capitalize"
                                            v-model.trim="$v.formData.city.$model"
                                            :items="citiesItems"
                                            item-text="name"
                                            item-value="id"
                                            label="Localidad"
                                            placeholder="Busca primero una localidad"
                                            return-object
                                            :error-messages="CityErrors"
                                            required
                                            @input="$v.formData.city.$touch()"
                                            @blur="$v.formData.city.$touch()"
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col
                                        cols="12"
                                        :xs="6"
                                        :sm="6"
                                        :md="3"
                                        :lg="3"
                                >
                                    <v-text-field
                                            label="Fijo"
                                            v-model="formData.phone"
                                            v-model.trim="$v.formData.phone.$model"
                                            :error-messages="PhoneErrors"
                                            @input="$v.formData.phone.$touch()"
                                            @blur="$v.formData.phone.$touch()"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="6"
                                        :sm="6"
                                        :md="3"
                                        :lg="3"
                                >
                                    <v-text-field
                                            label="Móvil"
                                            v-model.trim="$v.formData.mobil.$model"
                                            :error-messages="MobilErrors"
                                            @input="$v.formData.mobil.$touch()"
                                            @blur="$v.formData.mobil.$touch()"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="6"
                                        :sm="6"
                                        :md="3"
                                        :lg="3"
                                >
                                    <v-text-field
                                            label="Fax"
                                            v-model.trim="$v.formData.fax.$model"
                                            :error-messages="FaxErrors"
                                            @input="$v.formData.fax.$touch()"
                                            @blur="$v.formData.fax.$touch()"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                        cols="12"
                                        :xs="6"
                                        :sm="6"
                                        :md="3"
                                        :lg="3"
                                >
                                    <v-text-field
                                            label="Email"
                                            v-model.trim="$v.formData.email.$model"
                                            :error-messages="EmailErrors"
                                            @input="$v.formData.email.$touch()"
                                            @blur="$v.formData.email.$touch()"
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

    export default {
        name: "ClientModal",
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
                    city:{id:0,name:''},
                    state:{id:0,name:''},
                    projectscount:0
                },
                textAlert:false,
                typeAlert:false
            }
        },
        validations: {
            formData : {
                name: {
                    required,
                    maxLength: maxLength(100)
                },
                tax_number: {
                    required,
                    maxLength: maxLength(20)
                },
                city: {
                    required: requiredIf(function(){
                        return this.formData.state.id !== 0;
                    })
                },
                cp:{
                    numeric,
                    maxLength: maxLength(5)
                },
                phone:{
                    numeric
                },
                mobil:{
                    numeric
                },
                fax:{
                    numeric
                },
                email:{
                    email
                },
            }
        },
        created(){
            this.getStates();
        },
        methods: {
            closeModal(){
                this.$emit('closeButtonModal',{});
            },
            setMessage(message, type){
                this.$set(this, 'textAlert', message);
                this.$set(this, 'typeAlert', type);
            },
            getClities(id){
                Axios.get('/cities/states/'+id,
                ).then(response => {
                    this.$set(this, 'citiesItems', response.data.cities );
                    this.$v.formData.city.$touch();
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
            },
            setStateEvent(e){
                if(e.id !== 0 && e.id !== undefined){
                    this.$set(this.formData, 'city', {id:0,name:''});
                    this.setMessage('No se guardará la provincia. Debe elegir una localidad.', 'warning');
                    this.getClities(e.id);
                }
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
                    console.log(response);
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
                console.log(this.formData.id);
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
            NifErrors () {
                const errors = [];
                if (!this.$v.formData.tax_number.$dirty){
                    return errors;
                }
                if(!this.$v.formData.tax_number.maxLength){
                    errors.push('El campo excede el tamaño máximo');
                }
                if(!this.$v.formData.tax_number.required ){
                    errors.push('Campo requerido');
                }
                return errors;
            },
            CityErrors () {
                const errors = [];
                if (!this.$v.formData.city.$dirty){
                    return errors;
                }
                if(this.formData.state.id !== 0  && this.$v.formData.$model.city.id === 0){
                    errors.push('Campo requerido.');
                }
                return errors;
            },
            CpErrors () {
                const errors = [];
                if (!this.$v.formData.cp.$dirty){
                    return errors;
                }
                if(!this.$v.formData.cp.numeric ){
                    errors.push('Solo números');
                }
                if(!this.$v.formData.cp.maxLength){
                    errors.push('El campo excede el tamaño máximo');
                }
                return errors;
            },
            PhoneErrors () {
                const errors = [];
                if (!this.$v.formData.phone.$dirty){
                    return errors;
                }
                if(!this.$v.formData.phone.numeric ){
                    errors.push('Solo números');
                }
                return errors;
            },
            MobilErrors () {
                const errors = [];
                if (!this.$v.formData.mobil.$dirty){
                    return errors;
                }
                if(!this.$v.formData.mobil.numeric ){
                    errors.push('Solo números');
                }
                return errors;
            },
            FaxErrors () {
                const errors = [];
                if (!this.$v.formData.fax.$dirty){
                    return errors;
                }
                if(!this.$v.formData.fax.numeric ){
                    errors.push('Solo números');
                }
                return errors;
            },
            EmailErrors () {
                const errors = [];
                if (!this.$v.formData.email.$dirty){
                    return errors;
                }
                if(!this.$v.formData.email.email){
                    errors.push('Formato: mail@mail.com');
                }
                return errors;
            }
        },
        watch:{
            showmodal(value){
                this.$set(this, 'showmodaltop', value)
            },
            modaldata(value){
                if(value.id !== 0){
                    if(value.state.id !== 0){
                        this.getClities(value.state.id);
                    }
                }
                this.$set(this, 'formData', value);
                this.setMessage(false, false, false);
            }
        }

    }
</script>
