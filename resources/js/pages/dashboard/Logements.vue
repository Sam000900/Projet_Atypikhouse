<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import DashboardHousingManagement from '@/components/large/DashboardHousingManagement.vue';
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestion des logements'}">
    <DashboardHousingManagement />
  </DashboardLayout>
</template>