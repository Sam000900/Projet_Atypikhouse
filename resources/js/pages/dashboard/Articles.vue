<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import DashboardArticlesManagement from '@/components/DashboardArticlesManagement.vue'
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestion des articles'}">
    <DashboardArticlesManagement />
  </DashboardLayout>
</template>

<style scoped>
</style>