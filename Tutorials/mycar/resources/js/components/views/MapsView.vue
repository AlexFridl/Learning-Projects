<template>
<div class="container">
    <div class="row">
        <div class="col-6">
            <select @change="filterChanged" v-model="type" class="custom-select">
                <option value="gas_station">Pumpe</option>
                <option value="car_repair">Auto servisi</option>
            </select>
        </div>
        <div class="col-6">
            <select @change="filterChanged" v-model="radius" class="custom-select">
                <option value="5000">5 km</option>
                <option value="10000">10 km</option>
                <option value="20000">20 km</option>
                <option value="50000">50 km</option>
            </select>
        </div>
    </div>
    <GmapMap :center="{lat, lng}" :zoom="13" class="map mt-2">
        <GmapMarker :key="index" v-for="(place, index) in places" :position="place.geometry.location" :clickable="true" :draggable="false" @click="center=m.position" />
    </GmapMap>
    <div ref="map"></div>
</div>
</template>

<script>
export default {
    data() {
        return {
            type: 'gas_station',
            radius: 5000,
            lat: 0,
            lng: 0,
            places: [],
            //map: google.maps.Map
        }
    },
    created() {
        this.getLocation();
    },
    methods: {
        getLocation() {
            navigator.geolocation.getCurrentPosition(
                position => {
                    this.lat = position.coords.latitude;
                    this.lng = position.coords.longitude;
                    this.getNearby();
                },
                error => {
                    this.$toast.error("Došlo je do greške.", "Greška!", {});
                }
            )
        },
        getNearby() {
            axios.get(this.endpoint)
                .then(({
                    data
                }) => {
                    this.places = data.results;
                })
                .catch(error => {
                    this.$toast.error("Došlo je do greške.", "Greška!", {});
                });
        },
        filterChanged() {
            this.getNearby();
        }
    },
    computed: {
        endpoint() {
            return `https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=${this.lat},${this.lng}&type=${this.type}&radius=${this.radius}&key=AIzaSyDAur5lE8xfHtszjEp-eXgtyeTGG35bc7c`;
        }
    }
}
</script>
