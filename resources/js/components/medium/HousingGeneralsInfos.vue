<script setup>
  import { reactive, onMounted } from 'vue';
  import InputText from '@/components/small/InputText.vue';
  import InputNumber from '@/components/small/InputNumber.vue';
  import Textarea from '@/components/small/Textarea.vue';
  import Select from '@/components/small/Select.vue';
  import { initMap, updateMarkerPosition, inputLatitude, inputLongitude } from '@/lib/dynamicGoogleMap.js';
  
  const props = defineProps(['formData']);
  const inputData = reactive({
    "name": {
      "label": "Nom du logement",
      "type": "text",
      "id": "name",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 1,
      "placeholder": "Ex: Cabane perché avec vue sur lac"
    },
    "type": {
      "label": "Type de logement",
      "id": "type",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 2,
      "options": [
        { "value": "", "isDisabled": true, "title": "--Choisissez le type de logement--" },
        { "value": "Cabane", "isDisabled": false, "title": "Cabane" },
        { "value": "Yourte", "isDisabled": false, "title": "Yourte" },
        { "value": "Bulle", "isDisabled": false, "title": "Bulle" },
        { "value": "Igloo", "isDisabled": false, "title": "Igloo" },
        { "value": "Maison", "isDisabled": false, "title": "Maison" },
        { "value": "Péniche", "isDisabled": false, "title": "Péniche" },
        { "value": "Chalet", "isDisabled": false, "title": "Chalet" },
      ]
    },
    "area": {
      "label": "Superficie (m²)",
      "id": "area",
      "step": "1",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 3,
      "placeholder": "60"
    },
    "capacity": {
      "label": "Capacité d'accueil",
      "id": "capacity",
      "step": "1",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 4,
      "placeholder": "Nombre de personnes max"
    },
    "bedrooms": {
      "label": "Nombre de chambres",
      "id": "bedrooms",
      "step": "1",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 5,
      "placeholder": "2"
    },
    "department": {
      "label": "Département du logement",
      "type": "text",
      "id": "department",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 6,
      "placeholder": "Ex: Landes"
    },
    "municipality": {
      "label": "Commune du logement",
      "type": "text",
      "id": "municipality",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 7,
      "placeholder": "Ex: Luxey"
    },
    "address": {
      "label": "Adresse complète",
      "type": "text",
      "id": "address",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 8,
      "placeholder": "Pays, ville, code postal, rue"
    },
    "description": {
      "label": "Description détaillée",
      "id": "description",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 9,
      "placeholder": "Présentation du logement ambiance, point forts ..."
    },
    "latitude": {
      "label": "Latitude",
      "id": "latitude",
      "step": "any",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 10,
      "placeholder": "48.85341"
    },
    "longitude": {
      "label": "Longitude",
      "id": "longitude",
      "step": "any",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 11,
      "placeholder": "2.3488"
    },
  });

  const updateMarkerFromInputs = () => {
    updateMarkerPosition(form.latitude, form.longitude);
  };

  const updatePositionFormData = (newCoords) => {
    props.formData.latitude = newCoords[0];
    props.formData.longitude = newCoords[1];
  };

  onMounted(() => {
    initMap(props.formData.latitude, props.formData.longitude, updatePositionFormData);
  });
</script>

<template>
  <div class="housinggeneralsinfos">
    <div class="housinggeneralsinfos-content">
      <h2 class="housinggeneralsinfos-title">Informations générales du logement</h2>

      <div class="housinggeneralsinfos-grid">
        <InputText v-model="props.formData.name" :inputData="inputData['name']" :error="props.formData.errors.name" />
        <Select v-model="props.formData.type" :inputData="inputData['type']" :error="props.formData.errors.type" />
        <InputNumber v-model="props.formData.area" :inputData="inputData['area']" :error="props.formData.errors.area" />
        <InputNumber v-model="props.formData.capacity" :inputData="inputData['capacity']" :error="props.formData.errors.capacity" />
        <InputNumber v-model="props.formData.bedrooms" :inputData="inputData['bedrooms']" :error="props.formData.errors.bedrooms" />
        <InputText v-model="props.formData.department" :inputData="inputData['department']" :error="props.formData.errors.department" />
        <InputText v-model="props.formData.municipality" :inputData="inputData['municipality']" :error="props.formData.errors.municipality" />
        <InputText v-model="props.formData.address" :inputData="inputData['address']" :error="props.formData.errors.address" />
      </div>
      <Textarea v-model="props.formData.description" :inputData="inputData['description']" :error="props.formData.errors.description" />

      <div class="housinggeneralsinfos-map-box">
        <p class="housinggeneralsinfos-label">Coordonnées du logement</p>
        <div class="housinggeneralsinfos-content-map">
          <InputNumber @input="updateMarkerFromInputs" ref="inputLatitude" v-model="props.formData.latitude" :inputData="inputData['latitude']" :error="props.formData.errors.latitude" />
          <InputNumber @input="updateMarkerFromInputs" ref="inputLongitude" v-model="props.formData.longitude" :inputData="inputData['longitude']" :error="props.formData.errors.longitude" />
        </div>
        <div id="map" class="housinggeneralsinfos-map"></div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .housinggeneralsinfos {
    display: flex;
    flex-direction: column;
  }

  .housinggeneralsinfos-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .housinggeneralsinfos-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housinggeneralsinfos-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    -moz-column-gap: 50px;
    column-gap: 50px;
    margin-top: 40px;
  }

  .housinggeneralsinfos-content-map {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin-top: 20px;
  }

  .housinggeneralsinfos-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .housinggeneralsinfos-map-box {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
  }

  .housinggeneralsinfos-map {
    width: 100%;
    aspect-ratio: 1350 / 600;
    max-height: 450px;
    margin-top: 20px;
    border-radius: 10px;
    box-shadow: 2px 2px 4px #B6B6B6;
  }

  @media screen and (max-width: 1000px) {
    .housinggeneralsinfos-grid, .housinggeneralsinfos-content-map {
      display: flex;
      flex-direction: column;
    }
  }

  @media screen and (max-width: 900px) {
    .housinggeneralsinfos-map {
      width: 100%;
      aspect-ratio: 3/2;
      max-height: none;
      border-radius: 10px;
      box-shadow: 2px 2px 4px #B6B6B6;
    }
  }
</style>