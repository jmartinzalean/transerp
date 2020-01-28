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
                    <v-toolbar-title> {{modaldata.projects}}, {{modaldata.services}}, {{modaldata.applications}}, {{modaldata.name}}, <span class="font-weight-bold right-align">{{modaldata.elementcount}} Elementos</span></v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-row>
                        <v-col
                                :sm="4"
                                :md="4"
                                :lg="4"
                        >
                            <h3 class="text-center">Lenguajes(%)</h3>
                            <pie-chart :chartData="languagechart.chartData" v-model="languagechart" @charClickEvent="charClickEvent"></pie-chart>
                        </v-col>
                        <v-col
                                :sm="4"
                                :md="4"
                                :lg="4"
                        >
                            <h3 class="text-center">Extensiones(%)</h3>
                            <pie-chart :chartData="extensionchart.chartData" v-model="extensionchart" @charClickEvent="charClickEvent"></pie-chart>
                        </v-col>
                        <v-col
                                :sm="4"
                                :md="4"
                                :lg="4"
                        >
                            <h3 class="text-center">Capas(%)</h3>
                            <pie-chart :chartData="layoutchart.chartData" v-model="layoutchart" @charClickEvent="charClickEvent"></pie-chart>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                    <v-card-title>
                        Elementos
                        <v-spacer></v-spacer>
                        <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Wildcard"
                                single-line
                                hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
                            :headers="tablecolums"
                            :items="tablerows"
                            :search="search"
                            class="pd-30"
                    >
                        <template v-slot:item.versiones="{ item }">
                            <v-chip class="teal accent-1 c-pointer" @click="showElement( item.id )">
                                {{ item.versiones }} Versiones
                            </v-chip>
                        </template>
                    </v-data-table>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-dialog
                v-model="showmodalelement"
                hide-overlay
                max-width="900px"
                @click:outside="showmodalelement = !showmodalelement"
        >
            <v-card class="element_modal" title>
                <v-card-text>
                    <v-row>
                        <v-col
                                :sm="3"
                                :md="3"
                                :lg="3"
                        >
                            <p class="font-weight-bold">Nombre Corto:</p>
                            <p>{{currentelement.shortname}}</p>
                        </v-col>
                        <v-col
                                :sm="3"
                                :md="3"
                                :lg="3"
                        >
                            <p class="font-weight-bold">Nombre Largo:</p>
                            <p>{{currentelement.largename}}</p>
                        </v-col>
                        <v-col
                                :sm="3"
                                :md="3"
                                :lg="3"
                        >
                            <p class="font-weight-bold">Zamudio:</p>
                            <p>{{currentelement.zamudio}}</p>
                        </v-col>
                        <v-col
                                :sm="3"
                                :md="3"
                                :lg="3"
                        >
                            <p class="font-weight-bold">Tipo de elemento:</p>
                            <p>{{currentelement.extension}} - {{currentelement.language}} -{{currentelement.layout}}</p>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                    <v-row>
                        <v-col
                                :sm="4"
                                :md="4"
                                :lg="4"
                        >
                            <v-list>
                                <v-list-item class="font-weight-bold">
                                    Elemento
                                </v-list-item>
                                <v-list-item>
                                    <v-list>
                                        <v-list-item  v-for="versions in currentelement.versions" :key="versions.id" class="font-weight-bold">
                                            <span v-show="versions.id">{{currentelement.shortname}}</span>
                                        </v-list-item>
                                    </v-list>
                                </v-list-item>
                            </v-list>
                        </v-col>
                        <v-col
                                :sm="3"
                                :md="3"
                                :lg="3"
                        >
                            <v-list>
                                <v-list-item class="font-weight-bold">
                                    Versión
                                </v-list-item>
                                <v-list-item>
                                    <v-list>
                                        <v-list-item  v-for="versions in currentelement.versions" :key="versions.id" class="font-weight-bold">
                                            <span v-show="versions.version">{{versions.version}}</span>
                                        </v-list-item>
                                    </v-list>
                                </v-list-item>
                            </v-list>
                        </v-col>
                        <v-col
                                :sm="3"
                                :md="3"
                                :lg="3"
                        >
                        </v-col>

                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-dialog
                v-model="showmodalchar"
                hide-overlay
                max-width="900px"
                @click:outside="showmodalchar = !showmodalchar"
        >
            <v-data-table
                    :headers="tablecolumschar"
                    :items="tablerowschar"
                    class="pd-30"
            >
                <template v-slot:item.color="{ item }">
                    <v-chip :style="{backgroundColor : item.color}">
                    </v-chip>
                </template>
            </v-data-table>
        </v-dialog>
    </div>
