<template>
  <v-card>
    <v-toolbar color="cyan" dark dense class="mt-2">
      <v-toolbar-title>
        Category
      </v-toolbar-title>
    </v-toolbar>

    <v-list>
      <v-list-tile v-for="category in Categories" :key="category.id">
        <v-list-tile-content>
          <v-list-tile-title>{{category.name}}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>

  </v-card>
</template>

<script>
export default {
  data(){
    return{
      Categories:{}
    }
  },
  created(){
    axios.get('/api/category')
    .then(res => this.Categories = res.data.data)
  }
}
</script>

<style lang="css" scoped>
</style>
