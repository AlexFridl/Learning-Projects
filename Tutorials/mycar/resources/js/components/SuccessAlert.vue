<template>

</template>

<script>
export default {
    props: ["message"],
    created() {
        this.$toast.success(this.message, "Uspeh!", {});
    }
}
</script>
