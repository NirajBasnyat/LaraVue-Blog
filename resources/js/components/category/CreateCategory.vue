<template>
    <v-app>
        <v-container>
            <v-form ref="form" @submit.prevent="submitForm">
                <v-text-field
                    v-model="form.name"
                    type="text"
                    label="Category Name"
                    required
                ></v-text-field>

                <v-btn color="teal" class="mr-4 mb-5" type="submit">
                    {{ editSlug ? "Update" : "Create" }}
                </v-btn>
            </v-form>

            <!-- ------------------------------------CARD--------------------------------------- -->
            <v-card dense>
                <v-toolbar color="cyan" dark>
                    <v-toolbar-title>Categories</v-toolbar-title>
                </v-toolbar>

                <v-list>
                    <v-list-item
                        v-for="(category, index) in categories"
                        :key="category.id"
                    >
                        <v-list-item-content class="text-center">
                            {{ category.name }}
                        </v-list-item-content>

                        <v-btn
                            x-small
                            color="red mr-1"
                            @click="deleteCategory(category.slug, index)"
                        >Delete
                        </v-btn
                        >
                        <v-btn
                            x-small
                            color="blue"
                            @click="editCategory(category.slug, index)"
                        >Edit
                        </v-btn
                        >
                    </v-list-item>
                </v-list>
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
    export default {
        name: "CreateCategory",
        data() {
            return {
                form: {
                    name: ""
                },
                editSlug: "",
                categories: {}
            };
        },
        created() {
            axios
                .get(`/api/category`)
                .then(res => (this.categories = res.data.data));
        },
        methods: {
            submitForm() {
                this.editSlug ? this.updateCategory() : this.createCategory();
            },

            createCategory() {
                axios.post(`/api/category`, this.form).then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                });
            },

            updateCategory() {
                axios
                    .patch(`/api/category/${this.editSlug}`, this.form)
                    .then(res => {
                        this.categories.unshift(res.data);
                        this.form.name = null;
                    });
            },

            deleteCategory(slug, index) {
                axios.delete(`/api/category/${slug}`).then(res => {
                    this.categories.splice(index, 1);
                });
            },

            editCategory(slug, index) {
                this.form.name = this.categories[index].name;
                this.categories.splice(index, 1);
                this.editSlug = slug;
            }
        }
    };
</script>

<style scoped></style>
