<template>
    <v-card class="pa-2" outlined tile>
        <v-card-title>
            <router-link :to="data.path">
                {{ data.title }}
            </router-link>
        </v-card-title>

        <v-card-subtitle class="pb-0">
            By {{ data.user }}, {{ data.created_at }}
        </v-card-subtitle>

        <v-card-text class="text--primary pt-4">
            <div class="h6">{{ data.body }}</div>
        </v-card-text>

       
    </v-card>
</template>

<script>
export default {
    props: ["data"]
};
</script>

<style></style>
