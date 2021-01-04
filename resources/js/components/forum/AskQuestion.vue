<template>
    <v-app>
        <v-container>
            <v-form ref="form" @submit.prevent="createQuestion">
                <v-text-field
                    v-model="form.title"
                    type="text"
                    label="Title"
                    required
                ></v-text-field>

                <v-select
                    :items="categories"
                    item-value="id"
                    item-text="name"
                    v-model="form.category_id"
                    :menu-props="{ top: true, offsetY: true }"
                    label="Select Category"
                ></v-select>

                <vue-simplemde v-model="form.body" />

                <v-btn color="green" class="mr-4" type="submit">
                    {{ buttonName }}
                </v-btn>
            </v-form>
        </v-container>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            buttonName: "Create",
            form: {
                title: "",
                category_id: "",
                body: ""
            },
            categories: {}
        };
    },

    mounted() {
        if (this.$route.params.slug) {
            this.buttonName = "Update";
            axios
                .get(`/api/question/${this.$route.params.slug}`)
                .then(res => {
                    this.form = res.data.data;
                    console.log(res.data.data);
                })
                .catch(error => console.log(error.response.data.error));
        }
    },

    created() {
        if (!User.loggedIn()) {
            this.$router.push("/forum");
        }

        axios
            .get(`/api/category`)
            .then(res => (this.categories = res.data.data))
            .catch(error => console.log(error.response.data));
    },
    methods: {
        createQuestion() {
            if (this.$route.params.slug) {
                axios
                    .put(`/api/question/${this.$route.params.slug}`, this.form)
                    .then(res => {
                        this.$router.push(res.data.path);
                        console.log(res.data.path);
                    })
                    .catch(error => console.log(error));
            } else {
                axios
                    .post(`/api/question`, this.form)
                    .then(res => this.$router.push(res.data.path))
                    .catch(error => console.log(error.response.data.error));
            }
        }
    }
};
</script>

<style></style>
