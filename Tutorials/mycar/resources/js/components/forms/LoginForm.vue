<script>
export default {
    props: ["model"],
    data() {
        return {
            inputs: {
                email: this.model.email || '',
                password: '',
                remember: this.model.remember || false
            },
            errors: {
                email: {
                    status: false,
                    message: ''
                },
                password: {
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

            if(!this.inputs.email || this.inputs.email == ''){
                this.errors.email.status = true;
                this.errors.email.message = 'Morate uneti email.';
            }

            if(!this.inputs.password || this.inputs.password == ''){
                this.errors.password.status = true;
                this.errors.password.message = 'Morate uneti lozinku.';
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
            if(this.inputs.email == '' || !this.inputs.email){
                return true;
            }
            if(this.inputs.password == '' || !this.inputs.password){
                return true;
            }
            return false;
        }
    }
}
</script>