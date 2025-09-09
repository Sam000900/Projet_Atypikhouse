<script setup>
  import { Link, useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';
  import imgLogement from '@/../../public/images/img-cabane-triangle-haut-arbre.jpg'

  const form = useForm({
      email: '',
      password: '',
      remember: false,
  });

  const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
  };
</script>

<template>
  <div class="login">
    <div class="login-image-box">
      <img :src="imgLogement" alt="maison triangulaire en haut d'un arbre" class="login-image" />
    </div>
    <div class="login-form-box">
      <div class="login-card">

        <form @submit.prevent="submit" class="login-form">
          <h1 class="login-form-title">Connectez-vous</h1>
          <p class="login-form-text">Connectez-vous pour accéder à votre compte</p>
          <div class="login-form-inputs-box">

            <label class="login-form-label" for="email">Email</label>
            <input
              id="email"
              type="email"
              aria-label="Email"
              class="login-form-input-text"
              autofocus
              required
              :tabindex="1"
              autocomplete="email"
              v-model="form.email"
            />
            <div v-if="form.errors.email" class="login-form-error">
              <p>{{ form.errors.email }}</p>
            </div>

            <label class="login-form-label" for="password">Mot de passe</label>
            <input
              id="password"
              type="password"
              aria-label="Mot de passe"
              class="login-form-input-text"
              required
              :tabindex="2"
              autocomplete="current-password"
              v-model="form.password"
            />
            <div v-if="form.errors.password" class="login-form-error">
              <p>{{ form.errors.password }}</p>
            </div>
          </div>

          <button
            type="submit"
            class="login-form-input-submit"
            :tabindex="3"
            :disabled="form.processing"
          >
            Connexion
            <LoaderCircle v-if="form.processing" class="login-form-loader" />
          </button>
        </form>

        <p class="login-form-text">
          Vous n'avez pas de compte ? 
          <Link :href="route('inscription')" class="login-form-redirect">Créer un compte</Link>
        </p>
        <div class="login-separator-methods">
          <div class="login-separator"></div>
          <p class="login-form-text">ou</p>
          <div class="login-separator"></div>
        </div>
        <button class="login-button-methods">
          <VsxIcon iconName="Google" color="black" size="25" type="linear" />
          Continuer avec Google
        </button>
        <button class="login-button-methods">
          <VsxIcon iconName="Facebook" color="black" size="25" type="linear" />
          Continuer avec Facebook
        </button>
      </div>
      <Link :href="route('accueil')" class="login-button-home">Retour à la page d'accueil</Link>
    </div>
  </div>
</template>

<style scoped>
  .login {
    display: flex;
    min-height: 100vh;
  }

  .login-image-box {
    display: flex;
    height: 100vh;
    width: 600px;
  }

  .login-image {
    height: 100%;
    width: 100%;
    object-fit: cover;
  }

  .login-form-box {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: auto 0;
    max-height: 100vh;
    overflow-y: auto;
  }

  .login-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 480px;
    padding: 20px 60px;
    margin-top: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 18px rgba(0, 0, 0, 0.1);
  }

  .login-form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 100%;
    margin-bottom: 30px;
  }

  .login-form-title {
    font-family: Calibri, sans-serif;
    font-size: 26px;
    font-weight: bold;
    color: #296242;
    margin-bottom: 10px;
  }

  .login-form-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
  }

  .login-form-redirect {
    color: #00A551;
    text-decoration: underline;
    cursor: pointer;
  }

  .login-form-inputs-box {
    display: flex;
    flex-direction: column;
    text-align: left;
    width: 100%;
    gap: 5px;
    margin: 10px 0 20px 0;
  }

  .login-form-label {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #7F7E83;
    margin-top: 20px;
  }

  .login-form-input-text {
    height: 40px;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  .login-form-error p {
    margin-top: 5px;
    color: crimson;
  }

  .login-form-input-submit {
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

  .login-form-input-submit:hover {
    background-color: #357d54;
  }

  .login-separator-methods {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 20px 0;
  }

  .login-separator {
    flex: 1;
    height: 2px;
    margin: 0 15px;
    background-color: #E5E5E5;
  }

  .login-button-methods {
    display: flex;
    align-items: center;
    gap: 20px;
    width: 100%;
    height: 40px;
    border: solid #E5E5E5 1px;
    border-radius: 12px;
    margin-bottom: 15px;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
    background-color: #ffffff;
    cursor: pointer;
    transition: 0.25s;
  }

  .login-button-methods:hover {
    border-color: #296242;
    color: #296242;
  }

  .login-button-home {
    margin: 30px 0 20px 0;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #00A551;
    cursor: pointer;
  }

  .login-form-loader {
    animation: 0.5s linear infinite loader; 
  }

  @keyframes loader {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
  }
  
  @media screen and (max-width: 1100px) {
    .login-image-box {
      display: none;
    }
  }

  @media screen and (max-width: 600px) {
    .login-card {
      width: calc(100% - 20px);
      box-shadow: none;
      padding: 10px 10px;
    }

    .login-form {
      margin-bottom: 15px;
    }

    .login-form-inputs-box {
      gap: 2px;
      margin: 10px 0 20px 0;
    }
  }
</style>
