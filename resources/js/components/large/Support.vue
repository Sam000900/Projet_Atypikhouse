<script setup>
  import svgShield from '@/../../public/images/svg-shield.svg'
  import svgSupport from '@/../../public/images/svg-support.svg'
  import svgSerurePayment from '@/../../public/images/svg-secure-payment.svg'

  const cardData = [
    {
      image: svgShield,
      alt: 'Bouclier',
      title: 'Assurance & Garantie',
      text: 'Protection contre les dommages et assistance 24h/24 et 7j/7.',
    },
    {
      image: svgSupport,
      alt: 'casque audio avec micro',
      title: 'Support et Formation',
      text: 'Accès à des guides et une assistance dédiée',
    },
    {
      image: svgSerurePayment,
      alt: 'Paiement sécurisé',
      title: 'Paiements sécurisés',
      text: 'Gestion des transactions sans risque.',
    },
  ]
</script>

<template>
  <div class="support layout-container">
    <h2 class="support-title">Sécurité et Accompagnement</h2>
    <div class="support-content">
      <div class="support-card" v-for="card in cardData" :key="card.title">
        <div class="support-card-image-box">
          <img :src="card.image" :alt="card.alt" class="support-card-image" />
        </div>
        <div class="support-card-description">
          <h3 class="support-card-title">{{ card.title }}</h3>
          <p class="support-card-text">{{ card.text }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .support {
    display: flex;
    flex-direction: column;
  }

  .support-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 80px;
  }

  .support-content {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 40px;
  }

  .support-card {
    flex: 1;
    display: flex;
    justify-content: center;
    gap: 20px;
    width: 100%;
  }

  .support-card-image {
    height: 65px;
    flex-shrink: 0;
  }

  .support-card-description {
    display: flex;
    flex-direction: column;
    gap: 5px;
    max-width: 250px;
  }

  .support-card-title {
    font-family: "Larken-Medium";
    font-size: 20px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .support-card-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1200px) {
    .support-title {
      text-align: center;
    }
  }

  @media screen and (max-width: 1100px) {
    .support-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
    }

    .support-card:last-child {
      grid-column: 1 / span 2;
    }
  }

  @media screen and (max-width: 800px) {
    .support-content {
      display: grid;
      grid-template-columns: 1fr;
      gap: 60px;
    }

    .support-card {
      justify-content: start;
    }

    .support-card:last-child {
      grid-column: auto;
    }
  }
</style>