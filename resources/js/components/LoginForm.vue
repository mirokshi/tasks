<template>
    <v-form action="/login" method="post">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn href="/auth/facebook" icon><i class="fab fa-facebook fa-3x" style="color:#3b5998;"></i></v-btn>
            <v-btn href="/auth/github" icon ><i class="fab fa-github-square fa-3x"></i></v-btn>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field prepend-icon="person" name="email" label="email" type="text" v-model="dataEmail" :error-messages="emailErrors" @input="$v.dataEmail.$touch()" @blur="$v.dataEmail.$touch()"></v-text-field>
            <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password" v-model="password" :error-messages="passwordErrors" @input="$v.password.$touch()" @blur="$v.password.$touch()"></v-text-field>
            <span>¿No tienes usuario? <a href="/register">Registrate!</a></span>
            <br>
            <span> ¿Has olvidado la contraseña? <a href="/password/reset">Recuperala!</a></span>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit">Login</v-btn>
            <v-btn color="primary" href="/">Cancel</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
// validationMixin = vuelidate.validationMixin
import { validationMixin } from 'vuelidate'
import { required, email, minLength } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  validations: {
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) }
  },
  name: 'LoginForm',
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: {
    'email': '',
    'csrfToken': ''
  },
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.required && errors.push('El email es obligatorio')
      !this.$v.dataEmail.email && errors.push('Email invalido')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.minLength && errors.push('La longitud del password debe ser mayor de 6 caracteres')
      !this.$v.password.required && errors.push('El password es obligatorio')
      return errors
    }
  }
}
</script>

<style scoped>

</style>
