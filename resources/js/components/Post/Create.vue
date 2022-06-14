<template>
  <div class="container mx-auto">
      <form class="w-full" >
          <div class="my-3">Post title</div>
          <input class="border w-1/3" v-model="fields.title" type="text">
          <div v-if="errors.title" class="text-red-700">{{errors.title[0]}}</div>
          <div class="my-3">Post text</div>
          <textarea class="border w-1/3" v-model="fields.text"></textarea>
          <div v-if="errors.text" class="text-red-700">{{errors.text[0]}}</div>
          <div class="my-3">Category</div>
          <div>
              <select v-model="fields.category_id">
                <option v-for="category in categories"
                :value="category.id">
                    {{category.name}}
                </option>
              </select>
              <div v-if="errors.category_id" class="text-red-700">{{errors.category_id[0]}}</div>
          </div>
          <div class="my-3">
              <input type="submit" @click.prevent="submitForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" value="Save post">
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
            },
            errors:{}
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
                }).catch(err=>{
                    if(err.response.status === 422) {
                        this.errors = err.response.data.errors
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
