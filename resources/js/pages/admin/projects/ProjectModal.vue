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
                    <v-toolbar-title>tituloa</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    cupero
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>

    import Axios from 'axios';

    export default {
        name: "ClientModal",
        props: {
            showmodal : false,
            modaldata : {},
        },
        data() {
            return {
                showmodaltop : this.showmodal
            }
        },
        methods: {
            closeModal(){
                this.$emit('closeButtonModal',{});
            }
        },
        watch:{
            showmodal(){
                this.$set(this, 'showmodaltop', this.showmodal)
            }
        }

    }
</script>
