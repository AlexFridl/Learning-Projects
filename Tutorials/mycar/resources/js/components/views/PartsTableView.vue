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
                    <label>Kategorija:</label>
                    <select v-model="filters.type" @change="filtersChange" class="custom-select">
                        <option value="0">Sve</option>
                        <option v-for="(type, index) in partTypes" :key="index" :value="type.id">{{type.name}}</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Menjanje:</label>
                    <select v-model="filters.change" @change="filtersChange" class="custom-select">
                        <option value="2">Sve</option>
                        <option value="1">Da</option>
                        <option value="0">Ne</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Datum / kilometraža:</label>
                    <select v-model="display" class="custom-select">
                        <option value="0">Datum</option>
                        <option value="1">Kilometraža</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Sortiranje:</label>
                    <select v-model="filters.sort" @change="filtersChange" class="custom-select">
                        <option value="0">Za menjanje prvo</option>
                        <option value="1">Za menjanje na kraju</option>
                        <option value="2">Datum (opadajuće)</option>
                        <option value="3">Datum (rastuće)</option>
                    </select>
                </div>
            </div>
        </transition>
    </div>
    <table-view-row v-for="(part, index) in parts" :key="index" :topLeft="part.part_type.name" :bottomLeft="part.name" :topRight="display != 0 ? part.formattedMileage : part.formattedDate" :bottomRight="part.formattedPrice" :special="part.change" :link="`/vehicles/${vehicleId}/parts/${part.id}`"></table-view-row>
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
    props: ["vehicleId", "partTypes"],
    data() {
        return {
            parts: [],
            filters: {
                type: 0,
                change: 2,
                sort: 0,
            },
            display: 0,
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
                    this.parts.push(...data.data);
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
            this.parts = [];
            this.fetch(this.endpoint);
        },
    },
    computed: {
        endpointParams() {
            return `type=${this.filters.type}&change=${this.filters.change}&sort=${this.filters.sort}`;
        },
        endpoint() {
            return `/vehicles/${this.vehicleId}/parts/fetch?${this.endpointParams}`;
        },
    },
};
</script>
