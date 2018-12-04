import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'
import Tasques from './components/Tasques.vue'
import Tags from './components/Tags.vue'
import EditableText from './components/EditableText.vue'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList.vue'
import UserSelect from './components/UserSelect.vue'
import permissions from './plugins/permissions'
import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'

// instalacion vuetify
window.Vue = Vue
window.Vue.use(Vuetify)
window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)


// window.Vue.user($snackbar)

// componentes
window.Vue.component('example_component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tasques', Tasques)
window.Vue.component('tags', Tags)
window.Vue.component('editable-text', EditableText)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)

// eslint-disable-next-line no-unused-vars
const app = new Vue(AppComponent)
