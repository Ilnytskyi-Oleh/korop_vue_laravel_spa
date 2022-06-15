require('./bootstrap');

import { createApp } from "vue";
import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Index from "./components/Index.vue";
import router from './router'
import { i18n } from 'vue-lang-router'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


const app = createApp({
        components:{
            Index,
        },
});
app.use(VueLoading);
app.use(router).use(i18n)
app.use(VueSweetalert2);
app.mount("#app")



