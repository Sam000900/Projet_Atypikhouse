<script setup>
  import { Link } from '@inertiajs/vue3';
  import svgDocument from '@/../../public/images/svg-document.svg'
  import svgImages from '@/../../public/images/svg-images.svg'
  import svgBooking from '@/../../public/images/svg-booking.svg'
  import svgMoney from '@/../../public/images/svg-money.svg'

  const stepsCards = [
    {
      title: "Inscrivez votre logement",
      text: "Remplissez un formulaire simple",
      image: svgDocument,
      alt: "Formulaire"
    },
    {
      title: "Ajoutez des photos et une description",
      text: "Attirez les voyageurs avec un contenu engageant",
      image: svgImages,
      alt: "Images empilées"
    },
    {
      title: "Définissez vos tarifs et disponibilités",
      text: "Vous êtes maître de votre calendrier",
      image: svgBooking,
      alt: "Réservation sur un ordinateur"
    },
    {
      title: "Recevez des réservations",
      text: "Profitez d'un système sécurisé et intuitif",
      image: svgMoney,
      alt: "Pièces de monnaie"
    },
  ]
</script>

<template>
  <div class="steps layout-container">
    <h2 class="steps-title">Commentaire Ça Marche ?</h2>
    <div class="steps-container">
      <div class="steps-line"></div>
      <div class="steps-card" v-for="card in stepsCards" :key="card.title">
        <div class="steps-card-image-box">
          <img :src="card.image" :alt="card.alt" class="steps-card-image" />
        </div>
        <div class="steps-card-text-box">
          <h3 class="steps-card-title">{{ card.title }}</h3>
          <p class="steps-card-text">{{ card.text }}</p>
        </div>
      </div>
      <div class="steps-button-box">
        <Link :href="route('connexion')" class="steps-button" as="button">Commencer dès maintenant</Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .steps {
    display: flex;
    flex-direction: column;
  }

  .steps-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 80px;
  }

  .steps-container {
    position: relative;
    display: flex;
    justify-content: space-between;
    gap: 20px;
  }

  .steps-line {
    z-index: 0;
    position: absolute;
    top: 55px;
    width: calc(100% - 200px);
    margin: auto 100px;
    border-top: solid 3px #296242;
  }

  .steps-card {
    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: center;
    gap: 20px;
  }

  .steps-card-image-box {
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 110px;
    height: 110px;
    border-radius: 100px;
    border: solid #296242 3px;
    background-color: #ffffff;
  }

  .steps-card-image {
    width: 55%;
    aspect-ratio: 1/1;
  }

  .steps-card-text-box {
    display: flex;
    flex-direction: column;
    width: 250px;
  }

  .steps-card-title {
    font-family: "Larken-Medium";
    font-size: 18px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 5px;
    text-align: center;
  }

  .steps-card-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    text-align: center;
  }

  .steps-button-box {
    display: flex;
    justify-content: center;
    z-index: 1;
  }

  .steps-button {
    height: 50px;
    padding: 0 30px;
    margin-top: calc(60px - 25px - 3px);
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

  .steps-button:hover {
    background-color: #357d54;
  }

  @media screen and (max-width: 1440px) {
    .steps-card-text-box {
      width: 150px;
    }

    .steps-line {
      top: 45px;
      border-top-width: 2px;
    }

    .steps-card-image-box {
      flex-shrink: 0;
      width: 90px;
      height: 90px;
      border-width: 2px;
    }

    .steps-button {
      margin-top: calc(50px - 25px - 4px);
    }
  }

  @media screen and (max-width: 1000px) {
    .steps-container {
      flex-direction: column;
    }

    .steps-title {
      margin-bottom: 40px;
      font-size: 40px;
      text-align: center;
    }

    .steps-line {
      position: absolute;
      height: 60%;
      margin: 0 45px;
      border-top: 0;
      border-left: solid 2px #296242;
    }

    .steps-card {
      flex-direction: row;
    }

    .steps-card-text-box {
      width: auto;
    }

    .steps-card-title, .steps-card-text {
      text-align: start;
    }

    .steps-button {
      margin-top: 0;
    }
  }
</style>