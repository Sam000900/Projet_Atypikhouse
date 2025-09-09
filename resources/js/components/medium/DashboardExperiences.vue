<script setup>
  import { reactive, onMounted } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import InputFile from '@/components/small/InputFile.vue';
  import InputText from '@/components/small/InputText.vue';
  import InputNumber from '@/components/small/InputNumber.vue';
  import InputTime from '@/components/small/InputTime.vue';
  import Textarea from '@/components/small/Textarea.vue';
  import Select from '@/components/small/Select.vue';
  import Loader from '@/components/small/Loader.vue';
  import { initMap, updateMarkerPosition, inputLatitude, inputLongitude } from '@/lib/dynamicGoogleMap.js';

  const emit = defineEmits(['emitResetSelectedExperience', 'experienceUpdated']);
  const props = defineProps(['experienceData']);
  const form = useForm({
    name: props.experienceData?.name ?? '',
    type: props.experienceData?.type ?? '',
    location: props.experienceData?.location ?? '',
    address: props.experienceData?.address ?? '',
    max_number_persons: props.experienceData?.max_number_persons ?? '',
    service_duration: props.experienceData?.service_duration.slice(0, 5) ?? '',
    latitude: props.experienceData?.latitude ?? '',
    longitude: props.experienceData?.longitude ?? '',
    price: props.experienceData?.price ?? '',
    additional_information: props.experienceData?.additional_information ?? '',
    image: null,
  });
  const inputData = reactive({
    "image_create": {
      "label": "Image de l'expérience",
      "id": "image",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 1,
    },
    "image_modify": {
      "label": "Modifier l'image de l'expérience",
      "id": "image",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 1,
    },
    "name": {
      "label": "Titre de l'expérience",
      "type": "text",
      "id": "name",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 2,
      "placeholder": "Ex: Saut en parachute"
    },
    "type": {
      "label": "Type d'expérience",
      "id": "type",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 3,
      "options": [
        { "value": "", "isDisabled": true, "title": "--Choisissez le type de l'expérience--" },
        { "value": "Aventures", "isDisabled": false, "title": "Aventures" },
        { "value": "Gastronomie locale", "isDisabled": false, "title": "Gastronomie locale" },
        { "value": "Séjours bien-êtres", "isDisabled": false, "title": "Séjours bien-êtres" },
      ]
    },
    "location": {
      "label": "Département de l'expérience",
      "type": "text",
      "id": "location",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 4,
      "placeholder": "Ex: Landes"
    },
    "address": {
      "label": "Adresse complète",
      "type": "text",
      "id": "address",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 5,
      "placeholder": "Pays, ville, code postal, rue"
    },
    "max_number_persons": {
      "label": "Nombre de personnes maximum",
      "id": "max_number_persons",
      "step": "1",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 6,
      "placeholder": "2"
    },
    "price": {
      "label": "Prix de l'expérience (€)",
      "id": "price",
      "step": "0.01",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 7,
      "placeholder": ""
    },
    "service_duration": {
      "label": "Durée de l'expérience (heures:minutes)",
      "id": "service_duration",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 8,
    },
    "additional_information": {
      "label": "Informations additionnelles",
      "id": "additional_information",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 9,
      "placeholder": "..."
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

  const updatePositionExperienceData = (newCoords) => {
    form.latitude = newCoords[0];
    form.longitude = newCoords[1];
  };

  onMounted(() => {
    initMap(form.latitude, form.longitude, updatePositionExperienceData);
  });

  async function submit() {
    const isEdit = !!props.experienceData?.id;
    const url = isEdit ? `/update-experience/${props.experienceData.id}` : '/register-experience';
    const submitMethod = isEdit ? 'put' : 'post';

    form.submit('post', url, {
      method: submitMethod,
      forceFormData: true,
      onSuccess: async () => {
        emit('experienceUpdated');
      },
    });
  }

</script>

<template>
  <div class="dashboardexperiences">
    <form @submit.prevent="submit" class="dashboardarticles-form" enctype="multipart/form-data">
      <div class="dashboardexperiences-content">
        <h2 class="dashboardexperiences-title">Créer une expérience</h2>

        <div v-if="props.experienceData?.image_path">
          <p class="dashboardexperiences-label">Image actuelle de l'expérience :</p>
          <div class="dashboardexperiences-image-box">
            <img class="dashboardexperiences-image" :src="'/' + props.experienceData?.image_path" alt="Image de l'expérience" />
          </div>
        </div>

        <div class="dashboardexperiences-grid">
          <InputFile v-if="props.experienceData?.image_path" v-model="form.image" :inputData="inputData['image_modify']" :error="form.errors.image_modify" />
          <InputFile v-else v-model="form.image" :inputData="inputData['image_create']" :error="form.errors.image_create" />
          <InputText v-model="form.name" :inputData="inputData['name']" :error="form.errors.name" />
          <Select v-model="form.type" :inputData="inputData['type']" :error="form.errors.type" />
          <InputText v-model="form.location" :inputData="inputData['location']" :error="form.errors.location" />
          <InputText v-model="form.address" :inputData="inputData['address']" :error="form.errors.address" />
          <InputNumber v-model="form.max_number_persons" :inputData="inputData['max_number_persons']" :error="form.errors.max_number_persons" />
          <InputNumber v-model="form.price" :inputData="inputData['price']" :error="form.errors.price" />
          <InputTime v-model="form.service_duration" :inputData="inputData['service_duration']" :error="form.errors.service_duration" /> 
        </div>
        <Textarea v-model="form.additional_information" :inputData="inputData['additional_information']" :error="form.errors.additional_information" />

        <div class="dashboardexperiences-map-box">
          <p class="dashboardexperiences-label">Coordonnées de l'expérience</p>
          <div class="dashboardexperiences-content-map">
            <InputNumber @input="updateMarkerFromInputs" ref="inputLatitude" v-model="form.latitude" :inputData="inputData['latitude']" :error="form.errors.latitude" />
            <InputNumber @input="updateMarkerFromInputs" ref="inputLongitude" v-model="form.longitude" :inputData="inputData['longitude']" :error="form.errors.longitude" />
          </div>
          <div id="map" class="dashboardexperiences-map"></div>
        </div>

      </div>

      <div class="dashboardexperiences-bottom">
        <button class="dashboardexperiences-button-cancel" type="button" :disabled="form.processing"@click="emit('emitResetSelectedExperience');">Annuler</button>
        <button class="dashboardexperiences-button-save" type="submit" :disabled="form.processing">
          <Loader v-if="form.processing" />
          <span v-else>Enregistrer</span>
        </button>
      </div>

    </form>
  </div>
</template>

<style scoped>
  .dashboardexperiences {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    border-radius: 16px;
    background-color: #ffffff;
  }

  .dashboardexperiences-form {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .dashboardexperiences-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 20px 40px;
  }

  .dashboardexperiences-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
    margin-bottom: 20px;
  }

  .dashboardexperiences-image-box {
    display: flex;
    width: 300px;
    max-width: 100%;
    aspect-ratio: 1/1;
    border-radius: 8px;
  }

  .dashboardexperiences-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
  }

  .dashboardexperiences-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    -moz-column-gap: 50px;
    column-gap: 50px;
    margin-top: 40px;
  }

  .dashboardexperiences-input-box {
    display: flex;
    flex-direction: column;
  }

  .dashboardexperiences-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .dashboardexperiences-input-file {
    border: 0;
    border-radius: 10px;
    padding: 8px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    box-shadow: 2px 2px 4px #B6B6B6;
  }

  .dashboardexperiences-input-file::file-selector-button {
    height: 40px;
    padding: 0 20px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-size: 16px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .dashboardexperiences-input-text {
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

  .dashboardexperiences-textarea {
    height: 120px;
    max-width: 100%;
    border: 0;
    border-radius: 10px;
    padding: 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    line-height: 130%;
    box-shadow: 2px 2px 4px #B6B6B6;
  }

  .dashboardexperiences-bottom {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    width: 100%;
    min-height: 80px;
    padding: 10px 20px;
    border-top: solid 1px #B9BDC7;
  }

  .dashboardexperiences-button-cancel {
    height: 50px;
    padding: 10px 20px;
    border: 0;
    border: solid 1px crimson;
    border-radius: 8px;
    background-color: transparent;
    color: crimson;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .dashboardexperiences-button-cancel:hover {
    background-color: crimson;
    color: #ffffff;
  }

  .dashboardexperiences-button-save {
    height: 50px;
    padding: 10px 20px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .dashboardexperiences-button-save:hover {
    background-color: #357d54;
  }


  .dashboardexperiences-form-loader {
    animation: 0.5s linear infinite loader; 
  }

  .dashboardexperiences-validations-errors {
    margin-top: 10px;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 100%;
    color: crimson;
  }

  .dashboardexperiences-validations-success {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    line-height: 100%;
    color: #296242;
  }

  .dashboardexperiences-map-box {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
  }

  .dashboardexperiences-content-map {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin-top: 20px;
  }

  .dashboardexperiences-map {
    width: 100%;
    aspect-ratio: 1350 / 600;
    max-height: 450px;
    margin-top: 20px;
    border-radius: 10px;
    box-shadow: 2px 2px 4px #B6B6B6;
  }

  @media screen and (max-width: 1200px) {
    .dashboardexperiences-grid, .dashboardexperiences-content-map {
      display: flex;
      flex-direction: column;
    }
  }

  @media screen and (max-width: 700px) {
  .dashboardexperiences-map {
    aspect-ratio: 1 / 1;
  }
  }

  @media screen and (max-width: 500px) {
    .dashboardexperiences-content {
      padding: 15px;
    }

    .dashboardexperiences-bottom {
      flex-wrap: wrap;
    }
  }
</style>