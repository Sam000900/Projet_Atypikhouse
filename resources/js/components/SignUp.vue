<script setup>
  import { Link, useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';

  import imgLogement from '@/../../public/images/img-maison-bois-a-cote-de-tente.jpg'
  import imgLogoAtypikHouse from '@/../../public/images/logo-atypik-house.png'

  const form = useForm({
    lastname: '',
    firstname: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    birthdate: '',
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
            <div class="signup-input-block">
              <label class="signup-form-label">Nom</label>
              <input
                id="lastname"
                type="text"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="1"
                v-model="form.lastname"
                autocomplete="lastname"
              />
            </div>
            <div class="signup-input-block">
              <label class="signup-form-label">Prénom</label>
              <input
                id="firstname"
                type="text"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="2"
                v-model="form.firstname"
                autocomplete="firstname"
              />
            </div>
          </div>

          <div class="signup-inputs-line">
            <div class="signup-input-block">
              <label class="signup-form-label">Email</label>
              <input
                id="email"
                type="email"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="3"
                v-model="form.email"
                autocomplete="email"
              />
            </div>
            <div class="signup-input-block">
              <label class="signup-form-label">Téléphone</label>
              <input
                id="phone"
                type="tel"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="4"
                v-model="form.phone"
                autocomplete="phone"
              />
            </div>
          </div>

          <div class="signup-inputs-line">
            <div class="signup-input-block">
              <label class="signup-form-label">Mot de passe</label>
              <input
                id="password"
                type="password"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="5"
                v-model="form.password"
                autocomplete="password"
              />
            </div>
            <div class="signup-input-block">
              <label class="signup-form-label">Confirmation du mot de passe</label>
              <input
                id="password_confirmation"
                type="password"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="6"
                v-model="form.password_confirmation"
                autocomplete="password_confirmation"
              />
            </div>
          </div>

          <div class="signup-inputs-line">
            <div class="signup-input-block">
              <label class="signup-form-label">Date de naissance</label>
              <input
                id="birthdate"
                type="date"
                class="signup-form-input-text"
                required
                autofocus
                :tabindex="7"
                v-model="form.birthdate"
                autocomplete="birthdate"
              />
            </div>
          </div>

          <div class="signup-terms-box">
            <p class="signup-terms-text">
              En cliquant sur Accepter et continuer, j'accepte les 
              <Link :href="route('conditions-generales-utilisation')" class="signup-form-redirect">Conditions générales d'utilisation</Link>, les 
              <Link :href="route('conditions-generales-ventes')" class="signup-form-redirect">Conditions de service relatives aux paiements</Link>, 
              la Politique de non-discrimination et je reconnais avoir pris connaissance de la Politique de confidentialité d'Atypik House.
            </p>
          </div>

          <button type="submit" class="signup-form-input-submit" tabindex="8" :disabled="form.processing">
            Accepter et continuer
            <LoaderCircle v-if="form.processing" class="signup-form-loader" />
          </button>


        </form>
        <div class="signup-link-box">
          <p class="signup-form-text">
            Vous avez déjà un compte ? 
            <Link :href="route('connexion')" class="signup-form-redirect">Se Connecter</Link>
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
    min-height: 100vh;
    width: 600px;
  }

  .signup-image {
    min-height: 100vh;
    height: 100%;
    width: 100%;
    object-fit: cover;
  }

  .signup-form-box {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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
    width: 150px;
    aspect-ratio: 1/1;
    margin-bottom: 25px;
  }

  .signup-form-title {
    font-family: Calibri, sans-serif;
    font-size: 26px;
    font-weight: bold;
    color: #296242;
    margin-bottom: 25px;
  }

  .signup-inputs-line {
    display: flex;
    justify-content: flex-start;
    gap: 20px;
    width: 100%;
  }

  .signup-input-block {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 50%;
  }

  .signup-form-label {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #7F7E83;
    margin-bottom: 5px;
  }

  .signup-form-input-text {
    height: 40px;
    width: 100%;
    border: 0;
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
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
      gap: 0;
    }

    .signup-input-block {
      width: 100%;
    }

    .signup-link-box {
      flex-direction: column;
    }

    .signup-separator {
      display: none;
    }
  }
</style>