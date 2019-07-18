<template>
  <div>
    <vue-simplemde v-model="body" preview-class="markdown-body" />

    <v-btn color="green" @click="submit">
      done
    </v-btn>
  </div>
</template>

<script>
import VueSimplemde from 'vue-simplemde'

export default {
  props:['questionsSlug'],
  components:{
    VueSimplemde
  },
  data(){
    return{
        body: null
    }
  },
  methods:{
    submit(){
      axios.post(`/api/question/${this.questionsSlug}/reply`, {body:this.body})
      .then(res => {
        this.body = ''
        EventBus.$emit('newReply', res.data.reply)
        window.scrollTo(0,0)
      })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
