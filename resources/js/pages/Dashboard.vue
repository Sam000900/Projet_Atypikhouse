<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue';
  import DashboardContent from '@/components/DashboardContent.vue';
</script>

<template>
  <DashboardLayout :pageData="{title: 'Dashboard'}">
    <DashboardContent />
  </DashboardLayout>
</template>

<style scoped>
</style>