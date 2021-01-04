<template>
    <v-app>
        <v-container>
            <v-form ref="form" @submit.prevent="Login">
                <v-text-field
                    v-model="form.email"
                    type="email"
                    label="E-mail"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.password"
                    type="password"
                    label="Password"
                    required
                ></v-text-field>

                <v-btn color="green" class="mr-4" type="submit">
                    Submit
                </v-btn>

                <router-link to="/signup">
                    <v-btn color="blue" class="mr-4">
                        Sign Up
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
                email: "",
                password: ""
            }
        };
    },

    created() {
        if (User.loggedIn()) {
            this.$router.push({ name: "Forum" });
        }
    },

    methods: {
        Login() {
            User.Login(this.form);
            this.$router.push({ name: "Forum" });
        }
    }
};
</script>

<style></style>
