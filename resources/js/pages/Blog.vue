<script setup>
  import { ref, onMounted } from 'vue';

  import { getLastSixArticles } from '@/api/articleApi.js';
  
  import Header from '@/components/Header.vue'
  import BannerAlt from '@/components/large/BannerAlt.vue'
  import Gallery from '@/components/large/Gallery.vue'
  import Footer from '@/components/Footer.vue'
  import imgLogement from '@/../../public/images/img-spa-piscine-plage.jpg'

  const articles = ref([]);

  async function loadDatabaseContent() {
    articles.value = await getLastSixArticles();
  };

  onMounted(() => {
    loadDatabaseContent();
  });
</script>

<template>
  <Header />
  <BannerAlt :image="imgLogement" title="Blog" />
  <Gallery :articleData="articles" />
  <Footer />
</template>

<style scoped>
</style>
