<script>
export default {
    props: ["old", "email"],
    data() {
        return {
            inputs: {
                password: '',
                passwordConfirmation: ''
            },
            errors: {
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
            
            if(!this.inputs.password || this.inputs.password == ''){
                this.errors.password.status = true;
                this.errors.password.message = 'Morate uneti lozinku.';
            } else if(this.inputs.password.length < 8) {
                this.errors.password.status = true;
                this.errors.password.message = 'Lozinka mora biti najmanje 8 karaktera.';
            } else if(this.inputs.password != this.inputs.passwordConfirmation){
                this.errors.password.status = true;
                this.errors.password.message = 'Lozinka i ponovna lozinka nisu iste.';
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
            if(this.inputs.password == '' || !this.inputs.password){
                return true;
            }
            return false;
        }
    },
}
</script>