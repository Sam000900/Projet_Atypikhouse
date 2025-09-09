<script setup>
  import StatsCard from '@/components/medium/StatsCard.vue';

  const statsCardsData = [
      { title: 'Revenus du mois', text: '4 100 €', icon: 'DollarCircle', color: 'green' },
      { title: 'Taux d’occupation ', text: '85 %', icon: 'Chart1', color: 'blue' },
      { title: 'Réservation en attente', text: '7', icon: 'Clock', color: 'violet' },
      { title: 'Note moyenne', text: '4.6', icon: 'Star1', color: 'orange' }
  ];
</script>

<template>
  <div class="dashboardcontent-main">
    <div class="dashboardcontent-stats-box" >
      <StatsCard v-for="card in statsCardsData" :cardData="card" :key="card.title" />
    </div>
  </div>
</template>

<style scoped>
  .dashboardcontent-main {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
  }

  .dashboardcontent-stats-box {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
  }

  @media screen and (max-width: 1000px) {
    .dashboardcontent-stats-box {
      display: grid;
      grid-template-columns: repeat(1, 1fr);
      gap: 10px;
    }
  }
</style>