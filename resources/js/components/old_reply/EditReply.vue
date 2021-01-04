<template>
    <v-form @submit.prevent="updateReply">
        <vue-simplemde v-model="edit_body" />
        <v-btn color="green" class="mr-4" type="submit">
            update reply
        </v-btn>
    </v-form>
</template>

<script>
export default {
    props: ["reply"],
    data() {
        return {
            edit_body: "",
            slug: ""
            //reply_id: ""
        };
    },
    created() {
        this.slug = this.$route.params.slug;
        this.edit_body = this.reply.body;
        // this.reply_id = this.reply.id;
    },
    methods: {
        updateReply() {
            axios
                .patch(`/api/question/${this.slug}/reply/${this.reply.id}`, {
                    body: this.edit_body
                    //  id: this.reply_id
                })
                .then(res => {
                    console.log(res);
                    /*    EventBus.$emit("edit_complete", res);
                    window.scrollTo(0, 0);
                    this.edit_body = ""; */
                    //this.$router.push(this.slug);
                });
        }
    }
};
</script>

<style></style>
