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
              <option v-for="from in fromData" :value="from" data-thumbnail="images/icon-chrome.png" >
                {{ from }}
             </option>
          </select>
          <div  v-if="v$.selected.$error">Elige una moneda a covertir.</div>
       </div>
    </div>

    <div class="col-sm-4">
      <p class="h2" v-if="!clear">{{ ammount }}  {{ selected }} es:</p>
      <div class="input-group flex-nowrap"  v-for="to in toData">
        <span class="input-group-text" id="addon-wrapping" v-if="to.exchange != 0">{{ to.currency }}</span>
        <input type="text" class="form-control" :placeholder="to.exchange" v-if="to.exchange != 0" aria-label="Username" aria-describedby="addon-wrapping" :value="to.exchange" disabled>
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
         toData: [
            { currency: 'MXN', exchange: 0 },
            { currency: 'EUR', exchange: 0 },
            { currency: 'SGD', exchange: 0 },
            { currency: 'RUB', exchange: 0 },
            { currency: 'CAD', exchange: 0 },
            { currency: 'JPY', exchange: 0 },
            { currency: 'GBP', exchange: 0 }
            ]
      }
   },
   validations () {
    return {
      ammount: { required, minValue: minValue(1) },
      selected: { required }
    }
  },
   watch: {
      toData: function(value) {
         console.log(value);
      }
   },
   methods: {
    async convertir() {
      const result = await this.v$.$validate()
      if (!result) {
         return
      }
      this.isLoading = true
      this.toData.forEach((item) => {
         let params = { have: this.selected , want: item.currency , amount: this.ammount }
         ExchangeService.exchangeCurrency(params).then((response) => {
            item.exchange = response.new_amount
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
   }
}
}
</script>
<style scoped>
</style>