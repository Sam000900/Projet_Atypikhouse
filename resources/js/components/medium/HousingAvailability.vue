<script setup>
  import { ref } from 'vue';

  const attrs = ref([
    {
      key: 'available',
      content: 'blue',
      dates: { repeat: true },
    },
    {
      key: 'today',
      dot: 'orange',
      dates: new Date(),
    },
    {
      key: 'not-available',
      highlight: 'red',
      content: true,
      dates: [
        new Date(2025, 3, 1),
        new Date(2025, 3, 2),
        new Date(2025, 3, 3),
        new Date(2025, 3, 4),
        new Date(2025, 3, 5),
      ],
    },
    {
      key: 'reserved',
      highlight: 'green',
      content: true,
      dates: [
        new Date(2025, 3, 11),
        new Date(2025, 3, 12),
        new Date(2025, 3, 16),
        new Date(2025, 3, 17),
        new Date(2025, 3, 18),
      ],
    },
  ]);
</script>

<template>
  <div class="housingavailability">
    <h2 class="housingavailability-title">Disponibilités & Réservations</h2>
    <div class="housingrules-content">
      <div class="housingrules-calendar-box">
        <VCalendar
          :attributes='attrs'
          expanded
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .housingavailability {
    display: flex;
    flex-direction: column;
  }

  .housingavailability-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housingrules-content {
    display: flex;
    align-items: center;
    flex-direction: column;
    margin-top: 40px;
  }

  .housingrules-calendar-box {
    width: 600px;
  }
</style>