<template>
  <div class="container mx-auto">
      <form class="w-full" @click.prevent="submitForm">
          <div class="my-3">Post title</div>
          <input class="border w-1/3" v-model="fields.title" type="text">
          <div class="my-3">Post text</div>
          <textarea class="border w-1/3" v-model="fields.text"></textarea>
          <div class="my-3">Category</div>
          <div>
              <select v-model="fields.category_id">
                <option v-for="category in categories"
                :value="category.id">
                    {{category.name}}
                </option>
              </select>
          </div>
          <div class="my-3">
              <input type="submit"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" value="Save post">
          </div>
      </form>
  </div>
</template>

<script>
export default {
    name: "Create",
    data(){
        return {
            categories: {},
            fields:{
                title:'',
                text:'',
                category_id:''
            }
        }
    },
    mounted() {
        this.getCategories()
    },
    methods:{
        async getCategories() {
            await axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data.data;
                });
        },
        async submitForm() {
            await axios.post('/api/posts', this.fields)
                .then(res => {
                    this.$router.push({name:'posts'})
                });
        }
    }
}
</script>

<style scoped>

</style>
