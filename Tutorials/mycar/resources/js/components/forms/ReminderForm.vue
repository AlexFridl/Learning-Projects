<script>
export default {
    props: ["model"],
    data() {
        return {
            inputs: {
                description: this.model.description || "",
                date: this.model.date || null,
                notifyEmail: this.model.notify_email || 0,
                notifyDays: this.model.notify_days || "0",
                price: this.model.price || "",
            },
            errors: {
                description: {
                    status: false,
                    message: "",
                },
                date: {
                    status: false,
                    message: "",
                },
                notifyEmail: {
                    status: false,
                    message: "",
                },
                notifyDays: {
                    status: false,
                    message: "",
                },
                price: {
                    status: false,
                    message: "",
                },
            },
        };
    },
    methods: {
        validate: function (e) {
            for (let key in this.errors) {
                this.errors[key].status = false;
            }

            if (!this.inputs.description || this.inputs.description == "") {
                this.errors.description.status = true;
                this.errors.description.message = "Morate uneti opis.";
            }

            if (!this.inputs.date || this.inputs.date == "") {
                this.errors.date.status = true;
                this.errors.date.message = "Morate uneti datum.";
            }

            if (!this.inputs.notifyDays || this.inputs.notifyDays == "") {
                this.errors.notifyDays.status = true;
                this.errors.notifyDays.message =
                    "Morate uneti broj dana za notifikaciju.";
            } else if (!this.inputs.notifyDays.match(/^[0-9]*$/)) {
                this.errors.notifyDays.status = true;
                this.errors.notifyDays.message =
                    "Broj dana mora biti pozitivan ceo broj ili 0.";
            }

            if (!this.inputs.price || this.inputs.price == "") {
                this.errors.price.status = true;
                this.errors.price.message = "Morate uneti cenu.";
            } else if (!this.inputs.price.match(/^[0-9]+$/)) {
                this.errors.price.status = true;
                this.errors.price.message = "Cena mora biti pozitivan ceo broj ili nula.";
            }

            if (Object.values(this.errors).some((element) => element.status)) {
                e.preventDefault();
            }
        },
        isInvalid(input) {
            return this.errors[input].status ? "is-invalid" : "";
        },
    },
    computed: {
        isDisabled() {
            if (!this.inputs.description || this.inputs.description == "") {
                return true;
            }

            if (!this.inputs.date || this.inputs.date == "") {
                return true;
            }

            if (!this.inputs.notifyDays || this.inputs.notifyDays == "") {
                return true;
            }

            if (!this.inputs.price || this.inputs.price == "") {
                return true;
            }

            if (!this.inputs.price.match(/^[0-9]+$/)) {
                return true;
            }
            if (!this.inputs.notifyDays.match(/^[0-9]+$/)) {
                return true;
            }

            return false;
        },
    },
};
</script>
