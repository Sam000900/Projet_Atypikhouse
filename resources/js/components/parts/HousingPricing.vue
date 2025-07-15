<script setup>
  const props = defineProps(['formData']);
</script>

<template>
  <div class="housingpricing">
    <h2 class="housingpricing-title">Tarification & Disponibilités</h2>

    <div class="housingpricing-content">
      <div class="housingpricing-input-box">
        <label for="price_night" class="housingpricing-label">Tarif par nuit (€)</label>
        <input
          id="price_night"
          type="number"
          class="housingpricing-input-text"
          required
          autofocus
          :tabindex="1"
          v-model="props.formData.price_night"
          autocomplete="price_night"
        />
      </div>

      <div class="housingpricing-input-box">
        <label for="min_number_nights" class="housingpricing-label">Nombre de nuits minimun</label>
        <input
          id="min_number_nights"
          type="number"
          class="housingpricing-input-text"
          required
          autofocus
          :tabindex="2"
          v-model="props.formData.min_number_nights"
          autocomplete="min_number_nights"
        />
      </div>

      <div class="housingpricing-input-box">
        <label for="security_deposit" class="housingpricing-label">Dépôt de garantie (€)</label>
        <input
          id="security_deposit"
          type="number"
          class="housingpricing-input-text"
          required
          autofocus
          :tabindex="3"
          v-model="props.formData.security_deposit"
          autocomplete="security_deposit"
        />
      </div>

      <div class="housingpricing-input-box">
        <label for="cleaning_charges" class="housingpricing-label">Frais de ménages (€)</label>
        <input
          id="cleaning_charges"
          type="number"
          class="housingpricing-input-text"
          required
          autofocus
          :tabindex="4"
          v-model="props.formData.cleaning_charges"
          autocomplete="cleaning_charges"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .housingpricing {
    display: flex;
    flex-direction: column;
  }

  .housingpricing-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housingpricing-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin-top: 40px;
  }

  .housingpricing-input-box {
    display: flex;
    flex-direction: column;
  }

  .housingpricing-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .housingpricing-input-text {
    height: 40px;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    box-shadow: 2px 2px 4px #B6B6B6;
  }
</style>