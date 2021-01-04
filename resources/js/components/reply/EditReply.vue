<template>
    <div>
        <vue-simplemde v-model="reply.body" />
        <v-card-actions>
            <v-btn color="green" class="m-2" small @click="updateReply">
                update
            </v-btn>

            <v-btn class="m-2" @click="cancel" small>
                cancel
            </v-btn>
        </v-card-actions>
    </div>
</template>

<script>
export default {
    props: ["reply"],

    data() {
        return {};
    },
    methods: {
        updateReply() {
            axios
                .patch(
                    `/api/question/${this.$route.params.slug}/reply/${this.reply.id}`,
                    {
                        body: this.reply.body
                    }
                )
                .then(res => {
                    this.cancel();
                });
        },

        cancel() {
            EventBus.$emit("stop_editing");
        }
    }
};
</script>

<style></style>
