<script setup>
  import { ref, onMounted, reactive } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import { getLoggedUser } from '@/api/userApi.js';
  import InputText from '@/components/small/InputText.vue';
  import InputFile from '@/components/small/InputFile.vue';
  import Loader from '@/components/small/Loader.vue';
  import { formatToInputDate } from '@/lib/formatToInputDate';

  const userInfo = ref(null);
  const isEditActive = ref(false);
  const previousValues = ref({});
  const form = useForm({
    firstname: '',
    lastname: '',
    phone: '',
    birthdate: '',
    image: null,
  });
  const inputData = reactive({
    "firstname": {
      "label": "Prénom",
      "type": "text",
      "id": "firstname",
      "isRequired": true,
      "isDisabled": true,
      "tabindex": 1,
      "placeholder": ""
    },
    "lastname": {
      "label": "Nom",
      "type": "text",
      "id": "lastname",
      "isRequired": true,
      "isDisabled": true,
      "tabindex": 2,
      "placeholder": ""
    },
    "email": {
      "label": "Email",
      "type": "email",
      "id": "email",
      "isRequired": true,
      "isDisabled": true,
      "tabindex": 3,
      "placeholder": ""
    },
    "phone": {
      "label": "Téléphone",
      "type": "tel",
      "id": "phone",
      "isRequired": false,
      "isDisabled": true,
      "tabindex": 4,
      "placeholder": ""
    },
    "birthdate": {
      "label": "Date de naissance",
      "type": "date",
      "id": "birthdate",
      "isRequired": false,
      "isDisabled": true,
      "tabindex": 5,
      "placeholder": ""
    },
    "image": {
      "label": "Modifier l'image de profil",
      "id": "image",
      "isRequired": false,
      "isDisabled": true,
      "tabindex": 6,
    },
  })

  function editFields() {
    const editableFields = ['firstname', 'lastname', 'phone', 'birthdate', 'image'];

    if (!isEditActive.value) {
      previousValues.value = {
        firstname: form.firstname,
        lastname: form.lastname,
        phone: form.phone,
        birthdate: form.birthdate,
        image: form.image,
      };
    } else {
      form.firstname = previousValues.value.firstname || '';
      form.lastname = previousValues.value.lastname || '';
      form.phone = previousValues.value.phone || '';
      form.birthdate = previousValues.value.birthdate || '';
      form.image = null;
    }

    editableFields.forEach(field => {
      inputData[field].isDisabled = !inputData[field].isDisabled;
    });

    isEditActive.value = !isEditActive.value;
  }

  async function loadLoggedUser() {
    const response = await getLoggedUser();
    userInfo.value = response.data;

    form.firstname = userInfo.value.firstname || '';
    form.lastname = userInfo.value.lastname || '';
    form.email = userInfo.value.email || '';
    form.phone = userInfo.value.phone || '';
    form.birthdate = formatToInputDate(userInfo.value.birthdate) || '';
    form.image = userInfo.value.image || '';
  };

  onMounted(() => {
    loadLoggedUser();
  });

  async function submit() {
    form.submit('post', '/update-self-user', {
      method: 'put',
      forceFormData: true,
      onSuccess: async () => {
        isEditActive.value = false;
        ['firstname', 'lastname', 'phone', 'birthdate'].forEach(field => {
          inputData[field].isDisabled = true;
        });
        await loadLoggedUser();
      },
    });
  }
</script>

