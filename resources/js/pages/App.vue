<template>
    <v-app id="inspire" :class="{scrolloff : notScroll}">
        <router-view
            @loadevent="loadStatus"
            @scrollevent="scrollStatus"
            :pagetitle="pageTitle"
        ></router-view>
        <v-overlay :value="{isActive}" v-model="isActive">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
    </v-app>
</template>

<script>

    export default {
        name: "App",
        data() {
            return {
                isActive : true,
                notScroll: false,
                drawer: null,
                pageTitle: 'login'
            };
        },
        methods: {
            loadStatus(e) {
                this.isActive = e.active;
            },
            scrollStatus(e){
                this.notScroll = e.scroll;
            }
        },
        watch: {
            $route(to, from) {
                this.$set(this, 'pageTitle', this.$t("pages."+to.name));
                this.$set(this, 'isActive', true);
                this.$set(this, 'notScroll', false);

            }
        }
    }
</script>
