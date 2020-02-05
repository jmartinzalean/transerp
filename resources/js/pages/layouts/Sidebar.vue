<template>
    <div>
        <v-row>
            <v-col
                    :xs="12"
                    :sm="12"
                    :md="12"
                    :lg="6"
                    class="logo-title"
            >
                <img id="logo" src="../../../img/logo.jpg">
            </v-col>
            <v-col
                    :xs="12"
                    :sm="12"
                    :md="12"
                    :lg="6"
                    class="logo-title"
            >
                <p class="text-center title">{{appname}}</p>
            </v-col>
        </v-row>
        <v-list dense>
            <!--LOGGED USER-->
            <v-list-item link="link" v-if="$auth.check(1)" v-for="(route, key) in routes.user" v-bind:key="route.path" class="collection-item" :to="{ name : route.path }">
                <v-list-item-action>
                    <v-icon class="material-icons-outlined">{{route.icon}}<</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        {{route.name}}
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <!--LOGGED ADMIN-->
            <v-list-item link="link" v-if="$auth.check(2)" v-for="(route, key) in routes.admin" v-bind:key="route.path" class="collection-item" :to="{ name : route.path }">
                <v-list-item-action>
                    <v-icon class="material-icons-outlined">{{route.icon}}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        {{route.name}}
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <!--LOGOUT-->
            <v-list-item link="link" v-if="$auth.check()" class="collection-item" @click.prevent="$auth.logout()">
                <v-list-item-action>
                    <v-icon class="material-icons-outlined">power_settings_new</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Logout
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </div>
</template>

<script>
    export default {
        name: "Sidebar",
        props : {
            link : true
        },
        data() {
            return {
                routes: {

                    // LOGGED USER
                    user: [
                        {
                            name: this.$t("pages.dashboard"),
                            path: 'dashboard',
                            icon: 'home'
                        }
                    ],
                    // LOGGED ADMIN
                    admin: [
                        {
                            name: this.$t("pages.dashboard"),
                            path: 'dashboard',
                            icon: 'home'
                        },
                        {
                            name: this.$t("pages.clients"),
                            path: 'clients',
                            icon: 'streetview'
                        },
                        {
                            name: this.$t("pages.projects"),
                            path: 'projects',
                            icon: 'apartment'
                        }
                    ]
                },
                appname: this.$t("app.name"),
            }
        },
    }
</script>