<template>
  <div class="dashboardparameters">
    <div class="dashboardparameters-profil">
      <div class="dashboardparameters-profil-content" v-if="userInfo">
        <div class="dashboardparameters-image-box">
          <img v-if="userInfo.image_path" :src="'/' + userInfo.image_path" alt="Image de l'utilisateur" class="dashboardparameters-image"/>
        </div>
        <p class="dashboardparameters-profil-name">{{ userInfo.firstname }} {{ userInfo.lastname }}</p>
        <p class="dashboardparameters-profil-role">{{ userInfo.role }}</p>
      </div>
      <Loader v-else />
    </div>
    
    <form @submit.prevent="submit" class="dashboardparameters-profil-details" enctype="multipart/form-data">
      <h2>Détails du profil</h2>
      <div class="dashboardparameters-grid" v-if="userInfo">
        <InputText v-model="form.firstname" :inputData="inputData['firstname']" :error="form.errors.firstname" />
        <InputText v-model="form.lastname" :inputData="inputData['lastname']" :error="form.errors.lastname" />
        <InputText v-model="form.email" :inputData="inputData['email']" :error="form.errors.email" />
        <InputText v-model="form.phone" :inputData="inputData['phone']" :error="form.errors.phone" />
        <InputText v-model="form.birthdate" :inputData="inputData['birthdate']" :error="form.errors.birthdate" />
        <InputFile v-model="form.image" :inputData="inputData['image']" :error="form.errors.image" />
      </div>
      <Loader v-else />
      <div class="dashboardparameters-button-box" v-if="userInfo">
        <button v-if="!isEditActive" class="dashboardparameters-button-modify" v-on:click="editFields" :disabled="form.processing">Modifier le profil</button>
        <button v-else class="dashboardparameters-button-modify" v-on:click="editFields" :disabled="form.processing">Annuler modifications</button>
        <button v-if="isEditActive" type="submit" class="dashboardparameters-button-confirm" :disabled="form.processing">
          <Loader v-if="form.processing" />
          <span v-else>Valider</span>
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
  .dashboardparameters {
    display: flex;
    flex-direction: row;
    gap: 30px;
    width: 100%;
    min-height: 100%;
    background-color: transparent;
  }

  .dashboardparameters-profil {
    width: 30%;
    height: fit-content;
    min-width: 300px;
    padding: 40px 40px;
    background-color: #ffffff;
    border-radius: 24px;
  }

  .dashboardparameters-profil-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
  }

  .dashboardparameters-image-box {
    height: 150px;
    width: 150px;
    border-radius: 150px;
    margin-bottom: 30px;
    background-color: #747474;
  }

  .dashboardparameters-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
    user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }

  .dashboardparameters-profil-name {
    width: 100%;
    overflow-wrap: break-word;
    text-wrap: wrap;
    font-size: 28px;
    text-align: center;
  }

  .dashboardparameters-profil-role {
    margin-top: 5px;
    font-size: 16px;
  }

  .dashboardparameters-profil-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 40px 40px;
    background-color: #ffffff;
    border-radius: 24px;
  }

  h2 {
    margin-bottom: 40px;
    font-family: Calibri, sans-serif;
    color: #000000;
  }

  .dashboardparameters-user-info-title {
    font-size: 28px;
  }

  .dashboardparameters-user-info-text {
    font-size: 18px;
  }

  .dashboardparameters-grid {
    display: grid;
    gap: 30px;
    grid-template-columns: repeat(2, 1fr);
  }

  .dashboardparameters-button-box {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
    gap: 10px;
  }

  .dashboardparameters-button-confirm {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    max-height: 100%;
    padding: 0 15px;
    border: 0;
    border-radius: 10px;
    background-color: #296242;
    color: #ffffff;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .dashboardparameters-button-confirm:hover {
    background-color: #357d54;
  }

  .dashboardparameters-button-modify {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    max-height: 100%;
    padding: 0 15px;
    border: solid 1px #5D6679;
    border-radius: 10px;
    background-color: transparent;
    color: #5D6679;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .dashboardparameters-button-modify:hover {
      background-color: #5D6679;
      color: #ffffff;
  }

  @media screen and (max-width: 1400px) {
    .dashboardparameters {
      flex-direction: column;
    }

    .dashboardparameters-profil {
      width: 100%;
    }
  }

  @media screen and (max-width: 1200px) {
    .dashboardparameters-grid {
      display: flex;
      flex-direction: column;
    }
  }

  @media screen and (max-width: 600px) {
    .dashboardparameters-profil {
      min-width: auto;
    }

    .dashboardparameters {
      gap: 10px;
    }
  }

  @media screen and (max-width: 500px) {
    .dashboardparameters-profil {
      padding: 40px 20px;
    }

    .dashboardparameters-profil-details {
      padding: 40px 20px;
    }

    .dashboardparameters-button-box {
      flex-direction: column;
    }
  }

</style>