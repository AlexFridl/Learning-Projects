<template>
<div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-4">
            <edit-text-input :title="reminder.description" :smallText="'Opis'" :endpoint="'/vehicles/' + reminder.vehicle_id + '/reminders/' + reminder.id" :field="'description'" :required="true">
            </edit-text-input>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-4">
            <edit-date-input :title="reminder.date" :titleFormatted="reminder.formattedDate" :smallText="'Datum'" :endpoint="'/vehicles/' + reminder.vehicle_id + '/reminders/' + reminder.id" :field="'date'" :fieldFormatted="'formattedDate'" :required="true">
            </edit-date-input>
        </div>
        <div class="col-lg-4 mb-4">
            <edit-text-input :title="reminder.price" :smallText="'Cena'" :endpoint="'/vehicles/' + reminder.vehicle_id + '/reminders/' + reminder.id" :field="'price'" :required="true" :regex="/^[0-9]+$/">
            </edit-text-input>
        </div>
        <div class="col-lg-4 mb-4">
            <edit-text-input :title="reminder.notify_days" :smallText="'Obavesti me ranije'" :endpoint="'/vehicles/' + reminder.vehicle_id + '/reminders/' + reminder.id" :field="'notify_days'" :required="true" :regex="/^[0-9]+$/">
            </edit-text-input>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <edit-checkbox :title="'Obaveštenje na email'" :subtitle="'Ukoliko želite da Vam obaveštenje stigne na Vaš email.'" :value="reminder.notify_email" :endpoint="'/vehicles/' + reminder.vehicle_id + '/reminders/' + reminder.id" :field="'notify_email'">
            </edit-checkbox>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12 mb-0">
            <delete-confirmation :endpoint="'/vehicles/' + reminder.vehicle_id + '/reminders/' + reminder.id" inline-template>
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
    props: ["reminder"],
};
</script>
