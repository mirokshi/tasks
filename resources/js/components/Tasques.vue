<template>
  <span>
        <task-update></task-update>
       <tasks-list :users="users" :uri="uri" :tasks="tasks"></tasks-list>
      <task-create :users="users" :uri="uri" @created="add" ></task-create>
  </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import TaskCreate from './TaskCreate.vue'
import TasksList from './TasksList'
export default {
  name: 'Tasques',
  components: {
    'task-completed-toggle': TaskCompletedToggle,
    'tasks-list': TasksList,
    'task-create': TaskCreatem,
    'task-update': TaskUpdate
  },
  data () {
    return {
      dataUsers: this.users,
      name: '',
      completed: false,
      description: '',
      editDialog: false,
      dataTasks: this.tasks
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    add (task) {
      this.dataTasks.push(task)
    }
  }
}
</script>
