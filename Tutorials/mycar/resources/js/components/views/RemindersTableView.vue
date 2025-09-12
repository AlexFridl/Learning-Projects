<template>
<div v-infinite-scroll="loadMore" class="custom-table mt-3">
    <div class="mb-4 pt-2 pb-1 filters">
        <div @click="filtersShow = !filtersShow" class="text-center w-100 toggle">
            <h5>
                Filtriranje i sortiranje
                <i class="fas fa-caret-down filter-arrow" :class="filtersShow ? 'rotate-180' : ''"></i>
            </h5>
        </div>
        <transition name="slide">
            <div v-if="filtersShow" class="pb-3 pt-1 px-4 row">
                <div class="col-lg-3">
                    <label>Uskoro ističe:</label>
                    <select v-model="filters.expiresSoon" @change="filtersChange" class="custom-select">
                        <option value="2">Sve</option>
                        <option value="1">Da</option>
                        <option value="0">Ne</option>
                        <option value="3">Isteklo</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Notifikacija:</label>
                    <select v-model="filters.notify" @change="filtersChange" class="custom-select">
                        <option value="2">Sve</option>
                        <option value="0">Samo u aplikaciji</option>
                        <option value="1">I na email-u</option>
                    </select>
                </div>
                <div class="col-lg-3 offset-lg-3">
                    <label>Sortiranje:</label>
                    <select v-model="filters.sort" @change="filtersChange" class="custom-select">
                        <option value="0">Datum (rastuće)</option>
                        <option value="1">Datum (opadajuće)</option>
                    </select>
                </div>
            </div>
        </transition>
    </div>
    <table-view-row v-for="(reminder, index) in reminders" :key="index" :topLeft="''" :bottomLeft="reminder.description" :topRight="(reminder.expired ? 'isteklo ' : '') + reminder.formattedDate" :bottomRight="reminder.formattedPrice" :special="reminder.expiresSoon" :link="`/vehicles/${vehicleId}/reminders/${reminder.id}`"></table-view-row>
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
    props: ["vehicleId"],
    data() {
        return {
            reminders: [],
            filters: {
                expiresSoon: 2,
                notify: 2,
                sort: 0,
            },
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
                    this.reminders.push(...data.data);
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
        },
        filtersChange() {
            this.reminders = [];
            this.fetch(this.endpoint);
        },
    },
    computed: {
        endpointParams() {
            return `expiresSoon=${this.filters.expiresSoon}&notify=${this.filters.notify}&sort=${this.filters.sort}`;
        },
        endpoint() {
            return `/vehicles/${this.vehicleId}/reminders/fetch?${this.endpointParams}`;
        },
    },
};
</script>
