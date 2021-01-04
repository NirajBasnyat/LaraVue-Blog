<template>
    <v-app>
        <v-container fluid>
            <v-card class="pa-2 mb-5" outlined tile v-if="question">
                <v-card-title>
                    {{ question.title }}
                    <v-spacer></v-spacer>

                    <v-card-actions v-if="myQuestion">
                        <router-link
                            :to="{
                                name: 'EditQuestion',
                                params: { slug: question.slug }
                            }"
                        >
                            <v-btn color="blue" x-small class="mb-1 mr-2">
                                Edit
                            </v-btn>
                        </router-link>

                        <v-btn color="red" @click="deleteQuestion" x-small>
                            Delete
                        </v-btn>
                    </v-card-actions>
                </v-card-title>

                <v-card-subtitle class="pb-0">
                    By {{ question.user }}, {{ question.created_at }}
                </v-card-subtitle>

                <v-card-text class="text--primary pt-4">
                    <div class="h6" v-html="body"></div>
                </v-card-text>

                <v-btn color="teal" small> {{ replyCount }} replies </v-btn>
            </v-card>

            <!-- ------------------------------Replies Section--------------------------------------------- -->

            <all-replies :replies="question.replies"></all-replies>
        </v-container>
    </v-app>
</template>

<script>
import AllReplies from "../reply/AllReplies";

export default {
    components: { AllReplies },
    data() {
        return {
            question: "",
            myQuestion: "",
            replyCount: ""
        };
    },

    computed: {
        body() {
            return User.bodyHelper(this.question.body);
            // return md.parse(this.question.body);
        }
    },

    methods: {
        deleteQuestion() {
            axios
                .delete(`/api/question/${this.question.slug}`)
                .then(res => {
                    this.$router.push("/forum");
                })
                .catch(error => console.log(error.response.data.errors));
        }
    },

    created() {
        axios
            .get(`/api/question/${this.$route.params.slug}`)
            .then(res => {
                this.replyCount = res.data.data.reply_count;
                this.question = res.data.data;
                this.myQuestion = User.amIOwner(this.question.user_id);
            })
            .catch(error => {
                console.log(error.response.data);
            });

        EventBus.$on("reply_created", () => {
            this.replyCount += 1;
        });

        EventBus.$on("reply_deleted", () => {
            this.replyCount -= 1;
        });
    }
};
</script>

<style></style>
