<template>
<div v-infinite-scroll="loadMore" class="custom-table mt-3">
    <table-view-row v-for="(notification, index) in notifications" :key="index" :bottomLeft="notification.data.reminder.description" :topRight="'rok'" :bottomRight="notification.data.reminder.formattedDate" :special="notification.read_at == null ? true : false" :link="`/vehicles/${notification.data.reminder.vehicle_id}/reminders/${notification.data.reminder.id}`">
    </table-view-row>
    <div v-if="notifications.length == 0" class="d-flex justify-content-center">
        <h5>Nemate nijedno obaveštenje.</h5>
    </div>
    <div class="d-flex justify-content-center">
        <i v-show="spinner" class="fas fa-spinner fa-spin fa-3x"></i>
    </div>
</div>
</template>

<script>
import TableViewRow from "./TableViewRow";
export default {
    components: {
        TableViewRow,
    },
    data() {
        return {
            notifications: [],
            nextUrl: null,
            spinner: true,
            filtersShow: false,
        };
    },
    created() {
        this.fetch(this.endpoint);
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
        }
    },
    computed: {
        endpoint() {
            return `/notifications/fetch`;
        },
    },
};
</script>
