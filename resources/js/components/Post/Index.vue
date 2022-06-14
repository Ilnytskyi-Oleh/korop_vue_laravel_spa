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
                        <a href="#" @click.prevent="changeSort('title')">Title</a>
                        <span v-if="this.sortField === 'title' && this.sortDirection === 'asc'">&uarr;</span>
                        <span v-if="this.sortField === 'title' && this.sortDirection === 'desc'">&darr;</span>
                    </th>
                    <th
                        class="px-4 py-4 text-left bg-blue-900 text-white text-sm font-medium"
                    >
                        <a href="#" @click.prevent="changeSort('text')">Text</a>
                        <span v-if="this.sortField === 'text' && this.sortDirection === 'asc'">&uarr;</span>
                        <span v-if="this.sortField === 'text' && this.sortDirection === 'desc'">&darr;</span>
                    </th>
                    <th
                        class="px-4 py-4 text-left bg-blue-900 text-white text-sm font-medium"
                    >
                        <a href="#" @click.prevent="changeSort('created_at')">Created At</a>
                        <span v-if="this.sortField === 'created_at' && this.sortDirection === 'asc'">&uarr;</span>
                        <span v-if="this.sortField === 'created_at' && this.sortDirection === 'desc'">&darr;</span>
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
                @page-changed="this.$router.push({query: {page: `${currentPage = $event}`}})"

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
            sortField:'created_at',
            sortDirection:'desc',
            currentPage: 1,
            perPage: 5,
            total: 20,
        }
    },
    watch:{
        categoryId(){
            this.getPosts();
        }
    },
    computed:{
        queryPage() {
            let params = new URLSearchParams(document.location.search)
            return params.get('page');
        },
    },
    async beforeRouteUpdate(to, from) {
        if(to.query.page){
            this.getPosts(to.query.page)
        }
    },
    mounted() {
        this.getPosts(this.queryPage ?? 1);
        this.getCategories()
    },
    methods: {
        changeSort(field){
            if(this.sortField === field ){
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc'
            } else {
                this.sortField = field
                this.sortDirection = 'asc'
            }

            this.getPosts()
        },
        getPosts(page = 1) {
            axios.get(`/api/posts?page=${page}&category_id=${this.categoryId}&sort_field=${this.sortField}&sort_direction=${this.sortDirection}`)
                .then(res => {
                    this.posts = res.data.data;
                    this.total = res.data.meta.total;
                    this.perPage = res.data.meta.per_page;
                    this.currentPage = res.data.meta.current_page;
                    this.$router.push({query: {page: `${page}`}})
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
