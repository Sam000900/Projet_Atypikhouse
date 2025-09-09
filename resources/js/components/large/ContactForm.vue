<script setup>
  import { useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';

  const form = useForm({
    lastname: '',
    firstname: '',
    email: '',
    phone: '',
    message: '',
  })

  const submit = () => {
    form.post(route('contact'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
  };
</script>

<template>
  <div class="contactform layout-container">
    <form @submit.prevent="submit" class="contactform-form">
      <h2 class="contactform-title">Nous contacter</h2>
      <div class="contactform-content">

        <div class="contactform-input-box">
          <label for="lastname" class="contactform-label">Nom</label>
          <input
            v-model="form.lastname"
            id="lastname"
            name="lastname"
            type="text"
            class="contactform-input-text"
            required
            autofocus
            :tabindex="1"
            autocomplete="lastname"
            placeholder="Nom"
          />
          <div v-if="form.errors.lastname" class="contactform-error">
            <p>{{ form.errors.lastname }}</p>
          </div>
        </div>

        <div class="contactform-input-box">
          <label for="firstname" class="contactform-label">Prénom</label>
          <input
            v-model="form.firstname"
            id="firstname"
            name="firstname"
            type="text"
            class="contactform-input-text"
            required
            autofocus
            :tabindex="2"
            autocomplete="firstname"
            placeholder="Prénom"
          />
          <div v-if="form.errors.firstname" class="contactform-error">
            <p>{{ form.errors.firstname }}</p>
          </div>
        </div>

        <div class="contactform-input-box">
          <label for="email" class="contactform-label">Email</label>
          <input
            v-model="form.email"
            id="email"
            name="email"
            type="email"
            class="contactform-input-text"
            required
            autofocus
            :tabindex="3"
            autocomplete="email"
            placeholder="Email"
          />
          <div v-if="form.errors.email" class="contactform-error">
            <p>{{ form.errors.email }}</p>
          </div>
        </div>

        <div class="contactform-input-box">
          <label for="phone" class="contactform-label">Téléphone</label>
          <input
            v-model="form.phone"
            id="phone"
            name="phone"
            type="tel"
            class="contactform-input-text"
            required
            autofocus
            :tabindex="4"
            autocomplete="phone"
            placeholder="Téléphone"
          />
          <div v-if="form.errors.phone" class="contactform-error">
            <p>{{ form.errors.phone }}</p>
          </div>
        </div>

        <div class="contactform-input-box">
          <label for="message" class="contactform-label">Message</label>
          <textarea
            v-model="form.message"
            id="message"
            name="message"
            class="contactform-textarea"
            required
            autofocus
            :tabindex="5"
            autocomplete="message"
            placeholder="Message"
          ></textarea>
          <div v-if="form.errors.message" class="contactform-error">
            <p>{{ form.errors.message }}</p>
          </div>
        </div>
      </div>

      <p class="contactform-text">En soumettant ce formulaire, j'accepte que mes informations soient utilisées uniquement dans le cadre de ma demande et de la relation commerciale éthique et personnalisé qui peut en découler.</p>

      <div class="contactform-success-box">
        <div v-if="form.wasSuccessful" class="contactform-success">
          <p>Votre message a bien été envoyé</p>
        </div>
      </div>

      <div class="contactform-button-box">
        <button
          type="submit"
          class="contactform-button"
          :tabindex="6"
          :disabled="form.processing"
        >
          Envoyer
          <LoaderCircle v-if="form.processing" class="contactform-loader" />
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
  .contactform {
    display: flex;
    flex-direction: column;
    padding: 60px 60px 30px 60px;
    border-radius: 30px;
    background-color: #3F5A54;
  }

  .contactform-form {
    display: flex;
    flex-direction: column;
  }

  .contactform-title {
    font-family: "Larken-Medium";
    font-size: 36px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
    text-align: center;
  }

  .contactform-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
  }

  .contactform-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin: 40px 0;
  }

  .contactform-input-box {
    display: flex;
    flex-direction: column;
  }

  .contactform-input-box:last-child {
    grid-column: span 2;
  }

  .contactform-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 10px;
  }

  .contactform-input-text {
    height: 40px;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
  }

  .contactform-textarea {
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
  }

  .contactform-button-box {
    display: flex;
    justify-content: center;
    margin-top: 30px;
  }

  .contactform-button {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    height: 40px;
    padding: 0 60px;
    border: 0;
    border-radius: 8px;
    background-color: #ffffff;
    color: #296242;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .contactform-button:hover {
    background-color: #F4F4F4;
  }

  .contactform-success-box {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
  }

  .contactform-error, .contactform-success {
    width: fit-content;
    margin-top: 10px;
    padding: 5px 10px;
    background-color: white;
    border-radius: 5px;
  }

  .contactform-error p { color: crimson; }
  .contactform-success p {
    color: #3F5A54;
    text-align: center;
  }

  .contactform-loader {
    animation: 0.5s linear infinite loader; 
  }

  @keyframes loader {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
  }

  @media screen and (max-width: 1000px) {
    .contactform-content {
      display: flex;
      flex-direction: column;
      row-gap: 15px;
    }
  }

  @media screen and (max-width: 800px) {
    .contactform {
      padding: 30px 20px;
    }
  }
</style>