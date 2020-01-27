<template>
    <div>{{appName}}</div>
</template>

<script>

    import Vue from "vue";

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
        }
    };
</script>
