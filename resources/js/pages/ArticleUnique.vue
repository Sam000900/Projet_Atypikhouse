<script setup>
  import { ref, onMounted, watchEffect } from 'vue';
  import { usePage } from '@inertiajs/vue3';

  import { getLastSixArticles } from '@/api/articleApi.js';

  import Header from '@/components/Header.vue'
  import Banner from '@/components/Banner.vue'
  import ArticleContent from '@/components/ArticleContent.vue'
  import Gallery from '@/components/Gallery.vue'
  import Footer from '@/components/Footer.vue'

  const { props } = usePage();
  const uniqueArticleData = props.uniqueArticleData;
  const articles = ref([]);

  async function loadDatabaseContent() {
    articles.value = await getLastSixArticles();
  };

  onMounted(() => {
    if (uniqueArticleData?.id) {
      loadDatabaseContent();
    }
  });

  watchEffect(() => {
    if (uniqueArticleData?.id) {
      loadDatabaseContent();
    }
  });
</script>

<template>
  <Header />
  <Banner :image="uniqueArticleData.image_path" />
  <ArticleContent :uniqueArticleData="uniqueArticleData"/>
  <Gallery :articleData="articles" />
  <Footer />
</template>

<style scoped>
</style>