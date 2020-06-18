require('./bootstrap');
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from 'axios';
import './mixins/mixin';
import VueAxios from 'vue-axios';
import Routes from './routes/pages';
import App from './components/pages/App';
import BootstrapVue from 'bootstrap-vue'
import JsonExcel from 'vue-json-excel'
import { MultiSelectPlugin } from "@syncfusion/ej2-vue-dropdowns";
import { MultiSelect, CheckBoxSelection } from '@syncfusion/ej2-dropdowns';
import InputTag from 'vue-input-tag'
import money from 'v-money'
import 'vue-snotify/styles/material.css'; // or dark.css or simple.css
import Snotify from 'vue-snotify';

Vue.use(Snotify);
MultiSelect.Inject(CheckBoxSelection);
Vue.use(MultiSelectPlugin);
Vue.component('input-tag', InputTag)
Vue.component('downloadExcel', JsonExcel)
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);
Vue.use(BootstrapVue);
Vue.use(
	money, 
	{precision: 2}
)





const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App)
});

export default app;