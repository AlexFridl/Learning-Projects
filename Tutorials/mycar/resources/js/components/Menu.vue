<template>
<div>
    <div ref="myNav" class="overlay">

        <a class="closebtn" @click="closeNav()"><i class="fas fa-times fa-2x"></i></a>

        <div class="overlay-content">
            <a v-if="admin" href="/admin">Statistike</a>
            <a href="/vehicles">Vozila</a>
            <a href="/nearby">Mapa</a>
            <a href="/profile">Profil</a>
            <a href="/logout" @click.prevent="logout">Odjavite se</a>
            <form ref="logoutForm" action="/logout" method="POST" class="d-none">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>

    </div>

    <span @click="openNav()" class="openbtn">
        <i class="mt-3 fas fa-bars fa-lg"></i>
    </span>
</div>
</template>

<script>
export default {
    props: ["admin"],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        }
    },
    methods: {
        closeNav() {
            this.$refs.myNav.style.width = "0%";
        },
        openNav() {
            this.$refs.myNav.style.width = "100%";
        },
        logout() {
            this.$refs.logoutForm.submit();
        }
    }
}
</script>
