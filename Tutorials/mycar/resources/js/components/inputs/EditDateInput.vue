<template>
<div class="info-card">
    <div>
        <h4>{{smallText}}</h4>
        <h2 v-if="!editing">{{formatted}}</h2>
        <input v-else v-model="input" type="date" class="form-control mb-1" :class="showError ? 'is-invalid' : ''">
        <div v-cloak v-if="showError" v-html="error" class="invalid-feedback"></div>
    </div>
    <div>
        <i v-if="!editing" @click="editing = true" class="fas fa-edit fa-2x"></i>
        <div v-else>
            <i @click="accept" class="fas fa-check fa-2x text-success mr-4"></i>
            <i @click="cancel" class="fas fa-times fa-2x text-danger"></i>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["title", "titleFormatted", "smallText", "endpoint", "field", "fieldFormatted", "required"],
    data() {
        return {
            editing: false,
            formatted: this.titleFormatted,
            input: this.title,
            cache: this.title,
            errors: {
                required: "Polje ne sme biti prazno.",
            },
            error: '',
            showError: false
        }
    },
    methods: {
        accept() {
            const valid = this.validate();
            if (!valid) {
                return;
            }
            this.editing = false;
            axios.put(this.endpoint, {
                [this.field]: this.input
            }).then(({
                data
            }) => {
                this.formatted = data[this.fieldFormatted];
                this.input = data[this.field];
                this.cache = data[this.field];
            }).catch(err => {
                if (err.response.status == 422) {
                    this.$toast.error(err.response.data[this.field][0], "Greška!", {});
                }
                if (err.response.status == 500) {
                    this.$toast.error(err.response.data.errorMessage, "Greška!", {});
                }
                this.input = this.cache;
            });
        },
        cancel() {
            this.editing = false;
            this.input = this.cache;
            this.showError = false;
            this.error = '';
        },
        validate() {
            this.showError = false;
            this.error = '';
            if (this.required) {
                if (this.input == '' || this.input == null) {
                    this.showError = true;
                    this.error = this.errors.required;
                    return false;
                }
            }
            return true;
        }
    }
}
</script>
