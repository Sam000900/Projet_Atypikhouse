<script setup>
  import { initMap, updateMarkerPosition, inputLatitude, inputLongitude } from '@/lib/dynamicGoogleMap.js';
  const props = defineProps(['formData']);

  const updatePositionFormData = (newCoords) => {
    props.formData.latitude = newCoords[0];
    props.formData.longitude = newCoords[1];
  };

  initMap(props.formData.latitude, props.formData.longitude, updatePositionFormData);
</script>

<template>
  <div class="housinggeneralsinfos">
    <h2 class="housinggeneralsinfos-title">Informations générales du logement</h2>
    <div class="housinggeneralsinfos-content">

      <div class="housinggeneralsinfos-input-box">
        <label for="name" class="housinggeneralsinfos-label">Nom du logement</label>
        <input
          id="name"
          type="text"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="1"
          v-model="props.formData.name"
          autocomplete="name"
          placeholder="Ex: Cabane perché avec vue sur lac"
        />
      </div>
      
      <div class="housinggeneralsinfos-input-box">
        <label for="type" class="housinggeneralsinfos-label">Type de logement</label>
        <select
          id="type"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="2"
          v-model="props.formData.type"
          autocomplete="type"
        >
          <option disabled value="">--Choisissez le type de logement--</option>
          <option value="Cabane">Cabane</option>
          <option value="Yourte">Yourte</option>
          <option value="Bulle">Bulle</option>
          <option value="Igloo">Igloo</option>
          <option value="Maison">Maison</option>
          <option value="Péniche">Péniche</option>
          <option value="Chalet">Chalet</option>
        </select>
      </div>

      <div class="housinggeneralsinfos-input-box">
        <label for="area" class="housinggeneralsinfos-label">Superficie (m²)</label>
        <input
          id="area"
          type="number"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="3"
          v-model="props.formData.area"
          autocomplete="area"
          placeholder="60"
        />
      </div>
      
      <div class="housinggeneralsinfos-input-box">
        <label for="capacity" class="housinggeneralsinfos-label">Capacité d'accueil</label>
        <input
          id="capacity"
          type="number"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="4"
          v-model="props.formData.capacity"
          autocomplete="capacity"
          placeholder="Nombre de personnes max"
        />
      </div>

      <div class="housinggeneralsinfos-input-box">
        <label for="bedrooms" class="housinggeneralsinfos-label">Nombre de chambres</label>
        <input
          id="bedrooms"
          type="number"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="5"
          v-model="props.formData.bedrooms"
          autocomplete="bedrooms"
          placeholder="2"
        />
      </div>

      <div class="housinggeneralsinfos-input-box">
        <label for="department" class="housinggeneralsinfos-label">Département du logement</label>
        <input
          id="department"
          type="text"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="6"
          v-model="props.formData.department"
          autocomplete="department"
          placeholder="Ex: Landes"
        />
      </div>

      <div class="housinggeneralsinfos-input-box">
        <label for="municipality" class="housinggeneralsinfos-label">Commune du logement</label>
        <input
          id="municipality"
          type="text"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="7"
          v-model="props.formData.municipality"
          autocomplete="municipality"
          placeholder="Ex: Luxey"
        />
      </div>

      <div class="housinggeneralsinfos-input-box">
        <label for="address" class="housinggeneralsinfos-label">Adresse complète</label>
        <input
          id="address"
          type="text"
          class="housinggeneralsinfos-input-text"
          required
          autofocus
          :tabindex="8"
          v-model="props.formData.address"
          autocomplete="address"
          placeholder="Pays, ville, code postal, rue"
          />
      </div>
      
      <div class="housinggeneralsinfos-input-box">
        <label for="description" class="housinggeneralsinfos-label">Description détaillée</label>
        <textarea
          id="description"
          class="housinggeneralsinfos-textarea"
          required
          autofocus
          :tabindex="9"
          v-model="props.formData.description"
          autocomplete="description"
          placeholder="Présentation du logement ambiance, point forts ..."
        ></textarea>
      </div>
    </div>

    <div class="housinggeneralsinfos-map-box">
      <p class="housinggeneralsinfos-label">Coordonnées du logement</p>

      <div class="housinggeneralsinfos-content-map">
        <div class="housinggeneralsinfos-input-box">
          <label for="latitude" class="housinggeneralsinfos-label">Latitude</label>
          <input
            id="latitude"
            type="number"
            step="any"
            class="housinggeneralsinfos-input-text"
            required
            autofocus
            :tabindex="10"
            v-model="props.formData.latitude"
            @input="updateMarkerPosition()"
            ref="inputLatitude"
            autocomplete="latitude"
            placeholder="48.85341"
          />
        </div>

        <div class="housinggeneralsinfos-input-box">
          <label for="longitude" class="housinggeneralsinfos-label">Longitude</label>
          <input
            id="longitude"
            type="number"
            step="any"
            class="housinggeneralsinfos-input-text"
            required
            autofocus
            :tabindex="11"
            v-model="props.formData.longitude"
            @input="updateMarkerPosition()"
            ref="inputLongitude"
            autocomplete="longitude"
            placeholder="2.3488"
          />
        </div>
      </div>

      <div id="map" class="housinggeneralsinfos-map"></div>
    </div>
  </div>
</template>

<style scoped>
  .housinggeneralsinfos {
    display: flex;
    flex-direction: column;
  }

  .housinggeneralsinfos-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housinggeneralsinfos-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
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

  .housinggeneralsinfos-input-box {
    display: flex;
    flex-direction: column;
  }

  .housinggeneralsinfos-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .housinggeneralsinfos-input-text {
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

  .housinggeneralsinfos-textarea {
    height: 120px;
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

  @media screen and (max-width: 1200px) {
    .housinggeneralsinfos-content {
      grid-template-columns: 1fr;
      row-gap: 20px;
      column-gap: 0px;
      margin: 20px 0;
    }

    .housinggeneralsinfos-map-box {
      margin-top: 0;
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