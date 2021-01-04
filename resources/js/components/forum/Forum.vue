<template>
    <v-app>
        <v-container>
            <v-row>
                <v-col cols="12" md="8">
                    <Question
                        v-for="question in questions"
                        :key="question.path"
                        :data="question"
                    >
                    </Question>
                </v-col>

                <v-col cols="12" md="4">
                    <app-sidebar></app-sidebar>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
import AppSidebar from "./AppSidebar";
import Question from "./Question";
export default {
    data() {
        return {
            questions: {}
        };
    },
    components: {
        Question,
        AppSidebar
    },
    created() {
        axios
            .get(`api/question`)
            .then(res => {
                this.questions = res.data.data;
            })
            .catch(error => {
                console.log(error.response.data);
            });
    }
};
</script>

<style></style>
