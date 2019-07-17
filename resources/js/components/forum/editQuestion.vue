<template>
  <v-container>
    <v-card fluid>
      <v-form @submit.prevent="update">
        <v-text-field
          label="Title"
          v-model="form.title"
          type="text"
          required
        ></v-text-field>

        <vue-simplemde v-model="form.body" preview-class="markdown-body" />

        <v-card-actions>
          <v-btn small icon type="submit">
            <v-icon color="teal">save</v-icon>
          </v-btn>

          <v-btn small icon @click="cancel">
            <v-icon>cancel</v-icon>
          </v-btn>
        </v-card-actions>

      </v-form>
    </v-card>
  </v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde'

export default {
  props:['data'],
  components: {
    VueSimplemde
  },
  data(){
    return{
      form: {
        title: null,
        body: null
      }
    }
  },
  methods:{
    cancel() {
      EventBus.$emit('cancelEditing')
    },
    update(){
      axios.patch(`/api/question/${this.form.slug}`, this.form)
      .then(res => this.cancel())
    }
  },
  created(){
    this.form = this.data
  }
}
</script>

<style lang="css" scoped>
</style>
