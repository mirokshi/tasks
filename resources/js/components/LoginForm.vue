<template>
    <v-form action="/login" method="POST">
        <v-toolbar dark color="grey darken-4">
            <v-toolbar-title>Login form</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="email"
                    label="Login"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            ></v-text-field>
            <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                    v-model="password"
                    :error-messages="passwordErrors"
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
            ></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" disable="true">Login</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'LoginForm',
  mixins: [validationMixin],
  validations: {
    dataEmail: { email, required },
    password: { required, minLength: minLength(6) }
  },
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: ['email', 'csrfToken'],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) {
        return errors
      } else { !this.$v.dataEmail.email && errors.push('E-mail invalido') }
      !this.$v.dataEmail.required && errors.push('E-mail es obligatorio')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.required && errors.push('Password es obligatorio')
      !this.$v.password.minLength && errors.push('Password debe mayor de 6')
      return errors
    }
  }
}
</script>
