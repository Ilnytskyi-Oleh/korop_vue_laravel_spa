<template>
  <div class="container mx-auto">
      <form class="w-full" @submit.prevent="submitForm">
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
          <div class="my-2">
              Thumbnail
              <br/>
              <input type="file" @change="selectFile">
          </div>
          <div class="my-3">
              <input type="submit" :disabled="formSubmitting"
                     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled:bg-blue-300 cursor-pointer"
                     :value="formSubmitting ? 'Saving post...' : 'Save post'">
          </div>
      </form>
  </div>
</template>

<script>
export default {
    name: "Edit",
    data(){
        return {
            categories: {},
            fields:{
                title:'',
                text:'',
                category_id:'',
                thumbnail:null
            },
            errors:{},
            formSubmitting: false
        }
    },
    mounted() {
        this.getCategories()
        this.getPost()

    },
    methods:{
        async getPost() {
            await axios.get(`/api/posts/${this.$route.params.id}`)
                .then(res => {
                    this.fields = res.data.data;
                });
        },
        async getCategories() {
            await axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data.data;
                });
        },
        async submitForm() {
            this.formSubmitting = true

            let fields = new FormData()

            for(let key in this.fields){
                fields.append(key, this.fields[key])
            }
            fields.append('_method', 'PATCH');
            await axios.post(`/api/posts/${this.fields.id}`, fields)
                .then(res => {
                    this.$swal('Post updated!');
                    this.$router.push({name:'posts'})
                    this.formSubmitting = false
                }).catch(err=>{
                    if(err.response.status === 422) {
                        this.errors = err.response.data.errors
                    }
                    this.formSubmitting = false
                    this.$swal({icon:'error', title: 'Error has happened'});
                });
        },
        selectFile(event){
            this.fields.thumbnail = event.target.files[0]
        }
    }
}
</script>

<style scoped>

</style>
