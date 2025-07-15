<script setup>
  import { ref } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';
  import axios from 'axios';

  const emit = defineEmits(['emitResetSelectedArticle']);
  const props = defineProps(['articleData']);
  const errors = ref(null);
  const responseStatus = ref(null);

  const form = useForm({
    name: props.articleData?.name ?? '',
    text: props.articleData?.text ?? '',
    conclusion: props.articleData?.conclusion ?? '',
    image: null,
  });

  async function submit() {
    const formData = new FormData();
    formData.append('_method', 'put');
    formData.append('name', form.name);
    formData.append('text', form.text);
    formData.append('conclusion', form.conclusion);
    if (form.image instanceof File) {
      formData.append('image', form.image);
    }

    if (props.articleData?.id) {
      await axios
        .post(`/update-article/${props.articleData.id}`, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
        .then(response => {
          responseStatus.value = response.status;
          errors.value = null;
        })
        .catch((error) => errors.value = error.response.data.errors);
    }
    else {
      await axios
        .post('/register-article', form, { headers: { 'Content-Type': 'multipart/form-data' } })
        .then(response => {
          responseStatus.value = response.status;
          errors.value = null;
        })
        .catch((error) => errors.value = error.response.data.errors);
    }
  };

  function handleFileChange(e) {
    const file = e.target.files[0];
    if (file) { form.image = file; }
  }
</script>

<template>
  <div class="dashboardarticles">
    <form @submit.prevent="submit" class="dashboardarticles-form" enctype="multipart/form-data">
      <div class="dashboardarticles-content">
        <h2 class="dashboardarticles-title">Créer un article</h2>

        <div v-if="props.articleData?.image_path">
          <p class="dashboardarticles-label">Image actuelle de l'article :</p>
          <div class="dashboardarticles-image-box">
            <img class="dashboardarticles-image" :src="'/' + props.articleData?.image_path" alt="Image de l'article" />
          </div>
        </div>

        <div class="dashboardarticles-input-box">
          <label for="image" class="dashboardarticles-label" v-if="props.articleData?.image_path">Modifier l'image de l'article</label>
          <label for="image" class="dashboardarticles-label" v-else>Image de l'article</label>
          <input
            id="image"
            type="file"
            class="dashboardarticles-input-file"
            accept="image/*"
            v-if="props.articleData?.image_path"
            autofocus
            :tabindex="1"
            @change="(e) => handleFileChange(e)"
          />
          <input
            id="image"
            type="file"
            class="dashboardarticles-input-file"
            accept="image/*"
            v-else
            required
            autofocus
            :tabindex="1"
            @change="(e) => handleFileChange(e)"
          />
        </div>
        <div class="dashboardarticles-validations-errors" v-if="errors?.image">
          <p v-for="error in errors.image">{{ error }}</p>
        </div>

        <div class="dashboardarticles-input-box">
          <label for="name" class="dashboardarticles-label">Titre de l'article</label>
          <input
            id="name"
            type="text"
            class="dashboardarticles-input-text"
            required
            autofocus
            :tabindex="2"
            v-model="form.name"
            autocomplete="name"
            placeholder="Ex: Comment bien organiser ses vacances"
          />
        </div>
        <div class="dashboardarticles-validations-errors" v-if="errors?.name">
          <p v-for="error in errors.name">{{ error }}</p>
        </div>

        <div class="dashboardarticles-input-box">
          <label for="text" class="dashboardarticles-label">Contenu de l'article</label>
          <textarea
            id="text"
            class="dashboardarticles-textarea"
            required
            autofocus
            :tabindex="3"
            v-model="form.text"
            autocomplete="text"
            placeholder="..."
          ></textarea>
        </div>
        <div class="dashboardarticles-validations-errors" v-if="errors?.text">
          <p v-for="error in errors.text">{{ error }}</p>
        </div>

        <div class="dashboardarticles-input-box">
          <label for="conclusion" class="dashboardarticles-label">Conclusion de l'article</label>
          <textarea
            id="conclusion"
            class="dashboardarticles-textarea"
            required
            autofocus
            :tabindex="4"
            v-model="form.conclusion"
            autocomplete="conclusion"
            placeholder="..."
          ></textarea>
        </div>
        <div class="dashboardarticles-validations-errors" v-if="errors?.conclusion">
          <p v-for="error in errors.conclusion">{{ error }}</p>
        </div>
      </div>

      <div class="dashboardarticles-bottom">
        <div class="dashboardarticles-validations-success" v-if="responseStatus === 200">
          Enregistrement réussi
        </div>
        <button
          class="dashboardarticles-button-cancel"
          type="button"
          :disabled="form.processing"
          @click="emit('emitResetSelectedArticle');
        ">
          Annuler
        </button>
        <button
          class="dashboardarticles-button-save"
          type="submit"
          :disabled="form.processing"
        >
          Enregistrer
          <LoaderCircle v-if="form.processing" class="dashboardarticles-form-loader" />
        </button>
      </div>

    </form>
  </div>
</template>

<style scoped>
  .dashboardarticles {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    border-radius: 16px;
    background-color: #ffffff;
  }

  .dashboardarticles-form {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .dashboardarticles-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 20px 40px;
  }

  .dashboardarticles-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
    margin-bottom: 20px;
  }

  .dashboardarticles-image-box {
    display: flex;
    width: 300px;
    max-width: 100%;
    aspect-ratio: 1/1;
    border-radius: 8px;
  }

  .dashboardarticles-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
  }

  .dashboardarticles-input-box {
    display: flex;
    flex-direction: column;
  }

  .dashboardarticles-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .dashboardarticles-input-file {
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

  .dashboardarticles-input-file::file-selector-button {
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

  .dashboardarticles-input-text {
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

  .dashboardarticles-textarea {
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

  .dashboardarticles-bottom {
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

  .dashboardarticles-button-cancel {
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

  .dashboardarticles-button-cancel:hover {
    background-color: crimson;
    color: #ffffff;
  }

  .dashboardarticles-button-save {
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

  .dashboardarticles-button-save:hover {
    background-color: #357d54;
  }


  .dashboardarticles-form-loader {
    animation: 0.5s linear infinite loader; 
  }

  .dashboardarticles-validations-errors {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 100%;
    color: crimson;
  }

  .dashboardarticles-validations-success {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    line-height: 100%;
    color: #296242;
  }

  @media screen and (max-width: 500px) {
    .dashboardarticles-content {
      padding: 15px;
    }

    .dashboardarticles-bottom {
      flex-wrap: wrap;
    }
  }
</style>