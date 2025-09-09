<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue';
  import DashboardReservationsManagement from '@/components/large/DashboardReservationsManagement.vue';
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestion des réservations'}">
    <DashboardReservationsManagement />
  </DashboardLayout>
</template>