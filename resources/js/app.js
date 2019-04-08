import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'typeface-montserrat/index.css'
import 'typeface-roboto/index.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/tasks/Tasks.vue'
import Tasques from './components/tasks/Tasques.vue'
import Tags from './components/Tags.vue'
import EditableText from './components/EditableText.vue'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList.vue'
import UserSelect from './components/UserSelect.vue'
import permissions from './plugins/permissions'
import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'
import Impersonate from './components/Impersonate'
import GitInfo from './components/git/GitInfoComponent'
import Tema from './components/Tema.vue'
import Profile from './components/Profile'
import Changelog from './components/changelog/ChangelogComponent.vue'
import Navigation from './components/Navigation'
import NavigationRight from './components/NavigationRight.vue'
import Toolbar from './components/Toolbar.vue'
import ServiceWorker from './components/ServiceWorker.vue'
import NotificationsWidget from './components/notifications/NotificationsWidget'
import Notifications from './components/notifications/Notifications'
import ShareFab from './components/ui/ShareFab.vue'
import Mobile from './components/Mobile.vue'
import Clock from './components/others/Clock.vue'
import Newsletters from './components/newsletters/Newsletters.vue'
import NewsLetterSubscriptionCard from './components/newsletter/NewsLetterSubscriptionCard'
import Chat from './components/chat/Chat.vue'

import VueTimeago from 'vue-timeago'
import TreeView from 'vue-json-tree-view'

import '../../resources/img/icon16x16.png'
import '../../resources/img/icon32x32.png'
import ShowTask from './components/tasks/ShowTask.vue'
import Users from './components/Users.vue'
import Game from './components/Game.vue'
import UserOnlineWidget from './components/UserOnlineWidget.vue'

// window.location.reload(true)

Vue.config.productionTip = false

const PRIMARY_COLOR_KEY = 'PRIMARY_COLOR_KEY'
const SECONDARY_COLOR_KEY = 'SECONDARY_COLOR_KEY'

const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#2680C2'
const secondaryColor = window.localStorage.getItem(SECONDARY_COLOR_KEY) || '#2CB1BC'

// instalacion vuetify
window.Vue = Vue
window.Vuetify = Vuetify
window.Vue.use(TreeView)
window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)
window.Vue.use(VueTimeago, {
  locale: 'es', // Default locale
  locales: {
    'es': require('date-fns/locale/es')
  }
})

window.axios.interceptors.response.use((response) => {
  return response
}, function (error) {
  if (window.disableInterceptor) return Promise.reject(error)
  if (error && error.response) {
    // Refresh CSRF TOKEN
    // dAMpDXBRrjVJ2TKewouYHgOeozZmW72EiAt5K1jY
    console.log('PROVA ###############')
    if (error.response.status === 419) {
      console.log('419 error intercepted!!!!!')
      return window.helpers.getCsrfToken().then((token) => {
        console.log('TOKEN OBTAINED:')
        console.log(token)
        window.helpers.updateCsrfToken(token)
        console.log('csrf token updated!')
        error.config.headers['X-CSRF-TOKEN'] = token
        console.log('resend request!!!')
        return window.axios.request(error.config)
      }).catch(e => {
        console.log("NO s'ha pogut obtenir el CSRFTOKEN")
        console.log(e)
      })
    }
    console.log('1')
    if (error.response.status === 401) {
      window.Vue.prototype.$snackbar.showError("No heu entrat al sistema o ha caducat la sessió. Renviant-vos a l'entrada del sistema")
      const loginUrl = location.pathname ? '/login?back=' + location.pathname : '/login'
      console.log('Waiting to redirect to:')
      console.log(loginUrl)
      setTimeout(function () { window.location = loginUrl }, 3000)
      // Break the promise chain -> https://github.com/axios/axios/issues/715
      return new Promise(() => {})
    }
    if (error.response.status === 403) {
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 403!',
        'error',
        'No teniu permisos per realitzar aquesta acció.',
        'center'
      )
    }
    console.log('2')
    if (error.response.status === 422) {
      console.log('%%%%%%%%%%%%%%%%% ERROR DE VALIDACIó %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        error.response.data.message,
        'error',
        window.helpers.printObject(error.response.data.errors),
        'center'
      )
    }
    console.log('3')
    if (error.response.status === 404) {
      console.log('%%%%%%%%%%%%%%%%% NOT FOUND ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 404!',
        'error',
        "No s'ha pogut trobar al servidor el recurs que demaneu.",
        'center'
      )
    }
    if (error.response.status === 405) {
      console.log('%%%%%%%%%%%%%%%%% METHOD NOT ALLOWED FOUND ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 405!',
        'error',
        'Tipus de petició HTTP incorrecte.',
        'center'
      )
    }
    if (error.response.status === 500) {
      console.log('%%%%%%%%%%%%%%%%% SERVER ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 500!',
        'error',
        'Error inesperat al servidor',
        'center'
      )
    }
    return Promise.reject(error)
  }
  if (error && error.request) {
    window.Vue.prototype.$snackbar.showError("Error de xarxa! No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.")
    window.Vue.prototype.$snackbar.showSnackBar('Error de xarxa!', 'error', "No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.")
    return Promise.reject(error)
  }
})

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
window.Vue.component('impersonate', Impersonate)
window.Vue.component('git-info', GitInfo)
window.Vue.component('tema', Tema)
window.Vue.component('profile', Profile)
// Changelog
window.Vue.component('changelog', Changelog)

