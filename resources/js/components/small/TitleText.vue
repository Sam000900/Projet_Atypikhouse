<script setup>
  const props = defineProps(['title', 'texts'])
</script>

<template>
  <div class="titletext layout-container">
    <h2 class="titletext-title">{{ props.title }}</h2>
    <template v-for="(text, index) in props.texts" :key="index">
      <p class="titletext-text" v-html="text"></p>
    </template>
  </div>
</template>

<style scoped>
  .titletext {
    display: flex;
    flex-direction: column;
  }

  .titletext-title {
    font-family: "Larken-Medium";
    font-size: 36px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 20px;
  }

  .titletext-text {
    font-family: Calibri, sans-serif;
    font-size: 24px;
    font-weight: 400;
    color: #000000;
    line-height: 150%;
  }

  @media screen and (max-width: 1260px) {
    .titletext-text {
      font-size: 20px;
    }
  }
</style>