<template>
    <span>
        <tasks-list :users="users" :uri="uri" :tasks="dataTasks"></tasks-list>
        <task-create :users="users" :uri="uri" @created="add" ></task-create>
    </span>
</template>

<script>
import TaskCreate from './TaskCreate'
import TasksList from './TasksList'
export default {
  name: 'Tasques',
  components: {
    'tasks-list': TasksList,
    'task-create': TaskCreate
  },
  data () {
    return {
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
