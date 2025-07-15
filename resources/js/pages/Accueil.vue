<script setup>
  import { ref, onMounted } from 'vue';

  import { getLastThreeAccommodations } from '@/api/accommodationApi.js';
  import { getUniqueExperienceByTypes } from '@/api/experienceApi.js';
  import { getLastSixArticles } from '@/api/articleApi.js';

  import Header from '@/components/Header.vue';
  import Banner from '@/components/Banner.vue';
  import TrioCards from '@/components/TrioCards.vue';
  import ImageTextBloc from '@/components/ImageTextBloc.vue';
  import Gallery from '@/components/Gallery.vue';
  import ExperiencesCards from '@/components/ExperiencesCards.vue';
  import Footer from '@/components/Footer.vue';
  import bannerImage from '@/../../public/images/img-logement-insolite.jpg';

  const accommodations = ref([]);
  const experiences = ref([]);
  const articles = ref([]);

  async function loadDatabaseContent() {
    accommodations.value = await getLastThreeAccommodations();
    experiences.value = await getUniqueExperienceByTypes();
    articles.value = await getLastSixArticles();
  };

  onMounted(() => {
    loadDatabaseContent();
  });
</script>

<template>
  <Header />
  <Banner :image="bannerImage" />
  <TrioCards :accommodationsData="accommodations" />
  <ExperiencesCards :experiencesdata="experiences" />
  <ImageTextBloc />
  <Gallery :articleData="articles" />
  <Footer />
</template>

<style scoped>
</style>