import { expect } from 'chai'
import { shallowMount, mount } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks.vue'


describe('Tasks.vue', () => {
  beforeEach(function () {
    // import and pass your custom axios instance to this method
    moxios.install()
  })

  afterEach(function () {
    // import and pass your custom axios instance to this method
    moxios.uninstall()
  })

  it('contains_a_list_of_tasks', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'comprar',
            completed: false
          },
          {
            id: 2,
            name: 'morir',
            completed: false
          },
          {
            id: 3,
            name: 'estudiar',
            completed: false
          }
        ]
      }
    })
    // console.log('text:')
    // console.log(wrapper.text())
    // // console.log('HTML:')
    // console.log(wrapper.html())

    // 3 ASSERT
    expect(wrapper.text()).contains('comprar')
    expect(wrapper.text()).contains('morir')
    expect(wrapper.text()).contains('estudiar')

    // wrapper.vm -> Object Vue (vm: View Model)
    expect(wrapper.vm.datatasks).to.have.lengthOf(3)

    expect(wrapper.vm.datatasks[0].id).equals(1)
    expect(wrapper.vm.datatasks[0].name).equals('comprar')
    expect(wrapper.vm.datatasks[0].completed).equals(false)

    expect(wrapper.vm.datatasks[1].id).equals(2)
    expect(wrapper.vm.datatasks[1].name).equals('morir')
    expect(wrapper.vm.datatasks[1].completed).equals(false)

    expect(wrapper.vm.datatasks[2].id).equals(3)
    expect(wrapper.vm.datatasks[2].name).equals('estudiar')
    expect(wrapper.vm.datatasks[2].completed).equals(false)
  })
  it.only('shows_nothing_when_no_tasks_provied', () => {
    // 1 Prepare
    // 2 Execute
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: []
      }
    }) // <tasks></tasks>

    // 3 Assert
    // expect(wrapper.text()).to.include(msg)
    console.log(wrapper.text())
  })

  it.skip('todo2', () => {

  })
})
