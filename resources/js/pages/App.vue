<template>
    <router-view
    ></router-view>
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
    };
</script>
