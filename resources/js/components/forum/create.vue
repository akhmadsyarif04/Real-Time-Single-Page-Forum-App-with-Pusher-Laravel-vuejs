<template>
  <v-container>
      <form @submit.prevent="create">
        <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
        <v-text-field
          label="Title"
          v-model="form.title"
          type="text"
        ></v-text-field>

        <span class="red--text" v-if="errors.category_id">{{errors.category_id[0]}}</span>
        <v-autocomplete
          :items="categories"
          item-text="name"
          item-value="id"
          color="white"
          label="Category"
          v-model="form.category_id"
        ></v-autocomplete>

        <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
         <vue-simplemde v-model="form.body" preview-class="markdown-body" />

        <v-btn
          color="green"
          type="submit"
          :disabled="distable"
        >
          Create
        </v-btn>

    </form>
  </v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde'

export default {
  components: {
    VueSimplemde
  },
  data(){
    return {
      form: {
        title: null,
        category_id: null,
        body:null
      },
      categories: [],
      errors: {}
    }
  },
  created() {
    axios.get('/api/category')
    .then(res => this.categories = res.data.data)
  },
  methods: {
    create() {
      axios.post('/api/question', this.form)
      // path didapat dari QuestionResource
      .then(res => this.$router.push(res.data.path))
      .catch(error => this.errors = error.response.data.errors)
    }
  },
  computed:{
    distable(){
      return !(this.form.title && this.form.body && this.form.category_id)
    }
  }
}
</script>

<style lang="css" scoped>

</style>
