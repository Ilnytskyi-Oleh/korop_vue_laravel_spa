<template>
    <div>
        <div class="w-full max-w-screen-md mx-auto">
            <div class="my-5">
                <select v-model="categoryId">
                    <option value="" >-- select a category --</option>
                    <option v-for="category in categories"
                            :value="category.id"
                    >
                        {{category.name}}
                    </option>
                </select>
            </div>

            <table class="w-full table-auto rounded-sm">
                <thead>
                <tr>
                    <th
                        class="px-4 py-4 text-left bg-blue-900 text-white text-sm font-medium"
                    >
                        Title
                    </th>
                    <th
                        class="px-4 py-4 text-left bg-blue-900 text-white text-sm font-medium"
                    >
                        Text
                    </th>
                    <th
                        class="px-4 py-4 text-left bg-blue-900 text-white text-sm font-medium"
                    >
                        Created At
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="post in posts" class="border-gray-300">

                    <td class="px-4 py-8 border-t border-b border-gray-300 text-sm">
                        {{post.title}}
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-sm">
                        {{post.text.substring(0,50)}}
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-sm">
                        {{post.created_at}}
                    </td>
                </tr>

                </tbody>
            </table>
            <VueTailwindPagination
                :current="currentPage"
                :total="total"
                :per-page="perPage"
                @page-changed="getPosts(currentPage = $event)"

                text-before-input="Page"
                text-after-input="Go"/>
        </div>
    </div>
</template>

<script>
import '@ocrv/vue-tailwind-pagination/styles'
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination'

export default {
    name: "Index",
    components:{
        VueTailwindPagination
    },
    data(){
        return {
            posts:[],
            categories:[],
            categoryId:'',
            currentPage: 1,
            perPage: 5,
            total: 20,
        }
    },
    watch:{
        categoryId(value){
            this.getPosts();
        }
    },
    computed:{
        queryPage() {
            let params = new URLSearchParams(document.location.search)
            let page = params.get('page');
            return page;
        },
    },
    mounted() {
        this.getPosts(this.queryPage ?? 1);
        this.getCategories()
    },
    methods: {
        // Our method to GET results from a Laravel endpoint
        getPosts(page = 1) {
            axios.get(`/api/posts?page=${page}&category_id=${this.categoryId}`)
                .then(res => {
                    this.posts = res.data.data;
                    this.total = res.data.meta.total;
                    this.perPage = res.data.meta.per_page;
                    this.currentPage = res.data.meta.current_page;

                    const url = new URL(window.location);
                    url.searchParams.set('page', this.currentPage);
                    window.history.pushState({}, '', url);
                });
        },
        getCategories() {
            axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data.data;
                });
        }
    }
}
</script>

<style scoped>

</style>
