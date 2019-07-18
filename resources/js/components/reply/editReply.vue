<template>
  <div>
    <vue-simplemde v-model="reply.reply" preview-class="markdown-body" />
    <v-card-actions>

      <v-btn  icon small @click="update">
        <v-icon color="green" >save</v-icon>
      </v-btn>

      <v-btn  icon small @click="cancel">
        <v-icon color="yellow" >cancel</v-icon>
      </v-btn>

    </v-card-actions>
  </div>
</template>

<script>
import VueSimplemde from 'vue-simplemde'

export default {
  components:{VueSimplemde},
  props:['reply'],
  methods:{
    cancel(reply){
      EventBus.$emit('cancelEditing', reply);
    },
    update(){
      axios.patch(`/api/question/${this.reply.questions_slug}/reply/${this.reply.id}`, {body:this.reply.reply})
      .then(res => this.cancel(this.reply.reply))
    }
  }
}
</script>

<style lang="css" scoped>
</style>
