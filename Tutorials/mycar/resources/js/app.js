/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import infiniteScroll from "vue-infinite-scroll";
Vue.use(infiniteScroll);

import VueIziToast from "vue-izitoast";
import "izitoast/dist/css/iziToast.min.css";
Vue.use(VueIziToast);

import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDAur5lE8xfHtszjEp-eXgtyeTGG35bc7c'
    }
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "menu-component",
    require("./components/Menu.vue").default
);

Vue.component(
    "notifications-component",
    require("./components/Notifications.vue").default
);

Vue.component(
    "error-alert",
    require("./components/ErrorAlert.vue").default
);
Vue.component(
    "success-alert",
    require("./components/SuccessAlert.vue").default
);

Vue.component(
    "delete-confirmation",
    require("./components/forms/DeleteConfirmation.vue").default
);
Vue.component(
    "login-form",
    require("./components/forms/LoginForm.vue").default
);
Vue.component(
    "register-form",
    require("./components/forms/RegisterForm.vue").default
);
Vue.component(
    "reset-email-form",
    require("./components/forms/ResetEmailForm.vue").default
);
Vue.component(
    "reset-form",
    require("./components/forms/ResetForm.vue").default
);
Vue.component(
    "password-form",
    require("./components/forms/PasswordForm.vue").default
);
Vue.component(
    "vehicle-form",
    require("./components/forms/VehicleForm.vue").default
);
Vue.component("part-form", require("./components/forms/PartForm.vue").default);
Vue.component(
    "reminder-form",
    require("./components/forms/ReminderForm.vue").default
);

Vue.component(
    "vehicle-info-view",
    require("./components/views/VehicleInfoView.vue").default
);

Vue.component(
    "parts-table-view",
    require("./components/views/PartsTableView.vue").default
);
Vue.component(
    "part-info-view",
    require("./components/views/PartInfoView.vue").default
);

Vue.component(
    "reminders-table-view",
    require("./components/views/RemindersTableView.vue").default
);
Vue.component(
    "reminder-info-view",
    require("./components/views/ReminderInfoView.vue").default
);

Vue.component(
    "notifications-table-view",
    require("./components/views/NotificationsTableView.vue").default
);

Vue.component(
    "maps-view",
    require("./components/views/MapsView.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
