<template>
    <div>
        <single-reply
            v-for="(reply, index) in computedReplies"
            :key="reply.id"
            :reply="reply"
            :index="index"
        ></single-reply>

        <create-reply v-if="loggedIn"></create-reply>
    </div>
</template>

<script>
import SingleReply from "./SingleReply";
import CreateReply from "./CreateReply";

export default {
    components: { SingleReply, CreateReply },

    props: ["replies"],

    data() {
        return {
            all_replies: "",
            loggedIn: User.loggedIn()
        };
    },

    computed: {
        computedReplies: function() {
            this.all_replies = this.replies;
            return this.all_replies;
        }
    },

    created() {
        this.listenEvent();
    },

    methods: {
        listenEvent() {
            EventBus.$on("reply_created", reply => {
                this.all_replies = this.all_replies.unshift(reply);
            });

            EventBus.$on("reply_deleted", index => {
                this.all_replies.splice(index, 1);
            });

            Echo.private("App.User." + User.id()).notification(notification => {
                // console.log(notification.type);
                this.all_replies.unshift(notification.reply);
            });

            Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
                for (let index = 0; index < this.all_replies.length; index++) {
                    if (this.all_replies[index].id == e.id) {
                        this.all_replies.splice(index, 1);
                    }
                }
            });
        }
    }
};
</script>

<style></style>
