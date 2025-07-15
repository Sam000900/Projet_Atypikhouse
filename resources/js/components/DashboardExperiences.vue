<script setup>
  import { ref } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';
  import axios from 'axios';
  import { initMap, updateMarkerPosition, inputLatitude, inputLongitude } from '@/lib/dynamicGoogleMap.js';

  const emit = defineEmits(['emitResetSelectedExperience']);
  const props = defineProps(['experienceData']);
  const errors = ref(null);
  const responseStatus = ref(null);

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

    const updatePositionExperienceData = (newCoords) => {
      form.latitude = newCoords[0];
      form.longitude = newCoords[1];
    };

    initMap(form.latitude, form.longitude, updatePositionExperienceData);

  async function submit() {
    const formData = new FormData();
    formData.append('_method', 'put');
    formData.append('name', form.name);
    formData.append('type', form.type);
    formData.append('location', form.location);
    formData.append('address', form.address);
    formData.append('max_number_persons', form.max_number_persons);
    formData.append('service_duration', form.service_duration);
    formData.append('latitude', form.latitude);
    formData.append('longitude', form.longitude);
    formData.append('price', form.price);
    formData.append('additional_information', form.additional_information);
    if (form.image instanceof File) {
      formData.append('image', form.image);
    }

    if (props.experienceData?.id) {
      await axios
        .post(`/update-experience/${props.experienceData.id}`, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
        .then(response => { responseStatus.value = response.status; errors.value = null; })
        .catch((error) => errors.value = error.response.data.errors);
    }
    else {
      await axios
        .post('/register-experience', form, { headers: { 'Content-Type': 'multipart/form-data' } })
        .then(response => { responseStatus.value = response.status; errors.value = null; })
        .catch((error) => {errors.value = error.response.data.errors;  console.log(error.response.data.message)});
    }
  };

  function handleFileChange(e) {
    const file = e.target.files[0];
    if (file) { form.image = file; }
    console.log(form.image);

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
          <div class="dashboardexperiences-input-box">
            <label for="image" class="dashboardexperiences-label" v-if="props.experienceData?.image_path">Modifier l'image de l'expérience</label>
            <label for="image" class="dashboardexperiences-label" v-else>Image de l'expérience</label>
            <input
              id="image"
              type="file"
              class="dashboardexperiences-input-file"
              accept="image/*"
              v-if="props.experienceData?.image_path"
              autofocus
              :tabindex="1"
              @change="(e) => handleFileChange(e)"
            />
            <input
              id="image"
              type="file"
              class="dashboardexperiences-input-file"
              accept="image/*"
              v-else
              required
              autofocus
              :tabindex="1"
              @change="(e) => handleFileChange(e)"
            />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.image">
              <p v-for="error in errors.image">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="name" class="dashboardexperiences-label">Titre de l'expérience</label>
            <input
              id="name"
              type="text"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="2"
              v-model="form.name"
              autocomplete="name"
              placeholder="Ex: Comment bien organiser ses vacances"
            />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.name">
              <p v-for="error in errors.name">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="type" class="dashboardexperiences-label">Type d'expérience</label>
            <select
              id="type"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="3"
              v-model="form.type"
              autocomplete="type"
            >
              <option disabled value="">--Choisissez le type de l'expérience--</option>
              <option value="Aventures">Aventures</option>
              <option value="Gastronomie locale">Gastronomie locale</option>
              <option value="Séjours bien-êtres">Séjours bien-êtres</option>
            </select>
            <div class="dashboardexperiences-validations-errors" v-if="errors?.type">
              <p v-for="error in errors.type">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="location" class="dashboardexperiences-label">Département de l'expérience</label>
            <input
              id="location"
              type="text"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="4"
              v-model="form.location"
              autocomplete="location"
              placeholder="Ex: Landes"
            />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.location">
              <p v-for="error in errors.location">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="address" class="dashboardexperiences-label">Adresse complète</label>
            <input
              id="address"
              type="text"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="5"
              v-model="form.address"
              autocomplete="address"
              placeholder="Pays, ville, code postal, rue"
              />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.address">
              <p v-for="error in errors.address">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="max_number_persons" class="dashboardexperiences-label">Nombre de personnes maximum</label>
            <input
              id="max_number_persons"
              type="number"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="6"
              v-model="form.max_number_persons"
              autocomplete="max_number_persons"
              placeholder="2"
            />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.max_number_persons">
              <p v-for="error in errors.max_number_persons">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="price" class="dashboardexperiences-label">Prix de l'expérience (€)</label>
            <input
              id="price"
              type="number"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="7"
              v-model="form.price"
              autocomplete="price"
            />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.price">
              <p v-for="error in errors.price">{{ error }}</p>
            </div>
          </div>

          <div class="dashboardexperiences-input-box">
            <label for="service_duration" class="dashboardexperiences-label">Durée de l'expérience</label>
            <input
              id="service_duration"
              type="time"
              class="dashboardexperiences-input-text"
              required
              autofocus
              :tabindex="8"
              v-model="form.service_duration"
              autocomplete="service_duration"
            />
            <div class="dashboardexperiences-validations-errors" v-if="errors?.service_duration">
              <p v-for="error in errors.service_duration">{{ error }}</p>
            </div>
          </div>
        </div>

        <div class="dashboardexperiences-input-box">
          <label for="additional_information" class="dashboardexperiences-label">Informations additionnelles</label>
          <textarea
            id="additional_information"
            class="dashboardexperiences-textarea"
            required
            autofocus
            :tabindex="9"
            v-model="form.additional_information"
            autocomplete="additional_information"
            placeholder="..."
          ></textarea>
          <div class="dashboardexperiences-validations-errors" v-if="errors?.additional_information">
            <p v-for="error in errors.additional_information">{{ error }}</p>
          </div>
        </div>

        <div class="dashboardexperiences-map-box">
          <p class="dashboardexperiences-label">Coordonnées de l'expérience</p>

          <div class="dashboardexperiences-content-map">
            <div class="dashboardexperiences-input-box">
              <label for="latitude" class="dashboardexperiences-label">Latitude</label>
              <input
                id="latitude"
                type="number"
                step="any"
                class="dashboardexperiences-input-text"
                required
                autofocus
                :tabindex="10"
                v-model="form.latitude"
                @input="updateMarkerPosition"
                ref="inputLatitude"
                autocomplete="latitude"
                placeholder="48.85341"
              />
              <div class="dashboardexperiences-validations-errors" v-if="errors?.latitude">
                <p v-for="error in errors.latitude">{{ error }}</p>
              </div>
            </div>

            <div class="dashboardexperiences-input-box">
              <label for="longitude" class="dashboardexperiences-label">Longitude</label>
              <input
                id="longitude"
                type="number"
                step="any"
                class="dashboardexperiences-input-text"
                required
                autofocus
                :tabindex="11"
                v-model="form.longitude"
                @input="updateMarkerPosition"
                ref="inputLongitude"
                autocomplete="longitude"
                placeholder="2.3488"
              />
              <div class="dashboardexperiences-validations-errors" v-if="errors?.longitude">
                <p v-for="error in errors.longitude">{{ error }}</p>
              </div>
            </div>
          </div>

          <div id="map" class="dashboardexperiences-map"></div>
        </div>

      </div>

      <div class="dashboardexperiences-bottom">
        <div class="dashboardexperiences-validations-success" v-if="responseStatus === 200">
          Enregistrement réussi
        </div>
        <button
          class="dashboardexperiences-button-cancel"
          type="button"
          :disabled="form.processing"
          @click="emit('emitResetSelectedExperience');
        ">
          Annuler
        </button>
        <button
          class="dashboardexperiences-button-save"
          type="submit"
          :disabled="form.processing"
        >
          Enregistrer
          <LoaderCircle v-if="form.processing" class="dashboardexperiences-form-loader" />
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
    column-gap: 30px;
    row-gap: 10px;
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

  @media screen and (max-width: 500px) {
    .dashboardexperiences-content {
      padding: 15px;
    }

    .dashboardexperiences-bottom {
      flex-wrap: wrap;
    }
  }
</style>