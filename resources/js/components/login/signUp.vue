<template>
  <v-container>
      <form @submit.prevent="signUp">
        <v-text-field
          label="Name"
          v-model="form.name"
          type="teks"
        ></v-text-field>
        <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>

        <v-text-field
          label="E-mail"
          v-model="form.email"
          type="email"
        ></v-text-field>
        <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>

        <v-text-field
          label="Password"
          v-model="form.password"
          type="password"
        ></v-text-field>
        <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>

        <v-text-field
          label="Password Confirm"
          v-model="form.password_confirmation"
          type="password"
        ></v-text-field>

        <v-btn
          color="green"
          type="submit"
        >
          SignUp
        </v-btn>

        <router-link to="/login">
          <v-btn color="blue">Login</v-btn>
        </router-link>

    </form>
  </v-container>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        form: {
          name: null,
          email: null,
          password: null,
          password_confirmation: null
        },
        errors: {}
      }
    },
    created() {
      if (User.loggedIn()) {
          this.$router.push({name: 'forum'})
      }
      // jadi ini akan riderect jika loggedIn nilai true
    },
    methods: {
      signUp ()
      {
        axios.post('/api/auth/signup', this.form)
        .then(res => {
          User.responseAfterLogin(res)
          this.$router.push({name: 'forum'}) // ketika sukses login maka redirect/ganti component dengan component forum bukan login lagi
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
</script>
