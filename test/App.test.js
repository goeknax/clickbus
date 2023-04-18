import Vue from "vue";
import History from 'components/History';

test('renders a todo', () => {
  const wrapper = mount(History)

  const todo = wrapper.get('[data-test="todo"]')

  expect(todo.text()).toBe('Learn Vue.js 3')
})