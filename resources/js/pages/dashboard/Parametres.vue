<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import DashboardParameters from '@/components/large/DashboardParameters.vue'
</script>

<template>
  <DashboardLayout :pageData="{title: 'Paramètres'}">
    <DashboardParameters />
  </DashboardLayout>
</template>