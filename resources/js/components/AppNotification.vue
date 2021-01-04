<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn color="primary" dark v-bind="attrs" v-on="on" x-small>
                    Notifications {{ unread_count }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item
                    v-for="(notification, index) in unread_notifications"
                    :key="index"
                >
                    <router-link :to="notification.path">
                        <v-list-item-title @click="markAsRead(notification)">
                            {{ notification.question }}
                        </v-list-item-title>
                    </router-link>
                </v-list-item>

                <v-list-item
                    v-for="(notification, index) in read_notifications"
                    :key="index"
                >
                    <v-list-item-title>
                        {{ notification.question }}
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
export default {
    data() {
        return {
            read_notifications: {},
            unread_notifications: {},
            unread_count: 0
        };
    },

    created() {
        if (User.loggedIn()) {
            this.getNotifications();
        }

        Echo.private("App.User." + User.id()).notification(notification => {
            this.unread_notifications.unshift(notification);
            this.unread_count += 1;
        });
    },

    methods: {
        getNotifications() {
            axios
                .post(`/api/notifications`)
                .then(res => {
                    this.read_notifications = res.data.read;
                    this.unread_notifications = res.data.unread;
                    this.unread_count = res.data.unread.length;
                })
                .catch(error => Exception.handle(error));
        },
        markAsRead(notification) {
            axios.post(`/api/markAsRead`, { id: notification.id }).then(res => {
                this.unread_notifications.splice(notification, 1);
                this.read_notifications.push(notification);
                this.unread_count -= 1;
            });
        }
    }
};
</script>

<style></style>
