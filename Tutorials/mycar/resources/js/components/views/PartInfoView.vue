<template>
<div>
    <div class="row mt-4">
        <div class="col-lg-8 mb-4">
            <edit-text-input 
                :title="part.name" 
                :smallText="'Naziv'" 
                :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" 
                :field="'name'"
                :required="true"
            >
            </edit-text-input>
        </div>
        <div class="col-lg-4 mb-4">
            <edit-select 
                :title="part.part_type.name" 
                :smallText="'Kategorija'" 
                :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" 
                :field="'part_type_id'" 
                :name-field="'part_type'" 
                :value="part.part_type_id" 
                :options="partTypes"
                :required="true"
            >
            </edit-select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-3">
            <edit-date-input 
                :title="part.date" 
                :titleFormatted="part.formattedDate" 
                :smallText="'Datum'" 
                :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" 
                :field="'date'" 
                :fieldFormatted="'formattedDate'"
                :required="true"
            >
            </edit-date-input>
        </div>
        <div class="col-lg-4 mb-3">
            <edit-text-input 
                :title="part.mileage" 
                :smallText="'Kilometraža'" 
                :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" 
                :field="'mileage'"
                :required="true"
                :regex="/^[1-9]{1}[0-9]*$/"
            >
            </edit-text-input>
        </div>
        <div class="col-lg-4 mb-3">
            <edit-text-input 
                :title="part.price" 
                :smallText="'Cena'" 
                :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" 
                :field="'price'"
                :required="true"
                :regex="/^[1-9]{1}[0-9]*$/"
            >
            </edit-text-input>
        </div>
    </div>
    <div class="row">
            <div class="col-12 mb-3">
                <edit-checkbox 
                    :title="'Menjanje'" 
                    :subtitle="'Obeležite deo kojem je potrebna zamena.'" 
                    :value="part.change" 
                    :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" 
                    :field="'change'"
                >
                </edit-checkbox>
            </div>
        </div>

    <div class="row">
        <div class="form-group col-12 mb-0">
            <delete-confirmation :endpoint="'/vehicles/' + part.vehicle_id + '/parts/' + part.id" inline-template>
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
import EditDateInput from "../inputs/EditDateInput";
import EditSelect from "../inputs/EditSelect";
import EditCheckbox from "../inputs/EditCheckbox";
export default {
    components: {
        EditTextInput,
        EditDateInput,
        EditSelect,
        EditCheckbox,
    },
    props: ["part", "partTypes"],
};
</script>
