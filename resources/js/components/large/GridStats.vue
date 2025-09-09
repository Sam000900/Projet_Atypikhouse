<script setup>
  const statsCards = [
    { value:'+85%', text:'des hôtes louent leur logement en toute flexibilité, selon leurs disponibilités.' },
    { value:'2500€', text:'de revenus mensuels pour les logements les plus demandés.' },
    { value:'95%', text:'des hôtes affirment que leur expérience de localisation est positive et enrichissante.' },
    { value:'100%', text:'sécurisé : Garantie et assurance incluse pour protéger votre bien.' },
  ]
</script>

<template>
  <div class="gridstats layout-container">
    <div class="gridstats-grid">
      <div class="gridstats-card" v-for="card in statsCards" :key="card.value">
        <h2 class="gridstats-card-value">{{ card.value }}</h2>
        <p class="gridstats-card-text">{{ card.text }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .gridstats {
    display: flex;
    flex-direction: column;
  }

  .gridstats-grid {
    display: grid;
    gap: 60px;
    grid-template-columns: 1fr 1fr 1fr 1fr;
  }

  .gridstats-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .gridstats-card-value {
    font-family: "Larken-Medium";
    font-size: 52px;
    font-weight: bold;
    color: #296242;
    margin-bottom: 10px;
  }

  .gridstats-card-text {
    max-width: 300px;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1120px) {
    .gridstats-grid {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media screen and (max-width: 800px) {
    .gridstats-grid {
      gap: 30px;
    }
  }

  @media screen and (max-width: 600px) {
    .gridstats-grid {
      grid-template-columns: 1fr;
    }

    .gridstats-card-value {
      margin-bottom: 0;
    }
  }
</style>