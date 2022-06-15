import {createWebHistory} from "vue-router";
import { createLangRouter } from "vue-lang-router";
import translations from "../lang/translations";
// import localizedURLs from "../lang/localized-urls";



const routerOptions = {
    history: createWebHistory(process.env.APP_URL),
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
        {
            path: '/posts/create',
            name: 'posts.create',
            component: () => import('../components/Post/Create'),
        },
        {
            path: '/posts/:id/edit',
            name: 'posts.edit',
            component: () => import('../components/Post/Edit'),
        },
        {
            path: '/:pathMatch(.*)*',
            name: '404',
            component: () => import('../components/404'),
        },
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
