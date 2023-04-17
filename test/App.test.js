import Vue from "vue";
import App from "../assets/componentes/History";

test('renders a todo', () => {
  const wrapper = mount(App)

  const todo = wrapper.get('[data-test="todo"]')

  expect(todo.text()).toBe('Learn Vue.js 3')
})