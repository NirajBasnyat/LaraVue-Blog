<template>
    <v-app>
        <v-container>
            <v-form ref="form" @submit.prevent="editQuestion">
                <v-text-field
                    v-model="form.title"
                    type="text"
                    label="Title"
                    required
                ></v-text-field>

                <vue-simplemde v-model="form.body" />

                <v-btn color="green" class="mr-4" type="submit">
                    Edit
                </v-btn>
            </v-form>
        </v-container>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            form: ""
        };
    },
    created() {
        // console.log(this.$route.params.slug);
        axios
            .get(`/api/question/${this.$route.params.slug}`)
            .then(res => {
                this.form = res.data.data;
                console.log(res.data.data);
            })
            .catch(error => console.log(error.response.data.error));
    },
    methods: {
        editQuestion() {
            axios
                .put(`/api/question/${this.$route.params.slug}`, this.form)
                .then(res => this.$router.push(res.data.path))
                .catch(error => console.log(error));
        }
    }
};
</script>

<style></style>
