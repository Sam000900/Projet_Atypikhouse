<script setup>
  import { Link } from '@inertiajs/vue3';
  import imgHommeLogement from '@/../../public/images/img-homme-accueillant-dans-petit-logement-ovale.jpg'
</script>

<template>
  <div class="forminfoaccommodation">
    <div class="forminfoaccommodation-left-box">
      <h2 class="forminfoaccommodation-title">Partagez votre logement, gagnez de l'argent et rejoignez une communauté passionnée !</h2>
      
      <!--
      <form class="forminfoaccommodation-form">
        <div class="forminfoaccommodation-form-grid">
          <div>
            <label class="forminfoaccommodation-form-label" for="lastname">Nom</label><br>
            <input class="forminfoaccommodation-form-input-text" type="text" id="lastname" name="lastname" placeholder="Nom" required />
          </div>

          <div>
            <label class="forminfoaccommodation-form-label" for="firstname">Prénom</label><br>
            <input class="forminfoaccommodation-form-input-text" type="text" id="firstname" name="firstname" placeholder="Prénom" required />
          </div>
        </div>
        <label class="forminfoaccommodation-form-label" for="email">Email</label>
        <input class="forminfoaccommodation-form-input-text" type="email" id="email" name="email" placeholder="Email" required />
        <div class="forminfoaccommodation-submit-box">
          <button class="forminfoaccommodation-submit">Inscrivez votre logement dès maintenant</button>
        </div>
      </form>
      -->

      <Link :href="route('connexion')" class="forminfoaccommodation-submit" as="button">Commencer dès maintenant</Link>
    </div>
    <div class="forminfoaccommodation-right-box">
      <img :src="imgHommeLogement" alt="Homme accueillant devant son logement" class="forminfoaccommodation-image" />
    </div>
  </div>
</template>

<style scoped>
  .forminfoaccommodation {
    display: flex;
    background-color: #F3EEE7;
    margin-top: 20px;
    max-height: 500px;
  }

  .forminfoaccommodation-left-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px 60px;
    flex: 1;
  }

  .forminfoaccommodation-title {
    font-family: "Larken-Medium";
    font-size: 32px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .forminfoaccommodation-form {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-top: 60px;
  }

  .forminfoaccommodation-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    width: 100%;
  }

  .forminfoaccommodation-form-label {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  .forminfoaccommodation-form-input-text {
    width: 100%;
    height: 40px;
    margin-top: 5px;
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

  .forminfoaccommodation-submit-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }

  .forminfoaccommodation-submit {
    height: 50px;
    padding: 0 30px;
    margin-top: 40px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    transition: 0.25s;
    cursor: pointer;
  }

  .forminfoaccommodation-submit:hover {
    background-color: #357d54;
  }

  .forminfoaccommodation-right-box {
    width: 50%;
    display: flex;
  }

  .forminfoaccommodation-image {
    width: 100%;
    object-fit: cover;
  }

  @media screen and (max-width: 1250px) {
    .forminfoaccommodation-right-box {
      width: 40%;
    }
  }

  @media screen and (max-width: 1000px) {
    .forminfoaccommodation-right-box {
      width: 30%;
    }
  }

  @media screen and (max-width: 800px) {
    .forminfoaccommodation {
      max-height: none;
    }

    .forminfoaccommodation-right-box {
      display: none;
    }
  }

  @media screen and (max-width: 600px) {
    .forminfoaccommodation-title {
      font-size: 28px;
    }

    .forminfoaccommodation-form {
      margin-top: 30px;
    }

    .forminfoaccommodation-form-grid {
      grid-template-columns: 1fr;
      gap: 0;
    }
  }

  @media screen and (max-width: 500px) {
    .forminfoaccommodation-left-box {
      padding: 30px 20px;
    }
  }
</style>