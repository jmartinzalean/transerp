<template>
    <div>
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
            <v-app-bar-nav-icon class="white" @click.stop="drawer = !drawer" />
            <v-toolbar-title style="color:#fff">{{currentTitle}}</v-toolbar-title>
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
                                @loadeventchild="loadStatus"
                                @scrolleventchild="scrollStatus"
                                class="container"
                        ></router-view>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </div>
</template>

<script>

    import SidebarMenu from "../pages/layouts/Sidebar";

    export default {
        name: "AppLayout",
        components: {
            SidebarMenu
        },
        props:{
            pagetitle:''
        },
        data() {
            return {
                drawer: null,
                currentTitle: this.pagetitle
            };
        },
        methods: {
            loadStatus(e) {
                this.$emit('loadevent',{'active' : e.active });
            },
            scrollStatus(e){
                this.$emit('scrollevent',{'active' : e.active });
            }
        },
        watch: {
            pagetitle(){
                this.$set(this, 'currentTitle', this.pagetitle)
            }
        }
    };
</script>