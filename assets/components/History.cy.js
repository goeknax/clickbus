import History from './History.vue'

describe('<History />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(History)
  })
  it('carga pagina con cero información', () => {
    cy.mount(History)
    cy.contains('div', 'No hay información.')
  })
})