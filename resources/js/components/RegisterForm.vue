<template>
    <v-form action="/register" method="post">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Formulari de registre</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field prepend-icon="person" name="name" label="name" type="text" v-model="name" :error-messages="nameErrors" @input="$v.name.$touch()" @blur="$v.name.$touch()"></v-text-field>
            <v-text-field prepend-icon="person" name="email" label="email" type="text" v-model="dataEmail" :error-messages="emailErrors" @input="$v.dataEmail.$touch()" @blur="$v.dataEmail.$touch()"></v-text-field>
            <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password" v-model="password" :error-messages="passwordErrors" @input="$v.password.$touch()" @blur="$v.password.$touch()"></v-text-field>
            <v-text-field id="password_confirmation" prepend-icon="lock" name="password_confirmation" label="Password Confirmation" type="password" v-model="password_confirmation" :error-messages="password_confirmationErrors" @input="$v.password_confirmation.$touch()" @blur="$v.password_confirmation.$touch()"></v-text-field>
            <span>Ja tens usuari? <a href="/login">Inicia sessió!</a></span>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit">Registrat!</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
// validationMixin = vuelidate.validationMixin
import { validationMixin } from 'vuelidate'
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  validations: {
    name: { required, minLength: minLength(3) },
    dataEmail: { required, minLength: minLength(6), email },
    password: { required, minLength: minLength(6) },
    password_confirmation: { sameAsPassword: sameAs('password') }
  },
  name: 'LoginForm',
  data () {
    return {
      dataEmail: this.email,
      name: '',
      password: '',
      password_confirmation: ''
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

      !this.$v.dataEmail.minLength && errors.push('El camp email ha de tindre una mida minima de 6 caracters')
      !this.$v.dataEmail.required && errors.push('El camp email es obligatori')
      !this.$v.dataEmail.email && errors.push('El camp email ha de tindre un format mail valid')
      return errors
    },
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors

      !this.$v.name.minLength && errors.push('El camp name ha de tindre una mida minima de 6 caracters')
      !this.$v.name.required && errors.push('El camp name es obligatori')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.minLength && errors.push('El camp password ha de tindre una mida minima de 6 caracters')
      !this.$v.password.required && errors.push('El camp password es obligatori')
      return errors
    },
    password_confirmationErrors () {
      const errors = []
      if (!this.$v.password_confirmation.$dirty) return errors
      !this.$v.password_confirmation.sameAsPassword && errors.push('Les contrassenyes no coincideixen!')
      return errors
    }

  }
}
</script>

<style scoped>

</style>
