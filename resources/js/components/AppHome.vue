<template>
  <div class="">
    <toolbar></toolbar>
    <router-view></router-view>
    <app-footer></app-footer>
  </div>
</template>

<script type="text/javascript">
import toolbar from './Toolbar'
import AppFooter from './AppFooter'
import Login from './login/Login'



  export default {
    components:{
      toolbar,
      AppFooter,
      Login

    }

  }
</script>

<style media="screen">

</style>
