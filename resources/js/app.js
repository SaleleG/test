
require('./bootstrap');
import Vue from 'vue';
Vue.config.devtools = true;
window.Vue = require('vue');
Vue.config.productionTip = false
window.EventBus = window.EventBus || new Vue();
Vue.mixin({
    methods: {
        can(permission){
            if (this.in_array(permission,window.auth.permissions)){
                return true;
            }
            return false;
        },
        in_array(el, array) {
            if(array != 'undefined'){
                for(let i = 0; i < array.length; i++) {
                    if(array[i] == el) return true;
                }
                return false;
            }

        },
    }
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('auth-login', require('./Components/Auth/Login.vue').default);
Vue.component('dashboard-stock', require('./components/Stock/Dashboardstock.vue').default);
Vue.component('profile-partial', require('./Components/Profile/Partial.vue').default);
Vue.component('gamme', require('./components/Stock/Gamme.vue').default);
const app = new Vue({
    el: '#wrapper',
});

