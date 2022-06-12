require('./bootstrap');

import { createApp } from "vue";

import Index from "./components/Post/Index.vue";

const app = createApp({
        components:{
            Index
        }
}).mount("#app");



