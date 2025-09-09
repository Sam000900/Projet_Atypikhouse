<script setup>
  import { reactive } from 'vue';
  import { Link, useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';
  import InputText from '../small/InputText.vue';
  import InputRadio from '../small/InputRadio.vue';
  import imgLogement from '@/../../public/images/img-maison-bois-a-cote-de-tente.jpg';
  import imgLogoAtypikHouse from '@/../../public/images/logo-atypik-house.png';

  const form = useForm({
    lastname: '',
    firstname: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    birthdate: '',
    role: 'tenant',
  });
  const inputData = reactive({
    "lastname": {
      "label": "Nom",
      "type": "text",
      "id": "lastname",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 1,
      "placeholder": "",
      "style": 1,
    },
    "firstname": {
      "label": "Prénom",
      "type": "text",
      "id": "firstname",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 2,
      "placeholder": "",
      "style": 1,
    },
    "email": {
      "label": "Email",
      "type": "email",
      "id": "email",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 3,
      "placeholder": "",
      "style": 1,
    },
    "phone": {
      "label": "Téléphone",
      "type": "tel",
      "id": "phone",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 4,
      "placeholder": "",
      "style": 1,
    },
    "password": {
      "label": "Mot de passe",
      "type": "password",
      "id": "password",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 5,
      "placeholder": "",
      "style": 1,
    },
    "password_confirmation": {
      "label": "Confirmation du mot de passe",
      "type": "password",
      "id": "password_confirmation",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 6,
      "placeholder": "",
      "style": 1,
    },
    "birthdate": {
      "label": "Date de naissance",
      "type": "date",
      "id": "birthdate",
      "isRequired": true,
      "isDisabled": false,
      "tabindex": 7,
      "placeholder": "",
      "style": 1,
    },
    "role": {
      "label": "Type de compte",
      "name": "role",
      "isRequired": true,
      "radioFields": [
        {"id":"tenant", "value":"Locataire", "tabindex": 8},
        {"id":"owner", "value":"Propriétaire", "tabindex": 9}
      ],
    },
  });

  const submit = () => {
      form.post(route('register'), {
          onFinish: () => form.reset('password', 'password_confirmation'),
      });
  };
</script>

<template>
  <div class="signup">
    <div class="signup-form-box">
      <div class="signup-card">
        <form @submit.prevent="submit" class="signup-form">
          <img :src="imgLogoAtypikHouse" alt="logo Atypik House" class="signup-logo" />

          <h1 class="signup-form-title">Créez un compte</h1>

          <div class="signup-inputs-line">
            <InputText v-model="form.lastname" :inputData="inputData['lastname']" :error="form.errors.lastname" />
            <InputText v-model="form.firstname" :inputData="inputData['firstname']" :error="form.errors.firstname" />
          </div>

          <div class="signup-inputs-line">
            <InputText v-model="form.email" :inputData="inputData['email']" :error="form.errors.email" />
            <InputText v-model="form.phone" :inputData="inputData['phone']" :error="form.errors.phone" />
          </div>

          <div class="signup-inputs-line">
            <InputText v-model="form.password" :inputData="inputData['password']" :error="form.errors.password" />
            <InputText v-model="form.password_confirmation" :inputData="inputData['password_confirmation']" :error="form.errors.password_confirmation" />
          </div>

          <div class="signup-inputs-line">
            <InputText v-model="form.birthdate" :inputData="inputData['birthdate']" :error="form.errors.birthdate" />
          </div>

          <InputRadio v-model="form.role" :inputData="inputData['role']" :error="form.errors.role" />

          <div class="signup-terms-box">
            <p class="signup-terms-text">
              En cliquant sur Accepter et continuer, j'accepte les 
              <Link :href="route('conditions-generales-utilisation')" class="signup-form-redirect">Conditions générales d'utilisation</Link>, les 
              <Link :href="route('conditions-generales-ventes')" class="signup-form-redirect">Conditions de service relatives aux paiements</Link>, 
              la Politique de non-discrimination et je reconnais avoir pris connaissance de la Politique de confidentialité d'Atypik House.
            </p>
          </div>

          <button type="submit" class="signup-form-input-submit" tabindex="8" :disabled="form.processing">
            Accepter et continuer <LoaderCircle v-if="form.processing" class="signup-form-loader" />
          </button>


        </form>
        <div class="signup-link-box">
          <p class="signup-form-text">
            Vous avez déjà un compte ? <Link :href="route('connexion')" class="signup-form-redirect">Se Connecter</Link>
          </p>
          <span class="signup-separator">|</span>
          <Link :href="route('accueil')" class="signup-button-home">Retour à la page d'accueil</Link>
        </div>
      </div>
    </div>
    <div class="signup-image-box">
      <img :src="imgLogement" alt="maison triangulaire en haut d'un arbre" class="signup-image" />
    </div>
  </div>
</template>

<style scoped>
  .signup {
    display: flex;
    min-height: 100vh;
  }

  .signup-image-box {
    display: flex;
    height: 100vh;
    width: 600px;
  }

  .signup-image {
    height: 100%;
    width: 100%;
    object-fit: cover;
  }

  .signup-form-box {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: auto 0;
    max-height: 100vh;
    overflow-y: auto;
  }

  .signup-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: calc(100% - 120px);
    padding: 20px 60px;
    border-radius: 12px;
  }

  .signup-form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 100%;
    max-width: 900px;
    margin-bottom: 30px;
  }

  .signup-logo {
    width: 120px;
    aspect-ratio: 1/1;
    margin-bottom: 10px;
  }

  .signup-form-title {
    font-family: Calibri, sans-serif;
    font-size: 26px;
    font-weight: bold;
    color: #296242;
    margin-bottom: 20px;
  }

  .signup-inputs-line {
    display: flex;
    justify-content: flex-start;
    gap: 20px;
    width: 100%;
    margin-bottom: 20px;
  }

  .signup-terms-box {
    display: flex;
  }

  .signup-terms-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    margin-bottom: 30px;
    text-align: left;
    margin-top: 20px;
  }

  .signup-form-redirect {
    color: #00A551;
    text-decoration: underline;
    cursor: pointer;
  }

  .signup-form-input-submit {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    height: 45px;
    border: 0;
    border-radius: 8px;
    padding: 0 30px;
    background-color: #296242;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #ffffff;
    cursor: pointer;
    transition: 0.25s;
  }

  .signup-form-input-submit:hover {
    background-color: #357d54;
  }

  .signup-link-box {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .signup-form-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
  }

  .signup-button-home {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #00A551;
    cursor: pointer;
  }

  .signup-form-loader {
    animation: 0.5s linear infinite loader; 
  }

  @keyframes loader {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
  }

  @media screen and (max-width: 1400px) {
    .signup-card {
      width: 100%;
      padding: 20px 30px;
    }
  }

  @media screen and (max-width: 1250px) {
    .signup-image-box {
      display: none;
    }

    .signup-card {
      width: 100%;
      padding: 20px 30px;
    }
  }

  @media screen and (max-width: 600px) {
    .signup-inputs-line {
      flex-direction: column;
      gap: 10px;
    }

    .signup-link-box {
      flex-direction: column;
    }

    .signup-separator {
      display: none;
    }
  }
</style>