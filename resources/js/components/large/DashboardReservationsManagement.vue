<script setup>
  import { ref, onMounted } from 'vue';
  import { getUserReservations } from '@/api/reservationApi';
  import DashboardReservationCard from '@/components/medium/DashboardReservationCard.vue';

  const reservations = ref([]);

  async function loadReservations() {
    reservations.value = await getUserReservations();
  };

  /* onMounted */
  onMounted(() => {
    loadReservations();
  });
</script>

<template>
  <div class="dashboardreservationsmanagement">
    <div class="dashboardreservationsmanagement-main" :style="{ justifyContent: reservations.length <= 0 ? 'center' : 'start' }">
      <p class="dashboardreservationsmanagement-text" v-if="reservations.length <= 0">Aucune réservation effectuée pour le moment !</p>
      <template v-else v-for="reservation in reservations" :key="reservation.id">
        <DashboardReservationCard :reservationInfo="reservation" />
      </template>
    </div>
  </div>
</template>

<style scoped>
  .dashboardreservationsmanagement {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 20px;
  }

  .dashboardreservationsmanagement-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
  }

  .dashboardreservationsmanagement-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
  }
</style>