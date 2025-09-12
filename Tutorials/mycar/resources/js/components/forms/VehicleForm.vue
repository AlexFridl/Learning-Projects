<script>
export default {
    props: ["model"],
    data() {
        return {
            inputs: {
                make: this.model.make || '',
                model: this.model.model || '',
                registration: this.model.registration_number || ''
            },
            errors: {
                make: {
                    status: false,
                    message: ''
                },
                model: {
                    status: false,
                    message: ''
                },
                registration: {
                    status: false,
                    message: ''
                },
            }
        }
    },
    methods: {
        validate: function(e){
            for(let key in this.errors){
                this.errors[key].status = false;
            }

            if(!this.inputs.make || this.inputs.make == ''){
                this.errors.make.status = true;
                this.errors.make.message = 'Morate uneti marku.';
            }

            if(!this.inputs.model || this.inputs.model == ''){
                this.errors.model.status = true;
                this.errors.model.message = 'Morate uneti model.';
            }

            if(!this.inputs.registration || this.inputs.registration == ''){
                this.errors.registration.status = true;
                this.errors.registration.message = 'Morate uneti broj tablice.';
            } else if(!this.inputs.registration.match(/^[A-ZŠĐČĆŽ]{2}[0-9]{3,5}[A-ZŠĐČĆŽ]{2}$/)){
                this.errors.registration.status = true;
                this.errors.registration.message = 'Broj tablice nije u ispravnom formatu.';
            }

            if(Object.values(this.errors).some(element => element.status)){
                e.preventDefault();
            }
        },
        isInvalid(input){
            return this.errors[input].status ? 'is-invalid' : '';
        }
    },
    computed: {
        isDisabled(){
            if(Object.values(this.inputs).some(element => element == '' || !element)){
                return true;
            }
            if(!this.inputs.registration.match(/^[A-ZŠĐČĆŽ]{2}[0-9]{3,5}[A-ZŠĐČĆŽ]{2}$/)){
                return true;
            }
            return false;
        }
    }
}
</script>