</template>

<script>

    import Axios from 'axios';
    import PieChart from '../charts/PieChart';
    import FilterTable from '../components/FilterElements';

    export default {
        name: "RepositoriesModal",
        components: {
            PieChart, FilterTable
        },
        props: {
            showmodal : false,
            modaldata : {},
        },
        data() {
            return {
                search : '',
                showmodalelement : false,
                showmodaltop : false,
                showmodalchar : false,
                currentelement: {},
                languagechart: {
                    chartData: {}
                },
                extensionchart: {
                    chartData: {}
                },
                layoutchart: {
                    chartData: {}
                },
                tablecolums : [
                    {
                        text: "Nombre",
                        value: "shortname",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Lenguaje",
                        value: "language.name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Extension",
                        value: "extension.name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Capa",
                        value: "layout.name",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    },
                    {
                        text: "Versiones",
                        value: "versiones",
                        align: 'start',
                        sortable: true,
                        filterable: true
                    }
                ],
                tablerows : [],
                tablecolumschar : [
                    {
                        text: "",
                        value: "color",
                        align: 'start'
                    },
                    {
                        text: "Tipo",
                        value: "name",
                        align: 'start'
                    },
                    {
                        text: "Número de elementos",
                        value: "count",
                        align: 'start',
                    },
                    {
                        text: "Porcentaje",
                        value: "percentage",
                        align: 'start',
                    },
                ],
                tablerowschar : []
            }
        },
        methods: {
            closeModal(){
                this.$emit('closeButtonModal',{});
            },
            closeModalElement(){
                this.$set(this, 'showmodalelement', false );
            },
            prepareData(data) {
                return {
                    chartData: {
                        hoverBorderWidth: 10,
                        labels: data.label,
                        datasets: [
                            {
                                backgroundColor: data.color,
                                data: data.data
                            }
                        ]
                    }
                };
            },
            prepareCharData(data){
                let arrayData = [];
                let that = this;
                data.labels.forEach(function(value, index){
                    let charData = {
                        color : data.datasets[0].backgroundColor[index],
                        name : value,
                        count: Math.round(data.datasets[0].data[index] * this.modaldata.elementcount)/100,
                        percentage : (Math.round(data.datasets[0].data[index] *100)/100)+'%',
                    };
                    arrayData.push(charData);
                }, that);
                return arrayData;

            },
            searchList(e){
                console.log(e)
            },
            showElement(elementid) {
                if(elementid !== undefined) {
                    this.getElement(elementid);
                }
            },
            getElement(elementid) {
                Axios.get('api/elements/item/'+elementid).then(response => {
                    this.$set(this, 'currentelement', response.data.data );
                    this.$set(this, 'showmodalelement', true );
                }).catch(e => {
                    console.log(e);
                });
            },
            charClickEvent(e){
                this.$set(this, 'tablerowschar', []);
                this.$set(this, 'tablerowschar', this.prepareCharData(e));
                this.$set(this, 'showmodalchar', true );
            }
        },
        watch:{
            modaldata(){
                this.$set(this, 'layoutchart', this.prepareData(this.modaldata.layoutpercentage));
                this.$set(this, 'extensionchart', this.prepareData(this.modaldata.extensionspercentage));
                this.$set(this, 'languagechart', this.prepareData(this.modaldata.languagespercentage));
                this.$set(this, 'tablerows', this.modaldata.elements)
            },
            showmodal(){
                this.$set(this, 'showmodaltop', this.showmodal)
            }
        }

    }
</script>
