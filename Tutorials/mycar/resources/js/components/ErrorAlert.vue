<template>

</template>

<script>
export default {
    props: ["message"],
    created() {
        this.$toast.error(this.message, "Greška!", {});
    }
}
</script>