window.Vue.component('navigation', Navigation)
window.Vue.component('navigation-right', NavigationRight)
window.Vue.component('toolbar', Toolbar)

window.Vue.component('service-worker', ServiceWorker)
window.Vue.component('notifications-widget', NotificationsWidget)
window.Vue.component('user-online-widget', UserOnlineWidget)

window.Vue.component('notifications', Notifications)
window.Vue.component('share-fab', ShareFab)
window.Vue.component('mobile', Mobile)
window.Vue.component('clock', Clock)
window.Vue.component('newsletter-subscription-card', NewsLetterSubscriptionCard)
window.Vue.component('newsletters', Newsletters)
window.Vue.component('show-task', ShowTask)
window.Vue.component('chat', Chat)
window.Vue.component('users', Users)
window.Vue.component('game', Game)

// window.Vue.use(Vuetify)
window.Vue.use(Vuetify, {
  options: {
    customProperties: true
  },
  theme: {
    primary: {
      base: primaryColor,
      lighten1: '#4098D7',
      lighten2: '#62B0E8',
      lighten3: '#84C5F4',
      lighten4: '#B6E0FE',
      lighten5: '#DCEEFB',
      darken1: '#186FAF',
      darken2: '#0F609B',
      darken3: '#0A558C',
      darken4: '#003E6B'
    },
    secondary: {
      base: secondaryColor,
      lighten1: '#38BEC9',
      lighten2: '#54D1DB',
      lighten3: '#87EAF2',
      lighten4: '#BEF8FD',
      lighten5: '#E0FCFF',
      darken1: '#14919B',
      darken2: '#0E7C86',
      darken3: '#0A6C74',
      darken4: '#044E54'
    },
    accent: {
      base: '#F0B429',
      lighten1: '#F7C948',
      lighten2: '#FADB5F',
      lighten3: '#FCE588',
      lighten4: '#FFF3C4',
      lighten5: '#FFFBEA',
      darken1: '#DE911D',
      darken2: '#CB6E17',
      darken3: '#B44D12',
      darken4: '#8D2B0B'
    },
    error: {
      base: '#BA2525',
      lighten1: '#D64545',
      lighten2: '#E66A6A',
      lighten3: '#F29B9B',
      lighten4: '#FACDCD',
      lighten5: '#FFEEEE',
      darken1: '#A61B1B',
      darken2: '#911111',
      darken3: '#780A0A',
      darken4: '#610404'
    },
    // Taken from palete 3
    success: {
      base: '#27AB83',
      lighten1: '#3EBD93',
      lighten2: '#65D6AD',
      lighten3: '#8EEDC7',
      lighten4: '#C6F7E2',
      lighten5: '#EFFCF6',
      darken1: '#199473',
      darken2: '#147D64',
      darken3: '#0C6B58',
      darken4: '#014D40'
    },
    grey: {
      base: '#627D98',
      lighten1: '#829AB1',
      lighten2: '#9FB3C8',
      lighten3: '#BCCCDC',
      lighten4: '#D9E2EC',
      lighten5: '#F0F4F8',
      darken1: '#486581',
      darken2: '#334E68',
      darken3: '#243B53',
      darken4: '#102A43'
    }
  }
})

// eslint-disable-next-line no-unused-vars
const app = new Vue(AppComponent)
