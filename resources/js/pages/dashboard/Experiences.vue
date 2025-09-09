<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue';
  import DashboardExperiencesManagement from '@/components/large/DashboardExperiencesManagement.vue';
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestion des expériences'}">
    <DashboardExperiencesManagement />
  </DashboardLayout>
</template>