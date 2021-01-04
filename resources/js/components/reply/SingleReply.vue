<template>
    <div>
        <v-card class="mt-2">
            <v-card-subtitle class="pb-0">
                By {{ reply.user }}, {{ reply.created_at }}

                <v-spacer></v-spacer>

                <Likes :reply="reply"></Likes>
            </v-card-subtitle>
            <v-divider></v-divider>

            <div v-if="editMode">
                <edit-reply :reply="reply"></edit-reply>
            </div>

            <div v-else>
                <v-card-text class="text--primary pt-4">
                    <div class="h6" v-html="reply.body"></div>
                </v-card-text>

                <v-card-actions v-if="isMyReply(reply.user_id)">
                    <v-btn x-small color="red" @click="deleteReply(index)">
                        Delete
                    </v-btn>
                    <v-btn x-small color="blue" @click="editReply">
                        Edit
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
    </div>
</template>

<script>
import EditReply from "./EditReply";
import Likes from "../like/Likes";
export default {
    props: ["reply", "index"],

    components: { EditReply, Likes },

    data() {
        return {
            slug: "",
            editMode: false,
         //   loggedIn: User.loggedIn()
        };
    },

    created() {
        this.listen();
    },

    methods: {
        isMyReply(user_id) {
            return User.amIOwner(user_id);
        },

        deleteReply(index) {
            axios
                .delete(
                    `/api/question/${this.$route.params.slug}/reply/${this.reply.id}`
                )
                .then(res => {
                    EventBus.$emit("reply_deleted", index);
                });
        },

        editReply() {
            this.editMode = true;
        },

        listen() {
            EventBus.$on("stop_editing", () => {
                this.editMode = false;
            });
        }
    }
};
</script>

<style></style>
