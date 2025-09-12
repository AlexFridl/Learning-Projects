<template>
<div class="info-card">
    <div>
        <h4>{{smallText}}</h4>
        <h2 v-if="!editing">{{name}}</h2>
        <select v-else v-model="input" class="custom-select mb-1" :class="showError ? 'is-invalid' : ''">
            <option v-for="(option, index) in options" :key="index" :value="option.id">{{option.name}}</option>
        </select>
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
    props: ["title", "smallText", "endpoint", "field", "nameField", "value", "options", "required"],
    data() {
        return {
            editing: false,
            name: this.title,
            input: this.value,
            cache: this.value,
            errors: {
                required: "Morate izabrati nešto iz liste."
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
                this.name = data[this.nameField]['name'];
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
                if (this.input == '' || this.input == null || this.input == 0) {
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
