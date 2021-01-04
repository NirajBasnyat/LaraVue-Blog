<template>
    <v-app>
        <v-container>
            <v-form ref="form" @submit.prevent="signUp">
                <v-text-field
                    v-model="form.name"
                    type="text"
                    label="Name"
                    required
                ></v-text-field>

                <span class="red--text" v-if="errors.name">
                    {{ errors.name[0] }}
                </span>

                <v-text-field
                    v-model="form.email"
                    type="email"
                    label="E-mail"
                    required
                ></v-text-field>

                <span class="red--text" v-if="errors.email">
                    {{ errors.email[0] }}
                </span>

                <v-text-field
                    v-model="form.password"
                    type="password"
                    label="Password"
                    required
                ></v-text-field>

                <span class="red--text" v-if="errors.password">
                    {{ errors.password[0] }}
                </span>

                <v-text-field
                    v-model="form.password_confirmation"
                    type="password"
                    label="Confirm Password"
                    required
                ></v-text-field>

                <v-btn color="green" class="mr-4" type="submit">
                    Submit
                </v-btn>

                <router-link to="/login">
                    <v-btn color="blue" class="mr-4">
                        LogIn
                    </v-btn>
                </router-link>
            </v-form>
        </v-container>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: ""
            },
            errors: {}
        };
    },

    created() {
        if (User.loggedIn()) {
            this.$router.push({ name: "Forum" });
        }
    },

    methods: {
        signUp() {
            axios
                .post(`/api/auth/signup`, this.form)
                .then(res => {
                    User.responseAfterLogin(res); //localstorage function
                    this.$router.push({ name: "Forum" });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>

<style></style>
