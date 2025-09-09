<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import DashboardArticlesManagement from '@/components/large/DashboardArticlesManagement.vue'
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestion des articles'}">
    <DashboardArticlesManagement />
  </DashboardLayout>
</template>