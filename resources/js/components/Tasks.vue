<template>
    <v-container grid-list-md text-xs-center id="tasks" class="tasks">
        <div class="flex flex-col">
            <h1 class="text-center text-red-lighter pt-5">TASKS ({{total}})</h1>
            <div class="flex-row">
                <form>
                    <input type="text"
                           v-model="newTask"
                           @keyup.enter="add"
                           name="name"
                           class="m-3 mt-5 p-1 pl-2 shadow border rounded focus:shadow-outine text-grey-darker"
                           placeholder="New task"
                           required
                    >
                    <!--agregar-->
                    <button id="button_add_task" @click="add">
                        <svg class="h-6 w-4 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                        </svg>
                    </button>
                </form>
                <div v-if="errorMessage">
                    Ha sucedido un error: {{ errorMessage }}
                </div>
            </div>

            <!--SINTAX SUGAR-->
            <ul class="list-reset">
                <li v-for="task in filteredTasks" :key="task.id" class="text-grey-darker m-2 pl-5">
                <span :id="'task'+ task.id" :class="{strike: task.completed}">
                <editable-text
                        :text="task.name"
                        @edited="editName(task,$event)"
                ></editable-text>
                </span>
                    </li>
            </ul>

            <!--<v-list text-xs-center>-->
                <!--<v-list-tile v-for="task in filteredTasks" :key="task.id">-->
                    <!--<v-list-tile-content>-->
                        <!--<v-list-tile-title>-->
                            <!--<span :id="'task' + task.id" :class="{ strike: task.completed }"></span>-->
                            <!--<span :id="'delete_task_' + task.id" @click="remove(task)">&#x274c;</span>-->
                            <!--<editable-text-->
                                    <!--:text="task.name"-->
                                    <!--@edited="editName(task, $event)"-->
                            <!--&gt;</editable-text>-->
                        <!--</v-list-tile-title>-->
                    <!--</v-list-tile-content>-->
                <!--</v-list-tile>-->
            <!--</v-list>-->

            <span id="filters" v-show="total > 0">
            <h3>Filtros:</h3>
                Active : {{filter}}
                <br>
            <ul class="list-reset inline-flex">
                <li><button class="mr-5 bg-blue hover:bg-blue-dark border border-blue-darker " @click="setFilter('all')">Todos</button></li>
                <li><button class="mr-5 bg-blue hover:bg-blue-dark border border-blue-darker" @click="setFilter('completed')">Completados</button></li>
                <li><button class="bg-blue hover:bg-blue-dark border border-blue-darker " @click="setFilter('active')">Pendientes</button></li>
            </ul>
                </span>
        </div>
    </v-container>
    <!--<div id="tasks" class="tasks container flex justify-center">-->

    <!--</div>-->

</template>

<script>
import EditableText from './EditableText.vue'

var filters = {
  all: function (datatasks) {
    return datatasks
  },
  completed: function (datatasks) {
    return datatasks.filter(function (task) {
      return task.completed
      // if (task.completed) return true
      // else return false
    })
  },
  active: function (datatasks) {
    return datatasks.filter(function (task) {
      return !task.completed
      // if (task.completed) return false
      // else return true
    })
  }
}
export default {
  name: 'Tasks',
  components: {
    'editable-text': EditableText
  },
  data () {
    return {
      filter: 'all', // ALL COMPLETED ACTIVE
      newTask: '',
      datatasks: this.tasks,
      errorMessage: ''

    }
  },
  props: {
    'tasks': {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  computed: {
    total () {
      return this.datatasks.length
    },
    filteredTasks () {
      // Segun el filtro activo
      // Alternativa switch/case -> array asociativo
      return filters[this.filter](this.datatasks)
    }
  },
  watch: {
    tasks (newTasks) {
      this.datatasks = newTasks
    }
  },
  methods: {
    editName (task, text) {
      task.name = text
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },

    add () {
      if (this.newTask === '') return
      window.axios.post('/api/v1/tasks', {
        name: this.newTask
      }).then((response) => {
        this.datatasks.splice(0, 0, { id: response.data.id, name: this.newTask, completed: false })
        this.newTask = ''
      }).catch((error) => {
        console.log(response)
      })
    },
    remove (task) {
      axios.delete('/api/v1/tasks/' + task.id, {}).then((response) => {
        this.datatasks.splice(this.datatasks.indexOf(task), 1)
      }).catch((error) => {
        console.log(response)
      })
    }
  },
  created () {
    if (this.tasks.length === 0) {
      window.axios.get('/api/v1/tasks').then((response) => {
        this.datatasks = response.data
      }).catch((error) => {
        this.errorMessage = error.response.data
      })
    }
  }
}
</script>

<style>
    .strike {
        text-decoration: line-through;
    }
</style>
