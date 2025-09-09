<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import DashboardData from '@/components/large/DashboardData.vue'
</script>

<template>
  <DashboardLayout :pageData="{title: 'Gestions des données'}">
    <DashboardData />
  </DashboardLayout>
</template>