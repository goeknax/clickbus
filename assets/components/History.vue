<template>
   <hr class="my-4">
   <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col" v-for="log in logData">
       <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
         <h4 class="my-0 fw-normal">{{log[0].old_amount}} {{log[0].old_currency}} <span :class="getInfo(log[0].old_currency)[0].icon"></span></h4>
      </div>
      <div class="card-body">
         <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true" v-for="l in log">
            <span :class="getInfo(l.new_currency)[0].icon"></span>
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h6 class="mb-0">{{l.new_amount}} {{getInfo(l.new_currency)[0].description}} </h6>
                <p class="mb-0 opacity-75">{{l.new_currency}}</p>
             </div>
          </div>
          <small class="opacity-50 text-nowrap">{{ timeForHumans(l.created_at.date) }}</small>
       </a>
    </div>
 </div>
</div>
</div>
</div>
<div class="alert alert-primary" role="alert" v-if="logData.length <= 0">No hay información.
</div>
</template>
<script>
   import * as ExchangeService  from '../services/ExchangeService';
   import "/node_modules/flag-icons/css/flag-icons.min.css";
   import moment from 'moment'

   export default {
      name: "History",
      data() {
         return {
            messages: '',
            logData: [],
            old_uuid: '',
            filterData:[],
            currencyWant: [
            {
               icon: 'fi fi-mx',
               currency: 'MXN',
               description: 'Peso Mexicano',
            },
            {
               icon: 'fi fi-eu',
               currency: 'EUR',
               description: 'Euro',
            },
            {
               icon: 'fi fi-sg',
               currency: 'SGD',
               description: 'Dolar de Singapur',
            },
            {
               icon: 'fi fi-ru',
               currency: 'RUB',
               description: 'Rublo Ruso',
            },
            {
               icon: 'fi fi-ca',
               currency: 'CAD',
               description: 'Dolar Canadiense',
            },
            {
               icon: 'fi fi-jp',
               currency: 'JPY',
               description: 'Yen',
            },
            {
               icon: 'fi fi-gb',
               currency: 'GBP',
               description: 'Libra Esterlina',
            },
            {
               icon: 'fi fi-us',
               currency: 'USD',
               description: 'Dolar Americano',
            },
            {
               icon: 'fi fi-pl',
               currency: 'PLN',
               description: 'Zloty',
            },
            ]
         }
      },
      mounted() {
         ExchangeService.logs().then((response) => {
            this.logData = response.data
            console.log(this.logData)
         }).catch((e) => {
            console.log(e)
         }).finally(() => {

         });
      },
      methods: {
         getInfo(currency) {
            return this.currencyWant.filter((obj) => obj.currency === currency);
         },
         timeForHumans(date) {
            return moment(date).subtract(6, 'hours').fromNow()
         }

      }
   }
</script>
<style scoped>
</style>