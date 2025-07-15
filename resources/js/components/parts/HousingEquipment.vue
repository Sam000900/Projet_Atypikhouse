<script setup>
  const props = defineProps(['formData']);
</script>

<template>
  <div class="housingequipment">
    <h2 class="housingequipment-title">Equipements & Services</h2>
    <div class="housingequipment-content">
      <div class="housingequipment-checkbox-box">
        <input
          id="wifi"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="1"
          v-model="props.formData.wifi"
          autocomplete="wifi"
        />
        <label for="wifi" class="housingequipment-label-checkbox">Wi-Fi</label>
      </div>

      <div class="housingequipment-checkbox-box">
        <input
          id="air_conditioning"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="2"
          v-model="props.formData.air_conditioning"
          autocomplete="air_conditioning"
        />
        <label for="air_conditioning" class="housingequipment-label-checkbox">Climatisation</label>
      </div>

      <div class="housingequipment-checkbox-box">
        <input
          id="parking"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="3"
          v-model="props.formData.parking"
          autocomplete="parking"
        />
        <label for="parking" class="housingequipment-label-checkbox">Parking</label>
      </div>

      <div class="housingequipment-checkbox-box">
        <input
          id="spa"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="4"
          v-model="props.formData.spa"
          autocomplete="spa"
        />
        <label for="spa" class="housingequipment-label-checkbox">SPA</label>
      </div>

      <div class="housingequipment-checkbox-box">
        <input
          id="equipped_kitchen"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="5"
          v-model="props.formData.equipped_kitchen"
          autocomplete="equipped_kitchen"
        />
        <label for="equipped_kitchen" class="housingequipment-label-checkbox">Cuisine équipée</label>
      </div>

      <div class="housingequipment-checkbox-box">
        <input
          id="household_linen_provided"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="6"
          v-model="props.formData.household_linen_provided"
          autocomplete="household_linen_provided"
        />
        <label for="household_linen_provided" class="housingequipment-label-checkbox">Linge de maison fourni</label>
      </div>

      <div class="housingequipment-checkbox-box">
        <input
          id="bathroom"
          type="checkbox"
          class="housingequipment-input-checkbox"
          :tabindex="7"
          v-model="props.formData.bathroom"
          autocomplete="bathroom"
        />
        <label for="bathroom" class="housingequipment-label-checkbox">Salle de bain</label>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .housingequipment {
    display: flex;
    flex-direction: column;
  }

  .housingequipment-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housingequipment-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin-top: 40px;
  }

  .housingequipment-checkbox-box {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .housingequipment-input-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
  }

  .housingequipment-label-checkbox {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    cursor: pointer;
  }
</style>