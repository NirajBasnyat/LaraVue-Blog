<template>
    <div>
        <div v-if="!editMode">
            <v-card
                v-for="(reply, index) in computedReplies"
                :key="reply.id"
                class="mt-2"
            >
                <v-card-subtitle class="pb-0">
                    By {{ reply.user }}, {{ reply.created_at }}
                </v-card-subtitle>
                <v-divider></v-divider>

                <v-card-text class="text--primary pt-4">
                    <div v-if="!editMode">
                        <div class="h6" v-html="reply.body"></div>

                        <v-card-actions v-if="isMyReply(reply.user_id)">
                            <v-btn
                                x-small
                                color="red"
                                @click="deleteReply(index)"
                            >
                                Delete
                            </v-btn>
                            <v-btn
                                x-small
                                color="blue"
                                @click="editReply(index, reply.id)"
                            >
                                Edit
                            </v-btn>
                        </v-card-actions>
                    </div>
                </v-card-text>
            </v-card>
        </div>

        <div>
            <edit-reply :reply="edit_reply" v-if="editMode"></edit-reply>
        </div>

        <create-reply class="mt-3" v-if="!editMode"></create-reply>
    </div>
</template>

<script>
import CreateReply from "./CreateReply";
import EditReply from "./EditReply";
export default {
    props: ["replies"],

    components: { EditReply, CreateReply },

    data() {
        return {
            all_replies: "",
            slug: "",
            edit_reply: "",
            editMode: false
        };
    },

    created() {
        this.listenEvent();
        this.slug = this.$route.params.slug;
    },

    computed: {
        computedReplies: function() {
            this.all_replies = this.replies;
            return this.all_replies;
        },
        body(reply_body) {
            return md.parse(reply_body);
        }
    },

    methods: {
        isMyReply(user_id) {
            return User.amIOwner(user_id);
        },
        listenEvent() {
            //generated from createReply.vue

            EventBus.$on("reply_created", reply => {
                this.all_replies = this.all_replies.unshift(reply);
            });

            EventBus.$on("edit_complete", res => {
                this.editMode = false;
               // this.all_replies = res;
            });
        },

        deleteReply(index) {
            axios
                .delete(
                    `/api/question/${this.slug}/reply/${this.all_replies[index].id}`
                )
                .then(res => {
                    this.all_replies.splice(index, 1);
                });
        },

        editReply(index, reply_id) {
            this.editMode = true;
            this.edit_reply = this.all_replies.find(r => {
                return r.id == reply_id;
            });
        }
    }
};
</script>

<style></style>
