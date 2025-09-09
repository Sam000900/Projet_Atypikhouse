<script setup>
  import { reactive } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import InputFile from '@/components/small/InputFile.vue';
  import InputText from '@/components/small/InputText.vue';
  import Textarea from '@/components/small/Textarea.vue';
  import Loader from '@/components/small/Loader.vue';

  const emit = defineEmits(['emitResetSelectedArticle', 'articleUpdated']);
  const props = defineProps(['articleData']);
  const form = useForm({
    name: props.articleData?.name ?? '',
    text: props.articleData?.text ?? '',
    conclusion: props.articleData?.conclusion ?? '',
    image: null,
  });

  const inputData = reactive({
    "image_create": {
      "label": "Image de l'article",
      "id": "image",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 1,
    },
    "image_modify": {
      "label": "Modifier l'image de l'article",
      "id": "image",
      "isRequired": false,
      "isDisabled": false,
      "tabindex": 1,
    },
    "name": {
      "label": "Titre de l'article",
      "type": "text",
      "id": "name",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 2,
      "placeholder": "Ex: Comment bien organiser ses vacances"
    },
    "text": {
      "label": "Contenu de l'article",
      "id": "text",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 3,
      "placeholder": "..."
    },
    "conclusion": {
      "label": "Conclusion de l'article",
      "id": "conclusion",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 4,
      "placeholder": "..."
    }
  });

  async function submit() {
    const isEdit = !!props.articleData?.id;
    const url = isEdit ? `/update-article/${props.articleData.id}` : '/register-article';
    const submitMethod = isEdit ? 'put' : 'post';

    form.submit('post', url, {
      method: submitMethod,
      forceFormData: true,
      onSuccess: async () => {
        emit('articleUpdated');
      },
    });
  }
</script>

<template>
  <div class="dashboardarticles">
    <form @submit.prevent="submit" class="dashboardarticles-form" enctype="multipart/form-data">
      <div class="dashboardarticles-content">
        <h2 class="dashboardarticles-title">Créer un article</h2>

        <div v-if="props.articleData?.image_path">
          <p class="dashboardarticles-image-title">Image actuelle de l'article :</p>
          <div class="dashboardarticles-image-box">
            <img class="dashboardarticles-image" :src="'/' + props.articleData?.image_path" alt="Image de l'article" />
          </div>
        </div>

        <InputFile v-if="props.articleData?.image_path" v-model="form.image" :inputData="inputData['image_modify']" :error="form.errors.image_modify" />
        <InputFile v-else v-model="form.image" :inputData="inputData['image_create']" :error="form.errors.image_create" />
        <InputText v-model="form.name" :inputData="inputData['name']" :error="form.errors.name" />
        <Textarea v-model="form.text" :inputData="inputData['text']" :error="form.errors.text" /> 
        <Textarea v-model="form.conclusion" :inputData="inputData['conclusion']" :error="form.errors.conclusion" />
      </div>

      <div class="dashboardarticles-bottom">
        <button class="dashboardarticles-button-cancel" type="button" :disabled="form.processing" @click="emit('emitResetSelectedArticle');">Annuler</button>
        <button class="dashboardarticles-button-save" type="submit" :disabled="form.processing">
          <Loader v-if="form.processing" />
          <span v-else>Enregistrer</span>
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

  .dashboardarticles-image-title {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .dashboardarticles-bottom {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
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

  @media screen and (max-width: 500px) {
    .dashboardarticles-content {
      padding: 15px;
    }

    .dashboardarticles-bottom {
      flex-wrap: wrap;
    }
  }
</style>