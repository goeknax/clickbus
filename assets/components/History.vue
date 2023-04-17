<template>
   <hr class="my-4">
   <div class="row g-5" v-if="logData.length > 0" data-test="logbook">
      <div class="col-md-7 col-lg-12">
      <table class="table">
       <thead>
        <tr>
         <th scope="col">#</th>
         <th scope="col">Monto</th>
         <th scope="col">Moneda</th>
         <th scope="col">Nuevo monto</th>
         <th scope="col">Nueva moneda</th>
      </tr>
   </thead>
   <tbody>
     <tr v-for="log in logData">
      <th scope="row">{{log.id}}</th>
      <td>{{log.oldAmount}}</td>
      <td>{{log.oldCurrency}}</td>
      <td>{{log.newAmount}}</td>
      <td>{{log.newCurrency}}</td>
      </tr>
</tbody>
</table>
</div>
</div>
<div class="alert alert-primary" role="alert" v-if="logData.length <= 0">No hay información.
</div>
</template>
<script>
   import * as ExchangeService  from '../services/ExchangeService';

   export default {
      name: "History",
      data() {
         return {
            messages: '',
            logData: []
         }
      },
      mounted() {
         ExchangeService.logs().then((response) => {
            this.logData = JSON.parse(response.data)
            console.log(this.logData[0])
         }).catch((e) => {
            console.log(e)
         }).finally(() => {

         });
      },
      methods: {

      }
   }
</script>
<style scoped>
</style>