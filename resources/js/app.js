require('./bootstrap');

import { createApp } from "vue";

import Index from "./components/Index.vue";
import router from './router'
import { i18n } from 'vue-lang-router'


const app = createApp({
        components:{
            Index,
        },
});
app.use(router).use(i18n)
app.mount("#app")



