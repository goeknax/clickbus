<template>
<div class="row g-5">
   <div class="col-md-7 col-lg-12">
      <h4 class="mb-3">Conversor de divisas</h4>
      <div class="row g-3">
         <div class="col-sm-4">
            <div class="input-group mb-3">
               <span class="input-group-text">Importe $</span>
               <input type="number" aria-label="Importe" class="form-control" v-model="ammount" min=0>
               <div v-if="v$.ammount.$error">Elige un importe mayor a 0.</div>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="input-group mb-3">
               <select class="form-select" aria-label="Elige la moneda" v-model="selected" required>
                  <option disabled selected value="1">Moneda de:</option>
                  <option v-for="from in fromData" :value="from">
                     {{ from }}
                  </option>
               </select>
               <div  v-if="v$.selected.$error">Elige una moneda a covertir.</div>
            </div>
         </div>
         <div class="col-sm-12" v-if="!clear">
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
               <div class="col">
                  <div class="card mb-4 rounded-3 shadow-sm">
                     <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">{{ ammount }} {{getInfo(selected)[0].description}} <span :class="getInfo(selected)[0].icon"></span></h4>
                     </div>
                     <div class="card-body">
                        <div class="list-group">
                           <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true" v-for="to in toData">
                              <span :class="getInfo(to.currency)[0].icon"></span>
                              <div class="d-flex gap-2 w-100 justify-content-between">
                                 <div>
                                    <h6 class="mb-0">{{to.exchange}} {{getInfo(to.currency)[0].description}} </h6>
                                    <p class="mb-0 opacity-75">{{to.currency}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr class="my-4">
      <div class="row">
         <div class="col-sm-4">
            <button class="w-100 btn btn-success btn-lg" @click="convertir()" :disabled="isLoading">Convertir</button>
         </div>
         <div class="col-sm-4">
            <button class="w-100 btn btn-primary btn-lg" @click="clean()" :disabled="clear">Limpiar</button>
         </div>
      </div>
   </div>
</div>
</template>
<script>
   import * as ExchangeService  from '../services/ExchangeService';
   import { useVuelidate } from '@vuelidate/core'
   import { required, minValue } from '@vuelidate/validators'
   import { uuid } from 'vue-uuid'; 
   import "/node_modules/flag-icons/css/flag-icons.min.css";

   export default {
      setup: () => ({ v$: useVuelidate() }),
      name: "Example",
      data() {
       return {
         ammount: 1,
         isLoading: false,
         clear: true,
         selected: '',
         fromData: ["USD", "PLN"],
         uuid: '',
         toData: [
            { currency: 'MXN', exchange: 0 },
            { currency: 'EUR', exchange: 0 },
            { currency: 'SGD', exchange: 0 },
            { currency: 'RUB', exchange: 0 },
            { currency: 'CAD', exchange: 0 },
            { currency: 'JPY', exchange: 0 },
            { currency: 'GBP', exchange: 0 }
         ],
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
   validations () {
    return {
      ammount: { required, minValue: minValue(1) },
      selected: { required }
    }
  },
   methods: {
    async convertir() {
      const result = await this.v$.$validate()
      if (!result) {
         return
      }
      this.isLoading = true
      this.uuid = uuid.v1()   
      this.toData.forEach((item) => {
         let params = { have: this.selected , want: item.currency , amount: this.ammount }
         ExchangeService.exchangeCurrency(params).then((response) => {
            item.exchange = response.new_amount
            response.uuid = this.uuid
            ExchangeService.addToLog(response)
         }).catch((e) => {
            console.log(e)
         }).finally(() => {

         });
      })
      this.isLoading = false
      this.clear = false
   },
   clean() {
      this.toData.map((obj) => obj.exchange = 0)
      this.ammount = 1
      this.clear = true
      this.selected = '1'
   },
   getInfo(currency) {
      return this.currencyWant.filter((obj) => obj.currency === currency);
   },
}
}
</script>
<style scoped>
</style>