<template>
    <div>{{appName}}</div>
</template>

<script>

    import Axios from 'axios';

    export default {
        name: "App",

        props: {
            source: String,
        },
        data() {
            return {
                appName: this.$t("app.name"),
            };
        },
        created() {
            this.$emit('loadevent',{'active' : false });
            this.getCities();
        },
        methods: {

            getCities(){

                Axios.get('cities/states/',
                ).then(response => {
                    console.log(response);
                }).catch(e => {
                    console.log(e);
                });

            }
        }
    };
</script>
