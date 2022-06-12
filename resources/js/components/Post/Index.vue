<template>
    <div>
        <div class="w-full max-w-screen-md mx-auto">
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

                </tr>
                </thead>
                <tbody>
                <tr v-for="post in posts" class="border-gray-300">

                    <td class="px-4 py-8 border-t border-b border-gray-300 text-sm">
                        {{post.title}}
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-sm">
                        {{post.text}}
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    name: "Index",
    data(){
        return {
            posts:[]
        }
    },
    mounted() {
        axios.get('/api/posts').then(res => {
            this.posts = res.data
        })
    }
}
</script>

<style scoped>

</style>
