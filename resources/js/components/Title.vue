<script setup>
  const props = defineProps(['text'])
</script>

<template>
  <div class="title layout-container">
    <h1 class="title-text">{{ props.text }}</h1>
  </div>
</template>

<style scoped>
  .title-text {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }
</style>