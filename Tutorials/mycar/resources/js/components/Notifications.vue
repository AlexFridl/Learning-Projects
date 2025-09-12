<template>
<div>
    <div ref="notifications" class="overlay" v-infinite-scroll="loadMore">

        <a class="closebtn" @click="closeNotifications()"><i class="fas fa-times fa-2x"></i></a>

        <div class="overlay-content notifications custom-table px-3">
            <div class="row mb-4">
                <div class="col-lg-4 offset-lg-4">
                    <a class="btn btn-outline-warning" href="/notifications">Sva obaveštenja</a>
                </div>
            </div>
            <table-view-row v-for="(notification, index) in notifications" :key="index" :bottomLeft="notification.data.reminder.description" :bottomRight="notification.data.reminder.formattedDate" :special="notification.read_at == null ? true : false" :link="`/vehicles/${notification.data.reminder.vehicle_id}/reminders/${notification.data.reminder.id}`">
            </table-view-row>
            <div v-if="notifications.length == 0" class="d-flex justify-content-center">
                <h5>Nemate nijedno novo obaveštenje.</h5>
            </div>
            <div class="d-flex justify-content-center">
                <i v-show="spinner" class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
        </div>

    </div>

    <span @click="openNotifications()" class="openbtn mr-3">
        <i class="mt-3 fas fa-bell fa-lg" :class="iconChange"></i>
    </span>
</div>
</template>

<script>
import TableViewRow from "./views/TableViewRow";
export default {
    components: {
        TableViewRow,
    },
    props: ["unread"],
    data() {
        return {
            notifications: [],
            nextUrl: null,
            spinner: true,
            firstFetch: true,
            unreadCount: 0
        };
    },
    created() {
        this.checkUnread();
    },
    methods: {
        fetch(url) {
            this.spinner = true;
            axios
                .get(url)
                .then(({
                    data
                }) => {
                    this.notifications.push(...data.data);
                    this.nextUrl = data.next_page_url;
                    this.spinner = false;
                    this.checkUnread();
                })
                .then((res) => {
                    if (window.innerHeight > document.body.scrollHeight) {
                        this.loadMore(this.nextUrl);
                    }
                });
        },
        loadMore() {
            if (this.nextUrl != null) {
                this.fetch(this.nextUrl);
            }
        },
        closeNotifications() {
            this.$refs.notifications.style.width = "0%";
        },
        openNotifications() {
            this.$refs.notifications.style.width = "100%";
            if (this.firstFetch) {
                this.fetch(this.endpoint);
                this.firstFetch = false;
            }
        },
        checkUnread() {
            axios.get('/notifications/checkUnread')
                .then(({
                    data
                }) => {
                    this.unreadCount = data;
                });
        }
    },
    computed: {
        endpoint() {
            return `/notifications/fetchUnread`;
        },
        iconChange() {
            return this.unreadCount ? 'text-warning' : '';
        }
    }
}
</script>
