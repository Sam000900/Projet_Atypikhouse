<script setup>
  import { ref, onMounted } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import { getLastSixArticles } from '@/api/articleApi.js';
  import Header from '@/components/Header.vue'
  import BannerAlt from '@/components/large/BannerAlt.vue'
  import ArticleContent from '@/components/large/ArticleContent.vue'
  import Gallery from '@/components/large/Gallery.vue'
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
</script>

<template>
  <Header />
  <BannerAlt :image="uniqueArticleData.image_path" />
  <ArticleContent :uniqueArticleData="uniqueArticleData"/>
  <Gallery :articleData="articles" />
  <Footer />
</template>

<style scoped>
</style>