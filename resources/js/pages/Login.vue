<template>
    <v-app id="inspire">
        <v-content>
            <v-container
                    class="fill-height"
                    fluid
            >
                <v-row
                        align="center"
                        justify="center"
                >
                    <v-col
                            cols="12"
                            sm="8"
                            md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                    color="primary"
                                    dark
                                    flat
                            >
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer />
                            </v-toolbar>
                            <v-card-text>
                                <v-alert v-if="haserror" class="warning">
                                    <p>{{ loginerror }}</p>
                                </v-alert>
                                <v-form>
                                    <v-text-field
                                            label="E-mail"
                                            name="email"
                                            prepend-icon="person"
                                            type="text"
                                            id="email"
                                            placeholder="user@example.com"
                                            v-model="email"
                                            required
                                    />
                                    <v-text-field
                                            id="password"
                                            label="Password"
                                            name="password"
                                            prepend-icon="lock"
                                            type="password"
                                            v-model="password"
                                            required
                                    />
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer />
                                <v-btn type="submit" color="primary" @click="login">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                haserror: false,
                loginerror: this.$t("error.login"),
            }
        },

        methods: {
            login() {
                // get the redirect object
                var redirect = this.$auth.redirect();
                var app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function() {
                        // handle redirection
                        const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'dashboard';
                        this.$router.push({name: redirectTo})
                    },
                    error: function() {
                        app.haserror = true
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    }
</script>