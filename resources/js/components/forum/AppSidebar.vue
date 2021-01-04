<template>
    <v-app>
        <v-container>
            <v-card max-width="450" dense>
                <v-toolbar color="cyan" dark>
                    <v-toolbar-title>Categories</v-toolbar-title>
                </v-toolbar>

                <v-list>
                    <v-list-item
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <v-list-item-content class="text-center">
                            {{ category.name }}
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            categories: {}
        };
    },

    created() {
        axios
            .get(`/api/category`)
            .then(res => (this.categories = res.data.data));
    }
};
</script>

<style></style>
