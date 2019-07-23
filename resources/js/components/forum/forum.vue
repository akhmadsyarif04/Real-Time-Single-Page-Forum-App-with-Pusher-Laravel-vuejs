<template>
  <v-container fluid grid-list-md>
    <v-layout row wrap>
      <v-flex xs8>
        <!-- :data didapat dari nama props pada bagian question.vue, dimana nilai dari question di over ke file question.vue -->
        <question
          v-for="question in questions"
          :key="question.path"
          :data="question"
        >
        </question>

        <div class="text-xs-center">
            <v-pagination
              v-model="meta.current_page"
              :length="meta.last_page"
              @input="changePage"
            ></v-pagination>
        </div>

      </v-flex>

      <v-flex xs4>
        <app-sidebar></app-sidebar>
      </v-flex>

    </v-layout>
  </v-container>
</template>

<script>
  import question from './question'
  import AppSidebar from './AppSidebar'

  export default {
    data(){
      return {
        questions: [],
        meta:{}
      }
    },
    components: {
      question,
      AppSidebar
    },
    created() {
      this.fecthQuestions()
    },
    methods:{
      fecthQuestions() {
        axios.get('/api/question')
        .then(res => {
          this.meta = res.data.meta
          this.questions = res.data.data
        })
        .catch(error => console.log(error.response.data))
      },
      changePage(page){
        axios.get(`/api/question?page=${page}`)
        .then(res => {
          this.meta = res.data.meta
          this.questions = res.data.data
        })
        .catch(error => console.log(error.response.data))
      }
    }
  }
</script>
