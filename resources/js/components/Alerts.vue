<template>
    <div class="alert-component">
        <v-alert
                v-model="status"
                :type="typeAlert"
                dismissible
                @input="resetStatus"
        >
            {{ textAlert }}
        </v-alert>
    </div>
</template>

<script>
    export default {
        name: 'Alerts',
        props:{
            message:{
                required: false
            },
            type:{
                required: false
            }
        },
        data() {
            return {
                status:false,
                text:'',
                typeMessage:'success'
          }
        },
        methods:{
            resetStatus(){
                this.$set(this,'status',false);
            }
        },
        watch: {
            message(value) {
                this.resetStatus();
                this.$set(this,'text', value);
                this.$set(this,'status', true);
            },
            type(value) {
                this.$set(this,'typeMessage', value);
            }
        },
        computed:{
            textAlert(){
                return this.text;
            },
            typeAlert(){
                return this.typeMessage;
            }
        }
    }
</script>
