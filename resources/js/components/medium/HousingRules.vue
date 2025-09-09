<script setup>
  import { reactive } from 'vue';
  import InputNumber from '@/components/small/InputNumber.vue';
  import InputTime from '@/components/small/InputTime.vue';
  import Textarea from '@/components/small/Textarea.vue';
  import InputCheckbox from '@/components/small/InputCheckbox.vue';

  const props = defineProps(['formData']);
  const inputData = reactive({
    "arrival_time": {
      "label": "Heure d'arrivée (heures:minutes)",
      "id": "arrival_time",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 1,
    },
    "departure_time": {
      "label": "Heure de départ (heures:minutes)",
      "id": "departure_time",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 2,
    },
    "minimum_age": {
      "label": "Age minimum du locataire",
      "id": "minimum_age",
      "step": "1",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 3,
      "placeholder": ""
    },
    "smokers_allowed": {
      "label": "Fumeurs autorisés",
      "id": "smokers_allowed",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 4,
    },
    "pets_allowed": {
      "label": "Animaux acceptés",
      "id": "pets_allowed",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 5,
    },
    "events_allowed": {
      "label": "Evénements autorisés",
      "id": "events_allowed",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 6,
    },
    "additional_rules": {
      "label": "Règles supplémentaires",
      "id": "additional_rules",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 7,
      "placeholder": "Ajoutez des règles supplémentaires..."
    },
  });
</script>

<template>
  <div class="housingrules">
    <h2 class="housingrules-title">Règles du logement</h2>

    <div class="housingrules-grid">
      <InputTime v-model="props.formData.arrival_time" :inputData="inputData['arrival_time']" :error="props.formData.errors.arrival_time" /> 
      <InputTime v-model="props.formData.departure_time" :inputData="inputData['departure_time']" :error="props.formData.errors.departure_time" /> 
      <InputNumber v-model="props.formData.minimum_age" :inputData="inputData['minimum_age']" :error="props.formData.errors.minimum_age" />
    </div>
    <div class="housingrules-checkboxes-container">
      <InputCheckbox v-model="props.formData.smokers_allowed" :inputData="inputData['smokers_allowed']" :error="props.formData.errors.smokers_allowed" />
      <InputCheckbox v-model="props.formData.pets_allowed" :inputData="inputData['pets_allowed']" :error="props.formData.errors.pets_allowed" />
      <InputCheckbox v-model="props.formData.events_allowed" :inputData="inputData['events_allowed']" :error="props.formData.errors.events_allowed" />
    </div>
    <div class="housingrules-sub-content">
      <Textarea v-model="props.formData.additional_rules" :inputData="inputData['additional_rules']" :error="props.formData.errors.additional_rules" />
    </div>
  </div>
</template>

<style scoped>
  .housingrules {
    display: flex;
    flex-direction: column;
  }

  .housingrules-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housingrules-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 20px;
    column-gap: 50px;
    margin-top: 40px;
  }

  .housingrules-checkboxes-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin: 20px 0;
  }

  .housingrules-sub-content {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
  }

  @media screen and (max-width: 1000px) {
    .housingrules-grid {
      display: flex;
      flex-direction: column;
    }
  }
</style>