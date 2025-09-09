<script setup>
  import { reactive } from 'vue';
  import InputCheckbox from '@/components/small/InputCheckbox.vue';

  const props = defineProps(['formData']);
  const inputData = reactive({
    "wifi": {
      "label": "Wi-Fi",
      "id": "wifi",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 1,
    },
    "air_conditioning": {
      "label": "Climatisation",
      "id": "air_conditioning",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 2,
    },
    "parking": {
      "label": "Parking",
      "id": "parking",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 3,
    },
    "spa": {
      "label": "SPA",
      "id": "spa",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 4,
    },
    "equipped_kitchen": {
      "label": "Cuisine équipée",
      "id": "equipped_kitchen",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 5,
    },
    "household_linen_provided": {
      "label": "Linge de maison fourni",
      "id": "household_linen_provided",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 6,
    },
    "bathroom": {
      "label": "Salle de bain",
      "id": "bathroom",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 7,
    },
  });
</script>

<template>
  <div class="housingequipment">
    <h2 class="housingequipment-title">Equipements & Services</h2>
    <div class="housingequipment-grid">
      <InputCheckbox v-model="props.formData.wifi" :inputData="inputData['wifi']" :error="props.formData.errors.wifi" />
      <InputCheckbox v-model="props.formData.air_conditioning" :inputData="inputData['air_conditioning']" :error="props.formData.errors.air_conditioning" />
      <InputCheckbox v-model="props.formData.parking" :inputData="inputData['parking']" :error="props.formData.errors.parking" />
      <InputCheckbox v-model="props.formData.spa" :inputData="inputData['spa']" :error="props.formData.errors.spa" />
      <InputCheckbox v-model="props.formData.equipped_kitchen" :inputData="inputData['equipped_kitchen']" :error="props.formData.errors.equipped_kitchen" />
      <InputCheckbox v-model="props.formData.household_linen_provided" :inputData="inputData['household_linen_provided']" :error="props.formData.errors.household_linen_provided" />
      <InputCheckbox v-model="props.formData.bathroom" :inputData="inputData['bathroom']" :error="props.formData.errors.bathroom" />
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

  .housingequipment-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin-top: 40px;
  }

  @media screen and (max-width: 700px) {
    .housingequipment-grid {
      display: flex;
      flex-direction: column;
    }
  }
</style>