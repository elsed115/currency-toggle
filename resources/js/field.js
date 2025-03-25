import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-currency-toggle', IndexField)
  app.component('detail-currency-toggle', DetailField)
  app.component('form-currency-toggle', FormField)
})
