<script setup>
  import { LoaderCircle } from 'lucide-vue-next';
</script>

<template>
  <div class="loader">
    <LoaderCircle class="loader-icon" />
  </div>
</template>

<style scoped>
  .loader {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

  .loader-icon {
    animation: 0.5s linear infinite loader; 
  }

  @keyframes loader {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
  }
</style>