<script>
export default {
    props: ["model"],
    data() {
        return {
            inputs: {
                email: this.model.email || ''
            },
            errors: {
                email: {
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
            return false;
        }
    }
}
</script>