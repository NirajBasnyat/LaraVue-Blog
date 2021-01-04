<template>
    <v-form @submit.prevent="AddReply">
        <vue-simplemde v-model="create_body" />
        <v-btn color="green" class="mr-4" type="submit">
            post reply
        </v-btn>
    </v-form>
</template>

<script>
export default {
    data() {
        return {
            create_body: "",
            slug: ""
        };
    },
    created() {
        this.slug = this.$route.params.slug;
    },
    methods: {
        AddReply() {
            axios
                .post(`/api/question/${this.slug}/reply`, {
                    body: this.create_body
                })
                .then(res => {
                    EventBus.$emit("reply_created", res.data.reply);
                    window.scrollTo(0, 0);
                    this.create_body = "";
                });
        }
    }
};
</script>

<style></style>
