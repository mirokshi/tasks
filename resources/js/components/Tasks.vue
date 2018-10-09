<template>
    <div class="container flex justify-center">
        <div class="flex flex-col">
            <h1 class="text-center text-red-lighter pt-5">TASKS ({{total}})</h1>
            <div class="flex-row">
                <input type="text"
                       v-model="newTask" @keyup.enter="add"
                       class="m-3 mt-5 p-1 pl-5 shadow border rounded focus:shadow-outine text-grey-darker">
                <button @click="add">
                    <svg class="h-5 w-4.5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                    </svg>
                </button>
            </div>
            <!--SINTAX SUGAR-->

            <!--<input :value="newTask" @input="newTask = $event.target.value)">-->
            <ul class="list-reset">

                <!--<li v-for="task in tasks"-->
                <!--v-if="tasks.completed"><strike>{{task.name}}</strike></li>-->
                <!--<li v-else>{{tasks.completed}}</li>-->
                <li v-for="task in filteredTasks" :key="task.id" class="text-grey-darker m-2 pl-5">
                <span :class="{strike: task.completed}">
                <editable-text
                        :text="task.name"
                        @edited="editName(task,$event)"
                ></editable-text>
                </span>
                    <span @click="remove(task)"> &#x274c;</span></li>

            </ul>
            <h3>FILTROS</h3>
            <br>
            <p>Active Filter :::: {{filter}}</p>
            <br>
            <ul class="list-reset inline-flex ">
                <li>
                    <button class="mr-5 bg-blue hover:bg-blue-dark border border-blue-darker " @click="setFilter('all')">Todos</button>
                </li>
                <li>
                    <button class="mr-5 bg-blue hover:bg-blue-dark border border-blue-darker" @click="setFilter('completed')">Completados</button>
                </li>
                <li>
                    <button class="bg-blue hover:bg-blue-dark border border-blue-darker " @click="setFilter('active')">Pendientes</button>
                </li>
            </ul>
        </div>

    </div>

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
        components: {
          'editable-text': EditableText
        },
        data() {
            return {
                filter: 'all', //ALL COMPLETED ACTIVE
                newTask: '',
                datatasks: this.tasks
            }
        },
        props:{
          'tasks':{
              type: Array,
                default:function () {
                     []
                }
          }
        },
        computed: {
            total() {
                return this.datatasks.length
            },
            filteredTasks() {
                //Segun el filtro activo
                //Alternativa switch/case -> array asociativo
                return filters[this.filter](this.datatasks)

            }
        },
        watch: {
          tasks(newTasks){
              this.datatasks = newTasks
          }
        },
        methods: {
            editName(task, text){
                // console.log('TASK:', task.name);
                // console.log('TEXT:', text);
                // console.log(text);
                task.name= text
            },
            setFilter(newFilter) {
                this.filter = newFilter
            },

            add() {

                this.datatasks.splice(0, 0, {name: this.newTask, completed: false})
                this.newTask = ''
            },
            remove(task) {
                window.console.log(task)
                this.datatasks.splice(this.datatasks.indexOf(task), 1)
            },
            created(){
                console.log('Componente Tasks estar creador');
            }
        }
    }

</script>

<style>
    .strike {
        text-decoration: line-through;
    }
</style>