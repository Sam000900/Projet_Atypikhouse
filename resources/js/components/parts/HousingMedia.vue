<script setup>
  import { ref, watch } from 'vue'

  const props = defineProps(['formData', 'storedImagesData']);
  const emit = defineEmits(['update:images'])
  const images = ref([...props.formData.images] ?? []);
  const isDragging = ref(false);
  const fileInput = ref(null)
  const isGallery = ref(true)

  watch(images, (newImages) => {
    emit('update:images', newImages)
  }, { deep: true })

  function selectFiles() {
    fileInput.value.click()
  }

  function onFileSelect(e) {
    const files = e.target.files;
    if (files.length > 0) {
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = (event) => {
          images.value.push({
            url: event.target.result,
            file: file,
          });
        };
        reader.readAsDataURL(file);
      }
    }
  }

  function onDragOver(e) {
    e.preventDefault();
    isDragging.value = true;
  }

  function onDragLeave(e) {
    e.preventDefault();
    isDragging.value = false;
  }

  function onDrop(e) {
    e.preventDefault();
    isDragging.value = false;
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = (event) => {
          images.value.push({
            url: event.target.result,
            file: file,
          });
        };
        reader.readAsDataURL(file);
      }
    }
  }

  /* Images Parameters */

  function setMainImage(index) {
    const mainImage = images.value.splice(index, 1)[0];
    images.value.unshift(mainImage);
  }

  function deleteImage(index) {
    images.value.splice(index, 1);
  }

  function switchImagesComponents() {
    isGallery.value = !isGallery.value;
  }
</script>

<template>
  <div class="housingmedia">
    <h2 class="housingmedia-title">Photos et Médias</h2>
    <div class="housingmedia-switch-box">
      <label>
        <input type="checkbox" class="housingmedia-switch-checkbox" @click="switchImagesComponents" checked>
        <span class="housingmedia-switch-slider"></span>
      </label>
      <div>
        <p class="housingmedia-upload-text" v-if="isGallery">Galerie d'images du logement</p>
        <p class="housingmedia-upload-text" v-else>Téléversement d'images</p>
      </div>
    </div>

    <div class="housingmedia-content" v-if="isGallery">
      <div class="housingmedia-gallery-images-box" :style="props.storedImagesData.length === 0 && {'justifyContent':'center', 'alignContent':'center'}">
        <p class="housingmedia-upload-text" v-if="props.storedImagesData.length === 0">Il n'y a aucune image dans la galerie pour ce logement</p>
        
        <div class="housingmedia-image-container" v-for="(image, index) in props.storedImagesData" :key="index">
          <img class="housingmedia-image" :src="'/' + image.image_path" alt="Image utilisateur"/>
        </div>
      </div>
    </div>

    <div class="housingmedia-content" v-else>
      <div class="housingmedia-left">
        <div class="housingmedia-upload-box">
          <div
            class="housingmedia-upload"
            @dragover.prevent="onDragOver"
            @dragleave.prevent="onDragLeave"
            @drop.prevent="onDrop"
          >
            <VsxIcon iconName="Image" color="#5D6679" size="60" type="linear" />
            <span role="button" class="housingmedia-select-button" @click="selectFiles">Sélectionner</span>
            <p class="housingmedia-upload-text">Minimum 5 photos recommandées</p>
            <input
              name="images[]"
              type="file"
              class="housingmedia-file-input"
              ref="fileInput"
              accept="image/png, image/jpeg"
              multiple
              @change="onFileSelect" />
          </div>
          <div class="housingmedia-upload-box">
            <button type="button" class="housingmedia-upload-button">Téléverser</button>
          </div>
        </div>
      </div>
      <div class="housingmedia-right">
        <div class="housingmedia-images-box">
          <div class="housingmedia-image-container" v-for="(image, index) in props.formData.images" :key="index">
            <span class="housingmedia-image-main" v-if="index === 0">Image principale</span>
            <img class="housingmedia-image" :src="image.url" alt="Image utilisateur" @click="setMainImage(index)" />
            <span class="housingmedia-image-delete" @click="deleteImage(index)">Supprimer</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .housingmedia {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .housingmedia-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housingmedia-switch-box {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 15px;
  }

  .housingmedia-switch-checkbox {
    display: none;
  }

  .housingmedia-switch-slider {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    height: 36px;
    width: 70px;
    border-radius: 70px;
    background-color: #D6D6D6;
    cursor: pointer;
    transition: 0.25s;
  }

  .housingmedia-switch-slider:before {
    content: '';
    width: 28px;
    height: 28px;
    margin: 0 4px;
    background-color: #ffffff;
    border-radius: 28px;
  }

  .housingmedia-switch-checkbox:checked + .housingmedia-switch-slider {
    background-color: #296242;
  }

  .housingmedia-switch-checkbox:checked + .housingmedia-switch-slider {
    justify-content: flex-start;
  }

  .housingmedia-content {
    flex: 1;
    display: flex;
    margin-top: 20px;
  }

  .housingmedia-left {
    display: flex;
    align-items: center;
    width: 40%;
  }

  .housingmedia-right {
    flex: 1;
    display: flex;
  }

  .housingmedia-gallery-images-box {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: start;
    gap: 10px;
    width: 100%;
    height: 100%;
    padding: 10px;
    border-radius: 20px;
    border: solid #D6D6D6 3px;
  }

  .housingmedia-images-box {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: start;
    gap: 10px;
    width: 100%;
    height: 100%;
    margin-left: 20px;
    padding: 10px;
    border-radius: 20px;
    border: solid #D6D6D6 3px;
  }

  .housingmedia-image-container {
    z-index: 0;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    width: 200px;
    border-radius: 10px;
    background-color: #747474;
  }

  .housingmedia-image-container:hover .housingmedia-image-delete {
    display: block;
  }

  .housingmedia-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: inherit;
  }

  .housingmedia-image-main {
    position: absolute;
    top: 0;
    width: 100%;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #ffffff;
    text-align: center;
    background-color: #296242;
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
    cursor: pointer;
  }

  .housingmedia-image-delete {
    display: none;
    position: absolute;
    bottom: 0;
    width: 100%;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #ffffff;
    text-align: center;
    background-color: crimson;
    border-bottom-left-radius: inherit;
    border-bottom-right-radius: inherit;
    cursor: pointer;
  }

  .housingmedia-upload-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    width: 100%;
  }

  .housingmedia-upload {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
    height: 300px;
    border: dotted #D6D6D6 3px;
    border-radius: 20px;
  }

  .housingmedia-select-button {
    margin-top: 20px;
    margin-bottom: 5px;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #296242;
    text-decoration: underline;
    cursor: pointer;
  }

  .housingmedia-upload-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #5D6679;
    text-align: center;
  }

  .housingmedia-file-input {
    display: none;
  }

  .housingmedia-upload-button {
    height: 50px;
    padding: 10px 30px;
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

  .housingmedia-upload-button:hover {
    background-color: #357d54;
  }

  @media screen and (max-width: 1250px) {
    .housingmedia-content {
      flex-direction: column;
    }

    .housingmedia-left {
      width: 100%;
      margin-bottom: 20px;
    }

    .housingmedia-right {
      width: 100%;
    }
    
    .housingmedia-images-box {
      margin-left: 0;
    }
  }
</style>