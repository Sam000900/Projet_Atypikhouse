<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue';
  import DashboardReservationsManagement from '@/components/DashboardReservationsManagement.vue';
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestion des réservations'}">
    <DashboardReservationsManagement />
  </DashboardLayout>
</template>

<style scoped>
</style>