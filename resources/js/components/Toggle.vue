<template>
    <v-switch v-model="dataCompleted" :label="dataCompleted ? 'Completada' : 'Pendiente'"></v-switch>
</template>

<script>
export default {
  name: 'Toggle',
  data () {
    return {
      dataCompleted: this.completed
    }
  },
  props: {
    completed: {
      type: Boolean,
      required: true
    },
    id: {
      type: Number,
      required: true
    }
  },
  watch: {
    completed(completed){
      this.dataCompleted = completed
    },
    dataCompleted (dataCompleted, oldDataCompleted) {
      console.log('CAMBIO')
      console.log('nuevo')
      console.log(dataCompleted)
      console.log('antiguo')
      console.log(oldDataCompleted)
      if (dataCompleted) {
        // LOADING Y DISABLED
        window.axios.post('/v1/completed_task/{task}') // TODO ACABAR
      } else {
        // window.axios.delete('/v1/completed_task/{task}')
      }
    }
  }

}
</script>
