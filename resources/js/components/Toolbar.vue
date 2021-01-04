<template>
    <v-card color="grey lighten-4" tile>
        <v-toolbar dense>
            <v-toolbar-title>Code Alchemy</v-toolbar-title>

            <v-spacer></v-spacer>

            <app-notification v-if="loggedIn"></app-notification>
            <div>
                <router-link
                    v-for="item in items"
                    :key="item.title"
                    :to="item.link"
                >
                    <v-btn text v-if="item.show">
                        {{ item.title }}
                    </v-btn>
                </router-link>
            </div>
        </v-toolbar>
    </v-card>
</template>

<script>
import AppNotification from "./AppNotification";
export default {
    components: { AppNotification },
    data() {
        return {
            items: [
                { title: "Forum", link: "/forum", show: true },
                { title: "Ask", link: "/ask", show: User.loggedIn() },
                { title: "Category", link: "/category", show: User.loggedIn() },
                { title: "Login", link: "/login", show: !User.loggedIn() },
                { title: "Logout", link: "/logout", show: User.loggedIn() }
            ],

            loggedIn: User.loggedIn()
        };
    },
    created() {
        EventBus.$on("logout", () => {
            User.logOut();
        });
    }
};
</script>

<style></style>
