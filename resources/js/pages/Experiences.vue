<script setup>
  import { ref, onMounted } from 'vue';
  import { getExperiencesByTypes } from '@/api/experienceApi.js';
  import Header from '@/components/Header.vue';
  import Banner from '@/components/Banner.vue';
  import CarouselCardsExperiences from '@/components/CarouselCardsExperiences.vue';
  import Footer from '@/components/Footer.vue';
  import imgExperiences from '@/../../public/images/img-homme-au-milieu-de-ballons.jpg';

  const experiences = ref([]);

  async function loadDatabaseContent() {
    experiences.value = await getExperiencesByTypes();
  };

  onMounted(() => {
    loadDatabaseContent();
  });
</script>

<template>
  <Header />
  <Banner :image="imgExperiences" />
  <CarouselCardsExperiences title="Séjours bien-êtres" :experiencesData="experiences.wellness" />
  <CarouselCardsExperiences title="Aventures" :experiencesData="experiences.adventure" />
  <CarouselCardsExperiences title="Gastronomie locale" :experiencesData="experiences.gastronomy" />
  <Footer />
</template>

<style scoped>
</style>
