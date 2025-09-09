<script setup>
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import DashboardCommunicationManagement from '@/components/large/DashboardCommunicationManagement.vue'
</script>

<template>
  <DashboardLayout :pageData="{title: 'Communication'}">
    <DashboardCommunicationManagement />
  </DashboardLayout>
</template>