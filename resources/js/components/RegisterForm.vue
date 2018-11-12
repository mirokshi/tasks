<template>
        <form action="/register" method="POST">
            <v-toolbar dark color="primary">
                <v-toolbar-title>Register Form</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
              <v-card-text>
                  <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    v-model="name"
                    prepend-icon="person"
                    :error-messages="nameErrors"
                    :counter="10"
                    label="Name"
                    required
                    @input="$v.name.$touch()"
                    @blur="$v.name.$touch()"
            ></v-text-field>
            <v-text-field
                    v-model="dataEmail"
                    prepend-icon="email"
                    name="email"
                    label="Register"
                    type="text"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            ></v-text-field>
            <v-text-field
                    v-model="password"
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                    :error-messages="passwordErrors"
                    required
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
            ></v-text-field>
              </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
            <v-btn color="primary" type="submit">Register</v-btn>
            <v-btn color="primary" @click="clear">Clear</v-btn>
               </v-card-actions>
        </form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, maxLength, minLength, email } from 'vuelidate/lib/validators'

export default {
  name: 'RegisterForm',
  mixins: [validationMixin],
  validations: {
    name: { required, maxLength: maxLength(10) },
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) },
  },
  data () {
    return {
      name: '',
      dataEmail: this.email,
      password: ''
    }
  },
  props: ['email', 'csrfToken'],
  computed: {
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
      !this.$v.name.required && errors.push('Name is required.')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.required && errors.push('Password es obligatorio')
      !this.$v.password.minLength && errors.push('Password debe mayor de 6')
      return errors
    },
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.email && errors.push('Must be valid e-mail')
      !this.$v.dataEmail.required && errors.push('E-mail is required')
      return errors
    }
  },
  methods: {
    clear () {
      this.$v.$reset()
      this.name = ''
      this.email = ''
      this.checkbox = false
    }
  }
}
</script>
