<template>
  <v-container>
      <form @submit.prevent="login">
        <v-text-field
          label="E-mail"
          v-model="form.email"
          type="email"
          required
        ></v-text-field>
        <v-text-field
          label="Password"
          v-model="form.password"
          type="password"
          required
        ></v-text-field>

        <v-btn
          color="green"
          type="submit"
        >
          Login
        </v-btn>

        <router-link to="/signup">
          <v-btn color="blue">Sign Up</v-btn>
        </router-link>

    </form>
  </v-container>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        form: {
          email: null,
          password: null
        }
      }
    },
    created() {
      if (User.loggedIn()) {
          this.$router.push({name: 'forum'})
      }
      // jadi ini akan riderect jika loggedIn nilai true

    },
    methods: {
      login ()
      {
        User.login(this.form) // inisialisasi class User ada pada app.js
      }
    }
  }
</script>
