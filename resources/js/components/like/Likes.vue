<template>
    <div>
        <div v-if="loggedIn">
            <v-btn color="pink" x-small @click="likeBtn" v-if="liked === false"
                >Like ({{ count }})
            </v-btn>
            <v-btn color="blue" x-small @click="likeBtn" v-else
                >Liked ({{ count }})
            </v-btn>
        </div>

        <div v-else>
            <vbtn>{{ count }} likes</vbtn>
        </div>
    </div>
</template>

<script>
export default {
    props: ["reply"],
    data() {
        return {
            liked: this.reply.liked,
            count: this.reply.likes,
            loggedIn: User.loggedIn()
        };
    },

    created() {
        Echo.channel("likeChannel").listen("LikeEvent", e => {
            console.log(this.reply.id);
            console.log(e);
            if (this.reply.id == e.id) {
                e.type == 1 ? (this.count += 1) : (this.count -= 1);
            }
        });
    },
    methods: {
        likeBtn() {
            if (User.loggedIn()) {
                this.liked ? this.decrementCount() : this.incrementCount();
                this.liked = !this.liked;
            }
        },

        decrementCount() {
            axios.delete(`/api/like/${this.reply.id}`).then(res => {
                this.count -= 1;
            });
        },

        incrementCount() {
            axios.post(`/api/like/${this.reply.id}`).then(res => {
                this.count += 1;
            });
        }
    }
};
</script>

<style></style>
