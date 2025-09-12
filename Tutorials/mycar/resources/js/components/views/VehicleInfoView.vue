<template>
<div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <edit-text-input 
                :title="vehicle.make" 
                :smallText="'Marka'" 
                :endpoint="'/vehicles/' + vehicle.id" 
                :field="'make'"
                :required="true"
            >
            </edit-text-input>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <edit-text-input 
                :title="vehicle.model" 
                :smallText="'Model'" 
                :endpoint="'/vehicles/' + vehicle.id" 
                :field="'model'"
                :required="true"
            >
            </edit-text-input>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <edit-text-input 
                :title="vehicle.registration_number" 
                :smallText="'Broj tablica'" 
                :endpoint="'/vehicles/' + vehicle.id" 
                :field="'registration_number'"
                :required="true"
                :regex="/^[A-ZŠĐČĆŽ]{2}[0-9]{3,5}[A-ZŠĐČĆŽ]{2}$/"
            >
            </edit-text-input>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12 mb-0">
            <delete-confirmation :endpoint="'/vehicles/' + vehicle.id" inline-template>
                <form @submit="confirm" ref="form" :action="endpoint" method="POST">
                    <input type="hidden" :value="csrf" name="_token" />
                    <input type="hidden" value="DELETE" name="_method" />
                    <button class="btn btn-danger w-100">BRISANJE</button>
                </form>
            </delete-confirmation>
        </div>
    </div>
</div>
</template>

<script>
import EditTextInput from "../inputs/EditTextInput";
export default {
    components: {
        EditTextInput,
    },
    props: ["vehicle"],
};
</script>
