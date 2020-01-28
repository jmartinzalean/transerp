<template>
    <v-app id="inspire" :class="{scrolloff : notScroll}">
        <v-navigation-drawer id="sidebar"
                             v-model="drawer"
                             app
        >
            <sidebar-menu></sidebar-menu>
        </v-navigation-drawer>

        <v-app-bar
                app
                id="topbar"
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        </v-app-bar>

        <v-content id="content">
            <v-container
                    class="fill-height"
                    fluid
            >
                <v-row
                        align="center"
                        justify="center"
                >
                    <v-col class="text-center">
                        <router-view
                                class="container"
                                @loadevent="loadStatus"
                                @scrollevent="scrollStatus"
                        ></router-view>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
        <v-overlay :value="{isActive}" v-model="isActive">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
    </v-app>
</template>

<script>

    import SidebarMenu from "../pages/layouts/Sidebar";

    export default {
        name: "AppLayout",
        components: {
            SidebarMenu
        },
        data() {
            return {
                isActive : true,
                notScroll: false,
                drawer: null,
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
            $route (to, from) {
                this.$set(this, 'isActive', true);
                this.$set(this, 'notScroll', false);
            }
        }

    };
</script>