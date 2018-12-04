<template>
    <v-switch v-model="task.completed" :label="task.completed ? 'Completada' : 'Pendiente'"></v-switch>
</template>

<script>
export default {
  name: 'TaskCompletedToggle',
  data ()  {
    return {
      dataTask: this.task
    }
  },
  props: {
    task: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    dataTask:{
      handler: function () {
        
      }
    }
  }
}
</script>
