<script>
export default {
    props: ["model"],
    data() {
        return {
            inputs: {
                name: this.model.name || "",
                date: this.model.date || null,
                mileage: this.model.mileage || "",
                price: this.model.price || "",
                partTypeId: this.model.part_type_id || 0,
            },
            errors: {
                name: {
                    status: false,
                    message: "",
                },
                date: {
                    status: false,
                    message: "",
                },
                mileage: {
                    status: false,
                    message: "",
                },
                price: {
                    status: false,
                    message: "",
                },
                partTypeId: {
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

            if (
                !this.inputs.partTypeId ||
                this.inputs.partTypeId == "" ||
                this.inputs.partTypeId == 0
            ) {
                this.errors.partTypeId.status = true;
                this.errors.partTypeId.message = "Morate izabrati vrstu dela.";
            }

            if (!this.inputs.name || this.inputs.name == "") {
                this.errors.name.status = true;
                this.errors.name.message = "Morate uneti naziv.";
            }

            if (!this.inputs.date || this.inputs.date == "") {
                this.errors.date.status = true;
                this.errors.date.message = "Morate uneti datum.";
            }

            if (!this.inputs.mileage || this.inputs.mileage == "") {
                this.errors.mileage.status = true;
                this.errors.mileage.message = "Morate uneti kilometražu.";
            } else if (!this.inputs.mileage.match(/^[1-9]{1}[0-9]*$/)) {
                this.errors.mileage.status = true;
                this.errors.mileage.message =
                    "Kilometraža mora biti pozitivan ceo broj.";
            }

            if (!this.inputs.price || this.inputs.price == "") {
                this.errors.price.status = true;
                this.errors.price.message = "Morate uneti cenu.";
            } else if (!this.inputs.price.match(/^[1-9]{1}[0-9]*$/)) {
                this.errors.price.status = true;
                this.errors.price.message = "Cena mora biti pozitivan ceo broj.";
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
            if (
                Object.values(this.inputs).some(
                    (element) => element == "" || !element || element == 0
                )
            ) {
                return true;
            }
            if (!this.inputs.mileage.match(/^[1-9]{1}[0-9]*$/)) {
                return true;
            }
            if (!this.inputs.price.match(/^[1-9]{1}[0-9]*$/)) {
                return true;
            }
            return false;
        },
    },
};
</script>
