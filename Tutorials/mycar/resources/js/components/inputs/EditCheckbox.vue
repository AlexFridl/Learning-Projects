<template>
<div class="info-card">
    <div>
        <div>
            <h2>{{title}}</h2>
        </div>
        <div>
            <h4>{{subtitle}}</h4>
        </div>
    </div>
    <div>
        <input v-model="checked" @change="accept" type="checkbox" />
    </div>
</div>
</template>

<script>
export default {
    props: ["title", "subtitle", "value", "endpoint", "field"],
    data() {
        return {
            checked: this.value,
            cache: this.value,
        };
    },
    methods: {
        accept() {
            axios
                .put(this.endpoint, {
                    [this.field]: this.checked,
                })
                .then(({
                    data
                }) => {
                    this.checked = data[this.field];
                    this.cache = data[this.field];
                })
                .catch((err) => {
                    if (err.response.status == 422) {
                        this.$toast.error(err.response.data[this.field][0], "Greška!", {});
                    }
                    if (err.response.status == 500) {
                        this.$toast.error(err.response.data.errorMessage, "Greška!", {});
                    }
                    this.checked = this.cache;
                });
        },
    },
};
</script>
