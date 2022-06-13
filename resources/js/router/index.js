import {createWebHistory} from "vue-router";
import { createLangRouter } from "vue-lang-router";
import translations from "../lang/translations";
// import localizedURLs from "../lang/localized-urls";



const routerOptions = {
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../components/Home/Index'),
        },
        {
            path: '/posts',
            name: 'posts',
            component: () => import('../components/Post/Index'),
        },

        // {
        //     path: '/:pathMatch(.*)*',
        //     name: '404',
        //     component: () => import('../views/NotFoundView.vue'),
        // },
    ],
    scrollBehavior(to) {
            return { el:'#app', top: 0, behavior: 'smooth'}
    }
}

const langRouterOptions = {
    defaultLanguage: 'uk',
    translations,
    // localizedURLs,
}

const router = createLangRouter(langRouterOptions, routerOptions);

export default router
